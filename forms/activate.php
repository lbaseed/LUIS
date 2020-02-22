<?php  ob_start(); include("../inc/config.php"); include("../inc/php_functions.php"); 


if(isset($_GET['auth']) and isset($_GET['veri'])){

    $email = mysql_real_escape_string(trim(str_rot13($_GET['auth'])));
    $verification = mysql_real_escape_string(trim($_GET['veri']));

    $stmt = $conn->prepare("SELECT * FROM businesses WHERE email = :email AND verification_code = :verification AND verified_status = 'notverified' ");
    $query1 = $stmt->execute(['email' => $email, 'verification' => $verification]);

    $rows = $stmt->rowCount();
   
    if ($rows > 0) {
        
        $row = $stmt->fetch();

        $business_id = $row->business_id;
        $business_name = $row->business_name;
        $business_address = $row->business_address;
        $customer_name = $row->customer_name;
        $customer_phone = $row->phone;
        $customer_email = $row->email;


        $username = $business_id."101";
        $fullname = $customer_name;
        $phone = $customer_phone;
        $address = $business_address;
        $password = "pass";
        $active_status = 'active';
        $recover_status = 'yes';
        $dt = date("Y-m-d");
        $logo = $business_id.".jpg";

        //Function That create tables for the particular business
        initializeTables($business_id);

        $stmt = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_users (username, fullname, phone, email, address, password, active_status, recover_password, clrs, security_question, security_answer) VALUES (:username, :fullname, :phone, :email, :address, :password, :active_status, :recover_password, :clrs, :security_question, :security_answer) ");
		$query = $stmt->execute(['username' => $username, 'fullname' => $fullName, 'phone' => $phone, 'email' => "", 'address' => $address, 'password' => $password, 'active_status' => $active_status, 'recover_password' => $recover_status, 'clrs' => 9, 'security_question' => "", 'security_answer' => "" ]);
            
        $stmt2 = $conn->prepare("INSERT INTO ".$_SESSION["business_id"]."_company_profile (id, name, address, phone1, phone2, email, website, logo, date) VALUES (:id, :name, :address, :phone1, :phone2, :email, :website, :logo, :date) ");
		$query2 = $stmt2->execute(['id' => "", 'name' => $business_name, 'address' => $business_address, 'phone1' => $customer_phone, 'phone2' => "", 'email' => $customer_email, 'website' => "", 'logo' => $logo, 'date' => $dt ]);
			
        updateBusinesses($business_id);

                    $from="support@uis.com.ng";
					//$url="https://www.uis.com.ng/forms/activate.php?auth=".str_rot13($email)."&veri=".$verification_code." ";
                    $msg="Congratulations!!!\n\n Your registration is complete,\n Kindly use the system appropriately and manage your business.
                    \n\n Your Business ID is ".$business_id." \n Admin Username is ".$business_id."101 \n Password: pass \n\n Thank You for your patronage.";
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