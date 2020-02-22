<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(7);
if($_SESSION["clearance"]==6) {header("Location: index.php");}
?>
<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-Subscription")?>

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
           
            <div class="row clearfix">
                    
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                                Bronze (NGN200/day)
                            </h2>
                            
                        </div>
                        <div class="body">
                                <div class="list-group" style="font-weight: 600">
                                <ul>
                                    <br>
                                    <li>Variable Sales Price</li>
                                    <li>Create Multiple Users</li>
                                    <li>Manage Customers</li>
                                    <li>Manage Debts</li>
                                    <li>Make Sales</li>
                                    <li>Sales Report</li>
                                    <li>Business Closing Notification</li>
                                    <br>
                                </ul>
                            </div>
                            <button class="btn btn-block bg-green waves-effect"  type="button" onClick='subscription("bronze")'>
                                <i class="material-icons">print</i> <span>Subscribe</span>
                            </button>
                        </div>
                    </div>
                </div>
                    
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                                Silver (NGN5,000/Month)
                            </h2>
                            
                        </div>
                        <div class="body">
                                <div class="list-group" style="font-weight: 600">
                                <ul>
                                    <br>
                                    <li>Variable Sales Price</li>
                                    <li>Create Multiple Users</li>
                                    <li>Manage Customers</li>
                                    <li>Manage Debts</li>
                                    <li>Make Sales</li>
                                    <li>Sales Report</li>
                                    <li>Business Closing Notification</li>
                                    <br>
                                </ul>
                            </div>
                            <button class="btn btn-block bg-green waves-effect"  type="button" onClick='subscription("silver")'>
                                <i class="material-icons">print</i> <span>Subscribe</span>
                            </button>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                                Gold (NGN23,000/Month)
                            </h2>
                            
                        </div>
                        <div class="body">
                                <div class="list-group" style="font-weight: 600">
                                <ul>
                                    <li><h4>1 Operating Staff</h4></li>
                                    <li>Variable Sales Price</li>
                                    <li>Create Multiple Users</li>
                                    <li>Manage Customers</li>
                                    <li>Manage Debts</li>
                                    <li>Make Sales</li>
                                    <li>Sales Report</li>
                                    <li>Business Closing Notification</li>
                                </ul>
                            </div>
                            <button class="btn btn-block bg-green waves-effect"  type="button" onClick='subscription("gold")'>
                                <i class="material-icons">print</i> <span>Subscribe</span>
                            </button>
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
                                PREVIOUS SUBSCRIPTIONS 
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Amount Paid</th>
                                            <th>Purpose</th>
                                            <th>Status</th>
                                            <th>Approval Date</th>
                                            <th>Subscription Date</th>
                                            <th>Expiry Date</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php

                                            $user = $_SESSION["cur_user"];
                                            $businessId = $_SESSION["business_id"];

                                            $stmt = $conn->prepare("SELECT * FROM transactions_trn WHERE payee = :businessId ");
                                            $stmt->execute(['businessId' => $businessId]);

                                            $rows = $stmt->rowCount();
                                                        
                                            if($rows>0){

                                                $sn = 1; 

                                                for($i=0; $i<$rows; $i++){

                                                    $row = $stmt->fetch();
                                        
                                                    $id = $row->id; 
                                                    $amountPaid =  $row->amountPaid;
                                                    $purposeCode =  $row->purposeCode;
                                                    $approvalStatus =  $row->approvalStatus;
                                                    $approvalDate =  $row->approvalDate;
                                                    $table = "license_hst";
                                                    $subscriptionDate = getTableData($table, "transactionID", "$id", "subscriptionDate");
                                                    $expiryDate = getTableData($table, "transactionID", "$id", "expiryDate");

                                                    echo "<tr>
                                                            <td>$sn</td>
                                                            <td>$amountPaid</td>
                                                            <td>$purposeCode</td>
                                                            <td>$approvalStatus</td>
                                                            <td>$approvalDate</td>
                                                            <td>$subscriptionDate</td>
                                                            <td>$expiryDate</td>
                                                        </tr>
                                                    ";
                                                    $sn+=1;
                                                }
                                                
                                            }else{
                                                    echo "<div class='alert alert-warning'>No Previous Transaction History</div>";
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
            
        
          <div id="details">
          
          </div>
            
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
    
   
    <script>
     // $(document).ready(function() {

        function subscription(type) {
            $.ajax({
                url: "modal_subscription.php",
                type: "post",
                data: {type : type},
                success: function(response){
                    $("#details").html(response);
                    $("#modaldetails").modal({backdrop:'static'});
                }
            });
        }
		 
     // });
    </script>
    
    
    
</body>

</html>