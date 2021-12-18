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
-- Table structure for table `project_bids_evaluation`
--

CREATE TABLE `project_bids_evaluation` (
  `id` bigint(20) NOT NULL,
  `project_id` int(20) NOT NULL,
  `contractor_id` int(20) NOT NULL,
  `technical_score` decimal(16,2) NOT NULL,
  `financial_score` decimal(16,2) NOT NULL,
  `total_score` decimal(16,2) NOT NULL,
  `bid_amount` decimal(16,2) DEFAULT NULL,
  `recommendations` varchar(500) DEFAULT NULL,
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
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_data` timestamp NOT NULL DEFAULT current_timestamp(),
  `acct_type` enum('PO','SO_STORE','SO_CW','SO_RECORD','admin_north','admin_super','admin_south') NOT NULL,
  `status` enum('offline','online') NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `region` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `security_info`
--

INSERT INTO `security_info` (`id`, `username`, `password`, `reg_data`, `acct_type`, `status`, `email`, `phone`, `address`, `full_name`, `region`) VALUES
(1, 'dir_nhs', '$2y$10$/6ZG1xPTs92CYRNV3CjjnuG8MWZ1NwfWzrzK8GCC14BETqHCpWsGi', '2021-07-13 15:14:39', 'admin_super', 'offline', '', '', '', '', 'both'),
(2, 'dg_nhs', '$2y$10$GGo4NoQkJII3gtJI8vtAquU2yYv5ZeOX7CcaQ9ez2EMVr728d5JO6', '2021-07-13 15:14:54', 'admin_super', 'offline', '', '', '', '', 'both'),
(3, 'pd_north', '$2y$10$gAMATOqA7y0hGCQQXgKTbe2mbenqmWBIasm5XPjMC72X/vNPslaqu', '2021-07-13 15:20:49', 'admin_north', 'offline', '', '', '', '', 'north'),
(4, 'pd_south', '$2y$10$7xDnYMGmfd5Fn4Lz.YDy5udEPJaMunxA0A1jrQOBmuVOqnC9oxgvO', '2021-07-13 15:21:01', 'admin_south', 'offline', '', '', '', '', 'south'),
(5, 'po', '$2y$10$8XgyqXPz2fE5n2NwGsx6ZuB22QMZpd77S6vz76.I6Ws4CAID08zu.', '2021-06-17 10:41:33', 'PO','offline', '', '', '', '', 'north'),
(6, 'socw', '$2y$10$9g4nuznoQ8ChNs8VAbaeBeRx3QXTK.6Z5vi5.ErutktI2/5l2O1D6', '2021-06-17 10:41:46', 'SO_CW','offline', '', '', '', '', 'north'),
(7, 'sostore', '$2y$10$uddQ5MWvlAwLFe9xMmWMae6gjJdiVCkt2B.kN6oGJU7EUoQzsECXy', '2021-06-17 10:42:04', 'SO_STORE','offline', '', '', '', '', 'north'),
(8, 'sorecord', '$2y$10$uddQ5MWvlAwLFe9xMmWMae6gjJdiVCkt2B.kN6oGJU7EUoQzsECXy', '2021-06-17 10:42:04', 'SO_RECORD','offline', '', '', '', '', 'north'),
(9, 'po_s', '$2y$10$8XgyqXPz2fE5n2NwGsx6ZuB22QMZpd77S6vz76.I6Ws4CAID08zu.', '2021-06-17 10:41:33', 'PO','offline', '', '', '', '', 'south'),
(10, 'socw_s', '$2y$10$9g4nuznoQ8ChNs8VAbaeBeRx3QXTK.6Z5vi5.ErutktI2/5l2O1D6', '2021-06-17 10:41:46', 'SO_CW','offline', '', '', '', '', 'south'),
(11, 'sostore_s', '$2y$10$uddQ5MWvlAwLFe9xMmWMae6gjJdiVCkt2B.kN6oGJU7EUoQzsECXy', '2021-06-17 10:42:04', 'SO_STORE','offline', '', '', '', '', 'south'),
(12, 'sorecord_s', '$2y$10$uddQ5MWvlAwLFe9xMmWMae6gjJdiVCkt2B.kN6oGJU7EUoQzsECXy', '2021-06-17 10:42:04', 'SO_RECORD','offline', '', '', '', '', 'south');

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
  `bill_description` varchar(500) DEFAULT NULL,
  `date_added` DATE DEFAULT NULL,
  `gross_work_done` decimal(16,2) NULL,
  `wd_in_bill` decimal(16,2) NULL,
  `rm_deducted` decimal(16,2) NULL,
  `payment_made` decimal(16,2) NULL,
  `cheque_no` int(20) NULL,
  `it_deducted` decimal(16,2) NULL,
  `contract_amount` decimal(16,2) NULL,
  `paid_till_last_bill` decimal(16,2) NULL,
  `claim_amount` decimal(16,2) NULL,
  `verified_amount` decimal(16,2) NULL,
  `bill_file_attach_1` varchar(500) NULL,
  `total_cost_material_used` decimal(16,2) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `officer_record`
--
CREATE TABLE `officer_record` (
 `officer_id` int(11) NOT NULL,
 `officer_name` varchar(250) NULL,
 `officer_cnic` varchar(250) NULL,
 `officer_rank` varchar(250) NULL,
 `payment_last_month` decimal(16,2) NULL,
 `total_payment` decimal(16,2) NULL,
 `file_attach` varchar(500) NULL
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
  `ip_address` text NOT NULL,
  `seen` enum('yes','no') NOT NULL
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
-- Table structure for table `project_performance_security_letter`
--

CREATE TABLE `project_performance_security_letter` (
  `id` bigint(20) NOT NULL,
  `project_id` int(20) NOT NULL,
  `file_name` varchar(500) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `issued_by` varchar(200) DEFAULT NULL,
  `validity_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log_seen` (
 `activity_id` int(11) NOT NULL,
 `user_id` int(11) NOT NULL,
 `seen` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


alter table project_drawing
add column description varchar(500);

alter table inventory_detail
add column cost_per_unit decimal(16,2);

alter table project_allotment_letter
add COLUMN received_date date;

alter table project_allotment_letter
add COLUMN dispatch_date date;

alter table project_allotment_letter
add COLUMN officer_name varchar(100);

ALTER TABLE activity_log ADD COLUMN region varchar(15);
ALTER TABLE activity_log_seen ADD COLUMN region varchar(15);
ALTER TABLE chat ADD COLUMN region varchar(15);
ALTER TABLE contractors ADD COLUMN region varchar(15);
ALTER TABLE inventory ADD COLUMN region varchar(15);
ALTER TABLE inventory_detail ADD COLUMN region varchar(15);
ALTER TABLE inventory_used ADD COLUMN region varchar(15);
ALTER TABLE projects ADD COLUMN region varchar(15);
ALTER TABLE project_allotment_letter ADD COLUMN region varchar(15);
ALTER TABLE project_bids ADD COLUMN region varchar(15);
ALTER TABLE project_bids_evaluation ADD COLUMN region varchar(15);
ALTER TABLE project_bills ADD COLUMN region varchar(15);
ALTER TABLE project_drawing ADD COLUMN region varchar(15);
ALTER TABLE project_progress ADD COLUMN region varchar(15);
ALTER TABLE project_schedule ADD COLUMN region varchar(15);
ALTER TABLE project_performance_security_letter ADD COLUMN region varchar(15);

update activity_log set region = 'north';
update activity_log_seen set region = 'north';
Update chat set region = 'north';
Update contractors set region = 'north';
Update inventory set region = 'north';
Update inventory_detail set region = 'north';
Update inventory_used set region = 'north';
Update projects set region = 'north';
Update project_allotment_letter set region = 'north';
Update project_bids set region = 'north';
Update project_bills set region = 'north';
Update project_drawing set region = 'north';
Update project_progress set region = 'north';
Update project_schedule set region = 'north';

update inventory_detail
set cost_per_unit = Price / Quantity;

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
-- Indexes for table `project_bids_evaluation`
--
ALTER TABLE `project_bids_evaluation`
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
-- Indexes for table `project_performance_security_letter`
--
ALTER TABLE `project_performance_security_letter`
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
-- AUTO_INCREMENT for table `project_bids_evaluation`
--
ALTER TABLE `project_bids_evaluation`
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
-- AUTO_INCREMENT for table `project_performance_security_letter`
--
ALTER TABLE `project_performance_security_letter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

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


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
