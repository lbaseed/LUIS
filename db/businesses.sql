-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2019 at 11:09 AM
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
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `business_id` bigint(20) NOT NULL,
  `business_name` varchar(200) NOT NULL,
  `business_address` varchar(200) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `date_registered` date NOT NULL,
  `active_status` varchar(15) NOT NULL DEFAULT '0',
  `verified_status` varchar(15) NOT NULL,
  `verification_code` varchar(64) NOT NULL,
  `date_verified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`business_id`, `business_name`, `business_address`, `customer_name`, `phone`, `email`, `date_registered`, `active_status`, `verified_status`, `verification_code`, `date_verified`) VALUES
(1, 'Afreen Med Store', 'Along T/Dukku Road', 'Abdulbasid Haruna', '08064701206', 'lbaseed2010@gmail.com', '2019-03-04', '0', '0', '00e8d85e2b998a4e91738920596d6a15', '0000-00-00'),
(105, 'Shagon Albasa', 'Gandun albasa bakin titi', 'Sani', '0802225552', 'albasa@gmail.com', '2019-02-20', '1', '1', 'c4b4387390d976e93c9b65375ae77881', '0000-00-00'),
(106, 'Afreen Farms', 'Along Kalshingi Road', 'Abdulbasid Haruna', '08064701206', 'lbaseed2010@gmail.com', '2019-03-04', '0', '0', 'c0b2ea4b5b774dd16a44e3800d47c262', '0000-00-00'),
(110, 'JAMBANDU VENTURES', 'OPP Coca Cola Deport', 'Alh. Babawuro Sani', '08064701206', 'abdul@k9is.com', '2019-03-04', 'active', 'verified', 'a77720a89241848e74151b7a36c04d56', '2019-03-04'),
(111, 'Jambandu Ventures', 'Opp Coca Cola Deport', 'Alh. Babawuro Sani', '08064701206', 'lbaseed2010@gmail.com', '2019-03-04', '1', '1', 'd862253179ba5e6d1a7ca5553b9d2edc', '2019-03-04'),
(112, 'k9 Printing Press', 'federeal low cost', 'Abdulbasid Haruna', '08087470716', 'abdul@k9is.com', '2019-03-05', '1', '1', 'd49283ebce285fbc69c47b13445e712a', '2019-03-05'),
(113, 'Pearls Mart', 'No 2 Jalo Waziri Street, Gombe', 'Aishatu Usman Muhammad ', '08065681958', 'pearlsmart2019@gmail.com', '2019-03-07', 'active', 'verified', '5117cc7d9ed96d22c41e61f16a5e973f', '2019-03-07'),
(115, 'K9 TAILORING', 'Gombe main market', 'Abdulbasid Haruna', '08064701206', 'lbaseed2010@gmail.com', '2019-03-08', 'active', 'verified', '7d660bff53d8d0cda8fbccc04af178fa', '2019-03-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`business_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `business_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
