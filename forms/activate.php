<?php  ob_start(); include("../inc/config.php"); include("../inc/php_functions.php"); 


if(isset($_GET['auth']) and isset($_GET['veri'])){

    $email = mysql_real_escape_string(trim(str_rot13($_GET['auth'])));
    $verification = mysql_real_escape_string(trim($_GET['veri']));
    
    $query1 = mysql_query("SELECT * FROM businesses WHERE email='$email' AND verification_code = '$verification' AND verified_status = 'notverified'") or die(mysql_error());
   
    if (mysql_num_rows($query1) > 0) {
        
        $row = mysql_fetch_array($query1);
        $business_id = $row["business_id"];
        $business_name = $row["business_name"];
        $business_address = $row["business_address"];
        $customer_name = $row["customer_name"];
        $customer_phone = $row["phone"];
        $customer_email = $row["email"];


        $username = $business_id."101";
        $fullname = $customer_name;
        $phone = $customer_phone;
        $address = $customer_address;
        $password = "pass";
        $active_status = 'active';
        $recover_status = 'yes';
        $dt = date("Y-m-d");

        //Function That create tables for the particular business
        initializeTables($business_id);

        $query = mysql_query("INSERT INTO " . $business_id . "_users VALUES('$username','$fullname','$phone','','$address','$password','$active_status', '$recover_status','9','','')");
        $query2 = mysql_query("INSERT INTO " . $business_id . "_company_profile VALUES('','$business_name','$business_address','$customer_phone','','$customer_email','','".$business_id.".jpg','$dt')") or die(mysql_error());

        updateBusinesses($business_id);

                    $from="no-reply@uis.com.ng";
					$url="https://www.uis.com.ng/forms/activate.php?auth=".str_rot13($email)."&veri=".$verification_code." ";
                    $msg="Congratulations!!!\n\n Your registration is complete,\n Kindly use the system appropriately and manage your business.
                    \n\n Your Business ID is ".$business_id." \n Admin Username is ".$business_id."101 \n Password: 'pass' \n\n Thank You for your patronage.";
					$subj="LUIS - New Account";
						notify($msg,$email,$subj,$from);

            if($query){
                //send email

                header("Location: ../pages/message_page.php?activatesuccess&businessid=$business_id");
            }
    
    }else{
        header("Location: ../pages/message_page.php?activateerror");
    }
}else {
    header("Location: ../pages/login.php");
}

?>