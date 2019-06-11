<?php
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
			//deduct item quantity
			$deduct = deductQty($item_id, $item_qty);
			
			if ($deduct) 
			{
				
				//insert sales and serials record
				$cost_price = getCostPrice($item_id);

				$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_sales (sales_id,item_id,qty,cost_price,sold_price,sub_total,trans_id,date,cashier,status) VALUES (:sales_id, :item_id, :qty, :cost_price, :sold_price, :sub_total, :trans_id, :date, :cashier, :status) ");
				$stmt->execute(['sales_id' => "", 'item_id' => $item_id, 'qty' => $item_qty, 'cost_price' => $cost_price, 'sold_price' => $item_price, 'sub_total' => $sub_total, 'trans_id' => $tid, 'date' => $dt, 'cashier' => $_SESSION["cur_user"], 'status' => ""]);
				
				//$insert_sale = mysql_query("insert into ".$business_id."_sales values('','$item_id','$item_qty','$cost_price','$item_price','$sub_total','$tid','$dt','".$_SESSION["cur_user"]."','')");
				
				$sales_id = $conn->lastInsertId(); 
				
				if($item_serial !=""){

					$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_items_serials (`id`,`item`,`serialNumber`,`sales_id`,`timeStamp`) VALUES (:id,:item,:serialNumber,:sales_id,NOW() ) ");
					$stmt->execute(['id' => "", 'item' => $item_id, 'serialNumber' => $item_serial, 'sales_id' => $sales_id ]);
				
					//$insert_serails = mysql_query("insert into ".$business_id."_items_serials values('','$item_id','$item_serial','$sales_id',NOW()) ");
				}

				$total_qty += $item_qty;
				$total +=$sub_total;

				//store daily sales

				//check if record exist for a particular category

				$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_daily_sales WHERE  category = :item_category AND date = :dt ");
				$stmt->execute(['item_category' => $item_category, 'dt' => $dt]);

				$rows = $stmt->rowCount();

				//$check = mysql_query("select * from ".$business_id."_daily_sales where category='$item_category' and date='$dt' ");

				if($rows>0) {
					//record exist, increment daily total

					$row = $stmt->fetch();

					$daily_id = $row->id;

					$stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_daily_sales SET category_daily_total = category_daily_total + :sub_total WHERE id = :daily_id ");
					$stmt->execute(['sub_total' => $sub_total, 'daily_id' => $daily_id]);

					//$increment = mysql_query("update ".$business_id."_daily_sales set category_daily_total = category_daily_total + $sub_total where id='$daily_id'");
				}
				else{

					//insert daily category sales
					
					$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_daily_sales (id,date,category_daily_total,category) VALUES (:id,:date,:category_daily_total,:category) ");
					$stmt->execute(['id' => "",'date' => $dt,'category_daily_total' => $sub_total,'category' => $item_category]);
				
					//$insert_daily_sales = mysql_query("insert into ".$business_id."_daily_sales values ('','$dt','$sub_total','$item_category') ");

				}
			}
			
			
		}
		
		//insert transaction record
		$arr_size = count($obj);
		$srch_index = $arr_size-1;
		
		$mop = $obj[$srch_index]["mop"];
		$cash_mop = $obj[$srch_index]["cash_mop"];
		$pos_mop = $obj[$srch_index]["pos_mop"];
		$trnf_mop = $obj[$srch_index]["trnf_mop"];

		//check 4 split payment and change mop
		
		$am_tendered = $obj[$srch_index]["amount_tendered"];
		
		$change = $am_tendered - $total;
		
		$cust_name = strtoupper($obj[$srch_index]["cust_name"]);
		
		//check for balance
		if ($total > $am_tendered) { $bal = $total - $am_tendered; } else {$bal =0; }
		
		if (empty($cust_name)) {$cust_id = 0;} 
		else
		{
			$cu_id = $obj[$srch_index]["cust_id"];
			
			if (empty($cu_id)){
				
				$cust_address = strtoupper($obj[$srch_index]["cust_address"]);
				$cust_phone = $obj[$srch_index]["cust_phone"];

				//check for regular and non regular customers
				if ($bal>0) {$type = 1; } else {$type = 0; }

				$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_customers (ID,full_name,address,phone,total_debt,total_credit,type) VALUES (:id, :cust_name, :cust_address, :cust_phone, :bal, :total_credit, :type) ");
				$stmt->execute(['id' => "", 'cust_name' => $cust_name, 'cust_address' => $cust_address, 'cust_phone' => $cust_phone, 'bal' => $bal, 'total_credit' => 0, 'type' => $type ]);
				
				//$add_customer = mysql_query("insert into ".$business_id."_customers values('','$cust_name','$cust_address','$cust_phone','$bal','0','$type') ");
				$cust_id = $conn->lastInsertId();
				
			} else {
				
				$cust_id = $cu_id;

				//add to customers debts records
				$stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_customers SET total_debt=total_debt + :bal WHERE ID=:cust_id ");
				$add_debt = $stmt->execute(['bal' => $bal, 'cust_id' => $cust_id]);
				
				//$add_debt = mysql_query("update ".$business_id."_customers set total_debt=total_debt + $bal where ID='$cust_id'");
			}
			
		}

		$today = date("Y-m-d");
		$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_trans (`tid`, `total_sales`, `date`, `mop`, `amount_tendered`, `change`, `balance`, `cid`, `cashier`, `timeStamp`, `status`) VALUES (:tid, :total_sales, :date, :mop, :amount_tendered, :change, :balance, :cid, :cashier, NOW(), :status) ");
		$insert_trans = $stmt->execute(['tid' => $tid, 'total_sales' => $total, 'date' => $dt, 'mop' => $mop, 'amount_tendered' => $am_tendered, 'change' => $change, 'balance' => $bal, 'cid' => $cust_id, 'cashier' => $_SESSION["cur_user"], 'status' => "" ]);
		
		//$insert_trans = mysql_query("insert into ".$business_id."_trans values('$tid','$total','$dt','$mop','$am_tendered','$change','$bal','$cust_id','".$_SESSION["cur_user"]."',NOW(),'')");
		
		$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_payment_analysis (id,date,tid,amount,cash,pos,transfer,balance,status) VALUES (:id,:date,:tid,:amount,:cash,:pos,:transfer,:balance,:status) ");
		$insert_payment_analysis = $stmt->execute(['id' => "", 'date' => $today, 'tid' => $tid, 'amount' => $total, 'cash' => $cash_mop, 'pos' => $pos_mop, 'transfer' => $trnf_mop, 'balance' => $bal, 'status' => ""]);
				
		//$insert_payment_analysis = mysql_query("insert into ".$business_id."_payment_analysis values('','$today','$tid','$total','$cash_mop','$pos_mop','$trnf_mop','$bal','') ");
		
		//loggin
		$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_st_sales WHERE date= :dt ");
		$stmt->execute(['dt' => $dt]);

		$rows = $stmt->rowCount();

		//$check_loggin = mysql_query("select * from ".$business_id."_st_sales where date='$dt'");

		if ($rows > 0){

			$row = $stmt->fetch();

			$id = $row->id;

			$stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_st_sales SET amount = amount + :total, qty = qty + :total_qty WHERE id = :id ");
			$trans = $stmt->execute(['total' => $total, 'total_qty' => $total_qty, 'id' => $id]);
		
			//$loggin_update = mysql_query("update ".$business_id."_st_sales set amount=amount + '$total', qty=qty + '$total_qty' where id='$id'");
			
		}else {

			$stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_st_sales (`id`,`amount`,`qty`,`date`,`timeStamp`) VALUES (:id,:amount,:qty,:date,NOW()) ");
			$loggin = $stmt->execute(['id' => "", 'amount' => $total, 'qty' => $total_qty, 'date' => $dt ]);
			
			//$loggin = mysql_query("insert into ".$business_id."_st_sales values('','$total','$total_qty','$dt',NOW())");
		}
		
		
		if ($insert_trans) {echo $tid;}
		
}
	

function deductQty($item_id, $qty){

	global $conn;
	
	$business_id = $_SESSION["business_id"];

	$stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_items SET qty=qty - :qty WHERE item_id=:item_id ");
	$query = $stmt->execute(['qty' => $qty, 'item_id' => $item_id]);

	if ($query) {return "done"; }

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