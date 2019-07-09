<?php
/**
 * Created by PhpStorm.
 * User: dc7
 * Date: 7/9/2019
 * Time: 11:30 AM
 */
namespace Laravel\Homestead\app\Helpers\Log;

use Laravel\Homestead\app\Helpers\PublicPath;

trait Log
{

    private static $path;

    public static function setPath()
    {

        self::$path = PublicPath::getStoragePath(); // can be called from some config file later on..

    }

    public static function write($info){
        self::setPath();
        $fp = fopen(self::$path.'Log-'.date('Y-m-d').'.log', 'a');
        fwrite($fp, $info.PHP_EOL);
        fclose($fp);

    }

    public static function getLogs($date){

        self::setPath();

        if(!$date){

            return new \Exception('You must enter date()');
        }

        return file_get_contents(self::$path.'Log-'.$date.'.log');

    }

    public static function searchLogRecord($log, $string){

          return strpos($log, $string);


    }

}