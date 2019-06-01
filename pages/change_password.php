<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(3);

$business_id = $_SESSION["business_id"];
?>
<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-Change Password")?>

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
            <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Change Password
                                
                            </h2>
                            
                        </div>
                        <div class="body">
                        
                    <?php
                            
                    if(isset($_POST["submit"])){
                        
                        $current_password = sanitize($_POST["current_password"]);
                        $new_password = sanitize($_POST["new_password"]);
                        $new_password_again = sanitize($_POST["new_password_again"]);
                        
                        if(!empty($current_password) && !empty($new_password) && !empty($new_password_again)){
                            
                            if ($new_password === $new_password_again) {


                                if ($new_password !== $current_password) {
                                        
                                    $username = $_SESSION["cur_user"];

                                    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_users WHERE username = :username AND password = :current_password ");
                                    $stmt->execute(['username' => $username, 'current_password' => $current_password]);

                                    $rows = $stmt->rowCount();

                                    if($rows>0){
                                        
                                        $stmt = $conn->prepare("UPDATE ".$business_id."_users SET password = :new_password, recover_password = 'no' WHERE username = :username AND password = :current_password ");
                                        $query = $stmt->execute(['new_password' => $new_password, 'username' => $username, 'current_password' => $current_password]);

                                        if ($query) {
                                            echo "<div class='alert alert-success'>Password changed successfully</div>";
                                        }else {
                                            echo "<div class='alert alert-danger'>Unable to Update Password</div>";
                                        }

                                    }else {
                                        echo "<div class='alert alert-danger'>Invalid Current Password</div>";
                                    }

                                }else {
                                    echo "<div class='alert alert-danger'>New Password cannot be the same as Current Password</div>";
                                }
                                
                                


                            }else {
                                echo "<div class='alert alert-danger'>News Passwords must match</div>";
                            }

                        }else {
                            echo "<div class='alert alert-danger'>All Fields are Compulsory</div>";
                        }
                    }
                    ?>
                                <form action="" method="post">

                                        <div class="row clearfix">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                <div class="form-line">
                                                        <input type="password" class="form-control" placeholder="Current Password" name="current_password" />
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                <div class="form-line">
                                                        <input type="password" class="form-control" placeholder="New Password" name="new_password" />
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row clearfix">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                <div class="form-line">
                                                        <input type="password" class="form-control" placeholder="New Password Again" name="new_password_again" />
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    <div class="">
                                        <button class="btn btn-primary waves-effect" type="submit" name="submit" value="update">
                                            <i class="material-icons">update</i> <span>Update</span>
                                        </button>
                                    </div>
                            </form>
                                
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