<?php

		require("../../inc/config.php");

	$tid = $_GET["tid"];
	$buss_id = $_SESSION["business_id"];

		$q = mysql_query("SELECT * FROM ".$buss_id."_sales where trans_id='$tid' ");

	$q2 = mysql_query("SELECT * FROM ".$buss_id."_borrow_trans where tid='$tid' ");

$output = array();

if (mysql_num_rows($q)>0){
	
	for($i=0; $i<mysql_num_rows($q); $i++){
		
		$row = mysql_fetch_array($q);
		$output[] = $row;
		
		$output[$i]["ref"]= getName($output[$i]["item_id"])." [ Serial: ". getSerial($output[$i]["sales_id"]) ." ]";
		
	}

	
	
	while($row2 = mysql_fetch_array($q2)){
		
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
			
				$get_customer = mysql_query("select * from ".$buss_id."_customers where ID='$cust_id'");

				while($row3 = mysql_fetch_array($get_customer)){
					$output[] = $row3;
				}
			
			}
		
	}
	
	
	
	print(json_encode($output));
	
	
}
	
function getName($id){
	
	$q3 = mysql_query("select * from ".$_SESSION["business_id"]."_items where item_id='$id'");
	
		if(mysql_num_rows($q3)>0){
			$name = mysql_result($q3, 0, "name");
			return $name;
		}
}

function getSerial($salesID){
	
	$q4 = mysql_query("select * from ".$_SESSION["business_id"]."_items_serials where sales_id='$salesID'");
	
		if(mysql_num_rows($q4)>0){
			$serialNum = mysql_result($q4, 0, "serialNumber");
			return $serialNum;
		} else { return "";}
}


?>