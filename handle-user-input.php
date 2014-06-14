<?php
	header('Content-type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8"?>';

	echo '<Response>';

	$user_pushed = (int) $_REQUEST['Digits'];

	if ($user_pushed == 1)
	{
		echo '<Say>ZOMG I MUST SAY TWEET!</Say>';
	}
	else if ($user_pushed == 2)
	{
		echo "<Say>so so oh so Sorry! too sorry! two sorry!</Say>";
		echo '<Redirect>handle-incoming-call.php</Redirect>';
		
	}
	else if ($user_pushed == 3)
	{
		echo "<Say>Sorry! Sorry! Sorry!</Say>";
		echo '<Redirect>handle-incoming-call.php</Redirect>';
		
	}
	
	else {
		// We'll implement the rest of the functionality in the 
		// following sections.
		echo "<Say>Sorry, sorry, sorry, sorry, sorry, sorry, sorry!</Say>";
		echo '<Redirect>handle-incoming-call.php</Redirect>';
	}

	echo '</Response>';
?>
