<?php
/**
 * Created by PhpStorm.
 * User: dc7
 * Date: 7/9/2019
 * Time: 12:01 PM
 */

namespace Tests;

use Aws\S3\S3Client;
use Laravel\Homestead\app\Model\TestBusiness;
use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    public function testss3Instance(){

        $this->assertTrue(
            (new TestBusiness('omerfolder'))
                ->setS3instance(new \Aws\S3\S3Client([
            'version' => 'latest',
            'region' => 'us-west-2'
        ])));

    }


}