<?php

namespace Modules\Wallet\Http\Controllers;

use Modules\Wallet\Repositories\WalletsRepository;
use Modules\Wallet\Repositories\TransactionsRepository;
use Modules\Mailmessenger\Mailer\MailMan;
use Session;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Srmklive\PayPal\Services\AdaptivePayments;
use Illuminate\Support\Facades\Auth;
use URL;
use Validator;
use Redirect;

class PayController  extends Controller
{
    /**
     * @var ExpressCheckout
     */
  protected $provider;
  private $walletRepository;
  private $transactionsRepository;
 

  public function __construct(TransactionsRepository $transactionsRepository,WalletsRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
        $this->transactionsRepository = $transactionsRepository;

        $this->provider = \PayPal::setProvider('adaptive_payments');
      
    }

////////////////////buyer form to enter withdraw amount///////////////////////
public function getWithdrawInputs(){

  return view('wallet::paypalwithdraw');
}

//////////////////////////make paypal request for merchant to pay money/////////////////////////////
    public function postAdaptivePay(Request $request)
    {
      
       $userId=auth()->user()->id;

       $result=$this->walletRepository->getIfExistWallet($userId);
        
        $request->validate([
             'withdraw_amount' => 'required',
        ]);
       $inputs=$request->all();

       if($result){

        $balance=$result->balance; 
       $rest=$this->transactionsRepository->getBuyerWithdraw($userId);
       if($rest == null ){$limit= $balance;}
       else{ $limit=$rest;}
      
       if($inputs['withdraw_amount'] > $balance or $inputs['withdraw_amount'] > $limit){
        return 
        back()->with('error',"The entered Amount is higher than your wallet balance $balance GBP, or you overcome the limit");
        
        }
        else{

          $amount=$request->input('withdraw_amount');
           $wallet_id= $result->id;

              $this->transactionsRepository->saveWithdraw($wallet_id, $amount);
              return back()->with('success',"Your withdraw process added successfully, withdrawal will be done in 24hours ");
        
        }
}
        else{

            return back()->with('error',"you don't have any balance to withdraw");
        
           }
 
    }
    ///////////////////////////////////////////////////////

    public function listWithdrawTransactions(){

     $result=$this->transactionsRepository->getAllWithdraw();
    
      return view('wallet::viewAllWithdraw',['data'=>$result]);
    }
    /********************approre withdraw transaction*************/
    public function approveAdaptivePay($transId){

      if(Auth::check()){
         $this->provider = new AdaptivePayments();
        $conf = \Config::get('adaptivePayPal');
      
        $this->provider->setApiCredentials($conf);


      $result=$this->transactionsRepository->getSpecificTransaction($transId);
  
    if($result){

      $account_email=$result->paypal_email;
      $amount=$result->amount;

      $data = [
            'receivers'  => 
                [
                    'email'   => $account_email,
                    'amount'  => $amount,
                    'primary' => false,
                ],
               
           
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => URL::route('paypal.paidSuccess'),
            'cancel_url' => URL::route('paypal.listwithdraw'),
        ];
 
        $response = $this->provider->createPayRequest($data);
      
       if($response['responseEnvelope']['ack'] == 'Success'){
          //$this->provider->withdrawFromWallet();
          // $this->transactionsRepository->saveTransaction( $wallet_id,$result,'withdraw');
       // $trans=['trans_id'=>$transId,'trans_amount'=>$amount];
        Session::put('transId', $transId);
       
        $redirect_url = $this->provider->getRedirectUrl('approved', $response['payKey']);
        return redirect($redirect_url);
    }
  }
  else{
     return Redirect::route('paypal.listHistory');
  }

}
  
  }
  //////////////////////////////////////////////

  public function getMerchantPaid(){

    $trans_id= Session::get('transId');

    $this->transactionsRepository->updateTransaction($trans_id); 
    
   $transDetails=$this->transactionsRepository->getSpecificTransaction($trans_id);

    $this->walletRepository->withdrawFromWallet($transDetails->wallet_id,$transDetails->amount);

     $mailman = app(MailMan::class);
     $mailman->prepare('account::emails.confirmWithdraw', compact('transDetails'))
                ->send( $transDetails->paypal_email, 'Withdraw Money completed successfully');


 // Session::forget('transData');
    return Redirect::route('paypal.listwithdraw')->with('success',"Your Payment Successfully completed");
  }

}


?>