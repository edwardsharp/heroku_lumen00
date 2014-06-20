<?php
require('vendor/autoload.php');
 
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
 
// create a log channel to STDERR
$log = new Logger('name');
$log->pushHandler(new StreamHandler('php://stderr', Logger::WARNING));
 
// add records to the log
$log->addWarning("ZOMG THIS IS ADD LOGG");
 



    $url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    mysql_connect($server, $username, $password);


    mysql_select_db($db);


	if (!$db) {
	    echo "err?";
	    exit;
	}else{
		echo "ZOMG,YAY!";
		var_dump($db);
	}


?>