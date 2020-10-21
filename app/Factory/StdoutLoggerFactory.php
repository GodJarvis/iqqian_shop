<?php
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2020/10/14
 * Time: 15:51
 */

namespace App\Factory;


use App\Facade\Log;

class StdoutLoggerFactory
{
    public function __invoke()
    {
        // 返回 一个记录系统日志的 channel
        return Log::getLogChannel('sys');
    }
}