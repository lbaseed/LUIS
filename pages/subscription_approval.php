<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
//protectPage(7);
if($_SESSION["clearance"]==6) {header("Location: index.php");}
?>
<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-Subscription Approval")?>

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
           
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                SUBSCRIPTION REQUEST AWAITING APPROVAL 
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Payee</th>
                                            <th>Amount Paid</th>
                                            <th>Purpose</th>
                                            <th>Details</th>
                                            <th>Approve</th>
                                            <th>Reject</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        
                                        <?php

                                            $user = $_SESSION["cur_user"];
                                                
                                            $stmt = $conn->prepare("SELECT * FROM transactions_trn WHERE approvalStatus = 'pending' ");
                                            $stmt->execute();

                                            $rows = $stmt->rowCount();
                                                        
                                            if($rows>0){

                                                $sn = 1; 
                                                for($i=0; $i<$rows; $i++){

                                                    $row = $stmt->fetch();
                                                    
                                                    $id = $row->id; 
                                                    $payee = $row->payee; 
                                                    $amountPaid = $row->amountPaid;
                                                    $purposeCode = $row->purposeCode;

                                                    echo "<tr>
                                                            <td>$sn</td>
                                                            <td>$payee</td>
                                                            <td>$amountPaid</td>
                                                            <td>$purposeCode</td>
                                                            <td> <button type='button' class='btn bg-default waves-effect' onClick='trandetails($id)'> 
                                                            <i class='material-icons'>assignment</i>
                                                            </button> </td>
                                                            <td id = 'tdapprove_{$id}'> <button type='button' class='btn bg-default waves-effect' id = 'approve_{$id}' onClick='approve($id)'>Approve</button> </td>
                                                            <td id = 'tdreject_{$id}'> <button type='button' class='btn bg-default waves-effect'  id = 'reject_{$id}' onClick='reject($id)'>Reject</button> </td>
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
        
          <div id="details"></div>     
            
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

        function approve(id) {

            $("#approve_"+id).html("loading");

            $.ajax({
                url: "api/subscription_approval_action.php",
                type: "post",
                data: {action: 'approve',id : id},
                success: function(response){
                    if (response == "ApprovalSuccess") {

                        $("#approve_"+id).hide();
                        $("#reject_"+id).hide();
                        $("#tdapprove_"+id).html("Approved");

                    }else{

                        $("#approve_"+id).hide();
                        $("#reject_"+id).hide();
                        $("#tdreject_"+id).html("Approval Failed");

                    }
                    
                }
            });

        }

        function reject(id) {

            $("#reject_"+id).html("loading");

            $.ajax({
                url: "api/subscription_approval_action.php",
                type: "post",
                data: {action: 'reject',id : id},
                success: function(response){

                    if (response == "RejectionSuccess") {

                        $("#approve_"+id).hide();
                        $("#reject_"+id).hide();
                        $("#tdreject_"+id).html("Rejected");

                    }else{

                        
                        $("#approve_"+id).hide();
                        $("#reject_"+id).hide();
                        $("#tdreject_"+id).html("Transaction Failed");

                    }
                    
                }
            });

        }
        
        function trandetails(id) {
            $.ajax({
                url: "modal_subscription_approval_details.php",
                type: "post",
                data: {id : id},
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