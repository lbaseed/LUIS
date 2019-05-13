<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   


?>
<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-SIGN UP"); ?>	
</head>

<body class="signup-page" style="background-image:url(../images/bg1.jpg);  background-repeat: no-repeat; background-size: 100%;">
    <div class="signup-box">
        <div class="logo">
             <a href="javascript:void(0);">Universal<b> Inventory System</b></a>
            <small>Your Financial info everywhere</small>
        </div>
        <div class="card">
            <div class="body">
               
               
                <form>
                <?php if(isset($_GET["signupsuccess"])){echo "<div class='alert alert-success' role='alert'>Successfully Registered, Go to your email address to confirm your Registration." . "<a href='login.php'>Go back to Login Page</a>" .  "</div>";}?>
                <?php if(isset($_GET["activatesuccess"])){echo "<div class='alert alert-success' role='alert'>You have Successfully activated your account. You can now login to the system with the following credentials <br> Username: ". $_GET["businessid"] . "101 <br> Password: pass <br> <a href='login.php'>Go back to Login Page</a>" .  "</div>";} ?>
                <?php if(isset($_GET["activateerror"])){echo "<div class='alert alert-danger' role='alert'> Sorry, Unable to activate your account ". "<a href='login.php'>Go back to Login Page</a>" .  "</div>";}?>
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
    <script src="../js/pages/examples/sign-up.js"></script>
</body>

</html>