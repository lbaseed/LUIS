<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(7);
if($_SESSION["clearance"]==6) {header("Location: index.php");}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Return Approval</title>
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
           
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        RETURNED ITEMS AWAITING APPROVAL 
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Transaction ID</th>
                                    <th>Request By</th>
                                    <th>Request Date</th>
                                    <th>Details</th>
                                    <th>Approve</th>
                                    <th>Reject</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                
                                <?php

                                    $user = $_SESSION["cur_user"];
                                        
                                    $get_records = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_return WHERE status = 'awaitingapproval' ");
                                        
                                        if(mysql_num_rows($get_records)>0){

                                                $sn = 1; 
                                                for($i=0; $i<mysql_num_rows($get_records); $i++){

                                                    $row = mysql_fetch_array($get_records);
                                                    
                                                    $trans_id = $row["trans_id"]; 
                                                    $requestuser = $row['request_by'];
                                                    $tbl = $_SESSION["business_id"]."_users";
                                                    $requestby = getTableData($tbl, "username", "$requestuser", "fullname");
                                                    $requestdate   = $row["request_date"];

                                                    echo "<tr>
                                                            <td>$sn</td>
                                                            <td>$trans_id</td>
                                                            <td>$requestby</td>
                                                            <td>$requestdate</td>
                                                            <td> <button type='button' class='btn bg-default waves-effect' onClick='trandetails($trans_id)'> 
                                                            <i class='material-icons'>assignment</i>
                                                            </button> </td>
                                                            <td id = 'tdapprove_{$trans_id}'> <button type='button' class='btn bg-default waves-effect' id = 'approve_{$trans_id}' onClick='approve($trans_id, $user)'>Approve</button> </td>
                                                            <td id = 'tdreject_{$trans_id}'> <button type='button' class='btn bg-default waves-effect'  id = 'reject_{$trans_id}' onClick='reject($trans_id, $user)'>Reject</button> </td>
                                                            </tr>
                                                    ";
                                                    $sn+=1;
                                                }
                                                
                                                
                                            }else{
                                                    echo "<div class='alert alert-warning'>No Transaction Awaiting Approval</div>";
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

        function approve(trans_id, user) {

            $("#approve_"+trans_id).html("loading");

            $.ajax({
                url: "api/return_approval_action.php",
                type: "post",
                data: {action: 'approve',transaction_id : trans_id, user : user},
                success: function(response){

                    if (response == "ApprovalSuccess") {

                        $("#approve_"+trans_id).hide();
                        $("#reject_"+trans_id).hide();
                        $("#tdapprove_"+trans_id).html("Approved");

                    }else{

                        $("#approve_"+trans_id).hide();
                        $("#reject_"+trans_id).hide();
                        $("#td_"+trans_id).html("Transaction Failed");

                    }
                    
                }
            });

        }

        function reject(trans_id, user) {

            $("#reject_"+trans_id).html("loading");

            $.ajax({
                url: "api/return_approval_action.php",
                type: "post",
                data: {action: 'reject',transaction_id : trans_id, user : user},
                success: function(response){

                    if (response == "RejectionSuccess") {

                        $("#approve_"+trans_id).hide();
                        $("#reject_"+trans_id).hide();
                        $("#tdreject_"+trans_id).html("Rejected");

                    }else{

                        
                        $("#approve_"+trans_id).hide();
                        $("#reject_"+trans_id).hide();
                        $("#tdreject_"+trans_id).html("Transaction Failed");

                    }
                    
                }
            });

        }
        
        function trandetails(trans_id) {
            $.ajax({
                url: "modal_return_approval_details.php",
                type: "post",
                data: {transaction_id : trans_id},
                success: function(response){
                    $("#details").html(response);
                    $("#modaldetails").modal();
                }
            });

        }
        
		 
     // });
		
    </script>
    
    
    
</body>

</html>