<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;
use URL;
use Validator;
use Redirect;



class TransactionsController  extends Controller
{
    /**
     * @var ExpressCheckout
     */
protected $provider;


    public function __construct()
    {
        $this->provider = new ExpressCheckout();
        
      $this->provider = \PayPal::setProvider('express_checkout');
    }

/////////////////////

public function getTransactionHistory()
    {
    return view('wallet::selectHistoryDate');
    }
///////////////////////

  /**
     * Parse PayPal IPN.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function postTransactionHistory(Request $request)
    {


       if (!($this->provider instanceof ExpressCheckout)) {
            $this->provider = new ExpressCheckout();
        }
       
       $startdate = $request->input('start');

       $sd=date('d',strtotime($startdate));
       $sm=date('m',strtotime($startdate));
       $sy=date('y',strtotime($startdate));

       $enddate = $request->input('end');
       $ed=date('d',strtotime($enddate));
       $em=date('m',strtotime($enddate));
       $ey=date('y',strtotime($enddate));

      $startDate = gmdate("Y-m-d\\TH:i:s\\Z",mktime(0, 0, 0, $sm, $sd,$sy));
       $endDate = gmdate("Y-m-d\\TH:i:s\\Z",mktime(0, 0, 0, $em, $ed,$ey));
   
 
   $conf = \Config::get('adaptivePayPal');
       
       
   $this->provider->setApiCredentials($conf);
 
 //dd($this->provider);
              

           $data = [
                     'STARTDATE'   =>  $startDate,
                    'ENDDATE'     => $endDate,
                    
                                  ];

        $response = $this->provider->searchTransactions($data);

$val=(count($response)-5)/11;

    return view('wallet::viewHistory',['data'=>$response,'rows' => $val]);
                      // return view('wallet::test');

    }
 


}


?>