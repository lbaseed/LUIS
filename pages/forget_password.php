<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   //if ($_SESSION["cur_user"]!="") {} else {logout();} 

// @Kolerian Todo
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$message = "";

if(isset($_POST["email"]))
{
    $emailTo = $_POST["email"];
    $code =  uniqid(true);

    $stmt = $conn->prepare("insert into resetpassword(code, email) values(?,?)");
    $q = $stmt->execute([$code, $emailTo]);
    if(!$q){
        exit('Error');
    }
    $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 's.kole4real@gmail.com';                     // SMTP username
            $mail->Password   = 'kolerian3';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('s.kole4real@gmail.com', 'K9is');
            $mail->addAddress("$emailTo");     // Add a recipient
            $mail->addReplyTo('no-reply@k9is.com', 'No-Reply');
        
            // Content
            $url = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER["PHP_SELF"])."/resetPassword.php?code=$code";

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Your password reset Link';
            $mail->Body    = "<h1>You requested a password reset<h1> 
                            <p>Click <a href='$url'>this link</a> to do so</p>
                            ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            $message = 'Reset password link has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        exit();

}

//$stmt = $conn->prepare("select * from ".$_SESSION["business_id"]."_categories");
						



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
               
                <form id="sign_up" method="POST">
                    <?php 
                        if(isset($_POST["email"])){
                                echo '<p class="text-success text-center bg-success">'.$message. ' Check your e-mail</p>';  
                        }
                    
                    ?>
                    <div class="msg">Enter your email address, we will send you a link to reset your password</div>
                    
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit" name="reset" value="send">RESET MY PASSWORD</button>
                    <a href="login.php" class="btn btn-block btn-lg bg-green waves-effect">LOGIN</a>    
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