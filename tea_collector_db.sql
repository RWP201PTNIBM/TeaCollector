-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2020 at 04:03 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `dashboard_weekly_summary` ()  NO SQL
BEGIN  
   SELECT * FROM tea_collector_db.visit
    WHERE date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND date <= CURDATE();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Driver_Login` (IN `username` VARCHAR(15), IN `pass` VARCHAR(100))  NO SQL
BEGIN 
SELECT t.* FROM tea_collector_db.driver t WHERE t.password = SHA2(pass, 256) AND t.username = username;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Officer_Login` (IN `email` VARCHAR(256), IN `pass` VARCHAR(256))  NO SQL
BEGIN 
SELECT name FROM tea_collector_db.officer t WHERE t.password = SHA2(pass, 256) AND t.email = email AND t.status= 1;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `hash_string` (`value` VARCHAR(100)) RETURNS VARCHAR(256) CHARSET utf8mb4 NO SQL
BEGIN
	DECLARE str VARCHAR(256) DEFAULT '';
	
    SELECT SHA2(value, 256) into str FROM dual;
    
    RETURN str;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `LW_TeabagsCollected` () RETURNS INT(11) NO SQL
BEGIN
	DECLARE num INT DEFAULT 0;
    
    SELECT SUM(cl.no_of_bags) INTO num
    FROM tea_collector_db.collection_log cl 
    WHERE cl.date >= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 7 DAY) 
    AND cl.date <= CURRENT_TIMESTAMP();
    
    RETURN num;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `LW_TeaWeightCollected` () RETURNS DOUBLE(6,3) NO SQL
BEGIN
	DECLARE num double(6,3) DEFAULT 0;
    
    SELECT SUM(cl.weight) INTO num
    FROM tea_collector_db.collection_log cl 
    WHERE cl.date >= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 7 DAY) 
    AND cl.date <= CURRENT_TIMESTAMP();
    
    RETURN num;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `LW_VisitsCompleted` () RETURNS INT(11) NO SQL
BEGIN
	DECLARE num INT DEFAULT 0;
    
    SELECT COUNT(v.visit_id) into num 
            FROM tea_collector_db.visit v
            WHERE v.cre_timestamp >= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 7 DAY) 
            AND v.cre_timestamp <= CURRENT_TIMESTAMP()
            AND v.status = 1;
    
    RETURN num;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `LW_VisitsRegistered` () RETURNS INT(11) NO SQL
BEGIN
	DECLARE num INT DEFAULT 0;
    
    SELECT COUNT(v.visit_id) into num 
            FROM tea_collector_db.visit v
            WHERE v.cre_timestamp >= DATE_SUB(CURRENT_TIMESTAMP(), INTERVAL 7 DAY) 
            AND v.cre_timestamp <= CURRENT_TIMESTAMP();
    
    RETURN num;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Total_Drivers` () RETURNS INT(10) UNSIGNED ZEROFILL NO SQL
BEGIN
	DECLARE drivers INT DEFAULT 0;
    
    SELECT count(d.driver_id) INTO drivers FROM 			tea_collector_db.driver d;
    
    RETURN drivers;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Total_Suppliers` () RETURNS INT(10) UNSIGNED ZEROFILL NO SQL
BEGIN
	DECLARE suppliers INT DEFAULT 0;
    
    SELECT count(s.supplier_id) INTO suppliers FROM 			tea_collector_db.supplier s;
    
    RETURN suppliers;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `collection_log`
--

CREATE TABLE `collection_log` (
  `cl_id` int(11) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `weight` double(6,3) NOT NULL,
  `no_of_bags` int(2) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `visit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collection_log`
--

INSERT INTO `collection_log` (`cl_id`, `supplier_id`, `date`, `weight`, `no_of_bags`, `status`, `visit_id`) VALUES
(51, 2, '2020-08-30 07:16:46', 40.000, 2, 0, 74),
(52, 2, '2020-09-02 12:16:11', 20.000, 1, 0, 80),
(53, 5, '2020-09-02 12:16:21', 40.000, 2, 0, 82);

-- --------------------------------------------------------

--
-- Table structure for table `collection_point`
--

CREATE TABLE `collection_point` (
  `cp_id` int(10) NOT NULL,
  `cp_name` varchar(20) NOT NULL,
  `longitude` varchar(30) NOT NULL,
  `latitude` varchar(30) NOT NULL,
  `path_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collection_point`
--

INSERT INTO `collection_point` (`cp_id`, `cp_name`, `longitude`, `latitude`, `path_id`) VALUES
(60, 'ddddddddddddd', '80.70550479883435', '7.293853266062736', 6),
(61, 'CP1', '80.63958683008435', '7.104198109180657', 5),
(62, 'CP2', '80.93621768945935', '7.158704793199057', 5),
(63, 'CP3', '80.56268253320935', '6.984260721930658', 5),
(64, 'CP4', '80.91424503320935', '6.999527133149911', 5);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(256) NOT NULL,
  `license_no` varchar(25) NOT NULL,
  `vehicle_no` varchar(9) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `path_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `name`, `nic`, `username`, `password`, `license_no`, `vehicle_no`, `phone`, `path_id`) VALUES
(3, 'Sachin', '123456789v', 'Sachin', 'sachin123', '123456', '123456', '1234567890', 5),
(4, 'Wasantha Kumara', '12345678v', 'sachin2', 'sachin123', '123457', '123457', '1234567891', 6),
(7, 'Jambu', '123456781v', 'sachin5', 'helooo', '123456789', '123456748', '5264654878', 6);

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

CREATE TABLE `officer` (
  `officer_id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(70) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `acc_type` enum('ADMIN','OFFICER') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`officer_id`, `name`, `username`, `password`, `email`, `status`, `acc_type`) VALUES
(5, 'sachin', 'sachin', '857c43043be3dad3225f51e5f2ae0d99e8e663569c13e36f18c1b0898592e06d', 'sachinlagamuwa@gmail.com', 1, 'OFFICER');

--
-- Triggers `officer`
--
DELIMITER $$
CREATE TRIGGER `OfficerIns` BEFORE INSERT ON `officer` FOR EACH ROW SET NEW.password = SHA2(NEW.password, 256)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `OfficerUpd` BEFORE UPDATE ON `officer` FOR EACH ROW SET NEW.password = SHA2(NEW.password, 256)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `path`
--

CREATE TABLE `path` (
  `path_id` int(11) NOT NULL,
  `path_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `path`
--

INSERT INTO `path` (`path_id`, `path_name`) VALUES
(5, 'P1'),
(6, 'P2'),
(9, 'P3'),
(10, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(10) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_address` varchar(50) NOT NULL,
  `supplier_phone` varchar(12) NOT NULL,
  `cp_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_phone`, `cp_id`) VALUES
(2, 'Saman Kumara', 'No.72, Sapugoda Road, Akuressa', '1234567890', 61),
(3, 'M.M.Maheshi', 'No.12, Kiyanduwa Aranya Rd, Akuressa', '1234567895', 60),
(4, 'G.Dikmadugoda', 'No.32, Galaboda Hena Rd, Akuressa', '1234567892', 62),
(5, 'W.Munaweera', 'No.20, Wilehena Rd, Akuressa.', '1234567893', 62);

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
  `supplier_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`visit_id`, `date`, `cre_timestamp`, `status`, `driver_id`, `cp_id`, `supplier_id`) VALUES
(74, '2020-08-25', '2020-08-25 07:16:18', 1, 3, 61, 2),
(75, '2020-08-30', '2020-08-30 07:17:48', 0, 3, 62, 4),
(76, '2020-08-30', '2020-08-30 07:17:55', 0, 3, 62, 5),
(77, '2020-08-31', '2020-08-31 06:03:36', 1, 3, 61, 2),
(78, '2020-08-31', '2020-08-31 06:03:37', 0, 3, 62, 4),
(79, '2020-08-31', '2020-08-31 06:03:37', 0, 3, 62, 5),
(80, '2020-09-02', '2020-09-02 12:15:59', 1, 3, 61, 2),
(81, '2020-09-02', '2020-09-02 12:15:59', 0, 3, 62, 4),
(82, '2020-09-02', '2020-09-02 12:16:00', 1, 3, 62, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collection_log`
--
ALTER TABLE `collection_log`
  ADD PRIMARY KEY (`cl_id`),
  ADD UNIQUE KEY `supplier_id` (`supplier_id`,`date`),
  ADD KEY `cl_supplier_id_fk` (`supplier_id`),
  ADD KEY `cl_visit_id_fk` (`visit_id`);

--
-- Indexes for table `collection_point`
--
ALTER TABLE `collection_point`
  ADD PRIMARY KEY (`cp_id`),
  ADD UNIQUE KEY `cp_name` (`cp_name`),
  ADD KEY `cp_path_id_fk` (`path_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD UNIQUE KEY `driver_name_unique` (`nic`),
  ADD UNIQUE KEY `driver_uname_unique` (`username`),
  ADD UNIQUE KEY `driver_phone_unique` (`phone`);

--
-- Indexes for table `officer`
--
ALTER TABLE `officer`
  ADD PRIMARY KEY (`officer_id`),
  ADD UNIQUE KEY `officer_uname_unique` (`username`),
  ADD UNIQUE KEY `officer_email_unique` (`email`);

--
-- Indexes for table `path`
--
ALTER TABLE `path`
  ADD PRIMARY KEY (`path_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `supplier_cp_id_fk` (`cp_id`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`visit_id`),
  ADD UNIQUE KEY `date` (`date`,`supplier_id`),
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
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `collection_point`
--
ALTER TABLE `collection_point`
  MODIFY `cp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `officer`
--
ALTER TABLE `officer`
  MODIFY `officer_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `path`
--
ALTER TABLE `path`
  MODIFY `path_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collection_log`
--
ALTER TABLE `collection_log`
  ADD CONSTRAINT `cl_supplier_id_fk` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `cl_visit_id_fk` FOREIGN KEY (`visit_id`) REFERENCES `visit` (`visit_id`);

--
-- Constraints for table `collection_point`
--
ALTER TABLE `collection_point`
  ADD CONSTRAINT `cp_path_id_fk` FOREIGN KEY (`path_id`) REFERENCES `path` (`path_id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_cp_id_fk` FOREIGN KEY (`cp_id`) REFERENCES `collection_point` (`cp_id`);

--
-- Constraints for table `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_cp_id_fk` FOREIGN KEY (`cp_id`) REFERENCES `collection_point` (`cp_id`),
  ADD CONSTRAINT `visit_driver_id_fk` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`),
  ADD CONSTRAINT `visit_supplier_id_fk` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
