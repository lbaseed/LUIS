<?php
ob_start(); include("../../inc/config.php"); include("../../inc/php_functions.php");   

    if (isset($_POST["action"])) {

        $transaction_id = $_POST["transaction_id"];
        $user = $_POST["user"];
        $today = date("Y-m-d");
        
        if ($_POST["action"] == "approve") {
            
            $query = mysql_query("UPDATE ".$_SESSION["business_id"]."_return SET approved_by = '$user', approved_date = '$today', status = 'approved' WHERE trans_id = '$transaction_id'");

            $get_records = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = '$transaction_id'");
                                        
                if(mysql_num_rows($get_records)>0){

                    for($i=0; $i<mysql_num_rows($get_records); $i++){

                        $row = mysql_fetch_array($get_records);
                        
                        $item_id = $row["item_id"]; 
                        $quantity = $row["qty"];

                        mysql_query("UPDATE ".$_SESSION["business_id"]."_items SET qty = qty + '$quantity' WHERE item_id = '$item_id'");

                    }
                }
            
                $query1 = mysql_query("UPDATE ".$_SESSION["business_id"]."_sales SET status = 'returned' WHERE trans_id = '$transaction_id'");
                $query2 = mysql_query("UPDATE ".$_SESSION["business_id"]."_trans SET status = 'returned', total_sales=0 WHERE tid = '$transaction_id'");
                $query3 = mysql_query("UPDATE ".$_SESSION["business_id"]."_payment_analysis SET status = 'returned' WHERE tid = '$transaction_id'");
                                    


            if ($query && $query1 && $query2 && $query3) {

                echo "ApprovalSuccess";

            }else {

                echo "ApprovalFailure";

            }

        }else {
            
            $query = mysql_query("UPDATE ".$_SESSION["business_id"]."_return SET approved_by = '$user', approved_date = '$today', status = 'rejected' WHERE trans_id = '$transaction_id'");

            if ($query) {

                echo "RejectionSuccess";

            }else {

                echo "RejectionFailure";

            }
        }


    }


?>