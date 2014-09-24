<?php


class SimpleLogger {

    public static $logFile = null;

    const CUSTOM_DATE_FORMAT = 'Y-m-d G:i:s.u';


    public static function addLog($filePath, $message){

        static::$logFile = $filePath;
        if(!file_exists(static::$logFile)) {
            fopen(static::$logFile, 'a');
        };

        if ( ! static::$logFile) {
            throw new RuntimeException('Nie można otworzyć pliku');
        }

        file_put_contents(static::$logFile, static::formatMessage($message), FILE_APPEND);

    }

    public static function formatMessage($message)
    {
        return "[".static::getTimestamp()."] {$message}".PHP_EOL;
    }

    public  static function getTimestamp()
    {
        $originalTime = microtime(true);
        $micro = sprintf("%06d", ($originalTime - floor($originalTime)) * 1000000);
        $date = new DateTime(date('Y-m-d H:i:s.'.$micro, $originalTime));
        return $date->format(static::CUSTOM_DATE_FORMAT);
    }


} 