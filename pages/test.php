<?php
ob_start(); 

include("../inc/config.php"); $_SESSION["business_id"] = 111;include("../inc/php_functions.php"); 
    $business_id = 111;	
	$name = "Demo Account";
	$username = $business_id;
	$password = "admin";
	$user_lvl = 9;
	$img = $business_id.".jpg";
	$status = 1;
    $last_login = date("Y-m-d H:i:s");
    $address = "demo location";
    $phone = "080x xxx xxxx";


    $query2 = $conn->query("INSERT INTO ".$business_id."_company_profile (id, name, address, phone1, phone2, email, website, logo, date) VALUES ('','$name','$address','$phone','$phone','','','$img','') ");

?>
