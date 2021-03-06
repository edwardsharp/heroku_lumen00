<?php



	$sql = "CREATE TABLE IF NOT EXISTS voicemailbox (
	vmb_extension varchar(8) primary key not null, 
	vmb_description varchar(32) not null, 
	vmb_last_checked datetime
	);
	CREATE TABLE IF NOT EXISTS messages (
		message_id int not null primary key auto_increment, 
		message_frn_vmb_extension varchar(8) not null, 
		message_date datetime not null, 
		message_from varchar(16),
		message_audio_url varchar(1024),
		message_flag int(1) default 0
	);";
   

//function for retrieving voicemail box by exten
function getMailbox($voicemail_exten) {
	global $db_name, $db_host,$db_user,$db_passwd;


	$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    mysql_connect($server, $username, $password);


    mysql_select_db($db);

    //make sure DB is ready... #TODO: make this more efficient. 
		mysql_query($sql);


	//make sure inputs are db safe
	$voicemail_exten = mysql_real_escape_string($voicemail_exten);


	// Performing SQL query
	$query = sprintf("select * from voicemailbox where vmb_extension='%s'",
		$voicemail_exten);

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	$mailbox = false;

	if ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$mailbox = array();
		$mailbox['exten'] = $line['vmb_extension'];
		$mailbox['desc'] = $line['vmb_description'];
		// $mailbox['passcode'] = $line['vmb_passcode'];
	}

	mysql_close();
	return $mailbox;
}

function addMessage($voicemail_exten, $caller_id, $recording_url) {
	global $db_name, $db_host,$db_user,$db_passwd;

	
	$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    mysql_connect($server, $username, $password);


    mysql_select_db($db);


	mysql_query($sql);

	//make sure inputs are db safe
	$voicemail_exten = mysql_real_escape_string($voicemail_exten);
	$caller_id = mysql_real_escape_string($caller_id);
	$recording_url = mysql_real_escape_string($recording_url);

	// Performing SQL query
	$query = sprintf("insert into messages (message_frn_vmb_extension,"
		. "message_date,message_from,message_audio_url,message_flag)"
		. " values ('%s',now(),'%s','%s',0)", $voicemail_exten, $caller_id,
		$recording_url);

	mysql_query($query) or die('Query failed: ' . mysql_error());

	$id = mysql_insert_id();
	mysql_close();
	return $id;
}

function updateMessageFlag($msg_id, $flag=0){
	global $db_name, $db_host,$db_user,$db_passwd;

	$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    mysql_connect($server, $username, $password);


    mysql_select_db($db);

	mysql_query($sql);

	//make sure inputs are db safe
	$msg_id = mysql_real_escape_string($msg_id);
	$flag = mysql_real_escape_string($flag);

	// Performing SQL query
	$query = sprintf("update messages set message_flag=%d where message_id=%d",
		$flag, $msg_id);

	mysql_query($query) or die('Query failed: ' . mysql_error());
	mysql_close();
}

function getMessages($voicemail_exten,$flag=0){
	global $db_name, $db_host,$db_user,$db_passwd;

	$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    mysql_connect($server, $username, $password);


    mysql_select_db($db);

	mysql_query($sql);

	//make sure inputs are db safe
	$voicemail_exten = mysql_real_escape_string($voicemail_exten);
	$flag = mysql_real_escape_string($flag);

	// Performing SQL query
	$query = sprintf("select * from messages where message_flag=%d and "
		. "message_frn_vmb_extension='%s' order by message_date", $flag,
		$voicemail_exten);

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	$messages = array();
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$messages[]=$line['message_id'];
	}

	mysql_close();

	return $messages;
}

function getMessage($msg_id){
	global $db_name, $db_host,$db_user,$db_passwd;

	$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    mysql_connect($server, $username, $password);


    mysql_select_db($db);

	mysql_query($sql);

	//make sure inputs are db safe
	$msg_id = mysql_real_escape_string($msg_id);

	// Performing SQL query
	$query = sprintf("select * from messages where message_id=%d",$msg_id);


	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	$message = array();
	if($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$message['id']=$line['message_id'];
		$message['date']=$line['message_date'];
		$message['from']=$line['message_from'];
		$message['url']=$line['message_audio_url'];
	}

	mysql_close();

	return $message;
}

?>
