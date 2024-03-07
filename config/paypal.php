<?php

return [

    'client_id' => env('PAYPAL_CLIENT_ID'),

    'secret' => env('PAYPAL_SECRET'),

    'settings' => [
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ],

    'sandbox' => [
        'base_url' => 'https://www.sandbox.paypal.com',
        'api_url' => 'https://api.sandbox.paypal.com',
    ],
    'live' => [
        'base_url' => 'https://www.paypal.com',
        'api_url' => 'https://api.paypal.com',
    ],

];
