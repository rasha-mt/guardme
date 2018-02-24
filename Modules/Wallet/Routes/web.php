<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'account/wallet'], function () {
	Route::get('paywithpaypal', array('as' => 'addmoney.paywithpaypal','uses' => 'AddMoneyController@payWithPaypal',));
	Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'AddMoneyController@postPaymentWithpaypal',));
	Route::get('paypal', array('as' => 'payment.status','uses' => 'AddMoneyController@getPaymentStatus',));
	
	 Route::get('escrow',  'WalletController@viewEscrow');

    Route::get('withdrawInputs', array('as' => 'paypal.getwithdraw','uses' => 'PayController@getWithdrawInputs',));
	Route::post('withdraw', array('as' => 'paypal.postadaptivePay','uses' => 'PayController@postAdaptivePay',));

	Route::post('list-history',  'TransactionsController@postTransactionHistory');
    Route::get('list-history',  array('as' => 'paypal.listHistory','uses' => 'TransactionsController@getTransactionHistory',));

   Route::get('list-withdraw',  array('as' => 'paypal.listwithdraw','uses' => 'PayController@listWithdrawTransactions'));

   Route::get('approve-withdraw/{id}','PayController@approveAdaptivePay');

  Route::get('sucess-paid',  array('as' => 'paypal.paidSuccess','uses' => 'PayController@getMerchantPaid',));
  
	

});
