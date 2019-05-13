<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(7);


?>


<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-Returning")?>

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
                              Return an Item
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
                        
                        	<form action="" method="post">

								   <div class="row clearfix">
									   
									    <div class="col-sm-8">
										  <div class="form-group">
											<div class="form-line">
												 <input type="text" name="transaction_id" class="form-control" required autofocus placeholder="Transaction ID" autocomplete="off">
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

                    <?php
                        if (isset($_POST['submit'])) {

                            $transaction_id = sanitize($_POST['transaction_id']);

                            $query = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_payment_analysis WHERE tid = '$transaction_id' ");
                            $query1 = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = '$transaction_id' ");

                            if (mysql_num_rows($query)>0 && mysql_num_rows($query1)>0){

                                    $row = mysql_fetch_array($query);

                                    $trans_id = $row["tid"];
                                    $amount = $row["amount"];
                                    $cash_amount = $row["cash"];
                                    $pos_amount = $row["pos"];
                                    $transfer_amount = $row["transfer"];
                                    $balance = $row["balance"];
                    
                    
                            }else {
                                echo "<div class='alert alert-danger' role='alert'> Invalid Transaction ID </div>";
                            }

                        }
                    ?>

                    <div class="card">
                       
                        <div class="header">
                            <h2>
                              Transaction Details
                                <small></small>
                            </h2>
                        </div>
                        <div class="body">
                        
                        <div class="row">

                            <div class="col-lg-6">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Item</th>
                                        <th>Selling Price</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                    </tr> 
                                    <tr>
                                        <?php

                                            if (isset($_POST['submit'])) {

                                            $query2 = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = '$transaction_id' ");

                                            if (mysql_num_rows($query2)>0){

                                                while($row = mysql_fetch_array($query2)){

                                                    $item_id = $row["item_id"];
                                                    $item_name = getTableData("111_items", "item_id", "$item_id", "name");
                                                    $sold_price = $row["sold_price"];
                                                    $quantity = $row["qty"];
                                                    $date = $row["date"];
                                                    
                                                    echo "<tr><td>$item_name</td><td>$sold_price</td><td>$quantity</td><td>$date</td></tr>";
                                                }
                                    
                                            }
                                        }
                                        ?>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-lg-6">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <td>Total Cash Sales: </td>
                                        <td><?php if(isset($cash_amount)){echo "NGN". number_format($cash_amount);}else{echo "NGN 0";} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total POS Sales: </td>
                                        <td><?php if(isset($pos_amount)){echo "NGN". number_format($pos_amount);}else{echo "NGN 0";} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Transfer Sales: </td>
                                        <td><?php if(isset($transfer_amount)){echo "NGN". number_format($transfer_amount);}else{echo "NGN 0";} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Debt: </td>
                                        <td><?php if(isset($balance)){echo "NGN". number_format($balance);}else{echo "NGN 0";} ?></td>
                                    </tr>
                                </table>
                            </div>
                            <form method = "POST" action = "">
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="reason" class="form-control" required autofocus placeholder="Reason for Returning" autocomplete="off">
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="trans_id" value=<?php if(isset($trans_id)){echo $trans_id;}?> >
                                <div class="icon-and-text-button-demo">
                                    <button class="btn bg-green waves-effect" type="submit" name="reverse" value="Reverse">
                                        <i class="material-icons">save</i> 
                                    </button>
                                </div>
                            </form>
                            <?php 
                                if(isset($_POST["reverse"])){
                                    
                                    $trans_id = sanitize($_POST["trans_id"]);
                                    $reason = sanitize($_POST["reason"]);

                                    if(!empty($trans_id) && !empty($reason)){

                                        //Used to check if valid trans_id because trans_id is from hidden field and user can alter the value
                                        $check = mysql_num_rows(mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_payment_analysis WHERE tid = '$trans_id' "));
                                        $check1 = mysql_num_rows(mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = '$trans_id' "));
                                        
                                        //Used to check if transaction return already initialized
                                        $check2 = mysql_num_rows(mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_return WHERE trans_id = '$trans_id' "));

                                        if ($check > 0 && $check1 > 0) {

                                            if ($check2 == 0) {
                                                
                                                if(insertReturn($trans_id,$reason)){

                                                    echo "<div class='alert alert-success' role='alert'> Transaction Successfull and Awaiting Approval </div>";
    
                                                }else {
    
                                                    echo "<div class='alert alert-danger' role='alert'> Unable to Insert record </div>";
    
                                                }

                                            }else{
                                                echo "<div class='alert alert-danger' role='alert'> Transaction Already Processed </div>";
                                            }

                                           
                                        } else {

                                            echo "<div class='alert alert-danger' role='alert'> Transaction does not exist </div>";
                                        }
                                        
                                    }else{
                                        echo "<div class='alert alert-danger' role='alert'> An Error Occurred </div>";
                                    }

                                }
                            ?>
                        </div>
                        	
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