<?php
ob_start(); include("../inc/config.php"); include("../inc/php_functions.php"); 

echo $currentPage = end(explode('/', $_SERVER['SCRIPT_NAME']));

echo $_SESSION["cur_user"];
if(checkChangePassword($_SESSION["cur_user"])){
    echo "Good";
}
exit();

if($currentPage !== 'change_password.php' && checkChangePassword($_SESSION["cur_user"]) === true){
    header('location:change_password.php');
    exit();
}