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
               
            <?php
                if(isset($_POST["submit"])){

                    $business_id = $_GET["businessid"];

                    if (!empty($business_id)) {

                        $stmt = $conn->prepare("SELECT * FROM businesses WHERE business_id = :business_id ");
                        $query = $stmt->execute(['business_id' => $business_id]);

                        $rows = $stmt->rowCount();
                    
                        if ($rows > 0) {

                            $row = $stmt->fetch();
                            $email = $row->email;

                            $verification_expiry = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", time()). " + 1 day"));
                            echo $verification_code = md5(hash("whirlpool", "BakandamiyarGizogizo" + microtime()));
                            
                            $conn->beginTransaction();
        
                            $stmt1 = $conn->prepare("UPDATE businesses SET verification_code = '$verification_code', verification_expiry = '$verification_expiry' WHERE business_id = :business_id ");
                            $query1 = $stmt1->execute(['business_id' => $business_id]);

                            if ($query1) {

                                $from="support@uis.com.ng";
                                $url="https://luis.aws.com.ng/forms/activate.php?auth=".str_rot13($email)."&veri=".$verification_code." ";
                                $msg="Yor registration is almost complete,\n Kindly follow this link  ".$url." to complete it \n\n".
                                "Link is only valid for 24 hours";
                                $subj="LUIS - New Verification Code";

                                if(1==1){//notify($msg,$email,$subj,$from)){
                                    $conn->commit();
                                    echo "<div class='alert alert-success' role='alert'> Congratulations, Your new Verification Code has been sent. <br> <a href='login.php'>Go back to Login Page</a>";
                                    exit();
                                }else {
                                    $conn->rollback();
                                    echo "<div class='alert alert-danger' role='alert'> Sorry, Unable to Resend Verification Code. <br><br>";
                                }

                            }else {

                                echo "<div class='alert alert-danger' role='alert'> Sorry, Unable to Resend Verification Code. <br><br>";

                            }

                        
                        }

                    }
                   

                }

            ?>
               
                <form method = "POST" action="">

                    <?php if(isset($_GET["signupsuccess"])){echo "<div class='alert alert-success' role='alert'>Successfully Registered, Go to your email address to confirm your Registration." . "<a href='login.php'>Go back to Login Page</a>" .  "</div>";}?>
                    <?php if(isset($_GET["activatesuccess"])){echo "<div class='alert alert-success' role='alert'>You have Successfully activated your account. You can now login to the system with the following credentials <br> Username: ". $_GET["businessid"] . "101 <br> Password: ".$_GET["password"]." <br> <a href='login.php'>Go back to Login Page</a>" .  "</div>";} ?>
                    <?php if(isset($_GET["activateerror"])){echo "<div class='alert alert-danger' role='alert'> Sorry, Unable to activate your account ". "<a href='login.php'>Go back to Login Page</a>" .  "</div>";}?>

                    <?php if(isset($_GET["verificationexpire"])){ ?>
                        
                        <div class='alert alert-danger' role='alert'> Sorry, Your Verification Token has expired. <br><br>

                            <button class="btn btn-block bg-primary waves-effect" name="submit" type="submit">Click Here to Resend</button>
                        </div>
                    
                    <?php } ?>
                

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