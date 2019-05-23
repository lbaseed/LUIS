<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   //if ($_SESSION["cur_user"]!="") {} else {logout();} 

// @Kolerian Todo
						

if(isset($_POST["reset"]))
{
    $email = $_POST["email"];






}

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
               <?php
                 $selector = $_GET["selector"];
                 $validator = $_GET["validator"];

                 if(empty($selector) || empty($validator)){
                     echo "Could not validate your request";

                 }else{
                     if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                        ?>
                    <form action="reset-password.inc.php" method="post">
                        <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                        <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                        <input type="password" name="pwd" placeholder="Enter a new password...">
                        <input type="password" name="pwd-repeat" placeholder="Repeat new password...">
                        <button type="submit" name="reset-password-submit" >Reset Password</button>
                    </form>
                  <?php      
                     }
                 }
               ?>
               
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