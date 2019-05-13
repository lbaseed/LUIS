-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2019 at 01:15 PM
-- Server version: 5.7.25
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uiscomng_uis`
--

-- --------------------------------------------------------

--
-- Table structure for table `118_audit_trail`
--

CREATE TABLE `118_audit_trail` (
  `id` bigint(11) NOT NULL,
  `operation` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `activity` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_business_profile`
--

CREATE TABLE `118_business_profile` (
  `id` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `capital` double NOT NULL,
  `turnover` double NOT NULL,
  `profit` double NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_categories`
--

CREATE TABLE `118_categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `118_company_profile`
--

CREATE TABLE `118_company_profile` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `phone1` varchar(30) NOT NULL,
  `phone2` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `website` text NOT NULL,
  `logo` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_customers`
--

CREATE TABLE `118_customers` (
  `ID` int(11) NOT NULL,
  `full_name` text,
  `address` text,
  `phone` varchar(30) DEFAULT NULL,
  `total_debt` double NOT NULL,
  `total_credit` double NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_daily_sales`
--

CREATE TABLE `118_daily_sales` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `category_daily_total` double NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `118_items`
--

CREATE TABLE `118_items` (
  `item_id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `qty` double NOT NULL,
  `cost_price` double NOT NULL,
  `sale_price` double NOT NULL,
  `cat_id` int(11) NOT NULL,
  `med_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `barcode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `118_items_serials`
--

CREATE TABLE `118_items_serials` (
  `id` bigint(20) NOT NULL,
  `item` int(11) NOT NULL,
  `serialNumber` varchar(200) NOT NULL,
  `sales_id` bigint(20) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_order_details`
--

CREATE TABLE `118_order_details` (
  `oid` bigint(20) NOT NULL,
  `item_id` varchar(100) NOT NULL,
  `qty` double NOT NULL,
  `price` double NOT NULL,
  `value` double NOT NULL,
  `ref` varchar(100) NOT NULL,
  `qtySupplied` double NOT NULL,
  `priceSupplied` double NOT NULL,
  `valueOfSupplied` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_payment_analysis`
--

CREATE TABLE `118_payment_analysis` (
  `id` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `tid` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  `cash` double NOT NULL,
  `pos` double NOT NULL,
  `transfer` double NOT NULL,
  `balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_payment_details`
--

CREATE TABLE `118_payment_details` (
  `id` bigint(20) NOT NULL,
  `cust_id` bigint(11) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_placed_order`
--

CREATE TABLE `118_placed_order` (
  `ref` int(11) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `valueOrdered` double NOT NULL,
  `dateOrdered` date NOT NULL,
  `dateSupplied` date NOT NULL,
  `valueSupplied` double NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_sales`
--

CREATE TABLE `118_sales` (
  `sales_id` bigint(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `cost_price` double NOT NULL,
  `sold_price` double NOT NULL,
  `sub_total` double NOT NULL,
  `trans_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `cashier` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_st_items`
--

CREATE TABLE `118_st_items` (
  `id` bigint(20) NOT NULL,
  `item` int(11) NOT NULL,
  `qty` double NOT NULL,
  `date` date NOT NULL,
  `user` int(11) NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_st_sales`
--

CREATE TABLE `118_st_sales` (
  `id` bigint(11) NOT NULL,
  `amount` double NOT NULL,
  `qty` double NOT NULL,
  `date` date NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_trans`
--

CREATE TABLE `118_trans` (
  `tid` bigint(20) NOT NULL,
  `total_sales` double NOT NULL,
  `date` date NOT NULL,
  `mop` varchar(11) NOT NULL,
  `amount_tendered` double NOT NULL,
  `change` int(11) NOT NULL,
  `balance` double NOT NULL,
  `cid` int(11) NOT NULL,
  `cashier` varchar(200) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `118_users`
--

CREATE TABLE `118_users` (
  `username` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `password` varchar(64) NOT NULL,
  `active_status` varchar(20) NOT NULL,
  `recover_password` varchar(20) NOT NULL,
  `clrs` int(11) NOT NULL,
  `security_question` text NOT NULL,
  `security_answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `118_users`
--

INSERT INTO `118_users` (`username`, `fullname`, `phone`, `email`, `address`, `password`, `active_status`, `recover_password`, `clrs`, `security_question`, `security_answer`) VALUES
(118101, 'admin', 'admin', '', 'admin', 'pass', 'active', 'no', 9, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `118_audit_trail`
--
ALTER TABLE `118_audit_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `118_business_profile`
--
ALTER TABLE `118_business_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `118_categories`
--
ALTER TABLE `118_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `118_company_profile`
--
ALTER TABLE `118_company_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `118_customers`
--
ALTER TABLE `118_customers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `118_daily_sales`
--
ALTER TABLE `118_daily_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `118_items`
--
ALTER TABLE `118_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `118_items_serials`
--
ALTER TABLE `118_items_serials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `118_order_details`
--
ALTER TABLE `118_order_details`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `118_payment_analysis`
--
ALTER TABLE `118_payment_analysis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `118_payment_details`
--
ALTER TABLE `118_payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `118_placed_order`
--
ALTER TABLE `118_placed_order`
  ADD PRIMARY KEY (`ref`);

--
-- Indexes for table `118_sales`
--
ALTER TABLE `118_sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `118_st_items`
--
ALTER TABLE `118_st_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `118_st_sales`
--
ALTER TABLE `118_st_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `118_trans`
--
ALTER TABLE `118_trans`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `118_users`
--
ALTER TABLE `118_users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `118_audit_trail`
--
ALTER TABLE `118_audit_trail`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `118_business_profile`
--
ALTER TABLE `118_business_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `118_categories`
--
ALTER TABLE `118_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `118_customers`
--
ALTER TABLE `118_customers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `118_daily_sales`
--
ALTER TABLE `118_daily_sales`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `118_items`
--
ALTER TABLE `118_items`
  MODIFY `item_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=514;

--
-- AUTO_INCREMENT for table `118_items_serials`
--
ALTER TABLE `118_items_serials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `118_order_details`
--
ALTER TABLE `118_order_details`
  MODIFY `oid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `118_payment_analysis`
--
ALTER TABLE `118_payment_analysis`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `118_payment_details`
--
ALTER TABLE `118_payment_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `118_placed_order`
--
ALTER TABLE `118_placed_order`
  MODIFY `ref` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `118_sales`
--
ALTER TABLE `118_sales`
  MODIFY `sales_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `118_st_items`
--
ALTER TABLE `118_st_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `118_st_sales`
--
ALTER TABLE `118_st_sales`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `118_users`
--
ALTER TABLE `118_users`
  MODIFY `username` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118102;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
