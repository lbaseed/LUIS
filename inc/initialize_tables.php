<?php
	
include "config.php";

  $business_id = 100;	
  
	$name = "Demo Account";
	$username = $business_id;
	$password = "admin";
	$user_lvl = 9;
	$img = $business_id.".jpg";
	$status = 1;
	$last_login = date("Y-m-d H:i:s");
  
	$audit_trail = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_audit_trail` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `operation` varchar(50) NOT NULL,
    `date` date NOT NULL,
    `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `user` int(11) NOT NULL,
    `activity` text NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  ");
  
	$business_profile = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_business_profile` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `startDate` date NOT NULL,
    `endDate` date NOT NULL,
    `capital` double NOT NULL,
    `turnover` double NOT NULL,
    `profit` double NOT NULL,
    `user` int(11) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");
	
	$categories = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_categories` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` text NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");
	
	$company_profile = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_company_profile` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` text NOT NULL,
    `address` text NOT NULL,
    `phone1` varchar(30) NOT NULL,
    `phone2` varchar(30) NOT NULL,
    `email` text NOT NULL,
    `website` text NOT NULL,
    `logo` text NOT NULL,
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");
	
	$customers = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_customers` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `full_name` text,
    `address` text,
    `phone` varchar(30) DEFAULT NULL,
    `total_debt` double NOT NULL,
    `total_credit` double NOT NULL,
    `type` int(11) NOT NULL,
    PRIMARY KEY (`ID`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");
  
  $daily_sales = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_daily_sales` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `date` date NOT NULL,
    `category_daily_total` double NOT NULL,
    `category` int(11) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  ");
  
	$items = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_items` (
    `item_id` int(11) NOT NULL AUTO_INCREMENT,
    `name` text NOT NULL,
    `qty` double NOT NULL,
    `cost_price` double NOT NULL,
    `sale_price` double NOT NULL,
    `cat_id` int(11) NOT NULL,
    `med_id` int(11) NOT NULL,
    `date` date NOT NULL,
    `status` int(11) NOT NULL,
    `barcode` varchar(200) NOT NULL,
    PRIMARY KEY (`item_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");

	$items_serial = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_items_serials` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `item` int(11) NOT NULL,
    `serialNumber` varchar(200) NOT NULL,
    `sales_id` int(11) NOT NULL,
    `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");

	$order_details = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_order_details` (
    `oid` int(100) NOT NULL AUTO_INCREMENT,
    `pid` varchar(100) NOT NULL,
    `qty` double NOT NULL,
    `price` double NOT NULL,
    `value` double NOT NULL,
    `ref` varchar(100) NOT NULL,
    `qtySupplied` double NOT NULL,
    `priceSupplied` double NOT NULL,
    `valueOfSupplied` double NOT NULL,
    PRIMARY KEY (`oid`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
  ");

  $payment_analysis = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_payment_analysis` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `date` datetime NOT NULL,
    `tid` varchar(200) NOT NULL,
    `amount` double NOT NULL,
    `cash` double NOT NULL,
    `pos` double NOT NULL,
    `transfer` double NOT NULL,
    `balance` double NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  ");

  $payment_details = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_payment_details` (
    `id` bigint(11) NOT NULL AUTO_INCREMENT,
    `ref` int(11) NOT NULL,
    `amount` double NOT NULL,
    `date` date NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  ");

	$placed_order = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_placed_order` (
    `ref` int(11) NOT NULL AUTO_INCREMENT,
    `supplier` varchar(100) NOT NULL,
    `valueOrdered` double NOT NULL,
    `dateOrdered` date NOT NULL,
    `dateSupplied` date NOT NULL,
    `valueSupplied` double NOT NULL,
    `status` varchar(50) NOT NULL,
    PRIMARY KEY (`ref`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
	");

	$sales = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_sales` (
    `sales_id` bigint(20) NOT NULL AUTO_INCREMENT,
    `item_id` int(11) NOT NULL,
    `qty` double NOT NULL,
    `cost_price` double NOT NULL,
    `sold_price` double NOT NULL,
    `sub_total` double NOT NULL,
    `trans_id` int(11) NOT NULL,
    `date` date NOT NULL,
    `cashier` varchar(200) NOT NULL,
    PRIMARY KEY (`sales_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");

	$st_items = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_st_items` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `item` int(11) NOT NULL,
    `qty` double NOT NULL,
    `date` date NOT NULL,
    `user` int(11) NOT NULL,
    `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");

	$st_sales = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_st_sales` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `amount` double NOT NULL,
    `qty` double NOT NULL,
    `date` date NOT NULL,
    `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");

	$trans = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_trans` (
    `tid` int(11) NOT NULL,
    `total_sales` double NOT NULL,
    `date` date NOT NULL,
    `mop` varchar(11) NOT NULL,
    `amount_tendered` double NOT NULL,
    `change` int(11) NOT NULL,
    `balance` double NOT NULL,
    `cid` int(11) NOT NULL,
    `cashier` varchar(200) NOT NULL,
    `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`tid`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");

	$users = mysql_query("
    CREATE TABLE IF NOT EXISTS `".$business_id."_users` (
    `username` int(11) NOT NULL AUTO_INCREMENT,
    `fullname` varchar(100) NOT NULL,
    `phone` varchar(15) NOT NULL,
    `address` varchar(200) NOT NULL,
    `password` varchar(64) NOT NULL,
    `status` tinyint(4) NOT NULL DEFAULT '0',
    `clrs` int(11) NOT NULL,
    `email` varchar(200) NOT NULL,
    `security_question` text NOT NULL,
    `security_answer` text NOT NULL,
    PRIMARY KEY (`username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  ");
  
  
  $query = mysql_query("insert into ".$business_id."_users values('','$name','$username','$password','$user_lvl','$img','$status','$last_login','$business_id')");
  
	$address = "demo location";
	$phone = "080x xxx xxxx";
	$query2 = mysql_query("insert into ".$business_id."_company_profile values ('','$name','$address','$phone','$phone','','','$img','') ");
echo "done";

?>