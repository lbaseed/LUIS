<?php 
date_default_timezone_set("Africa/Lagos");

    error_reporting(0);
    ob_start(); 
    //$_SESSION["home_link"] = "https://luis.aws.com.ng/pages/"; 

    //$_SESSION["home_link"] = "http://k9isonline.com/luis/pages/"; 

    $_SESSION["home_link"] = "http://localhost:81/k9is/LUIS/pages/"; 


function autologout($sec){		
	if (isset( $_SESSION["ctime"]))
		{
			
            $_SESSION["timeN"]= time();
            
			$time_dif= $_SESSION["timeN"] - $_SESSION["ctime"];
			
		}else { $_SESSION["ctime"]= time();}
			
			if ($time_dif > $sec)
			{
			unset($_SESSION["ctime"]);
			header ("Location: index.php?id=out");
			}
			else
			{	
				$_SESSION["ctime"]= time();
			}
}

//getting file extention function
function getExtension($str) {
    $i = strrpos($str, ".");
    if (!$i) 
    return "";
    $l = strlen($str)-$i;
    $ext = substr($str, $i+1, $l);
    return $ext;
}
         
//picture upload function
function upload($name, $fileName, $location, $asize){
    
        $nm = $_FILES["$name"]["name"];
        $size = $_FILES["$name"]["size"];
        $tmp = $_FILES["$name"]["tmp_name"];
        $extn = getExtension($nm);
        
        if ($size < $asize)
        {
            if ($extn=="jpg" || $extn=="gif" || $extn=="png" || $extn=="jpeg" || $extn=="JPG" || $extn=="GIF" || $extn=="PNG" || $extn=="JPEG" )
            {
                $dstName = $fileName.".".$extn;
                $copy = copy($tmp, "../images/$location/". $dstName);
        
                if ($copy) {return $dstName;}
        
            }	else {echo "<div class='alert danger'>File format not accepted"; exit;}
        }	else {echo "<div class='alert danger'>File size too big"; exit;}
}

function links($title){
	?>
			<title><?php echo $title ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
	<!-- Custom Css -->
    <link href="../css/custom.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="../css/fonts.css" rel="stylesheet" type="text/css">
    <link href="../css/icons.css" rel="stylesheet" type="text/css">


    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">


    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />

	

	<?php
}

function search_bar(){
	?>
		<div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <form action="../pages/search.php" method="get">
        <input type="text" name="srch" placeholder="START TYPING...">
        
        </form>
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
	<?php
}

function top_bar(){
	
	?>
		
		<nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php">LUMO Universal Inventory SYSTEM (LUIS)</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    
                    
                </ul>
            </div>
        </div>
    </nav>
    
	<?php
	
}
function loading(){

    ?>
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
    <?php
}
function navigation_left(){
	$home_link = $_SESSION["home_link"];
	$bid = $_SESSION["business_id"];
	
	$logo = getTableData("{$bid}_company_profile", "id", "1", "logo");
		
    include '../pages/navigation.php'; 
            
}



function panel_head($head, $sub_head){
	
	?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="card">
		<div class="header">
			<h2><?php echo $head; ?> <small><?php echo $sub_head; ?></small></h2>
			<ul class="header-dropdown m-r--5">
				<li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);">Action</a></li>
                        <li><a href="javascript:void(0);">Another action</a></li>
                        <li><a href="javascript:void(0);">Something else here</a></li>
                    </ul>
               </li>
			</ul>
		</div>
		<div class="body">
	<?php
	
}

function panel_foot(){
	?>
		        </div>
		
	        </div>
        </div>
	<?php
}
	
//controls functions
function list_categories(){

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_categories");
	$stmt->execute();

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        for ($i=0; $i < $rows; $i++) { 

            $row = $stmt->fetch();

            $id = $row->id;
            $name = $row->name;

            echo "<option value='$id'>$name || [ $id ]</option>";
        }
	
    }
}

function getCategories($cat_id){

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_categories WHERE id = :cat_id ");
	$stmt->execute(['cat_id' => $cat_id]);

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        
        $row = $stmt->fetch();
        $name = $row->name;
										 
        return $name;
										
	}else{
        return "Error Getting Record";
    }

}

function list_items(){

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items WHERE status = 1 ORDER BY `name` ASC");
	$stmt->execute();

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        for ($i=0; $i < $rows; $i++) { 

            $row = $stmt->fetch();

            $id = $row->item_id;
            $name = $row->name;
            $sale_price = $row->sale_price;

            echo "<option value='$id'>$name : $sale_price</option>";
        }
	
    }
	
}

function list_users(){

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_users ");
	$stmt->execute();

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        for ($i=0; $i < $rows; $i++) { 

            $row = $stmt->fetch();

            $id = $row->username;
            $name = $row->fullname;

            echo "<option value='$id'>$name </option>";
        }
	
    }
	
}

function list_customers(){

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_customers WHERE full_name!='' ORDER BY `ID` DESC ");
	$stmt->execute();

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        for ($i=0; $i < $rows; $i++) { 

            $row = $stmt->fetch();

            $id = $row->ID;
            $name = $row->full_name;

            echo "<option value='$id'>$name [$id]</option>";
        }
	
    }
	
}

function get_customer($id){

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_customers WHERE ID = :id ");
	$stmt->execute(['id' => $id]);

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        
        $row = $stmt->fetch();
        $name = $row->full_name;
										 
        return $name;
										
	}else{
        return "Error Getting Record";
    }

}

function list_suppliers(){

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_suppliers ORDER BY `ID` DESC ");
	$stmt->execute();

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        for ($i=0; $i < $rows; $i++) { 

            $row = $stmt->fetch();

            $id = $row->ID;
            $name = $row->full_name;

            echo "<option value='$id'>$name [$id]</option>";
        }
	
    }

}

function get_suppliers($id){

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_suppliers WHERE ID = :id ");
	$stmt->execute(['id' => $id]);

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        
        $row = $stmt->fetch();
        $name = $row->full_name;
										 
        return $name;
										
	}else{
        return "Error Getting Record";
    }

}

function get_profit($tid){
    
    global $conn;
    $profit = 0;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_sales WHERE trans_id = :tid ");
	$stmt->execute(['tid' => $tid]);

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        
        $row = $stmt->fetch();
        
        $cost_price = $row->cost_price; 
        $sold_price = $row->sold_price;
        $qty = $row->qty;
        $profit += ($sold_price - $cost_price) * $qty;
										 
        return $profit;
										
	}else{
        return "Error Getting Record";
    }

}

function full_receipt_header(){
	
	global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_company_profile  ");
	$stmt->execute();

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        $row = $stmt->fetch();

        $company_name = $row->name; 
        $address = $row->address;
        $phone1 = $row->phone1; 
        $phone2 = $row->phone2;
        $email = $row->email;  
        $logo = $row->logo;
    }
    ?>
    <table>
        <tr>
            <td>
                <div style="text-align: left"><img src="../images/logos/<?php echo $logo; ?>" width="90" height="80"  /></div>
            </td>
            
            <td width="600">
                <div style="text-align: center">
                <label id="bus_name"><?php echo $company_name?></label><br>
                <label id="bus_address"><?php echo $address?></label><br>
                <label id="bus_contact"><?php echo $phone1 . ", " .$phone2; ?></label><br>
                <label id="bus_email"><?php echo $email?></label>
                </div>
            </td>
        </tr>
    </table>
    <div class="clearfix"></div>
        
    <?php
}

function logout(){
    $home_link = $_SESSION["home_link"];
    
	$_SESSION["cur_user"] = "";
	$_SESSION["fullName"] = "";
	$_SESSION["clearance"] = "";
    $_SESSION["business_id"]= "";
    session_destroy();
	header("Location: ".$home_link."login.php");
}

function getTableData($tbl, $identifier, $parameter, $returnColumn){

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM $tbl WHERE $identifier = :parameter ");
	$stmt->execute(['parameter' => $parameter]);

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        
        $row = $stmt->fetch();
        
        $result = $row->$returnColumn; 
										 
        return $result;
										
	}else{
        return "Error Getting Record";
    }

}

function login($sys_user, $pass, $bid)	{

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM " . $bid ."_users WHERE username= :sys_user AND active_status='active' ");
	$query = $stmt->execute(['sys_user' => $sys_user]);
        
    if($query){

        $rows = $stmt->rowCount();
        $row = $stmt->fetch();

		if ($rows > 0)
		{
            $fpass = $row->password;
            //$status = mysql_result($q, 0, "status");
			
			if ($pass==$fpass)
			{
                //Check if compulsory change of password
               // if ($status === 2) {
                    
               // }
				//login successful
				
				$_SESSION["cur_user"] = $row->username;
				$_SESSION["clearance"] = $row->clrs;
				$_SESSION["fullname"] = $row->fullname;
				$_SESSION["business_id"] = $bid;
				
				header("Location:index.php"); 
			} 
			else {
				echo "<div class='alert alert-danger'>Wrong password</div>";
            }
            
		} else {
			
			//check user of a business
			echo "<div class='alert alert-danger'>No user record found</div>";
	
                } 
                
    } else {
                echo "<div class='alert alert-danger'>Wrong Business ID</div>";
            }
					

}

function general_borrow_receipt(){
	
	?>
		<div class="modal fade" id="fullModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="fullModalLabel">Borrow Receipt</h4>
                        </div>
                        <div class="modal-body">
                           	<div id="printFullReceipt" style="width: 800px; height: auto">
                           		
                           		<?php   full_receipt_header(); ?>
                          			
                          			<table width="750">
                          				<tr>
                          					<td> 
                          						<div>Full Name: <label  id="modal_full_cust_name">####</label></div>
												<div>Address: <label  id="modal_full_cust_addr">####</label></div>
												<div>Phone: <label  id="modal_full_cust_phone">####</label></div>
                          					</td>
                          					<td style="text-align: right">
                          						<div> Payment Channel<br> <label id="modal_full_payment_channel"></label></div>
                          					</td>
                          				</tr>
                          			</table>
                           			
                           			
                           			<table width="750">
                           				<tr>
                           					<td>
                           						<div>Transaction Ref: <label  id="modal_full_trans_ref"></label></div> 
                           					</td>
                           					
                           					<td>
                           						<div><label id="receipt_type"></label></div>
                           					</td>
                           					
                           					<td style="text-align: right">
                           						<div><label id="modal_full_trans_date"></label></div>
                           					</td>
                           				</tr>
                           			</table>
									
                           				<table id="modal_full_items_list" border="2" class="table" cellpadding="4" cellspacing="4" style="font-size: 9; width:750px" >
                           				<thead>
                           					<tr><th>Qty</th> <th>Item</th> <th>Unit Price</th> <th>Sub-Total</th></tr>
                           					</thead>
                           					<tbody>
                           						
                           					</tbody>
                           				</table>
                           			
                           			<div style="text-align: center">
										<label>Total Sales: </label> <label id="modal_full_total_label"> #### </label><br>
										<label>Amount Tendered: </label> <label id="modal_full_amount_tendered"> ####</label><br>
										<label id="modal_full_change_text">Change: </label> <label id="modal_full_change"> ####</label>
										
									</div>
                        			<br>
                         			<table width="750">
                         				<tr>
                         					<td style="border-top: solid 1px #000; width:250px; text-align: center">
                         						Customer Signature
                         					</td>
                         					<td width="250"> </td>
                         					<td style="border-top: solid 1px #000; width:250px; text-align: center">
                         						Manager's Signature
                         					</td>
                         				</tr>
                         			</table>
                         			<br>
                          			<div><label id="modal_full_footer">cashier: <?php echo $_SESSION["cur_user"];?>, </label>
                          			<label id="modal_full_footer_timestamp"></label> <label><i>Please note that their is <b>NO</b> Refund After Payment</i></label>
                          			</div>
                           	</div>
                        </div>
                        <div class="modal-footer">
                           	
                            <button type="button" class="btn btn-link waves-effect" onClick="printFull('printFullReceipt')">Print Receipt</button>
                            <button type="button" class="btn btn-link waves-effect" id="modal_full_close" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            
	<?php
}

function general_full_receipt(){
	
	?>
		<div class="modal fade" id="fullModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="fullModalLabel">Full Receipt</h4>
                        </div>
                        <div class="modal-body">
                           	<div id="printFullReceipt" style="width: 800px; height: auto">
                           		
                           		<?php   full_receipt_header(); ?>
                          			
                          			<table width="750">
                          				<tr>
                          					<td> 
                          						<div>Full Name: <label  id="modal_full_cust_name">####</label></div>
												<div>Address: <label  id="modal_full_cust_addr">####</label></div>
												<div>Phone: <label  id="modal_full_cust_phone">####</label></div>
                          					</td>
                          					<td style="text-align: right">
                          						<div> Payment Channel<br> <label id="modal_full_payment_channel"></label></div>
                          					</td>
                          				</tr>
                          			</table>
                           			
                           			
                           			<table width="750">
                           				<tr>
                           					<td>
                           						<div>Transaction Ref: <label  id="modal_full_trans_ref"></label></div> 
                           					</td>
                           					
                           					<td>
                           						<div><label id="receipt_type"></label></div>
                           					</td>
                           					
                           					<td style="text-align: right">
                           						<div><label id="modal_full_trans_date"></label></div>
                           					</td>
                           				</tr>
                           			</table>
									
                           				<table id="modal_full_items_list" border="2" class="table" cellpadding="4" cellspacing="4" style="font-size: 9; width:750px" >
                           				<thead>
                           					<tr><th>Qty</th> <th>Item</th> <th>Unit Price</th> <th>Sub-Total</th></tr>
                           					</thead>
                           					<tbody>
                           						
                           					</tbody>
                           				</table>
                           			
                           			<div style="text-align: center">
										<label>Total Sales: </label> <label id="modal_full_total_label"> #### </label><br>
										<label>Amount Tendered: </label> <label id="modal_full_amount_tendered"> ####</label><br>
										<label id="modal_full_change_text">Change: </label> <label id="modal_full_change"> ####</label>
										
									</div>
                        			<br>
                         			<table width="750">
                         				<tr>
                         					<td style="border-top: solid 1px #000; width:250px; text-align: center">
                         						Customer Signature
                         					</td>
                         					<td width="250"> </td>
                         					<td style="border-top: solid 1px #000; width:250px; text-align: center">
                         						Manager's Signature
                         					</td>
                         				</tr>
                         			</table>
                         			<br>
                          			<div><label id="modal_full_footer">cashier: <?php echo $_SESSION["cur_user"];?>, </label>
                          			<label id="modal_full_footer_timestamp"></label> <label><i>Please note that their is <b>NO</b> Refund After Payment</i></label>
                          			</div>
                           	</div>
                        </div>
                        <div class="modal-footer">
                           	
                            <button type="button" class="btn btn-link waves-effect" onClick="printFull('printFullReceipt')">Print Receipt</button>
                            <button type="button" class="btn btn-link waves-effect" id="modal_full_close" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            
	<?php
}

function general_order_receipt(){
	
	?>
		<div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="fullModalLabel">Order Receipt</h4>
                        </div>
                        <div class="modal-body">
                           	<div id="printFullReceipt" style="width: 800px; height: auto">
                           		
                           		<?php   full_receipt_header(); ?>
                          			
                          			<table width="750">
                          				<tr>
                          					<td> 
                          						<div>Supplier Name: <label  id="modal_order_cust_name">####</label></div>
												
												<div>Supplier Phone: <label  id="modal_order_cust_phone">####</label></div>
                          					</td>
                          					<td style="text-align: right">
                          						<div> Oder Status<br> <label id="modal_order_status"></label></div>
                          					</td>
                          				</tr>
                          			</table>
                           			
                           			
                           			<table width="750">
                           				<tr>
                           					<td>
                           						<div>Oder Ref: <label  id="modal_order_ref"></label></div> 
                           					</td>
                           					
                           					<td>
                           						<div><label id="receipt_type"></label></div>
                           					</td>
                           					
                           					<td style="text-align: right">
                           						<div><label id="modal_order_trans_date"></label></div>
                           					</td>
                           				</tr>
                           			</table>
									
                           				<table id="modal_order_items_list" border="2" class="table" cellpadding="2" cellspacing="2" style="font-size: 9; width:750px" >
                           				<thead>
                           					<tr><th>SN</th> <th>Item</th> <th>Qty</th> <th>Unit Price</th> <th>Sub-Total</th></tr>
                           					</thead>
                           					<tbody>
                           						
                           					</tbody>
                           				</table>
                           			
                           			<div style="text-align: center">
										<label>Total order: </label> <label id="modal_order_total_label"> #### </label><br>
										
									</div>
                        			<br>
                         			<table width="750">
                         				<tr>
                         					<td style="border-top: solid 1px #000; width:250px; text-align: center">
                         						Customer Signature
                         					</td>
                         					<td width="250"> </td>
                         					<td style="border-top: solid 1px #000; width:250px; text-align: center">
                         						Manager's Signature
                         					</td>
                         				</tr>
                         			</table>
                         			<br>
                          			<div><label id="modal_order_footer">cashier: <?php echo $_SESSION["cur_user"];?>, </label>
                          			<label id="modal_order_footer_timestamp"></label> <label><i>Please note that their is <b>NO</b> Refund After Payment</i></label>
                          			</div>
                           	</div>
                        </div>
                        <div class="modal-footer">
                           	
                            <button type="button" class="btn btn-link waves-effect" onClick="printFull('printFullReceipt')">Print Receipt</button>
                            <button type="button" class="btn btn-link waves-effect" id="modal_order_close" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            
	<?php
}

function general_thermal_receipt(){

    ?>
    <!-- Small Size -->
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">Thermal Receipt</h4>
            </div>
            <div class="modal-body">
                <div id="printThis" style="font-size:12px">
                    <?php

                        global $conn;

                        $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_company_profile ");
                        $stmt->execute();

                        $rows = $stmt->rowCount();
                        
                        if ($rows>0)
                        {
                            
                            $row = $stmt->fetch();
                            
                            $company_name = $row->name;
                            $address = $row->address;
                            $phone1 = $row->phone1; 
                            $phone2 = $row->phone2;
                            $email = $row->email;  
                            $logo = $row->logo;
                                                            
                        }
                        
                    ?>
                        <div style="text-align: center"><img src="../images/logos/<?php echo $logo; ?>" width="90" height="80"  /></div>
                        <div style="text-align: center;">
                            <label id="bus_name"><?php echo $company_name?></label><br>
                            <label id="bus_address"><?php echo $address?></label><br>
                            <label id="bus_contact"><?php echo $phone1 . ", " .$phone2; ?></label>
                        </div>
                        <div style="float: left">Ref: <label  id="modal_trans_ref"></label></div> 
                        <div class="pull-right" ><label id="modal_trans_date"></label></div><br>
                        
                        
                            <table id="modal_items_list" class="table" >
                            <thead>
                                <tr><th>Qty</th> <th>Item</th> <th width="25%">Sub</th></tr>
                                
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        
                        <div style="text-align: center">
                            <label>Total Sales: </label> <label id="modal_total_label"> #### </label><br>
                            <label>Amount Tendered: </label> <label id="modal_amount_tendered"> ####</label><br>
                            <label>Change: </label> <label id="modal_change"> ####</label>
                            
                        </div>
                        <div><label id="modal_footer">cashier: <?php echo $_SESSION["cur_user"];?>,</label><label id="modal_footer_date"> </label></div>
                </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-link waves-effect" onClick="printDiv('printThis')">Print Receipt</button>
                <button type="button" class="btn btn-link waves-effect" id="modal_close" data-dismiss="modal">CLOSE</button>
            </div>
            </div>
        </div>
    </div>

    <!-- ======  end of small modal ========-->
            
    <?php
}

function deposite_payback_receipt(){

    ?>
             <!-- Small Size -->
             <div class="modal fade" id="deposite_payback_Modal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-body">
                           	<div id="printThis" style="font-size:12px">
                          			<?php
                                        global $conn;

                                        $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_company_profile ");
                                        $stmt->execute();
                
                                        $rows = $stmt->rowCount();
                                        
                                        if ($rows>0)
                                        {
                                            
                                            $row = $stmt->fetch();
                                            
                                            $company_name = $row->name;
                                            $address = $row->address;
                                            $phone1 = $row->phone1; 
                                            $phone2 = $row->phone2;
                                            $email = $row->email;  
                                            $logo = $row->logo;
                                                                            
                                        }
								?>
                           			<div style="text-align: center"><img src="../images/logos/<?php echo $logo; ?>" width="90" height="80"  /></div>
                           			<div style="text-align: center;">
										<label id="bus_name"><?php echo $company_name; ?></label><br>
										<label id="bus_address"><?php echo $address; ?></label><br>
										<label id="bus_contact"><?php echo $phone1 . ", " .$phone2; ?></label>
									</div>
                           			<div style="float: left">Ref: <label  id="modal_depo_ref"></label></div> 
                           			<div class="pull-right" ><label id="modal_depo_date"></label></div><br>
                           			
                           			<div style="text-align: center">
										<label>Payment Type: </label> <label id="modal_payment_type"> #### </label><br>
										<label>Amount Tendered: </label> <label id="modal_amount"> ####</label><br>
										<label>Remaining Balance: </label> <label id="modal_balance"> ####</label>
										
									</div>
                          			<div><label id="modal_footer">cashier: <?php echo $_SESSION["cur_user"];?>,</label><label id="modal_footer_date"> </label></div>
                           	</div>
                        </div>
                        <div class="modal-footer">
                           	
                            <button type="button" class="btn btn-link waves-effect" onClick="printDiv('printThis')">Print Receipt</button>
                            <button type="button" class="btn btn-link waves-effect" id="modal_close" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ======  end of small modal ========-->
            
    <?php
}

function message($type, $bg, $text){
	
	// type == dismissable or normal
		
		$msg = "<div class='alert bg-$bg alert-dismissible'>";
								
		if ($type == 'x'){ 
			
			$msg .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		}
		
		$msg .= ''.$text.'</div>';
	
	echo $msg;
}

function dailySales(){

    $today = date("Y-m-d");
	$sales = 0;
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_st_sales WHERE date = :today ");
    $stmt->execute(['today' => $today]);

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        
        $row = $stmt->fetch();
        
        $sales = $row->amount;
        return $sales;
                                        
    }else {
        return $sales;
    }
	
}

function dailyQty(){
	
    $today = date("Y-m-d");
    $qty = 0;
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_st_sales WHERE date = :today ");
    $stmt->execute(['today' => $today]);

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        
        $row = $stmt->fetch();
        
        $qty = $row->qty;
        return $qty;
                                        
    }else {
        return $qty;
    }
	
}

function monthlySales(){
	
    $year = date("Y"); 
    $month = date("m");
    $totalSales = 0;
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_st_sales WHERE MONTH(date)= :month AND YEAR(date)= :year");
    $stmt->execute(['month' => $month, 'year' => $year]);

    $rows = $stmt->rowCount();
    //BUG Discuss with CEO bekamata $totalSales nachikin for loop ba kamar yadda yake da a nasa
    if ($rows>0)
    {
        for ($i=0; $i < $rows; $i++) { 

            $row = $stmt->fetch();
            $sales = $row->amount;
            
            $totalSales+=$sales;
        }
        
    }else {
        $totalSales = 0;
    }
	
	return $totalSales;
}

function totalItems(){
	
	global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_items ");
    $stmt->execute();

    $rows = $stmt->rowCount();
		
	return $rows;
	
}


function getTotalSalesType($type, $date1, $date2){

    $total = 0;
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_payment_analysis WHERE date BETWEEN ? AND ? AND status <> 'returned' ");
    $stmt->execute([$date1, $date2]);

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        while($row = $stmt->fetch()){

            switch ($type){

                case 1: 
                    $total += $row->cash; 
                break;
                case 2: 
                    $total += $row->pos;
                break;
                case 3: 
                    $total += $row->transfer; 
                break;
                case 4: 
                    $total += $row->amount; 
                break;

            }

        }
    }

    return $total;
}

function initializeTables($business_id){
    
    global $conn;

    require_once("initialize_tables.php");

    if ($audit_trail && $auto_inc_audit_trail && $borrow && $auto_inc_borrow && $borrow_trans && $business_profile && $auto_inc_business_profile &&
    $categories && $auto_inc_cat && $company_profile && $customers && $auto_inc_customers && $daily_sales && $auto_inc_daily_sales && $items &&
    $auto_incerement_items && $items_serials && $auto_inc_items_serials && $order_details && $auto_inc_order_details && $payment_analysis &&
    $auto_inc_payment_analysis && $payment_details && $auto_inc_payment_details && $placed_order && $auto_inc_placed_order && $return && 
    $sales && $auto_inc_sales && $st_items && $auto_inc_st_items && $st_sales && $auto_inc_st_sales && $suppliers && $auto_inc_suppliers &&
    $trans && $users) {
        return true;
    }else{
        return false;
    }
    
}

function logged_in(){
    return (isset($_SESSION['cur_user']) && isset($_SESSION["business_id"]) && isset($_SESSION["clearance"])) ? true : false;
    
    //if ($_SESSION['cur_user'] == "") {return false;} else {return true;}
}

function checkBusinessStart(){
    global $conn;

    $business_id = $_SESSION["business_id"];

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_business_profile");
    $stmt->execute();

    $rows = $stmt->rowCount();

    if ($rows >= 1) {
        return true;
    }else {
        return false;
    }

}

function checkChangePassword($username){

    global $conn;

    $stmt = $conn->prepare("SELECT recover_password FROM ".$_SESSION["business_id"]."_users WHERE username = :username AND recover_password = 'yes'");
    $stmt->execute(['username' => $username]);

    $rows = $stmt->rowCount();
    
    return (($rows) >= 1) ? true : false;
}

function checkSubscription($businessID){

    global $conn;

    $stmt = $conn->prepare("SELECT expiryDate FROM license_mst WHERE businessID = '$businessID' ");
    $stmt->execute();

    $rows = $stmt->rowCount();
    
    if ($rows >= 1) {

        $row = $stmt->fetch();

        $expiryDate = strtotime($row->expiryDate);
        $today = strtotime(date("Y-m-d H:i:s"));

        if ($today > $expiryDate) {
            return false;
        }else{
            return true;
        }

    }else {
        return false;
    }
    
    //return ($rows >= 1) ? true : false;
}

function checkCategoryExists(){
    
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_categories");
    $stmt->execute();

    $rows = $stmt->rowCount();
    
    if ($rows >= 1) {
        return true;
    }else {
        header ("Location: categories.php?error=nocategory");
    }

}

function protectPage($clearance){
    $page = explode('/', $_SERVER['SCRIPT_NAME']);
    $currentPage = end($page);

    if (logged_in() === false) {
        logout();
        exit();
    } else {

        autologout(900);

        if($currentPage !== 'index.php' && (isset($_SESSION["clearance"]) < $clearance) ){
            header('location:index.php');
            exit();
        }
    }


    if($currentPage !== 'change_password.php' && checkChangePassword($_SESSION["cur_user"]) == true){
        header('location:change_password.php');
	    exit();
    }

    //if($currentPage !== 'subscription.php' && checkSubscription($_SESSION["business_id"]) == false){
      //  header('location:subscription.php');
	    //exit();
    //}

}

function sanitize($string){
    $string = trim($string);
    //$string = strip_tags($string);
    $string = htmlentities($string);
    $string = stripslashes($string);
    return ($string);
}

function escape($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function token(){
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
    return $_SESSION['token'];
}

function notify($msg,$owner,$subject,$from){
			
    $fromMail = $from;
    $boundary = str_replace(" ", "", @date('l jS \of F Y h i s A'));
    $subjectMail = $subject;
    $toMail=$owner;

    $message = $msg;


    $headersMail = '';
    $headersMail .= 'From: ' . $fromMail . "\r\n" . 'Reply-To: ' . $fromMail . "\r\n";
    $headersMail .= 'Return-Path: ' . $fromMail . "\r\n";

    if(mail($toMail, $subjectMail, $message, $headersMail)){
        return true;
    }else {
        return false;
    }

}


function getCustomerBal($customer) {

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_customers WHERE  ID= :customer ");
    $stmt->execute(['customer' => $customer]);

    $rows = $stmt->rowCount();

    if ($rows>0){

        $row = $stmt->fetch();
 
        $total_debt = $row->total_debt;
        $total_credit = $row->total_credit;
     
        return ($total_credit - $total_debt); 
     }
  
}

function updateBusinesses($business_id){

    global $conn;
    
    $date_verified = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("UPDATE businesses SET active_status = 'active', verified_status = 'verified', date_verified = '$date_verified' WHERE business_id = :business_id ");
    $query = $stmt->execute(['business_id' => $business_id]);

    if ($query) {
        return true;
    }else {
        return false;
    }

}
 
function getDailyDeposites($date1, $date2, $type, $payment_class){
    //Look for better way to include payment class in prepared statement
    global $conn;
    $total_deposites = 0;

    if($payment_class){ 
        $sql = "SELECT * FROM ".$_SESSION["business_id"]."_payment_details WHERE date between '$date1' and '$date2' and payment_type='$payment_class' ";
    }else {
        $sql = "SELECT * FROM ".$_SESSION["business_id"]."_payment_details where date between '$date1' and '$date2' ";
    }

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $rows = $stmt->rowCount();

        if ($rows>0){

            while($row = $stmt->fetch()){
                
                $amount = $row->amount;
                $cash_amount = $row->cash;
                $pos_amount = $row->pos;
                $transfer_amount = $row->transfer;

                switch ($type){

                    case "cash":  $total_deposites += $cash_amount; break;
                    case "pos" : $total_deposites += $pos_amount; break;
                    case "transfer" : $total_deposites += $transfer_amount; break;
                    case "all" : $total_deposites += $amount; break;
                }
                

            }

            return $total_deposites;
        }
}

function insertReturn($trans_id, $reason){
 
    global $conn;
    $user = $_SESSION["cur_user"];
    $today = date("Y-m-d");

    $stmt  = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_return (`id`, `trans_id`, `reason`, `request_by`, `request_date`, `approved_by`, `approved_date`, `status`) VALUES (:id, :trans_id, :reason,	:request_by, :request_date, :approved_by, :approved_date, :status) ");
    $query = $stmt->execute(['id' => "", 'trans_id' => $trans_id, 'reason' => $reason, 'request_by' => $user, 'request_date' => $today, 'approved_by' => "", 'approved_date' => "", 'status' => "awaitingapproval"]);
    
    if ($query) {
        return true;
    }else {
        return false;
    }
}

function companyHeading($data){

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ".$_SESSION["business_id"]."_company_profile ");
    $stmt->execute();

    $rows = $stmt->rowCount();
    
    if ($rows>0)
    {
        
        $row = $stmt->fetch();
        
        $company_name = $row->name;
        $address = $row->address;
        $phone1 = $row->phone1; 
        $phone2 = $row->phone2;
        $email = $row->email;  
        $logo = $row->logo;
                                        
    }
    ?>
        <div style="text-align: center"><img src="../images/logos/<?php echo $logo; ?>" width="90" height="80"  /></div>
            <div style="text-align: center;">
                <label id="bus_name"><?php echo $company_name?></label><br>
                <label id="bus_address"><?php echo $address?></label><br>
                <label id="bus_contact"><?php echo $phone1 . ", " .$phone2; ?></label><br>
                <label id="bus_contact"><?php echo $data; ?></label>
            </div>
    <?php
}


?>
