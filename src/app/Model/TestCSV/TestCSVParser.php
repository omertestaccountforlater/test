<?php
/**
 * Created by PhpStorm.
 * User: dc7
 * Date: 7/9/2019
 * Time: 3:01 PM
 */

namespace Laravel\Homestead\app\Model\TestCSV;


class TestCSVParser
{
    protected $data;

    public function getCSV(){

        $c = curl_init();

        curl_setopt_array($c, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://admin.b2b-carmarket.com//test/project',
        ]);

        $resp = curl_exec($c);

        curl_close($c);

        $this->data = $resp;

        return $this->data;


    }


}