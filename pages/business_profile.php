<?php ob_start(); include("../inc/config.php"); include("../inc/php_functions.php");   
protectPage(7);

	
?>
<!DOCTYPE html>
<html>

<head>
    <?php links("UIS-BUSINESS PROFILE")?>

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
                                Business Profile
                    
                            </h2>
                            
                        </div>
                        <div class="body">
                                            <?php
                                            
                            ///post update information
                            if(isset($_POST["submit"])){

                                $address = sanitize($_POST["address"]);
                                $phone1 = sanitize($_POST["phone1"]);
                                $phone2 = sanitize($_POST["phone2"]);
                                $email = sanitize($_POST["email"]);
                                $rec_id_update = sanitize($_POST["rec_id"]);

                                $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_company_profile SET address = :address, phone1 = :phone1, phone2 = :phone2, email = :email WHERE id = :rec_id_update ");
					            $update_query = $stmt->execute(['address' => $address, 'phone1' => $phone1, 'phone2' => $phone2, 'email' => $email, 'rec_id_update' => $rec_id_update ]);

                                if ($update_query) { echo "<div class='alert alert-success'>Record Updated Successfully</div>";}
                                else { echo "<div class='alert alert-danger'>Record Updated Failed, Try again!</div>";}

                            }

                            //upload Image
                            if(isset($_POST["upload"])){

                                $rec_id_update = sanitize($_POST["rec_id"]);
                               $dstName = upload("logo",$_SESSION['business_id'],"logos",1024*200);

                                $stmt = $conn->prepare("UPDATE ".$_SESSION["business_id"]."_company_profile SET logo = :dstName WHERE id = :rec_id_update ");
					            $updateDB = $stmt->execute(['dstName' => $dstName, 'rec_id_update' => $rec_id_update ]);

                                //$updateDB = mysql_query("update ".$_SESSION["business_id"]."_company_profile set logo='$dstName' where id='$rec_id_update' ");
                                
                            }

                            $username = $_SESSION["cur_user"];

                                $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_company_profile");
                                $stmt->execute();
                            
                                $rows = $stmt->rowCount();

                                if($rows > 0){
                                    
                                    $row = $stmt->fetch();
                                    $rec_id = $row->id;
                                    $business_name = $row->name;
                                    $website = $row->website;
                                    $address = $row->address;
                                    $phone1 = $row->phone1;
                                    $phone2 = $row->phone2;
                                    $email = $row->email;
                                    $logo = $row->logo;
                                    
                                }
                        
                            ?>		       

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="user-info">
                                            
                                                <img src="../images/logos/<?php echo $logo; ?>" class="img-rounded" width="58" height="58" alt="logo" />
                                         
                                                <input type="hidden" name="rec_id" value="<?php echo escape($rec_id); ?>" />
                                        </div>
                                        <br>
                                        <input type="file" name="logo" id="logo">
                                        <input type="submit" name="upload" value="Upload" class="btn btn-success pull-right">
                                    </div>
                                
                            </div>
                        </div>
                        <hr>
                    </form>

                	<form action="" method="post">

                    

                        <input type="hidden" name="rec_id" value="<?php echo escape($rec_id); ?>" />

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="text" class="form-control" value="<?php echo escape($business_name); ?>" readonly/>
                                </div>
                                </div>
                            </div>
						</div>	
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="text" class="form-control"  value=" Business ID <?php echo $_SESSION["business_id"]; ?>" readonly/>
                                </div>
                                </div>
                            </div>
						</div>	

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo escape($address); ?>" required />
                                </div>
                                </div>
                            </div>
						</div>	

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="text" class="form-control" onkeydown="numericOnly('phone1');" id="phone1" name="phone1" placeholder="Phone Number 1" value="<?php echo escape($phone1); ?>" required />
                                </div>
                                </div>
                            </div>
						</div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="text" class="form-control"onkeydown="numericOnly('phone2');" id="phone2" name="phone2" placeholder="Phone Number 2" value="<?php echo escape($phone2); ?>" required />
                                </div>
                                </div>
                            </div>
						</div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div class="form-line">
                                        <input type="email" class="form-control" name="email" placeholder="email" value="<?php echo escape($email); ?>" required />
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

    <!-- Validation Plugin Js -->
    <script src="../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Moment Plugin Js -->
    <script src="../plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/index.js"></script>
    <script src="../js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
    <script>
        function numericOnly(fieldID){

$('#'+ fieldID +'').keypress(function (event) {
  var keycode = event.which;
  if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
      event.preventDefault();
  }
});
}
    </script>
</body>
</html>