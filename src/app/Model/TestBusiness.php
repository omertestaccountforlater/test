<?php
/**
 * Created by PhpStorm.
 * User: dc7
 * Date: 7/9/2019
 * Time: 12:55 PM
 */

namespace Laravel\Homestead\app\Model;


use Aws\S3\S3Client;
use Laravel\Homestead\app\Helpers\Log\Log;


class TestBusiness extends TestModel
{

    protected $s3instance;
    public $files;
    public $model;

    /**
     * @param S3Client $client
     * @return bool
     */
    public function setS3instance(S3Client $client) : bool{

        if(!$client instanceof S3Client ){

            new \Exception('Instance requires s3 class');
            return false;
        }

        $this->s3instance = $client;

        return true;

    }

    public function putFilesIntoFolder() : void{


        $this->files = $this->getAllFilesArray();

        foreach ($this->files as $queue){



            try {
                $result = $this->s3instance->putObject([
                    'Bucket' => $this->getFolderName(),
                    'Key'    => $queue, // this is for filename?  //
                    'Body'   => fopen($this->getFolderPath().$queue, 'r'),
                    'ACL'    => 'public-read', // private maybe ? //
                ]);


               Log::write('Uploaded file under : '.$this->getFolderName(). ' . Name : '.$queue .' success ... Url : '. $result['ObjectURL']);


            } catch (Aws\S3\Exception\S3Exception $e) {
                // write the log //
                Log::write('Exception :(. Code :'. $e->getCode(). ' Message: '. $e->getMessage());

            }

        }


    }

    /**
     * @param $files
     * @return bool|string
     */
    public function validateViaLogs($files){

        /*
         * Read the logs and validate the data
         * */
       $this->files = $files;
        foreach ($files as $file_names){

            $status = Log::searchLogRecord(Log::getLogs(date('Y-m-d')), $file_names);
            if(!$status){
                Log::write('Some files are missing');
                return 'Some files are missing';

            }

        }
        return true;

    }

    /**
     * @return bool
     */
    public function validateObjects(){

       foreach ($this->files as $files ){
        try {
            // Get the object.
            $result = $this->s3instance->getObject([
                'Bucket' => $this->getFolderName(),
                'Key'    => $files
            ]);

            // Display the object in the browser.
            Log::write('File '. $files . ' Validated via s3');
            return true;
        } catch (\Exception $e) {
           Log::write('Validation via s3 instance has a problem. Some files are missing' . $e->getMessage());
           return false;
        }
       }

    }





}