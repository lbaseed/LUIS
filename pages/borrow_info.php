<?php 
//Ban gane query din line 126 ba
ob_start(); 
include("../inc/config.php"); 
include("../inc/php_functions.php");   
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
                                Customer Debts  :
                                <?php 
                                    $customer_curr = $_GET["customer"];

                                    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_customers where ID = :customer_curr ");
                                    $stmt->execute(['customer_curr' => $customer_curr]);
                                    
                                    $rows = $stmt->rowCount();

									if ($rows > 0){
                                        $row = $stmt->fetch();
                                        
                                        $name = $row->full_name;
                                        $address = $row->address;
                                        $phone = $row->phone;
                                        echo $name;
                                        
									}else {
                                        echo "error";
                                    }
							
							  ?>
                              <small><?php echo $phone?></small>
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
                        	
                       
                       	
                        
                        <table class="table table-striped">
                       		<thead>
                       			<tr>
                       				<th> Items Borrowed </th> <th> Price </th> <th> qty</th>
                       			</tr>
                       		</thead>
                       		<tbody>
                      				
                       				<?php
									$borrow=$_SESSION["business_id"]."_borrow";
									$items=$_SESSION["business_id"]."_items";
									$customer_curr = $_GET["customer"];
									$trans_id=$_GET["trans"];
                                    
                                    $stmt = $conn->prepare("SELECT $borrow.*,$items.name FROM $borrow JOIN $items ON $borrow.item_id=$items.item_id WHERE trans_id = :trans_id");
                                    $stmt->execute(['trans_id' => $trans_id]);
                                    
                                    $rows = $stmt->rowCount();

									//$q=mysql_query("select $borrow.*,$items.name from $borrow join $items on $borrow.item_id=$items.item_id where trans_id=$trans_id" );//fetch borrow join items
                                    
                                    if($rows > 0){

										for($i=0; $i<$rows; $i++){

                                            $row = $stmt->fetch();
                                            
											$total+=$row->borrow_price;
                                            $date = $row->date;
                                            
										echo "<tr> <td>".$row["name"]."</td> <td> ". $row["borrow_price"]."</td><td>".$row["qty"]."</td> </tr>";
										
											
											}
									
									echo "<tr><th>Total</th><td>".$total."</td></tr>";
                                    echo "<tr><th>Date</th><td>".$date."</td></tr>";
                                    
                                    $stmt = $conn->prepare("SELECT mop FROM ".$_SESSION["business_id"]."_borrow_trans WHERE tid = :trans_id;");
                                    $stmt->execute(['trans_id' => $trans_id]);
                                    
                                    $rows = $stmt->rowCount();

									//$q2=mysql_query("select mop from ".$_SESSION["business_id"].'_borrow_trans'." where tid=$trans_id;");
                                    
                                    if($rows > 0){

                                        $row = $stmt->fetch();

										$status = $row->mop;
									
										}
									echo "<tr><th>Status</th><td><label id=status>".$status."</label></td></tr>";
									
									
									}
															
									?>
                       		</tbody>
                       	</table>
                        
						</div>
               	
					</div>
                	
                
				</div>
                
                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-4">
                    <div class="card">
                       
                        <div class="header">
                            <h2>
                              Payment
                                
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
							
								//display selected customer's infomration
								$get_customer_id = $_GET["customer"];
							
							
						?>
                        

							<input type="hidden" id="cust_id"  name="" value="<?php echo $get_customer_id; ?>" />
							<input type="hidden" id="trans_id"  name="trans_id" value="<?php echo $_GET["trans"]; ?>" />
								
                             
                                        <div class="row clearfix">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                   
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                
                                        <div class="icon-and-text-button-demo">
                                        <?php 

                                            $stmt = $conn->prepare("SELECT mop FROM ".$_SESSION["business_id"]."_borrow_trans WHERE tid= :trans_id AND mop='sold'");
                                            $stmt->execute(['trans_id' => $trans_id]);

                                            //$rec = mysql_query("select mop from ".$_SESSION["business_id"]."_borrow_trans where tid='$trans_id' and mop='sold'");
											//if(mysql_num_rows($rec)>0){
												?>
												<button class="btn bg-green waves-effect" type="submit" name="get_receipt" id="get_receipt" value="go">
                                                Receipt
                                            </button>
												<?php
												//}else{
													
													?>
													<button class="btn bg-green waves-effect" type="submit"  id="payment_borrow">
                                                sold
                                            </button>
                                             <button class="btn bg-green waves-effect" type="submit" name="return" id="return" value="go">
                                                returned
                                            </button>
													<?php
													//}
										
										
										?>
                                            
                                             
                                        </div>
                                    	
					
                        	
                            
                        </div>
                       
                    </div>
                    
                </div>
                
            </div>
            
            

            
                
                
                <!-- Modal Dialogs ====================================================================================================================== -->
            	  <!-- Small Size -->
                                            <?php general_thermal_receipt()  ?>
      
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
            
          <!--  <div class="modal fade" id="debtModal" tabindex="-1" role="dialog">
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
                                                            <input type="text" id="cash_tendered" name="amount_paid_cash" class="form-control" onKeyDown="numericOnly('amount')" required autocomplete="off"  autofocus placeholder="Enter Cash Amount *" />
                                                        </div><div class="form-line">   
                                                            <input type="text" id="pos_tendered" name="amount_paid_pos" class="form-control" onKeyDown="numericOnly('amount')" required   placeholder="Enter POS Amount " />
                                                        </div><div class="form-line">   
                                                            <input type="text" id="trnf_tendered" name="amount_paid_trnf" class="form-control" onKeyDown="numericOnly('amount')" required placeholder="Enter Transfer Amount " />                                                                                                                  
                                                    </div>
                                                    <div class="form-line">   
                                                           <label> Tota Tendered: </label> 
												 <label id="total_tendered_label"> </label>
                                                        </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                
                                        <div class="icon-and-text-button-demo">
                                            <button class="btn bg-green waves-effect" type="submit" name="post_payment" id="payment_borrow" value="go">
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
            </div> -->
            
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
  <script src="borrow.js"></script>
    <script>
        function debtPlatform(){
	
	$('#debtModal').modal('show');
}
    </script>
</body>
</html>