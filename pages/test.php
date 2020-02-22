<?php
//Study roll back and apply
ob_start(); 
include("../inc/config.php"); 
include("../inc/php_functions.php");   

//echo date("Y-m-d H:i:s ", "1577964063");

//2days sub
	$subDate = "2020-01-06 10:52:39";
	$expDate = "2020-01-08 10:52:39";  

//2month sub
	$now = "2020-01-06 11:00:57";
	$expDateMonth = "2020-03-06 11:00:57";

//validity
	
	$str_daily_sub = strtotime($now);
	$str_daily_exp = strtotime($expDate);

	if($str_daily_exp >= $str_daily_sub){
		//prev sub has some validity;
		$prev_sub_validity = $str_daily_exp - $str_daily_sub;
		
		$str =  $prev_sub_validity + strtotime($expDateMonth);
	
		//echo date("Y-m-d H:i:s" ,$str);
	}

//echo date("Y-m-d H:i:s", strtotime($now));
$used = strtotime($expDateMonth) - strtotime($now);
echo $used;

//echo date("Y-m-d H:i:s", strtotime($used));


    if (isset($_POST["action"])) {

        $transaction_id = $_POST["transaction_id"];
        $user = $_POST["user"];
        $today = date("Y-m-d");
        
        if ($_POST["action"] == "approve") {

            $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_return SET approved_by = :user, approved_date = :today, status = 'approved' WHERE trans_id=:transaction_id ");
            $query = $stmt->execute(['user' => $user, 'today' => $today, 'transaction_id' => $transaction_id ]);

            //$query = mysql_query("UPDATE ".$_SESSION["business_id"]."_return SET approved_by = '$user', approved_date = '$today', status = 'approved' WHERE trans_id = '$transaction_id'");

            $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = :transaction_id ");
            $get_records = $stmt->execute(['transaction_id' => $transaction_id ]);

            //$get_records = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = '$transaction_id'");
            
            $rows = $stmt->rowCount();

            if($rows>0){

                for($i=0; $i<$rows; $i++){

                    $row = $stmt->fetch();
                    
                    $item_id = $row->item_id; 
                    $quantity = $row->qty;

                    $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_items SET qty = qty + :quantity WHERE item_id = :item_id ");
                    $stmt->execute(['quantity' => $quantity, 'item_id' => $item_id ]);

                    //mysql_query("UPDATE ".$_SESSION["business_id"]."_items SET qty = qty + '$quantity' WHERE item_id = '$item_id'");

                }
            }

            $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_sales SET status = 'returned' WHERE trans_id = :transaction_id ");
            $query1 = $stmt->execute(['transaction_id' => $transaction_id ]);

            $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_trans SET status = 'returned', total_sales=0 WHERE tid = :transaction_id ");
            $query2 = $stmt->execute(['transaction_id' => $transaction_id ]);

            $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_payment_analysis SET status = 'returned' WHERE tid = :transaction_id ");
            $query3 = $stmt->execute(['transaction_id' => $transaction_id ]);

            //$query1 = mysql_query("UPDATE ".$_SESSION["business_id"]."_sales SET status = 'returned' WHERE trans_id = '$transaction_id'");
            //$query2 = mysql_query("UPDATE ".$_SESSION["business_id"]."_trans SET status = 'returned', total_sales=0 WHERE tid = '$transaction_id'");
            //$query3 = mysql_query("UPDATE ".$_SESSION["business_id"]."_payment_analysis SET status = 'returned' WHERE tid = '$transaction_id'");
                                


        if ($query && $query1 && $query2 && $query3) {

            echo "ApprovalSuccess";

        }else {

            echo "ApprovalFailure";

        }

    }else {

        $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_return SET approved_by = :user, approved_date = '$today', status = 'rejected' WHERE trans_id = :transaction_id ");
        $query = $stmt->execute(['user' => $user, 'transaction_id' => $transaction_id ]);

        //$query = mysql_query("UPDATE ".$_SESSION["business_id"]."_return SET approved_by = '$user', approved_date = '$today', status = 'rejected' WHERE trans_id = '$transaction_id'");

        if ($query) {

            echo "RejectionSuccess";

        }else {

            echo "RejectionFailure";

        }
    }


    }


?>