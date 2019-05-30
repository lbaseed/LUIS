<?php
//Study roll back and apply
ob_start(); 
include("../../inc/config.php"); 
include("../../inc/php_functions.php");   

//instanciate connection class
$Config = new Config;
$conn = $Config->connect();

    if (isset($_POST["action"])) {

        $transaction_id = $_POST["transaction_id"];
        $user = $_POST["user"];
        $today = date("Y-m-d");
        
        if ($_POST["action"] == "approve") {

            try {
                $conn->beginTransaction();

                $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_return SET approved_by = :user, approved_date = :today, status = 'approved' WHERE trans_id=:transaction_id ");
                $query = $stmt->execute(['user' => $user, 'today' => $today, 'transaction_id' => $transaction_id ]);

                if ($query) {

                    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = :transaction_id ");
                    $get_records = $stmt->execute(['transaction_id' => $transaction_id ]);
                    
                    if ($get_records) {
                        
                        $rows = $stmt->rowCount();

                        if($rows>0){

                            for($i=0; $i<$rows; $i++){

                                $row = $stmt->fetch();
                                
                                $item_id = $row->item_id; 
                                $quantity = $row->qty;

                                $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_items SET qty = qty + :quantity WHERE item_id = :item_id ");
                                $update = $stmt->execute(['quantity' => $quantity, 'item_id' => $item_id ]);

                                if (!$update) {
                                    throw new Exception();
                                }

                            }

                            $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_sales SET status = 'returned' WHERE trans_id = :transaction_id ");
                            $query1 = $stmt->execute(['transaction_id' => $transaction_id ]);
                
                            $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_trans SET status = 'returned', total_sales=0 WHERE tid = :transaction_id ");
                            $query2 = $stmt->execute(['transaction_id' => $transaction_id ]);
                
                            $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_payment_analysis SET status = 'returned' WHERE tid = :transaction_id ");
                            $query3 = $stmt->execute(['transaction_id' => $transaction_id ]);
                            
                            if ($query && $query1 && $query2 && $query3) {

                                echo "ApprovalSuccess";
                    
                            }else {
                                throw new Exception();
                            }

                        }else {
                            throw new Exception();
                        }
                        
                    }else {
                        throw new Exception();
                    }

                }else {
                    throw new Exception();
                }

                $conn->commit();

            } catch (Exception $e) {

                $conn->rollback();

                echo "ApprovalFailure";
            }

        }else {

            $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_return SET approved_by = :user, approved_date = '$today', status = 'rejected' WHERE trans_id = :transaction_id ");
            $query = $stmt->execute(['user' => $user, 'transaction_id' => $transaction_id ]);

            if ($query) {

                echo "RejectionSuccess";

            }else {

                echo "RejectionFailure";

            }
        }


    }


?>