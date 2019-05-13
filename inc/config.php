<?php  session_start();
	
	error_reporting(0);

	$db_host = "localhost";
	$db_name = "uis";
	$db_user = "root";
	$db_pass = "";

	$conn = mysql_connect("$db_host", "$db_user", "$db_pass");

if($conn) {
	
	mysql_select_db("$db_name", $conn);
	
}
?>