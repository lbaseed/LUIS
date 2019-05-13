<?php  ob_start(); include '../../inc/config.php';

    $order_id = $_POST["order"];
    $bid = $_SESSION["business_id"];

   //get items in placed order list

   $q1 = mysql_query("select * from ".$bid."_order_details where ref='$order_id' ");

   if(mysql_num_rows($q1)>0){
    $total = 0;
        while($row1 = mysql_fetch_array($q1)){

            $item_id = $row1["item_id"];
            $item_cost_price = $row1["price"];
            $item_qty = $row1["qty"];

            $total += ($item_cost_price * $item_qty);
            //insert to stock
            $query = mysql_query("update ".$bid."_items set qty=qty + '$item_qty', cost_price='$item_cost_price', date=NOW() where item_id='$item_id' ");					
			//loggin
			$loggin = mysql_query("insert into ".$bid."_st_items values('','$item_id','$item_qty','$date','".$_SESSION["cur_user"]."',NOW())");
									
        }

        //update placed order table

        $q2 = mysql_query("update ".$bid."_placed_order set dateSupplied=NOW(), valueSupplied='$total', status='SUPPLIED' where ref='$order_id' ");

        if ($q2) {echo $order_id;} else { echo "failed"; }
   }

    

?>