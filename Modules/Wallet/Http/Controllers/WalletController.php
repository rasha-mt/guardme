<?php

namespace Modules\Wallet\Http\Controllers;

use Modules\Wallet\Repositories\WalletsRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use URL;
use Validator;
use Redirect;

class WalletController 
{
  private $walletRepository;

  public function __construct(WalletsRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
     
       
    }

public function viewEscrow(){

$userId=auth()->user()->id;

$clientWallet=$this->walletRepository->getIfExistWallet($userId);
if($clientWallet){
	$balance=$this->walletRepository->getWalletBalance($userId);
return view('wallet::viewEscrow',['balance' =>$balance ]);
}
else{
	$balance=0;
	return view('wallet::viewEscrow',['balance' =>$balance ]);
}

}

}