<?php
ob_start(); 

include("../inc/config.php"); $_SESSION["business_id"] = 111;include("../inc/php_functions.php"); 


    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = :tid ");
	$stmt->execute(['tid' => $tid]);

    $rows = $stmt->rowCount();

	//$q2 = mysql_query("SELECT * FROM ".$buss_id."_borrow_trans where tid='$tid' ");

	$output = array();

	if ($rows > 0){
		
		for($i=0; $i<$rows; $i++){
			
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$row = mysql_fetch_array($q);
			$output[] = $row;
			
			$output[$i]["ref"]= getName($output[$i]["item_id"])." [ Serial: ". getSerial($output[$i]["sales_id"]) ." ]";
			
        }
    }

?>
