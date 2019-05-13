<?php

		require("../../inc/config.php"); require("../../inc/php_functions.php");

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
			$item_category = getTableData($business_id."_items", "item_id", $item_id, "cat_id");
		
			

			
				
				//insert borrow
				$cost_price = getCostPrice($item_id);
				
				$insert_borrow = mysql_query("insert into ".$business_id."_borrow values('','$item_id','$item_qty','$cost_price','$item_price','$sub_total','$tid','$dt','".$_SESSION["cur_user"]."')");
				
		
				//$sales_id = mysql_insert_id();
				
				if($item_serial !=""){
				//$insert_serails = mysql_query("insert into ".$business_id."_items_serials values('','$item_id','$item_serial','$sales_id',NOW()) ");
				}
				$total_qty += $item_qty;
				$total +=$sub_total;

				//store daily sales

				//check if record exist for a particular category
			/*	$check = mysql_query("select * from ".$business_id."_daily_sales where category='$item_category' and date='$dt' ");
				if(mysql_num_rows($check)>0) {
					//record exist, increment daily total

					//$daily_id = mysql_result($check, 0, "id");
					//$increment = mysql_query("update ".$business_id."_daily_sales set category_daily_total = category_daily_total + $sub_total where id='$daily_id'");
				}
				else{

					//insert daily category sales
				    //$insert_daily_sales = mysql_query("insert into ".$business_id."_daily_sales values ('','$dt','$sub_total','$item_category') ");

				}*/
			
			
			
		}
		
		//insert transaction record
		$arr_size = count($obj);
		$srch_index = $arr_size-1;
		
		$mop ="borrow";
		$cash_mop = $obj[$srch_index]["cash_mop"];
		$pos_mop = $obj[$srch_index]["pos_mop"];
		$trnf_mop = $obj[$srch_index]["trnf_mop"];

		//check 4 split payment and change mop
		
		$am_tendered = 0;
		
		$change = 0;
	
		$cust_name = strtoupper($obj[$srch_index]["cust_name"]);
		
		//check for balance 
		$bal = $total;
		
			$cu_id = $obj[$srch_index]["cust_id"];
			
				
				$cust_address = strtoupper($obj[$srch_index]["cust_address"]);
				$cust_phone = $obj[$srch_index]["cust_phone"];

				//type 2 denotes borrower
				$type = 2;
				
				$add_customer = mysql_query("insert into ".$business_id."_customers values('','$cust_name','$cust_address','$cust_phone','$bal','0','$type') ");
				$cust_id = mysql_insert_id();
				
			
			
		
		
																						//`id`, `date`, `tid`, `amount`, `cash`, `pos`, `transfer`, `balance`
		$insert_trans = mysql_query("insert into ".$business_id."_borrow_trans values('$tid','$total','$dt','$mop','$am_tendered','$change','$bal','$cust_id','".$_SESSION["cur_user"]."',NOW()) ");
    /*    
        //$insert_payment_analysis = mysql_query("insert into ".$business_id."_payment_analysis values('',NOW(),'$tid','$total','$cash_mop','$pos_mop','$trnf_mop','$bal') ");
		
		
        //loggin
        /*
		$check_loggin = mysql_query("select * from ".$business_id."_st_sales where date='$dt'");
		if (mysql_num_rows($check_loggin)>0){
			$id = mysql_result($check_loggin, 0, "id");
			$loggin_update = mysql_query("update ".$business_id."_st_sales set amount=amount + '$total', qty=qty + '$total_qty' where id='$id'");
		}else {
			$loggin = mysql_query("insert into ".$business_id."_st_sales values('','$total','$total_qty','$dt',NOW())");
        }
        */
		
		
	if ($insert_trans){echo $tid;}
		
}




	if(isset($_POST['Data'])){
		
 $obj = json_decode( json_encode($_POST['Data']), true);
		$cust_id=$obj[0];
		$trans_id=$obj[1];
		$status=$obj[2];
		
		//$newDebt=$obj[2];
		//$amount_tendered=$obj[3];
		$dt = date("Y-m-d");
<<<<<<< HEAD
		$bal=$total-$amount_tendered;
		
		$trans = mysql_query("update ".$business_id."_trans set amount_tendered='$amount_tendered',balance=balance-'$amount_tendered',cashier='".$_SESSION["cur_user"]."',timeStamp=NOW(), where trans_id='$trans_id'");
    $upt_dailysales=mysql_query("insert into ".$business_id."_daily_sales values('','$t','$amount_tendered','1')");
		$pymnt_anl=mysql_query("insert into ".$business_id."_payment_analysis values('',NOW(),'$trans_id','$amount_tendered','1','0','0','$bal')");
=======
		//$bal=$total-$amount_tendered;
		$T=$business_id."_borrow_trans";   //transaction table name
		$C=$business_id."_customers"; // customer table name
		
		//$trans =  mysql_query("UPDATE ".$T." INNER JOIN ".$C." ON ".$T.".cid=".$C.".ID SET ".$T.".amount_tendered='$amount_tendered',".$T.".balance=".$T.".balance-'$amount_tendered',".$T.".cashier='".$_SESSION["cur_user"]."',".$T.".timeStamp=NOW(), ".$C.".total_debt='$newDebt' where ".$T.".tid='$trans_id'");
<<<<<<< HEAD
		$trans =  mysql_query("UPDATE ".$T." JOIN ".$C." ON ".$T.".cid=".$C.".ID  SET mop='$status',cashier='".$_SESSION["cur_user"]."',timeStamp=NOW(),balance=0,total_debt=0 where tid='$trans_id'");
=======
		$trans =  mysql_query("UPDATE ".$T."  SET mop='sold',cashier='".$_SESSION["cur_user"]."',timeStamp=NOW() where tid='$trans_id'");
>>>>>>> mylocal
>>>>>>> master
		
    //$upt_dailysales=mysql_query("insert into ".$business_id."_daily_sales values('','$dt','$amount_tendered','1')");
		//$pymnt_anl=mysql_query("insert into ".$business_id."_payment_analysis values('',NOW(),'$trans_id','$amount_tendered','1','0','$0','$newDebt')");
		
		
		
	if($trans){echo $trans_id;}
		
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