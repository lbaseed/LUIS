<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(6);
?>
<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-Update Item")?>

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    
    <!--data tables-->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Wait Me Css -->
    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />

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
    
    <!-- #Top Bar -->
    <?php navigation_left();?>
   

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
               
            </div>
            <!-- Input -->
            
            <div class="row clearfix">
              
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       
                        <div class="header">
                            <h2>
                              Update Item
                                <small></small>
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
								
									$item_id = sanitize(strtoupper($_POST["item_id"]));
									$item_name = sanitize(strtoupper($_POST["itemName"]));
									$item_cat = sanitize(strtoupper($_POST["item_cat"]));
									$qty = sanitize(strtoupper($_POST["qty"]));
									
									$cost_price = sanitize(strtoupper($_POST["cost_price"]));
									
									$sale_price = sanitize(strtoupper($_POST["sale_price"]));
									$item_code = sanitize(strtoupper($_POST["itemCode"]));
									
									$user = $_SESSION["cur_user"];
									$date = date("Y-m-d");
									
									
								if ($item_name and $item_cat and $cost_price and $sale_price){
									
									$query = mysql_query("update ".$_SESSION["business_id"]."_items set name='$item_name', cat_id='$item_cat', qty='$qty', cost_price='$cost_price', sale_price='$sale_price' where item_id='$item_id'");
									
									
									
									if ($query) { echo "<div class='alert alert-success' role='alert'>Item Updated Successfully</div>"; }
									else { echo "<div class='alert alert-danger' role='alert'>Operation Failed, try again</div>";}
								} else { echo "<div class='alert alert-danger' role='alert'>Fill all * fields</div>";}
							}
							
							{
								
								if(isset($_GET["item"])) {$Update_item_id = $_GET["item"];} else {$update_item_id="";}
							
								if(isset($Update_item_id)){
									
									$fetch_item_info = mysql_query("select * from ".$_SESSION["business_id"]."_items where item_id='$Update_item_id' and status=1");
									
									if(mysql_num_rows($fetch_item_info)>0){
										
										$rec = mysql_fetch_array($fetch_item_info);
										
										$fetch_name = $rec["name"];  $fetch_qty = $rec["qty"]; $fetch_cost_price = $rec["cost_price"];
										$fetch_sale_price = $rec["sale_price"]; $fetch_cat = $rec["cat_id"]; $cat_name = getCategories($fetch_cat);
										$fetch_bar_code = $rec["barcode"];
										
									}
								}
							}
							{
								
								
								if(isset($_GET["del_item"])) {

								$delete_item = $_GET["del_item"];

									
									$del_query = mysql_query("update ".$_SESSION["business_id"]."_items set status='0' where item_id='$delete_item' ");
									
									if ($del_query) { echo "<div class='alert alert-success' role='alert'>Item Deleted Successfully</div>"; }
									else { echo "<div class='alert alert-danger' role='alert'>Operation Failed, try again</div>";}
								}
							
							}
						?>
                        	<form action="" method="post">

							<input type="hidden" name="item_id" value="<?php echo $Update_item_id; ?>" />
								<div class="row clearfix">
									   <div class="col-sm-8">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="itemName" class="form-control" value="<?php echo $fetch_name; ?>" required autofocus placeholder="Item Name *" />
											</div>
										  </div>
									   </div>
									   <div class="col-sm-4">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="itemCode" class="form-control" value="<?php echo $fetch_bar_code; ?>" placeholder="Bar Code" />
											</div>
										  </div>
									   </div>
								   </div>
								   
								   <div class="row clearfix">
														<div class="col-sm-3">
															<select class="form-control show-tick" name="item_cat" data-live-search="true">
																<option value="">-- Category * --</option>
																<option value="<?php echo $fetch_cat; ?>" selected ><?php echo $cat_name; ?></option>
																<?php list_categories();?>
															</select>
														</div>
									   
									   <div class="col-sm-3">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="cost_price" class="form-control" value="<?php echo $fetch_cost_price; ?>" placeholder="Cost Price *" />
												 
											</div>
											
										  </div>
									   </div>
								   
									   <div class="col-sm-3">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" name="sale_price" class="form-control" value="<?php echo $fetch_sale_price; ?>" placeholder="Sale Price *" />
												
											</div>
										  </div>
									   </div>
								  
									   <div class="col-sm-3">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="qty" class="form-control" value="<?php echo $fetch_qty; ?>" placeholder="quantity *" />
											</div>
										  </div>
									   </div>
							</div>
						  
								<div class="icon-and-text-button-demo">
									<button class="btn bg-green waves-effect" type="submit" name="submit" value="go">
										<i class="material-icons">save</i> 
									</button>
									<a href="?del_item=<?php echo $_GET["item"];?>">
										<button class="btn bg-red waves-effect pull-right" type="button" name="del" value="Delete">
										<i class="material-icons">delete</i> 
									</button>
									</a>
									
								</div>
								
								
								
						</form>
                        	
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

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>
</html>