<?php
ob_start(); include("../inc/config.php"); include("../inc/php_functions.php"); 
list_categories();
?>

<select>
    <option value="">Select Item</option>
    <?php list_categories(); ?>
</select>
