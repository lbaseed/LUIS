<?php include("../inc/config.php"); include("../inc/php_functions.php");

if(!isset($_GET["code"])){
    exit("Can't fine page");
}
$code = $_GET["code"];
//$getEmailQuery = "";
$stmt = $conn->prepare("select email from resetpassword where code = ?");
$stmt->execute([$code]);

$rows_count = $stmt->rowCount();

if($rows_count = 0){
    exit("Can't fine page");
}

if(isset($_POST["password"])){
    $pw = $_POST["password"];
    //$pw =md5($pw);
    $row = $stmt->fetch();
    $emai = $row->email;

    $stmt = $conn->prepare("update users set password = ? where email = ?");
    $qry = $stmt->execute([$pw, $emai]);

    if($qry){
        $stmt = $conn->prepare("delete from resetpassword where code = ?");
        $stmt->execute([$code]);
        exit("Password Updated");
    }
    else {
        exit("Something went wrong");
    }
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
               
                <form id="sign_up" method="POST">
                    <?php 
                        if(isset($_POST["email"])){
                                echo '<p class="text-success text-center bg-success">'.$message. ' Check your e-mail</p>';  
                        }
                    
                    ?>
                    <div class="msg">Enter your new password </div>
                    
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">Password</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Enter New Password" required>
                        </div>
                    </div>
                    
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit" name="submit" value="send">UPDATE NEW PASSWORD</button>   
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