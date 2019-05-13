<?php  ob_start(); include("../inc/config.php"); include("../inc/php_functions.php"); 

		
if(isset($_POST["post"]))
{
						
    $customer_name = mysql_real_escape_string(strtoupper($_POST["customer_name"]));
	$business_name = mysql_real_escape_string(strtoupper($_POST["business_name"]));
	$business_address = mysql_real_escape_stringstrtoupper($_POST["business_address"]));
	$email = mysql_real_escape_string(strtolower($_POST["email"]));
	$phone = mysql_real_escape_string($_POST["phone"]);
    $agree = mysql_real_escape_string($_POST["terms"]);
	
	$active_status = 'notactive';
	$verified_status = 'notverified';
	$date_registered = date("Y-m-d");
	$verification_code = md5(hash("whirlpool", $customer_name.$business_name + microtime()));
	
	if(!empty($agree))
	{

		if (!empty($customer_name) && !empty($business_name) && !empty($business_address) && !empty($phone) && !empty($email))
		{
				$query = mysql_query("INSERT INTO businesses  VALUES('','$business_name','$business_address','$customer_name','$phone','$email','$date_registered','$active_status','$verified_status','$verification_code','')") or die (mysql_error());

				if ($query) {

					$from="no-reply@uis.com.ng";
					$url="https://www.uis.com.ng/forms/activate.php?auth=".str_rot13($email)."&veri=".$verification_code." ";
					$msg="Yor registration is almost complete,\n Kindly follow this link  ".$url." to complete it \n\n".
                    "Link is only valid for 24 hours";
					$subj="LUIS - New Account";

					if(notify($msg,$email,$subj,$from)){
						header("Location: ../pages/message_page.php?signupsuccess");
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