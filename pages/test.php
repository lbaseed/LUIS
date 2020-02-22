<?php
<<<<<<< HEAD
//Study roll back and apply
ob_start(); 
include("../inc/config.php"); 
include("../inc/php_functions.php");   

//echo date("Y-m-d H:i:s ", "1577964063");

//2days sub
	$subDate = "2020-01-06 10:52:39";
	$expDate = "2020-01-08 10:52:39";  

//2month sub
	$now = "2020-01-06 11:00:57";
	$expDateMonth = "2020-03-06 11:00:57";

//validity
	
	$str_daily_sub = strtotime($now);
	$str_daily_exp = strtotime($expDate);

	if($str_daily_exp >= $str_daily_sub){
		//prev sub has some validity;
		$prev_sub_validity = $str_daily_exp - $str_daily_sub;
		
		$str =  $prev_sub_validity + strtotime($expDateMonth);
	
		//echo date("Y-m-d H:i:s" ,$str);
	}

//echo date("Y-m-d H:i:s", strtotime($now));
$used = strtotime($expDateMonth) - strtotime($now);
echo $used;

//echo date("Y-m-d H:i:s", strtotime($used));

=======
include("../inc/config.php"); include("../inc/php_functions.php");   
>>>>>>> 24d3b945d4a071e7bb6adb383d5cd4ce7efb16bf

//echo substr(md5(time()), 0, 10);

//date_default_timezone_set("Africa/Lagos");

//echo "<p>" . date("M d, Y h:i a") . "</p>";
    $business_id = 1;

    //require_once("../inc/initialize_tables.php");

    $verification_expiry = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", time()). " + 1 day"));
    
    $date_verified = date("Y-m-d H:i:s");
    $active_status = "active";
    $verified_status = "verified";

    //$stmt = $conn->prepare("UPDATE businesses SET active_status = :active_status, verified_status = :verified_status, date_verified = :date_verified WHERE business_id = :business_id ");
    //$query = $stmt->execute(['active_status' => $active_status, 'verified_status' => $verified_status, 'date_verified' => $date_verified, 'business_id' => $business_id]);


$verification_code = "063456a40db2b4a8159a0e81a691dae2";
echo $url="localhost:81/k9is/luis/forms/activate.php?auth=".str_rot13("jambandu@gmail.com")."&veri=".$verification_code." ";


    


?>
