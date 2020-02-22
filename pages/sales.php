<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(3);
if($_SESSION["clearance"]==6 || $_SESSION["clearance"]==4) {header("Location: index.php");}
?>
<!DOCTYPE html>
<html>

<head>
 <?php links("UIS-Sales Page")?>

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
    <script src="../plugins/jquery-validation/jquery.validate.js"></script>
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

          	<div class="row clearfix">
            
			  	<?php
					//Check to see if business start if not user must start business
					if (checkBusinessStart()) {
				?>
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
							
								
								<div id="list_items_cart" style="height: 350px; overflow-y: auto" >
										<ul class="list-group">
								
										</ul>
								</div>
								
								<hr>
								<div class="col-xs-6">
											
											<div class="form-group">
												<div class="form-line">
													
													<label> Total Sale: </label> 
													<label id="total_sale_label"> </label>
												</div>
									</div>
										
										<div class="form-group">	 
											<div class="col-xs-8">
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="" autocomplete="off" id="cash_tendered" onKeyDown="numericOnly('cash_tendered')" class="form-control" placeholder="Cash Tendered *" />
												</div><div class="form-line">
													<input type="text" name="" autocomplete="off" id="pos_tendered" onKeyDown="numericOnly('pos_tendered')" class="form-control" placeholder="POS Tendered " />
												</div><div class="form-line">	 
													<input type="text" name="" autocomplete="off" id="trnf_tendered" onKeyDown="numericOnly('trnf_tendered')" class="form-control" placeholder=Transfer Tendered *" />
												</div>
											</div>
										</div>
										</div>
										
										
										
								</div>
								<div class="col-xs-6" >
									
									<div class="icon-and-text-button-demo" >
										<button class="btn bg-green waves-effect" style="width: auto" type="button" id="thermal_receipt">
											<i class="material-icons">print</i> <span>Thermal Receipt</span>
										</button>
									</div>
								
									<div class="icon-and-text-button-demo">
										<button class="btn bg-green waves-effect" style="width: auto" type="button" id="full_receipt">
											<i class="material-icons">print</i> <span>A4 Receipt</span>
										</button>
									</div>
									<div class="breaker"></div><br>
									<div class="form-group">
												<div class="form-line">
													
													<label> Total Tendered: </label> 
													<label id="total_tendered_label"> </label>
												</div>
									</div>
									
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
													<input type="text" id="barcode" class="form-control" autocomplete="off" autofocus placeholder="Barcode Here *" />
												</div>
											</div>
										</div>
									</div>
										<input type="hidden" id="cur_user_clrs" value="<?php echo $_SESSION["clearance"];?>" />

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
													<input type="text" name="sale_price" id="sale_price" autocomplete="off" onKeyDown="numericOnly('sale_price')" class="form-control" placeholder="sale Price *" />
													<input type="hidden" id="cost_price" name="cost_price" />
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												
												<div class="form-line">
													<input type="text" name="qty" id="qty" autocomplete="off" onKeyDown="numericOnly('qty')" class="form-control" placeholder="Quantity *" />
													
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
													<input type="text" name="item_serial" autocomplete="off" id="item_serial" class="form-control" placeholder="Serial Number" />
													
												</div>
											</div>
										</div>
									</div>
									
									<div class="clearfix">
											<div class="col-sm-12">
											<div class="form-group">
												
												<div class="form-line">
												Customer Information
													
													<select class="form-control show-tick" data-live-search="true" id="fetched_customer_list">
																	<option value="">Select Customer</option>
																	<?php list_customers(); ?>
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
													<input type="text" name="cu_name" id="cu_name" autocomplete="off" class="form-control" placeholder="Customer Name" />
													
												</div>
											</div>
										</div>
									</div>
										<div class="clearfix">
											<div class="col-sm-12">
											<div class="form-group">
												
												<div class="form-line">
													<input type="text" id="cu_address" autocomplete="off" class="form-control" placeholder="Customer Address" />
													
												</div>
											</div>
										</div>
										</div>
									
										<div class="clearfix">  
											<div class="col-sm-12">
											<div class="form-group">
												
												<div class="form-line">
													<input type="text" id="cu_phone" autocomplete="off" onKeyDown="numericOnly('cu_phone')" class="form-control" placeholder="Customer Phone " />
													
												</div>
											</div>
										</div>
										</div>
										
									<!--recent sales table-->
										
							</form>
								
							</div>
						</div>
						
					</div>
					
					<div class="clearfix"></div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
						<div class="card">
							<div class="header">
								<h2>
									Recently added Items List
									<small>List of Items</small>
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
						
							<div class="body table-responsive">
								
								
						<table class="table-bordered col-lg-10">
							<thead>
								<tr>
									<th>SN</th><th>Item Name</th><th>Qty</th> <th>Sale Price (NGN)</th> <th> </th>
								</tr>
							</thead>
							<tbody>
								<?php

									$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items WHERE status=1 ORDER BY `date` DESC LIMIT 10 ");
									$stmt->execute();

									$rows = $stmt->rowCount();

									if ($rows>0){
										$sn=1;
										for($i=1; $i<$rows; $i++){

											$row = $stmt->fetch();
												
											$fetched_id = $row->item_id; 
											$fetch_item_name = $row->name;
											$fetch_cost_price = $row->cost_price; 
											$fetch_sale_price = $row->sale_price;
											$fetch_item_qty = $row->qty;
											
											echo "<tr><td>$sn</td> <td><a href=''>$fetch_item_name </a></td> <td>$fetch_item_qty</td>  <td>". number_format($fetch_sale_price)."</td> <td>
											
											</td> </tr>";
											$sn++;
										}
									}
								?>
							</tbody>
							
						</table>
						
							</div>
							
						</div>
					</div>

				<?php
					}else {
				?>

					<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
						<div class="card">
							<div class="header">
								<h2>
									Start Business
									
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
								<div class='alert alert-warning' role='alert'>You Must Start Business before you can make Sales</div>
								<?php
									if (isset($_POST["startbusiness"])){
										$start_date = date("Y-m-d H:i:s");

										$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items ");
										$stmt->execute();
									
										$rows = $stmt->rowCount();

										if ($rows>0){

											$startCapital = 0;

											for($i=1; $i<=$rows; $i++){
														
												$row = $stmt->fetch();

												$cost_price = $row->cost_price;
												$quantity = $row->qty;

												$startCapital += $cost_price * $quantity;
											}

										}

										$stmt  = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_business_profile (`id`, `startDate`, `capital`) VALUES (:id, :startDate, :capital) ");
										$query = $stmt->execute(['id' => "", 'startDate' => $start_date, 'capital' => $startCapital]);
										
										if ($query) { 
											echo "<div class='alert alert-success' role='alert'>Business Started Successfully</div>"; 
										}else {
											echo "<div class='alert alert-danger' role='alert'>Operation Failed, try again</div>";
										}

									}
								?>
								<form action="" method="post">
									<div class="icon-button-demo">
										<button class="btn bg-green waves-effect"  type="submit" name="startbusiness">
											<i class="material-icons">print</i> <span>Start Business</span>
										</button>
									</div>
								</form>
												
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
						<div class="card">
							<div class="header">
								<h2>
									Business Details
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

									$stmt1 = $conn->prepare("SELECT * FROM businesses WHERE business_id = ".$_SESSION["business_id"]." ");
									$stmt1->execute();
									
									$rows = $stmt1->rowCount();

									if ($rows > 0){

										$row = $stmt1->fetch();

										$business_id = $row->business_id;
										$business_name = $row->business_name;
										$business_address = $row->business_address;
										$customer_name = $row->customer_name;

									}

									$stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items");
									$stmt->execute();

									$rows = $stmt->rowCount();

									if ($rows > 0){

										//$row = $stmt->fetch();
										$cost_price = 0;
										$quantity = 0;

										$startCapital = 0;
										$numberOfItems = $stmt->rowCount();
										
										for($i=1; $i <= $rows; $i++){
													
											$row = $stmt->fetch();

											$cost_price = $row->cost_price;
											$quantity = $row->qty;

											$startCapital += $cost_price * $quantity;
										}

									}

								?>
								<table class="table table-striped table-hover">
									<tr>
										<td>Business ID: </td>
										<td><b><?php if(isset($business_id)){echo $business_id;}  ?></b></td>
									</tr>
									<tr>
										<td>Business Name: </td>
										<td><b><?php if(isset($business_name)){echo $business_name;} ?></b></td>
									</tr>
									<tr>
										<td>Business Address: </td>
										<td><b><?php if(isset($business_address)){echo $business_address;}  ?></b></td>
									</tr>
									<tr>
										<td>Customer Name: </td>
										<td><b><?php  if(isset($customer_name)){echo $customer_name;} ?></b></td>
									</tr>
									<tr>
										<td>Total Items: </td>
										<td><b><?php if(isset($numberOfItems)){echo $numberOfItems;}  ?></b></td>
									</tr>
									<tr>
										<td>Start Capital: </td>
										<td><b><?php if(isset($startCapital)){echo "NGN".number_format($startCapital);}  ?></b></td>
									</tr>
								</table>				
							</div>
						</div>
					</div>
					
				<?php
					//End check business start
					}
				?>

            </div>

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
            <?php general_thermal_receipt(); ?>
            
            <!-- ======  end of small modal ========-->
            
            <!-- full Size Receipt modal-->
            <?php general_full_receipt(); ?>
            
            <!-- ======  end of full size modal ========-->
            
            
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
    
    <script src="sales.js"></script>
</body>
</html>