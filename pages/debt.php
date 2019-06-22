<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(5);
if($_SESSION["clearance"]==6) {header("Location: index.php");}
?>
<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-Debts page") ?>

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    
    <!--data tables-->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    
    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>
</head>

<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <?php search_bar();?>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <?php top_bar(); ?>
    
    <!-- #Top Bar -->
    <?php navigation_left();?>
   

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
               
            </div>
            <!-- Input -->
            
            <div class="row clearfix">
              
						<div class="col-lg-6 col-md-6 col-sm-4 col-xs-4">
                    <div class="card">
                       
                        <div class="header">
                            <h2>
                              Customer Debts History
                                <small>Customer Information</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                        
                        <?php
							
							if (isset($_POST["submit"])){
                                
                                //update customer information
									$cust_id = sanitize(strtoupper($_POST["cust_id"]));
									$cust_name = sanitize(strtoupper($_POST["fullname"]));
									$cust_address = sanitize(strtoupper($_POST["address"]));
									$cust_phone = sanitize(strtoupper($_POST["pnum"]));
									
									
									$user = $_SESSION["cur_user"];
									$date = date("Y-m-d");
									
									
								if ($cust_id and $cust_name and $cust_address and $cust_phone){
                                    
                                    $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_customers SET full_name= :cust_name, address = :cust_address, phone = :cust_phone WHERE ID = :cust_id ");
                                    $query = $stmt->execute(['cust_name' => $cust_name, 'cust_address' => $cust_address, 'cust_phone' => $cust_phone, 'cust_id' => $cust_id]);

									if ($query) { echo "<div class='alert alert-success' role='alert'>Item Updated Successfully</div>"; }
									else { echo "<div class='alert alert-danger' role='alert'>Operation Failed, try again</div>";}
								} else { echo "<div class='alert alert-danger' role='alert'>Fill all * fields</div>";}
							}
							
							{
								//display selected customer's infomration
								$get_customer_id = $_GET["customer"];
                            
                                $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_customers where ID = :get_customer_id ");
                                $stmt->execute(['get_customer_id' => $get_customer_id]);

                                $rows = $stmt->rowCount();

                                if ($rows>0){

                                    $row = $stmt->fetch();
                                        
                                    $fetched_id = $row->ID; 
                                    $fetch_customer_name = $row->full_name;
                                    
                                    $fetch_phone = $row->phone; 
                                    $fetch_address = $row->address;
                                    $fetch_debt = $row->total_debt; 
                                            
                                    }
							}
						?>
                        	<form action="" method="post">

							<input type="hidden" name="cust_id" value="<?php echo $get_customer_id; ?>" />
								
								<div class="row clearfix">
									   <div class="col-sm-12">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="fullname" class="form-control" value="<?php echo $fetch_customer_name?>" required autofocus placeholder="Full Name *" />
											</div>
										  </div>
									   </div>
									  
								   </div>
								   
								   <div class="row clearfix">
									   <div class="col-sm-12">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="address" class="form-control" value="<?php echo $fetch_address; ?>" required placeholder="Address *" />
											</div> 
										  </div>
									   </div>
									  
								   </div>
								   <div class="row clearfix">
									   <div class="col-sm-12">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="pnum" class="form-control" value="<?php echo $fetch_phone; ?>" required placeholder="Phone Number*" />
											</div>
										  </div>
									   </div>
									  
								   </div>
								   
						  
								<div class="icon-and-text-button-demo">
									<button class="btn bg-green waves-effect" type="submit" name="submit" value="go">
										<i class="material-icons">save</i> 
									</button>
								</div>
								
						</form>
                        	
                        </div>
                       
                    </div>
                    
                </div>
				
                
                
                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-4">
                	
                	<div class="card">
                       
                        <div class="header">
                            <h2>
                              Customer Debts Payments
                                <small>Debt payments</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" onClick="debtPlatform();" id="addPayment">Add Payment</a></li>
                                       
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                        	
                        	<?php 
						
								if(isset($_POST["post_payment"])){
									
									$customer = sanitize($_GET["customer"]);
									
                                    $amount_cash = sanitize($_POST["amount_paid_cash"]);
                                    $amount_pos = sanitize($_POST["amount_paid_pos"]);
                                    $amount_trnf = sanitize($_POST["amount_paid_trnf"]);

                                    $total_payment = $amount_cash + $amount_pos + $amount_trnf;

                                    $bal = getCustomerBal($customer) + $total_payment;
                                    $today = date("Y-m-d");

                                    if ($bal>=0){
                                      $payment_type = "deposite";
                                    } else {$payment_type = "payback";}
									
									if ($total_payment){
										
                                    //insert payment information

                                    $stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_payment_details (`id`, `cust_id`, `amount`, `cash`, `pos`, `transfer`, `payment_type`, `date`) VALUES (:id, :cust_id, :amount, :cash, :pos, :transfer, :payment_type, :date) ");
					                $insert_payment = $stmt->execute(['id' => "", 'cust_id' => $customer, 'amount' => $total_payment, 'cash' => $amount_cash, 'pos' => $amount_pos, 'transfer' => $amount_trnf, 'payment_type' => $payment_type, 'date' => $today ]);
                                    
                                    $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."customers SET total_credit= total_credit + :total_payment where ID= :customer");
					                $q = $stmt->execute(['total_payment' => $total_payment, 'customer' => $customer ]);

										if ($q) { message("x","green","Payment Accepted");}
										
										else {message("x","red","Operation Failed"); }	
										
									} else { message("x","red","Fill all Fields"); }
									
								}
									
									
							?>
                       
                       	<table class="table table-striped">
                       		<thead>
                       			<tr>
                       				<th> Item : </th> <th> Content </th>
                       			</tr>
                       		</thead>
                       		<tbody>
                      				
                       				<?php
                                        $customer_curr = $_GET["customer"];
                                        
                                        $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_customers WHERE  ID= :customer_curr ");
                                        $stmt->execute(['customer_curr' => $customer_curr]);

                                        $rows = $stmt->rowCount();

                                        if ($rows>0){
                                            
                                           // $get_rec = mysql_query("select * from ".$_SESSION["business_id"]."_customers where ID='$customer_curr' ");
                                            
                                            //if (mysql_num_rows($get_rec)>0){
                                            $row = $stmt->fetch();
                                            $t_debt = $row->total_debt;
                                            $t_credit = $row->total_credit;
                                            $rem_credit = $t_credit - $t_debt;
                                            
                                            echo "<tr> <td>Total Debt</td> <td> ". number_format($t_debt)." </td> </tr>";
                                            echo "<tr> <td>Total Credit</td> <td> ". number_format($t_credit)."  </td> </tr>";
                                            
                                            $credit_msg = "Remaining Credit in Account: ";
                                            $debit_msg = "Final Balance Payable by Customer";
                                            
                                            if ($rem_credit > 0){ echo "<tr> <td>$credit_msg </td> <td> ". number_format($rem_credit)."  </td> </tr>"; }
                                            else {echo "<tr> <td>$debit_msg </td> <td> ". number_format($rem_credit)." </td> </tr>";}
                                                
                                        }
								?>
                       		</tbody>
                       	</table>
                        
						</div>
               	
					</div>
                	
                
				</div>
                
                
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="card">
                    	 <div class="header">
                            <h2>
                               All Payments and Deposites by <?php echo get_customer($_GET["customer"])." [".$_GET["customer"]."]"; ?>
                                <small>List of Transactions</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                      
                        <div class="body table-responsive">
                                        
                                        
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SN</th><th>Ref</th><th>Amount</th> <th>Channel [Cash]</th><th>Channel [POS]</th> <th>Channel [Transfer]</th> <th>Payment Type</th> <th>Date</th><th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                        
                                                $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_payment_details WHERE cust_id = :get_customer_id ORDER BY `date` DESC ");
                                                $stmt->execute(['get_customer_id' => $get_customer_id]);
                                            
                                                $rows = $stmt->rowCount();

                                                if ($rows>0){
                                                    $sn=1;
                                                    $total_payment_sum = 0;
                                                    $total_cash_sum = 0;
                                                    $total_pos_sum = 0;
                                                    $total_transfer_sum = 0;

                                                    for($i=0; $i<$rows; $i++){

                                                        $row = $stmt->fetch();

                                                        $fetched_id = $row->id; 
                                                        $trans_date = $row->date; 
                                                        $total_amount = $row->amount;
                                                        $cash = $row->cash; 
                                                        $pos = $row->pos; 
                                                        $transfer = $row->transfer;

                                                        //sum payments
                                                        $total_payment_sum += $total_amount;
                                                        $total_cash_sum += $cash;
                                                        $total_pos_sum += $pos;
                                                        $total_transfer_sum += $transfer;

                                                        $payment_type_fetch = strtoupper($row->payment_type);
                                                        
                                                    echo "<tr><td>$sn</td> <td>$fetched_id</td> <td>". number_format($total_amount) ."</td> <td>". number_format($cash)."</td><td>". number_format($pos)."</td> <td>". number_format($transfer)."</td> <td>$payment_type_fetch</td>
                                                     <td>$trans_date</td>
                                                    <td>
                                                        <button type='button' class='btn bg-default waves-effect' onClick='getDepositePaybackTrans(".$fetched_id.")'> 
                                                                        <i class='material-icons'>assignment</i>
                                                                        </button>
                                                    </td>
                                                    </tr>";
                                                    $sn++;
                                                }
                                            
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                      <?php echo "  <th>SN</th><th>Ref</th><th>". number_format($total_payment_sum)."</th> <th>". number_format($total_cash_sum)."</th><th>". number_format($total_pos_sum)."</th> <th>". number_format($total_transfer_sum)."</th> <th>Payment Type</th> <th>Date</th><th> </th> " ; ?>
                                        </tr>    
                                    </tfoot>
                                </table>
                                
                        </div>
                    	
                    </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="card">
                    	 <div class="header">
                            <h2>
                               All Transactions by Customer
                                <small>List of Transactions</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                      
                        <div class="body table-responsive">
                                        
                                        
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SN</th><th>Ref</th><th>Total Sales</th><th>Amount Paid</th> <th>Balance</th><th>Channel</th> <th>Date</th><th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php

                                                $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_trans WHERE cid = :get_customer_id ORDER BY `balance` DESC ");
                                                $stmt->execute(['get_customer_id' => $get_customer_id]);

                                                $rows = $stmt->rowCount();
                                        
                                                if ($rows>0){
                                                        $sn=1;
                                                        
                                                        for($i=0; $i<$rows; $i++){
                                                            $row = $stmt->fetch();
                                                                
                                                            $fetched_id = $row->tid; 
                                                            $total_sale = $row->total_sales;
                                                            
                                                            $trans_date = $row->date; 
                                                            $mop = $row->mop;
                                                            $amount_tendered = $row->amount_tendered; 
                                                            $change = $row->change;  
                                                            $bal = $row->balance;
                                                            
                                                            //converting Means of Payment
                                                            switch($mop){
                                                                case "0": $mopText = "Loan";	break;
                                                                case "0/1": $mopText = "Cash";  break;
                                                                case "0/1/2": $mopText = "Cash/POS"; break;
                                                                case "0/1/2/3": $mopText = "Cash/POS/Trnf"; break;

                                                                case "0/2": $mopText = "POS"; break;
                                                                case "0/2/3": $mopText = "POS/Trnf"; break;

                                                                case "01/3": $mopText = "Cash/Trnf"; break;
                                                                case "0/3": $mopText = "Trnf"; break;
                                                            }

                                                    
                                                            
                                                            echo "<tr><td>$sn</td> <td>$fetched_id</td> <td>". number_format($total_sale) ."</td> <td>". number_format($amount_tendered)."</td> <td>". number_format($bal)."</td> <td>$mopText</td> <td>$trans_date</td>
                                                            <td>
                                                                <button type='button' class='btn bg-default waves-effect' onClick='full_receipt($fetched_id, $get_customer_id)'> 
                                                                                <i class='material-icons'>assignment</i>
                                                                                </button>
                                                            </td>
                                                            </tr>";
                                                    $sn++;
                                                }
                                            
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>SN</th><th>Ref</th><th>Total Sales</th><th>Amount Paid</th> <th>Balance</th><th>Channel</th> <th>Date</th> <th> </th>
                                        </tr>    
                                    </tfoot>
                                </table>
                                
                        </div>
                    	
                    </div>
            </div>
                
                
                <!-- Modal Dialogs ====================================================================================================================== -->
            	<!--Deposite and Payback receipt-->

                <?php deposite_payback_receipt(); ?>
                
                  <!-- Small Size -->
                                            <?php general_thermal_receipt();  ?>
                                <!---->

                                
            <style type="text/css">
   @media screen {
        #printSection {
           display: none;
        }
   }

   @media print {
        body > *:not(#printSection) {
           display: none;
        }
        #printSection, #printSection * {
            visibility: visible;
        }
        #printSection {
            position:absolute;
            left:0;
            top:0;
        }
   }
</style>
                 
            <!-- ======  end of small modal ========-->
            
            <!-- full Size Receipt modal-->
            <?php general_full_receipt(); ?>
            
            
            <!--Debt Payment modal-->
            
            <div class="modal fade" id="debtModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="fullModalLabel">Add Payment</h4>
                        </div>
                        
                        <div class="modal-body">
                           	<div id="printDebtPaymentReceipt" style="width: 800px; height: auto">
                           	
                                    <form method="post" action="">
                                        <div class="row clearfix">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                            <input type="text" name="amount_paid_cash" class="form-control" onKeyDown="numericOnly('amount')" required autocomplete="off"  autofocus placeholder="Enter Cash Amount *" />
                                                        </div><div class="form-line">   
                                                            <input type="text" name="amount_paid_pos" class="form-control" onKeyDown="numericOnly('amount')" required autocomplete="off"  placeholder="Enter POS Amount " />
                                                        </div><div class="form-line">   
                                                            <input type="text" name="amount_paid_trnf" class="form-control" onKeyDown="numericOnly('amount')" required autocomplete="off" placeholder="Enter Transfer Amount " />
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                
                                        <div class="icon-and-text-button-demo">
                                            <button class="btn bg-green waves-effect" type="submit" name="post_payment" value="go">
                                                <i class="material-icons">save</i> 
                                            </button>
                                        </div>
                                    </form>

                                <div id="payment_history"></diV>


                        	</div>
                        </div>
                        <div class="modal-footer">
                           	
                            <button type="button" class="btn btn-link waves-effect" id="modal_full_close" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="../plugins/autosize/autosize.js"></script>

   
    
    <!-- Moment Plugin Js -->
    <script src="../plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    
    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    
    <script src="../js/pages/forms/basic-form-elements.js"></script>
    <script src="../js/pages/tables/jquery-datatable.js"></script>

   <!--sales report JS-->
   <script src="sales_report.js"></script>
    <!-- Demo Js -->
    <script src="../js/demo.js"></script>

    <script>
        function debtPlatform(){
	
	$('#debtModal').modal('show');
}
    </script>
</body>
</html>