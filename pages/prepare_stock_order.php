<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(6);
?>
<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Prepare Stock Order</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

   <!-- Custom Css -->
    <link href="../css/custom.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="../css/fonts.css" rel="stylesheet" type="text/css">
    <link href="../css/icons.css" rel="stylesheet" type="text/css">

   
    
    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

   <!-- Sweetalert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
    
    
    <!-- Wait Me Css -->
    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />

 
    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

</head>

<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader" id="loadingCircle">
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
    
    <!-- #left Bar -->
    <?php 
	navigation_left();
	
	?>
   

    <section class="content" >
        <div class="container-fluid">
            
            <!-- Input -->
            
          <div class="row clearfix">
          
              <!--items sells cart -->
              
              		<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                    <div class="card">
                       
                        <div class="header">
                            <h2>
                              Items List (cart)
                                <small></small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Suspend Sales</a></li>
                                        <li><a href="javascript:void(0);">Retieve Sale</a></li>
                                        <li><a href="javascript:void(0);" id="clear_cart">Clear Cart</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body" style="height: 600px;">
                        
                        	
                        	<div  style="height: 350px; overflow-y: auto" >
                        			<ul class="list-group" id="list_items_cart">
                              </ul>
                        	</div>
                        	
                        	<hr>
                        	<div class="col-xs-6">
										 
										  <div class="form-group">
											  <div class="form-line">
											 	 
												 <label> Total Amount: </label> 
												 <label id="total_sale_label"> </label>
											  </div>
								</div>
									  
									
							</div>
                       		<div class="col-xs-6" >
                       			
                       			  <div class="icon-and-text-button-demo" >
									<button class="btn bg-green waves-effect" style="width: auto" type="button" id="full_receipt">
										<i class="material-icons">print</i> <span>Process Order</span>
									</button>
								</div>
                      		
								<div class="breaker"></div><br>
								
                      			 
                       		</div>
                        		
                        </div>
                    </div>
                    
                </div>
                
				<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                    <div class="card">
                       
                        
                        <div class="body">
                       
                        	<form action="" method="post">

								<div class="row clearfix">
									   <div class="col-sm-12">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" id="barcode" class="form-control" autofocus placeholder="Barcode Here *" />
											</div>
										  </div>
									   </div>
								   </div>
								   
								   <div class="row clearfix">
														<div class="col-sm-12" id="list">
															<select class="form-control show-tick" data-live-search="true" name="list" id="fetched_items_list">
																<option value="">Select Item</option>
																<?php list_items(); ?>
															</select>
														</div>
									   
									   
								   
									   
							</div>
							
							<input type="hidden" id="item_id" />
							
						  <div class="row clearfix">
									<div class="col-sm-12">
										  <div class="form-group">
											
											<div class="form-line">
												 <label> Item Name: </label> <label id="item_name_label"></label>
												  <label id="qty_left_label" class="pull-right"></label> <label class="pull-right"> Item qty left:  </label>
											</div>
										  </div>
									   </div>
										<div class="col-sm-4">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" name="sale_price" id="sale_price" onKeyDown="numericOnly('sale_price')" class="form-control" placeholder="sale Price *" />
												<input type="hidden" id="cost_price" name="cost_price" />
											</div>
										  </div>
									   </div>
									   <div class="col-sm-4">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" name="qty" id="qty" onKeyDown="numericOnly('qty')" class="form-control" placeholder="Quantity *" />
												
											</div>
										  </div>
									   </div>
									   
									   <div class="icon-and-text-button-demo">
									<button class="btn bg-green waves-effect" type="button" name="submit" id="add">
										<i class="material-icons">add</i> 
									</button>
								</div>
						 </div>
						  
								
								<div class="clearfix">
										<div class="col-sm-12">
										  <div class="form-group">
											
											<div class="form-line">
											 Supplier Information
												 
												  <select class="form-control show-tick" data-live-search="true" id="fetched_customer_list">
																<option value="">Select Supplier</option>
																<?php list_suppliers(); ?>
													</select>
												 
											</div>
										  </div>
									   </div>
								</div>
								<input type="hidden" name="cid" id="customer_id" />
								<div class="clearfix"></div>
								
										<div class="clearfix">
										<div class="col-sm-12">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" readonly name="cu_name" id="cu_name" class="form-control" placeholder="Supplier Name" />
												
											</div>
										  </div>
									   </div>
								</div>
									   <div class="clearfix">
										<div class="col-sm-12">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" readonly id="cu_address" class="form-control" placeholder="Supplier Address" />
												
											</div>
										  </div>
									   </div>
									 </div>
								   
									   <div class="clearfix">  
										<div class="col-sm-12">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" readonly id="cu_phone" onKeyDown="numericOnly('cu_phone')" class="form-control" placeholder="Supplier Phone " />
												
											</div>
										  </div>
									   </div>
									   </div>
									   
								
									
						</form>
                        	
                        </div>
                    </div>
                    
                </div>
				
                <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Search Report
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);"> </a></li>
                                        <li><a href="javascript:void(0);"> </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            
                            	<form action="" method="GET">
                        					
                        					 <div class="row clearfix">
														<div class="col-sm-3">
                                                        <select class="form-control show-tick" name="supplier" data-live-search="true" id="fetched_suppliers">
																<option value="">-- Select Supplier * --</option>
																<option value="ALL">All Suppliers</option>
																<?php list_suppliers();?>
															</select>
														</div>
														
									<div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" name="date" id="reservation" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="icon-and-text-button-demo">
									<button class="btn bg-cyan waves-effect" style="width: auto" type="submit" name="submit" value="go" >
										<i class="material-icons">search</i>
									</button>
								</div>
											  </div>
                       						
                        			</form>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            EXPORTABLE ORDER REPORT
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);"> </a></li>
                                        <li><a href="javascript:void(0);"> </a></li>
                                    </ul> 
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Order ID</th>
                                            <th>Supplier</th>
                                            <th>Value Ordered (N)</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Order Receipt</th>
                                            <th>Processing</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    	<tr>
                                        <th>SN</th>
                                            <th>Order ID</th>
                                            <th>Supplier</th>
                                            <th>Value Ordered (N)</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Order Receipt</th>
                                            <th>Processing</th>
                                        </tr>
                                    </tfoot>
                                   
                                    <tbody>
                                        
                                        <?php
											
										if(isset($_GET["submit"])){
											
											//search sales record
											$supplier = sanitize($_GET["supplier"]);
                                                $dt = split(":",sanitize($_GET["date"]));
											
                                                if ($supplier and $dt){
                                        
                                    
                                                    $dt1 = trim($dt[0]);  
                                                    $dt2 = trim($dt[1]);
                                                    $grand_total = 0;
                                                    $total_profit = 0;

                                                    if($supplier=="ALL"){ 
                                                        $get_records = mysql_query("select * from ".$_SESSION["business_id"]."_placed_order where dateOrdered BETWEEN '$dt1' AND '$dt2' order by `dateOrdered` DESC");
                                                    } else {
                                                        
                                                        $get_records = mysql_query("select * from ".$_SESSION["business_id"]."_placed_order where supplier='$supplier' and dateOrdered BETWEEN '$dt1' AND '$dt2' order by `dateOrdered` DESC");
                                                    }	
                                        
											
                                            
                                        
											if(mysql_num_rows($get_records)>0){
												$sn = 1; 
												for($i=0; $i<mysql_num_rows($get_records); $i++){
													$rec = mysql_fetch_array($get_records);
													
													$ref = $rec["ref"]; $value_ordered = $rec["valueOrdered"];
                                                     $supplierID = $rec["supplier"];
                          
													$SupplierName = get_suppliers($supplierID);  
													
                                                    $date = $rec["dateOrdered"];
                                                    $date_supplied = $rec["dateSupplied"];
													$status = $rec["status"]; 
													
													//summation of total orders
													$grand_total +=$value_ordered;
													
													echo "<tr>
                                                    <td>$sn</td>
                                                    <td> <a href=''>$ref</a> </td>
                                                    
                                                    <td>$SupplierName</td>
                                                    <td>". number_format($value_ordered)."</td>
                                                    <td><label id='st_$ref'>$status</label></td>";

                                                    if ($status=="SUPPLIED") {echo "<td>$date_supplied</td>";} else { echo "<td>$date</td>";}
                                                    
                                                    
                                                    echo "<td> <button type='button' class='btn bg-default waves-effect' onClick='getReceipt(".$ref.")'> 
                                                    <i class='material-icons'>assignment</i>
                                                    </button> </td> <td>";

                                                    if ($status == "NOT_SUPPLIED"){
                                                    echo "<button id='$ref' type='button' class='btn bg-default waves-effect' onClick='processOrder(".$ref.")'> 
                                                                                    <i class='material-icons'>assignment</i>Process
                                                    </button>";
                                                    }
                                                    echo " </td>
															</tr>
													";
													$sn+=1;
												}
												echo "<tr>
                                                <td> </td>
                                                <td>  </td>
                                                
                                                <td align='right'> <b>Total: </td>
                                                <td> <b>". number_format($grand_total)."</b></td>
                                                <td> <b> </b></td>
                                                <td> </td>
                                                <td> </td>
                                                <td> </td>
                                                <td></td>
												</tr>";
												
											}else{ echo "<div class='alert alert-danger'>No Record Found</div>";}
											
									    }		
											
										}
										
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

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
            
            <!-- Modal Dialogs ====================================================================================================================== -->
            
            
            
            <!-- full Size Receipt modal-->
            <?php general_order_receipt(); ?>
            
            <!-- ======  end of full size modal ========-->
            
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script  src="../plugins/jquery/jquery.min.js"></script>
    

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="../js/moment/moment.min.js"></script>
    <script src="../js/datepicker/daterangepicker.js"></script>

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

   <!-- Modal Plugin Js -->
    <script src="../js/pages/ui/modals.js"></script>
    
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
    <!--diaogs Js-->
    <script src="../js/pages/ui/dialogs.js"></script>
    
    <script src="../js/pages/forms/basic-form-elements.js"></script>
    <script src="../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
    
    <script src="stock_order.js"></script>

    <script>
      
		
      $(document).ready(function() {
        $('#reservation').daterangepicker({format: 'YYYY-MM-DD'}, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
		 
        });
      });
		
    </script>

</body>
</html>