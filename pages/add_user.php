<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
$business_id = $_SESSION['business_id'];
protectPage(9);

?>
<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-Add Users")?>

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
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
            
            <!-- Input -->
            <div class="row clearfix">
				<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add User
                                
                            </h2>
                            
                        </div>
                        <div class="body">
                        
                        	<?php
									
							if(isset($_POST["submit"])){
								
								$fullName = sanitize($_POST["fullName"]);
                                $phone = sanitize($_POST["phone"]);
								$email = sanitize($_POST["email"]);
								$address = sanitize($_POST["address"]);
								$level = sanitize($_POST["level"]);
                                $active_status = "active";
                                $recover_status = "yes";
                                
								if($fullName and $level){
                                    
									$q = mysql_query("insert into ".$business_id."_users values('','$fullName','$phone','$email','$address','pass','$active_status','$recover_status','$level','','')");
									$user_id = mysql_insert_id();
									if($q){ echo "<div class='alert alert-success'>User Created Successfully. User ID: [$user_id] </div>";}
								}
								else {
									echo "<div class='alert alert-danger'>Fill all Necessary fields please</div>";
								}
							}
							?>
                        	<form action="" method="post">

									<div class="row clearfix">
									   <div class="col-sm-12">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" class="form-control" placeholder="Full Name" name="fullName" />
											</div>
										  </div>
									   </div>
								   </div>
								   <div class="row clearfix">
									   <div class="col-sm-12">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" class="form-control" placeholder="Phone Number" name="phone" />
											</div>
										  </div>
									   </div>
								   </div>
								
                                   <div class="row clearfix">
									   <div class="col-sm-12">
										  <div class="form-group">
											<div class="form-line">
												 <input type="email" class="form-control" placeholder="Email Address" name="email" />
											</div>
										  </div>
									   </div>
								   </div>

                                   <div class="row clearfix">
									   <div class="col-sm-12">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" class="form-control" placeholder="Address" name="address" />
											</div>
										  </div>
									   </div>
								   </div>
								   
								   <div class="row clearfix">
														<div class="col-sm-12">
															<select class="form-control show-tick" name="level">
																<option value="">-- Clearance --</option>
																<option value="9">Admin</option>
																<option value="7">Manager</option>
																<option value="6">Store Manager</option>
																<option value="5">Sales Manager</option>
																<option value="4">Store</option>
																<option value="3">Sales</option>
																
															</select>
														</div>
									   </div>

								  
								<div class="icon-and-text-button-demo">
									<button class="btn btn-primary waves-effect" type="submit" name="submit" value="submit">
										<i class="material-icons">save</i> <span>Add</span>
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
                                List of Users
                                <small>List of all registered users on the system</small>
                            </h2>
                            
                        </div>
                        <div class="body">
                        	
                        	<table class="table-bordered">
                        		<thead>
                        			<tr>
                        				<th>SN</th> <th>User ID</th>  <th>Full Name</th>  <th>Address</th>  <th>Phone Number</th> <th>Access Level</th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        				
                        				<?php 
								
							$query = mysql_query("select * from ".$business_id."_users ");
							if (mysql_num_rows($query)>0){
								$sn=1;
								for($i=0; $i<mysql_num_rows($query); $i++){
									
									$rec = mysql_fetch_array($query);
									
									$username = $rec["username"];  $fullname = $rec["fullname"];  $address = $rec["address"]; $phone = $rec["phone"];
									$access_lvl = $rec["clrs"];
																		
									
														switch ($access_lvl){
															case 3:
																$access = "Sales User";
																break;
															case 9:
																$access = "System Admin";
																break;
															case 7:
																$access = "Manager";
																break;
															case 4:
																$access = "Store User";
																break;
															case 5:
																$access = "Sales Manager";
																break;
															case 6: 
																$access = "Store Manager";
																break;
														}
									echo "<tr><td>$sn</td> <td>$username</td>  <td>$fullname</td>  <td>$address</td>  <td>$phone</td> <td>$access</td></tr>";
									$sn+=1;
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

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>
</html>