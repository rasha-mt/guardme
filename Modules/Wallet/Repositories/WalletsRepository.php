<?php

namespace Modules\Wallet\Repositories;


use Modules\Wallet\Models\Wallet;


class WalletsRepository
{
    /**
     * @var Wallet
     */
    private $wallet;


    /**
     * TransactionsRepository constructor.
     * @param Transactions $trans
     */
    public function __construct(Wallet $wallet)
    {
        $this->$wallet = $wallet;
    }


     public function saveWallet($user_id,$data)
    {
      $payerId=$data->payer->payer_info->payer_id;
      $payerEmail=$data->payer->payer_info->email;
      $balance=$data->transactions[0]->amount->total;


       
        return Wallet::create([
            'user_id' => $user_id,
            'account_id' => $payerId,
            'paypal_email' => $payerEmail,
            'balance'=> $balance
           
        ]);
    }

////////////
     public function getIfExistWallet($user_id)
    {
        
        $result=Wallet::where('user_id', $user_id)->first();
        
    
         return  $result;
        
    }
/////////////////////////////////////////////////////
public function updateWallet($walletId,$data){

$amount=$data->transactions[0]->amount->total;
    $wal=Wallet::findOrFail($walletId);
    if($wal->balance != 0) {
            $wal->balance += $amount;
            $wal->save();
        }else{
$wal=$this->wallet->balance = $amount ;
 $wal->save();
}
  }
////////////////
  public function withdrawFromWallet($walletId,$amount){

    $wal=Wallet::findOrFail($walletId);
    
            $editBalance=$wal->balance - $amount;
           
            $wal->balance=$editBalance;
            $wal->save();
        
  }
/////////////////////////////

  public function getWalletBalance($userId){

 $result=Wallet::where('user_id', $userId)->first();
        $balance=$result->balance;
    
         return  $balance;

  }
///////////////////////

///////////////////////
 
}

?>