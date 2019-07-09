<?php
/**
 * Created by PhpStorm.
 * User: dc7
 * Date: 7/9/2019
 * Time: 1:38 PM
 */

namespace Laravel\Homestead\app\Helpers\SqlOperations;


use Laravel\Homestead\app\Config\Database;
use Laravel\Homestead\app\Helpers\PublicPath;

class TestSqlModel
{

    protected $folder;
    protected $sql_files;
    protected $united_file;


    /**
     * TestSqlModel constructor.
     * @param $folder
     */
    public function __construct($folder)
    {

        $this->folder = $folder;
        $this->sql_files = PublicPath::getStoragePath().$folder;
        $this->united_file = '/allfiles.sql';


    }

    /**
     * @return mixed
     */
    public function getFilesToArray(){

        $tmp = array_slice(scandir($this->sql_files), 2);

        foreach ($tmp as $files){

            $get_date = explode('_', $files);
            $get_date = explode('.',$get_date[1]);
            $dates[] = $get_date[0];

        }

        return $this->sortDates($dates);

    }

    /**
     * @param $dates
     * @return mixed
     */
    private function sortDates($dates){

        usort($dates,  function ($a, $b) {
            return strtotime($a) - strtotime($b);
        });
        return $dates;
    }

    /**
     * @return mixed
     */
    public function listBackupsToArray(){

        // lists related on date //
        return $this->getFilesToArray();

    }

    /**
     * @return array
     */
    public function getAllFiles() : array {

        foreach ($this->getFilesToArray() as $order){

            $result [] = array(

                $this->sql_files.'sql-backup_'.$order.'.sql'

            );

        }
        return $result;

    }

    /**
     * @param $file_list
     */
    public function mergeSqlFiles($file_list) : void{
         $num = count($file_list);
         $file_paths = '';
         for ($x=0; $x<$num; $x++){

             $file_paths .= $file_list[$x][0];
         }

        exec('cat /b '.$file_paths.' '.$this->sql_files.$this->united_file);
    }

    /**
     * @return string
     */
    public function  importIntoSQL(){

        $this->dsn = 'mysql:host=localhost;dbname=test';

        $t = new \PDO($this->dsn,'root','');

        $t->beginTransaction();

        try {

            $t->exec(file_get_contents($this->united_file));


        } catch(\Exception $e) {

            $t->rollBack();
            return 'Something went wrong'; // can be placed as an error codes //

        }

        $t->commit();

        return true;


    }





}