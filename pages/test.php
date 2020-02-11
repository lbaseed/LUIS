<?php
include("../inc/config.php"); include("../inc/php_functions.php");   

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
