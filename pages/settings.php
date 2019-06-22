<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");  
protectPage(9);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <?php links(); ?>
    !-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
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
                               Setting Company Information
                               
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
								
									
									$post_item_id = sanitize(strtoupper($_POST["item_id"]));
									$post_qty = sanitize(strtoupper($_POST["qty"]));
									$date = date("Y-m-d");
									
									
								if ($post_qty and $post_item_id){

                                    $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_items SET qty = qty + :post_qty, date = :date WHERE id = :post_item_id ");
                                    $query = $stmt->execute(['post_qty' => $post_qty, 'date' => $date, 'post_item_id'=> $post_item_id]);
                                    
                                    //loggin
                                    $stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_st_items (`id`, `item`, `qty`, `date`, `user`, `timeStamp`) VALUES (:id,:item,:qty,:date,:user,NOW() ) ");
				                    $loggin = $stmt->execute(['id' => "", 'item' => $post_item_id, 'qty' => $post_qty, 'date' => $date, 'user' => $_SESSION["cur_user"] ]);
				
									if ($query) { echo "<div class='alert alert-success' role='alert'>Stock updated Successfully</div>";}
									else { echo "<div class='alert alert-danger' role='alert'>Operation Failed, try again</div>";}
								} else { echo "<div class='alert alert-danger' role='alert'>Fill all * fields</div>";}
								
							}
						?>
                        	<form action="" method="post">

						<div class="row clearfix">				
									   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" name="ompanyName" id="" class="form-control" placeholder="Company Name *" />
												
											</div>
										  </div>
									   </div>
						 </div>   
						
					   <div class="row clearfix">				
									   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" name="address" class="form-control" placeholder="Address *" />
												
											</div>
										  </div>
									   </div>
						 </div>
					   
					   <div class="row clearfix">				
									   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" name="phone1"  class="form-control" placeholder="Phone Number 1 *" />
												
											</div>
										  </div>
									   </div>
						 </div>
					   
					   <div class="row clearfix">				
									   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" name="phone2" class="form-control" placeholder="Phone Number 2" />
												
											</div>
										  </div>
									   </div>
						 </div>
						 
						 <div class="row clearfix">				
									   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" name="website" class="form-control" placeholder="Website" />
												
											</div>
										  </div>
									   </div>
						 </div>
						 
						 <div class="row clearfix">				
									   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="text" name="emailAddress" class="form-control" placeholder="Email Address"/>
												
											</div>
										  </div>
									   </div>
						 </div>
					   
					   <div class="row clearfix">				
									   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										  <div class="form-group">
											
											<div class="form-line">
												 <input type="file" name="logo" class="form-control" placeholder="Upload Logo *" />
												
											</div>
										  </div>
									   </div>
						 </div>
						   
								<div class="icon-button-demo">
									<button class="btn bg-green waves-effect" type="submit" name="submit">
										<i class="material-icons">save</i> 
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
                                Business Information
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
                        	
							
                      <table class="table">
                      	<thead>
                      		<tr>
                      			<th>SN</th><th>Item NAme</th><th>QTY</th>
                      		</tr>
                      	</thead>
                      	<tbody>
                        <?php
                            
                            $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items ORDER BY `date` DESC LIMIT 20");
                            $stmt->execute();

                            $rows = $stmt->rowCount();

                            if ($rows>0){
                                $sn=1;
                                for($i=0; $i<$rows; $i++){
                                    
                                    $row = $stmt->fetch();
                                        
                                    $fetched_cat_id = $row->id; 
                                    $fetch_name = $row->name; 
                                    $fetch_qty = $row->qty;
                                    
                                    
                                    //echo "<tr><td>$sn</td> <td>$fetch_name</td> <td>$fetch_qty</td> </tr>";
                                    $sn++;
                                }
                            }
						?>
                      	</tbody>
                      	
                      </table>
                       
                        </div>
                    	
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                    
                    <div class="card">
                    	 <div class="header">
                            <h2>
                                Registered Company Profile
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
                        	
							
                      <table class="table">
                      	<thead>
                      		<tr>
                      			<th>SN</th><th>Item NAme</th><th>QTY</th>
                      		</tr>
                      	</thead>
                      	<tbody>
                        <?php

                            $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items ORDER BY `date` DESC LIMIT 20");
                            $stmt->execute();

                            $rows = $stmt->rowCount();

                            if ($rows>0){
                                $sn=1;
                                for($i=0; $i<$rows; $i++){
                                    
                                    $row = $stmt->fetch();
                                        
                                    $fetched_cat_id = $row->id; 
                                    $fetch_name = $row->name; 
                                    $fetch_qty = $row->qty;
                                    
                                    //echo "<tr><td>$sn</td> <td>$fetch_name</td> <td>$fetch_qty</td> </tr>";
                                    $sn++;
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
    
    <!--custom jscript-->
    <script src="stock.js"></script>
</body>
</html>