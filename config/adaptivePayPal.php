<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => 'engram.roma988-facilitator_api1.gmail.com',
        'password'    => 'C3EQYTGHN3FUL2NY',
        'secret'      => 'EHHCp7dbNICwIpKdS-WFlQOU78wmaf_-AmVUl3hcl0F-VmLNLnSz3LalQNT9EvHbkZ1360nGpZXBT9Os',
        'certificate' => '',
        'signature' => 'A4aO6CjVMiW0LvjQlznv5ivFZj56AnycUJ6Fy7-OCKpUSAAe8AfJ-ll3',
        'app_id'      => 'APP-80W284485P519543T',    // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => '',
        'password'    => '',
        'secret'      => '',
        'certificate' =>  '',
        'app_id'      => '',         // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can Only Be 'Sale', 'Authorization', 'Order'
    'currency'       => 'GBP',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl' => true,  
];
