<?php
//BUG check real name of trans id in _borrow_trans

	require("../../inc/config.php");

	$tid = $_GET["tid"];
	$buss_id = $_SESSION["business_id"];

	$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = :tid ");
	$stmt->execute(['tid' => $tid]);

    $rows = $stmt->rowCount();

	//$q2 = mysql_query("SELECT * FROM ".$buss_id."_borrow_trans where tid='$tid' ");

	$output = array();

	if ($rows > 0){
		
		for($i=0; $i<$rows; $i++){
			
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			//$row = mysql_fetch_array($q);
			$output[] = $row;
			
			$output[$i]["ref"]= getName($output[$i]["item_id"])." [ Serial: ". getSerial($output[$i]["sales_id"]) ." ]";
			
		}

		$stmt2 = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_borrow_trans WHERE trans_id = :tid ");
		$stmt2->execute(['tid' => $tid]);
		
		while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
			
			$output[] = $row2;
			
			$mop = $output[0]["mop"];

			if ($mop == "0" ) {$mop_text = "Loan";}
			if ($mop == "0/1" ) {$mop_text = "Cash";}
			if ($mop == "0/1/2" ) {$mop_text = "Cash/POS";}
			if ($mop == "0/1/2/3" ) {$mop_text = "Cash/POS/Trnf";}

			if ($mop == "0/2" ) {$mop_text = "POS";}
			if ($mop == "0/2/3" ) {$mop_text = "POS/Trnf";}

			if ($mop == "01/3" ) {$mop_text = "Cash/Trnf";}
			if ($mop == "0/3" ) {$mop_text = "Trnf";}

			$output[0]["mop"] = $mop_text;

			//get customer information
			$cust_id = $row2["cid"];
			
			if ($cust_id != 0){

				$stmt3 = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_customers WHERE ID = :cust_id ");
				$stmt3->execute(['cust_id' => $cust_id]);
		
				while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
					$output[] = $row3;
				}
			
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