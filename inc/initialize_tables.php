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

    $audit_trail = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_audit_trail` (
            `id` bigint(11) NOT NULL AUTO_INCREMENT,
            `operation` varchar(50) NOT NULL,
            `date` date NOT NULL,
            `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `user` int(11) NOT NULL,
            `activity` text NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
      
    ");

    $auto_inc_audit_trail = $conn->query("ALTER TABLE `".$business_id."_audit_trail` AUTO_INCREMENT=100 ");

    $borrow = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_borrow` (
            `borrow_id` bigint(20) NOT NULL AUTO_INCREMENT,
            `item_id` int(11) NOT NULL,
            `qty` double NOT NULL,
            `cost_price` double NOT NULL,
            `borrow_price` double NOT NULL,
            `sub_total` double NOT NULL,
            `trans_id` int(11) NOT NULL,
            `date` date NOT NULL,
            `cashier` varchar(200) NOT NULL,
            PRIMARY KEY (`borrow_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");
    
    $auto_increment_borrow = $conn->query("ALTER TABLE `".$business_id."_borrow` AUTO_INCREMENT=100");
	
	$borrow_trans = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_borrow_trans` (
            `tid` bigint(20) NOT NULL,
            `total_sales` double NOT NULL,
            `date` date NOT NULL,
            `mop` varchar(11) NOT NULL,
            `amount_tendered` double NOT NULL,
            `change` int(11) NOT NULL,
            `balance` double NOT NULL,
            `cid` int(11) NOT NULL,
            `cashier` varchar(200) NOT NULL,
            `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`tid`);
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");
    
    $business_profile = $conn->query("
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

    $auto_inc_business_profile = $conn->query("ALTER TABLE `".$business_id."_business_profile` AUTO_INCREMENT=100 ");

    $categories = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_categories` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` text NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $auto_inc_cat = $conn->query("ALTER TABLE `".$business_id."_categories` AUTO_INCREMENT=100 ");

    $company_profile = $conn->query("
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

    $customers = $conn->query("
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

    $auto_inc_customers = $conn->query("ALTER TABLE `".$business_id."_customers` AUTO_INCREMENT=100 ");

    $daily_sales = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_daily_sales` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `date` date NOT NULL,
            `category_daily_total` double NOT NULL,
            `category` int(11) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $auto_inc_daily_sales = $conn->query("ALTER TABLE `".$business_id."_daily_sales` AUTO_INCREMENT=100 ");

    $items = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_items` (
            `item_id` bigint(20) NOT NULL AUTO_INCREMENT,
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

    $auto_incerement_items = $conn->query("ALTER TABLE `".$business_id."_items` AUTO_INCREMENT=100 ");

    $items_serials = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_items_serials` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `item` int(11) NOT NULL,
            `serialNumber` varchar(200) NOT NULL,
            `sales_id` bigint(20) NOT NULL,
            `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $auto_inc_items_serial = $conn->query("ALTER TABLE `".$business_id."_items_serial` AUTO_INCREMENT=100 ");

    $order_details = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_order_details` (
            `oid` bigint(100) NOT NULL AUTO_INCREMENT,
            `item_id` varchar(100) NOT NULL,
            `qty` double NOT NULL,
            `price` double NOT NULL,
            `value` double NOT NULL,
            `ref` varchar(100) NOT NULL,
            `date` date NOT NULL,
            PRIMARY KEY (`oid`)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
    ");

    $auto_inc_order_details = $conn->query("ALTER TABLE `".$business_id."_order_details` AUTO_INCREMENT=100 ");

    $payment_analysis = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_payment_analysis` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `date` date NOT NULL,
            `tid` varchar(200) NOT NULL,
            `amount` double NOT NULL,
            `cash` double NOT NULL,
            `pos` double NOT NULL,
            `transfer` double NOT NULL,
            `balance` double NOT NULL,
            `status` varchar(20) DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $auto_inc_payment_analysis = $conn->query("ALTER TABLE `".$business_id."_payment_analysis` AUTO_INCREMENT=100 ");

    $payment_details = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_payment_details` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `cust_id` bigint(11) NOT NULL,
            `amount` double NOT NULL,
            `date` date NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $auto_inc_payment_details = $conn->query("ALTER TABLE `".$business_id."_payment_details` AUTO_INCREMENT=100 ");

    $placed_order = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_placed_order` (
            `ref` int(11) NOT NULL AUTO_INCREMENT,
            `supplier` varchar(100) NOT NULL,
            `valueOrdered` double NOT NULL,
            `dateOrdered` date NOT NULL,
            `dateSupplied` date NOT NULL,
            `valueSupplied` double NOT NULL,
            `status` varchar(50) NOT NULL,
            PRIMARY KEY (`ref`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $auto_inc_placed_order = $conn->query("ALTER TABLE `".$business_id."_placed_order` AUTO_INCREMENT=100 ");

    $return = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_return` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `trans_id` int(11) NOT NULL,
            `reason` text NOT NULL,
            `request_by` int(11) NOT NULL,
            `request_date` date NOT NULL,
            `approved_by` int(11) NOT NULL,
            `approved_date` date NOT NULL,
            `status` varchar(20) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $sales = $conn->query("
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
            `status` varchar(20) DEFAULT NULL,
            PRIMARY KEY (`sales_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $auto_inc_sales = $conn->query("ALTER TABLE `".$business_id."_sales` AUTO_INCREMENT=100 ");

    $st_items = $conn->query("
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

    $auto_inc_st_items = $conn->query("ALTER TABLE `".$business_id."_st_items` AUTO_INCREMENT=100 ");

    $st_sales = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_st_sales` (
            `id` bigint(11) NOT NULL AUTO_INCREMENT,
            `amount` double NOT NULL,
            `qty` double NOT NULL,
            `date` date NOT NULL,
            `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $auto_incerement_st_sales = $conn->query("ALTER TABLE `".$business_id."_st_sales` AUTO_INCREMENT=100 ");

    $suppliers = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_suppliers` (
            `ID` bigint(20) NOT NULL AUTO_INCREMENT,
            `full_name` text,
            `address` text,
            `phone` varchar(30) DEFAULT NULL,
            `total_debt` double NOT NULL,
            `total_credit` double NOT NULL,
            PRIMARY KEY (`ID`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $auto_inc_suppliers = $conn->query("ALTER TABLE `".$business_id."_suppliers` AUTO_INCREMENT=100 ");

    $trans = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_trans` (
            `tid` bigint(20) NOT NULL,
            `total_sales` double NOT NULL,
            `date` date NOT NULL,
            `mop` varchar(11) NOT NULL,
            `amount_tendered` double NOT NULL,
            `change` int(11) NOT NULL,
            `balance` double NOT NULL,
            `cid` int(11) NOT NULL,
            `cashier` varchar(200) NOT NULL,
            `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `status` varchar(20) DEFAULT NULL,
            PRIMARY KEY (`tid`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $users = $conn->query("
        CREATE TABLE IF NOT EXISTS `".$business_id."_users` (
            `username` int(11) NOT NULL AUTO_INCREMENT,
            `fullname` text NOT NULL,
            `phone` varchar(15) NOT NULL,
            `email` varchar(200) NOT NULL,
            `address` varchar(200) NOT NULL,
            `password` varchar(64) NOT NULL,
            `active_status` varchar(20) NOT NULL,
            `recover_password` varchar(20) NOT NULL,
            `clrs` int(11) NOT NULL,
            `security_question` text NOT NULL,
            `security_answer` text NOT NULL,
            PRIMARY KEY (`username`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $businesses = $conn->query("
        CREATE TABLE `businesses` (
            `business_id` bigint(20) NOT NULL AUTO_INCREMENT,
            `business_name` varchar(200) NOT NULL,
            `business_address` varchar(200) NOT NULL,
            `customer_name` varchar(100) NOT NULL,
            `phone` varchar(15) NOT NULL,
            `email` varchar(200) NOT NULL,
            `date_registered` date NOT NULL,
            `active_status` varchar(15) NOT NULL DEFAULT '0',
            `verified_status` varchar(15) NOT NULL,
            `verification_code` varchar(64) NOT NULL,
            `date_verified` date NOT NULL,
            PRIMARY KEY (`business_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ");

    $query = $conn->query("INSERT INTO ".$business_id."_users (username, fullname, phone, email, address, password, active_status, recover_password, clrs, security_question, security_answer) VALUES('','$name','','','','$password','$status','','$user_lvl','','') ");

    $address = "demo location";
    $phone = "080x xxx xxxx";
    
	$query2 = $conn->query("INSERT INTO ".$business_id."_company_profile (id, name, address, phone1, phone2, email, website, logo, date) VALUES ('','$name','$address','$phone','$phone','','','$img','') ");
    
    echo "done";

	
    
?>