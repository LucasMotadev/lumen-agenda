<?php

return [
    'default' => 'mysql',
    'migrations' => 'migrations',
    'connections' => [
        'oracle' => [
            'driver'    => 'oracle',
            'host'      => env('DB_HOST_ORA', ''),
            'port'      => env('DB_PORT_ORA', ''),
            'database'  => env('DB_DATABASE_ORA', ''),
            'username'  => env('DB_USERNAME_ORA', ''),
            'password'  => env('DB_PASSWORD_ORA', ''),
            'charset'   => 'utf-8',
            'collation' => 'utf8_general_ci'
        ],
        'mysql' => [
            
            'driver'    => 'mysql',
            'host'      => env('DB_HOST_MYSQL', ''),
            'port'      => env('DB_PORT_MYSQL', ''),
            'database'  => env('DB_DATABASE_MYSQL', ''),
            'username'  => env('DB_USERNAME_MYSQL', ''),
            'password'  => env('DB_PASSWORD_MYSQL', ''),
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci'
            
        ]
    ]
];
