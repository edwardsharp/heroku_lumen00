<?php
require 'vendor/autoload.php';	
// require "Services/Twilio.php";
include "messages.php";

if (strlen($_REQUEST['exten'])) {
	$exten = $_REQUEST['exten'];
	$mailbox = getMailbox($exten);

	//output TwiML to record the message
	$response = new Services_Twilio_Twiml();
	$response->say('will record ' . $mailbox['desc']);
	$response->record(
		array(
			'action' => "handle_message.php?exten=$exten",
			'maxLength' => '120')
	);

	// record will post to this url if it receives a message
	// otherwise it falls through to the next verb
	$response->gather()
		->say("Sorry, failure seems eminent. Press any key to try again");

	print $response;
}

?>
