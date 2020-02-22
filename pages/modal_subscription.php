<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   ?>

<div class="modal fade" id="modaldetails" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullModalLabel">Transaction Details</h4>
            </div>
            <div class="modal-body">

                <?php
                    if (isset($_POST['type'])) {

                        $type = ($_POST['type']);

                        switch ($type) {
                            case 'bronze':
                                $type = "Bronze";
                                $price = "200";
                                $validity = "1 Day";
                            break;
                            case 'silver':
                                $type = "Silver";
                                $price = "5000";
                                $validity = "1 Month";
                            break;
                            case 'gold':
                                $type = "Gold";
                                $price = "23000";
                                $validity = "1 Month";
                            break;
                            
                        }
                    }
                ?>

                    <div class="card">
                       
                        <div class="header">
                            <h2>
                              Subscription
                                <small></small>
                            </h2>
                        </div>
                        <div class="body">
                        <div class="place"></div>
                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            Payment Details
                                        </h2>
                                        
                                    </div>
                                    <div class="body">
                                    
                                        
                                        <form action="process_modal_subscription.php" method="post" class="ajaxx">

                                            <div class="row clearfix">
                                                    <div class="col-sm-12">
                                                        <select class="form-control show-tick" name="modeOfPayment">
                                                            <option value="">-- Mode of Payment --</option>
                                                            <option value="bankTeller">Bank Teller</option>
                                                            <option value="ATM">ATM Card</option>
                                                            <option value="transfer">Transfer</option>
                                                            
                                                        </select>
                                                    </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" placeholder="Enter Amount Paid" name="amountPaid" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" placeholder="Enter Bank Paid Into" name="bankPaidTo" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" placeholder="Enter Account Number Paid Into" name="accountNumber" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" placeholder="Enter Teller Number" name="tellerNumber"  autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="date" class="form-control" placeholder="Enter Transaction Date" name="transactionDate" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="purposeCode" value="<?php echo $_POST['type']; ?>">                                            
                                            <input class="btn btn-block bg-green"  type="submit" name="submit">
                                    </form>
                                        
                                    </div>
                                </div>
                    
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <td>Plan Name: </td>
                                        <td><b><?php echo $type; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Price: </td>
                                        <td><b><?php echo "NGN ". number_format("$price"); ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Validity: </td>
                                        <td><b><?php echo $validity; ?></b></td>
                                    </tr>
                                </table>
                            </div>
                        </row>
                    </div>
                    <div class="place"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" id="modal_full_close" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<script>
//$(document).ready(function(){
    $('form.ajaxx').on('submit', function(){
        var that = $(this),
            url = that.attr('action'),
            type = that.attr('method'),
            data = {};

        that.find('[name]').each(function(index, value){
            var that = $(this),
                name = that.attr('name'),
                value = that.val();

            data[name] = value;

            //console.log(value);
            //console.log(data);
        });

        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(response){
                $('.place').html(response);
            },
            error: function(){
                alert("an unkwnon error occur");
            }
        });

        //Put or otherwise the form will submit in its normal fashion
        return false;

        });
    
//});
</script>
