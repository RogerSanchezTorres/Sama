<?php

// config/excel.php

use Maatwebsite\Excel\Excel;

return [

    'exports' => [
        'csv' => [
            'delimiter' => ',',
        ],
    ],

    'imports' => [
        'csv' => [
            'delimiter' => ',',
        ],
    ],

    'value' => [
        'driver' => 'recursive',
    ],

    'precalculate' => false,

    'import' => [
        'start_row' => 2,
    ],

    'heading' => [
        'bold' => false,
        'size' => 12,
    ],

    'temporary_path' => storage_path('framework/excel'),

    'store' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
    ],

    'cache' => [
        'enabled' => true,
        'expire' => 600,
        'store' => 'array',  // Cambiado de 'file' a 'array'
    ],

    'queue' => [
        'import' => true,
        'export' => false,
    ],

    'extension_detector' => [
        'xlsx'     => Excel::XLSX,
        'xlsm'     => Excel::XLSX,
        'xltx'     => Excel::XLSX,
        'xltm'     => Excel::XLSX,
        'xls'      => Excel::XLS,
        'xlt'      => Excel::XLS,
        'ods'      => Excel::ODS,
        'ots'      => Excel::ODS,
        'slk'      => Excel::SLK,
        'xml'      => Excel::XML,
        'gnumeric' => Excel::GNUMERIC,
        'htm'      => Excel::HTML,
        'html'     => Excel::HTML,
        'csv'      => Excel::CSV,
        'tsv'      => Excel::TSV,
        'pdf'      => Excel::DOMPDF,
    ],

    'value_binder' => [
        'default' => Maatwebsite\Excel\DefaultValueBinder::class,
    ],

    'cache' => [
        'enabled' => true,
        'store' => null,
        'expire' => 600,
    ],

    'transactions' => [
        'handler' => 'db',
        'db'      => [
            'connection' => null,
        ],
    ],

    'temporary_files' => [
        'local_path'        => storage_path('framework/cache/laravel-excel'),
        'local_permissions' => [],
        'remote_disk'       => null,
        'remote_prefix'     => null,
        'force_resync_remote' => null,
    ],
];
