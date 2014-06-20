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
  return $ret;
}

	//okay, i guess this is not really CSV, but newline'd...
	$data = preg_split("/(\r\n|\n|\r)/",str_getcsv(getURL('https://docs.google.com/a/edwardsharp.net/spreadsheets/d/1KuyXu3OiXuKD7hScO_gJlx5cS_74oMPvGrwwawm62ck/export?gid=0&format=csv')));

	$c = count($data);
	$r1 = rand(0, $c);
	$rand = $data[$r1];

	echo "count: $c";
	echo "random $r1: $rand";
	
if( isset($_GET['vardump']) ) {
	var_dump($data);
}
	


?>
