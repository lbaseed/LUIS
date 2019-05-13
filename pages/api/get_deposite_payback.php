<?php

		require("../../inc/config.php"); require("../../inc/php_functions.php");

	$tid = $_GET["id"];
	$buss_id = $_SESSION["business_id"];

		$q = mysql_query("SELECT * FROM ".$buss_id."_payment_details where id='$tid' ");

	

$output = array();

if (mysql_num_rows($q)>0){
	
	
		
		$row = mysql_fetch_array($q);
		$output[] = $row;

		$cust_id = $row["cust_id"];
		$remaining_bal = getCustomerBal($cust_id);
		array_push($output,$remaining_bal);
	}	
	
	
	print(json_encode($output));

	

?>