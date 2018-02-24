
<?php

    return array(
/** set your paypal credential **/
'sandbox_client_id' =>'AVecA3Gvhi2SPoJva-mOa1AO-h_BB4c67isqxtPZv3epWw4pyeSWyg1gynmdZix78kCMY6qainO66qZq',
'sandbox_secret' => 'EHHCp7dbNICwIpKdS-WFlQOU78wmaf_-AmVUl3hcl0F-VmLNLnSz3LalQNT9EvHbkZ1360nGpZXBT9Os',
'live_client_id' => '',
'live_secret' => '',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 1000,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);