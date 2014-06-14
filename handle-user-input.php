<?php
	header('Content-type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8"?>';

	echo '<Response>';

	$user_pushed = (int) $_REQUEST['Digits'];

	if ($user_pushed == 1)
	{
		echo '<Say>ZOMG I MUST SAY!</Say>';
		echo '<Play>http://lumen00.herokuapp.com/s/1.mp3</Play>';
	}
	else if ($user_pushed == 2)
	{
		echo "<Say>Two oh too.</Say>";
		echo '<Play>http://lumen00.herokuapp.com/s/2.mp3</Play>';
		echo '<Redirect>handle-incoming-call.php</Redirect>';
		
	}
	else if ($user_pushed == 3)
	{
		echo "<Say>lol! lolol! zomg!</Say>";
		echo '<Play>http://lumen00.herokuapp.com/s/3.mp3</Play>';
		echo '<Redirect>handle-incoming-call.php</Redirect>';
		
	}
	else if ($user_pushed == 4)
	{
		echo "<Say>On all fours.</Say>";
		echo '<Play>http://lumen00.herokuapp.com/s/4.mp3</Play>';
		echo '<Redirect>handle-incoming-call.php</Redirect>';
		
	}
	else if ($user_pushed == 5)
	{
		echo "<Say>We're spying on you. :)</Say>";
		echo "<Say>Record your expierence after the beep.</Say>";
    echo '<Record maxLength="99" action="handle-recording.php" />';
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
