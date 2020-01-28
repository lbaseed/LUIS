<?php  ob_start(); include("../inc/config.php"); include("../inc/php_functions.php"); 


if(isset($_GET['auth']) && isset($_GET['veri'])){

    $email = (trim(str_rot13($_GET['auth'])));
    $verification = (trim($_GET['veri']));

    $stmt = $conn->prepare("SELECT * FROM businesses WHERE email = :email AND verification_code = :verification AND verified_status = 'notverified' ");
    $query = $stmt->execute(['email' => $email, 'verification' => $verification]);

    $rows = $stmt->rowCount();
   
    if ($rows > 0) {
        
        $row = $stmt->fetch();
        $business_id = $row->business_id;
        $verification_expiry = strtotime($row->verification_expiry);
        
        $today = strtotime(date("Y-m-d H:i:s"));

        //Retrived from businesses to insert in compay profile
        $name = $row->business_name;
        $address = $row->business_address;
        $phone1 = $row->phone;
        $email = $row->email;
        $logo = $business_id.".jpg";

        //Test to see if verification has expired
        if ($verification_expiry > $today) {

            //Check to see if tables are created successfully
            if (initializeTables($business_id)) {

                $date_verified = date("Y-m-d H:i:s");
                $active_status = "active";
                $verified_status = "verified";
                
                $username = $business_id. "101";
                $fullname = "admin";
                $password = substr(md5(time()), 0, 10);
                $clrs = 9;
                $active_status = "active";
                $recover_password = "yes";
            
                    
                    $conn->beginTransaction();

                    //Update Businesses table
                    $stmt1 = $conn->prepare("UPDATE businesses SET active_status = 'active', verified_status = 'verified', date_verified = '$date_verified' WHERE business_id = :business_id ");
                    $query1 = $stmt1->execute(['business_id' => $business_id]);

                    //Insert Admin user account
                    $stmt2 = $conn->prepare("INSERT INTO ".$business_id."_users (`username`, `fullname`, `phone`, `email`, `address`, `password`, `active_status`, `recover_password`, `clrs`, `security_question`, `security_answer`) VALUES('$username','$fullname','','','','$password','$active_status','$recover_password','$clrs','','') ");
                    $query2 = $stmt2->execute();

                    //Insert Company profile
                    $stmt3 = $conn->prepare("INSERT INTO ".$business_id."_company_profile (`id`, `name`, `address`, `phone1`, `phone2`, `email`, `website`, `logo`, `date`) VALUES (:id,:name,:address,:phone1,:phone2,:email,:website,:logo,:date) ");
                    $query3 = $stmt3->execute(['id' => "", 'name' => $name, 'address' => $address, 'phone1' => $phone1, 'phone2' => '', 'email' => $email, 'website' => '', 'logo' => $logo, 'date' => '']);
                    
                    if ($query1 && $query2 && $query3) {

                        $from="support@uis.com.ng";
                        $msg="Congratulations!!!\n\n Your registration is complete,\n Kindly use the system appropriately and manage your business.
                            \n\n Your Business ID is ".$business_id." \n Admin Username is ".$business_id."101 \n Password: ".$password." \n\n Thank You for your patronage.";
                        $subj="LUIS - Successful Activation";

                        //Test if email is sent before commit
                        $a = 4;
                        $b = 3;

                        if ($a > $b){//notify($msg,$email,$subj,$from)) {

                            $conn->commit();
                            header("Location: ../pages/message_page.php?activatesuccess&businessid=$business_id&password=$password");

                        }else {

                            $conn->rollback();
                            header("Location: ../pages/message_page.php?activateerror");
                            
                        }
                        
                    } else {
                        header("Location: ../pages/message_page.php?activateerror");
                    }
                    
            }else{
                header("Location: ../pages/message_page.php?activateerror");
            }

        }else {
            header("Location: ../pages/message_page.php?verificationexpire&businessid=$business_id");
        }

    }else{
        header("Location: ../pages/message_page.php?activateerror");
    }

}else {
    header("Location: ../pages/login.php");
}

?>