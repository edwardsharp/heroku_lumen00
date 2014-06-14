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
			.crazy-button {
				-moz-box-shadow:inset 0px 1px 0px 0px #fce2c1;
				-webkit-box-shadow:inset 0px 1px 0px 0px #fce2c1;
				box-shadow:inset 0px 1px 0px 0px #fce2c1;
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ff6600), color-stop(1, #ff6600) );
				background:-moz-linear-gradient( center top, #ff6600 5%, #ff6600 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff6600', endColorstr='#ff6600');
				background-color:#ff6600;
				-webkit-border-top-left-radius:10px;
				-moz-border-radius-topleft:10px;
				border-top-left-radius:10px;
				-webkit-border-top-right-radius:10px;
				-moz-border-radius-topright:10px;
				border-top-right-radius:10px;
				-webkit-border-bottom-right-radius:10px;
				-moz-border-radius-bottomright:10px;
				border-bottom-right-radius:10px;
				-webkit-border-bottom-left-radius:10px;
				-moz-border-radius-bottomleft:10px;
				border-bottom-left-radius:10px;
				text-indent:0px;
				border:1px solid #f59c03;
				display:inline-block;
				color:#ffffff;
				font-family:Arial;
				font-size:30px;
				font-weight:bold;
				font-style:normal;
				height:75px;
				line-height:75px;
				width:200px;
				text-decoration:none;
				text-align:center;
				text-shadow:1px 1px 0px #cc9f52;
			}
			.crazy-button:hover {
				background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #fb9e25), color-stop(1, #ffc477) );
				background:-moz-linear-gradient( center top, #fb9e25 5%, #ffc477 100% );
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fb9e25', endColorstr='#ffc477');
				background-color:#fb9e25;
			}.crazy-button:active {
				position:relative;
				top:1px;
			}
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
