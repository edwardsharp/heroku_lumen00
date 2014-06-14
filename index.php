<?php
require('vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel to STDERR
$log = new Logger('name');
$log->pushHandler(new StreamHandler('php://stderr', Logger::WARNING));

// add records to the log
$log->addWarning("ZOMG THIS IS ADD LOGG");

// don't forget to greet the world!
//echo "Hello World!";



# This function reads your DATABASE_URL configuration automatically set by Heroku
# the return value is a string that will work with pg_connect
function pg_connection_string() {
	return "dbname=df0g26t452pud4 host=ec2-54-225-101-202.compute-1.amazonaws.com port=5432 user=xoxyxywvhpenav password=RvrEMtAH5IbjJR9iKIdqUIk1T- sslmode=require";
//Connection URL:
  //  postgres://xoxyxywvhpenav:RvrEMtAH5IbjJR9iKIdqUIk1T-@ec2-54-225-101-202.compute-1.amazonaws.com:5432/df0g26t452pud4

}

 
# Establish db connection
$db = pg_connect(pg_connection_string());
if (!$db) {
    echo "Database connection error.";
    exit;
}else{
	echo "ZOMG,YAY!";
}
 
//$result = pg_query($db, "SELECT stuff");
?>
