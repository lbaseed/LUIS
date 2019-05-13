<?php

			require("../../inc/config.php");


$type = $_GET["type"];
$id = $_GET["id"];
if ($type=="one"){
	
	$q = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_items where item_id='$id' ");

$output = array();

if (mysql_num_rows($q)>0){
	
	while($row = mysql_fetch_array($q)){
		$output[] = $row;
	} 
	
	print(json_encode($output));
}
	
}elseif($type=="single"){
	//get single item of a record
	
	$tbl = $_SESSION["business_id"]."_".$_GET["tbl"];
	$id = $_GET["id"];
	$rec = $_GET["rec"];
	$q = mysql_query("SELECT * FROM ".$tbl." where id='$id'");

if (mysql_num_rows($q)>0){
	
	$record = mysql_result($q, 0, "$rec");
	
	echo $record;
}
	
}
else
{
	
	$q = mysql_query("SELECT * FROM ".$_SESSION["business_id"]."_items where status=1 order by `name` ASC");

$output = array();

if (mysql_num_rows($q)>0){
	
	while($row = mysql_fetch_array($q)){
		$output[] = $row;
	} 
	
	print(json_encode($output));
}
	
}

?>