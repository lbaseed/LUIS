<?php  
ob_start(); 
include '../../inc/config.php';

    $order_id = $_GET["order"];
    $sup = $_GET["sup"];
    $bid = $_SESSION["business_id"];

   //get items in placed order list

    $stm = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_order_details WHERE ref= :order_id ");
    $stm->execute(['order_id' => $order_id]);

    $rows = $stm->rowCount();
	
    if($rows>0){

        $total = 0;

        for($i=0; $i<$rows; $i++){

		$row = $stm->fetch();

            $item_id = $row->item_id;
            $item_cost_price = $row->price;
            $item_qty = $row->qty;

            $total += ($item_cost_price * $item_qty);

            $stmt = $conn->prepare("UPDATE ".$bid."_items SET qty=qty + :item_qty, cost_price=:item_cost_price, date=NOW() WHERE item_id=:item_id ");
            $stmt->execute(['item_qty' => $item_qty, 'item_cost_price'=> $item_cost_price, 'item_id' => $item_id]);
           
            //loggin
            $stmt2 = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_st_items (`id`, `item`, `qty`, `date`, `user`, `timeStamp`) VALUES(:id,:item,:qty,NOW(),:user,NOW()) ");
            $loggin = $stmt2->execute(['id' => "", 'item' => $item_id , 'qty' => $item_qty , 'user' => $_SESSION["cur_user"] ]);

								
        }

        //update placed order table

        $stmt3 = $conn->prepare("UPDATE ".$bid."_placed_order SET dateSupplied=NOW(), valueSupplied = :total, status='SUPPLIED' WHERE ref=:order_id ");
        $q2 = $stmt3->execute(['total' => $total, 'order_id'=> $order_id ]);
		
			$stmt4 = $conn->prepare("UPDATE ".$bid."_suppliers SET total_credit=total_credit + :total WHERE ID = :sup_id ");
			$stmt4->execute(['total' => $total, 'sup_id'=> $sup]);
            
      
        if ($q2) {echo $order_id;} else { echo "failed"; }
   }




?>