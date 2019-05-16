<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   //if ($_SESSION["cur_user"]!="") {} else {logout();} 

// if(isset($_POST["post"])){ @Kolerian Todo
						
//     $customer_name = mysql_real_escape_string($_POST["customer_name"]);
//     $business_name = mysql_real_escape_string($_POST["business_name"]);
//     $email = mysql_real_escape_string($_POST["email"]);
//     $password = mysql_real_escape_string($_POST["password"]);
//     $confirm_pass = mysql_real_escape_string($_POST["confirmPass"]);
//     $agree = mysql_real_escape_string($_POST["terms"]);
    
//     if($agree){
//         $query = mysql_query("insert into VALUES('', '$customer_name','','','', '$password','$business_name')");
									
									
//             if ($query) { $success = "<div class='alert alert-success' role='alert'>Customer Added Successfully</div>"; }
//             else { $error = "<div class='alert alert-danger' role='alert'>Operation Failed, try again</div>";}
// 	} 
// }

if(isset($_POST["post"]))
{
    $customer_name = $_POST["customer_name"];
    $business_name = $_POST["business_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_pass = $_POST["confirmPass"];
    $agree = $_POST["terms"];

    if($agree)
    {
        $stmt = $conn->prepare("insert into VALUES('', '$customer_name','','','', '$password','$business_name')");
        $stmt->execute();
        if ($query) 
        {
            $success = "<div class='alert alert-success' role='alert'>Customer Added Successfully</div>";
        }
        else 
            { 
                $error = "<div class='alert alert-danger' role='alert'>Operation Failed, try again</div>";
            }
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
               
               
                <form id="sign_up" method="POST" action="">

                    <?php if($success){echo $success;}?>
                    <?php if($error){echo $error;}?>
                    <div class="msg">Enter your email address, we will send you a link to reset your password</div>
                    
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit" name="post" value="send">RESET MY PASSWORD</button>
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