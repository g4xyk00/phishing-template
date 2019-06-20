<html>
<head></head>
<body>
<?php
$LOG_PATH = "8d777f385d3dfec8815d20f7496026dc.txt";
$DIRECT_ACCESS = FALSE;

date_default_timezone_set("Asia/Kuala_Lumpur");
$DATE_TIME = date('d-m-Y H:i:s');

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function writeToFile($LOG_PATH, $LOG_INFO){
	$LOG_FILE = fopen($LOG_PATH, 'a+');
	fwrite($LOG_FILE, $LOG_INFO);
	fclose($LOG_FILE);
}

$IP_ADDR = getUserIpAddr();
$HOST_NAME = gethostbyaddr($IP_ADDR);

if(isset($_GET["email"])){
	$EMAIL = $_GET["email"];
	$LOG_INFO = $EMAIL.' accessed at '.$DATE_TIME."\r\n";
	writeToFile($LOG_PATH, $LOG_INFO);
}else{
	if(isset($_GET["ia"])){
		$LOG_INFO = $_GET["ia"]."\r\n";
		writeToFile($LOG_PATH, $LOG_INFO);
	}else{
		$DIRECT_ACCESS = TRUE;
		writeToFile($LOG_PATH, $LOG_INFO);
	}
}

if(!isset($_GET["ia"])){
	if($DIRECT_ACCESS){
		$LOG_INFO = $IP_ADDR.' ('.$HOST_NAME.') accessed directly without parameter at '.$DATE_TIME."\r\n";
		writeToFile($LOG_PATH, $LOG_INFO);
		header("Location: https://www.google.com");
	}else{
		$LOG_INFO = $IP_ADDR.' ('.$HOST_NAME.') accessed at '.$DATE_TIME."\r\n";
		writeToFile($LOG_PATH, $LOG_INFO);
	}
}	
?>
</body>
</html>
