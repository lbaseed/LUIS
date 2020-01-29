<?php  
ob_start(); 
include("../inc/config.php"); 
include("../inc/php_functions.php"); 
		
if(isset($_POST["post"]))
{
						
    $customer_name = (strtoupper($_POST["customer_name"]));
	$business_name = (strtoupper($_POST["business_name"]));
	$business_address = $_POST["business_address"];
	$email = (strtolower($_POST["email"]));
	$phone = ($_POST["phone"]);
    $agree = ($_POST["terms"]);
	
	$active_status = 'notactive';
	$verified_status = 'notverified';
	$date_registered = date("Y-m-d H:i:s");
	$verification_expiry = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", time()). " + 1 day"));
	$verification_code = md5(hash("whirlpool", $customer_name.$business_name + microtime()));
	
	if(!empty($agree))
	{
		$conn->beginTransaction();

		if (!empty($customer_name) && !empty($business_name) && !empty($business_address) && !empty($phone) && !empty($email))
		{
			$stmt  = $conn->prepare("INSERT INTO businesses (business_id, business_name, business_address, customer_name, phone, email, date_registered, active_status, verified_status, verification_code, verification_expiry, date_verified) VALUES (:business_id, :business_name, :business_address, :customer_name, :phone, :email, :date_registered, :active_status, :verified_status, :verification_code, :verification_expiry, :date_verified) ");
    		$query = $stmt->execute(['business_id' => "", 'business_name' => $business_name, 'business_address' => $business_address, 'customer_name' => $customer_name, 'phone' => $phone, 'email' => $email, 'date_registered' => $date_registered, 'active_status' => $active_status, 'verified_status' => $verified_status, 'verification_code' => $verification_code, 'verification_expiry' => $verification_expiry, 'date_verified' => ""]);

			if ($query) {

				$from="support@uis.com.ng";
				$url="https://luis.aws.com.ng/forms/activate.php?auth=".str_rot13($email)."&veri=".$verification_code." ";
				$msg="Yor registration is almost complete,\n Kindly follow this link  ".$url." to complete it \n\n".
				"Link is only valid for 24 hours";
				$subj="LUIS - New Account";


				if(notify($msg,$email,$subj,$from)){
					$conn->commit();
					header("Location: ../pages/message_page.php?signupsuccess");
				}else {
					$conn->rollback();
					header("Location: ../pages/sign-up.php?failedsignup");
				}
				
			}else {
				header("Location: ../pages/sign-up.php?failedsignup");
			}
			
		} else {
			header("Location: ../pages/sign-up.php?emptyfield");
		}
	}
}else {
	header("location: ../pages/login.php");
}

					

?>