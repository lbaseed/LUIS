<?php

require("../../inc/config.php");

	$type = $_GET["type"];
	$id = $_GET["id"];

	if ($type=="one"){

		$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items WHERE item_id = :id ");
		$stmt->execute(['id' => $id]);

    	$rows = $stmt->rowCount();
		
		$output = array();

		if ($rows>0){
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$output[] = $row;
			} 
			
			print(json_encode($output));
		}
		
	}elseif($type=="single"){

		//get single item of a record

		$tbl = $_SESSION["business_id"]."_".$_GET["tbl"];
		$id = $_GET["id"];
		$rec = $_GET["rec"];

		$stmt = $conn->prepare("SELECT * FROM ".$tbl." WHERE id = :id ");
		$stmt->execute(['id' => $id]);

    	$rows = $stmt->rowCount();

		if ($rows>0){

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$record = $row->$rec;
			
			echo $record;
		}
		
	}else{
		
		$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items WHERE status = 1 ORDER BY `name` ASC ");
		$stmt->execute();

		$rows = $stmt->rowCount();

		$output = array();

		if ($rows>0){
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$output[] = $row;
			} 
			
			print(json_encode($output));
		}
		
	}

?>