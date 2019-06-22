<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");  
protectPage(4);
if($_SESSION["clearance"]==5) {header("Location: index.php");}
?>
<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-Add Items")?>

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
                              Add Item
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
								
									
									$item_name = sanitize(strtoupper($_POST["itemName"]));
									$cat = sanitize(strtoupper($_POST["cat"]));
									$qty = sanitize(strtoupper($_POST["qty"]));
									
									$cost_price = sanitize(strtoupper($_POST["cost_price"]));
                                    $sale_price = sanitize(strtoupper($_POST["sale_price"]));
                                    
                                    if ($sale_price > $cost_price) {
                                        
                                        $item_code = sanitize(strtoupper($_POST["itemCode"]));
									
                                        $user = $_SESSION["cur_user"];
                                        $date = date("Y-m-d");
                                        
                                        
                                        if ($item_name and $cat and $cost_price and $sale_price){

                                            $stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_items (`item_id`, `name`, `qty`, `cost_price`, `sale_price`, `cat_id`, `med_id`, `date`, `status`, `barcode`) VALUES (:item_id, :name, :qty, :cost_price, :sale_price, :cat_id, :med_id, :date, :status, :barcode) ");
                                            $query = $stmt->execute(['item_id' => "", 'name' => $item_name, 'qty' => $qty, 'cost_price' => $cost_price, 'sale_price' => $sale_price, 'cat_id' => $cat, 'med_id' => "", 'date' => $date, 'status' => 1, 'barcode' => $item_code ]);
				
                                            if ($query) { 
                                                echo "<div class='alert alert-success' role='alert'>Item Added Successfully</div>"; 
                                            }else {
                                                echo "<div class='alert alert-danger' role='alert'>Operation Failed, try again</div>";
                                            }

                                        }else {
                                             echo "<div class='alert alert-danger' role='alert'>Fill all * fields</div>";
                                        }

								    }else {
                                        echo "<div class='alert alert-danger' role='alert'>Sale Price must be more than Cost Price</div>";
                                    }
							}
						?>
                        	<form action="" method="post">

								<div class="row clearfix">
									   <div class="col-sm-8">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="itemName" class="form-control" required autofocus placeholder="Item Name *" autocomplete="off">
											</div>
										  </div>
									   </div>
									   <div class="col-sm-4">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="itemCode" class="form-control" placeholder="Bar Code" autocomplete="off">
											</div>
										  </div>
									   </div>
								   </div>
								   
								   <div class="row clearfix">
														<div class="col-sm-3">
															<select class="form-control show-tick" name="cat" data-live-search="true">
																<option value="">-- Category * --</option>
																<?php list_categories();?>
															</select>
														</div>
									   
									   <div class="col-sm-3">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="cost_price" class="form-control" placeholder="Cost Price *" autocomplete="off">
												 
											</div>
											
										  </div>
									   </div>
								   
									   <div class="col-sm-3">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" name="sale_price" class="form-control" placeholder="Sale Price *" autocomplete="off">
												
											</div>
										  </div>
									   </div>
								  
									   <div class="col-sm-3">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="qty" class="form-control" placeholder="quantity *" autocomplete="off">
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
				
                
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="card">
                    	 <div class="header">
                            <h2>
                                Recent Items List
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
                        	
							
                      <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                      	<thead>
                      		<tr>
                      			<th>SN</th><th>Item Name</th><th>Qty</th><th width="200">Cost Price</th> <th>Sale Price</th> <th>Group </th>
                      		</tr>
                      	</thead>
                      	<tbody>
                        <?php
                            $total_cost = 0;
                            $total_qty = 0;
                            $total_sale = 0;

                            $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items WHERE status = 1 ORDER BY item_id ASC");
                            $stmt->execute();

                            $rows = $stmt->rowCount();

                            if ($rows>0){
                                $sn=1;
                            
                                for($i=0; $i<$rows; $i++){

                                    $row = $stmt->fetch();
                                        
                                    $fetched_id = $row->item_id; 
                                    $fetch_item_name = $row->name;
                                    $fetch_cost_price = $row->cost_price;
                                    $fetch_sale_price = $row->sale_price;
                                    $fetch_item_qty = $row->qty; 
                                    $fetched_cat = getCategories($row->cat_id);
                                    
                                    $total_cost += $fetch_cost_price * $fetch_item_qty;
                                    $total_qty += $fetch_item_qty;
                                    echo "<tr><td>$sn</td> <td><a href='update_item.php?item=$fetched_id'>$fetch_item_name</a></td> <td>$fetch_item_qty</td> <td>".number_format($fetch_cost_price)."</td> <td>" .number_format($fetch_sale_price)."</td> <td>
                                    $fetched_cat
                                    </td> </tr>";
                                    $sn++;
                                }
								
								echo "<tr>
                      			<th> </th><th> Total </th><th>".number_format($total_qty)."</th><th> NGN".number_format($total_cost)."</th> <th></th> <th>  </th>
                      		</tr>";
								
							}
						?>
                      	</tbody>
                      	<tfoot>
                                        <tr>
                                           <th>SN</th><th>Total </th><th><?php echo number_format($total_qty); ?> </th><th><?php echo "NGN".number_format($total_cost); ?></th> <th> </th> <th> </th>
                                        </tr>
                                    </tfoot>
                      </table>
                      
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