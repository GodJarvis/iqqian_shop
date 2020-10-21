<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
$appEnv = env('APP_ENV', 'dev');
/**
 * dev(开发)环境: 日志使用 php://stdout 输出到 标准输出(stdout), 并且 Formatter 中设置 allowInlineLineBreaks, 方便查看多行日志
 * 非 dev 环境: 日志使用 JsonFormatter, 会被格式为 json, 方便投递到第三方日志服务
 */
if ($appEnv == 'dev') {
    $formatter = [
        'class'       => \Monolog\Formatter\LineFormatter::class,
        'constructor' => [
            'format'                => "[%datetime%] %channel%.%level_name%: %message%\n",
            'dateFormat'            => 'Y-m-d H:i:s',
            'allowInlineLineBreaks' => true,
            'includeStacktraces'    => true,
        ],
    ];
} else {
    $formatter = [
        'class'       => \Monolog\Formatter\JsonFormatter::class,
        'constructor' => [],
    ];
}

return [
//    'default' => [
//        'handler'   => [
////            'class'       => \Monolog\Handler\StreamHandler::class,
//            'class'       => Monolog\Handler\RotatingFileHandler::class,//日志文件可以按照日期轮转
//            'constructor' => [
////                'stream' => 'php://stdout',
//                'filename' => BASE_PATH . '/runtime/logs/hyperf.log',
//                'level'  => \Monolog\Logger::DEBUG,
//            ],
//        ],
//        'formatter' => $formatter,
//    ],

    'default' => [

        /**
         * 配置多个 handler
         * 当用户投递一个 DEBUG 级别以上的日志时，只会在 hyperf.log 中写入日志。
         * 当用户投递一个 ERROR 级别以上日志时，会在 hyperf.log 和 hyperf-error.log 写入日志。
         */
        'handlers' => [
            [
//                'class'       => Monolog\Handler\RotatingFileHandler::class,//日志文件可以按照日期轮转
                'class'       => \Monolog\Handler\StreamHandler::class,// 将日志输出到控制台中
                'constructor' => [
//                    'filename' => BASE_PATH . '/runtime/logs/hyperf.log',
                    'stream' => 'php://stdout',
                    'level'  => \Monolog\Logger::DEBUG,
                ],
                'formatter'   => $formatter,
            ],
            [
                'class'       => Monolog\Handler\RotatingFileHandler::class,//日志文件可以按照日期轮转
                'constructor' => [
                    'filename' => BASE_PATH . '/runtime/logs/hyperf-error.log',
                    'level'    => \Monolog\Logger::ERROR,
                ],
                'formatter'   => $formatter,
            ],
        ],
    ],
];
