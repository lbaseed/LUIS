<?php

if(isset($_POST["reset"]))
{
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/LUIS/pages/create-new-password.php?selector=".$selector."$validator=".bin2hex($token);

    $expire = date("U") + 1800;

    $userEmail = $_POST["email"];

    $sql = "delete from pwdReset where pwdEmail =? ";
    if(!$stmt = $conn->prepare($sql))
    {
        echo "There was an Error!";
        exit();
    }else
    {
        $stmt = $conn->prepare($sql)->execute([$userEmail]);

    }

    $sql = "insert into pwdReset(pwdEmail, pwdResetSelector, pwdResetToken, pwdResetExpire) values(?,?,?,?)";
    if(!$stmt = $conn->prepare($sql))
    {
        echo "There was an Error";
        exit();
    }
    else
    {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT); 
        $stmt = $conn->prepare($sql)->execute([$userEmail, $selector, $token, $expire]);
    }

    $to = $userEmail;

    $subject = 'Reset your password for K9is';
    $messege = '<p>We recieved a password reset request, The link to reset your password make
     this request, you can ignore this mail</p>';
     $messege .='<p>Here is your password reset link: <br>';
     $messege .= '<a href="'.$url.'">'.$url.'</a></p>';

     $header = "From: Kolerian <s.kole4real@gmail.com>\r\n";
     $header.="Reply-To: s.kole4real@gmail.com\r\n";
     $header .="Content-type: text/html\r\n";

     mail($to, $subject, $messege, $header);

     header("Location: reset_password.php?reset=success");

}
else
{
    header("location: index.php");
}