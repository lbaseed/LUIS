<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   ?>
<div class="modal fade" id="modaldetails" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullModalLabel">Transaction Details</h4>
            </div>
            <div class="modal-body">

                    <?php
                        if (isset($_POST['transaction_id'])) {

                            $transaction_id = ($_POST['transaction_id']);

                            $query = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_payment_analysis WHERE tid = '$transaction_id' ");
                            $query1 = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = '$transaction_id' ");

                            if (mysql_num_rows($query)>0 && mysql_num_rows($query1)>0){

                                    $row = mysql_fetch_array($query);

                                    $trans_id = $row["tid"];
                                    $amount = $row["amount"];
                                    $cash_amount = $row["cash"];
                                    $pos_amount = $row["pos"];
                                    $transfer_amount = $row["transfer"];
                                    $balance = $row["balance"];
                    
                    
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
                                        <th>Item</th>
                                        <th>Selling Price</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                    </tr> 
                                    <tr>
                                        <?php

                                            if (isset($_POST['transaction_id'])) {

                                            $transaction_id = ($_POST['transaction_id']);
                                            $query2 = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = '$transaction_id' ");

                                            if (mysql_num_rows($query2)>0){

                                                while($row = mysql_fetch_array($query2)){

                                                    $item_id = $row["item_id"];
                                                    $item_name = getTableData("111_items", "item_id", "$item_id", "name");
                                                    $sold_price = $row["sold_price"];
                                                    $quantity = $row["qty"];
                                                    $date = $row["date"];
                                                    
                                                    echo "<tr><td>$item_name</td><td>$sold_price</td><td>$quantity</td><td>$date</td></tr>";
                                                }
                                    
                                            }
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-lg-6">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <td>Total Cash Sales: </td>
                                        <td><?php if(isset($cash_amount)){echo "NGN". number_format($cash_amount);}else{echo "NGN 0";} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total POS Sales: </td>
                                        <td><?php if(isset($pos_amount)){echo "NGN". number_format($pos_amount);}else{echo "NGN 0";} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Transfer Sales: </td>
                                        <td><?php if(isset($transfer_amount)){echo "NGN". number_format($transfer_amount);}else{echo "NGN 0";} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Debt: </td>
                                        <td><?php if(isset($balance)){echo "NGN". number_format($balance);}else{echo "NGN 0";} ?></td>
                                    </tr>
                                </table>
                            </div>

                            <?php

                                if (isset($_POST['transaction_id'])) {

                                    $transaction_id = ($_POST['transaction_id']);

                                    $query3 = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_return WHERE trans_id = '$transaction_id' ");

                                    if (mysql_num_rows($query3)>0){

                                        $row = mysql_fetch_array($query3);

                                        $reason = $row["reason"];
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