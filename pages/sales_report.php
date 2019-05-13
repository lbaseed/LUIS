<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(5);
if($_SESSION["clearance"]==6) {header("Location: index.php");}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sales Report</title>
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
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <?php search_bar();?>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <?php top_bar(); ?>
    
    <!-- #left Bar -->
    <?php navigation_left();?>
    
    

    <section class="content">
        <div class="container-fluid">
            
           
            
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
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    	<tr>
                                           	<th>SN</th>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>Total Sales (N)</th>
                                            <th>Profit (N)</th>
                                            <th>Date &nbsp &nbsp &nbsp</th>
                                            <th>Cashier</th>
                                            <th> </th>
                                        </tr>
                                    </tfoot>
                                   
                                    <tbody>
                                        
                                        <?php
											
										if(isset($_GET["submit"])){
											
											//search sales record
											$user = sanitize($_GET["user"]);
											$dt = split(":",sanitize($_GET["date"]));
											
								        if ($user and $dt){
									
								
											$dt1 = trim($dt[0]);  
											$dt2 = trim($dt[1]);
											$grand_total = 0;
											$total_profit = 0;
										if($user=="ALL"){ 
											$get_records = mysql_query("select * from ".$_SESSION["business_id"]."_trans where date BETWEEN '$dt1' AND '$dt2' order by `date` DESC");
										} else {
											
											$get_records = mysql_query("select * from ".$_SESSION["business_id"]."_trans where cashier='$user' and date BETWEEN '$dt1' AND '$dt2' order by `date` DESC");
                                        }	
                                        
											
                                            
                                        
											if(mysql_num_rows($get_records)>0){
												$sn = 1; 
												for($i=0; $i<mysql_num_rows($get_records); $i++){
													$rec = mysql_fetch_array($get_records);
													
													$tid = $rec["tid"]; $total_sales = $rec["total_sales"];
													$cid = $rec["cid"];
													if ($cid>0){ $type = get_customer($cid);  } else { $type = "Walk in Customer"; }
													
													$date = $rec["date"];
													$cashier = $rec["cashier"]; 
													$profit = get_profit($tid);
													
													//summation of total sales and profit
													$grand_total +=$total_sales;
													$total_profit += $profit;
													
													echo "<tr>
															<td>$sn</td>
															<td> <a href=''>$tid</a> </td>
															
															<td>$type</td>
															<td>". number_format($total_sales)."</td>
															<td>".number_format($profit)."</td>
															<td>$date</td>
															<td>$cashier</td>
															<td> <button type='button' class='btn bg-default waves-effect' onClick='full_receipt($tid, $cid)'> 
															<i class='material-icons'>assignment</i>
															</button> </td>
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
            <!-- #END# Exportable Table -->
            
            <!--print receipt css-->
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
            
            <!-- full Size Receipt modal-->
            
        </div>
    </section>
    
    
    		

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="../js/moment/moment.min.js"></script>
    <script src="../js/datepicker/daterangepicker.js"></script>
    
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
    
    <script src="../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
    
    
   
    
    <!--sales report JS-->
   <script src="sales_report.js"></script>
   
    <script>
      
		
      $(document).ready(function() {
        $('#reservation').daterangepicker({format: 'YYYY-MM-DD'}, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
		 
        });
      });
		
    </script>
    
    
    
</body>

</html>