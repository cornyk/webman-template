<?php

if (!(bool)env('BEANSTALK_CONSUMER_RUN', false)) {
    return [];
}

return [
    'consumer'  => [
        'handler'     => Cornyk\Webman\BeanstalkQueue\Process\Consumer::class,
        'count'       => 1, // could be more than 1
        'constructor' => [
            // consumer subdir
            'consumer_dir' => app_path() . '/queue/beanstalk'
        ]
    ]
];
