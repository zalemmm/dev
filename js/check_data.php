<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-config.php');

$a = DB_NAME;
$b = DB_USER;
$c = DB_PASSWORD;
$d = DB_HOST;
$connection = @mysql_connect($d, $b, $c) or die(); 
$db = @mysql_select_db($a, $connection) or die(); 

$login = $_POST['checklogin'];
if ($login) {
	$query = "SELECT * FROM `wp_fbs_users` WHERE login = '".$login."'";
	$result = MYSQL_QUERY($query) or die(mysql_error());
	$wszystkie = mysql_numrows($result);
	if ($wszystkie > 0) {
		echo 'istnieje';
	} else {
		echo 'nie istnieje';
	}

}

$email = $_POST['checkemail'];
if ($email) {
	$query = "SELECT * FROM `wp_fbs_users` WHERE email = '".$email."'";
	$result = MYSQL_QUERY($query) or die(mysql_error());
	$wszystkie = mysql_numrows($result);
	if ($wszystkie > 0) {
		echo 'istnieje';
	} else {
		echo 'nie istnieje';
	}

}


?>