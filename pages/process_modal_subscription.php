<?php
include("../inc/config.php"); 
include("../inc/php_functions.php");

    if (isset($_POST["submit"])) {

        $errors = true;

        $payee = sanitize($_SESSION["business_id"]);
        $amountPaid = sanitize($_POST["amountPaid"]);
        $purposeCode = sanitize($_POST["purposeCode"]);
        $modeOfPayment = sanitize($_POST["modeOfPayment"]);
        $tellerNumber = sanitize($_POST["tellerNumber"]);
        $bankPaidTo = sanitize($_POST["bankPaidTo"]);
        $accountNumber = sanitize($_POST["accountNumber"]);
        $transactionDate = sanitize($_POST["transactionDate"]);
        $insertDate = date("Y-m-d");
        $approvalStatus = 'pending';

        if (isset($_POST["modeOfPayment"]) && $modeOfPayment != '') {

            switch ($_POST["modeOfPayment"]) {
                case 'bankTeller':
                    if ($amountPaid != '' && $tellerNumber != '' && $bankPaidTo != '' && $accountNumber != '' && $transactionDate != '') {
                        if (is_numeric($amountPaid) && (is_numeric($tellerNumber)) && (is_numeric($accountNumber))) {
                            $errors = false;
                        }else {
                            $errors = true;
                            $errorMessage = "Invalid Input";
                        }
                    }else {
                        $errors = true;
                        $errorMessage = "All Fields are Compulsory";
                    }
                break;
                case 'ATM':
                    $errors = false;
                break;
                case 'transfer':
                    if ($amountPaid != '' && $bankPaidTo != '' && $accountNumber != '' && $transactionDate != '') {
                        if (is_numeric($amountPaid) && (is_numeric($accountNumber))) {
                            $errors = false;
                        }else {
                            $errorMessage = "Invalid Input";
                        }
                    }else {
                        $errors = true;
                        $errorMessage = "All Fields are Compulsory";
                    }
                break;
            }

            if (!$errors) {

                switch ($purposeCode) {
                    case 'bronze':
                        if ($amountPaid < 200) {
                            $errors = true;
                            $errorMessage = "Invalid Amount";
                        }
                    break;
                    case 'silver':
                        if ($amountPaid < 5000) {
                            $errors = true;
                            $errorMessage = "Invalid Amount";
                        }
                    break;
                    case 'bronze':
                        if ($amountPaid < 23000) {
                            $errors = true;
                            $errorMessage = "Invalid Amount";
                        }
                    break;
                }

                if (!$errors) {

                    $stmt  = $conn->prepare("INSERT INTO `transactions_trn`(`id`, `payee`, `amountPaid`, `purposeCode`,
                                            `modeOfPayment`, `tellerNumber`, `bankPaidTo`, `accountNumber`, `transactionDate`,
                                            `insertDate`, `approvalStatus`) 
                                            VALUES (:id,:payee,:amountPaid,:purposeCode,:modeOfPayment,:tellerNumber,:bankPaidTo,
                                            :accountNumber,:transactionDate,:insertDate,:approvalStatus)");

                    $query = $stmt->execute(['id' => "", 'payee' => $payee, 'amountPaid' => $amountPaid, 'purposeCode' => $purposeCode, 
                                            'modeOfPayment' => $modeOfPayment, 'tellerNumber' => $tellerNumber, 'bankPaidTo' => $bankPaidTo, 'accountNumber' => $accountNumber,
                                            'transactionDate' => $transactionDate, 'insertDate' => $insertDate, 'approvalStatus' => $approvalStatus]);
    
                    if ($query) { 
                        echo "<div class='alert alert-success' role='alert'>Transaction Added Successfully, awaiting approval</div>"; 
                    }else {
                        echo "<div class='alert alert-danger' role='alert'>Operation Failed, try again</div>";
                    }

                }else {
                    echo "<div class='alert alert-danger' role='alert'>$errorMessage</div>";
                }
            
            }else {
                echo "<div class='alert alert-danger' role='alert'>$errorMessage</div>";
            }

        }else {
            echo "<div class='alert alert-danger' role='alert'>Please Select Mode of Payment</div>";
        }

            
    
    }

?>