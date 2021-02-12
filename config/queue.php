<?php
return [
    'connections' => [
        'sync' => [
            'drive' => 'sync'
        ]
    ],
    'database' => [
        'drive' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
    ]

];
