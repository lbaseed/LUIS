<?php
ob_start(); include("../../inc/config.php"); include("../../inc/php_functions.php");   

    if (isset($_POST["action"])) {

        $id = sanitize($_POST["id"]);
        $today = date("Y-m-d H:i:s");
        $errors = false;
        
        if ($_POST["action"] == "approve") {

            $conn->beginTransaction();

            $stmt = $conn->prepare("SELECT * FROM transactions_trn WHERE id = :id ");
            $stmt->execute(['id' => $id]);
            
            $rows = $stmt->rowCount();
                                                        
            if($rows>0){
                    
                $days = 0;

                $row = $stmt->fetch();

                $tranID = $row->id;
                $payee = $row->payee;
                $amountPaid = $row->amountPaid; 
                $purposeCode = $row->purposeCode;

                    //Check whether licence exist and have not expired if so calculate new licence based on expiry date
                    $check = $conn->prepare("SELECT * FROM license_mst WHERE businessID = :payee ");
                    $check->execute(['payee' => $payee]);
                    
                    $rowsCheck = $check->rowCount();

                    if ($rowsCheck > 0) {

                        $rowCheck = $check->fetch();

                        $eDate = $rowCheck->expiryDate;

                        //Check validity for subscription
                        if (strtotime($eDate) >= strtotime($today)) {
                            //get prev sub balance
                            $today = $eDate;
                        }else {
                            $today = date("Y-m-d H:i:s");
                        }

                    }

                    //To Calculate expiry date for each subscription
                    switch ($purposeCode) {
                        case 'bronze':
                            $days = floor($amountPaid/200);
                            if($days<1){$errors = true;}
                            //Calculate Expiry day based on calculated days
                            $expiryDate = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($today)). " + $days day"));
                            $histExpDate =   date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", time()). " + $days day"));
                        break;
                        case 'silver':
                            $days = floor($amountPaid/5000);
                            if($days<1){$errors = true;}
                            //Calculate Expiry day based on calculated days
                            $expiryDate = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($today)). " + $days month"));
                            $histExpDate =   date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", time()). " + $days month"));
                        break;
                        case 'gold':
                            $days = floor($amountPaid/23000);
                            if($days<1){$errors = true;}
                            //Calculate Expiry day based on calculated days
                            $expiryDate = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($today)). " + $days month"));
                            $histExpDate =   date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", time()). " + $days month"));
                        break;
                    }

                    //Check, to see whether amount paid is less than for a day
                    if ($errors == false) {
                    
                        //Check whether licence exist so update instead of insert
                        if($rowsCheck > 0){

                            $stmt1 = $conn->prepare("UPDATE license_mst SET expiryDate = :expiryDate WHERE businessID = :payee ");
                            $query = $stmt1->execute(['expiryDate' => $expiryDate, 'payee' => $payee ]);

                        }else {

                            $stmt1 = $conn->prepare("INSERT INTO `license_mst`(`id`, `businessID`, `expiryDate`) VALUES (:id,:payee,:expiryDate)");
					        $query = $stmt1->execute(['id' => "", 'payee' => $payee, 'expiryDate' => $expiryDate ]);
				
                        }

                        $stmt2 = $conn->prepare("INSERT INTO `license_hst`(`id`, `bussinessID`, `transactionID`, `subscriptionDate`, `expiryDate`) VALUES (:id,:payee,:tranID,NOW(),:histExpDate)");
                        $query2 = $stmt2->execute(['id' => "", 'payee' => $payee, 'tranID' => $tranID, 'histExpDate' => $histExpDate ]); 

                        $stmt3 = $conn->prepare("UPDATE transactions_trn SET approvalStatus = 'aprroved', approvalDate = NOW() WHERE id = :id");
                        $query3 = $stmt3->execute(['id' => $id ]);

                        if ($query && $query2 && $query3) {
                            $conn->commit();
                            echo "ApprovalSuccess";
            
                        }else {
                            $conn->rollBack();
                            echo "ApprovalFailure";
            
                        }

                    }else {
                        echo "ApprovalFailure";
                    }

            }
            
                                    


            

        }else {
            
            $query = mysql_query("UPDATE transactions_trn SET approvalStatus = 'rejected', approvalDate = '$today' WHERE id = '$id'");

            if ($query) {

                echo "RejectionSuccess";

            }else {

                echo "RejectionFailure";

            }
        }


    }


?>