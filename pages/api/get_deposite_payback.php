<?php

require("../../inc/config.php"); 
require("../../inc/php_functions.php");

	$tid = $_GET["id"];
	$buss_id = $_SESSION["business_id"];

	$tid = $_GET["tid"];
	$buss_id = $_SESSION["business_id"];

	$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_payment_details WHERE id = :tid ");
	$stmt->execute(['id' => $tid]);

    $rows = $stmt->rowCount();

	$output = array();

	if ($rows>0){

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$output[] = $row;

		$cust_id = $row["cust_id"];
		$remaining_bal = getCustomerBal($cust_id);
		array_push($output,$remaining_bal);

	}	
		
		
		print(json_encode($output));

	

?>