<?php

	require("../../inc/config.php");
	//instanciate connection class
	$Config = new Config;
	$conn = $Config->connect();

	$id = $_GET["cid"];

	$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_customers WHERE ID = :id ");
	$stmt->execute(['id' => $id]);

	$rows = $stmt->rowCount();
	
	$output = array();

	if ($rows>0){
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$output[] = $row;
		} 
		
		print(json_encode($output));
	}
	


?>