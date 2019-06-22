<?php
//CHECK IF NOW WORKED IN LINE 98
//CHECK LINE 137 if Balance worked
require("../../inc/config.php"); 
require("../../inc/php_functions.php");

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

			$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_borrow (`borrow_id`, `item_id`, `qty`, `cost_price`, `borrow_price`, `sub_total`, `trans_id`, `date`, `cashier`) VALUES (:id, :item_id, :item_qty, :cost_price, :item_price, :sub_total, :tid, :dt, :cur_user) ");
			$stmt->execute(['id' => "", 'item_id' => $item_id, 'item_qty' => $item_qty, 'cost_price' => $cost_price, 'item_price' => $item_price, 'sub_total' => $sub_total, 'tid' => $tid, 'dt' => $dt, 'cur_user' => $_SESSION["cur_user"] ]);
				
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

				$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_customers (`ID`, `full_name`, `address`, `phone`, `total_debt`, `total_credit`, `type`) VALUES (:id, :cust_name, :cust_address, :cust_phone, :bal, :total_credit, :type) ");
				$stmt->execute(['id' => "", 'cust_name' => $cust_name, 'cust_address' => $cust_address, 'cust_phone' => $cust_phone, 'bal' => $bal, 'total_credit' => 0, 'type' => $type ]);
				
				$cust_id = $conn->lastInsertId(); 
				
				//`id`, `date`, `tid`, `amount`, `cash`, `pos`, `transfer`, `balance`
				$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_borrow_trans (`tid`, `total_sales`, `date`, `mop`, `amount_tendered`, `change`, `balance`, `cid`, `cashier`, `timeStamp`) VALUES (:tid, :total, :dt, :mop, :am_tendered, :change, :bal, :cust_id, :cur_user, NOW()) ");
				$insert_trans = $stmt->execute(['tid' => $tid, 'total' => $total, 'dt' => $dt, 'mop' => $mop, 'am_tendered' => $am_tendered, 'change' => $change, 'bal' => $bal, 'cust_id' => $cust_id, 'cur_user' => $_SESSION["cur_user"] ]);
				
				//$insert_trans = mysql_query("insert into ".$business_id."_borrow_trans values('$tid','$total','$dt','$mop','$am_tendered','$change','$bal','$cust_id','".$_SESSION["cur_user"]."',NOW()) ");
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
		$bal=$total-$amount_tendered;

		$stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_trans SET amount_tendered = :amount_tendered, balance = balance-:amount_tendered, cashier = :cashier, timeStamp=NOW() WHERE trans_id = :trans_id ");
		$trans = $stmt->execute(['amount_tendered' => $amount_tendered, 'cashier' => $_SESSION["cur_user"], 'trans_id' => $trans_id]);
		
		//$trans = mysql_query("update ".$business_id."_trans set amount_tendered='$amount_tendered',balance=balance-'$amount_tendered',cashier='".$_SESSION["cur_user"]."',timeStamp=NOW(), where trans_id='$trans_id'");
		
		$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_daily_sales (`id`, `date`, `category_daily_total`, `category`) VALUES (:id,:date,:category_daily_total,:category) ");
		$upt_dailysales = $stmt->execute(['id' => "", 'date' => $t, 'category_daily_total' => $amount_tendered, 'category' => 1 ]);
				
		//$upt_dailysales=mysql_query("insert into ".$business_id."_daily_sales values('','$t','$amount_tendered','1')");
		
		$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_payment_analysis (`id`, `date`, `tid`, `amount`, `cash`, `pos`, `transfer`, `balance`, `status`) VALUES (:id,NOW(),:tid,:amount,:cash,:pos,:transfer,:balance,:status) ");
		$pymnt_anl = $stmt->execute(['id' => "", 'tid' => $trans_id, 'amount' => $amount_tendered, 'cash' => 1, 'pos' => 0, 'transfer' => 0 , 'balance' => $bal, 'status' => ""]);
				
		//$pymnt_anl=mysql_query("insert into ".$business_id."_payment_analysis values('',NOW(),'$trans_id','$amount_tendered','1','0','0','$bal')");
		
		//$bal=$total-$amount_tendered;
		$T=$business_id."_borrow_trans";   //transaction table name
		$C=$business_id."_customers"; // customer table name
		
		$stmt = $conn->prepare("UPDATE ".$T." JOIN ".$C." ON ".$T.".cid=".$C.".ID  SET mop='$status',cashier='".$_SESSION["cur_user"]."',timeStamp=NOW(),balance=0,total_debt=0 WHERE tid='$trans_id' ");
		$trans = $stmt->execute();
		
		//$trans =  mysql_query("UPDATE ".$T." INNER JOIN ".$C." ON ".$T.".cid=".$C.".ID SET ".$T.".amount_tendered='$amount_tendered',".$T.".balance=".$T.".balance-'$amount_tendered',".$T.".cashier='".$_SESSION["cur_user"]."',".$T.".timeStamp=NOW(), ".$C.".total_debt='$newDebt' where ".$T.".tid='$trans_id'");
		//$trans =  mysql_query("UPDATE ".$T." JOIN ".$C." ON ".$T.".cid=".$C.".ID  SET mop='$status',cashier='".$_SESSION["cur_user"]."',timeStamp=NOW(),balance=0,total_debt=0 where tid='$trans_id'");
		
    //$upt_dailysales=mysql_query("insert into ".$business_id."_daily_sales values('','$dt','$amount_tendered','1')");
		//$pymnt_anl=mysql_query("insert into ".$business_id."_payment_analysis values('',NOW(),'$trans_id','$amount_tendered','1','0','$0','$newDebt')");
		
		
	if($trans){echo $trans_id;}
		
}
	
	

function deductQty($item_id, $qty){
	global $conn;
	
	$business_id = $_SESSION["business_id"];

	$stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_items SET qty=qty - :qty WHERE item_id=:item_id ");
	$query = $stmt->execute(['qty' => $qty, 'item_id' => $item_id]);

	//$query = mysql_query("update ".$business_id."_items set qty=qty - $qty where item_id='$item_id'");
	
	if ($query) {return "done"; }
	//insert into query logs table
}

function getCostPrice($item_id){
	
	global $conn;
	$cost_price = 0;

	$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items WHERE item_id=:item_id ");
	$query = $stmt->execute(['item_id' => $item_id]);

	//$query = mysql_query("select * from ".$_SESSION["business_id"]."_items where item_id='$item_id'");
	
	$rows = $stmt->rowCount();

	if($rows>0){ 
		$row = $stmt->fetch();
		$cost_price = $row->cost_price;
	}
	
	return $cost_price;
}

?>