<?php
/**
 * Created by PhpStorm.
 * User: dc7
 * Date: 7/9/2019
 * Time: 9:07 AM
 */

namespace Laravel\Homestead\app\Model;


use Laravel\Homestead\app\Helpers\PublicPath;
use Laravel\Homestead\app\Model\Contractors\TestModelContractor;

class TestModel implements TestModelContractor
{

    private $folder_name = 'omerfolder';
    private $public_path;

   // presentation model //


    public function __construct($folder_name = ''){

             // initiate folder name with desired one //
             // validations for a folder later //

             $this->folder_name = $folder_name;
             $this->setPath();

    }


    /**
     * @return bool
     */
    public function isFolderSet() : bool{

        return $this->folder_name ? true : false;

    }

    /**
     * @return string of a folder name
     */
    public function getFolderName() : string{


        return $this->folder_name;

    }

    /**
     * @return string
     */
    public function getFolderPath() : string{

        return $this->public_path;

    }

    /**
     *   Go to trait to change desired path //
     */
    public function setPath() : void{

        $this->public_path = PublicPath::getPublicPath($this->folder_name);

    }

    /**
     * @return array list of a files
     */
    public function getAllFilesArray() : array{

        return array_slice(scandir($this->public_path), 2);

    }



}