<?php
/**
 * Created by PhpStorm.
 * User: dc7
 * Date: 7/9/2019
 * Time: 9:14 AM
 */

namespace Laravel\Homestead\app\Helpers;


trait PublicPath
{

    /**
     * @param string $path_name
     * @return string
     */
    public static function getPublicPath($path_name = '') : string {

        // no helpers of laravel exist in here, so create one //
        return __DIR__ . '/../../../public/'.$path_name.'/';

    }

    /**
     * @param string $path_name
     * @return string
     */
    public static function getStoragePath() : string{


        return __DIR__ . '/../../../storage/';

    }

}