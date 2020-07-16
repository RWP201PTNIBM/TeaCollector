-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2020 at 01:46 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tea_collector_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Register_Admin` (IN `emp_name` VARCHAR(50), IN `nic_no` VARCHAR(12), IN `user_name` VARCHAR(15), IN `password` VARCHAR(15), IN `email` VARCHAR(70))  NO SQL
    SQL SECURITY INVOKER
BEGIN

INSERT INTO tea_collector_db.employee (emp_name, nic_no, email) VALUES (emp_name, nic_no, email);
SELECT emp_no AS LastID INTO @EMP_NO FROM tea_collector_db.employee WHERE emp_no = @@Identity LIMIT 1;
INSERT INTO tea_collector_db.account (user_name, password,acc_type,emp_no) VALUES (user_name, password, 'ADMIN',@EMP_NO);
COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Register_Driver` (IN `emp_name` VARCHAR(50), IN `nic_no` VARCHAR(12), IN `user_name` VARCHAR(15), IN `password` VARCHAR(15), IN `license_no` VARCHAR(25), IN `vehicle_no` VARCHAR(9), IN `phone_no` INT(10))  NO SQL
    SQL SECURITY INVOKER
BEGIN

INSERT INTO tea_collector_db.employee (emp_name, nic_no) VALUES (emp_name, nic_no);
SELECT emp_no AS LastID INTO @EMP_NO FROM tea_collector_db.employee WHERE emp_no = @@Identity LIMIT 1;
INSERT INTO tea_collector_db.account (user_name, password,acc_type,emp_no) VALUES (user_name, password, 'DRIVER',@EMP_NO);
INSERT INTO tea_collector_db.driver (license_no, vehicle_no, phone_no, emp_no) VALUES (license_no, vehicle_no, phone_no, @EMP_NO);
COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Register_Officer` (IN `emp_name` VARCHAR(50), IN `nic_no` VARCHAR(12), IN `user_name` VARCHAR(15), IN `password` VARCHAR(15), IN `email` VARCHAR(70))  NO SQL
    SQL SECURITY INVOKER
BEGIN

INSERT INTO tea_collector_db.employee (emp_name, nic_no, email) VALUES (emp_name, nic_no, email);
SELECT emp_no AS LastID INTO @EMP_NO FROM tea_collector_db.employee WHERE emp_no = @@Identity LIMIT 1;
INSERT INTO tea_collector_db.account (user_name, password,acc_type,emp_no) VALUES (user_name, password, 'OFFICER',@EMP_NO);
COMMIT;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_name` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `acc_type` enum('DRIVER','OFFICER','ADMIN','') NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `emp_no` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_name`, `password`, `acc_type`, `status`, `emp_no`) VALUES
('driverProc1', 'hellopass', 'DRIVER', 0, 11),
('driverProc2', 'hellopass', 'DRIVER', 0, 15),
('driverProc3', 'hellopass', 'DRIVER', 0, 16),
('hello 6', 'hellopass6', 'OFFICER', 0, 8),
('helloProc1', 'hellopass', 'OFFICER', 0, 9),
('helloProc2', 'hellopass', 'OFFICER', 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `collection_log`
--

CREATE TABLE `collection_log` (
  `cl_id` int(11) NOT NULL,
  `supplier_id` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `weight` double(6,3) NOT NULL,
  `no_of_bags` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `visit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `collection_point`
--

CREATE TABLE `collection_point` (
  `cp_id` int(10) NOT NULL,
  `cp_name` varchar(20) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `latitude` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(5) NOT NULL,
  `license_no` varchar(25) NOT NULL,
  `vehicle_no` varchar(9) NOT NULL,
  `phone_no` int(10) NOT NULL,
  `emp_no` int(5) NOT NULL,
  `path_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `license_no`, `vehicle_no`, `phone_no`, `emp_no`, `path_id`) VALUES
(3, '43543e', 'r535', 54352, 16, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_no` int(5) NOT NULL,
  `nic_no` varchar(12) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `email` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_no`, `nic_no`, `emp_name`, `email`) VALUES
(1, '34545dgfdgd', 'hello name 1', NULL),
(2, '3455fddgdg', 'hello name 2', NULL),
(4, '3455fd345fdg', 'hello name 3', NULL),
(6, 'puyyyuty6765', 'hello name 4', NULL),
(7, 'yoyoyoyo', 'hello name 5', NULL),
(8, 'oooooooooo', 'hello name 6', NULL),
(9, 'sdfasfaf', 'hello name proc 1', NULL),
(10, '6656ashgyf', 'hello name proc 2', NULL),
(11, '234324', 'driver name proc 1', NULL),
(13, '23432443', 'driver name proc 1', NULL),
(15, '2343421', 'driver name proc 2', NULL),
(16, '541213123', 'driver name proc 3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `path`
--

CREATE TABLE `path` (
  `path_id` int(11) NOT NULL,
  `path_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` varchar(10) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_address` varchar(50) NOT NULL,
  `supplier_phone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `visit_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `cre_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL,
  `driver_id` int(5) NOT NULL,
  `cp_id` int(11) NOT NULL,
  `supplier_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD UNIQUE KEY `user_name_unique` (`user_name`),
  ADD KEY `emp_no_fk` (`emp_no`);

--
-- Indexes for table `collection_log`
--
ALTER TABLE `collection_log`
  ADD PRIMARY KEY (`cl_id`),
  ADD KEY `cl_supplier_id_fk` (`supplier_id`),
  ADD KEY `cl_visit_id_fk` (`visit_id`);

--
-- Indexes for table `collection_point`
--
ALTER TABLE `collection_point`
  ADD PRIMARY KEY (`cp_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `driver_emp_no_fk` (`emp_no`),
  ADD KEY `driver_path_id_fk` (`path_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_no`),
  ADD UNIQUE KEY `nic_no_unique` (`nic_no`);

--
-- Indexes for table `path`
--
ALTER TABLE `path`
  ADD PRIMARY KEY (`path_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `visit_driver_id_fk` (`driver_id`),
  ADD KEY `visit_cp_id_fk` (`cp_id`),
  ADD KEY `visit_supplier_id_fk` (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collection_log`
--
ALTER TABLE `collection_log`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `collection_point`
--
ALTER TABLE `collection_point`
  MODIFY `cp_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `path`
--
ALTER TABLE `path`
  MODIFY `path_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `emp_no_fk` FOREIGN KEY (`emp_no`) REFERENCES `employee` (`emp_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `collection_log`
--
ALTER TABLE `collection_log`
  ADD CONSTRAINT `cl_supplier_id_fk` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cl_visit_id_fk` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`visit_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_emp_no_fk` FOREIGN KEY (`emp_no`) REFERENCES `employee` (`emp_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `driver_path_id_fk` FOREIGN KEY (`path_id`) REFERENCES `path` (`path_id`) ON UPDATE CASCADE;

--
-- Constraints for table `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_cp_id_fk` FOREIGN KEY (`cp_id`) REFERENCES `collection_point` (`cp_id`),
  ADD CONSTRAINT `visit_driver_id_fk` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `visit_supplier_id_fk` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
