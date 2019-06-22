<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");  
protectPage(6);
?>

<!DOCTYPE html>
<html>

<head>
    
    <?php links("UIS-Categories"); ?>
    
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
                               Items Categories
                               
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
								
									
									$cat_name = sanitize(strtoupper($_POST["parent_name"]));
									
									
									
								if ($cat_name){

                                    $stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_categories (`id`,`name`) VALUES (:id,:name) ");
					                $query = $stmt->execute(['id' => "",'name' => $cat_name]);
				
									if ($query) { echo "<div class='alert alert-success' role='alert'>Category added Successfully</div>";}
									else { echo "<div class='alert alert-danger' role='alert'>Operation Failed, try again</div>";}
								} else { echo "<div class='alert alert-danger' role='alert'>Fill all * fields</div>";}
							}
						?>
                        	<form action="" method="post">

								<div class="row clearfix">
									   <div class="col-sm-12">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="parent_name" class="form-control" placeholder="Category Name " />
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
                                Categories List
                                <small>List of categories</small>
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
                      			<td>SN</td><td>Category Name</td>
                      		</tr>
                      	</thead>
                      	<tbody>
                      			<?php
                            
                                    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_categories  ORDER BY id DESC");
                                    $stmt->execute();

                                    $rows = $stmt->rowCount();

                                    if ($rows>0){
                                        $sn=1;
                                        for($i=0; $i<$rows; $i++){
                                            
                                            $row = $stmt->fetch();
                                                
                                            $fetched_cat_id = $row->id; 
                                            $fetch_name = $row->name;
                                            
                                            
                                            echo "<tr><td>$sn</td> <td><a href='?id=2&ref=$fetched_cat_id'>$fetch_name </a></td> </tr>";
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
</body>
</html>