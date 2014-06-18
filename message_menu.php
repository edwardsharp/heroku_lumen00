<?php

require 'vendor/autoload.php';	
// require "Services/Twilio.php";
include "messages.php";

if (strlen($_REQUEST['exten'])){
	$exten=$_REQUEST['exten'];
} else {
	$response = new Services_Twilio_Twiml();
	$response->say("Sorry! Failure is inevitable without an extension... ");
	die((string) $response);
}

if (strlen($_REQUEST['Digits'])){
	$digits = $_REQUEST['Digits'];
	if ($digits == 1 || $digits == 2) {
		$messages = getMessages($exten, $digits - 1);
		$location = "location: listen.php?exten=$exten&messages="
			. urlencode(implode(",",$messages));
		header($location);
		exit();
	} else {
		$error=true;
	}
}

$messages = getMessages($exten, 0);
$new_msgs = count($messages);

$response = new Services_Twilio_Twiml();

if($error)
	$response->say('Unable to process that extension');

$gather = $response->gather(array("numDigits" => "1"));
$gather->say("$new_msgs new");
$gather->say("To listen press 1.");
$gather->say("saved messages press 2.");
$response->say("ya'll come back now, ya hear?");
print $response;

?>
