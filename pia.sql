-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2016 at 12:56 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pia`
--

-- --------------------------------------------------------

--
-- Table structure for table `administration`
--

CREATE TABLE `administration` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administration`
--

INSERT INTO `administration` (`admin_id`, `admin_email`, `admin_password`, `admin_position`) VALUES
(1, 'ays@yahoo.com', '900150983cd24fb0d6963f7d28e17f72', 'finance'),
(2, 'abc@gmail.com.pk', '900150983cd24fb0d6963f7d28e17f72', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `Ref_id` varchar(20) NOT NULL,
  `cand_id` int(11) NOT NULL,
  `cand_password` varchar(255) NOT NULL,
  `cand_full_name` varchar(50) NOT NULL,
  `cand_father_name` varchar(20) NOT NULL,
  `cand_nic` char(14) NOT NULL,
  `isapprove` tinyint(1) NOT NULL,
  `cand_dob` date NOT NULL,
  `cand_gender` varchar(20) NOT NULL,
  `cand_contactno` varchar(11) NOT NULL,
  `cand_email` varchar(40) NOT NULL,
  `cand_permenant_address` varchar(200) NOT NULL,
  `cand_current_address` varchar(200) NOT NULL,
  `cand_nic_attachment` longblob NOT NULL,
  `cand_profile_pic` longblob NOT NULL,
  `cand_pob` varchar(20) NOT NULL,
  `cand_organization` varchar(20) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL,
  `disabled_by` varchar(60) NOT NULL,
  `disabled_at` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` datetime NOT NULL,
  `Activation` varchar(50) NOT NULL,
  `active_time` time NOT NULL,
  `isapproveby` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`Ref_id`, `cand_id`, `cand_password`, `cand_full_name`, `cand_father_name`, `cand_nic`, `isapprove`, `cand_dob`, `cand_gender`, `cand_contactno`, `cand_email`, `cand_permenant_address`, `cand_current_address`, `cand_nic_attachment`, `cand_profile_pic`, `cand_pob`, `cand_organization`, `isactive`, `isdeleted`, `disabled_by`, `disabled_at`, `modified_by`, `modified_at`, `Activation`, `active_time`, `isapproveby`) VALUES
('2016PIA0093', 93, '02f87940892a89645473b0b4d11e0b9c', 'Farah Sadiq', 'Sadiq Muhhamad', '42101674381234', 1, '1995-06-15', 'Female', '02134522671', 'farahsadiq357@yahoo.com', 'Malir Halt Baghe rafi karachi', 'Malir Halt Baghe rafi karachi', 0x63312e6a7067, 0x7468756d622d637574652d626f792d77616c6c70617065722d666f722d63656c6c70686f6e652d646f776e6c6f61642d667265652d313139332e6a7067, 'Karachi', 'Pakistan Internation', 1, 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '00:00:00', 'abc@gmail.com.pk'),
('2016PAF0094', 94, '02f87940892a89645473b0b4d11e0b9c', 'Ayesha ruba Hussain', 'Hussain', '42101674367234', 0, '1994-06-14', 'Female', '02132433671', 'ayesha@forin.com', 'B2-block19 National Complex Gulshan e Iqbal Karachi', 'B2-block19 National Complex Gulshan e Iqbal Karachi', 0x63312e6a7067, 0x7468756d622d637574652d626f792d77616c6c70617065722d666f722d63656c6c70686f6e652d646f776e6c6f61642d667265652d313139332e6a7067, 'karachi', 'Pakistan Air Force', 0, 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '00:00:00', ''),
('2016SHA0099', 99, '02f87940892a89645473b0b4d11e0b9c', 'Bisma Ayaz', 'Ayaz Ahmed', '42101373611234', 1, '1996-06-14', 'Female', '03297834567', 'bisma.ayaz@yahoo.com', 'B2-block19 National Complex Gulshan e Iqbal Karachi', 'B2-block19 National Complex Gulshan e Iqbal Karachi', 0x63312e6a7067, 0x7468756d622d637574652d626f792d77616c6c70617065722d666f722d63656c6c70686f6e652d646f776e6c6f61642d667265652d313139332e6a7067, 'Karachi', 'Shaheen Air Internat', 1, 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '11:20:48', 'abc@gmail.com.pk'),
('2016PIA0101', 101, '110a6a26bb90190391c53e9545095d62', 'Muhammad Asif', 'Sadiq Muhhamad', '42501951321753', 1, '1984-02-13', 'Male', '89234932489', 'asif.sadiq@live.com', 'R-1, Street A', 'R-1, Street A', 0x63312e6a7067, 0x63312e6a7067, 'karachi', 'Pakistan Internation', 0, 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '39f525f04a4a6818be91454b8c55b30d', '11:23:14', 'abc@gmail.com.pk');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'B1'),
(2, 'B2');

-- --------------------------------------------------------

--
-- Table structure for table `course_information`
--

CREATE TABLE `course_information` (
  `Course_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `course_information` varchar(300) NOT NULL,
  `course_duration` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enroll_id` int(11) NOT NULL,
  `cand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `enroll_date` datetime NOT NULL,
  `station_id` int(11) NOT NULL,
  `isenrolled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`enroll_id`, `cand_id`, `category_id`, `module_id`, `enroll_date`, `station_id`, `isenrolled`) VALUES
(54, 93, 1, 2, '2016-06-15 15:53:39', 1, 1),
(55, 93, 2, 5, '2016-06-15 15:54:53', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exams_shift`
--

CREATE TABLE `exams_shift` (
  `exam_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `shift_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `cand_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `cand_id`, `login_time`, `logout_time`, `ip_address`) VALUES
(1, 1, '2016-05-19 11:22:19', '2016-05-19 11:47:17', 'localhost:57034'),
(2, 1, '2016-05-19 11:22:19', '2016-05-19 11:47:17', 'localhost:57034'),
(3, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'localhost:57172'),
(4, 2, '0000-00-00 00:00:00', '2016-05-19 13:22:03', 'localhost:57175'),
(5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'localhost:57184'),
(6, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'localhost:57240'),
(7, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'localhost:57243'),
(8, 1, '0000-00-00 00:00:00', '2016-05-19 13:20:27', 'localhost:57256'),
(9, 1, '0000-00-00 00:00:00', '2016-05-19 13:23:02', 'localhost:49656'),
(10, 1, '0000-00-00 00:00:00', '2016-05-19 13:25:00', 'localhost:49698'),
(11, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'localhost:57265'),
(12, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'localhost:57240'),
(13, 1, '0000-00-00 00:00:00', '2016-05-19 13:30:22', 'localhost:49823'),
(14, 1, '2016-05-19 13:31:07', '2016-05-19 13:31:27', 'localhost:49855'),
(15, 3, '2016-05-19 13:34:25', '2016-05-19 13:34:46', 'localhost:49890'),
(16, 1, '2016-05-19 22:35:53', '0000-00-00 00:00:00', 'localhost:55632'),
(17, 1, '2016-05-20 06:24:34', '0000-00-00 00:00:00', 'localhost:56388'),
(18, 1, '2016-05-20 06:32:28', '0000-00-00 00:00:00', 'localhost:56487'),
(19, 1, '2016-05-20 06:36:46', '2016-05-20 06:38:53', 'localhost:56620'),
(20, 1, '2016-05-20 06:39:27', '2016-05-20 06:39:45', 'localhost:56658'),
(21, 2, '2016-05-20 06:40:09', '2016-05-20 06:40:13', 'localhost:56672'),
(22, 1, '2016-05-20 09:10:30', '2016-05-20 10:17:41', 'localhost:56720'),
(23, 1, '2016-05-20 11:30:58', '2016-05-20 14:49:00', 'localhost:57383'),
(24, 2, '2016-05-20 14:49:07', '0000-00-00 00:00:00', 'localhost:58215'),
(25, 2, '2016-05-20 14:58:01', '2016-05-20 15:01:07', 'localhost:58367'),
(26, 3, '2016-05-20 15:02:16', '2016-05-20 15:05:53', 'localhost:58428'),
(27, 3, '2016-05-20 15:06:32', '2016-05-20 15:42:15', 'localhost:58496'),
(28, 1, '2016-05-24 13:01:53', '2016-05-24 13:03:34', 'localhost:63697'),
(29, 6, '2016-05-24 13:12:49', '2016-05-24 15:42:35', 'localhost:63871'),
(30, 1, '2016-05-24 15:43:27', '2016-05-24 16:44:53', 'localhost:64514'),
(31, 19, '2016-05-24 21:02:29', '2016-05-24 21:02:33', 'localhost:53114'),
(32, 19, '2016-05-24 23:09:32', '2016-05-24 23:13:42', 'localhost:54975'),
(33, 19, '2016-05-24 23:16:20', '0000-00-00 00:00:00', 'localhost:55170'),
(34, 19, '2016-05-24 23:22:42', '2016-05-24 23:23:17', 'localhost:55242'),
(35, 3, '2016-05-25 09:53:45', '2016-05-25 09:56:53', 'localhost:55839'),
(36, 3, '2016-05-25 16:19:54', '0000-00-00 00:00:00', 'localhost:58088'),
(37, 1, '2016-05-27 11:14:02', '2016-05-27 11:48:41', 'localhost:52530'),
(38, 3, '2016-05-27 12:00:28', '0000-00-00 00:00:00', 'localhost:52751'),
(39, 3, '2016-05-27 12:32:48', '0000-00-00 00:00:00', 'localhost:53019'),
(40, 3, '2016-05-27 13:11:44', '0000-00-00 00:00:00', 'localhost:53362'),
(41, 3, '2016-05-29 21:55:53', '2016-05-29 21:55:57', 'localhost:59228'),
(42, 3, '2016-05-29 22:11:06', '2016-05-29 22:11:10', 'localhost:59469'),
(43, 3, '2016-05-30 09:30:49', '2016-05-30 10:41:34', 'localhost:62170'),
(44, 3, '2016-05-30 10:43:22', '2016-05-30 12:13:51', 'localhost:62670'),
(45, 3, '2016-05-30 21:27:21', '0000-00-00 00:00:00', 'localhost:52624'),
(46, 3, '2016-05-30 21:37:03', '0000-00-00 00:00:00', 'localhost:52784'),
(47, 3, '2016-05-31 12:11:26', '2016-05-31 14:36:37', 'localhost:53090'),
(48, 3, '2016-06-01 11:02:27', '2016-06-01 16:00:54', 'localhost:55160'),
(49, 3, '2016-06-01 21:49:51', '2016-06-02 09:58:00', 'localhost:59473'),
(50, 3, '2016-06-02 09:58:08', '0000-00-00 00:00:00', 'localhost:62543'),
(51, 3, '2016-06-02 10:43:53', '0000-00-00 00:00:00', 'localhost:62999'),
(52, 3, '2016-06-02 14:45:07', '2016-06-02 15:03:10', 'localhost:49648'),
(53, 3, '2016-06-02 15:04:08', '2016-06-02 15:09:09', 'localhost:49727'),
(54, 3, '2016-06-02 15:15:04', '2016-06-02 15:16:33', 'localhost:49869'),
(55, 3, '2016-06-02 23:10:35', '0000-00-00 00:00:00', 'localhost:54552'),
(56, 3, '2016-06-02 23:11:08', '0000-00-00 00:00:00', 'localhost:54564'),
(57, 3, '2016-06-02 23:11:15', '0000-00-00 00:00:00', 'localhost:54567'),
(58, 3, '2016-06-02 23:11:36', '0000-00-00 00:00:00', 'localhost:54572'),
(59, 3, '2016-06-02 23:13:28', '0000-00-00 00:00:00', 'localhost:54595'),
(60, 3, '2016-06-02 23:18:56', '0000-00-00 00:00:00', 'localhost:54657'),
(61, 1, '2016-06-02 23:20:32', '2016-06-02 23:21:37', 'localhost:54688'),
(62, 3, '2016-06-02 23:22:39', '0000-00-00 00:00:00', 'localhost:54709'),
(63, 3, '2016-06-02 23:22:46', '2016-06-03 00:11:41', 'localhost:54712'),
(64, 3, '2016-06-03 09:01:10', '2016-06-03 10:16:01', 'localhost:55484'),
(65, 3, '2016-06-03 10:18:56', '2016-06-03 11:55:07', 'localhost:56397'),
(66, 60, '2016-06-03 12:45:44', '2016-06-03 13:25:33', 'localhost:58803'),
(67, 3, '2016-06-07 00:16:05', '2016-06-07 02:12:56', 'localhost:59872'),
(68, 3, '2016-06-07 18:41:22', '2016-06-07 18:41:26', 'localhost:64434'),
(69, 3, '2016-06-14 09:36:25', '2016-06-14 09:36:29', 'localhost:63950'),
(70, 3, '2016-06-14 09:53:42', '2016-06-14 10:10:45', 'localhost:64152'),
(71, 3, '2016-06-14 10:10:55', '0000-00-00 00:00:00', 'localhost:64313'),
(72, 3, '2016-06-14 12:50:40', '0000-00-00 00:00:00', 'localhost:51474'),
(73, 3, '2016-06-14 14:13:48', '2016-06-14 15:54:32', 'localhost:51940'),
(74, 93, '2016-06-15 06:01:59', '2016-06-15 06:35:01', 'localhost:60304'),
(75, 93, '2016-06-15 10:50:06', '2016-06-15 10:50:43', 'localhost:63726'),
(76, 93, '2016-06-15 11:53:30', '2016-06-15 12:15:34', 'localhost:64343'),
(77, 99, '2016-06-15 12:58:30', '0000-00-00 00:00:00', 'localhost:49287'),
(78, 99, '2016-06-15 13:14:04', '2016-06-15 13:14:31', 'localhost:49408'),
(79, 93, '2016-06-15 13:14:40', '0000-00-00 00:00:00', 'localhost:49422'),
(80, 93, '2016-06-15 15:51:11', '0000-00-00 00:00:00', 'localhost:50206');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(20) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_name`, `category_id`) VALUES
(1, 'Module 01', 1),
(2, 'Module 02', 1),
(3, 'Module 03', 1),
(4, 'Module 01', 2),
(5, 'Module 02', 2),
(6, 'Module 04', 1),
(7, 'Module 05', 1),
(8, 'Module 06', 1),
(9, 'Module 07', 1),
(10, 'Module 08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `org_id` int(11) NOT NULL,
  `org_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`org_id`, `org_name`) VALUES
(1, 'Pakistan International Airlines'),
(2, 'Army'),
(3, 'Pakistan Air Force'),
(4, 'Navy'),
(5, 'Shaheen Air International'),
(6, 'Air Blue');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `exam_date` datetime NOT NULL,
  `module_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `station_id` varchar(30) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `exam_deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`exam_date`, `module_id`, `category_id`, `station_id`, `exam_id`, `exam_deadline`) VALUES
('2016-08-16 00:00:00', 2, 1, '1', 27, '2016-06-23'),
('2016-06-14 00:00:00', 5, 2, '8', 28, '2016-06-16'),
('2016-06-18 00:00:00', 8, 1, '6', 29, '2016-06-16'),
('2016-06-30 00:00:00', 4, 2, '4', 30, '2016-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `station_id` int(11) NOT NULL,
  `station_name` varchar(20) NOT NULL,
  `STN` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`station_id`, `station_name`, `STN`) VALUES
(1, 'Karachi', 'KHI'),
(2, 'Lahore', 'LHR'),
(3, 'Sawat', 'SWT'),
(4, 'Islamabad', 'ISL'),
(5, 'Multan', 'MLT'),
(6, 'Peshawar', 'PSH'),
(7, 'Quetta', 'QTA'),
(8, 'Nawabshah', 'NBS');

-- --------------------------------------------------------

--
-- Table structure for table `user_shift`
--

CREATE TABLE `user_shift` (
  `cand_id` int(11) NOT NULL,
  `user_shift_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_transaction`
--

CREATE TABLE `user_transaction` (
  `transaction_id` int(11) NOT NULL,
  `cand_id` int(11) NOT NULL,
  `enroll_id` int(11) NOT NULL,
  `transaction_time` datetime NOT NULL,
  `transaction_ipaddress` varchar(50) NOT NULL,
  `debit` float NOT NULL,
  `credit` float NOT NULL,
  `balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_transaction`
--

INSERT INTO `user_transaction` (`transaction_id`, `cand_id`, `enroll_id`, `transaction_time`, `transaction_ipaddress`, `debit`, `credit`, `balance`) VALUES
(21, 93, 0, '2016-06-15 06:00:19', 'localhost:60232', 5000, 0, 5000),
(22, 93, 0, '2016-06-15 06:01:04', 'localhost:60270', 5000, 0, 10000),
(24, 93, 37, '2016-06-15 06:22:55', 'localhost:60615', 0, 2000, 8000),
(25, 93, 38, '2016-06-15 06:31:18', 'localhost:60758', 0, 2000, 6000),
(26, 93, 39, '2016-06-15 10:50:29', 'localhost:63742', 0, 2000, 4000),
(27, 93, 40, '2016-06-15 11:54:29', 'localhost:64363', 0, 2000, 2000),
(37, 93, 50, '2016-06-15 12:13:44', 'localhost:64799', 0, 2000, 0),
(43, 93, 0, '2016-06-15 12:40:13', 'localhost:65321', 5000, 0, 5000),
(48, 93, 54, '2016-06-15 15:53:39', 'localhost:50230', 0, 2000, 3000),
(49, 93, 55, '2016-06-15 15:54:53', 'localhost:50285', 0, 2000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_id` varchar(10) NOT NULL,
  `voucher_amount` float NOT NULL,
  `Ref_id` varchar(11) NOT NULL,
  `voucher_attachment` longblob NOT NULL,
  `voucher_date` date NOT NULL,
  `voucher_entry_date` date NOT NULL,
  `admin_id` int(11) NOT NULL,
  `isdeletedby` int(11) NOT NULL,
  `isdeletedat` datetime NOT NULL,
  `isdeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `voucher_amount`, `Ref_id`, `voucher_attachment`, `voucher_date`, `voucher_entry_date`, `admin_id`, `isdeletedby`, `isdeletedat`, `isdeleted`) VALUES
('12345', 5000, '2016PIA0093', 0x63312e6a7067, '2016-06-15', '2016-06-15', 1, 0, '0000-00-00 00:00:00', 0),
('346734', 5, '2016PIA0093', 0x63312e6a7067, '2016-06-14', '2016-06-15', 1, 0, '0000-00-00 00:00:00', 0),
('43743', 5000, '2016PIA0093', 0x63312e6a7067, '2016-06-15', '2016-06-15', 1, 0, '0000-00-00 00:00:00', 0),
('456783', 5000, '2016PIA0093', 0x63312e6a7067, '2016-06-15', '2016-06-15', 1, 0, '0000-00-00 00:00:00', 0),
('73637', 5000, '2016PIA0093', 0x63312e6a7067, '2016-06-15', '2016-06-15', 1, 0, '0000-00-00 00:00:00', 0),
('7838', 5000, '2016PIA0093', 0x63312e6a7067, '2016-06-15', '2016-06-15', 1, 0, '0000-00-00 00:00:00', 0),
('78902', 10000, '2016PIA0093', 0x63312e6a7067, '2016-06-14', '2016-06-15', 1, 0, '0000-00-00 00:00:00', 0),
('832743', 500, '2016PIA0093', 0x63312e6a7067, '2016-06-15', '2016-06-15', 1, 0, '0000-00-00 00:00:00', 0),
('83943', 50000, '2016PIA0093', 0x63312e6a7067, '2016-06-15', '2016-06-15', 1, 0, '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`cand_id`),
  ADD UNIQUE KEY `cand_email` (`cand_email`),
  ADD UNIQUE KEY `cand_nic` (`cand_nic`),
  ADD UNIQUE KEY `cand_contactno` (`cand_contactno`),
  ADD UNIQUE KEY `Ref_id` (`Ref_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `course_information`
--
ALTER TABLE `course_information`
  ADD PRIMARY KEY (`Course_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enroll_id`);

--
-- Indexes for table `exams_shift`
--
ALTER TABLE `exams_shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`station_id`);

--
-- Indexes for table `user_shift`
--
ALTER TABLE `user_shift`
  ADD PRIMARY KEY (`user_shift_id`);

--
-- Indexes for table `user_transaction`
--
ALTER TABLE `user_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD UNIQUE KEY `voucher_id` (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administration`
--
ALTER TABLE `administration`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `cand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `course_information`
--
ALTER TABLE `course_information`
  MODIFY `Course_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `exams_shift`
--
ALTER TABLE `exams_shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_shift`
--
ALTER TABLE `user_shift`
  MODIFY `user_shift_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_transaction`
--
ALTER TABLE `user_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
