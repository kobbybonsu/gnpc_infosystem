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
-- Database: `gnpc_employees`
--

-- --------------------------------------------------------

--
-- Table structure for table `ge_departments`
--

CREATE TABLE IF NOT EXISTS `ge_departments` (
`d_id` int(11) NOT NULL,
  `d_name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ge_departments`
--

INSERT INTO `ge_departments` (`d_id`, `d_name`) VALUES
(1, 'Human Resource'),
(2, 'Finance'),
(3, 'Information Technology'),
(4, 'Geology'),
(5, 'Geophysics'),
(6, 'Engineering'),
(7, 'Marketing'),
(8, 'Corporate Strategy and New Business'),
(9, 'CE''s Secretariat'),
(10, 'Corporate Affairs'),
(11, 'Internal Audit'),
(12, 'Supply Chain and Procurement'),
(13, 'Research and Data Management'),
(14, 'Facilities'),
(15, 'Legal'),
(16, 'Operations');

-- --------------------------------------------------------

--
-- Table structure for table `ge_groups`
--

CREATE TABLE IF NOT EXISTS `ge_groups` (
`g_id` int(11) NOT NULL,
  `g_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ge_groups`
--

INSERT INTO `ge_groups` (`g_id`, `g_name`) VALUES
(1, 'Chief Executive'),
(2, 'Director'),
(3, 'Manager'),
(4, 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `ge_users`
--

CREATE TABLE IF NOT EXISTS `ge_users` (
`u_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `u_group` int(11) NOT NULL,
  `u_department` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ge_users`
--

INSERT INTO `ge_users` (`u_id`, `firstname`, `lastname`, `username`, `password`, `u_group`, `u_department`) VALUES
(1, 'Kwabena', 'Ohene-Bonsu', 'kgohenebonsu', 'e10adc3949ba59abbe56e057f20f883e', 4, 3),
(2, 'Godfred', 'Ofori-Som', 'goforisom', 'e10adc3949ba59abbe56e057f20f883e', 3, 3),
(3, 'HR', 'Person', 'hrperson', 'e10adc3949ba59abbe56e057f20f883e', 4, 1),
(4, 'HR', 'Director', 'hrdirector', 'e10adc3949ba59abbe56e057f20f883e', 2, 1),
(5, 'Facilities', 'Person', 'facperson', 'e10adc3949ba59abbe56e057f20f883e', 4, 14),
(6, 'Facilities', 'Manager', 'facmanager', 'e10adc3949ba59abbe56e057f20f883e', 3, 14),
(7, 'Internal Audit', 'Person', 'iaperson', 'e10adc3949ba59abbe56e057f20f883e', 4, 11),
(8, 'Internal Audit', 'Manager', 'iamanager', 'e10adc3949ba59abbe56e057f20f883e', 3, 11),
(9, 'Finance', 'Person', 'finperson', 'e10adc3949ba59abbe56e057f20f883e', 4, 2),
(10, 'Finance', 'Director', 'findirector', 'e10adc3949ba59abbe56e057f20f883e', 2, 2),
(11, 'Marketing', 'Person', 'markperson', 'e10adc3949ba59abbe56e057f20f883e', 4, 7),
(12, 'Marketing', 'Manager', 'markmanager', 'e10adc3949ba59abbe56e057f20f883e', 3, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ge_departments`
--
ALTER TABLE `ge_departments`
 ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `ge_groups`
--
ALTER TABLE `ge_groups`
 ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `ge_users`
--
ALTER TABLE `ge_users`
 ADD PRIMARY KEY (`u_id`), ADD KEY `u_group` (`u_group`), ADD KEY `u_department` (`u_department`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ge_departments`
--
ALTER TABLE `ge_departments`
MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ge_groups`
--
ALTER TABLE `ge_groups`
MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ge_users`
--
ALTER TABLE `ge_users`
MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ge_users`
--
ALTER TABLE `ge_users`
ADD CONSTRAINT `ge_users_ibfk_1` FOREIGN KEY (`u_group`) REFERENCES `ge_groups` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ge_users_ibfk_2` FOREIGN KEY (`u_department`) REFERENCES `ge_departments` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
