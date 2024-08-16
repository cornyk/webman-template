<?php

return [
    'default' => [
        'ip' => env('BEANSTALK_HOST', '127.0.0.1'),
        'port' => env('BEANSTALK_PORT', 11300),
        'timeout' => 3, // s
        'options' => [
            'auth' => '', // password
            'delay'  => 2,      // delay seconds
            'retry_after' => 5, // in seconds
        ]
    ],
];
