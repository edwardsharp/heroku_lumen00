<?php
require 'vendor/autoload.php';	
//require "Services/Twilio.php"
//require "Services/Twilio/Capability.php";
$accountSid = getenv("ASID");;
$authToken  = getenv("AUTHTOKEN");
$token = new Services_Twilio_Capability($accountSid, $authToken);
$token->allowClientOutgoing('APe50e37e24df1d6f7dbbc626f7ab9a722'); 
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>
			lumen00 call and record
		</title>
		<style type="text/javascript">
			input { width: 33%; font-size: 3em; }
		</style>
		<script type="text/javascript" src="//static.twilio.com/libs/twiliojs/1.1/twilio.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
		var connection=null;
		$(document).ready(function(){
			Twilio.Device.setup("<?php echo $token->generateToken();?>",{"debug":true});
			$("#call").click(function() {  
				$("#press5").show();
				Twilio.Device.connect();
			});
			$("#hangup").click(function() {  
  				connection.sendDigits("#");
			});

			$("#press5").click(function() {  
  				connection.sendDigits("5");
			});

			Twilio.Device.ready(function (device) {
				$('#status').text('');
			});

			Twilio.Device.offline(function (device) {
				$('#status').text('offline! #sorry');
			});

			Twilio.Device.error(function (error) {
				$('#status').text(error);
			});

			Twilio.Device.connect(function (conn) {
				connection=conn;
				$('#status').text("");
				$('#status').css('color', '#ff660');
				toggleCallStatus();
			});

			Twilio.Device.disconnect(function (conn) {
				$('#status').html('recording ended. <br/><a href="show_recordings.php">view recording list</a>');
				$('#status').css('color', 'black');
				$("#press5").hide();
				toggleCallStatus();
			});
			
			function toggleCallStatus(){
				$('#call').toggle();
				$('#hangup').toggle();
			}
		});
		</script>
	

	</head>
	<body>
		<div align="center">

			<input class="crazy-button" type="button" id="call" value="start recording"/>
			<input class="crazy-button" type="button" id="hangup" value="stop recording" style="display:none;"/>
			<input class="crazy-button" type="button" id="press5" value="press 5" style="display:none;"/>

			<div id="status">
				yo, it's offline rightnow :(
			</div>
		</div>

	</body>
</html>
