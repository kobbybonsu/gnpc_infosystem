-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2015 at 10:08 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gnpc_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `lms_holidays`
--

CREATE TABLE IF NOT EXISTS `lms_holidays` (
`h_id` int(11) NOT NULL,
  `h_name` varchar(100) NOT NULL,
  `h_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_holidays`
--

INSERT INTO `lms_holidays` (`h_id`, `h_name`, `h_date`) VALUES
(1, 'Farmer''s Day', '2015-12-04'),
(2, 'Christmas Day', '2015-12-25'),
(3, 'Boxing (Proclamation) Day', '2015-12-26'),
(4, 'New Year''s Day 2016', '2016-01-01'),
(5, 'Independence Day', '2016-03-06'),
(6, 'Good Friday', '2016-03-25'),
(7, 'Easter Monday', '2016-03-28'),
(8, 'May Day', '2016-05-01'),
(9, 'African Unity Day', '2016-05-25'),
(10, 'Republic Day', '2016-07-01'),
(11, 'Eid Ul-Fitr', '2016-07-07'),
(12, 'Eid Ul-Adha', '2016-09-11'),
(13, 'Founder''s Day', '2016-09-21'),
(14, 'Farmer''s Day', '2016-12-02'),
(15, 'Christmas Day', '2016-12-25'),
(16, 'Boxing (Proclamation) Day', '2016-12-26');

-- --------------------------------------------------------

--
-- Table structure for table `lms_leave_type`
--

CREATE TABLE IF NOT EXISTS `lms_leave_type` (
`t_id` int(11) NOT NULL,
  `t_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_leave_type`
--

INSERT INTO `lms_leave_type` (`t_id`, `t_name`) VALUES
(1, 'Official Leave'),
(3, 'Sick Leave'),
(4, 'Maternity Leave'),
(5, 'Out-Of-Office');

-- --------------------------------------------------------

--
-- Table structure for table `lms_official_leave_days`
--

CREATE TABLE IF NOT EXISTS `lms_official_leave_days` (
`d_id` int(11) NOT NULL,
  `group` varchar(70) NOT NULL,
  `leave_days` int(11) NOT NULL,
  `date_entered` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_official_leave_days`
--

INSERT INTO `lms_official_leave_days` (`d_id`, `group`, `leave_days`, `date_entered`) VALUES
(1, 'CE', 40, '2015-10-27'),
(2, 'Director', 35, '2015-10-27'),
(3, 'Manager', 35, '2015-10-27'),
(4, 'Regular', 23, '2015-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `lms_requests`
--

CREATE TABLE IF NOT EXISTS `lms_requests` (
`r_id` int(11) NOT NULL,
  `employee_ref` int(11) NOT NULL,
  `job_title` varchar(200) NOT NULL,
  `request_date` date NOT NULL,
  `num_days_left` int(11) NOT NULL,
  `num_days_requested` int(11) NOT NULL,
  `leave_type_ref` int(11) NOT NULL,
  `request_status_ref` int(11) NOT NULL,
  `commencement_date` date NOT NULL,
  `end_date` date NOT NULL,
  `resumption_date` date NOT NULL,
  `leave_address` varchar(500) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `officer_taking_over` varchar(100) NOT NULL,
  `hod_endorsement` int(11) NOT NULL,
  `hr_officer` varchar(100) NOT NULL,
  `hr_verification` int(11) NOT NULL,
  `hr_dir_approval` int(11) NOT NULL,
  `approval_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_requests`
--

INSERT INTO `lms_requests` (`r_id`, `employee_ref`, `job_title`, `request_date`, `num_days_left`, `num_days_requested`, `leave_type_ref`, `request_status_ref`, `commencement_date`, `end_date`, `resumption_date`, `leave_address`, `contact`, `email`, `officer_taking_over`, `hod_endorsement`, `hr_officer`, `hr_verification`, `hr_dir_approval`, `approval_date`) VALUES
(1, 1, 'Assistant Support Officer', '2015-11-30', 23, 4, 1, 1, '2015-12-01', '2015-12-05', '2015-12-06', 'dvsad', '0204457587', 'nanette@gmail.com', 'Nanette', 0, '', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `lms_request_status`
--

CREATE TABLE IF NOT EXISTS `lms_request_status` (
`rs_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_request_status`
--

INSERT INTO `lms_request_status` (`rs_id`, `status`) VALUES
(1, 'Pending'),
(2, 'Endorsed by H.O.D'),
(3, 'Verified by H.R'),
(4, 'Approved'),
(5, 'Declined'),
(6, 'Cancelled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lms_holidays`
--
ALTER TABLE `lms_holidays`
 ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `lms_leave_type`
--
ALTER TABLE `lms_leave_type`
 ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `lms_official_leave_days`
--
ALTER TABLE `lms_official_leave_days`
 ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `lms_requests`
--
ALTER TABLE `lms_requests`
 ADD PRIMARY KEY (`r_id`), ADD KEY `employee_ref` (`employee_ref`), ADD KEY `leave_type_ref` (`leave_type_ref`), ADD KEY `request_status_ref` (`request_status_ref`);

--
-- Indexes for table `lms_request_status`
--
ALTER TABLE `lms_request_status`
 ADD PRIMARY KEY (`rs_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lms_holidays`
--
ALTER TABLE `lms_holidays`
MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `lms_leave_type`
--
ALTER TABLE `lms_leave_type`
MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lms_official_leave_days`
--
ALTER TABLE `lms_official_leave_days`
MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lms_requests`
--
ALTER TABLE `lms_requests`
MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lms_request_status`
--
ALTER TABLE `lms_request_status`
MODIFY `rs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `lms_requests`
--
ALTER TABLE `lms_requests`
ADD CONSTRAINT `lms_requests_ibfk_1` FOREIGN KEY (`employee_ref`) REFERENCES `gnpc_employees`.`ge_users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `lms_requests_ibfk_2` FOREIGN KEY (`leave_type_ref`) REFERENCES `lms_leave_type` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `lms_requests_ibfk_3` FOREIGN KEY (`request_status_ref`) REFERENCES `lms_request_status` (`rs_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
