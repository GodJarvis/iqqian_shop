<?php
/**
 * Created by : PhpStorm
 * User: godjarvis
 * Date: 2020/10/14
 * Time: 15:25
 */

namespace App\Facade;

use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;

class Log
{
    public static function info($message, $name = 'app')
    {
        self::getLogChannel($name)->info($message);
    }

    public static function error($message, $name = 'app')
    {
        self::getLogChannel($name)->error($message);
    }

    public static function alert($message, $name = 'app')
    {
        self::getLogChannel($name)->alert($message);
    }

    public static function critical($message, $name = 'app')
    {
        self::getLogChannel($name)->critical($message);
    }

    public static function debug($message, $name = 'app')
    {
        self::getLogChannel($name)->debug($message);
    }

    public static function notice($message, $name = 'app')
    {
        self::getLogChannel($name)->notice($message);
    }

    public static function emergency($message, $name = 'app')
    {
        self::getLogChannel($name)->emergency($message);
    }

    public static function warning($message, $name = 'app')
    {
        self::getLogChannel($name)->warning($message);
    }

    public static function log($level, $message, $name = 'app')
    {
        self::getLogChannel($name)->log($level, $message);
    }

    public static function getLogger(): LoggerFactory
    {
        return ApplicationContext::getContainer()->get(LoggerFactory::class);
    }

    public static function getLogChannel($name = 'app')
    {
        return self::getLogger()->get($name);
    }
}
