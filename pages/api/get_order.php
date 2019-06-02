<?php
require("../../inc/config.php");

	$tid = $_GET["tid"];
	$buss_id = $_SESSION["business_id"];

	$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_order_details WHERE ref = :tid ");
	$stmt->execute(['tid' => $tid]);

    $rows = $stmt->rowCount();

	//$q2 = mysql_query("SELECT * FROM ".$buss_id."_placed_order where ref='$tid' ");

	$output = array();

	if ($rows>0){
		
		for($i=0; $i<$rows; $i++){
			
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$output[] = $row;
			
			$output[$i]["ref"]= getName($output[$i]["item_id"]);
			
		}

		$stmt2 = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_placed_order WHERE ref = :tid ");
		$stmt2->execute(['tid' => $tid]);

		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
			
			$output[] = $row2;

			//get customer information
			$cust_id = $row2["supplier"];

			$stmt3 = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_suppliers WHERE ID = :cust_id ");
			$stmt3->execute(['cust_id' => $cust_id]);

			while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
				$output[] = $row3;
			}
			
		}
		
		print(json_encode($output));
		
		
	}
		
	function getName($id){

		global $conn;

		$stmt4 = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items WHERE item_id = :id ");
		$stmt4->execute(['id' => $id]);

		$rows = $stmt4->rowCount();

		if ($rows>0){
			$row = $stmt4->fetch();

			$name = $row->name;
			return $name;
		}
		
	}

	function getSerial($salesID){

		global $conn;
	
		$stmt5 = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items_serials WHERE sales_id = :sales_id ");
		$stmt5->execute(['sales_id' => $salesID]);

		$rows = $stmt5->rowCount();
		
		if ($rows>0){
			$row = $stmt5->fetch();

			$serialNum = $row->serialNumber;
			return $serialNum;
		}else {
			return "";
		}
			
	}

?>