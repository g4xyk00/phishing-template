<?php
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

date_default_timezone_set("Asia/Kuala_Lumpur");
$DATE_TIME = date('d-m-Y H:i:s');
$IP_ADDR = getUserIpAddr();
$HOST_NAME = gethostbyaddr($IP_ADDR);
$LOG_INFO = $IP_ADDR.' ('.$HOST_NAME.') accessed at '.$DATE_TIME."\r\n";
$LOG_PATH = "data.txt";
$LOG_FILE = fopen($LOG_PATH, 'a+');
fwrite($LOG_FILE, $LOG_INFO);
fclose($LOG_FILE);
header("Location: https://www.google.com");
?>
