<?php
return [
    'key'                   => env('REDSYS_KEY','sq7HjrUOBfKmC576ILgskD5srU870gJ7'),
    'url_notification'      => env('REDSYS_URL_NOTIFICATION','http://127.0.0.1:8000/redsys/notify'),
    'url_ok'                => env('REDSYS_URL_OK','http://127.0.0.1:8000/redsys/ok'),
    'url_ko'                => env('REDSYS_URL_KO','http://127.0.0.1:8000/redsys/ko'),
    'merchantcode'          => env('REDSYS_MERCHANT_CODE','999008881'),
    'terminal'              => env('REDSYS_TERMINAL','1'),
    'enviroment'            => env('REDSYS_ENVIROMENT','test'),
    'tradename'             => env('REDSYS_TRADENAME','SubministresSama'),
];
