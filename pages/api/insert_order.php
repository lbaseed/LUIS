<?php require("../../inc/config.php"); require("../../inc/php_functions.php");

$business_id = $_SESSION["business_id"];

	if(isset($_POST['myData'])){
		
 		$obj = json_decode( json_encode($_POST['myData']), true);
 
		$tid = time();
		$dt = date("Y-m-d");
		$total = 0;
		$total_qty = 0;
		
		for($i=0; $i<count($obj)-1; $i++){
			
			$item_id = $obj[$i]['item_id'];
			$item_price = $obj[$i]['item_price'];
			$item_qty = $obj[$i]['item_qty'];
			$item_serial = $obj[$i]['item_serial'];
			
			$sub_total = $item_price * $item_qty;
			$total += $sub_total;
				//insert order
				
				$insert_sale = mysql_query("insert into ".$business_id."_order_details values('','$item_id','$item_qty','$item_price','$sub_total','$tid','$dt')");
			
			
		}
		
		//insert transaction record
		$arr_size = count($obj);
		$srch_index = $arr_size-1;
	
		$cust_name = strtoupper($obj[$srch_index]["supp_name"]);
		
		
		if (empty($cust_name)) {$cust_id = 0;} 
		else
		{
			$cu_id = $obj[$srch_index]["supp_id"];
			
			
				
				$cust_id = $cu_id;
				//add to customers debts records
				$add_debt = mysql_query("update ".$business_id."_suppliers set total_credit=total_credit + $total where ID='$cust_id'");
			
			
		}
		
																						//`id`, `date`, `tid`, `amount`, `cash`, `pos`, `transfer`, `balance`
		$insert_trans = mysql_query("insert into ".$business_id."_placed_order values('$tid','$cust_id','$total','$dt','','','NOT_SUPPLIED') ");
		
		
		if ($insert_trans) {echo $tid;}
		
}
	

function deductQty($item_id, $qty){
	
	$business_id = $_SESSION["business_id"];
	$query = mysql_query("update ".$business_id."_items set qty=qty - $qty where item_id='$item_id'");
	
	if ($query) {return "done"; }
	//insert into query logs table
}

function getCostPrice($item_id){
	
	$cost_price = 0;
	$query = mysql_query("select * from ".$_SESSION["business_id"]."_items where item_id='$item_id'");
		
	if(mysql_num_rows($query)>0){ $cost_price = mysql_result($query, 0, "cost_price");}
	
	return $cost_price;
}

?>