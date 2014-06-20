<?php
require('../vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$dump = print_r($_REQUEST, true);

$log = new Logger('appdebug');
$log->pushHandler(new StreamHandler('php://stderr', Logger::WARNING));
$log->addWarning("_REQUEST ".$dump);


$from = $_REQUEST['From'];
$body = $_REQUEST['Body'];
$message = '';

if( isset($_GET['vardump']) ) {
  var_dump($_REQUEST);
}

function getURL($url){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $ret = curl_exec($ch);
  curl_close($ch);
  if( isset($_GET['vardump']) ) {
        var_dump($ret);
  }
  return $ret;
}

function getRandomRow(){
    //okay, i guess this is not really CSV, but newline'd...
    $data = preg_split("/\\r\\n|\\r|\\n/",getURL('https://docs.google.com/a/edwardsharp.net/spreadsheets/d/1KuyXu3OiXuKD7hScO_gJlx5cS_74oMPvGrwwawm62ck/export?gid=0&format=csv'));

    $c = count($data);
    $r1 = rand(0, $c-1);
    $rand = $data[$r1];

    if( isset($_GET['vardump']) ) {
        echo "count: $c";
        echo "random $r1: $rand";
        var_dump($data);
    }

    return $rand;
}

function getHelpMsg(){
   return "HELLO! SEND: R TO RECEIVE NEW MICRONEMEZ";
}


if (strcasecmp($body, 'r') == 0) {
    $message = getRandomRow();
}else {
    $message = getHelpMsg();
}

// now greet the sender
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Message><?php echo $message; ?></Message>
</Response>

