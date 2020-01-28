-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2020 at 12:28 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uis`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `business_id` bigint(20) NOT NULL,
  `business_name` varchar(200) NOT NULL,
  `business_address` varchar(200) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `date_registered` datetime NOT NULL,
  `active_status` varchar(15) NOT NULL DEFAULT '0',
  `verified_status` varchar(15) NOT NULL,
  `verification_code` varchar(64) NOT NULL,
  `verification_expiry` datetime NOT NULL,
  `date_verified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `license_hst`
--

CREATE TABLE `license_hst` (
  `id` int(11) NOT NULL,
  `bussinessID` varchar(15) NOT NULL,
  `transactionID` varchar(20) NOT NULL,
  `subscriptionDate` datetime NOT NULL,
  `expiryDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `license_mst`
--

CREATE TABLE `license_mst` (
  `id` int(11) NOT NULL,
  `businessID` varchar(15) NOT NULL,
  `expiryDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions_trn`
--

CREATE TABLE `transactions_trn` (
  `id` int(11) NOT NULL,
  `payee` varchar(30) NOT NULL,
  `amountPaid` decimal(12,2) NOT NULL,
  `purposeCode` varchar(10) NOT NULL,
  `modeOfPayment` varchar(50) NOT NULL,
  `tellerNumber` varchar(15) NOT NULL,
  `bankPaidTo` varchar(100) NOT NULL,
  `accountNumber` varchar(15) NOT NULL,
  `transactionDate` date NOT NULL,
  `insertDate` date NOT NULL,
  `approvalStatus` varchar(12) NOT NULL,
  `approvalDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`business_id`);

--
-- Indexes for table `license_hst`
--
ALTER TABLE `license_hst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `license_mst`
--
ALTER TABLE `license_mst`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions_trn`
--
ALTER TABLE `transactions_trn`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `business_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `license_hst`
--
ALTER TABLE `license_hst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `license_mst`
--
ALTER TABLE `license_mst`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions_trn`
--
ALTER TABLE `transactions_trn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
