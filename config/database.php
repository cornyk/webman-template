<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

return [
    // 默认数据库
    'default' => 'mysql',

    // 各种数据库配置
    'connections' => [
        'mysql' => [
            'driver'      => env('DB_DRIVER', 'mysql'),
            'host'        => env('DB_HOST', 'localhost'),
            'port'        => env('DB_PORT', '3306'),
            'database'    => env('DB_DATABASE'),
            'username'    => env('DB_USERNAME'),
            'password'    => env('DB_PASSWORD'),
            'unix_socket' => '',
            'charset'     => env('DB_CHARSET', 'utf8mb4'),
            'collation'   => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix'      => env('DB_PREFIX', ''),
            'strict'      => true,
            'engine'      => null,
            'options' => [
                PDO::ATTR_EMULATE_PREPARES => false, // 当使用swoole或swow作为驱动时是必须的
            ],
            'pool' => [ // 连接池配置
                'max_connections' => env('DB_MAX_CONN', 5),               // 最大连接数
                'min_connections' => env('DB_MIN_CONN', 1),               // 最小连接数
                'wait_timeout' => env('DB_WAIT_TIMEOUT', 3),              // 从连接池获取连接等待的最大时间，超时后会抛出异常。仅在协程环境有效
                'idle_timeout' => env('DB_IDLE_TIMEOUT', 60),             // 连接池中连接最大空闲时间，超时后会关闭回收，直到连接数为min_connections
                'heartbeat_interval' => env('DB_HEARTBEAT_INTERVAL', 50), // 连接池心跳检测时间，单位秒，建议小于60秒
            ],
        ],
    ],
];
