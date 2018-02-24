<?php

namespace Modules\Wallet\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Redirect;
use Input;
use URL;
/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Modules\Wallet\Repositories\WalletsRepository;
use Modules\Wallet\Repositories\TransactionsRepository;


class AddMoneyController extends Controller
{
    private $_api_context;
    private $walletRepository;
    private $transactionsRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionsRepository $transactionsRepository,WalletsRepository $walletRepository)
    {
       $this->walletRepository = $walletRepository;
       $this->transactionsRepository = $transactionsRepository;
            /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');

        if($paypal_conf['settings']['mode'] == 'sandbox'){

        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['sandbox_client_id'], $paypal_conf['sandbox_secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }else{

       $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['live_client_id'], $paypal_conf['live_secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);

    }
    }
    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal()
    {
        return view('wallet::paywithpaypal');
    }
    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('GBP')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('GBP')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
            
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('addmoney.paywithpaypal');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('addmoney.paywithpaypal');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/

        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error','Unknown error occurred');
        // dd(Session::get('paypal_payment_id'));
        return Redirect::route('addmoney.paywithpaypal');
    }


    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/

        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('addmoney.paywithpaypal');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
       
    //}
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 
          
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            $user_id=auth()->user()->id;
        $findWallet= $this->walletRepository->getIfExistWallet($user_id);

       
        if($findWallet){
          
         $this->walletRepository->updateWallet($findWallet->id,$result);
          $wallet_id= $findWallet->id; 
            }else{

            $newWallet = $this->walletRepository->saveWallet($user_id,$result);

        $wallet_id= $newWallet->id;
            }

            $this->transactionsRepository->saveTransaction( $wallet_id,$result);
////////////////////////////////////
            \Session::put('success','Payment successully completed ');
            return Redirect::route('addmoney.paywithpaypal');
        }

        \Session::put('error','Payment failed');
        return Redirect::route('addmoney.paywithpaypal');
    }



  }