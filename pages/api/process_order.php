<?php  
ob_start(); 
include '../../inc/config.php';

//instanciate connection class
$Config = new Config;
$conn = $Config->connect();

    $order_id = $_POST["order"];
    $bid = $_SESSION["business_id"];

   //get items in placed order list

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_order_details WHERE ref= :order_id ");
    $stmt->execute(['order_id' => $order_id]);

    //$q1 = mysql_query("select * from ".$bid."_order_details where ref='$order_id' ");
    $rows = $stmt->rowCount();

    if($rows>0){

        $total = 0;

        while($row = $stmt->fetch()){

            $item_id = $row->item_id;
            $item_cost_price = $row->price;
            $item_qty = $row->qty;

            $total += ($item_cost_price * $item_qty);

            $stmt = $conn->prepare("UPDATE ".$bid."_items SET qty=qty + :item_qty, cost_price=:item_cost_price, date=NOW() WHERE item_id=:item_id ");
            $stmt->execute(['item_qty' => $item_qty, 'item_cost_price'=> $item_cost_price, 'item_id' => $item_id]);
            
            //insert to stock
            //$query = mysql_query("update ".$bid."_items set qty=qty + '$item_qty', cost_price='$item_cost_price', date=NOW() where item_id='$item_id' ");					
            
            //loggin
            $stmt  = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_st_items (id,item,qty,date,user,timeStamp) VALUES(:id,:item,:qty,:date,:user,NOW()) ");
            $loggin = $stmt->execute(['id' => "", 'item' => $item_id , 'qty' => $item_qty, 'date' => $date , 'user' => $_SESSION["cur_user"] ]);

			//$loggin = mysql_query("insert into ".$bid."_st_items values('','$item_id','$item_qty','$date','".$_SESSION["cur_user"]."',NOW())");
									
        }

        //update placed order table

        $stmt = $conn->prepare("UPDATE ".$bid."_placed_order SET dateSupplied=NOW(), valueSupplied = :total, status='SUPPLIED' WHERE ref=:order_id ");
        $q2 = $stmt->execute(['total' => $total, 'order_id'=> $order_id ]);
            
        //$q2 = mysql_query("update ".$bid."_placed_order set dateSupplied=NOW(), valueSupplied='$total', status='SUPPLIED' where ref='$order_id' ");

        if ($q2) {echo $order_id;} else { echo "failed"; }
   }

    

?>