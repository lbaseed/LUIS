<?php

			require("../../inc/config.php");



$id = $_GET["cid"];

	
	$q = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_customers where ID='$id' ");

$output = array();

if (mysql_num_rows($q)>0){
	
	while($row = mysql_fetch_array($q)){
		$output[] = $row;
	} 
	
	print(json_encode($output));
}
	


?>