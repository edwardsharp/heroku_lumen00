<?php
 //  require('../vendor/autoload.php');
 
 // 	use Google\Spreadsheet\DefaultServiceRequest;
	// use Google\Spreadsheet\ServiceRequestFactory;

	// $serviceRequest = new DefaultServiceRequest($accessToken);
	// ServiceRequestFactory::setInstance($serviceRequest);

  
 //    header("content-type: text/xml");
		
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

	
	echo getRandomRow();
		


?>
