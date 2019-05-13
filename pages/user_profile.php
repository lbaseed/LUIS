<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(3);
?>
<!DOCTYPE html>
<html>

<head>
    <?php links("UIS- USER PROFILE")?>

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
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                                User Profile
                            </h2>
                            
                                    </div>
                        <div class="body">
                        <?php   

                        $username = $_SESSION["cur_user"];
                        $bid = $_SESSION["business_id"];

                    //update query

                    if(isset($_POST["update"])){
                        
                        $update_phone = mysql_real_escape_string($_POST["new_phone"]);
                        $update_address = mysql_real_escape_string($_POST["new_address"]);
                        $update_email = mysql_real_escape_string($_POST["new_emai"]);
                        $update_sec_que = mysql_real_escape_string($_POST["security_question"]);
                        $update_sec_ans = mysql_real_escape_string($_POST["security_answer"]);

                        
                        $update_query = mysql_query("update ".$bid."_users set phone='$update_phone', address='$update_address', email='$update_email' where username='$username' ");

                        if($update_sec_que) {
                            $update_sec_query = mysql_query("update ".$bid."_users set security_question='$update_sec_que', security_answer='$update_sec_ans' where username='$username' ");

                        }

                        if($update_query) {echo "<div class='alert alert-success'>Update Successfull</div>";}
                        else {echo "<div class='alert alert-danger'>Update Failed</div>";}
                    }

                    
                    $query = mysql_query("select * from ".$bid."_users where username='$username'");                     
                        if(mysql_num_rows($query)>0){
                            $rec = mysql_fetch_array($query);
                            $username = $rec["username"];
                            $fullname = $rec["fullname"];
                            $address = $rec["address"];
                            $phone = $rec["phone"];
                            $email = $rec["email"];
                            $security_question = $rec["security_question"];
                            $security_answer = $rec["security_answer"];
                        }
                    ?>  							         
                	<form action="" method="post">
                    
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Username" value="<?php echo escape($username); ?>" readonly/>
                                </div>
                                </div>
                            </div>
						</div>	

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="text" class="form-control" placeholder="FullName" value="<?php echo escape($fullname); ?>" readonly/>
                                </div>
                                </div>
                            </div>
						</div>	
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="text" class="form-control" onkeydown="numericOnly('phone');" id="phone" name="new_phone" placeholder="phone" value="<?php echo escape($phone); ?>" />
                                </div>
                                </div>
                            </div>
						</div>

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="text" class="form-control" name="new_address" placeholder="address" value="<?php echo escape($address); ?>" />
                                </div>
                                </div>
                            </div>
						</div>	
                       <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="email" class="form-control" name="new_emai" placeholder="email" value="<?php echo escape($email); ?>" />
                                </div>
                                </div>
                            </div>
						</div>

                        <div class="row clearfix">
                            <div class="col-sm-12">
                            <select class="form-control show-tick" name="security_question">
                            <option value="">SECURITY QUESTION</option>
                            <option>YOUR FAVORITE MEAL</option>
                            <option>YOUR FIRST PHONE MODEL</option>
                            <option>YOUR BEST FILM</option>
                            </select>
                                </div>
						</div>	

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="text" class="form-control" name="security_answer" placeholder="Security Answer" value="<?php echo escape($security_answer); ?>" />
                                </div>
                                </div>
                            </div>
						</div>	
								  <input type="hidden" name="update" value="processUpdate" />
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