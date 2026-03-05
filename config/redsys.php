<?php
return [
    'key'                   => env('REDSYS_KEY','Qsz6HKvKDd+NLmPdb1bwkc6sa3TcExkb'),
    'url_notification'      => env('REDSYS_URL_NOTIFICATION','http://127.0.0.1:8000/redsys/notify'),
    'url_ok'                => env('REDSYS_URL_OK','http://127.0.0.1:8000/redsys/ok'),
    'url_ko'                => env('REDSYS_URL_KO','http://127.0.0.1:8000/redsys/ko'),
    'merchantcode'          => env('REDSYS_MERCHANT_CODE','48295810'),
    'terminal'              => env('REDSYS_TERMINAL','001'),
    'enviroment'            => env('REDSYS_ENVIROMENT','live'),
    'tradename'             => env('REDSYS_TRADENAME','SubministresSama'),
];
