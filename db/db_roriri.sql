-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2024 at 06:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_roriri`
--

-- --------------------------------------------------------

--
-- Table structure for table `academy_detail_tbl`
--

CREATE TABLE `academy_detail_tbl` (
  `academy_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `academy_year` varchar(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `academy_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `academy_created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `additional_details_tbl`
--

CREATE TABLE `additional_details_tbl` (
  `ad_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `aadhar` varchar(20) NOT NULL,
  `additional_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `aditional_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `additional_details_tbl`
--

INSERT INTO `additional_details_tbl` (`ad_id`, `entity_id`, `stu_id`, `dob`, `email`, `phone`, `address`, `aadhar`, `additional_created_date`, `aditional_status`) VALUES
(1, 0, 1, '2001-01-17', 'yesubalans@roririsoft.com', '9344995037', 'Kalakad', '463689346511', '2024-06-10 12:13:30', 'Inactive'),
(2, 0, 2, '2002-01-24', 'jebastin@gmail.com', '9874563214', 'Kela Kalladi', '989745632146', '2024-06-15 14:18:09', 'Active'),
(3, 0, 3, '1995-02-14', 'jebarlin@gmail.com', '9789867842', 'kalakad', '5342465657567', '2024-06-18 12:40:58', 'Inactive'),
(4, 0, 4, '1997-07-06', 'jebarathi@gmail.com', '9789867842', 'kalakad', '275861786592', '2024-06-18 12:44:43', 'Inactive'),
(5, 0, 5, '2001-07-18', 'nicks@gmail.com', '9789867842', 'kalakad', '125478548665', '2024-06-18 12:55:11', 'Inactive'),
(6, 0, 6, '2003-03-20', 'dania@roriri.com', '6787685667', 'Kalakad', '576876978945', '2024-06-18 13:01:58', 'Inactive'),
(7, 0, 7, '2002-07-01', 'dghkgh@gmail.com', '9789867842', 'kalakad', '457812458956', '2024-06-18 13:02:37', 'Inactive'),
(8, 0, 8, '2001-07-10', 'nicks@gmail.com', '9789867842', 'kalakad', '125478548665', '2024-06-18 14:57:20', 'Active'),
(9, 0, 9, '2004-03-18', 'dania@roriri.com', '6787685667', 'Kalakad', '576876978945', '2024-06-18 15:09:02', 'Inactive'),
(10, 0, 10, '2024-06-18', 'dania@roriri.com', '67876856676575', 'Kalakad', '576876978945', '2024-06-18 15:09:44', 'Inactive'),
(11, 0, 11, '2003-03-20', 'roriri@roriri.com', '6787685667', 'Kalakad', '576876978945', '2024-06-18 16:08:41', 'Inactive'),
(12, 0, 12, '2024-06-01', 'dania@roriri.com', '6787685667', 'Kalakad', '576876978945', '2024-06-20 14:20:17', 'Active'),
(13, 0, 13, '2024-06-11', 'dania@roriri.com', '6787685667', 'Kalakad', '576876978945', '2024-06-26 10:41:42', 'Active'),
(14, 0, 14, '2024-06-11', 'dania@roriri.com', '6787685667', 'Kalakad', '576876978945', '2024-06-26 10:41:44', 'Inactive'),
(15, 0, 15, '2024-06-11', 'dania@roriri.com', '6787685667', 'Kalakad', '576876978945', '2024-06-26 10:41:44', 'Inactive'),
(16, 0, 16, '2024-06-11', 'dania@roriri.com', '6787685667', 'Kalakad', '576876978945', '2024-06-26 10:41:46', 'Inactive'),
(17, 0, 17, '2024-06-11', 'dania@roriri.com', '6787685667', 'Kalakad', '576876978945', '2024-06-26 10:41:48', 'Inactive'),
(18, 0, 18, '2024-06-01', 'roriri@roriri.com', '6787685667435', 'Kalakad', '57687697894545', '2024-06-26 10:50:49', 'Active'),
(19, 0, 19, '2024-06-04', 'uma@roriri.com', '6787685667', 'Kalakad', '576876978945', '2024-06-26 11:02:09', 'Active'),
(20, 0, 20, '2024-06-07', 'durga@gmail.com', '5246434558', 'kalakad', '545424548517', '2024-06-28 14:32:38', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `role` enum('Super Admin','Admin','MD','Team Leader','Jr.Developer','Student','Sr.Developer','HR','CEO','UI/UX Designer') NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`user_id`, `name`, `username`, `pass`, `role`, `created_date`, `status`) VALUES
(1, 'admin', 'admin', 'admin', 'Super Admin', '2024-06-10 10:10:48', 'Active'),
(2, 'vasnth M', 'vasnthM', 'vasnthM482', 'Jr.Developer', '2024-06-10 10:35:22', 'Active'),
(3, 'Yesu Balan', 'YesuBalan', 'YesuBalan539', 'Student', '2024-06-10 12:13:30', 'Active'),
(4, 'Gnana Jebastin', 'GnanaJebastin', 'GnanaJebastin915', 'Student', '2024-06-15 14:18:09', 'Active'),
(5, 'Asha T', 'AshaT', 'AshaT306', 'Jr.Developer', '2024-06-17 14:53:01', 'Active'),
(6, 'Jebarlin Dania', 'JebarlinDania', 'JebarlinDania564', 'Student', '2024-06-18 12:40:58', 'Active'),
(7, 'Jebarathi S', 'JebarathiS', 'JebarathiS676', 'Student', '2024-06-18 12:44:43', 'Active'),
(8, 'KingJohn Nicks', 'KingJohnNicks', 'KingJohnNicks252', 'Student', '2024-06-18 12:55:11', 'Active'),
(9, 'Jebarli Dania', 'JebarliDania', 'JebarliDania902', 'Student', '2024-06-18 13:01:58', 'Active'),
(10, 'Uma Saraswathi', 'UmaSaraswathi', 'UmaSaraswathi689', 'Student', '2024-06-18 13:02:37', 'Inactive'),
(11, 'KingJohn N', 'KingJohnN', 'KingJohnN966', 'Student', '2024-06-18 14:57:20', 'Active'),
(15, 'Asha1 T', 'Asha1T', 'Asha1T265', 'Student', '2024-06-18 15:09:02', 'Active'),
(17, 'Asha12 T', 'Asha12T', 'Asha12T818', 'Student', '2024-06-18 15:09:44', 'Active'),
(18, 'Bala Ajinika', 'BalaAjinika', 'BalaAjinika121', 'Student', '2024-06-18 16:08:41', 'Inactive'),
(19, 'Jebarlin  Dania', 'Jebarlin Dania732', 'Jebarlin Dania292', 'Jr.Developer', '2024-06-19 12:55:01', 'Active'),
(20, 'Dania J', 'DaniaJ', 'DaniaJ610', 'Student', '2024-06-20 14:20:16', 'Active'),
(21, 'Raj Kumar', 'RajKumar', 'RajKumar803', 'Team Leader', '2024-06-25 09:39:03', 'Active'),
(25, 'Asha 1 T', 'Asha 1T', 'Asha 1T435', 'Jr.Developer', '2024-06-25 09:45:32', 'Active'),
(26, 'Jebarli J', 'JebarliJ', 'JebarliJ297', 'Jr.Developer', '2024-06-26 09:59:00', 'Active'),
(27, 'Jebarlij dania', 'Jebarlijdania', 'Jebarlijdania302', 'Student', '2024-06-26 10:41:42', 'Active'),
(28, 'Jebarlij dania', 'Jebarlijdania514', 'Jebarlijdania270', 'Student', '2024-06-26 10:41:44', 'Inactive'),
(29, 'Jebarlij dania', 'Jebarlijdania956', 'Jebarlijdania961', 'Student', '2024-06-26 10:41:44', 'Inactive'),
(30, 'Jebarlij dania', 'Jebarlijdania747', 'Jebarlijdania631', 'Student', '2024-06-26 10:41:46', 'Inactive'),
(31, 'Jebarlij dania', 'Jebarlijdania978', 'Jebarlijdania581', 'Student', '2024-06-26 10:41:48', 'Inactive'),
(32, 'kavi s', 'kavis', 'kavis481', 'Student', '2024-06-26 10:50:49', 'Active'),
(33, 'Jons J', 'JonsJ', 'JonsJ288', 'Student', '2024-06-26 11:02:09', 'Active'),
(34, 'Durga s', 'Durgas', 'Durgas930', 'Jr.Developer', '2024-06-28 14:21:31', 'Active'),
(35, 'Durga s', 'Durgas139', 'Durgas312', 'Student', '2024-06-28 14:32:38', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `assign_task_tbl`
--

CREATE TABLE `assign_task_tbl` (
  `at_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `syllabus_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `at_status` enum('Pending','Completed') NOT NULL,
  `at_date` date NOT NULL DEFAULT current_timestamp(),
  `at_complete_date` date NOT NULL DEFAULT current_timestamp(),
  `at_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `at_updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_task_tbl`
--

INSERT INTO `assign_task_tbl` (`at_id`, `stu_id`, `task_id`, `syllabus_id`, `course_id`, `at_status`, `at_date`, `at_complete_date`, `at_created_date`, `at_updated_date`) VALUES
(1, 0, 0, 0, 0, '', '2024-06-24', '2024-06-24', '2024-06-24 11:13:19', '2024-06-24 05:43:19'),
(2, 1, 1, 1, 2, 'Pending', '2024-06-11', '2024-06-24', '2024-06-24 17:44:45', '2024-06-24 12:14:45'),
(3, 1, 1, 1, 2, 'Pending', '2024-06-12', '2024-06-24', '2024-06-24 17:47:56', '2024-06-24 12:17:56'),
(4, 1, 1, 1, 2, 'Pending', '2024-06-11', '2024-06-24', '2024-06-24 17:48:07', '2024-06-24 12:18:07'),
(5, 8, 1, 1, 2, 'Pending', '2024-06-13', '2024-06-12', '2024-06-25 09:51:57', '2024-06-25 04:21:57'),
(6, 1, 1, 1, 2, 'Pending', '2024-06-04', '2024-06-26', '2024-06-25 09:54:24', '2024-06-25 04:24:24'),
(7, 1, 1, 1, 2, 'Pending', '2024-06-13', '2024-06-16', '2024-06-25 09:54:42', '2024-06-25 04:24:42'),
(8, 3, 1, 1, 2, 'Pending', '2024-06-25', '2024-06-26', '2024-06-25 09:57:12', '2024-06-25 04:27:12'),
(9, 4, 1, 1, 2, 'Pending', '2024-06-25', '2024-06-26', '2024-06-25 10:25:54', '2024-06-25 04:55:54'),
(10, 5, 1, 1, 2, 'Pending', '2024-06-25', '2024-06-26', '2024-06-25 10:27:36', '2024-06-25 04:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `atd_id` int(11) NOT NULL,
  `atd_report` longtext NOT NULL,
  `atd_date` date NOT NULL,
  `atd_status` enum('Active','Inactive') NOT NULL,
  `atd_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `atd_updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `category_id` int(11) DEFAULT NULL,
  `Category_type` varchar(50) NOT NULL,
  `category_status` enum('Active','Inactive','','') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`category_id`, `Category_type`, `category_status`, `created_at`, `updated_at`) VALUES
(1, 'Employee', 'Active', '2024-06-06 12:50:32', '2024-06-06 12:50:32'),
(2, 'Client', 'Active', '2024-06-06 12:50:32', '2024-06-06 12:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `client_tbl`
--

CREATE TABLE `client_tbl` (
  `client_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_company` varchar(100) NOT NULL,
  `client_location` varchar(100) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `client_phone` varchar(11) NOT NULL,
  `client_gst` varchar(30) NOT NULL,
  `client_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `client_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `client_updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_tbl`
--

INSERT INTO `client_tbl` (`client_id`, `entity_id`, `client_name`, `client_company`, `client_location`, `client_email`, `client_phone`, `client_gst`, `client_status`, `client_created_date`, `client_updated_date`) VALUES
(1, 1, 'Roriri Soft Private Ltd', 'RORIRI SOFTWARE SOLUTIONS PRIVATE LIMITED', 'fdgjkfdj', 'roririsoftpvtltd@gmail.com', '07845593579', 'xsg4j5h471456', 'Active', '2024-06-15 10:18:07', '2024-06-21 09:39:37'),
(2, 1, 'Asha', 'Roriri', 'Kalakad', 'ashat4944@gmail.com', '9943862039', '-----', 'Active', '2024-06-17 14:49:50', '2024-06-17 09:19:50'),
(3, 1, 'Dania', 'Roriri', 'Kalakad', 'dania@roriri.com', '9943862039', '-----', 'Inactive', '2024-06-18 12:00:09', '2024-06-18 07:44:54'),
(4, 1, 'Uma', 'Roriri', 'Kalakad', 'uma@roriri.com', '6738469287', '-----', 'Inactive', '2024-06-18 12:18:38', '2024-06-18 07:44:51'),
(5, 1, 'Anu', 'Roriri', 'Kalakad', 'anu@roriri.com', '4354676575', '-----', 'Inactive', '2024-06-18 12:30:00', '2024-06-18 07:44:49'),
(6, 1, 'Rajkumar', 'Roriri', 'Kalakad', 'rajkumar@roriri.com', '76878979', '-----', 'Inactive', '2024-06-18 12:34:19', '2024-06-18 07:44:46'),
(7, 1, 'Roriri', 'Roriri Software', 'Kalakad', 'roriri@roriri.com', '789879780', '-----', 'Inactive', '2024-06-18 12:35:36', '2024-06-18 07:44:42'),
(8, 1, 'Irin', 'Roriri', 'Kalakad', 'irin@roriri.com', '8798980', '-----', 'Inactive', '2024-06-18 12:37:39', '2024-06-18 07:44:39'),
(9, 1, 'Aji', 'Roriri', 'Kalakad', 'dania@roriri.com', '67879789', '-----', 'Inactive', '2024-06-18 12:45:09', '2024-06-18 07:44:25'),
(10, 1, 'Kanaga', 'Roriri', 'Kalakad', 'dania@roriri.com', '6787685667', '-----', 'Inactive', '2024-06-18 13:14:02', '2024-06-18 07:44:36'),
(11, 1, 'Kanaga', 'Roriri', 'Kalakad', 'kanaga@roriri.com', '6787685667', '-----', 'Inactive', '2024-06-18 14:11:35', '2024-06-18 09:10:34'),
(12, 1, 'Kanaga', 'Roriri', 'Kalakad', 'dania@roriri.com', '6787685667', '-----', 'Inactive', '2024-06-18 14:48:33', '2024-06-18 09:18:45'),
(13, 1, 'Kanaga', 'Roriri', 'Kalakad', 'dania@roriri.com', '678768566', '-----', 'Inactive', '2024-06-18 14:51:10', '2024-06-18 09:22:59'),
(14, 1, 'Aji', 'Roriri', 'Kalakad', 'dania@roriri.com', '67876856', '-----', 'Inactive', '2024-06-18 14:52:37', '2024-06-18 09:22:43'),
(15, 1, 'Aji', 'Roriri', 'Kalakad', 'dania@roriri.com', '6787685667', '-----', 'Inactive', '2024-06-18 14:56:55', '2024-06-18 09:29:55'),
(16, 1, 'Kanaga', 'Roriri Software', 'Kalakad', 'dania@roriri.com', '6787685667', '-----', 'Inactive', '2024-06-18 14:58:24', '2024-06-18 09:28:29'),
(17, 1, 'Kanaga', 'Roriri', 'Kalakad', 'dania@roriri.com', '6787685667', '-----', 'Inactive', '2024-06-18 14:59:30', '2024-06-18 09:29:41'),
(18, 1, 'Kanaga1', 'Roriri', 'Kalakad', 'dania@roriri.com', '6787685667', '-----', 'Inactive', '2024-06-18 15:00:55', '2024-06-18 09:31:17'),
(19, 1, 'Kanaga', 'Roriri', 'Kalakad', 'dania@roriri.com', '6787685667', '-----', 'Inactive', '2024-06-18 15:04:57', '2024-06-18 09:35:03'),
(20, 1, 'Kanaga', 'Roriri', 'Kalakad', 'dania@roriri.com', '67876856678', '-----', 'Active', '2024-06-18 15:06:21', '2024-06-18 09:36:21'),
(21, 1, 'Aji', 'Roriri', 'Kalakad', 'dania@roriri.com', '67876856674', '-----', 'Inactive', '2024-06-18 15:12:31', '2024-06-18 09:44:00'),
(22, 1, 'Kanaga', 'Roriri', 'Kalakad', 'dania@roriri.com', '67876856674', '-----', 'Inactive', '2024-06-18 15:13:21', '2024-06-18 09:44:02'),
(23, 1, 'Aji', 'Roriri', 'Kalakad', 'aji@roriri.com', '6787685665', '-----', 'Active', '2024-06-18 15:15:10', '2024-06-18 09:46:02'),
(24, 1, 'fhjl', 'fhjl', 'fhjl', 'fhjl@gmail.com', '7896541354', '5465797549595', 'Inactive', '2024-06-21 15:09:13', '2024-06-21 09:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
  `course_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `course_fees_3` int(11) NOT NULL,
  `course_fees_6` int(11) NOT NULL,
  `course_fees_12` int(11) NOT NULL,
  `course_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `course_created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_tbl`
--

INSERT INTO `course_tbl` (`course_id`, `entity_id`, `course_name`, `course_fees_3`, `course_fees_6`, `course_fees_12`, `course_status`, `course_created_date`) VALUES
(1, 1, 'Internship', 15000, 30000, 0, 'Active', '2024-06-06 13:27:48'),
(2, 3, 'Full Stack Development', 20000, 45000, 90000, 'Active', '2024-06-06 13:28:15'),
(3, 3, 'Testing', 15000, 25000, 0, 'Active', '2024-06-06 13:28:56'),
(4, 3, 'Devops', 15000, 30000, 0, 'Active', '2024-06-06 13:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE `employee_tbl` (
  `emp_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `emp_first_name` varchar(50) NOT NULL,
  `emp_last_name` varchar(50) NOT NULL,
  `emp_user_id` int(11) NOT NULL,
  `emp_aadhar` varchar(50) NOT NULL,
  `emp_pan` varchar(50) NOT NULL,
  `emp_bank` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `emp_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `emp_married_status` enum('Married','Unmarried') NOT NULL DEFAULT 'Unmarried'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_tbl`
--

INSERT INTO `employee_tbl` (`emp_id`, `entity_id`, `emp_first_name`, `emp_last_name`, `emp_user_id`, `emp_aadhar`, `emp_pan`, `emp_bank`, `created_date`, `updated_date`, `emp_status`, `emp_married_status`) VALUES
(1, 1, 'Vasanth', 'M', 2, '', '', '', '2024-06-10 10:35:22', '2024-06-26 04:44:18', 'Active', 'Unmarried'),
(2, 1, 'Asha', 'T', 5, '', '', '', '2024-06-17 14:53:01', '2024-06-18 09:35:46', 'Active', 'Unmarried'),
(3, 1, 'Jebarlin 1', 'Dania', 19, 'Jebarlin Dania732_aadhar.txt', 'Jebarlin Dania732_pan.txt', 'Jebarlin Dania732_bank.txt', '2024-06-19 12:55:01', '2024-06-19 07:39:47', 'Inactive', 'Married'),
(4, 1, 'Raj', 'Kumar', 21, 'RajKumar_aadhar.png', 'RajKumar_pan.png', 'RajKumar_bank.jpg', '2024-06-25 09:39:03', '2024-06-28 09:16:34', 'Active', 'Unmarried'),
(5, 1, 'Asha 1', 'T', 25, '', '', '', '2024-06-25 09:45:32', '2024-06-25 04:15:51', 'Inactive', 'Unmarried'),
(6, 1, 'Jebarli', 'J', 26, '', '', '', '2024-06-26 09:59:00', '2024-06-26 05:03:57', 'Inactive', 'Married'),
(7, 1, 'Durga', 's', 34, 'Durgas_aadhar.jpg', 'Durgas_pan.jpg', 'Durgas_bank.jpg', '2024-06-28 14:21:31', '2024-06-28 09:00:10', 'Inactive', 'Unmarried');

-- --------------------------------------------------------

--
-- Table structure for table `emp_additional_tbl`
--

CREATE TABLE `emp_additional_tbl` (
  `add_tbl_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `emp_personal_email` varchar(30) NOT NULL,
  `emp_company_email` varchar(40) NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_pay_role` int(11) NOT NULL,
  `emp_joining_date` date NOT NULL,
  `emp_role` enum('Team Leader','Jr.Developer','HR','CEO','Sr.Developer','UI/UX Designer') NOT NULL,
  `emp_mobile` varchar(10) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `emp_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_additional_tbl`
--

INSERT INTO `emp_additional_tbl` (`add_tbl_id`, `emp_id`, `emp_personal_email`, `emp_company_email`, `emp_dob`, `emp_pay_role`, `emp_joining_date`, `emp_role`, `emp_mobile`, `emp_address`, `emp_created_date`, `emp_status`) VALUES
(1, 1, 'vasanth@gmail.com', 'vasanth@roririsoft.com', '2001-02-11', 0, '2024-06-03', 'Jr.Developer', '9894688091', 'kallikulam', '2024-06-10 10:35:22', 'Active'),
(2, 2, 'ashat4944@gmail.com', 'ashat@roririsoft.com', '2003-03-20', 0, '2024-06-15', 'Jr.Developer', '9943862039', '234354365', '2024-06-17 14:53:01', 'Active'),
(3, 3, 'dania@gmail.com', 'dania@roririsoft.com', '2024-06-14', 0, '2024-06-04', 'Jr.Developer', '9943862090', 'kalakad', '2024-06-19 12:55:01', 'Inactive'),
(4, 4, 'raj@gmail.com', 'raj@roriri.com', '2024-06-05', 0, '2024-06-12', 'Team Leader', '7896541354', 'kalakad', '2024-06-25 09:39:03', 'Active'),
(5, 5, 'asha@roriri.com', 'asha@gmail.com', '2024-06-05', 0, '2024-06-13', 'Jr.Developer', '7896541389', 'kalakad', '2024-06-25 09:45:32', 'Inactive'),
(6, 6, 'vasanth@gmail.com', 'vasanth@roririsoft.com', '2024-06-01', 0, '2024-06-04', 'Jr.Developer', '6787685667', 'kallikulam', '2024-06-26 09:59:00', 'Inactive'),
(7, 7, 'durga@gmail.com', 'durga@roriri.com', '2024-06-06', 0, '2024-06-01', 'Jr.Developer', '5246434558', '456456524634', '2024-06-28 14:21:31', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `entity_tbl`
--

CREATE TABLE `entity_tbl` (
  `entity_id` int(11) NOT NULL,
  `entity_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entity_tbl`
--

INSERT INTO `entity_tbl` (`entity_id`, `entity_name`) VALUES
(1, 'RORIRI SOFTWARE SOLUTIONS '),
(2, 'NEXGEN IT COLLEGE'),
(3, 'NEXGEN IT ACADEMY'),
(4, 'RORIRI FOUNDATION'),
(5, 'RORIRI GROUPS'),
(6, 'RIYA IAS ACADEMY'),
(7, 'ROSHAN TILES'),
(8, 'RITHISH FARMS'),
(9, 'RIYA INFO SYSTEM');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `inv_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `invoice_dateile` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`invoice_dateile`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`inv_id`, `entity_id`, `invoice_dateile`) VALUES
(1, 1, '{\"Name\":\"vasanth M\",\"Address\":\"1/117 D vadukachiMathil\",\"MobileNo\":\"09789867842\",\"gstno\":\"787894\",\"gst\":\"IGST\",\"ssncode\":[\"001\",\"002\",\"003\"],\"Technologies\":[\"Website Development\",\"Website Development\",\"Website Development\"],\"Particulars\":[\"4\",\"2\",\"3\"],\"Amount\":[\"5154\",\"2000\",\"5000\"]}'),
(2, 1, '{\"Name\":\"anushiya\",\"Address\":\"kalakad\",\"MobileNo\":\"7878949\",\"gstno\":\"das5454\",\"gst\":\"IGST\",\"ssncode\":[\"002\"],\"Technologies\":[\"Website Development\"],\"Particulars\":[\"4\"],\"Amount\":[\"8941\"]}'),
(3, 1, '{\"Name\":\"anushiya\",\"Address\":\"kalakad\",\"MobileNo\":\"7878949\",\"gstno\":\"das5454\",\"gst\":\"IGST\",\"ssncode\":[\"002\"],\"Technologies\":[\"Website Development\"],\"Particulars\":[\"4\"],\"Amount\":[\"8941\"]}'),
(4, 1, '{\"Name\":\"Riya Infosystems\",\"Address\":\"1\\/117 D vadukachiMathil\",\"MobileNo\":\"09789867842\",\"gstno\":\"787894\",\"gst\":\"SGST-CGST\",\"ssncode\":[\"003\"],\"Technologies\":[\"\"],\"Particulars\":[\"4\"],\"Amount\":[\"8949\"]}'),
(5, 1, '{\"Name\":\"rajkumar\",\"Address\":\"1\\/117 D vadukachiMathil\",\"MobileNo\":\"09789867842\",\"gstno\":\"787894\",\"gst\":\"SGST-CGST\",\"ssncode\":[\"984189\"],\"Technologies\":[\"Website Development\"],\"Particulars\":[\"2\"],\"Amount\":[\"94951\"]}'),
(6, 1, '{\"Name\":\"rajkumar\",\"Address\":\"1\\/117 D vadukachiMathil\",\"MobileNo\":\"09789867842\",\"gstno\":\"787894\",\"gst\":\"SGST-CGST\",\"ssncode\":[\"984189\"],\"Technologies\":[\"Website Development\"],\"Particulars\":[\"2\"],\"Amount\":[\"94951\"]}'),
(7, 1, '{\"Name\":\"RORIRI\",\"Address\":\"RORIRI IT PARK,NALLANATHAPURAM,KALAKAD\",\"MobileNo\":\"09789867842\",\"gstno\":\"787894\",\"gst\":\"IGST\",\"ssncode\":[\"65485\"],\"Technologies\":[\"Website Development\"],\"Particulars\":[\"2\"],\"Amount\":[\"5151\"]}'),
(8, 3, '{\"Name\":\"Yesu Balan\",\"Address\":\"kovilpathu,kalakad,tirunelveli\",\"MobileNo\":\"7894561231\",\"gst\":\"IGST\",\"Technologies\":null,\"Particulars\":null,\"Amount\":null}'),
(9, 3, '{\"Name\":\"Yesu Balan\",\"Address\":\"kovilpathu,kalakad,tirunelveli\",\"MobileNo\":\"7894561231\",\"gst\":\"SGST-CGST\",\"Technologies\":[\"web development\"],\"Particulars\":[\"6 months\"],\"Amount\":[\"45000\"]}'),
(10, 3, '{\"Name\":\"Yesu Balan\",\"Address\":\"kovilpathu,kalakad,tirunelveli\",\"MobileNo\":\"7894561231\",\"gst\":\"SGST-CGST\",\"Technologies\":[\"web development\"],\"Particulars\":[\"6 months\"],\"Amount\":[\"45000\"]}'),
(11, 3, '{\"Name\":\"Yesu Balan\",\"Address\":\"kovilpathu,kalakad,tirunelveli\",\"MobileNo\":\"4563217896\",\"Technologies\":[\"web development\"],\"Particulars\":[\"6\"],\"Amount\":[\"45000\"]}'),
(12, 3, '{\"Name\":\"Jestin\",\"Address\":\"kalladi\",\"MobileNo\":\"7896541234\",\"Technologies\":[\"Full Stack developer\"],\"Particulars\":[\"5 years\"],\"Amount\":[\"500000\"]}'),
(13, 3, '{\"Name\":\"Muthu\",\"Address\":\"kalakad\",\"MobileNo\":\"654789321\",\"Technologies\":[\"Full Stack developer\"],\"Particulars\":[\"6 Months\"],\"Amount\":[\"45000\"]}'),
(14, 3, '{\"Name\":\"Jestin\",\"Address\":\"kovilpathu,kalakad,tirunelveli\",\"MobileNo\":\"4849494598\",\"Technologies\":[\"Full Stack developer\"],\"Particulars\":[\"6 Months\"],\"Amount\":[\"45000\"]}'),
(15, 0, '{\"Name\":\"Yesu Balan\",\"Address\":\"kovilpathu,kalakad,tirunelveli\",\"MobileNo\":\"5494548\",\"gstno\":\"gst54654Sajf\",\"gst\":\"SGST-CGST\",\"ssncode\":[\"4444\"],\"Technologies\":[\"Full Stack developer\"],\"Particulars\":[\"2\"],\"Amount\":[\"5485\"]}'),
(16, 3, '{\"Name\":\"Tamil Mani\",\"Address\":\"kovilpathu,kalakad,tirunelveli\",\"MobileNo\":\"78654914265\",\"Technologies\":[\"Full Stack developer\"],\"Particulars\":[\"6 Months\"],\"Amount\":[\"45000\"]}'),
(17, 3, '{\"Name\":\"Jebarlin\",\"Address\":\"kalakad\",\"MobileNo\":\"789465135\",\"Technologies\":[\"Full Stack developer\"],\"Particulars\":[\"6 Months\"],\"Amount\":[\"45000\"]}');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history_tbl`
--

CREATE TABLE `payment_history_tbl` (
  `pay_his_id` int(11) NOT NULL,
  `pay_id` int(11) NOT NULL,
  `history_payment_date` date NOT NULL,
  `pay_amount` int(11) NOT NULL,
  `payment_method` enum('Cash','Online Payment','Net Banking') NOT NULL,
  `history_created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_history_tbl`
--

INSERT INTO `payment_history_tbl` (`pay_his_id`, `pay_id`, `history_payment_date`, `pay_amount`, `payment_method`, `history_created_date`) VALUES
(1, 1, '2024-05-23', 15000, 'Cash', '2024-06-10 12:16:02'),
(2, 1, '2024-06-15', 1000, 'Cash', '2024-06-15 13:01:07'),
(3, 11, '2024-06-18', 1000, 'Cash', '2024-06-18 16:12:57'),
(4, 8, '2024-06-20', 1000, 'Cash', '2024-06-18 16:31:58'),
(5, 12, '0000-00-00', 1000, 'Cash', '2024-06-20 14:20:57'),
(6, 8, '2024-06-21', 5000, 'Cash', '2024-06-21 16:47:32'),
(7, 12, '0000-00-00', 1000, 'Online Payment', '2024-06-28 12:24:38'),
(8, 8, '2024-06-27', 1000, 'Cash', '2024-06-28 14:47:57'),
(9, 8, '2024-06-28', 1000, 'Cash', '2024-06-28 14:55:46'),
(10, 8, '2024-06-28', 1000, 'Cash', '2024-06-28 14:56:45'),
(11, 20, '2024-06-01', 5000, 'Cash', '2024-06-28 15:57:19'),
(12, 20, '2024-06-28', 5000, 'Cash', '2024-06-28 16:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl`
--

CREATE TABLE `payment_tbl` (
  `pay_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `amount_received` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `pay_status` enum('Paid','Unpaid','Partially Paid') NOT NULL DEFAULT 'Unpaid',
  `payment_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_tbl`
--

INSERT INTO `payment_tbl` (`pay_id`, `stu_id`, `charge`, `amount_received`, `payment_date`, `pay_status`, `payment_created_date`, `payment_updated_date`, `payment_status`) VALUES
(1, 1, 90000, 16000, '0000-00-00', 'Unpaid', '2024-06-10 12:13:30', '2024-06-18 10:50:10', 'Inactive'),
(2, 2, 30000, 0, '0000-00-00', 'Unpaid', '2024-06-15 14:18:09', '2024-06-18 10:50:14', 'Inactive'),
(3, 3, 90000, 0, '0000-00-00', 'Unpaid', '2024-06-18 12:40:58', '2024-06-18 10:51:07', 'Inactive'),
(4, 4, 90000, 0, '0000-00-00', 'Unpaid', '2024-06-18 12:44:43', '2024-06-18 10:51:13', 'Inactive'),
(5, 5, 45000, 0, '0000-00-00', 'Unpaid', '2024-06-18 12:55:11', '2024-06-18 10:51:17', 'Inactive'),
(6, 6, 30000, 0, '0000-00-00', 'Unpaid', '2024-06-18 13:01:58', '2024-06-18 10:51:21', 'Inactive'),
(7, 7, 45000, 0, '0000-00-00', 'Unpaid', '2024-06-18 13:02:37', '2024-06-18 10:51:03', 'Inactive'),
(8, 8, 45000, 9000, '0000-00-00', 'Partially Paid', '2024-06-18 14:57:20', '2024-06-28 09:26:45', 'Active'),
(9, 9, 30000, 0, '0000-00-00', 'Unpaid', '2024-06-18 15:09:02', '2024-06-18 09:39:56', 'Inactive'),
(10, 10, 30000, 0, '0000-00-00', 'Unpaid', '2024-06-18 15:09:44', '2024-06-18 09:39:50', 'Inactive'),
(11, 11, 20000, 1000, '0000-00-00', 'Unpaid', '2024-06-18 16:08:41', '2024-06-18 10:52:30', 'Inactive'),
(12, 12, 20000, 2000, '0000-00-00', 'Unpaid', '2024-06-20 14:20:17', '2024-06-28 06:54:38', 'Active'),
(13, 13, 15000, 0, '0000-00-00', 'Unpaid', '2024-06-26 10:41:42', '2024-06-26 05:11:42', 'Active'),
(14, 14, 15000, 0, '0000-00-00', 'Unpaid', '2024-06-26 10:41:44', '2024-06-26 05:12:46', 'Inactive'),
(15, 15, 15000, 0, '0000-00-00', 'Unpaid', '2024-06-26 10:41:44', '2024-06-26 05:12:43', 'Inactive'),
(16, 16, 15000, 0, '0000-00-00', 'Unpaid', '2024-06-26 10:41:46', '2024-06-26 05:19:31', 'Inactive'),
(17, 17, 15000, 0, '0000-00-00', 'Unpaid', '2024-06-26 10:41:48', '2024-06-26 05:19:24', 'Inactive'),
(18, 18, 30000, 0, '0000-00-00', 'Unpaid', '2024-06-26 10:50:49', '2024-06-26 05:20:49', 'Active'),
(19, 19, 30000, 0, '0000-00-00', 'Unpaid', '2024-06-26 11:02:09', '2024-06-26 05:32:09', 'Active'),
(20, 20, 25000, 10000, '0000-00-00', 'Partially Paid', '2024-06-28 14:32:38', '2024-06-28 10:30:17', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `stu_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `entity_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `course_month` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `stu_gender` enum('Male','Female','Other') NOT NULL,
  `stu_aadhar` varchar(50) NOT NULL,
  `stu_marksheet` varchar(50) NOT NULL,
  `stu_qrcode` varchar(50) NOT NULL,
  `stu_blood_group` varchar(10) NOT NULL,
  `stu_cast` varchar(20) NOT NULL,
  `stu_religion` varchar(20) NOT NULL,
  `stu_mother_tongue` varchar(50) NOT NULL,
  `stu_native` varchar(50) NOT NULL,
  `stu_image` varchar(50) NOT NULL,
  `registration_date` date NOT NULL,
  `stu_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `stu_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `stu_updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`stu_id`, `user_id`, `entity_id`, `course_id`, `course_month`, `first_name`, `last_name`, `stu_gender`, `stu_aadhar`, `stu_marksheet`, `stu_qrcode`, `stu_blood_group`, `stu_cast`, `stu_religion`, `stu_mother_tongue`, `stu_native`, `stu_image`, `registration_date`, `stu_status`, `stu_created_date`, `stu_updated_date`, `client_id`) VALUES
(1, 3, 3, 2, 12, 'Yesu', 'Balan', 'Male', '', '', '', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-10 12:13:30', '2024-06-25 07:27:34', 0),
(2, 4, 1, 1, 3, 'Gnana', 'Jebastin', 'Male', '', '', '', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-15 14:18:09', '2024-06-19 07:40:43', 0),
(3, 6, 3, 3, 12, 'Jebarlin', 'Dania', 'Female', 'JebarlinDania_aadhar.jpeg', 'JebarlinDania_marksheet.jpg', '', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-18 12:40:58', '2024-06-25 07:10:12', 0),
(4, 7, 3, 2, 12, 'Jebarathi', 'S', 'Female', '', '', 'JebarathiS_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-18 12:44:43', '2024-06-20 11:11:03', 0),
(5, 8, 3, 2, 6, 'KingJohn', 'Nicks', 'Male', '', '', 'KingJohnNicks_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-18 12:55:11', '2024-06-26 05:33:57', 0),
(6, 9, 1, 1, 3, 'Jebarlin', 'Dania', 'Female', '', '', '', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-18 13:01:58', '2024-06-20 11:11:07', 0),
(7, 10, 3, 2, 6, 'Uma', 'Saraswathi', 'Female', '', '', 'UmaSaraswathi_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Inactive', '2024-06-18 13:02:37', '2024-06-25 04:20:57', 0),
(8, 11, 3, 2, 6, 'KingJohn', 'N', 'Male', 'KingJohnN_aadhar.jpeg', 'KingJohnN_marksheet.webp', 'KingJohnN_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-18 14:57:20', '2024-06-18 09:29:34', 0),
(9, 15, 1, 1, 3, 'Asha1', 'T', 'Female', '', '', '', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-18 15:09:02', '2024-06-20 11:11:11', 0),
(10, 17, 1, 1, 3, 'Asha12', 'T', 'Female', '', '', '', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-18 15:09:44', '2024-06-20 11:11:15', 0),
(11, 18, 3, 3, 3, 'Bala', 'Ajinika', 'Female', '', '', 'BalaAjinika_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-18 16:08:41', '2024-06-27 11:07:16', 0),
(12, 20, 3, 2, 3, 'Dania', 'J', 'Female', '', '', 'DaniaJ_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-20 14:20:17', '2024-06-26 05:19:48', 0),
(13, 27, 3, 3, 3, 'Jebarlij', 'dania', 'Female', '', '', 'Jebarlijdania_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-26 10:41:42', '2024-06-26 05:11:43', 0),
(14, 28, 3, 3, 3, 'Jebarlij', 'dania', 'Female', '', '', 'Jebarlijdania_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Inactive', '2024-06-26 10:41:44', '2024-06-26 05:12:46', 0),
(15, 29, 3, 3, 3, 'Jebarlij', 'dania', 'Female', '', '', 'Jebarlijdania_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Inactive', '2024-06-26 10:41:44', '2024-06-26 05:12:43', 0),
(16, 30, 3, 3, 3, 'Jebarlij', 'dania', 'Female', '', '', 'Jebarlijdania_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Inactive', '2024-06-26 10:41:46', '2024-06-26 05:19:31', 0),
(17, 31, 3, 3, 3, 'Jebarlij', 'dania', 'Female', '', '', 'Jebarlijdania_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Inactive', '2024-06-26 10:41:48', '2024-06-26 05:19:24', 0),
(18, 32, 3, 1, 6, 'kavi', 's', 'Female', '', '', 'kavis_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-26 10:50:49', '2024-06-26 05:20:49', 0),
(19, 33, 1, 1, 6, 'Jons', 'J', 'Female', '', '', 'JonsJ_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-26 11:02:09', '2024-06-28 09:54:42', 0),
(20, 35, 3, 3, 6, 'Durga', 's', 'Female', 'Durgas139_aadhar.jpg', 'Durgas139_marksheet.jpg', 'Durgas_qrcode.png', '', '', '', '', '', '', '0000-00-00', 'Active', '2024-06-28 14:32:38', '2024-06-28 09:06:47', 0);

-- --------------------------------------------------------

--
-- Table structure for table `syllabus_tbl`
--

CREATE TABLE `syllabus_tbl` (
  `syllabus_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `syllabus_name` varchar(50) NOT NULL,
  `syllabus_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `syllabus_updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `syllabus_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `syllabus_tbl`
--

INSERT INTO `syllabus_tbl` (`syllabus_id`, `entity_id`, `course_id`, `syllabus_name`, `syllabus_created_date`, `syllabus_updated_date`, `syllabus_status`) VALUES
(1, 3, 2, 'HTML', '2024-06-17 11:45:56', '2024-06-17 06:15:56', 'Active'),
(2, 3, 2, 'CSS', '2024-06-17 11:46:06', '2024-06-17 06:16:06', 'Active'),
(3, 3, 3, 'JavaScript', '2024-06-17 11:46:30', '2024-06-28 06:47:31', 'Active'),
(4, 3, 2, 'demo', '2024-06-17 11:46:55', '2024-06-28 06:41:24', 'Inactive'),
(5, 3, 3, 'PHP', '2024-06-17 11:47:07', '2024-06-26 07:26:17', 'Active'),
(6, 3, 2, 'MySQL', '2024-06-17 11:47:21', '2024-06-17 06:17:21', 'Active'),
(8, 3, 3, 'JSON', '2024-06-28 11:04:35', '2024-06-28 06:54:10', 'Inactive'),
(9, 3, 3, 'HTML', '2024-06-28 12:23:52', '2024-06-28 06:54:05', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `task_detail`
--

CREATE TABLE `task_detail` (
  `task_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `task_detail` longtext NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_detail`
--

INSERT INTO `task_detail` (`task_id`, `student_id`, `task_detail`, `created_at`, `update_at`) VALUES
(1, 1, '{\"1\": {\"course_id\": \"2\", \"syllabus_id\": \"1\", \"taskName_id\": \"1\", \"start_date\": \"2024-06-02\", \"end_date\": \"2024-06-03\", \"status\": \"Complete\"}}', '2024-06-27', '2024-06-27 07:23:55'),
(2, 3, '{\"3\": {\"course_id\": \"2\", \"syllabus_id\": \"1\", \"taskName_id\": \"3\", \"start_date\": \"2024-06-06\", \"end_date\": \"2024-06-04\", \"status\": \"Completed\"}, \"9\": {\"course_id\": \"2\", \"syllabus_id\": \"5\", \"taskName_id\": \"9\", \"start_date\": \"2024-06-04\", \"end_date\": \"2024-06-03\", \"status\": \"Pending\"}}', '2024-06-27', '2024-06-27 07:25:21'),
(3, 4, '{\"1\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"1\",\"start_date\":\"2024-06-27\",\"end_date\":\"2024-06-28\",\"status\":\"Completed\"},\"3\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"3\",\"start_date\":\"2024-06-26\",\"end_date\":\"2024-06-27\",\"status\":\"Pending\"}}', '2024-06-27', '2024-06-27 07:28:54'),
(4, 5, '{\"1\": {\"course_id\": \"2\", \"syllabus_id\": \"1\", \"taskName_id\": \"1\", \"start_date\": \"2024-06-27\", \"end_date\": \"2024-06-28\", \"status\": \"Completed\"}, \"3\": {\"course_id\": \"2\", \"syllabus_id\": \"1\", \"taskName_id\": \"3\", \"start_date\": \"2024-06-27\", \"end_date\": \"2024-06-28\", \"status\": \"Pending\"}, \"4\": {\"course_id\": \"2\", \"syllabus_id\": \"1\", \"taskName_id\": \"4\", \"start_date\": \"2024-06-27\", \"end_date\": \"2024-06-28\", \"status\": \"Pending\"}}', '2024-06-27', '2024-06-27 08:48:09'),
(5, 11, '{\"8\":{\"course_id\":\"2\",\"syllabus_id\":\"3\",\"taskName_id\":\"8\",\"start_date\":\"2024-06-26\",\"end_date\":\"2024-06-27\",\"status\":\"Completed\"},\"1\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"1\",\"start_date\":\"2024-06-27\",\"end_date\":\"2024-06-28\",\"status\":\"Pending\"},\"3\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"3\",\"start_date\":\"2024-06-27\",\"end_date\":\"2024-06-28\",\"status\":\"Pending\"}}', '2024-06-27', '2024-06-27 10:44:28'),
(6, 18, '{\"1\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"1\",\"start_date\":\"2024-06-27\",\"end_date\":\"2024-06-27\",\"status\":\"Pending\"},\"4\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"4\",\"start_date\":\"2024-06-27\",\"end_date\":\"2024-06-27\",\"status\":\"Pending\"}}', '2024-06-27', '2024-06-27 11:08:38'),
(7, 12, '{\"1\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"1\",\"start_date\":\"2024-06-27\",\"end_date\":\"2024-06-27\",\"status\":\"Pending\"}}', '2024-06-27', '2024-06-27 11:10:32'),
(8, 13, '{\"1\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"1\",\"start_date\":\"2024-06-27\",\"end_date\":\"2024-06-28\",\"status\":\"Pending\"}}', '2024-06-27', '2024-06-27 11:14:33'),
(9, 1, '{\"1\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"1\",\"start_date\":\"2024-06-07\",\"end_date\":\"2024-06-03\",\"status\":\"Pending\"},\"11\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"11\",\"start_date\":\"2024-06-05\",\"end_date\":\"2024-06-14\",\"status\":\"Pending\"}}', '2024-06-28', '2024-06-28 06:30:27'),
(10, 0, '[]', '2024-06-28', '2024-06-28 06:42:39'),
(11, 4, '{\"4\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"4\",\"start_date\":\"2024-06-05\",\"end_date\":\"2024-06-07\",\"status\":\"Pending\"}}', '2024-06-28', '2024-06-28 06:43:40'),
(12, 11, '{\"3\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"3\",\"start_date\":\"2024-06-12\",\"end_date\":\"2024-06-03\",\"status\":\"Pending\"}}', '2024-06-28', '2024-06-28 06:53:15'),
(13, 3, '{\"1\": {\"course_id\": \"3\", \"syllabus_id\": \"1\", \"taskName_id\": \"1\", \"start_date\": \"2024-06-27\", \"end_date\": \"2024-06-27\", \"status\": \"Pending\"}, \"3\": {\"course_id\": \"3\", \"syllabus_id\": \"1\", \"taskName_id\": \"3\", \"start_date\": \"2024-06-27\", \"end_date\": \"2024-06-28\", \"status\": \"Completed\"}}', '2024-06-28', '2024-06-28 09:46:23'),
(14, 12, '{\"4\":{\"course_id\":\"2\",\"syllabus_id\":\"1\",\"taskName_id\":\"4\",\"start_date\":\"2024-06-19\",\"end_date\":\"2024-06-18\",\"status\":\"Pending\"}}', '2024-06-28', '2024-06-28 09:48:53'),
(15, 19, '{\"5\":{\"course_id\":\"1\",\"syllabus_id\":\"1\",\"taskName_id\":\"5\",\"start_date\":\"2024-06-26\",\"end_date\":\"2024-06-19\",\"status\":\"Pending\"}}', '2024-06-28', '2024-06-28 09:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `task_tbl`
--

CREATE TABLE `task_tbl` (
  `task_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `syllabus_id` int(11) NOT NULL,
  `task_name` longtext NOT NULL,
  `task_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `task_created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_tbl`
--

INSERT INTO `task_tbl` (`task_id`, `course_id`, `syllabus_id`, `task_name`, `task_status`, `task_created_date`) VALUES
(1, 2, 1, 'demo1', 'Active', '2024-06-25 11:28:22'),
(2, 2, 2, 'demo2', 'Active', '2024-06-25 11:28:32'),
(3, 2, 1, 'demo3', 'Active', '2024-06-25 11:28:43'),
(4, 2, 1, 'demo1', 'Active', '2024-06-25 14:42:33'),
(5, 2, 1, 'demo4', 'Active', '2024-06-25 15:26:36'),
(6, 3, 6, 'demo1', 'Active', '2024-06-26 11:09:45'),
(7, 3, 5, 'demo1', 'Active', '2024-06-26 15:40:14'),
(8, 2, 3, 'demo6', 'Active', '2024-06-26 15:40:46'),
(9, 3, 5, 'demo6', 'Active', '2024-06-27 13:05:22'),
(10, 3, 6, 'demo6', 'Active', '2024-06-28 15:19:32'),
(11, 2, 1, 'demo6', 'Active', '2024-06-28 15:53:42'),
(12, 2, 3, 'demo1', 'Active', '2024-06-28 16:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `topic_tbl`
--

CREATE TABLE `topic_tbl` (
  `topic_id` int(11) NOT NULL,
  `syllabus_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `topic_name` varchar(50) NOT NULL,
  `topic_duration` int(11) NOT NULL,
  `topic_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `topic_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `topic_updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topic_tbl`
--

INSERT INTO `topic_tbl` (`topic_id`, `syllabus_id`, `course_id`, `topic_name`, `topic_duration`, `topic_status`, `topic_created_date`, `topic_updated_date`) VALUES
(1, 1, 2, 'Heading 1', 2, 'Active', '2024-06-26 15:09:45', '2024-06-27 04:27:47'),
(2, 2, 2, 'Element', 1, 'Active', '2024-06-26 15:27:14', '2024-06-27 04:28:15'),
(3, 3, 2, 'object', 2, 'Active', '2024-06-28 15:52:38', '2024-06-28 10:22:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academy_detail_tbl`
--
ALTER TABLE `academy_detail_tbl`
  ADD PRIMARY KEY (`academy_id`);

--
-- Indexes for table `additional_details_tbl`
--
ALTER TABLE `additional_details_tbl`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_user_name` (`username`);

--
-- Indexes for table `assign_task_tbl`
--
ALTER TABLE `assign_task_tbl`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`atd_id`);

--
-- Indexes for table `client_tbl`
--
ALTER TABLE `client_tbl`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `course_tbl`
--
ALTER TABLE `course_tbl`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `emp_additional_tbl`
--
ALTER TABLE `emp_additional_tbl`
  ADD PRIMARY KEY (`add_tbl_id`);

--
-- Indexes for table `entity_tbl`
--
ALTER TABLE `entity_tbl`
  ADD PRIMARY KEY (`entity_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `payment_history_tbl`
--
ALTER TABLE `payment_history_tbl`
  ADD PRIMARY KEY (`pay_his_id`);

--
-- Indexes for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `syllabus_tbl`
--
ALTER TABLE `syllabus_tbl`
  ADD PRIMARY KEY (`syllabus_id`);

--
-- Indexes for table `task_detail`
--
ALTER TABLE `task_detail`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_tbl`
--
ALTER TABLE `task_tbl`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `topic_tbl`
--
ALTER TABLE `topic_tbl`
  ADD PRIMARY KEY (`topic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academy_detail_tbl`
--
ALTER TABLE `academy_detail_tbl`
  MODIFY `academy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `additional_details_tbl`
--
ALTER TABLE `additional_details_tbl`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `assign_task_tbl`
--
ALTER TABLE `assign_task_tbl`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  MODIFY `atd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_tbl`
--
ALTER TABLE `client_tbl`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `course_tbl`
--
ALTER TABLE `course_tbl`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_tbl`
--
ALTER TABLE `employee_tbl`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `emp_additional_tbl`
--
ALTER TABLE `emp_additional_tbl`
  MODIFY `add_tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `entity_tbl`
--
ALTER TABLE `entity_tbl`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment_history_tbl`
--
ALTER TABLE `payment_history_tbl`
  MODIFY `pay_his_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `syllabus_tbl`
--
ALTER TABLE `syllabus_tbl`
  MODIFY `syllabus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `task_detail`
--
ALTER TABLE `task_detail`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `task_tbl`
--
ALTER TABLE `task_tbl`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `topic_tbl`
--
ALTER TABLE `topic_tbl`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
