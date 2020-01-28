<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php"); 

if (logged_in()) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-Login Page"); ?>
</head>

<body class="login-page" style="background-image:url(../images/bg1.jpg);  background-repeat: no-repeat; background-size: 100%;">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Universal<b> Inventory System</b></a>
            <small>Your Financial info everywhere</small>
        </div>
        <div class="card">
            <div class="body">
               <?php
				//@Kolerian Todo Nothing to change all the code is intact
                if(isset($_POST["submit"])){

                    $uname = sanitize($_POST["username"]);
                    $pass = sanitize($_POST["password"]);
                    $bid = sanitize($_POST["business_id"]);

                    if (!empty($uname) && !empty($pass) && !empty($bid) ) {

                            login($uname, $pass, $bid);
                    }else {
                        echo "<div class='alert alert-danger'>Fill all fields</div>";
                    }
                }
				
				?>
                <form id="sign_in" action="" method="POST">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="business_id" placeholder="Business ID" required autofocus autocomplete="off">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autocomplete="off">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="off">
                            
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" name="submit" type="submit">SIGN IN</button>
                        </div>
                        
                        <div class="col-xs-4 pull-right">
                            <a href="sign_up.php" class="btn btn-block bg-green">SIGN UP</a>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        
                        <div class="col-xs-6 align-right">
                            <a href="forget_password.php">Forget Password</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/examples/sign-in.js"></script>
</body>

</html>