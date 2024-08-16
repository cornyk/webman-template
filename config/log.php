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
    // 应用日志
    'default' => [
        'handlers' => [
            [
                'class' => app\util\LogFileHandlerUtil::class,
                'constructor' => [
                    runtime_path() . '/logs/app.log',
                    10, //$maxFiles
                    Monolog\Logger::DEBUG,
                ],
                'formatter' => [
                    'class' => app\util\LogFormatterUtil::class,
                    'constructor' => [],
                ],
            ],
            [
                'class' => app\util\LogFileHandlerUtil::class,
                'constructor' => [
                    runtime_path() . '/logs/error.log',
                    10, //$maxFiles
                    Monolog\Logger::ERROR,
                ],
                'formatter' => [
                    'class' => app\util\LogFormatterUtil::class,
                    'constructor' => [],
                ],
            ]
        ],
    ],
    // 请求日志
    'access' => [
        'handlers' => [
            [
                'class' => app\util\LogFileHandlerUtil::class,
                'constructor' => [
                    runtime_path() . '/logs/access.log',
                    10, //$maxFiles
                    Monolog\Logger::DEBUG,
                ],
                'formatter' => [
                    'class' => app\util\LogFormatterUtil::class,
                    'constructor' => [],
                ],
            ]
        ],
    ],
    // 命令行执行日志
    'cli' => [
        'handlers' => [
            [
                'class' => app\util\LogFileHandlerUtil::class,
                'constructor' => [
                    runtime_path(). '/logs/cli.log',
                    10, //$maxFiles
                    Monolog\Logger::DEBUG,
                ],
                'formatter' => [
                    'class' => app\util\LogFormatterUtil::class,
                    'constructor' => [],
                ],
            ]
        ],
    ],
    // 错误日志
    'error' => [
        'handlers' => [
            [
                'class' => app\util\LogFileHandlerUtil::class,
                'constructor' => [
                    runtime_path() . '/logs/error.log',
                    10, //$maxFiles
                    Monolog\Logger::DEBUG,
                ],
                'formatter' => [
                    'class' => app\util\LogFormatterUtil::class,
                    'constructor' => [],
                ],
            ]
        ],
    ],
    // SQL日志
    'sql' => [
        'handlers' => [
            [
                'class' => app\util\LogFileHandlerUtil::class,
                'constructor' => [
                    runtime_path() . '/logs/sql.log',
                    10, //$maxFiles
                    Monolog\Logger::DEBUG,
                ],
                'formatter' => [
                    'class' => app\util\LogFormatterUtil::class,
                    'constructor' => [],
                ],
            ]
        ],
    ],
    // SQL错误日志
    'sql_error' => [
        'handlers' => [
            [
                'class' => app\util\LogFileHandlerUtil::class,
                'constructor' => [
                    runtime_path() . '/logs/sql_err.log',
                    10, //$maxFiles
                    Monolog\Logger::DEBUG,
                ],
                'formatter' => [
                    'class' => app\util\LogFormatterUtil::class,
                    'constructor' => [],
                ],
            ]
        ],
    ],
    // 发送请求日志
    'send_request' => [
        'handlers' => [
            [
                'class' => app\util\LogFileHandlerUtil::class,
                'constructor' => [
                    runtime_path() . '/logs/send_req.log',
                    10, //$maxFiles
                    Monolog\Logger::DEBUG,
                ],
                'formatter' => [
                    'class' => app\util\LogFormatterUtil::class,
                    'constructor' => [],
                ],
            ]
        ],
    ],
    // 发送请求日志
    'send_request_error' => [
        'handlers' => [
            [
                'class' => app\util\LogFileHandlerUtil::class,
                'constructor' => [
                    runtime_path() . '/logs/send_req_err.log',
                    10, //$maxFiles
                    Monolog\Logger::DEBUG,
                ],
                'formatter' => [
                    'class' => app\util\LogFormatterUtil::class,
                    'constructor' => [],
                ],
            ]
        ],
    ],
];
