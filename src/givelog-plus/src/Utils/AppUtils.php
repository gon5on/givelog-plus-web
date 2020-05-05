<?php
namespace App\Utils;

class AppUtils {

    public static function beautifulExceptionLog(\Exception $e)
    {
        $trace = $e->getTraceAsString();
        $trace = preg_replace('/#/', '│ #', $trace);

        $log  =  PHP_EOL;
        $log .= "┌ Log Entry ─────────────────────────────────────────────────" . PHP_EOL;
        $log .= "│ Type    : " . get_class($e) . PHP_EOL;
        $log .= "│ File    : {$e->getFile()}" . PHP_EOL;
        $log .= "│ Line    : {$e->getLine()}" . PHP_EOL;
        $log .= "│ Code    : {$e->getCode()}" . PHP_EOL;
        $log .= "│ Message : {$e->getMessage()}" . PHP_EOL;
        $log .= "│ Trace   : " . PHP_EOL;
        $log .= $trace . PHP_EOL;
        $log .= "└────────────────────────────────────────────────────────────". PHP_EOL;

        return $log;
    }
}
?>