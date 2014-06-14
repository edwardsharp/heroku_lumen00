<?php 
// this line loads the library 
require('Services/Twilio.php'); 
 
$account_sid = 'AC828cb7e80f68cbb54b74e3ecb990bdf6'; 
$auth_token = 'a070bfc127cddd747c0c90397c834710'; 
$client = new Services_Twilio($account_sid, $auth_token); 
 
$recordings = $client->account->recordings->getIterator(0, 50, array(   
)); 
 
foreach ($recordings as $recording) {
	echo " - - - - - - -"	 
	echo $recording->sid; 
}

 
$calls = $client->account->calls->getIterator(0, 50, array(      
)); 
 
foreach ($calls as $call) { 
	echo " # # # # # # # # "
	echo $call->sid; 
}

?>
