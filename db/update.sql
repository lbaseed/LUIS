CREATE TABLE `111_return` (
  `id` bigint(20) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `request_by` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `approved_by` int(11) NOT NULL,
  `approved_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE 111_return AUTO_INCREMENT=100;
ALTER TABLE 111_trans ADD COLUMN status varchar(20);
ALTER TABLE 111_sales ADD COLUMN status varchar(20);
ALTER TABLE 111_payment_analysis ADD COLUMN status varchar(20);


CREATE TABLE `111_borrow` (
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

ALTER TABLE `105_order_details`
  DROP `qtySupplied`,
  DROP `priceSupplied`,
  DROP `valueOfSupplied`;


  CREATE TABLE IF NOT EXISTS `105_suppliers` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `full_name` text,
  `address` text,
  `phone` varchar(30) DEFAULT NULL,
  `total_debt` double NOT NULL,
  `total_credit` double NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;
ALTER TABLE `105_suppliers` AUTO_INCREMENT = 100;
<<<<<<< HEAD
=======


CREATE TABLE `111_borrow_trans` (
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
 PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
>>>>>>> mylocal
