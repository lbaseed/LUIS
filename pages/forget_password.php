<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   //if ($_SESSION["cur_user"]!="") {} else {logout();} 




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
               <div class="msg">Enter your Business ID and Email address, we will send you a link to reset your password</div>
				<?php
					if(isset($_POST["reset"]))
							{
								$email = sanitize($_POST["email"]);
								$bid = sanitize($_POST["bid"]);

									$stmt = $conn->prepare("select * from ".$bid."_users where email= :email");
									$q = $stmt->execute(['email' => $email]);

                                    $rows = $stmt->rowCount();
                                    
								if($rows>0){

										$rec = $stmt->fetch();
										$username = $rec->username;
										$password = $rec->password;

                                        $from="support@uis.com.ng";
                                        $msg="Hello!\n\n Your Login credentials are:-
                                        \n\n Your Business ID is : <b>".$bid."</b>\n Username is : <b>".$username."</b>\n Password : <b>".$password."</b> \n\n Thank You for your patronage.";
                                        $subj="LUIS - Password Detail";

                                        if (notify($msg,$email,$subj,$from)) {
										    echo '<div class="alert alert-success text-center ">Please Check your e-mail for your Login Details</div>';  
                                        }else{
                                            echo "<div class='alert alert-danger text-center'>Unable to send email, Please try later</div>";
                                        }
								}else{
									echo "<div class='alert alert-danger text-center'>No Record Found</div>";
								}

							}

				?>
                <form id="sign_up" method="POST">
                    
                    
                    
					<div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">business</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="bid" placeholder="Business ID" required>
                        </div>
                    </div>
					
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