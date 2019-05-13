<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(6);

?>
<!DOCTYPE html>
<html>

<head>
<?php links("UIS-Add Suppliers"); ?>
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
                              Add Supplier
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
								
									
									$full_name = sanitize(strtoupper($_POST["fullname"]));
									$address = sanitize(strtoupper($_POST["address"]));
									$pnum = sanitize(strtoupper($_POST["pnum"]));
									
									
									$user = $_SESSION["cur_user"];
									$date = date("Y-m-d");
									
									
								if ($full_name and $address and $pnum ){
									
									$query = mysql_query("insert into ".$_SESSION["business_id"]."_suppliers values('','$full_name','$address','$pnum','0','0')");
									
									$customer_id  = mysql_insert_id();
									
									if ($query) { echo "<div class='alert alert-success' role='alert'>Customer Added Successfully [$customer_id]</div>"; }
									else { echo "<div class='alert alert-danger' role='alert'>Operation Failed, try again</div>";}
								} else { echo "<div class='alert alert-danger' role='alert'>Fill all * fields</div>";}
							}
						?>
                        	<form action="" method="post">

								<div class="row clearfix">
									   <div class="col-sm-8">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="fullname" class="form-control" required autofocus placeholder="Full Name *" />
											</div>
										  </div>
									   </div>
									  
								   </div>
								   
								   <div class="row clearfix">
									   <div class="col-sm-8">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="address" class="form-control" required placeholder="Address *" />
											</div>
										  </div>
									   </div>
									  
								   </div>
								   <div class="row clearfix">
									   <div class="col-sm-8">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="pnum" class="form-control" required placeholder="Phone Number*" />
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
                                Added Suppliers List
                                <small>List of Suppliers</small>
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
                      			<th>SN</th><th>Customer ID</th><th>Full Name</th><th>Address</th><th>Phone</th> <th>Total Supply</th>
                      		</tr>
                      	</thead>
                      	<tbody>
                      			<?php
							
								$fetch_query = mysql_query("select * from ".$_SESSION["business_id"]."_suppliers order by `total_credit` DESC");
								
							if (mysql_num_rows($fetch_query)>0){
									$sn=1;
								
									for($i=0; $i<mysql_num_rows($fetch_query); $i++){
										$rec = mysql_fetch_array($fetch_query);
											
											$fetched_id = $rec["ID"]; $fetch_customer_name = $rec["full_name"];
										
                                        $fetch_phone = $rec["phone"]; $fetch_address = $rec["address"];
                                        $fetch_credit = $rec["total_credit"];
                                        $fetch_debt = $rec["total_debt"]; 
                                        $customer_debt = $fetch_credit - $fetch_debt;
										
										echo "<tr><td>$sn</td> <td><a href=''>$fetched_id</a></td> <td>$fetch_customer_name</td> <td>$fetch_address</td> <td>$fetch_phone</td> <td>
										" .number_format($customer_credit)."
										</td> </tr>";
										$sn++;
									}
								
								}
							?>
                      	</tbody>
                      	<tfoot>
                        		
                        		<tr>
                      			<th>SN</th><th>Customer ID</th><th>Full Name</th><th>Address</th><th>Phone</th> <th>Total Supply</th>
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