<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");  
protectPage(3);

?>
<!DOCTYPE html>
<html>

<head>
<?php links("Welcome To | LUMOKU UIS"); ?>
  
</head>

<body class="theme-green">
    <!-- Page Loader -->
        <?php  loading(); ?>
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
    <?php navigation_left(); echo $_SESSION["business_id"];?>
    
    <section class="content">
        <div class="container-fluid">
            

            <?php
            //@kolerian Todo @description it doesnt require any changes
					
					if(isset($_GET["id"])) {$a = $_GET["id"];} else {$a = 1;}
			
				if ($a==1) {include "../forms/home.php";}
				if ($a=="out") {logout();}
				
				
			
			?>
            <!-- CPU Usage -->
            
            
                <!-- #END# Browser Usage -->
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

    <!-- Jquery CountTo Plugin Js -->
    <script src="../plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="../plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="../plugins/flot-charts/jquery.flot.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="../plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/index.js"></script>
    <script src="../js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>