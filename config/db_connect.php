<?php 
$hostname='127.0.0.1';
$db_username='root';
$db_password='';
$db_name='rental_db';

$con=mysqli_connect($hostname,$db_username,$db_password,$db_name);

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

date_default_timezone_set("Asia/Kolkata");
$local = array("::1", "127.0.0.1");
if ( in_array($_SERVER['REMOTE_ADDR'], $local) ) {
	$basePath = $_SERVER['DOCUMENT_ROOT']."/room/";
	$baseUrl =  'http://'.$_SERVER['SERVER_NAME'].'/Room/';
}else {
	$basePath = $_SERVER['DOCUMENT_ROOT']."/";
	$baseUrl =  'http://'.$_SERVER['SERVER_NAME'].'/';
}

?>