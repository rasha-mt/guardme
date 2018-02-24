<?php


namespace Modules\Wallet\Repositories;


use Modules\Wallet\Models\Transactions;
use Modules\Wallet\Models\Wallet;

class TransactionsRepository
{
    /**
     * @var Transactions
     */
    private $trans;


    /**
     * TransactionsRepository constructor.
     * @param Transactions $trans
     */
    public function __construct(Transactions $trans)
    {
        $this->$trans = $trans;
    }

    public function saveTransaction($wallet_id, $data)
    {
        $total=$data->transactions[0]->amount->total;

        $state=$data->transactions[0]->related_resources[0]->sale->state;
        return Transactions::create([
            'wallet_id' => $wallet_id,
            'trans_type' => 'add',
            'trans_status' => $state,
            'amount' => $total,
          
           
        ]);
    }
/////////////////////////////////////////////////////
        public function saveWithdraw($wallet_id, $amount)
    {
    
        return Transactions::create([
            'wallet_id' => $wallet_id,
            'trans_type' => 'withdraw',
            'trans_status' => 'withdraw',
            'amount' => $amount,
          
           
        ]);
    }
/////////////////////////////////////////

    public function getAllWithdraw()
       {
        
        $result=Transactions::select('Transactions.id','amount','paypal_email','wallet_id')
                            ->orderBy('paypal_email','amount')
                            ->leftJoin('Wallet', 'Transactions.wallet_id', '=', 'wallet.id')
                            ->where('trans_type','=','withdraw')
                            ->where('confirm','0')->get();
        
  
         return  $result;
    }
//////////////get specific transaction///////////////////////////
    public function getSpecificTransaction($id){


 $result=Transactions::select('Transactions.id','amount','paypal_email','wallet_id','balance')
                           ->leftJoin('Wallet', 'Transactions.wallet_id', '=', 'wallet.id')
                            ->where('Transactions.id','=',$id)->first();
    
         return  $result;
    }
    ////////////////////////////////////////
  public function updateTransaction($id){

    $wal=Transactions::where('id',$id)->first();
    
            $wal->confirm = 1;
            $wal->trans_status='completed';
            $wal->save();
       
  }
  ///////////////////////////////////


    public function getBuyerWithdraw($userId)
       {
        $total=0;
     
    
  $result=Transactions::select('Transactions.id','amount','balance')
                            ->orderBy('amount')
                            ->leftJoin('Wallet', 'Transactions.wallet_id', '=', 'wallet.id')
                            ->where('wallet.user_id','=',$userId)
                            ->where('trans_type','=','withdraw')
                            ->where('confirm','0')->get(); 
         
         $rowsNo=count($result);                
     if($rowsNo > 1){   
       
    foreach($result as $data){
    $amount=$data->amount;
    $total+=$amount;
   
    }
    
    $rest=$data->balance-$total;
         return  $rest;
    }
    elseif($rowsNo == 1){

     foreach($result as $data){
    $balance=$data->balance;
    $amount=$data->amount;
    }
         $rest=$balance-$amount;
    return  $rest;

    }else{
    
      return null;
    }
  }


}