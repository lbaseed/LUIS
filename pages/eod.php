<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(5);
if($_SESSION["clearance"]==6) {header("Location: index.php");}
?>


<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-End of Day")?>

    <!-- Bootstrap Material Datetime Picker Css -->
    <!-- Custom Css -->
    <link href="../css/custom.min.css" rel="stylesheet">
    <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    
    <!--data tables-->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Wait Me Css -->
    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    
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
                              END OF DAY
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
                        
                        	<form action="" method="get">

								
								   
								   <div class="row clearfix">
                                        <div class="col-sm-3">
                                            <select class="form-control show-tick" name="cat" data-live-search="true">
                                                <option value="">-- Category * --</option>
                                                <option value="all">All</option>
                                                <?php list_categories();?>
                                            </select>
                                        </div>
									   
									   
									   <div class="col-sm-3">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="date" class="form-control" placeholder="Date *" id="reservation" />
											</div>
										  </div>
									   </div>
									   
									   <div class="icon-and-text-button-demo">
									<button class="btn bg-green waves-effect" type="submit" name="submit" value="go">
										<i class="material-icons">search</i> 
									</button>
								</div>
								
							</div>
						  
								
								
						</form>
                        	
                        </div>
                    </div>
                    
                </div>
				
                
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="card">
                    	<div class="header">
                            <h2>
                               End of Day Display
                                <small></small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" onClick="eodPlatform();">Print</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>

                                    <div id="printEOD"> 
                                        <div class="body table-responsive">
                                        
                                            <div class="row clearfix">
                                                
                                                   
                                                    <div class="col-xs-4">
                                                        <h2>Date: <?php if(isset($_GET['date'])){ echo $_GET['date']; } 
                                                        

                                                        $date = split(':', $_GET['date']);
                                                        $date1 = trim($date[0]);
                                                        $date2 = trim($date[1]);

                                                        $cat = $_GET['cat'];

                                                            ?></h2>

                                                            
                                                    </div>

                                                    <div class="col-xs-4">
                                                        <h2>Category: <?php if(isset($_GET['cat'])){
                                                            

                                                            if(($_GET['cat']) === 'all') {
                                                                echo "ALL";
                                                            }else{
                                                                echo getCategories($_GET['cat']);
                                                            }
                                                        }
                                                            ?></h2>
                                                    </div>
                                                    
                                                    <!--
                                                    <div class="col-xs-4">
                                                        <h2 id="tsales">Total Sales: <?php echo "NGN ".number_format($cash = getTotalSalesType(4, $date1, $date2)); ?>  </h2>
                                                    </div>
                                                    -->
                                                    
                                               

                                                <hr>

                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Sales</th>
                                                            <th>Deposites and Paymback</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            
                                                            <td>

                                                                    <table class="table table-striped table-hover">
                                                                        <tr>
                                                                            <td>Total Cash Sales: </td>
                                                                            <td><?php echo "NGN ".number_format($cash = getTotalSalesType(1, $date1, $date2)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total POS Sales: </td>
                                                                            <td><?php echo "NGN ".number_format($pos = getTotalSalesType(2, $date1, $date2)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Transfer Sales: </td>
                                                                            <td><?php echo "NGN ".number_format($trnf =  getTotalSalesType(3, $date1, $date2)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Revenue: </td>
                                                                            <td><?php echo "NGN ".number_format($cash + $pos + $trnf) ; ?></td>
                                                                        </tr>
                                                                    </table>

                                                            </td>
                                                            <td>
                                                                    <table class="table table-striped table-hover">
                                                                        <tr>
                                                                            <td>Total Cash Deposites/Payback: </td>
                                                                            <td><?php echo "NGN ".number_format($depo_cash = getDailyDeposites($date1, $date2, "cash","")); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total POS Deposites/Payback: </td>
                                                                            <td><?php echo "NGN ".number_format($depo_pos = getDailyDeposites($date1, $date2, "pos","")); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Transfer Deposites/Payback: </td>
                                                                            <td><?php echo "NGN ".number_format($depo_trnf =  getDailyDeposites($date1, $date2, "transfer","")); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Deposites/Payback: </td>
                                                                            <td><?php echo "NGN ".number_format($depo_cash + $depo_pos + $depo_trnf) ; ?></td>
                                                                        </tr>
                                                                    </table>
                                                            
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="row clearfix"></div>

                                                <hr>       
                                            </div>

                                                <?php  if(empty($_GET) === false): ?>

                                                    <?php if(empty($_GET['cat'] == false) && empty($_GET['date'] == false)): ?>

                                                        <table class="table  table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>SN</th><th width="200">Category</th> <th>Total Sales</th> <th>Profit </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <?php

                                                                    
                                                                    
                                                                    $total_cost = 0;
                                                                    $total_qty = 0;
                                                                    $total_sale = 0;

                                                                    switch ($cat) {
                                                                        case 'all':
                                                                            $fetch_query_all = mysql_query("select * from ".$_SESSION["business_id"]."_categories");
                                                                            if (mysql_num_rows($fetch_query_all)>0){
                                                                                $sn=1;
                                                                            
                                                                                for($i=0; $i<mysql_num_rows($fetch_query_all); $i++){
                                                                                    $rec = mysql_fetch_array($fetch_query_all);
                                                                                        
                                                                                    $fetched_id = $rec["id"]; 
                                                                                    $fetch_cat_name = $rec["name"];
                                                                                    
                                                                                    $total_cat_sales = 0;
                                                                                    $total_cat_profit = 0;
                                                                                    $total = 0;
                                                                                    $total_profit = 0;
                                                                                    
                                                                                    
                                                                                    $q =  mysql_query("select * from  ".$_SESSION["business_id"]."_sales WHERE date BETWEEN '$date1' AND '$date2' and status <> 'returned' ");
                                                                                    
                                                                                    if (mysql_num_rows($q)>0) {
                                                                                        
                                                                                        while($row = mysql_fetch_array($q)){
                                                                                            
                                                                                            $item = $row["item_id"];
                                                                                            $tbl = $_SESSION["business_id"]."_items";
                                                                                            
                                                                                            $cat = getTableData($tbl, "item_id", $item, "cat_id");
                                                                                            
                                                                                            $total += ($row["sold_price"] * $row["qty"]) ;
                                                                                            
                                                                                            $total_profit += ($row["sold_price"] - $row["cost_price"]) * $row["qty"];
                                    
                                                                                            if ($fetched_id == $cat){
                                                                                            
                                                                                                $sub_sold_price = $row["sold_price"]; 
                                                                                                $sub_cost_price = $row["cost_price"];
                                                                                                $sub_qty = $row["qty"];
                                                                                                
                                                                                                $cat_profit = ($sub_sold_price - $sub_cost_price) * $sub_qty;
                                                                                                
                                                                                                $total_cat_sales += ($sub_sold_price * $sub_qty);
                                                                                                $total_cat_profit += $cat_profit;
                                                                                                
                                                                                            }
                                                                                            
                                    
                                                                                        }
                                    
                                                                                    }
                                                                                    
                                                                                    
                                                                                    //display categories and totals table
                                                                                    
                                                                                    echo "<tr><td>$sn</td><td width=200>$fetch_cat_name</td> <td>".number_format($total_cat_sales)."</td> <td>".number_format($total_cat_profit)."</td></tr>";
                                                                                    $sn++;
                                                                                    
                                                                                }
                                                                            }
                                                                        break;
                                                                        default:
                                                                            $fetch_query = mysql_query("select * from ".$_SESSION["business_id"]."_categories WHERE id = '$cat'");
                                                                            if (mysql_num_rows($fetch_query)>0){
                                                                                $sn=1;
                                                                            
                                                                            
                                                                                    $rec = mysql_fetch_array($fetch_query);
                                                                                        
                                                                                    $fetched_id = $rec["id"]; 
                                                                                    $fetch_cat_name = $rec["name"];
                                                                                    
                                                                                    $total_cat_sales = 0;
                                                                                    $total_cat_profit = 0;
                                                                                    $total = 0;
                                                                                    $total_profit = 0;
                                                                                    
                                                                                    
                                                                                    $q =  mysql_query("select * from  ".$_SESSION["business_id"]."_sales WHERE date BETWEEN '$date1' AND '$date2' and status <> 'returned'");
                                                                                    
                                                                                    if (mysql_num_rows($q)>0) {
                                                                                        
                                                                                        for($i=0; $i<mysql_num_rows($q); $i++){

                                                                                            $row = mysql_fetch_array($q);
                                                                                            $item = $row["item_id"];
                                                                                            $tbl = $_SESSION["business_id"]."_items";
                                                                                            
                                                                                            $cat = getTableData($tbl, "item_id", $item, "cat_id");
                                                                                            
                                                                                            $total += ($row["sold_price"] * $row["qty"]) ;
                                    
                                                                                            if ($fetched_id == $cat){
                                                                                            
                                                                                                $sub_sold_price = $row["sold_price"]; 
                                                                                                $sub_cost_price = $row["cost_price"];
                                                                                                $sub_qty = $row["qty"];
                                                                                                
                                                                                                $cat_profit = ($sub_sold_price - $sub_cost_price) * $sub_qty;
                                                                                                
                                                                                                $total_cat_sales += ($sub_sold_price * $sub_qty);
                                                                                                $total_cat_profit += $cat_profit;
                                                                                                
                                                                                            }
                                                                                            
                                    
                                                                                        }
                                    
                                                                                    
                                                                                    
                                                                                    
                                                                                    //desiplay categories and totals table
                                                                                    
                                                                                    echo "<tr><td>$sn</td><td width=200>$fetch_cat_name</td> <td>".number_format($total_cat_sales)."</td> <td>".number_format($total_cat_profit)."</td></tr>";
                                                                                    $sn++;
                                                                                    
                                                                                }
                                                                            }
                                                                            break;
                                                                    }
                                                                
                                                                    //all categories query
                 
                                                                    
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                            <tr>
                                                                            <th>SN</th><th>Total </th><th><?php echo "NGN ".number_format($total); ?> </th><th><?php echo "NGN ".number_format($total_profit); ?></th> <th> </th> <th> </th>
                                                                            </tr>
                                                                        </tfoot>
                                                        </table>
                                                    <?php endif;?>
                                                <?php endif;?>
                                    
                                        </div>
                                    </div>
                    	
                    </div>
                </div>
            </div>
            
            <!--EOD modal code-->

            <div class="modal fade" id="eodModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="fullModalLabel">End of Day</h4>
                        </div>
                        
                        <div class="modal-body">

                        <div id="printEOD"> 
                                        <div class="body table-responsive">
                                        
                                            <div class="row clearfix">
                                                
                                                   
                                                    <div class="col-xs-4">
                                                        <h2>Date: <?php if(isset($_GET['date'])){ echo $_GET['date']; } 
                                                        

                                                        $date = split(':', $_GET['date']);
                                                        $date1 = trim($date[0]);
                                                        $date2 = trim($date[1]);

                                                        $cat = $_GET['cat'];

                                                            ?></h2>

                                                            
                                                    </div>

                                                    <div class="col-xs-4">
                                                        <h2>Category: <?php if(isset($_GET['cat'])){
                                                            

                                                            if(($_GET['cat']) === 'all') {
                                                                echo "ALL";
                                                            }else{
                                                                echo getCategories($_GET['cat']);
                                                            }
                                                        }
                                                            ?></h2>
                                                    </div>

                                                    
                                                    <!--
                                                    <div class="col-xs-4">
                                                        <h2 id="tsales">Total Sales: <?php echo "NGN ".number_format($cash = getTotalSalesType(4, $date1, $date2)); ?>  </h2>
                                                    </div>
                                                    -->
                                                    
                                               

                                                <hr>

                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Sales</th>
                                                            <th>Deposites and Paymback</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            
                                                            <td>

                                                                    <table class="table table-striped table-hover">
                                                                        <tr>
                                                                            <td>Total Cash Sales: </td>
                                                                            <td><?php echo "NGN ".number_format($cash = getTotalSalesType(1, $date1, $date2)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total POS Sales: </td>
                                                                            <td><?php echo "NGN ".number_format($pos = getTotalSalesType(2, $date1, $date2)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Transfer Sales: </td>
                                                                            <td><?php echo "NGN ".number_format($trnf =  getTotalSalesType(3, $date1, $date2)); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Revenue: </td>
                                                                            <td><?php echo "NGN ".number_format($cash + $pos + $trnf) ; ?></td>
                                                                        </tr>
                                                                    </table>

                                                            </td>
                                                            <td>
                                                                    <table class="table table-striped table-hover">
                                                                        <tr>
                                                                            <td>Total Cash Deposites/Payback: </td>
                                                                            <td><?php echo "NGN ".number_format($depo_cash = getDailyDeposites($date1, $date2, "cash","")); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total POS Deposites/Payback: </td>
                                                                            <td><?php echo "NGN ".number_format($depo_pos = getDailyDeposites($date1, $date2, "pos","")); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Transfer Deposites/Payback: </td>
                                                                            <td><?php echo "NGN ".number_format($depo_trnf =  getDailyDeposites($date1, $date2, "transfer","")); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Deposites/Payback: </td>
                                                                            <td><?php echo "NGN ".number_format($depo_cash + $depo_pos + $depo_trnf) ; ?></td>
                                                                        </tr>
                                                                    </table>
                                                            
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <div class="row clearfix"></div>

                                                <hr>       
                                            </div>

                                                <?php  if(empty($_GET) === false):?>

                                                    <?php if(empty($_GET['cat'] == false) && empty($_GET['date'] == false)): ?>

                                                        <table class="table  table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>SN</th><th width="200">Category</th> <th>Total Sales</th> <th>Profit </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <?php

                                                                    
                                                                    
                                                                    $total_cost = 0;
                                                                    $total_qty = 0;
                                                                    $total_sale = 0;

                                                                    switch ($cat) {
                                                                        case 'all':
                                                                        //all categories query
                                                                            $fetch_query_all = mysql_query("select * from ".$_SESSION["business_id"]."_categories");
                                                                            if (mysql_num_rows($fetch_query_all)>0){
                                                                                $sn=1;
                                                                            
                                                                                for($i=0; $i<mysql_num_rows($fetch_query_all); $i++){
                                                                                    $rec = mysql_fetch_array($fetch_query_all);
                                                                                        
                                                                                    $fetched_id = $rec["id"]; 
                                                                                    $fetch_cat_name = $rec["name"];
                                                                                    
                                                                                    $total_cat_sales = 0;
                                                                                    $total_cat_profit = 0;
                                                                                    $total = 0;
                                                                                    $total_profit = 0;
                                                                                    
                                                                                    
                                                                                    $q =  mysql_query("select * from  ".$_SESSION["business_id"]."_sales WHERE date BETWEEN '$date1' AND '$date2' and status <> 'returned'");
                                                                                    
                                                                                    if (mysql_num_rows($q)>0) {
                                                                                        
                                                                                        while($row = mysql_fetch_array($q)){
                                                                                            
                                                                                            $item = $row["item_id"];
                                                                                            $tbl = $_SESSION["business_id"]."_items";
                                                                                            
                                                                                            $cat = getTableData($tbl, "item_id", $item, "cat_id");
                                                                                            
                                                                                            $total += ($row["sold_price"] * $row["qty"]) ;
                                                                                            
                                                                                            $total_profit +=($row["sold_price"] - $row["cost_price"]) * $row["qty"];
                                    
                                                                                            if ($fetched_id == $cat){
                                                                                            
                                                                                                $sub_sold_price = $row["sold_price"]; 
                                                                                                $sub_cost_price = $row["cost_price"];
                                                                                                $sub_qty = $row["qty"];
                                                                                                
                                                                                                $cat_profit = ($sub_sold_price - $sub_cost_price) * $sub_qty;
                                                                                                
                                                                                                $total_cat_sales += ($sub_sold_price * $sub_qty);
                                                                                                $total_cat_profit += $cat_profit;
                                                                                                
                                                                                            }
                                                                                            
                                    
                                                                                        }
                                    
                                                                                    }
                                                                                    
                                                                                    
                                                                                    //desiplay categories and totals table
                                                                                    
                                                                                    echo "<tr><td>$sn</td><td width=200>$fetch_cat_name</td> <td>".number_format($total_cat_sales)."</td> <td>".number_format($total_cat_profit)."</td></tr>";
                                                                                    $sn++;
                                                                                    
                                                                                }
                                                                            }
                                                                        break;
                                                                        default:

                                                                        //selected category query
                                                                            $fetch_query = mysql_query("select * from ".$_SESSION["business_id"]."_categories WHERE id = '$cat'");
                                                                            if (mysql_num_rows($fetch_query)>0){
                                                                                $sn=1;
                                                                            
                                                                            
                                                                                    $rec = mysql_fetch_array($fetch_query);
                                                                                        
                                                                                    $fetched_id = $rec["id"]; 
                                                                                    $fetch_cat_name = $rec["name"];
                                                                                    
                                                                                    $total_cat_sales = 0;
                                                                                    $total_cat_profit = 0;
                                                                                    $total = 0;
                                                                                    $total_profit = 0;
                                                                                    
                                                                                    
                                                                                    $q =  mysql_query("select * from  ".$_SESSION["business_id"]."_sales WHERE date BETWEEN '$date1' AND '$date2' and status <> 'returned'");
                                                                                    
                                                                                    if (mysql_num_rows($q)>0) {
                                                                                        
                                                                                        for($i=0; $i<mysql_num_rows($q); $i++){

                                                                                            $row = mysql_fetch_array($q);
                                                                                            $item = $row["item_id"];
                                                                                            $tbl = $_SESSION["business_id"]."_items";
                                                                                            
                                                                                            $cat = getTableData($tbl, "item_id", $item, "cat_id");
                                                                                            
                                                                                            $total += ($row["sold_price"] * $row["qty"]) ;
                                    
                                                                                            if ($fetched_id == $cat){
                                                                                            
                                                                                                $sub_sold_price = $row["sold_price"]; 
                                                                                                $sub_cost_price = $row["cost_price"];
                                                                                                $sub_qty = $row["qty"];
                                                                                                
                                                                                                $cat_profit = ($sub_sold_price - $sub_cost_price) * $sub_qty;
                                                                                                
                                                                                                $total_cat_sales += ($sub_sold_price * $sub_qty);
                                                                                                $total_cat_profit += $cat_profit;
                                                                                                
                                                                                            }
                                                                                            
                                    
                                                                                        }
                                    
                                                                                    //desiplay categories and totals table
                                                                                    
                                                                                    echo "<tr><td>$sn</td><td width=200>$fetch_cat_name</td> <td>".number_format($total_cat_sales)."</td> <td>".number_format($total_cat_profit)."</td></tr>";
                                                                                    $sn++;
                                                                                    
                                                                                }
                                                                            }
                                                                            break;
                                                                    }
                                                                
                                                                
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                            <tr>
                                                                            <th>SN</th><th>Total </th><th><?php echo "NGN ".number_format($total); ?> </th><th><?php echo "NGN ".number_format($total_profit); ?></th> <th> </th> <th> </th>
                                                                            </tr>
                                                                        </tfoot>
                                                        </table>
                                                    <?php endif;?>
                                                <?php endif;?>
                                    
                                        </div>
                                    </div>                                       

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" id="modal_eod_print" onclick="printEOD('printEOD');" data-dismiss="modal">PRINT</button>
                            <button type="button" class="btn btn-link waves-effect" id="modal_eod_close" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>                                                    


            <!--End of modal-->

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
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>
    
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
    
     <script>
      
		
      $(document).ready(function() {
        $('#reservation').daterangepicker({format: 'YYYY-MM-DD'}, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
		 
        });
      });
        
      function printEOD(div) {

        // Create and insert new print section
        var elem = document.getElementById(div);
            var domClone = elem.cloneNode(true);
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            $printSection.appendChild(domClone);
            document.body.insertBefore($printSection, document.body.firstChild);

            window.print(); 

            // Clean up print section for future use
            var oldElem = document.getElementById("printSection");
            if (oldElem != null) { oldElem.parentNode.removeChild(oldElem); } 
                                //oldElem.remove() not supported by IE

            return true;

}

function eodPlatform(){
	
	$('#eodModal').modal({
        
        backdrop: 'static'
    });
    
}
    </script>
    
</body>

</html>