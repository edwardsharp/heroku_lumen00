<?php 
// this line loads the library 
require('/path/to/twilio-php/Services/Twilio.php'); 
 
$account_sid = 'AC828cb7e80f68cbb54b74e3ecb990bdf6'; 
$auth_token = '[AuthToken]'; 
$client = new Services_Twilio($account_sid, $auth_token); 
 
$recordings = $client->account->recordings->getIterator(0, 50, array(   
)); 
 
foreach ($recordings as $recording) { 
	echo $recording->sid; 
}
?>
