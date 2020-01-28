<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   ?>
<div class="modal fade" id="modaldetails" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullModalLabel">Transaction Details</h4>
            </div>
            <div class="modal-body">

                    <?php
                        if (isset($_POST['id'])) {

                            $id = ($_POST['id']);

                            $stmt = $conn->prepare("SELECT * FROM transactions_trn WHERE id = :id ");
                            $stmt->execute(['id' => $id]);

                            $rows = $stmt->rowCount();
                                        
                            if($rows>0){

                                $row = $stmt->fetch();

                                $id = $row->id; 
                                $payee = $row->payee; 
                                $amountPaid = $row->amountPaid;
                                $purposeCode = $row->purposeCode;
                                $modeOfPayment = $row->modeOfPayment;
                                $tellerNumber = $row->tellerNumber;
                                $bankPaidTo = $row->bankPaidTo;
                                $accountNumber = $row->accountNumber;
                                $transactionDate = $row->transactionDate;
                                $businessName = getTableData('businesses', "business_id", "$payee", "business_name");
                    
                    
                            }else {
                                echo "<div class='alert alert-danger' role='alert'> Invalid Transaction ID </div>";
                            }

                        }
                    ?>

                    <div class="card">
                       
                        <div class="header">
                            <h2>
                              Transaction Details
                                <small></small>
                            </h2>
                        </div>
                        <div class="body">
                        
                        <div class="row">

                            <div class="col-lg-6">
                                <table class="table table-striped table-hover">

                                    <tr>
                                        <td>Business ID: </td>
                                        <td><?php if(isset($payee)){echo $payee;} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Business Name: </td>
                                        <td><?php if(isset($businessName)){echo $businessName;} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Amount Paid: </td>
                                        <td><?php if(isset($amountPaid)){echo "NGN". number_format($amountPaid);} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Purpose: </td>
                                        <td><?php if(isset($purposeCode)){echo $purposeCode; } ?></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-lg-6">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <td>Mode of Payment: </td>
                                        <td><?php if(isset($modeOfPayment)){echo $modeOfPayment;} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Teller Number: </td>
                                        <td><?php if(isset($tellerNumber)){echo $tellerNumber;} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Bank Paid To: </td>
                                        <td><?php if(isset($bankPaidTo)){echo $bankPaidTo;} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Account Number: </td>
                                        <td><?php if(isset($accountNumber)){echo $accountNumber;} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Transaction Date: </td>
                                        <td><?php if(isset($transactionDate)){echo $transactionDate;} ?></td>
                                    </tr>
                                </table>
                            </div>

                            <?php

                                if (isset($_POST['transaction_id'])) {

                                    $transaction_id = ($_POST['transaction_id']);

                                    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_return WHERE trans_id = :transaction_id ");
                                    $stmt->execute(['transaction_id' => $transaction_id]);

                                    $rows = $stmt->rowCount();
                                                        
                                    if($rows>0){

                                        $row = $stmt->fetch();
                                        
                                        $reason = $row->reason;
                                    }
                                            

                                }
                            ?>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" readonly class="form-control" value="<?php if(isset($reason)){echo ($reason);}?>">
                                    </div>
                                    </div>
                                </div>
                            </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" id="modal_full_close" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>