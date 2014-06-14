<?php // @start snippet
require 'vendor/autoload.php';	
//require "Services/Twilio.php"
//require "Services/Twilio/Capability.php";
$accountSid = 'AC828cb7e80f68cbb54b74e3ecb990bdf6';
$authToken  = 'fff5edb02b98081f968436dc8db33434';
$token = new Services_Twilio_Capability($accountSid, $authToken);
$token->allowClientOutgoing('APe50e37e24df1d6f7dbbc626f7ab9a722'); // @end snippet
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>
			lumen00 call and record
		</title>
		<!-- @start snippet -->
		<script type="text/javascript" src="//static.twilio.com/libs/twiliojs/1.1/twilio.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
		var connection=null;
		$(document).ready(function(){
			Twilio.Device.setup("<?php echo $token->generateToken();?>",{"debug":true});
			$("#call").click(function() {  
				Twilio.Device.connect();
			});
			$("#hangup").click(function() {  
  				connection.sendDigits("#");
			});

			Twilio.Device.ready(function (device) {
				$('#status').text('system is ready, yo!');
			});

			Twilio.Device.offline(function (device) {
				$('#status').text('offline! #sorry');
			});

			Twilio.Device.error(function (error) {
				$('#status').text(error);
			});

			Twilio.Device.connect(function (conn) {
				connection=conn;
				$('#status').text("it is live, yo!");
				$('#status').css('color', '#ff660');
				toggleCallStatus();
			});

			Twilio.Device.disconnect(function (conn) {
				$('#status').html('recording ended!<br/><a href="show_recordings.php">view recording list</a>');
				$('#status').css('color', 'black');
				toggleCallStatus();
			});
			
			function toggleCallStatus(){
				$('#call').toggle();
				$('#hangup').toggle();
			}
		});
		</script>
		<!-- @end snippet -->

	</head>
	<body>
		<div align="center">
		<!-- @start snippet -->
			<h3>Create a Recording</h3>
			<input type="button" id="call" value="start recording"/>
			<input type="button" id="hangup" value="stop recording" style="display:none;"/>
			<div id="status">
				yo, it's offline rightnow.
			</div>
		<!-- @end snippet -->
		</div>

	</body>
</html>
