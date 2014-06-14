<!DOCTYPE HTML>
<html>
	<head>
		<title>
			LISTEN UP (TO ZEE FILEZ)
		</title>
		<body>
			<h1>LISTEN UP (TO ZEE FILE RECORDINGZ)</h1>
		<?php
    // Include the PHP TwilioRest library 
	// include 'Services/Twilio.php';
		require 'vendor/autoload.php';	    
    // Twilio REST API version 
    $ApiVersion = "2010-04-01";
    
    // Set our AccountSid and AuthToken 
	$accountSid = 'AC828cb7e80f68cbb54b74e3ecb990bdf6';
	$authToken  = 'fff5edb02b98081f968436dc8db33434';

	// @start snippet
    // Instantiate a new Twilio Rest Client 
	$client = new Services_Twilio($accountSid, $authToken);

	$recordings = $client->account->recordings->getIterator(0, 50, array(   
	)); 


	echo ("<table>");
	foreach ($recordings as $recording) { 
  		echo "<tr><td>{$recording->duration} seconds</td> ";
  		echo "<td><audio src=\"https://api.twilio.com/2010-04-01/Accounts/$accountSid/Recordings/{$recording->sid}.mp3\" controls preload=\"auto\" autobuffer></audio></td>";
  		echo "<td>{$recording->date_created}</td>";
  		echo "<td>{$recording->sid}</td></tr>";
	}
	echo ("<table>");
	// @end snippet
    ?>
	</body>
</html>
