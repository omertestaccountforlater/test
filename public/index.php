
<?php
require('../vendor/autoload.php');

$b = new \Laravel\Homestead\app\Model\TestBusiness('omerfolder');

//$b->setS3instance(new Aws\S3\S3Client([
//            'version' => 'latest',
//            'region' => 'us-west-2'
//        ]));
//$b->putFilesIntoFolder();

//var_dump($b->validateViaLogs($b->getAllFilesArray()));
//
//// or /
//
//$b->validateObjects();

//$c = new \Laravel\Homestead\app\Helpers\SqlOperations\TestSqlModel('sqlbackups');

//var_dump($c->getAllFiles());
//var_dump($c->mergeSqlFiles($c->getAllFiles()))  ;

$a = new \Laravel\Homestead\app\Model\TestCSV\TestCSVParser();
//var_dump($a->getCSV());

$t = new ParseCsv\Csv($a->getCSV());
var_dump($t->data);




//$db = new \Laravel\Homestead\app\Config\Database();
//
//$db->beginTransaction();
//try{
//
//$db->query('INSERT INTO `vehicleorders` '.$t->data.' VALUES ('.$t->data.')');
//$db->execute();
//}
//catch (Exception $e){
// $db->rollback();
//}
//$db->endTransaction();





?>

<h1>Welcome </h1>

<h3>A si tu</h3>