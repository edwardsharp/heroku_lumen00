<!DOCTYPE HTML>
<html>
	<head>
		<title>
			lumen00 -- LISTEN TO PHONE RECORDINGZ
		</title>
		<body>
			<h1>(646)666-7769</h1>
			<h1><a href="browser-record.php" title="WHY YOU BEEN CALLIN THIS NUMBER? WHAT DO YOU NEED?">MAKE A NEW RECORDING</a></h1>
		<?php
    
		require 'vendor/autoload.php';	    

    $ApiVersion = "2010-04-01";
    
		$accountSid = getenv("ASID");;
		$authToken  = getenv("AUTHTOKEN");


		$client = new Services_Twilio($accountSid, $authToken);

		$recordings = $client->account->recordings->getIterator(0, 200, array(   
		)); 

		echo "<h1>LISTEN UP (TO ZEE PHONE RECORDINGZ)</h1>";
		echo ("<table>");
		foreach ($recordings as $recording) { 
	  		echo "<tr style='margin-bottom:3em;'>";
	  		echo "<td>{$recording->date_created}</td>";
	  		echo "<td><audio src=\"https://api.twilio.com/2010-04-01/Accounts/$accountSid/Recordings/{$recording->sid}.mp3\" controls preload=\"auto\" autobuffer></audio></td>";
	  		echo "<td>{$recording->duration} seconds</td>";
	  		echo "</tr>";
		}
		echo ("<table>");
    ?>
	</body>
</html>
