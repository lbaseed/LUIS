<?php
ob_start(); 

include("../inc/config.php"); $_SESSION["business_id"] = 111;include("../inc/php_functions.php"); 

?>

<select>
    <option value="">Select Item</option>
    <?php list_suppliers(); ?>
</select>
