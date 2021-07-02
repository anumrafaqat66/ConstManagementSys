-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 03:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `management_system`
--
CREATE DATABASE IF NOT EXISTS `management_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `management_system`;

-- --------------------------------------------------------

--
-- Table structure for table `project_bids`
--

CREATE TABLE `project_bids` (
  `id` bigint(20) NOT NULL,
  `project_id` int(20) NOT NULL,
  `contractor_id` int(20) NOT NULL,
  `bid_amount` decimal(16,2) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_bids`
--

INSERT INTO `project_bids` ( `id`, `project_id`, `contractor_id`, `bid_amount`, `Status`) VALUES
(1, 1, 1, 100000, 'Verified'),
(2, 2, 2, 2500000, 'Verified'),
(3, 3, 3, 5000000, 'Verified');

--
-- Table structure for table `contractors`
--


CREATE TABLE IF NOT EXISTS `contractors` (
  `ID` bigint(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Contact_no` varchar(100) DEFAULT NULL,
  `Email_id` varchar(100) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `Start_date` date DEFAULT NULL,
  `Assigned_Projects` int(20) DEFAULT 0,
  `Completed_Projects` int(20) DEFAULT 0,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contractors`
--

INSERT INTO `contractors` ( `ID`, `Name`, `Contact_no`, `Email_id`, `Description`, `Start_date`,`Status`) VALUES
(1, 'Contractor-1', '03312344532', 'contractor_one@gmail.com', 'Verified contractor by department', '2021-06-13', 'Verified'),
(2, 'Contractor-2', '03312344532', 'contractor_two@gmail.com', 'Verified contractor by department', '2021-07-13', 'Verified'),
(3, 'Contractor-3', '03312344532', 'contractor_three@gmail.com', 'Verified contractor by department', '2021-08-13', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `ID` bigint(20) NOT NULL,
  `Material_Name` varchar(50) NOT NULL,
  `Material_Total_Quantity` int(20) DEFAULT NULL,
  `Material_Total_Price` decimal(16,2) DEFAULT NULL,
  `Unit` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`ID`, `Material_Name`, `Material_Total_Quantity`, `Material_Total_Price`, `Unit`) VALUES
(1, 'Steel', 100, '23000.00', 'meter'),
(2, 'Iron', 200, '33000.00', 'square foot'),
(3, 'Wood', 300, '43000.00', 'square foot'),
(4, 'Bricks', 1500, '13000.00', 'kilogram'),
(5, 'Cement', 2500, '53000.00', 'Kilogram');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_detail`
--

CREATE TABLE `inventory_detail` (
  `ID` bigint(20) NOT NULL,
  `Material_ID` bigint(20) NOT NULL,
  `Quantity` int(20) DEFAULT NULL,
  `Price` decimal(16,2) DEFAULT NULL,
  `stock_date` date DEFAULT current_timestamp(),
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory_detail`
--

INSERT INTO `inventory_detail` (`ID`, `Material_ID`, `Quantity`, `Price`, `stock_date`, `Status`) VALUES
(1, 1, 100, '23000.00', '2021-06-08', 'Delivered'),
(2, 2, 200, '33000.00', '2021-06-08', 'Delivered'),
(3, 3, 300, '43000.00', '2021-06-08', 'Delivered'),
(4, 4, 1500, '13000.00','2021-06-08', 'Delivered'),
(5, 5, 2500, '53000.00','2021-06-08', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_used`
--

CREATE TABLE `inventory_used` (
  `Material_id` bigint(20) NOT NULL,
  `Material_used_by_Project` bigint(20) NOT NULL,
  `Quantity_used` int(20) DEFAULT NULL,
  `Price` decimal(16,2) DEFAULT NULL,
  `delivery_date` date DEFAULT current_timestamp(),  
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ID` bigint(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Code` varchar(250) DEFAULT NULL,
  `Start_date` date DEFAULT NULL,
  `End_date` date DEFAULT NULL,
  `Total_Cost` decimal(16,2) DEFAULT NULL,
  `Created_by` varchar(100) DEFAULT NULL,
  `contractor_id` bigint(20) DEFAULT NULL,
  `bid_id` int(20) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ID`, `Name`, `Code`, `Start_date`, `End_date`, `Total_Cost`, `Status`, `contractor_id`,`bid_id`, `Created_by`) VALUES
(1, 'Project-32C', '32C', '2021-06-08', '2021-06-08', 2300.00, 'On-going', 1, 1, 'po'),
(2, 'Project-42C', '42C', '2021-06-08', '2021-06-08', 5400.00, 'On-going', 2, 2, 'po'),
(3, 'Project-42B', '42B', '2021-06-08', '2021-06-08', 56400.00, 'Initiated', 3, 3, 'po');

-- --------------------------------------------------------

--
-- Table structure for table `security_info`
--

CREATE TABLE `security_info` (
  `id` bigint(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_data` timestamp NOT NULL DEFAULT current_timestamp(),
  `acct_type` enum('PO','SO_STORE','SO_CW','SO_RECORD','admin') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `security_info`
--

INSERT INTO `security_info` (`id`, `username`, `password`, `reg_data`, `acct_type`) VALUES
(1, 'admin', '$2y$10$uVajLuVrXeV2S4TWWuH4a.CLTS4LW92nmGiitB94akkA6pAWMJyI2', '2021-05-21 19:00:00', 'admin'),
(2, 'po', '$2y$10$8XgyqXPz2fE5n2NwGsx6ZuB22QMZpd77S6vz76.I6Ws4CAID08zu.', '2021-06-17 10:41:33', 'PO'),
(3, 'socw', '$2y$10$9g4nuznoQ8ChNs8VAbaeBeRx3QXTK.6Z5vi5.ErutktI2/5l2O1D6', '2021-06-17 10:41:46', 'SO_CW'),
(4, 'sostore', '$2y$10$uddQ5MWvlAwLFe9xMmWMae6gjJdiVCkt2B.kN6oGJU7EUoQzsECXy', '2021-06-17 10:42:04', 'SO_STORE');

--
-- Table structure for table `project_progress`
--

CREATE TABLE `project_progress` (
  `id` bigint(20) NOT NULL,
  `project_id` int(20) NOT NULL,
  `task_id` int(20) NOT NULL,
  `progress_date` date DEFAULT NULL,
  `progress_percentage` decimal(5,2) DEFAULT NULL,
  `progress_description` varchar(500) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_schedule`
--

CREATE TABLE `project_schedule` (
  `id` bigint(20) NOT NULL,
  `project_id` int(20) NOT NULL,
  `schedule_date` date DEFAULT NULL,
  `schedule_name` varchar(100) DEFAULT NULL,
  `schedule_description` varchar(500) DEFAULT NULL,
  `schedule_start_date` date DEFAULT NULL,
  `schedule_end_date` date DEFAULT NULL,
  `schedule_cost` decimal(16,2) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Table structure for table "project drawing"
CREATE TABLE `project_drawing` (
  `id` bigint(20) NOT NULL ,
  `project_id` int(20) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `date_added` DATE DEFAULT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table "project allotment letter"
CREATE TABLE `project_allotment_letter` (
  `id` bigint(20) NOT NULL ,
  `project_id` int(20) NOT NULL,
  `file_name` varchar(500) DEFAULT NULL,
  `date_added` DATE DEFAULT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table "project bills"
CREATE TABLE `project_bills` (
  `id` bigint(20) NOT NULL ,
  `project_id` int(20) NOT NULL,
  `bill_name` varchar(500) DEFAULT NULL,
  `date_added` DATE DEFAULT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `attachment_name` text NOT NULL,
  `file_ext` text NOT NULL,
  `mime_type` text NOT NULL,
  `message_date_time` text NOT NULL,
  `ip_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
 `id` int(11) NOT NULL,
 `activity_module` enum('Admin','SO_Store','PO','SO_CW','SO_Record'),
 `activity_action` enum('add','update','delete') ,
 `activity_detail` text NULL,
 `activity_by` varchar(250) NULL,
 `activity_date` datetime
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log_seen` (
 `activity_id` int(11) NOT NULL,
 `user_id` int(11) NOT NULL,
 `seen` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contractors`
--
ALTER TABLE `contractors`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `inventory_detail`
--
ALTER TABLE `inventory_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Material_ID` (`Material_ID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `security_info`
--
ALTER TABLE `security_info`
  ADD PRIMARY KEY (`id`);
  
--
-- Indexes for table `project_bids`
--
ALTER TABLE `project_bids`
  ADD PRIMARY KEY (`id`);
  

--
-- Indexes for table `project_progress`
--
ALTER TABLE `project_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_schedule`
--
ALTER TABLE `project_schedule`
  ADD PRIMARY KEY (`id`);
  
--
-- Indexes for table `project_drawing`
--
ALTER TABLE `project_drawing`
  ADD PRIMARY KEY (`id`); 

--
-- Indexes for table `project_allotment_letter`
--
ALTER TABLE `project_allotment_letter`
  ADD PRIMARY KEY (`id`);  

--
-- Indexes for table `project_bills`
--
ALTER TABLE `project_bills`
  ADD PRIMARY KEY (`id`);  
  
  
--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);
  
  
--
-- Indexes for table `activity_log`
--  
ALTER TABLE `activity_log`
 ADD PRIMARY KEY (`id`);
    
  
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contractors`
--
ALTER TABLE `contractors`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory_detail`
--
ALTER TABLE `inventory_detail`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `security_info`
--
ALTER TABLE `security_info`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
  
--
-- AUTO_INCREMENT for table `project_bids`
--
ALTER TABLE `project_bids`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
  

--
-- AUTO_INCREMENT for table `project_progress`
--
ALTER TABLE `project_progress`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_schedule`
--
ALTER TABLE `project_schedule`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_drawing`
--
ALTER TABLE `project_drawing`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_allotment_letter`
--
ALTER TABLE `project_allotment_letter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_bills`
--
ALTER TABLE `project_bills`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
  
  
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
 MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_detail`
--
ALTER TABLE `inventory_detail`
  ADD CONSTRAINT `inventory_detail_ibfk_1` FOREIGN KEY (`Material_ID`) REFERENCES `inventory` (`ID`);

--
-- Constraints for table `inventory_used`
--
ALTER TABLE `inventory_used`
  ADD CONSTRAINT `inventory_used_ibfk_1` FOREIGN KEY (`Material_id`) REFERENCES `inventory` (`ID`),
  ADD CONSTRAINT `inventory_used_ibfk_2` FOREIGN KEY (`Material_used_by_Project`) REFERENCES `projects` (`ID`);
COMMIT;

ALTER TABLE `security_info`
  ADD `status` enum('offline','online') NOT NULL;

ALTER TABLE `chat`
  ADD `seen` enum('no','yes') NOT NULL;

ALTER TABLE `security_info`
  ADD `email` varchar(200) NOT NULL;

ALTER TABLE `security_info`
  ADD `phone` varchar(200) NOT NULL;

ALTER TABLE `security_info`
  ADD `address` varchar(500) NOT NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
