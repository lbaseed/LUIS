<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(9);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>UIS - Sales</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    
    <!--data tables-->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Wait Me Css -->
    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    
    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
    
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
    
    <!-- #left Bar -->
    <?php 
	navigation_left();
	
	?>
   

    <section class="content" >
        <div class="container-fluid">
            
            <!-- Input -->
            
           
            
            
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
                                        <li><a href="" id="record_id">my modal </a></li>
                                        <li><a href="javascript:void(0);"> </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            
                            	<form action="" method="GET">
                        					
                        					 <div class="row clearfix">
														<div class="col-sm-3">
															<select class="form-control show-tick" name="user" data-live-search="true">
																<option value="">-- Select User * --</option>
																<option value="ALL">All Users</option>
																<?php list_users();?>
															</select>
														</div>
														
									<div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" class="form-control date" name="dt" id="reservation" />
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
            
            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EXPORTABLE REPORT
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
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>Total Sales (N)</th>
                                            <th>Profit (N)</th>
                                            <th>Date &nbsp &nbsp &nbsp</th>
                                            <th>Cashier</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        
                                        <?php
											
										if(isset($_GET["submit"])){
											
											//search sales record
											$user = sanitize($_GET["user"]);
											$dt = split(":",sanitize($_GET["dt"]));
											
								            if ($user and $dt){
								
                                                $dt1 = trim($dt[0]);  
                                                $dt2 = trim($dt[1]);
                                                $grand_total = 0;
                                                $total_profit = 0;
                                                
                                                if($user=="All"){ 

                                                    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_trans WHERE date BETWEEN :dt1 AND :dt2 ORDER BY `date` DESC ");
                                                    $stmt->execute(['dt1' => $dt1, 'dt2' => $dt2 ]);

                                                } else {
                                                    
                                                    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_trans WHERE cashier = :user AND date BETWEEN :dt1 AND :dt2 ORDER BY `date` DESC ");
                                                    $stmt->execute(['user' => $user, 'dt1' => $dt1, 'dt2' => $dt2 ]);
                                                }	
                                            
                                                $rows = $stmt->rowCount();
											
                                                if($rows>0){
                                                    $sn = 1; 
                                                    
                                                    for($i=0; $i<$rows; $i++){

                                                        $row = $stmt->fetch();
                                                        
                                                        $tid = $row->tid; 
                                                        $total_sales = $row->total_sales;
                                                        $cid = $row->cid;
                                                        if ($cid>0){ $type = get_customer($cid);  } else { $type = "Walk in Customer"; }
                                                        
                                                        $date = $row->date;
                                                        $cashier = $row->cashier; 
                                                        $profit = get_profit($tid);
                                                        
                                                        //summation of total sales and profit
                                                        $grand_total +=$total_sales;
                                                        $total_profit += $profit;
                                                        
													echo "<tr>
															<td>$sn</td>
															<td> <a href='' id='record_id'>$tid</a> </td>
															
															<td>$type</td>
															<td>". number_format($total_sales)."</td>
															<td>".number_format($profit)."</td>
															<td>$date</td>
															<td>$cashier</td>
															</tr>
													";
													$sn+=1;
												}
												echo "<tr>
															<td> </td>
															<td>  </td>
															
															<td align='right'> <b>Total: </td>
															<td> <b>". number_format($grand_total)."</b></td>
															<td> <b>".number_format($total_profit)." </b></td>
															<td> </td>
															<td> </td>
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
            <!-- Exportable Table -->
            
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
            
            <!-- Small Size -->
            <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Thermal Receipt</h4>
                        </div>
                        <div class="modal-body">
                           	<div id="printThis">
                          			<?php
										
										$business_id = $_SESSION["business_id"];
									$fetch = mysql_query("select * from ".$business_id."_company_profile ");
								if (mysql_num_rows($fetch)>0){
									
									$company_name = mysql_result($fetch, 0, "name"); $address = mysql_result($fetch, 0, "address");
									$phone1 = mysql_result($fetch, 0, "phone1"); $phone2 = mysql_result($fetch, 0, "phone2");
									$email = mysql_result($fetch, 0, "email");  $logo = mysql_result($fetch, 0, "logo");
								}
								?>
                           			<div style="text-align: center"><img src="../images/logos/<?php echo $logo; ?>" width="90" height="80"  /></div>
                           			<div style="text-align: center">
										<label id="bus_name"><?php echo $company_name?></label><br>
										<label id="bus_address"><?php echo $address?></label><br>
										<label id="bus_contact"><?php echo $phone1 . " " .$phone2; ?></label>
									</div>
                           			<div style="float: left">Ref: <label  id="modal_trans_ref"></label></div> 
                           			<div class="pull-right" ><label id="modal_trans_date"></label></div><br>
                           			
									
                           				<table id="modal_items_list" class="table" style="font-size: 9" >
                           				<thead>
                           					<tr><th>Qty</th> <th>Item</th> <th>Sub-Total</th></tr>
                           					
                           					</thead>
                           					<tbody>
                           						
                           					</tbody>
                           				</table>
                           			
                           			<div style="text-align: center">
										<label>Total Sales: </label> <label id="modal_total_label"> #### </label><br>
										<label>Amount Tendered: </label> <label id="modal_amount_tendered"> ####</label><br>
										<label>Change: </label> <label id="modal_change"> ####</label>
										
									</div>
                          			<div><label id="modal_footer">cashier: <?php echo $_SESSION["cur_user"];?>, date: </label></div>
                           	</div>
                        </div>
                        <div class="modal-footer">
                           	
                            <button type="button" class="btn btn-link waves-effect" onClick="printDiv('printThis')">Print Receipt</button>
                            <button type="button" class="btn btn-link waves-effect" id="modal_close" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ======  end of small modal ========-->
            
            <!-- full Size Receipt modal-->
            <div class="modal fade" id="fullModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="fullModalLabel">Full Receipt</h4>
                        </div>
                        <div class="modal-body">
                           	<div id="printFullReceipt" style="width: 800px; height: auto">
                           			<?php
										
										$business_id = $_SESSION["business_id"];
									$fetch = mysql_query("select * from ".$business_id."_company_profile ");
								if (mysql_num_rows($fetch)>0){
									
									$company_name = mysql_result($fetch, 0, "name"); $address = mysql_result($fetch, 0, "address");
									$phone1 = mysql_result($fetch, 0, "phone1"); $phone2 = mysql_result($fetch, 0, "phone2");
									$email = mysql_result($fetch, 0, "email");  $logo = mysql_result($fetch, 0, "logo");
								}
								?>
                           			<div style="text-align: center"><img src="../images/logos/<?php echo $logo; ?>" width="90" height="80"  /></div>
                           			<div style="text-align: center">
										<label id="bus_name"><?php echo $company_name?></label><br>
										<label id="bus_address"><?php echo $address?></label><br>
										<label id="bus_contact"><?php echo $phone1 . " " .$phone2; ?></label>
									</div>
                          			<div>Full Name: <label  id="modal_full_cust_name">####</label></div>
                          			<div>Address: <label  id="modal_full_cust_addr">####</label></div>
                          			<div>Phone: <label  id="modal_full_cust_phone">####</label></div><br>
                          			
                           			<div style="float: left">Ref: <label  id="modal_full_trans_ref"></label></div> 
                           			<div class="pull-right" ><label id="modal_full_trans_date"></label></div><br>
                           			
									
                           				<table id="modal_full_items_list" class="table" style="font-size: 9" >
                           				<thead>
                           					<tr><th>Qty</th> <th>Item</th> <th>Price</th> <th>Sub-Total</th></tr>
                           					</thead>
                           					<tbody>
                           						
                           					</tbody>
                           				</table>
                           			
                           			<div style="text-align: center">
										<label>Total Sales: </label> <label id="modal_full_total_label"> #### </label><br>
										<label>Amount Tendered: </label> <label id="modal_full_amount_tendered"> ####</label><br>
										<label>Change: </label> <label id="modal_full_change"> ####</label>
										
									</div>
                          			<div><label id="modal_full_footer">cashier: <?php echo $_SESSION["cur_user"];?>, date/time: </label></div>
                           	</div>
                        </div>
                        <div class="modal-footer">
                           	
                            <button type="button" class="btn btn-link waves-effect" onClick="printFull('printFullReceipt')">Print Receipt</button>
                            <button type="button" class="btn btn-link waves-effect" id="modal_full_close" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ======  end of full size modal ========-->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="fullModalLabel">Full Receipt</h4>
                        </div>
                        <div class="modal-body">
                        
                       </div>
                        <div class="modal-footer">
                           	
                            <button type="button" class="btn btn-link waves-effect" onClick="printFull('printDepReceipt')">Print Receipt</button>
                            <button type="button" class="btn btn-link waves-effect" id="modal_dep_close" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>  
            <!-- full Size Receipt modal-->
            <div class="modal fade" id="depModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="fullModalLabel">Full Receipt</h4>
                        </div>
                        <div class="modal-body">
                           	<div id="printDepReceipt" style="width: 800px; height: auto">
                           			<?php
										
										$business_id = $_SESSION["business_id"];
									$fetch = mysql_query("select * from ".$business_id."_company_profile ");
								if (mysql_num_rows($fetch)>0){
									
									$company_name = mysql_result($fetch, 0, "name"); $address = mysql_result($fetch, 0, "address");
									$phone1 = mysql_result($fetch, 0, "phone1"); $phone2 = mysql_result($fetch, 0, "phone2");
									$email = mysql_result($fetch, 0, "email");  $logo = mysql_result($fetch, 0, "logo");
								}
								?>
                           			<div style="text-align: center"><img src="../images/logos/<?php echo $logo; ?>" width="90" height="80"  /></div>
                           			<div style="text-align: center">
										<label id="bus_name"><?php echo $company_name?></label><br>
										<label id="bus_address"><?php echo $address?></label><br>
										<label id="bus_contact"><?php echo $phone1 . " " .$phone2; ?></label>
									</div>
                          			<div>Full Name: <label  id="modal_dep_cust_name">####</label></div><br>
                          			<div>Address: <label  id="modal_dep_cust_addr">####</label></div><br>
                          			<div>Phone: <label  id="modal_dep_cust_phone">####</label></div><br>
                          			
                           			<div style="float: left">Ref:<label  id="modal_dep_trans_ref">####</label></div> 
                           			<div style="margin-left: 300px"><label id="receipt_type"></label></div> 
                           			<div style="margin-left: 500px; float: left"><label id="modal_dep_trans_date"> dd/mm/YYYY </label> </div>
                           			
									
                           				<table id="modal_dep_items_list" class="table" style="font-size: 9" >
                           				<thead>
                           					<tr><th>Qty</th> <th>Item</th> <th>Price</th> <th>Sub-Total</th></tr>
                           					</thead>
                           					<tbody>
                           						
                           					</tbody>
                           				</table>
                           			
                           			<div style="text-align: center">
										<label>Total Sales: </label> <label id="modal_dep_total_label"> #### </label><br>
										<label>Amount Tendered: </label> <label id="modal_dep_amount_tendered"> ####</label><br>
										<label>Change / Balance Payable: </label> <label id="modal_dep_change"> ####</label>
										
									</div>
                          			<div><label id="modal_dep_footer">cashier: <?php echo $_SESSION["cur_user"];?>, date/time: </label></div>
                           	</div>
                        </div>
                        <div class="modal-footer">
                           	
                            <button type="button" class="btn btn-link waves-effect" onClick="printFull('printDepReceipt')">Print Receipt</button>
                            <button type="button" class="btn btn-link waves-effect" id="modal_dep_close" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ======  end of deposit size modal ========-->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script  src="../plugins/jquery/jquery.min.js"></script>
    

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

   <!-- Modal Plugin Js -->
    <script src="../js/pages/ui/modals.js"></script>
    
    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <!--diaogs Js-->
    <script src="../js/pages/ui/dialogs.js"></script>
    
    <script src="../js/pages/forms/basic-form-elements.js"></script>
    <script src="../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
    
    <script src="sales_report.js"></script>
</body>
</html>