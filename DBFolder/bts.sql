-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2023 at 03:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bts`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `Lastname` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Firstname` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Middlename` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Suffix` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Birthdate` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Civilstatus` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contactnumber` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Sex` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ZipCode` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Citizenship` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` longblob DEFAULT NULL,
  `City` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EmailAddress` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Username` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Role` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DateOfEnrolled` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `Lastname`, `Firstname`, `Middlename`, `Suffix`, `Birthdate`, `Civilstatus`, `Contactnumber`, `Sex`, `Address`, `ZipCode`, `Citizenship`, `picture`, `City`, `EmailAddress`, `Password`, `Username`, `Role`, `DateOfEnrolled`) VALUES
(2, 'Test', 'Qwe', 'Qwe', '', '2005-07-03', 'Single', '09999991231', 'OTHERS', 'Qwe', '', '', 0x696d672f757365725f69636f6e2e706e67, 'Qwe', 'qwetestq@gmail.com', 'Admin123', 'Admin453', 'Admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_module_exam_pdf`
--

CREATE TABLE `admin_module_exam_pdf` (
  `idadmin_module_exam_pdf` int(11) NOT NULL,
  `pdf` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_module_exam_pdf`
--

INSERT INTO `admin_module_exam_pdf` (`idadmin_module_exam_pdf`, `pdf`) VALUES
(1, 0x2e2e2f2e2e2f75706c6f6164732f7064665f6d6f64756c65732f4d6f64756c652d73657373696f6e2d312e706466),
(2, 0x2e2e2f2e2e2f75706c6f6164732f7064665f6d6f64756c65732f73657373696f6e2d322e706466),
(3, 0x2e2e2f2e2e2f75706c6f6164732f7064665f6d6f64756c65732f4d6f64756c652d73657373696f6e2d332e706466),
(4, 0x2e2e2f2e2e2f75706c6f6164732f7064665f6d6f64756c65732f4254532d4578616d2d52657669657765722e706466);

-- --------------------------------------------------------

--
-- Table structure for table `admin_updatepostdesc`
--

CREATE TABLE `admin_updatepostdesc` (
  `idUpdatePostDesc` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Title` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_updatepostdesc`
--

INSERT INTO `admin_updatepostdesc` (`idUpdatePostDesc`, `Date`, `Title`, `Description`) VALUES
(9, '2023-09-13', 'tested123', 'tested12312321'),
(10, '2023-10-03', 'Topic ', 'Today is the daya sbdhasdbsajdsas');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrolled`
--

CREATE TABLE `course_enrolled` (
  `idCourse_Enrolled` int(11) NOT NULL,
  `Course` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Course_info` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Vechile(Type)` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Price` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DLcode` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_enrolled`
--

INSERT INTO `course_enrolled` (`idCourse_Enrolled`, `Course`, `Course_info`, `Vechile(Type)`, `Info`, `Price`, `DLcode`) VALUES
(1, 'PDC', 'Practical Driving Course Motorcycle', 'Manual', 'an eight hours of actual driving, it means you', '2500', 'A (L1, L2, L3)'),
(2, 'PDC', 'Practical Driving Course Car', 'Manual', 'an eight hours of actual driving, it means you\'re driving a manual transmission Car to get the driver\'s license code or restriction code.', '4000', 'B (M1)'),
(3, 'PDC', 'Practical Driving Course Motorcycle', 'Automatic', 'an eight hours of actual driving, it means you\'re driving a Automatic transmission motorcycle to get the driver\'s license code or restriction code.', '2500', 'A (L1, L2, L3)'),
(4, 'PDC', 'Practical Driving Course Car', 'Automatic', 'an eight hours of actual driving, it means you\'re driving a Automatic transmission Car to get the driver\'s license code or restriction code.', '4000', 'B (M1)'),
(5, 'TDC', 'Theoretical Driving Course (TDC)', NULL, 'Aspiring drivers are now required to attend 15-hour Theoretical Driving Course before applying for student permits.', '1000', ''),
(6, 'General Information', 'Theoretical Driving Course (TDC)', NULL, 'Aspiring drivers are now required to attend 15-hour Theoretical Driving Course before applying for student permits.', '1000  ', ''),
(7, 'General Information', 'Practical Driving Course (PDC) MOTORCYCLE', NULL, 'An eight hours of actual driving, it means you\'re driving a motorcycle to get the driver\'s license code or restriction code.', '2500', ''),
(8, 'General Information', 'Practical Driving Course (PDC) Light Vehicle', NULL, 'An eight hours of actual driving, it means you\'re driving a real light vehicle to get the driver\'s license code or restriction code.', '4000  ', '');

-- --------------------------------------------------------

--
-- Table structure for table `di`
--

CREATE TABLE `di` (
  `id_DI` int(11) NOT NULL,
  `Lastname` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Firstname` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Midllename` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Suffix` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `Civil_status` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Sex` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ContactNumber` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ZipCode` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Citizenship` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Educational_Attainment` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Educational_Attainment_yr` date DEFAULT NULL,
  `Educational_Attainment_school` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Educational_Attainment_degree` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DI_Training` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DI_Training_yrgraduate` date DEFAULT NULL,
  `DI_Training_yrTrainingCenter` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Exp_DI_From` date DEFAULT NULL,
  `Exp_DI_To` date DEFAULT NULL,
  `Di_posisyon` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Di_driving_school` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CurrentDL` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CurrentDL_Expiration` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DL` longblob DEFAULT NULL,
  `DI_profile_pic` longblob DEFAULT NULL,
  `Username` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Availability_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `di`
--

INSERT INTO `di` (`id_DI`, `Lastname`, `Firstname`, `Midllename`, `Suffix`, `Birthdate`, `Civil_status`, `Sex`, `ContactNumber`, `Address`, `City`, `ZipCode`, `Citizenship`, `Email`, `Educational_Attainment`, `Educational_Attainment_yr`, `Educational_Attainment_school`, `Educational_Attainment_degree`, `DI_Training`, `DI_Training_yrgraduate`, `DI_Training_yrTrainingCenter`, `Exp_DI_From`, `Exp_DI_To`, `Di_posisyon`, `Di_driving_school`, `CurrentDL`, `CurrentDL_Expiration`, `DL`, `DI_profile_pic`, `Username`, `Password`, `Availability_status`) VALUES
(5, 'Morgan', 'Arthur', 'Calluhan', 'Sr,', '2005-06-06', 'Single', 'MALE', '09999999999', 'Qwe', 'Eqwe', '1231', 'Qweqwe', 'Morgan.Arthut@gmail.com', 'Elementary', '2023-09-12', 'Qwe', 'Test', 'Motorcycle', '2023-09-17', 'Qwe', '2023-09-06', '2023-09-20', 'Wtf', 'Wtf', 'Qweqwe', 'Non_Pro', NULL, NULL, 'William@123', 'William@123', 'Active'),
(101, 'Perez', 'Jeff', 'Calluhan', 'Sr,', '2005-06-06', 'Single', 'MALE', '09999999999', 'Qwe', 'Eqwe', '1231', 'Qweqwe', NULL, 'Elementary', '2023-09-12', 'Qwe', 'Test', 'Motorcycle', '2023-09-17', 'Qwe', '2023-09-06', '2023-09-20', 'Wtf', 'Wtf', 'Qweqwe', 'Non_Pro', NULL, NULL, 'E2TMLSLRuSaS', 'William@123', 'Inactive'),
(104, 'Hernandez', 'Jophet', 'Benig', 'Hernandez', '2005-06-20', 'Single', 'MALE', '09381848511', 'Mandaluyong', 'Mandaluyong', '1533', 'Filipino', 'hernandezjophet@gmail.com', 'College', '2023-10-03', 'Jru', 'Bsit', 'Motorcyle_and_light_vehicle', '2023-10-03', 'Jru', '1970-01-01', '1970-01-01', '', '', 'Filipino', 'Professional', 0x2e2e2f2e2e2f75706c6f6164732f44695f75706c6f6164732f363531626539386364616364305f6173736573736d656e742e706466, 0x2e2e2f2e2e2f75706c6f6164732f44695f75706c6f6164732f44495f69636f6e2e706e67, 'DIPeter', 'Yi1ki2bi', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `di_assign_tbl`
--

CREATE TABLE `di_assign_tbl` (
  `Di_Assign` int(11) NOT NULL,
  `Di_Id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DI_Username` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Student_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Date` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `di_assign_tbl`
--

INSERT INTO `di_assign_tbl` (`Di_Assign`, `Di_Id`, `DI_Username`, `Student_id`, `Date`, `status`) VALUES
(1026, '2', 'William@123', '99', '2023-09-16', 'declined'),
(1027, '2', 'William@123', '99', '2023-09-16', 'declined'),
(1028, '2', 'William@123', '99', '2023-09-19', 'declined'),
(1031, '5', 'William@123', '99', '2023-09-20', 'declined'),
(1032, '5', 'William@123', '99', '2023-09-20', 'complete'),
(1036, '5', 'William@123', '99', '2023-09-21', 'declined'),
(1037, '5', 'William@123', '99', '2023-09-21', 'complete'),
(1038, '5', 'William@123', '99', '2023-09-21', 'complete'),
(1039, '5', 'William@123', '99', '2023-09-21', 'complete'),
(1040, '1', 'qwer123', '99', '2023-09-22', 'complete'),
(1041, '5', 'William@123', '99', '2023-09-22', 'declined'),
(1042, '101', 'E2TMLSLRuSaS', '99', '2023-09-23', 'declined'),
(1047, '5', 'William@123', '99', '2023-09-24', 'declined'),
(1049, '5', 'William@123', '99', '2023-09-24', 'declined'),
(1050, '5', 'William@123', '99', '2023-09-24', 'declined'),
(1051, '5', 'William@123', '99', '2023-09-24', 'declined'),
(1052, '5', 'William@123', '99', '2023-09-24', 'declined'),
(1053, '5', 'William@123', '99', '2023-09-25', 'declined'),
(1055, '5', 'William@123', '99', '2023-09-25', 'complete'),
(1056, '5', 'William@123', '99', '2023-09-25', 'complete'),
(1057, '5', 'William@123', '99', '2023-09-25', 'complete'),
(1058, '5', 'William@123', '99', '2023-09-25', 'declined'),
(1059, '5', 'William@123', '100', '2023-09-25', 'declined'),
(1060, '5', 'William@123', '99', '2023-09-25', 'declined'),
(1061, '5', 'William@123', '100', '2023-09-25', 'declined'),
(1062, '5', 'William@123', '102', '2023-09-30', 'declined'),
(1063, '5', 'William@123', '99', '2023-09-30', 'declined'),
(1064, '5', 'William@123', '99', '2023-09-30', 'declined'),
(1065, '5', 'William@123', '99', '2023-09-30', 'declined'),
(1066, '5', 'William@123', '101', '2023-09-30', 'complete'),
(1067, '5', 'William@123', '101', '2023-10-01', 'complete'),
(1068, '5', 'William@123', '101', '2023-10-01', 'complete'),
(1069, '5', 'William@123', '101', '2023-10-01', 'complete'),
(1070, '5', 'William@123', '101', '2023-10-01', 'declined'),
(1071, '102', 'DiTES2', '105', '2023-10-01', 'complete'),
(1072, '5', 'William@123', '105', '2023-10-01', 'complete'),
(1073, '101', 'E2TMLSLRuSaS', '105', '2023-10-01', 'complete'),
(1074, '103', 'William@12', '105', '2023-10-01', 'complete'),
(1075, '5', 'William@123', '105', '2023-10-01', 'complete'),
(1076, '5', 'William@123', '105', '2023-10-01', 'declined'),
(1077, '5', 'William@123', '105', '2023-10-02', 'declined'),
(1078, '5', 'William@123', '105', '2023-10-02', 'declined'),
(1079, '5', 'William@123', '105', '2023-10-03', 'declined'),
(1080, '104', 'DIPeter', '101', '2023-10-03', 'declined'),
(1081, '104', 'DIPeter', '99', '2023-10-03', 'complete'),
(1082, '104', 'DIPeter', '99', '2023-10-03', 'declined'),
(1083, '5', 'William@123', '101', '2023-10-04', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `di_report_tbl`
--

CREATE TABLE `di_report_tbl` (
  `report_id` int(11) NOT NULL,
  `DI_id` int(11) NOT NULL,
  `Vehicle` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `session` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Start_Odometer` int(11) NOT NULL,
  `End_Odometer` int(11) NOT NULL,
  `DateofAssessment` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `di_report_tbl`
--

INSERT INTO `di_report_tbl` (`report_id`, `DI_id`, `Vehicle`, `student_id`, `session`, `Start_Odometer`, `End_Odometer`, `DateofAssessment`) VALUES
(4, 5, 'Rusi:Classic 250', 99, '1', 100000, 100020, '2023-09-25'),
(5, 5, 'Toyota:Camry', 99, '2', 10020, 10030, '2023-09-26'),
(6, 5, 'Honda:Click 155', 101, '1', 1000, 1500, '2023-09-30'),
(7, 5, 'Yamaha:Nmax', 101, '2', 1000, 2000, '2023-10-01'),
(8, 5, 'Honda:Accord', 101, '1', 2000, 2500, '2023-10-01'),
(9, 5, 'Honda:Accord', 101, '2', 2500, 3000, '2023-10-02'),
(14, 104, 'Honda:Civic', 99, '1', 30000, 300500, '2023-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `evalques_tb`
--

CREATE TABLE `evalques_tb` (
  `eval_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evalques_tb`
--

INSERT INTO `evalques_tb` (`eval_id`, `question`) VALUES
(1, 'Student Name:'),
(2, 'Do you already have a Drivers license?'),
(3, 'Date enrolled:'),
(4, '1. Overall, how would you rate your experience with BTS Driving School?'),
(5, '2. How would you rate the quality of the driving instructors at BTS Driving School?'),
(6, '3. Did the curriculum at BTS Driving School effectively prepare you for the LTO licensure exams?'),
(7, '4. Please provide any additional comments or suggestions for improvement:');

-- --------------------------------------------------------

--
-- Table structure for table `evalres_tb`
--

CREATE TABLE `evalres_tb` (
  `res_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `license_num` varchar(255) NOT NULL,
  `date_enrolled` date NOT NULL,
  `Q1` varchar(255) NOT NULL,
  `Q2` varchar(255) NOT NULL,
  `Q3` varchar(255) NOT NULL,
  `Q4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evalres_tb`
--

INSERT INTO `evalres_tb` (`res_id`, `student_name`, `license_num`, `date_enrolled`, `Q1`, `Q2`, `Q3`, `Q4`) VALUES
(1, 'Jophet', '12345678', '2023-10-01', 'Excellent', 'Average', 'Yes', 'good');

-- --------------------------------------------------------

--
-- Table structure for table `feedques_tb`
--

CREATE TABLE `feedques_tb` (
  `qID` int(11) NOT NULL,
  `Question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedques_tb`
--

INSERT INTO `feedques_tb` (`qID`, `Question`) VALUES
(1, 'Teacher / Instructor name'),
(2, 'Why did you chose this course?'),
(3, 'Level of knowledge on start of course'),
(4, 'Level of effort invested in course'),
(5, 'Level of knowledge at the end of the course'),
(6, 'Level of communication'),
(7, 'Would you recommend this course to other students?');

-- --------------------------------------------------------

--
-- Table structure for table `feedres_tb`
--

CREATE TABLE `feedres_tb` (
  `Response_ID` int(11) NOT NULL,
  `Student_id` int(11) NOT NULL,
  `Student_name` varchar(100) NOT NULL,
  `DI_Name` varchar(100) NOT NULL,
  `Q1` varchar(255) NOT NULL,
  `Q2` varchar(255) NOT NULL,
  `Q3` varchar(255) NOT NULL,
  `Q4` varchar(255) NOT NULL,
  `Q5` varchar(255) NOT NULL,
  `Q6` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedres_tb`
--

INSERT INTO `feedres_tb` (`Response_ID`, `Student_id`, `Student_name`, `DI_Name`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`) VALUES
(1, 99, 'PerezGlen William', 'Morgan, Arthur', 'Degree requirement', 'Very good', 'Good', 'Very good', 'Good', 'Yes'),
(2, 102, 'JonsonBustine', 'Morgan, Arthur', 'Degree requirement', 'Very good', 'Very good', 'Very good', 'Very good', 'Yes'),
(3, 105, 'HernandezPeter', 'Morgan, Name sample', 'Degree requirement', 'Good', 'Good', 'Very good', 'Very good', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `info_tb`
--

CREATE TABLE `info_tb` (
  `info_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info_tb`
--

INSERT INTO `info_tb` (`info_id`, `title`, `description`) VALUES
(1, 'What is a Theoretical Driving Course (TDC)?', 'The Theoretical Driving Course (TDC) is a structured educational program designed to provide aspiring drivers with the necessary theoretical knowledge and understanding of road rules, traffic regulations, and safe driving practices.'),
(2, 'What happens if I fail the TDC exam?', 'If you fail the TDC exam, you may be allowed to retake it after a certain waiting period.'),
(3, 'Is the PDC exam-based?', 'Yes, the Practical Driving Course concludes with a driving test where you are evaluated on your ability to demonstrate safe driving practices and apply the knowledge gained from the TDC.'),
(4, 'What topics are covered in the TDC?', 'The TDC covers a range of topics, including road signs, traffic signals, right of way, speed limits, safe following distances, parking regulations, and basic vehicle maintenance.'),
(7, 'ABOUT BTS DRIVING SCHOOL', 'When it comes to choosing the best driving school in Metro Manila, there is one name that stands out: The Best Training School (BTS) Driving School. As an accredited institution since 2021, BTS Driving School has proven its commitment to providing top-notch driver education. With a focus on equipping new drivers with the knowledge and skills necessary to be safe and responsible on the road, BTS Driving School has built a reputation for excellence. By choosing BTS Driving School, aspiring drivers can be confident that they are receiving instruction from experienced professionals who understand the intricacies of driving in Metro Manila. Whether it\'s learning the rules of the road, mastering essential techniques, or understanding defensive driving strategies, BTS Driving School goes above and beyond to ensure that every student receives the highest quality education. For those seeking a driving school that prioritizes safety, expertise, and comprehensive driver training, BTS Driving School is the clear choice. Trust your journey to the best driving school in Metro Manila and pave the way for a lifetime of confident and responsible driving.');

-- --------------------------------------------------------

--
-- Table structure for table `newupdate`
--

CREATE TABLE `newupdate` (
  `idNewUpdate` int(11) NOT NULL,
  `PICTURE` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newupdate`
--

INSERT INTO `newupdate` (`idNewUpdate`, `PICTURE`) VALUES
(1, 0x2e2e2f696d672f64726976652d646f776e6c6f61642d3230323330363134543132353333305a2d3030312f6973746f636b70686f746f2d313136323830313631382d363132783631322e6a7067),
(2, 0x2e2e2f696d672f64726976652d646f776e6c6f61642d3230323330363134543132353333305a2d3030312f6d6f64616c5f696d672e6a706567),
(3, 0x2e2e2f696d672f64726976652d646f776e6c6f61642d3230323330363134543132353333305a2d3030312f57454c434f4d4520504147452e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `olpayment_tb`
--

CREATE TABLE `olpayment_tb` (
  `ol_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `Gcash_num` varchar(45) NOT NULL,
  `Receipt_pic` longblob NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `olpayment_tb`
--

INSERT INTO `olpayment_tb` (`ol_id`, `student_id`, `student_name`, `Gcash_num`, `Receipt_pic`, `date`) VALUES
(1, 99, 'Guillero Mark', '991231242', 0x2e2f75706c6f6164732f696d67735f67636173685f73747564656e742f42504951525f4d61726b2e706e67, '2023-09-22'),
(2, 99, 'Guillero Mark', '0991231242', 0x2e2f75706c6f6164732f696d67735f67636173685f73747564656e742f4250496d616d612e706e67, '2023-09-22'),
(3, 99, 'Guillero Mark', '0991231242', 0x2e2f75706c6f6164732f696d67735f67636173685f73747564656e742f42504951525f4d61726b2e706e67, '2023-09-22'),
(4, 102, 'Jonson Bustine', '09994576241', 0x2e2f75706c6f6164732f696d67735f67636173685f73747564656e742f42504951525f4d61726b2e706e67, '2023-09-26'),
(5, 105, 'Hernandez Peter', '09122222222', 0x2e2f75706c6f6164732f696d67735f67636173685f73747564656e742f3337393533303439315f313534303731363239333030323835355f353930383436333837343334363936373836355f6e2e6a7067, '2023-10-01'),
(6, 106, 'Hernandez Jophet', '09381848511', 0x2e2f75706c6f6164732f696d67735f67636173685f73747564656e742f3337393533303439315f313534303731363239333030323835355f353930383436333837343334363936373836355f6e2e6a7067, '2023-10-03'),
(7, 107, 'Hernandez Jophet', '09381848511', 0x2e2f75706c6f6164732f696d67735f67636173685f73747564656e742f3337393533303439315f313534303731363239333030323835355f353930383436333837343334363936373836355f6e2e6a7067, '2023-10-03'),
(8, 108, 'Hernandez Peter', '09122222222', 0x2e2f75706c6f6164732f696d67735f67636173685f73747564656e742f3337393533303439315f313534303731363239333030323835355f353930383436333837343334363936373836355f6e2e6a7067, '2023-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `pdc_assessment`
--

CREATE TABLE `pdc_assessment` (
  `assess_id` int(11) NOT NULL,
  `DI_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `Course` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Q_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `Assessment_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pdc_assessment`
--

INSERT INTO `pdc_assessment` (`assess_id`, `DI_id`, `std_id`, `session`, `Course`, `Q_title`, `rate`, `Assessment_Date`) VALUES
(1, 5, 99, 1, 'Motorcycle_Manual', 'Pre-Drive_Inspection', 1, '2023-09-19'),
(2, 5, 99, 1, 'Motorcycle_Manual', 'Adjustment_of_Controls', 1, '2023-09-19'),
(3, 5, 99, 1, 'Motorcycle_Manual', 'Starting_the_Vehicle', 1, '2023-09-19'),
(4, 5, 99, 1, 'Motorcycle_Manual', 'Parking_Brake_Usage', 1, '2023-09-19'),
(5, 5, 99, 1, 'Motorcycle_Manual', 'Steering_Control', 1, '2023-09-19'),
(6, 5, 99, 1, 'Motorcycle_Manual', 'Use_of_Signals', 1, '2023-09-19'),
(7, 5, 99, 1, 'Motorcycle_Manual', 'Lane_Positioning', 1, '2023-09-19'),
(8, 5, 99, 1, 'Motorcycle_Manual', 'Speed_Control', 1, '2023-09-19'),
(9, 5, 99, 1, 'Motorcycle_Manual', 'Observation_and_Awareness', 1, '2023-09-19'),
(10, 5, 99, 1, 'Motorcycle_Manual', 'Stopping_and_Starting_Smoothly', 1, '2023-09-19'),
(13, 5, 99, 2, 'Motorcycle_Manual', 'Intersection_Handling:', 1, '2023-09-19'),
(14, 5, 99, 2, 'Motorcycle_Manual', 'Turning_and_Lane_Changes:', 1, '2023-09-19'),
(15, 5, 99, 2, 'Motorcycle_Manual', 'Parking_Skills:', 1, '2023-09-19'),
(16, 5, 99, 2, 'Motorcycle_Manual', 'Use_of_Defensive_Driving_Techniques:', 1, '2023-09-19'),
(17, 5, 99, 2, 'Motorcycle_Manual', 'Traffic_Rules_Compliance:', 1, '2023-09-19'),
(18, 5, 99, 2, 'Motorcycle_Manual', 'Emergency_Procedures:', 1, '2023-09-19'),
(21, 5, 99, 2, 'Motorcycle_Manual', 'Intersection_Handling:', 1, '2023-09-19'),
(22, 5, 99, 2, 'Motorcycle_Manual', 'Turning_and_Lane_Changes:', 5, '2023-09-19'),
(23, 5, 99, 2, 'Motorcycle_Manual', 'Parking_Skills:', 5, '2023-09-19'),
(24, 5, 99, 2, 'Motorcycle_Manual', 'Use_of_Defensive_Driving_Techniques:', 5, '2023-09-19'),
(25, 5, 99, 2, 'Motorcycle_Manual', 'Traffic_Rules_Compliance:', 5, '2023-09-19'),
(26, 5, 99, 2, 'Motorcycle_Manual', 'Emergency_Procedures:', 5, '2023-09-19'),
(29, 5, 99, 1, 'Motorcycle_Manual', 'Pre-Drive_Inspection', 5, '2023-09-20'),
(30, 5, 99, 1, 'Motorcycle_Manual', 'Adjustment_of_Controls', 5, '2023-09-20'),
(31, 5, 99, 1, 'Motorcycle_Manual', 'Starting_the_Vehicle', 5, '2023-09-20'),
(32, 5, 99, 1, 'Motorcycle_Manual', 'Parking_Brake_Usage', 5, '2023-09-20'),
(33, 5, 99, 1, 'Motorcycle_Manual', 'Steering_Control', 5, '2023-09-20'),
(34, 5, 99, 1, 'Motorcycle_Manual', 'Use_of_Signals', 5, '2023-09-20'),
(35, 5, 99, 1, 'Motorcycle_Manual', 'Lane_Positioning', 5, '2023-09-20'),
(36, 5, 99, 1, 'Motorcycle_Manual', 'Speed_Control', 5, '2023-09-20'),
(37, 5, 99, 1, 'Motorcycle_Manual', 'Observation_and_Awareness', 5, '2023-09-20'),
(38, 5, 99, 1, 'Motorcycle_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-09-20'),
(41, 5, 99, 1, 'Motorcycle_Manual', 'Pre-Drive_Inspection', 4, '2023-09-20'),
(42, 5, 99, 1, 'Motorcycle_Manual', 'Adjustment_of_Controls', 5, '2023-09-20'),
(43, 5, 99, 1, 'Motorcycle_Manual', 'Starting_the_Vehicle', 5, '2023-09-20'),
(44, 5, 99, 1, 'Motorcycle_Manual', 'Parking_Brake_Usage', 3, '2023-09-20'),
(45, 5, 99, 1, 'Motorcycle_Manual', 'Steering_Control', 2, '2023-09-20'),
(46, 5, 99, 1, 'Motorcycle_Manual', 'Use_of_Signals', 5, '2023-09-20'),
(47, 5, 99, 1, 'Motorcycle_Manual', 'Lane_Positioning', 5, '2023-09-20'),
(48, 5, 99, 1, 'Motorcycle_Manual', 'Speed_Control', 5, '2023-09-20'),
(49, 5, 99, 1, 'Motorcycle_Manual', 'Observation_and_Awareness', 5, '2023-09-20'),
(50, 5, 99, 1, 'Motorcycle_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-09-20'),
(53, 5, 99, 1, 'Motorcycle_Manual', 'Pre-Drive_Inspection', 1, '2023-09-20'),
(54, 5, 99, 1, 'Motorcycle_Manual', 'Adjustment_of_Controls', 1, '2023-09-20'),
(55, 5, 99, 1, 'Motorcycle_Manual', 'Starting_the_Vehicle', 1, '2023-09-20'),
(56, 5, 99, 1, 'Motorcycle_Manual', 'Parking_Brake_Usage', 3, '2023-09-20'),
(57, 5, 99, 1, 'Motorcycle_Manual', 'Steering_Control', 2, '2023-09-20'),
(58, 5, 99, 1, 'Motorcycle_Manual', 'Use_of_Signals', 5, '2023-09-20'),
(59, 5, 99, 1, 'Motorcycle_Manual', 'Lane_Positioning', 5, '2023-09-20'),
(60, 5, 99, 1, 'Motorcycle_Manual', 'Speed_Control', 5, '2023-09-20'),
(61, 5, 99, 1, 'Motorcycle_Manual', 'Observation_and_Awareness', 1, '2023-09-20'),
(62, 5, 99, 1, 'Motorcycle_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-09-20'),
(65, 5, 99, 1, 'Motorcycle_Manual', 'Pre-Drive_Inspection', 1, '2023-09-20'),
(66, 5, 99, 1, 'Motorcycle_Manual', 'Adjustment_of_Controls', 1, '2023-09-20'),
(67, 5, 99, 1, 'Motorcycle_Manual', 'Starting_the_Vehicle', 1, '2023-09-20'),
(68, 5, 99, 1, 'Motorcycle_Manual', 'Parking_Brake_Usage', 3, '2023-09-20'),
(69, 5, 99, 1, 'Motorcycle_Manual', 'Steering_Control', 2, '2023-09-20'),
(70, 5, 99, 1, 'Motorcycle_Manual', 'Use_of_Signals', 5, '2023-09-20'),
(71, 5, 99, 1, 'Motorcycle_Manual', 'Lane_Positioning', 5, '2023-09-20'),
(72, 5, 99, 1, 'Motorcycle_Manual', 'Speed_Control', 5, '2023-09-20'),
(73, 5, 99, 1, 'Motorcycle_Manual', 'Observation_and_Awareness', 1, '2023-09-20'),
(74, 5, 99, 1, 'Motorcycle_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-09-20'),
(77, 5, 99, 1, 'Motorcycle_Manual', 'Pre-Drive_Inspection', 5, '2023-09-20'),
(78, 5, 99, 1, 'Motorcycle_Manual', 'Adjustment_of_Controls', 5, '2023-09-20'),
(79, 5, 99, 1, 'Motorcycle_Manual', 'Starting_the_Vehicle', 5, '2023-09-20'),
(80, 5, 99, 1, 'Motorcycle_Manual', 'Parking_Brake_Usage', 5, '2023-09-20'),
(81, 5, 99, 1, 'Motorcycle_Manual', 'Steering_Control', 5, '2023-09-20'),
(82, 5, 99, 1, 'Motorcycle_Manual', 'Use_of_Signals', 5, '2023-09-20'),
(83, 5, 99, 1, 'Motorcycle_Manual', 'Lane_Positioning', 5, '2023-09-20'),
(84, 5, 99, 1, 'Motorcycle_Manual', 'Speed_Control', 5, '2023-09-20'),
(85, 5, 99, 1, 'Motorcycle_Manual', 'Observation_and_Awareness', 5, '2023-09-20'),
(86, 5, 99, 1, 'Motorcycle_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-09-20'),
(89, 5, 99, 2, 'Motorcycle_Manual', 'Intersection_Handling:', 3, '2023-09-20'),
(90, 5, 99, 2, 'Motorcycle_Manual', 'Turning_and_Lane_Changes:', 5, '2023-09-20'),
(91, 5, 99, 2, 'Motorcycle_Manual', 'Parking_Skills:', 3, '2023-09-20'),
(92, 5, 99, 2, 'Motorcycle_Manual', 'Use_of_Defensive_Driving_Techniques:', 3, '2023-09-20'),
(93, 5, 99, 2, 'Motorcycle_Manual', 'Traffic_Rules_Compliance:', 3, '2023-09-20'),
(94, 5, 99, 2, 'Motorcycle_Manual', 'Emergency_Procedures:', 5, '2023-09-20'),
(97, 5, 99, 1, 'Motorcycle_Manual', 'Pre-Drive_Inspection', 5, '2023-09-20'),
(98, 5, 99, 1, 'Motorcycle_Manual', 'Adjustment_of_Controls', 5, '2023-09-20'),
(99, 5, 99, 1, 'Motorcycle_Manual', 'Starting_the_Vehicle', 5, '2023-09-20'),
(100, 5, 99, 1, 'Motorcycle_Manual', 'Parking_Brake_Usage', 5, '2023-09-20'),
(101, 5, 99, 1, 'Motorcycle_Manual', 'Steering_Control', 5, '2023-09-20'),
(102, 5, 99, 1, 'Motorcycle_Manual', 'Use_of_Signals', 5, '2023-09-20'),
(103, 5, 99, 1, 'Motorcycle_Manual', 'Lane_Positioning', 5, '2023-09-20'),
(104, 5, 99, 1, 'Motorcycle_Manual', 'Speed_Control', 5, '2023-09-20'),
(105, 5, 99, 1, 'Motorcycle_Manual', 'Observation_and_Awareness', 1, '2023-09-20'),
(106, 5, 99, 1, 'Motorcycle_Manual', 'Stopping_and_Starting_Smoothly', 1, '2023-09-20'),
(109, 5, 99, 2, 'Motorcycle_Manual', 'Intersection_Handling:', 2, '2023-09-20'),
(110, 5, 99, 2, 'Motorcycle_Manual', 'Turning_and_Lane_Changes:', 1, '2023-09-20'),
(111, 5, 99, 2, 'Motorcycle_Manual', 'Parking_Skills:', 1, '2023-09-20'),
(112, 5, 99, 2, 'Motorcycle_Manual', 'Use_of_Defensive_Driving_Techniques:', 3, '2023-09-20'),
(113, 5, 99, 2, 'Motorcycle_Manual', 'Traffic_Rules_Compliance:', 4, '2023-09-20'),
(114, 5, 99, 2, 'Motorcycle_Manual', 'Emergency_Procedures:', 3, '2023-09-20'),
(117, 5, 99, 2, 'Motorcycle_Manual', 'Intersection_Handling:', 2, '2023-09-20'),
(118, 5, 99, 2, 'Motorcycle_Manual', 'Turning_and_Lane_Changes:', 1, '2023-09-20'),
(119, 5, 99, 2, 'Motorcycle_Manual', 'Parking_Skills:', 1, '2023-09-20'),
(120, 5, 99, 2, 'Motorcycle_Manual', 'Use_of_Defensive_Driving_Techniques:', 3, '2023-09-20'),
(121, 5, 99, 2, 'Motorcycle_Manual', 'Traffic_Rules_Compliance:', 4, '2023-09-20'),
(122, 5, 99, 2, 'Motorcycle_Manual', 'Emergency_Procedures:', 3, '2023-09-20'),
(125, 5, 99, 2, 'Motorcycle_Manual', 'Intersection_Handling:', 2, '2023-09-21'),
(126, 5, 99, 2, 'Motorcycle_Manual', 'Turning_and_Lane_Changes:', 2, '2023-09-21'),
(127, 5, 99, 2, 'Motorcycle_Manual', 'Parking_Skills:', 2, '2023-09-21'),
(128, 5, 99, 2, 'Motorcycle_Manual', 'Use_of_Defensive_Driving_Techniques:', 2, '2023-09-21'),
(129, 5, 99, 2, 'Motorcycle_Manual', 'Traffic_Rules_Compliance:', 1, '2023-09-21'),
(130, 5, 99, 2, 'Motorcycle_Manual', 'Emergency_Procedures:', 2, '2023-09-21'),
(133, 5, 99, 1, 'Car_Manual', 'Pre-Drive_Inspection', 1, '2023-09-21'),
(134, 5, 99, 1, 'Car_Manual', 'Adjustment_of_Controls', 1, '2023-09-21'),
(135, 5, 99, 1, 'Car_Manual', 'Starting_the_Vehicle', 1, '2023-09-21'),
(136, 5, 99, 1, 'Car_Manual', 'Parking_Brake_Usage', 1, '2023-09-21'),
(137, 5, 99, 1, 'Car_Manual', 'Steering_Control', 1, '2023-09-21'),
(138, 5, 99, 1, 'Car_Manual', 'Use_of_Signals', 1, '2023-09-21'),
(139, 5, 99, 1, 'Car_Manual', 'Lane_Positioning', 1, '2023-09-21'),
(140, 5, 99, 1, 'Car_Manual', 'Speed_Control', 1, '2023-09-21'),
(141, 5, 99, 1, 'Car_Manual', 'Observation_and_Awareness', 1, '2023-09-21'),
(142, 5, 99, 1, 'Car_Manual', 'Stopping_and_Starting_Smoothly', 1, '2023-09-21'),
(145, 5, 99, 2, 'Motorcycle_Manual', 'Intersection_Handling:', 1, '2023-09-22'),
(146, 5, 99, 2, 'Motorcycle_Manual', 'Turning_and_Lane_Changes:', 5, '2023-09-22'),
(147, 5, 99, 2, 'Motorcycle_Manual', 'Parking_Skills:', 4, '2023-09-22'),
(148, 5, 99, 2, 'Motorcycle_Manual', 'Use_of_Defensive_Driving_Techniques:', 4, '2023-09-22'),
(149, 5, 99, 2, 'Motorcycle_Manual', 'Traffic_Rules_Compliance:', 4, '2023-09-22'),
(150, 5, 99, 2, 'Motorcycle_Manual', 'Emergency_Procedures:', 5, '2023-09-22'),
(153, 1, 99, 1, 'Car_Manual', 'Pre-Drive_Inspection', 5, '2023-09-22'),
(154, 1, 99, 1, 'Car_Manual', 'Adjustment_of_Controls', 4, '2023-09-22'),
(155, 1, 99, 1, 'Car_Manual', 'Starting_the_Vehicle', 3, '2023-09-22'),
(156, 1, 99, 1, 'Car_Manual', 'Parking_Brake_Usage', 4, '2023-09-22'),
(157, 1, 99, 1, 'Car_Manual', 'Steering_Control', 3, '2023-09-22'),
(158, 1, 99, 1, 'Car_Manual', 'Use_of_Signals', 4, '2023-09-22'),
(159, 1, 99, 1, 'Car_Manual', 'Lane_Positioning', 3, '2023-09-22'),
(160, 1, 99, 1, 'Car_Manual', 'Speed_Control', 4, '2023-09-22'),
(161, 1, 99, 1, 'Car_Manual', 'Observation_and_Awareness', 4, '2023-09-22'),
(162, 1, 99, 1, 'Car_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-09-22'),
(165, 5, 99, 1, 'Motorcycle_Manual', 'Pre-Drive_Inspection', 5, '2023-09-25'),
(166, 5, 99, 1, 'Motorcycle_Manual', 'Adjustment_of_Controls', 5, '2023-09-25'),
(167, 5, 99, 1, 'Motorcycle_Manual', 'Starting_the_Vehicle', 5, '2023-09-25'),
(168, 5, 99, 1, 'Motorcycle_Manual', 'Parking_Brake_Usage', 5, '2023-09-25'),
(169, 5, 99, 1, 'Motorcycle_Manual', 'Steering_Control', 5, '2023-09-25'),
(170, 5, 99, 1, 'Motorcycle_Manual', 'Use_of_Signals', 5, '2023-09-25'),
(171, 5, 99, 1, 'Motorcycle_Manual', 'Lane_Positioning', 5, '2023-09-25'),
(172, 5, 99, 1, 'Motorcycle_Manual', 'Speed_Control', 5, '2023-09-25'),
(173, 5, 99, 1, 'Motorcycle_Manual', 'Observation_and_Awareness', 5, '2023-09-25'),
(174, 5, 99, 1, 'Motorcycle_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-09-25'),
(177, 5, 99, 2, 'Motorcycle_Manual', 'Intersection_Handling:', 4, '2023-09-25'),
(178, 5, 99, 2, 'Motorcycle_Manual', 'Turning_and_Lane_Changes:', 5, '2023-09-25'),
(179, 5, 99, 2, 'Motorcycle_Manual', 'Parking_Skills:', 5, '2023-09-25'),
(180, 5, 99, 2, 'Motorcycle_Manual', 'Use_of_Defensive_Driving_Techniques:', 5, '2023-09-25'),
(181, 5, 99, 2, 'Motorcycle_Manual', 'Traffic_Rules_Compliance:', 5, '2023-09-25'),
(182, 5, 99, 2, 'Motorcycle_Manual', 'Emergency_Procedures:', 5, '2023-09-25'),
(185, 5, 99, 1, 'Car_Manual', 'Pre-Drive_Inspection', 5, '2023-09-25'),
(186, 5, 99, 1, 'Car_Manual', 'Adjustment_of_Controls', 2, '2023-09-25'),
(187, 5, 99, 1, 'Car_Manual', 'Starting_the_Vehicle', 1, '2023-09-25'),
(188, 5, 99, 1, 'Car_Manual', 'Parking_Brake_Usage', 1, '2023-09-25'),
(189, 5, 99, 1, 'Car_Manual', 'Steering_Control', 1, '2023-09-25'),
(190, 5, 99, 1, 'Car_Manual', 'Use_of_Signals', 5, '2023-09-25'),
(191, 5, 99, 1, 'Car_Manual', 'Lane_Positioning', 1, '2023-09-25'),
(192, 5, 99, 1, 'Car_Manual', 'Speed_Control', 1, '2023-09-25'),
(193, 5, 99, 1, 'Car_Manual', 'Observation_and_Awareness', 3, '2023-09-25'),
(194, 5, 99, 1, 'Car_Manual', 'Stopping_and_Starting_Smoothly', 2, '2023-09-25'),
(197, 5, 101, 1, 'Motorcycle_Automatic', 'Pre-Drive_Inspection', 5, '2023-09-30'),
(198, 5, 101, 1, 'Motorcycle_Automatic', 'Adjustment_of_Controls', 5, '2023-09-30'),
(199, 5, 101, 1, 'Motorcycle_Automatic', 'Starting_the_Vehicle', 5, '2023-09-30'),
(200, 5, 101, 1, 'Motorcycle_Automatic', 'Parking_Brake_Usage', 1, '2023-09-30'),
(201, 5, 101, 1, 'Motorcycle_Automatic', 'Steering_Control', 5, '2023-09-30'),
(202, 5, 101, 1, 'Motorcycle_Automatic', 'Use_of_Signals', 5, '2023-09-30'),
(203, 5, 101, 1, 'Motorcycle_Automatic', 'Lane_Positioning', 1, '2023-09-30'),
(204, 5, 101, 1, 'Motorcycle_Automatic', 'Speed_Control', 5, '2023-09-30'),
(205, 5, 101, 1, 'Motorcycle_Automatic', 'Observation_and_Awareness', 1, '2023-09-30'),
(206, 5, 101, 1, 'Motorcycle_Automatic', 'Stopping_and_Starting_Smoothly', 5, '2023-09-30'),
(209, 5, 101, 2, 'Motorcycle_Automatic', 'Intersection_Handling:', 5, '2023-10-01'),
(210, 5, 101, 2, 'Motorcycle_Automatic', 'Turning_and_Lane_Changes:', 5, '2023-10-01'),
(211, 5, 101, 2, 'Motorcycle_Automatic', 'Parking_Skills:', 5, '2023-10-01'),
(212, 5, 101, 2, 'Motorcycle_Automatic', 'Use_of_Defensive_Driving_Techniques:', 5, '2023-10-01'),
(213, 5, 101, 2, 'Motorcycle_Automatic', 'Traffic_Rules_Compliance:', 5, '2023-10-01'),
(214, 5, 101, 2, 'Motorcycle_Automatic', 'Emergency_Procedures:', 5, '2023-10-01'),
(217, 5, 101, 1, 'Car_Manual', 'Pre-Drive_Inspection', 5, '2023-10-01'),
(218, 5, 101, 1, 'Car_Manual', 'Adjustment_of_Controls', 5, '2023-10-01'),
(219, 5, 101, 1, 'Car_Manual', 'Starting_the_Vehicle', 5, '2023-10-01'),
(220, 5, 101, 1, 'Car_Manual', 'Parking_Brake_Usage', 5, '2023-10-01'),
(221, 5, 101, 1, 'Car_Manual', 'Steering_Control', 5, '2023-10-01'),
(222, 5, 101, 1, 'Car_Manual', 'Use_of_Signals', 5, '2023-10-01'),
(223, 5, 101, 1, 'Car_Manual', 'Lane_Positioning', 5, '2023-10-01'),
(224, 5, 101, 1, 'Car_Manual', 'Speed_Control', 5, '2023-10-01'),
(225, 5, 101, 1, 'Car_Manual', 'Observation_and_Awareness', 5, '2023-10-01'),
(226, 5, 101, 1, 'Car_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-10-01'),
(229, 5, 101, 2, 'Car_Manual', 'Intersection_Handling:', 5, '2023-10-01'),
(230, 5, 101, 2, 'Car_Manual', 'Turning_and_Lane_Changes:', 5, '2023-10-01'),
(231, 5, 101, 2, 'Car_Manual', 'Parking_Skills:', 5, '2023-10-01'),
(232, 5, 101, 2, 'Car_Manual', 'Use_of_Defensive_Driving_Techniques:', 5, '2023-10-01'),
(233, 5, 101, 2, 'Car_Manual', 'Traffic_Rules_Compliance:', 5, '2023-10-01'),
(234, 5, 101, 2, 'Car_Manual', 'Emergency_Procedures:', 5, '2023-10-01'),
(237, 102, 105, 1, 'Motorcycle_Manual', 'Pre-Drive_Inspection', 5, '2023-10-01'),
(238, 102, 105, 1, 'Motorcycle_Manual', 'Adjustment_of_Controls', 5, '2023-10-01'),
(239, 102, 105, 1, 'Motorcycle_Manual', 'Starting_the_Vehicle', 5, '2023-10-01'),
(240, 102, 105, 1, 'Motorcycle_Manual', 'Parking_Brake_Usage', 5, '2023-10-01'),
(241, 102, 105, 1, 'Motorcycle_Manual', 'Steering_Control', 5, '2023-10-01'),
(242, 102, 105, 1, 'Motorcycle_Manual', 'Use_of_Signals', 5, '2023-10-01'),
(243, 102, 105, 1, 'Motorcycle_Manual', 'Lane_Positioning', 5, '2023-10-01'),
(244, 102, 105, 1, 'Motorcycle_Manual', 'Speed_Control', 5, '2023-10-01'),
(245, 102, 105, 1, 'Motorcycle_Manual', 'Observation_and_Awareness', 5, '2023-10-01'),
(246, 102, 105, 1, 'Motorcycle_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-10-01'),
(248, 5, 105, 1, 'Motorcycle_Manual', 'Pre-Drive_Inspection', 5, '2023-10-01'),
(249, 5, 105, 1, 'Motorcycle_Manual', 'Adjustment_of_Controls', 5, '2023-10-01'),
(250, 5, 105, 1, 'Motorcycle_Manual', 'Starting_the_Vehicle', 5, '2023-10-01'),
(251, 5, 105, 1, 'Motorcycle_Manual', 'Parking_Brake_Usage', 5, '2023-10-01'),
(252, 5, 105, 1, 'Motorcycle_Manual', 'Steering_Control', 5, '2023-10-01'),
(253, 5, 105, 1, 'Motorcycle_Manual', 'Use_of_Signals', 5, '2023-10-01'),
(254, 5, 105, 1, 'Motorcycle_Manual', 'Lane_Positioning', 5, '2023-10-01'),
(255, 5, 105, 1, 'Motorcycle_Manual', 'Speed_Control', 5, '2023-10-01'),
(256, 5, 105, 1, 'Motorcycle_Manual', 'Observation_and_Awareness', 5, '2023-10-01'),
(257, 5, 105, 1, 'Motorcycle_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-10-01'),
(260, 101, 105, 2, 'Motorcycle_Manual', 'Intersection_Handling:', 5, '2023-10-01'),
(261, 101, 105, 2, 'Motorcycle_Manual', 'Turning_and_Lane_Changes:', 5, '2023-10-01'),
(262, 101, 105, 2, 'Motorcycle_Manual', 'Parking_Skills:', 5, '2023-10-01'),
(263, 101, 105, 2, 'Motorcycle_Manual', 'Use_of_Defensive_Driving_Techniques:', 5, '2023-10-01'),
(264, 101, 105, 2, 'Motorcycle_Manual', 'Traffic_Rules_Compliance:', 5, '2023-10-01'),
(265, 101, 105, 2, 'Motorcycle_Manual', 'Emergency_Procedures:', 5, '2023-10-01'),
(267, 103, 105, 1, 'Car_Manual', 'Pre-Drive_Inspection', 5, '2023-10-01'),
(268, 103, 105, 1, 'Car_Manual', 'Adjustment_of_Controls', 5, '2023-10-01'),
(269, 103, 105, 1, 'Car_Manual', 'Starting_the_Vehicle', 5, '2023-10-01'),
(270, 103, 105, 1, 'Car_Manual', 'Parking_Brake_Usage', 5, '2023-10-01'),
(271, 103, 105, 1, 'Car_Manual', 'Steering_Control', 5, '2023-10-01'),
(272, 103, 105, 1, 'Car_Manual', 'Use_of_Signals', 5, '2023-10-01'),
(273, 103, 105, 1, 'Car_Manual', 'Lane_Positioning', 5, '2023-10-01'),
(274, 103, 105, 1, 'Car_Manual', 'Speed_Control', 5, '2023-10-01'),
(275, 103, 105, 1, 'Car_Manual', 'Observation_and_Awareness', 5, '2023-10-01'),
(276, 103, 105, 1, 'Car_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-10-01'),
(278, 103, 105, 1, 'Car_Manual', 'Pre-Drive_Inspection', 5, '2023-10-01'),
(279, 103, 105, 1, 'Car_Manual', 'Adjustment_of_Controls', 5, '2023-10-01'),
(280, 103, 105, 1, 'Car_Manual', 'Starting_the_Vehicle', 5, '2023-10-01'),
(281, 103, 105, 1, 'Car_Manual', 'Parking_Brake_Usage', 5, '2023-10-01'),
(282, 103, 105, 1, 'Car_Manual', 'Steering_Control', 5, '2023-10-01'),
(283, 103, 105, 1, 'Car_Manual', 'Use_of_Signals', 5, '2023-10-01'),
(284, 103, 105, 1, 'Car_Manual', 'Lane_Positioning', 5, '2023-10-01'),
(285, 103, 105, 1, 'Car_Manual', 'Speed_Control', 5, '2023-10-01'),
(286, 103, 105, 1, 'Car_Manual', 'Observation_and_Awareness', 5, '2023-10-01'),
(287, 103, 105, 1, 'Car_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-10-01'),
(289, 5, 105, 1, 'Car_Manual', 'Pre-Drive_Inspection', 5, '2023-10-01'),
(290, 5, 105, 1, 'Car_Manual', 'Adjustment_of_Controls', 5, '2023-10-01'),
(291, 5, 105, 1, 'Car_Manual', 'Starting_the_Vehicle', 5, '2023-10-01'),
(292, 5, 105, 1, 'Car_Manual', 'Parking_Brake_Usage', 5, '2023-10-01'),
(293, 5, 105, 1, 'Car_Manual', 'Steering_Control', 5, '2023-10-01'),
(294, 5, 105, 1, 'Car_Manual', 'Use_of_Signals', 5, '2023-10-01'),
(295, 5, 105, 1, 'Car_Manual', 'Lane_Positioning', 5, '2023-10-01'),
(296, 5, 105, 1, 'Car_Manual', 'Speed_Control', 5, '2023-10-01'),
(297, 5, 105, 1, 'Car_Manual', 'Observation_and_Awareness', 5, '2023-10-01'),
(298, 5, 105, 1, 'Car_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-10-01'),
(301, 104, 99, 1, 'Car_Manual', 'Pre-Drive_Inspection', 5, '2023-10-03'),
(302, 104, 99, 1, 'Car_Manual', 'Adjustment_of_Controls', 5, '2023-10-03'),
(303, 104, 99, 1, 'Car_Manual', 'Starting_the_Vehicle', 5, '2023-10-03'),
(304, 104, 99, 1, 'Car_Manual', 'Parking_Brake_Usage', 1, '2023-10-03'),
(305, 104, 99, 1, 'Car_Manual', 'Steering_Control', 5, '2023-10-03'),
(306, 104, 99, 1, 'Car_Manual', 'Use_of_Signals', 5, '2023-10-03'),
(307, 104, 99, 1, 'Car_Manual', 'Lane_Positioning', 5, '2023-10-03'),
(308, 104, 99, 1, 'Car_Manual', 'Speed_Control', 5, '2023-10-03'),
(309, 104, 99, 1, 'Car_Manual', 'Observation_and_Awareness', 5, '2023-10-03'),
(310, 104, 99, 1, 'Car_Manual', 'Stopping_and_Starting_Smoothly', 5, '2023-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `pdc_questions`
--

CREATE TABLE `pdc_questions` (
  `ques_id` int(11) NOT NULL,
  `q_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desciption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pdc_questions`
--

INSERT INTO `pdc_questions` (`ques_id`, `q_title`, `desciption`, `session`) VALUES
(1, 'Pre-Drive Inspection', 'Properly checks vehicle condition, such as lights, tires, brakes, mirrors, etc.', 1),
(2, 'Adjustment of Controls', 'Properly adjusts seats, mirrors, and steering wheel.', 1),
(3, 'Starting the Vehicle', 'Starts the vehicle without any issues.', 1),
(4, 'Parking Brake Usage', 'Applies and releases parking brake correctly.', 1),
(5, 'Steering Control', 'Demonstrates proper hand-over-hand or push-pull steering technique.', 1),
(6, 'Use of Signals', 'Uses turn signals and brake lights appropriately.', 1),
(7, 'Lane Positioning', 'Maintains proper lane position and alignment.', 1),
(8, 'Speed Control', 'Maintains an appropriate and safe speed for road conditions.', 1),
(9, 'Observation and Awareness', 'Demonstrates good situational awareness by checking mirrors and blind spots.', 1),
(10, 'Stopping and Starting Smoothly', 'Stops and starts the vehicle smoothly without jerking.', 1),
(11, 'Intersection Handling:', 'Navigates intersections safely and follows right-of-way rules.', 2),
(12, 'Turning and Lane Changes:', 'Executes turns and lane changes correctly and safely.', 2),
(13, 'Parking Skills:', 'Demonstrates proficiency in parallel parking, perpendicular parking, and hill parking (if applicable).', 2),
(14, 'Use of Defensive Driving Techniques:', 'Demonstrates awareness of potential hazards and reacts appropriately.', 2),
(15, 'Traffic Rules Compliance:', 'Adheres to traffic signs, signals, and rules.', 2),
(16, 'Emergency Procedures:', 'Reacts correctly to emergency situations (e.g., sudden braking, swerving).', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pdc_result`
--

CREATE TABLE `pdc_result` (
  `PDC_attempt_id` int(11) NOT NULL,
  `Username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Student_id` int(11) NOT NULL,
  `PDC_Course_enrolled` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` int(11) NOT NULL,
  `Assessment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pdc_result`
--

INSERT INTO `pdc_result` (`PDC_attempt_id`, `Username`, `Student_id`, `PDC_Course_enrolled`, `session`, `Assessment`, `Date`) VALUES
(1, 'Mark555', 99, 'Motorcycle_Manual', 1, 'pass', '2023-09-25'),
(2, 'Mark555', 99, 'Motorcycle_Manual', 2, 'pass', '2023-09-25'),
(3, 'Mark555', 99, 'Car_Manual', 1, 'failed', '2023-09-25'),
(4, 'Mark555', 99, 'Car_Manual', 1, 'failed', '2023-09-25'),
(5, 'Mark555', 99, 'Car_Manual', 1, 'failed', '2023-09-25'),
(6, 'Mark555', 99, 'Car_Manual', 1, 'failed', '2023-09-25'),
(7, 'Mark555', 99, 'Car_Manual', 1, 'failed', '2023-09-25'),
(8, 'Mark888', 101, 'Motorcycle_Automatic', 1, 'pass', '2023-09-30'),
(9, 'Mark888', 101, 'Motorcycle_Automatic', 2, 'pass', '2023-10-01'),
(10, 'Mark888', 101, 'Car_Manual', 1, 'pass', '2023-10-01'),
(11, 'Mark888', 101, 'Car_Manual', 2, 'pass', '2023-10-01'),
(12, 'Yi1ki2bi', 105, 'Motorcycle_Manual', 1, 'failed', '2023-10-01'),
(13, 'Yi1ki2bi', 105, 'Motorcycle_Manual', 1, 'pass', '2023-10-01'),
(14, 'Yi1ki2bi', 105, 'Motorcycle_Manual', 2, 'failed', '2023-10-01'),
(15, 'Yi1ki2bi', 105, 'Car_Manual', 1, 'failed', '2023-10-01'),
(16, 'Yi1ki2bi', 105, 'Car_Manual', 1, 'failed', '2023-10-01'),
(17, 'Yi1ki2bi', 105, 'Car_Manual', 1, 'pass', '2023-10-01'),
(18, 'Mark555', 99, 'Car_Manual', 1, 'pass', '2023-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `pdc_schedule`
--

CREATE TABLE `pdc_schedule` (
  `PDC_SchedID` int(11) NOT NULL,
  `schedule1` date DEFAULT NULL,
  `schedule2` date DEFAULT NULL,
  `time1` time DEFAULT NULL,
  `time2` time DEFAULT NULL,
  `Slot` int(11) DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pdc_schedule`
--

INSERT INTO `pdc_schedule` (`PDC_SchedID`, `schedule1`, `schedule2`, `time1`, `time2`, `Slot`) VALUES
(10, '2023-10-05', '2023-10-06', '08:00:00', '15:30:00', 4),
(11, '2023-10-03', '2023-10-04', '08:00:00', '15:30:00', 4),
(12, '2023-10-09', '2023-10-10', '08:00:00', '15:30:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qid` int(11) NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ans1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ans2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ans3` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ans4` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `question`, `ans1`, `ans2`, `ans3`, `ans4`, `correct_answer`, `topic`) VALUES
(121, 'What does this road sign indicate? (Image: Stop sign)Which of the following traffic signs indicates that U-turns are not \nallowed?', 'A circular sign with a white arrow pointing right', 'A circular sign with a red arrow pointing left', 'A circular sign with a green arrow pointing up', 'A triangular sign with a yellow center and black border', 'B', 'Module 1'),
(122, 'Which of the following traffic signs indicates that you are prohibited from entering a specific area or road?', 'A rectangular sign with a blue background and a white arrow pointing forward', 'A circular sign with a red border and a white hand making a stop gesture', 'A diamond-shaped sign with an orange background and black symbols', 'A triangular sign with a red border and a white exclamation mark', 'C', 'Module 1'),
(123, 'What does the \"No Entry\" traffic sign indicate?', 'Vehicles must enter the designated lane.', 'Vehicles are allowed to enter the area with caution.', 'Vehicles are prohibited from entering the area in the direction of the sign.', 'Vehicles should accelerate and pass quickly.', 'C', 'Module 1'),
(124, 'What is the maximum speed limit for private cars on non-expressway roads', '60 kilometers per hour (kph)', '80 kilometers per hour (kph)', '100 kilometers per hour (kph)', '120 kilometers per hour (kph)', 'A', 'Module 1'),
(125, 'You approach an intersection with a \"No Turn\" sign. What does this sign indicate?', 'You should turn in the direction indicated by the sign.', 'You can turn in any direction without restrictions.', 'You are prohibited from making the indicated turn.', 'You must make the indicated turn to proceed', 'C', 'Module 1'),
(126, 'When you see a \"One Way\" sign, what does it mean?', 'You can proceed in any direction on the road.', 'You must make a U-turn and find another route.', 'Traffic is allowed to flow in one direction only on the road.', 'You can choose either direction depending on your preference.', 'C', 'Module 1'),
(127, 'When you encounter a \"Give Way\" sign, what should you do?', 'Speed up and proceed through the intersection quickly.', 'Stop and yield the right-of-way to all other vehicles at the intersection.', 'Honk your horn to alert other drivers to your presence.', 'Change lanes without signaling to assert your position.', 'B', 'Module 1'),
(128, 'When you encounter a \"Keep Right\" sign, what does it instruct you to do?', 'You should immediately turn right at the upcoming intersection', 'You can choose to turn left or right as you prefer.', 'You must stay to the right side of the road and not cross into oncoming traffic.', 'You must keep your vehicle\'s speed within the speed limit.', 'C', 'Module 1'),
(129, 'You approach an intersection with a \"Left Turners Must Give Way\" sign. What does this sign mean for drivers intending to make a left turn?', 'Left-turning drivers have the right-of-way and can proceed without stopping.', 'Left-turning drivers must yield the right-of-way to oncoming traffic and pedestrians.', 'Left-turning drivers can ignore the sign and proceed as usual.', 'Left-turning drivers must come to a complete stop, but all other traffic must yield to them.', 'B', 'Module 1'),
(130, 'You come across a \"No Waiting Anytime\" sign on the side of the road. What does this sign mean?', 'You can park your vehicle temporarily but not for an extended period.', 'You are allowed to stop and wait for a short duration.', 'Parking or waiting is prohibited at all times in the designated area.', 'You can park or wait as long as you use your hazard lights.', 'C', 'Module 1'),
(131, 'What does Section 52 of RA 4136 prohibit regarding the use of motor vehicles?', 'Using a motor vehicle for commercial purposes on public sidewalks', 'Driving or parking a motor vehicle on sidewalks, paths, or alleys not intended for vehicular traffic or parking', 'Racing motor vehicles on public roads', 'Using a motor vehicle without a valid license plate', 'B', 'Module 2'),
(132, 'What does Section 54 of RA 4136 prohibit regarding the operation of motor vehicles on the highway?', 'Overtaking other vehicles on the right side', 'Driving at a speed exceeding the posted limit', 'Driving in a manner that obstructs or impedes the passage of other vehicles', 'Using a mobile phone while driving', 'C', 'Module 2'),
(133, 'Are red lights allowed at the front of a motor vehicle in the Philippines according to the law of driving?', 'Yes, red lights are allowed for all motor vehicles as a standard feature.', 'Yes, red lights are allowed for private vehicles to enhance visibility.', 'No, red lights are strictly prohibited at the front of a motor vehicle.', 'Yes, red lights are allowed for all motor vehicles for decorative purposes.', 'C', 'Module 2'),
(134, 'What shall be the color of taillights that are visible within 100 meters to traffic regulations?', 'White', 'Red', 'Amber', 'Green', 'B', 'Module 2'),
(135, 'What shall be the color of plate lights on vehiclesWhat shall be the color of plate lights on vehicles', 'Red', 'Blue', 'White', 'Green', 'C', 'Module 2'),
(136, 'Under Section 53 of RA 4136, which substance(s) can result in a driver being considered \"under the influence\" as discussed in RA 10586?', 'Red', 'Yellow', 'Green', 'Blue', 'A', 'Module 2'),
(137, 'How often should you change your vehicle\'s engine oil?What is the primary right of way granted to police and other emergency vehicles according to Section 49 of RA 4136', 'Only alcohol', 'They have the right of way only when their sirens and red or blue lights are in operation.', 'Both alcohol and drugs', 'Only prescription medication\n', 'C', 'Module 2'),
(138, 'What is the primary right of way granted to police and other emergency vehicles according to Section 49 of RA 4136', 'They have the right of way at all times, even if it requires other vehicles to stop abruptly.', 'They have the right of way only when their sirens and red or blue lights are in operation.', 'The provincial board, municipal board, or city council having jurisdiction over the highways', 'They have no special right of way and must follow traffic rules like other vehicles.', 'B', 'Module 2'),
(139, 'Who is responsible for properly classifying public highways for traffic purposes and providing appropriate signs, subject to the approval of the Commissioner, as per Section 38 of RA 4136?', 'The Department of Transportation (DOTr)', 'The Land Transportation Office (LTO)', 'The provincial board, municipal board, or city council having jurisdiction over the highways', 'The Philippine National Police (PNP)', 'C', 'Module 2'),
(140, 'What does Section 36 of RA 4136 primarily address regarding speed limits', 'It allows provincial authorities to set their own speed limits.', 'It establishes uniform speed limits nationwide, preventing local variations.', 'It grants cities and municipalities the authority to set speed limits within their jurisdictions.', 'It imposes strict penalties for exceeding speed limits on highways.', 'B', 'Module 2'),
(141, 'what action should a driver take when approaching a railway grade crossing in the vicinity of another vehicle proceeding in the same direction?', 'Speed up and overtake the vehicle before reaching the crossing.', 'Honk the horn to signal the vehicle in front to move aside.', 'Wait until after the railway grade crossing to overtake the vehicle.', 'Overtake the vehicle as quickly as possible, even if you are at the crossing.\nOvertake the vehicle as quickly as possible, even if you are at the crossing.', 'C', 'Module 3'),
(142, 'When overtaking another vehicle proceeding in the same direction, what should a driver do according to traffic regulations?', 'Pass closely on either side, depending on the road conditions.', 'Pass at any distance as long as it\'s done quickly.', 'Pass at a safe distance to the left and avoid returning to the right side until clear.Overtaking during the daytime', 'Pass at a safe distance to the right and use your horn to signal your intent.', 'C', 'Module 3'),
(143, 'In which situation is overtaking or passing another vehicle proceeding in the same direction prohibited?', 'Overtaking upon a curve', 'Overtaking in a straight section of the highway', 'Overtaking during the daytime', 'Overtaking in clear weather conditions', 'A', 'Module 3'),
(144, 'which of the following vehicles are allowed to use sirens and emergency lights?', 'All government vehicles', 'To prevent accidents and ensure the timely response to emergencies', 'Only authorized emergency vehicles such as ambulances, firetrucks, and police cars', 'Private vehicles of medical practitioners', 'C', 'Module 3'),
(145, 'What should drivers do if they are unable to move to the side of the road immediately to allow an emergency vehicle to pass?', 'To avoid traffic violations', 'To prevent accidents and ensure the timely response to emergencies\n', 'Stay in their lane and continue driving until a safe opportunity to yield the right of way arises.', 'To show respect for the emergency personnel', 'B', 'Module 3'),
(146, 'What should drivers do if they are unable to move to the side of the road immediately to allow an emergency vehicle to pass?', 'Honk their horn to alert the emergency vehicle.', 'Speed up to get out of the way as quickly as possible.', 'A safe following distance that allows the emergency vehicle to maneuverStay in their lane and continue driving until a safe opportunity to yield the right of way arises.', 'Stop their vehicle in the middle of the road to make way for the emergency vehicle.', 'C', 'Module 3'),
(147, 'What is the minimum distance that drivers should maintain from an emergency vehicle with its sirens and lights activated?', 'At least 50 meters (164 feet)', 'As close as possible to facilitate communication with the emergency personnel', 'A safe following distance that allows the emergency vehicle to maneuver', 'A minimum of 100 meters (328 feet)', 'C', 'Module 3'),
(148, 'If a motor vehicle is found to be operating without a muffler, what could be the consequence for the driver or owner?', 'Metallic tires are permitted but must be painted a specific color.A verbal warning from a traffic officer.', 'Metallic tires are allowed for commercial vehicles only.A fine and a written warning.', 'No motor vehicle with metallic tires shall be operated on any public highway.Immediate suspension of the vehicle\'s registration.', 'No consequences; mufflers are optional.\n', 'B', 'Module 3'),
(149, 'what is the restriction regarding metallic tires on motor vehicles operating on public highways?\n', 'Metallic tires are permitted but must be painted a specific color.', 'Metallic tires are allowed for commercial vehicles only.', 'No motor vehicle with metallic tires shall be operated on any public highway.', 'Metallic tires are allowed only during nighttime.\n', 'C', 'Module 3'),
(150, 'what is the requirement regarding the use of solid tires with metal rims on vehicles?', 'Solid tires with metal rims are prohibited for all vehicles.', 'Solid tires with metal rims are allowed only on motorcycles.', 'Solid tires with metal rims are permitted, but they must have sufficient thickness to prevent direct contact with the road.', 'Solid tires with metal rims are allowed on commercial vehicles only.', 'C', 'Module 3'),
(151, 'When should you use your vehicle\'s hazard lights?', 'During heavy rain', 'During daytime only', 'During nighttime only', 'When you want to warn other drivers of your presence', 'D', 'Module 2'),
(152, 'What is the purpose of a brake pedal in a vehicle?', 'To accelerate the vehicle', 'To change gears', 'To activate the windshield wipers', 'To slow down or stop the vehicle', 'D', 'Module 3'),
(153, 'What does this road sign indicate? (Image: No Overtaking sign)', 'No passing', 'No U-turn', 'No Entry', 'No Parking', 'A', 'Module 1'),
(154, 'What is the legal blood alcohol concentration (BAC) limit for drivers in most states?', '0.01%', '0.05%', '0.08%', '0.10%', 'C', 'Module 2');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `idStudent` int(11) NOT NULL,
  `Username` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EmailAddress` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Lastname` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Firstname` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Middlename` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Suffix` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Birthdate` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Civilstatus` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Sex` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contactnumber` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ZipCode` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Profile_picture` longblob DEFAULT NULL,
  `Citizenship` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Enroll_Status` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Role` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DateOfEnrolled` date DEFAULT NULL,
  `BirthCert` longblob DEFAULT NULL,
  `BirthCertType` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contact_person` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contact_person_number` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Relationship` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Student_permit_number` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LTO_Client_ID` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Student_permit_img` longblob DEFAULT NULL,
  `Expiration_student_permit` date DEFAULT NULL,
  `Mode_of_Payment` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` float DEFAULT NULL,
  `balance` float DEFAULT NULL,
  `studentcol` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PDC-MOTOR` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PDC-CAR` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TDC` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TDC_Cert_approve` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PDC_Cert_approve` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`idStudent`, `Username`, `EmailAddress`, `Password`, `Lastname`, `Firstname`, `Middlename`, `Suffix`, `Birthdate`, `Civilstatus`, `Sex`, `Contactnumber`, `Address`, `ZipCode`, `Profile_picture`, `Citizenship`, `City`, `Enroll_Status`, `Role`, `DateOfEnrolled`, `BirthCert`, `BirthCertType`, `Contact_person`, `Contact_person_number`, `Relationship`, `Student_permit_number`, `LTO_Client_ID`, `Student_permit_img`, `Expiration_student_permit`, `Mode_of_Payment`, `total_amount`, `balance`, `studentcol`, `PDC-MOTOR`, `PDC-CAR`, `TDC`, `TDC_Cert_approve`, `PDC_Cert_approve`) VALUES
(1, 'BOBI', 'qwe@gmail.com', 'Admin123', 'Bibo', 'Tender', 'Qwe', '', '2005-07-03', 'Single', 'Male', '09999991231', 'Qwe', '', 0x2e2f75706c6f6164732f3330363331383233335f313131353832343436393035353134325f373235313135383931333834363533363238335f6e2e6a7067, '', 'Qwe', 'pending', 'Student', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(80, 'Admin888', 'qweqwe123@gmail.com', '123', 'Qwe', 'Qwe', 'Qwe', 'Qwe', NULL, NULL, NULL, NULL, NULL, NULL, 0x2e2f75706c6f6164732f4a5255205669727475616c204261636b67726f756e642032335f32342e6a7067, NULL, NULL, 'enrolled', 'Student', '2023-09-04', NULL, NULL, NULL, NULL, NULL, 'qweqweqwe', '0', NULL, '2023-09-04', '', 0, 0, NULL, NULL, NULL, NULL, '', ''),
(98, 'Admin555', 'johnmark.guillero@my.jru.edu', 'Admin123', 'Qwe', 'Qwe', 'Qwe', 'Qwe', '2005-06-15', 'Single', NULL, '09999991231', 'Johpet St.', '1231', 0x2e2f75706c6f6164732f757365725f69636f6e2e706e67, 'Qwe', 'Pasig City', 'pending', 'Student', '2023-09-02', 0x2e2f75706c6f6164732f7064665f53747564656e742f505431202d20415753206c6f67696e20506167652e706466, NULL, 'Mark', NULL, 'Mark', NULL, '0', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(99, 'Mark555', 'crossmode75@gmail.com', 'Admin123', 'Perez', 'Glen William', '', 'jr', '2005-06-08', 'Single', 'MALE', '09999991231', 'Johpet St.', '1231', NULL, 'Qwe', 'Pasig City', 'enrolled', 'Student', '2023-09-22', 0x2e2f75706c6f6164732f7064665f53747564656e742f505431202d20415753206c6f67696e20506167652e706466, NULL, 'Mark', '09995612112', 'parent', '10244878888', '0', 0x2e2f75706c6f6164732f7064665f53747564656e742f505431202d20415753206c6f67696e20506167652e706466, '2023-09-05', '', 7500, 4000, NULL, 'Motorcycle_Manual', 'Car_Manual', 'Enrolling', '', ''),
(100, 'Jophet12', 'hernandezjophet@gmail.com', 'Username_1', 'Qwe', 'Qwe', 'Qwe', '', '2005-06-19', 'Single', 'MALE', '09999991231', 'Johpet St.', '1231', 0x2e2f75706c6f6164732f656d6f696c2e706e67, 'Qwe', 'Pasig City', 'pending', 'Student', '2023-09-30', NULL, NULL, 'Mark', '09995612112', 'spouse', 'qweqweqwe123', '123123123123123132122222222222', 0x2e2f75706c6f6164732f7064665f53747564656e742f476f616c2d6e612d6e6565642d6d612d6669782d61667465722d746869732d74657374696e672d616e642d6d61672d484f484f5354494e472d6e612d7461796f2e706466, '2023-09-26', '', 13000, 13000, NULL, 'Motorcycle_Manual', 'Car_Manual', NULL, '', ''),
(101, 'Mark888', 'crossmode85@gmail.com', 'Admin123', 'Bonsol', 'Justine ', '', '', '2005-06-08', 'Single', 'MALE', '09999991231', 'Calzada-Tipas', '4584', NULL, 'Filipino', 'Taguig City', 'enrolled', 'Student', '2023-09-26', NULL, NULL, 'Micka', '09995612112', 'parent', '10244878888', '0', NULL, '2023-09-05', '', 7500, 5000, NULL, 'Motorcycle_Automatic', 'Car_Manual', 'Enrolling', '', ''),
(102, 'Tine123', 'Tine2x@gmail.com', 'Admin123', 'Jonson', 'Bustine', 'Williams', '', '2005-06-08', 'Single', 'FEMALE', '09999991231', 'Calzada-Tipas', '4584', NULL, 'Filipino', 'Taguig City', 'enrolled', 'Student', '2023-09-26', NULL, NULL, 'Micka', '09995612112', 'parent', '10244878888', '0', NULL, '2023-09-05', '', 7500, 2000, NULL, 'Motorcycle_Automatic', 'Car_Automatic', NULL, '', ''),
(103, 'pat@123', 'Pat123@gmail.com', 'Admin123', 'Qwe', 'Qwe', '', '', '2005-06-08', 'Married', 'FEMALE', '09999991231', 'Johpet St.', '1231', NULL, 'Qwe', 'Pasig City', NULL, 'Student', '2023-10-05', 0x2e2f75706c6f6164732f7064665f53747564656e742f476f616c2d6e612d6e6565642d6d612d6669782d61667465722d746869732d74657374696e672d616e642d6d61672d484f484f5354494e472d6e612d7461796f2e706466, 'Birth Certificate', 'Mark', '09123213111', 'spouse', '10244878888', '0', NULL, '2023-09-05', '', 9500, 4500, NULL, NULL, NULL, 'Enrolling', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_enrolled`
--

CREATE TABLE `student_enrolled` (
  `idstudent_enrolled` int(11) NOT NULL,
  `Username` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TDC` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PDC-MOTOR` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PDC-CAR` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_permit_number` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ExpirationDate` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_enrolled`
--

INSERT INTO `student_enrolled` (`idstudent_enrolled`, `Username`, `TDC`, `PDC-MOTOR`, `PDC-CAR`, `student_permit_number`, `ExpirationDate`) VALUES
(4, 'Admin321', 'Enrolling', 'Motorcycle(Automatic)', 'CAR(Automatic)', '', ''),
(5, 'BOBI', 'Enrolling', 'Motorcycle(Automatic)', 'CAR(Manual)', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_result`
--

CREATE TABLE `student_result` (
  `result_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Session_num` int(11) NOT NULL,
  `Score` int(11) NOT NULL,
  `result` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_of_wrong_ans` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_result`
--

INSERT INTO `student_result` (`result_id`, `username`, `Session_num`, `Score`, `result`, `num_of_wrong_ans`) VALUES
(64, 'Yi1ki2bi', 1, 10, 'Passed', 1),
(65, 'Yi1ki2bi', 2, 4, 'Failed', 8),
(66, 'Yi1ki2bi', 2, 11, 'Passed', 1),
(67, 'Yi1ki2bi', 3, 10, 'Passed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_schedule_pdc`
--

CREATE TABLE `student_schedule_pdc` (
  `idstudent_schedule` int(11) NOT NULL,
  `Student_Id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Username` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PDC_Vechicle` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule1` date DEFAULT NULL,
  `schedule2` date DEFAULT NULL,
  `Time1` time DEFAULT NULL,
  `Time2` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_schedule_pdc`
--

INSERT INTO `student_schedule_pdc` (`idstudent_schedule`, `Student_Id`, `Username`, `PDC_Vechicle`, `schedule1`, `schedule2`, `Time1`, `Time2`) VALUES
(1, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(2, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(3, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(4, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(5, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(6, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(7, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(8, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(9, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(10, '99', 'Mark555', 'Car_Manual', '2023-09-05', '2023-09-05', '23:08:00', '03:08:00'),
(11, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(12, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(13, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(14, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(15, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(16, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(17, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(18, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(19, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(20, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(21, '99', 'Mark555', 'Car_Manual', '2023-09-05', '2023-09-05', '23:08:00', '03:08:00'),
(22, '99', 'Mark555', 'Car_Manual', '2023-09-05', '2023-09-05', '23:08:00', '03:08:00'),
(23, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(24, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(25, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(26, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(27, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(28, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(29, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(30, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(31, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(32, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(33, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(34, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(35, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(36, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(37, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(38, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(39, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(40, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(41, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(42, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(43, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(44, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(45, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(46, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(47, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(48, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(49, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(50, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(51, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(52, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(53, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(54, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(55, '99', 'Mark555', 'Car_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(56, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(57, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(58, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(59, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(60, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(61, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(62, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(63, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(64, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(65, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(66, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(67, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(68, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(69, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(70, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(71, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(72, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(73, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(74, '99', 'Mark555', 'Motorcycle_Manual', '2023-09-02', '2023-09-05', '22:32:00', '02:32:00'),
(75, '99', 'Mark555', 'Car_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(76, '105', 'Yi1ki2bi', 'Motorcycle_Manual', '2023-09-06', '2023-09-11', '23:32:00', '03:32:00'),
(77, '105', 'Yi1ki2bi', 'Car_Manual', '2023-09-05', '2023-09-05', '23:08:00', '03:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_schedule_tdc`
--

CREATE TABLE `student_schedule_tdc` (
  `idstudent_schedule` int(11) NOT NULL,
  `Student_Id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Username` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule1` date DEFAULT NULL,
  `schedule2` date DEFAULT NULL,
  `Time1` time DEFAULT NULL,
  `Time2` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_schedule_tdc`
--

INSERT INTO `student_schedule_tdc` (`idstudent_schedule`, `Student_Id`, `Username`, `schedule1`, `schedule2`, `Time1`, `Time2`) VALUES
(1, '99', 'Mark555', '0000-00-00', '0000-00-00', '00:00:00', '00:00:00'),
(2, '104', 'Username1', '2023-09-05', '2023-09-05', '01:11:00', '01:11:00'),
(3, '106', 'Jophet18', '2023-09-05', '2023-09-05', '01:11:00', '01:11:00'),
(4, '107', 'Jophy123', '2023-09-05', '2023-09-05', '01:11:00', '01:11:00'),
(5, '108', 'Yi1ki2bi', '2023-10-03', '2023-10-04', '08:30:00', '12:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_transaction`
--

CREATE TABLE `student_transaction` (
  `Transaction_ID` int(11) NOT NULL,
  `student_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Amount_paid` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Submit_date` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Transaction_Remark` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Transaction_time` time DEFAULT NULL,
  `Course` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_transaction`
--

INSERT INTO `student_transaction` (`Transaction_ID`, `student_id`, `Amount_paid`, `Submit_date`, `Transaction_Remark`, `Transaction_time`, `Course`) VALUES
(1, '99', '1000', '2023-09-22', 'First Pay', '01:12:35', 'PDC'),
(2, '99', '500', '2023-09-23', 'ads', '01:37:38', 'PDC'),
(3, '101', '2500', '2023-09-26', 'First Payment', '11:51:25', 'PDC'),
(4, '102', '3000', '2023-09-20', 'First Payment', '11:52:07', 'PDC'),
(5, '102', '1500', '2023-09-28', 'Second Payment', '11:53:32', 'PDC'),
(6, '102', '1000', '2023-09-29', 'First OL payment', '11:56:04', 'PDC'),
(7, '99', '2000', '2023-09-28', 'second payment', '01:13:19', 'PDC'),
(8, '103', '5000', '2023-09-27', 'First payment', '02:16:33', 'TDC'),
(9, '99', '4000', '2023-09-30', 'Last', '02:07:46', 'PDC'),
(10, '104', '1000', '2023-09-30', 'Full payment', '01:13:38', 'TDC'),
(11, '101', '5000', '2023-10-01', 'full', '09:22:07', 'PDC'),
(12, '101', '5000', '2023-10-01', 'full', '09:22:07', 'PDC'),
(13, '101', '5000', '2023-10-01', 'full', '09:23:28', 'PDC'),
(14, '105', '1000', '2023-10-01', 'partial', '10:33:14', 'PDC'),
(15, '106', '1000', '2023-10-03', 'full', '03:50:54', 'TDC'),
(16, '107', '1000', '2023-10-03', 'full', '04:04:30', 'TDC'),
(17, '108', '1000', '2023-10-03', 'Full payment', '07:55:32', 'TDC'),
(18, '103', '500', '2023-10-04', 'partial', '06:41:41', 'TDC');

-- --------------------------------------------------------

--
-- Table structure for table `tdc_schedule`
--

CREATE TABLE `tdc_schedule` (
  `TDC_SchedID` int(11) NOT NULL,
  `schedule1` date DEFAULT NULL,
  `schedule2` date DEFAULT NULL,
  `time1` time DEFAULT NULL,
  `time2` time DEFAULT NULL,
  `Slot` int(11) DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tdc_schedule`
--

INSERT INTO `tdc_schedule` (`TDC_SchedID`, `schedule1`, `schedule2`, `time1`, `time2`, `Slot`) VALUES
(5, '2023-10-03', '2023-10-04', '08:05:00', '15:35:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_tbl`
--

CREATE TABLE `vehicle_tbl` (
  `vhcl_id` int(11) NOT NULL,
  `Type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_brand_model` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_tbl`
--

INSERT INTO `vehicle_tbl` (`vhcl_id`, `Type`, `vehicle_brand_model`) VALUES
(1, 'Car(manual)', 'Honda:Civic'),
(2, 'Car(automatic)', 'Honda:Accord'),
(3, 'Motorcycle(manual)', 'Rusi:Classic 250'),
(4, 'Motorcycle(automatic)', 'Yamaha:Nmax'),
(5, 'Car(manual)', 'Toyota:Corolla'),
(6, 'Car(automatic)', 'Toyota:Camry'),
(7, 'Motorcycle(manual)', 'Kawasaki:Rouser'),
(8, 'Motorcycle(automatic)', 'Honda:Click 155');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `admin_module_exam_pdf`
--
ALTER TABLE `admin_module_exam_pdf`
  ADD PRIMARY KEY (`idadmin_module_exam_pdf`);

--
-- Indexes for table `admin_updatepostdesc`
--
ALTER TABLE `admin_updatepostdesc`
  ADD PRIMARY KEY (`idUpdatePostDesc`);

--
-- Indexes for table `course_enrolled`
--
ALTER TABLE `course_enrolled`
  ADD PRIMARY KEY (`idCourse_Enrolled`);

--
-- Indexes for table `di`
--
ALTER TABLE `di`
  ADD PRIMARY KEY (`id_DI`);

--
-- Indexes for table `di_assign_tbl`
--
ALTER TABLE `di_assign_tbl`
  ADD PRIMARY KEY (`Di_Assign`);

--
-- Indexes for table `di_report_tbl`
--
ALTER TABLE `di_report_tbl`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `evalques_tb`
--
ALTER TABLE `evalques_tb`
  ADD PRIMARY KEY (`eval_id`);

--
-- Indexes for table `evalres_tb`
--
ALTER TABLE `evalres_tb`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `feedques_tb`
--
ALTER TABLE `feedques_tb`
  ADD PRIMARY KEY (`qID`);

--
-- Indexes for table `feedres_tb`
--
ALTER TABLE `feedres_tb`
  ADD PRIMARY KEY (`Response_ID`);

--
-- Indexes for table `info_tb`
--
ALTER TABLE `info_tb`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `newupdate`
--
ALTER TABLE `newupdate`
  ADD PRIMARY KEY (`idNewUpdate`);

--
-- Indexes for table `olpayment_tb`
--
ALTER TABLE `olpayment_tb`
  ADD PRIMARY KEY (`ol_id`);

--
-- Indexes for table `pdc_assessment`
--
ALTER TABLE `pdc_assessment`
  ADD PRIMARY KEY (`assess_id`);

--
-- Indexes for table `pdc_questions`
--
ALTER TABLE `pdc_questions`
  ADD PRIMARY KEY (`ques_id`);

--
-- Indexes for table `pdc_result`
--
ALTER TABLE `pdc_result`
  ADD PRIMARY KEY (`PDC_attempt_id`);

--
-- Indexes for table `pdc_schedule`
--
ALTER TABLE `pdc_schedule`
  ADD PRIMARY KEY (`PDC_SchedID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idStudent`);

--
-- Indexes for table `student_enrolled`
--
ALTER TABLE `student_enrolled`
  ADD PRIMARY KEY (`idstudent_enrolled`);

--
-- Indexes for table `student_result`
--
ALTER TABLE `student_result`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `student_schedule_pdc`
--
ALTER TABLE `student_schedule_pdc`
  ADD PRIMARY KEY (`idstudent_schedule`);

--
-- Indexes for table `student_schedule_tdc`
--
ALTER TABLE `student_schedule_tdc`
  ADD PRIMARY KEY (`idstudent_schedule`);

--
-- Indexes for table `student_transaction`
--
ALTER TABLE `student_transaction`
  ADD PRIMARY KEY (`Transaction_ID`);

--
-- Indexes for table `tdc_schedule`
--
ALTER TABLE `tdc_schedule`
  ADD PRIMARY KEY (`TDC_SchedID`);

--
-- Indexes for table `vehicle_tbl`
--
ALTER TABLE `vehicle_tbl`
  ADD PRIMARY KEY (`vhcl_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_module_exam_pdf`
--
ALTER TABLE `admin_module_exam_pdf`
  MODIFY `idadmin_module_exam_pdf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_updatepostdesc`
--
ALTER TABLE `admin_updatepostdesc`
  MODIFY `idUpdatePostDesc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_enrolled`
--
ALTER TABLE `course_enrolled`
  MODIFY `idCourse_Enrolled` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `di`
--
ALTER TABLE `di`
  MODIFY `id_DI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `di_assign_tbl`
--
ALTER TABLE `di_assign_tbl`
  MODIFY `Di_Assign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1084;

--
-- AUTO_INCREMENT for table `di_report_tbl`
--
ALTER TABLE `di_report_tbl`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `evalques_tb`
--
ALTER TABLE `evalques_tb`
  MODIFY `eval_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `evalres_tb`
--
ALTER TABLE `evalres_tb`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedques_tb`
--
ALTER TABLE `feedques_tb`
  MODIFY `qID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedres_tb`
--
ALTER TABLE `feedres_tb`
  MODIFY `Response_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `info_tb`
--
ALTER TABLE `info_tb`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `olpayment_tb`
--
ALTER TABLE `olpayment_tb`
  MODIFY `ol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pdc_assessment`
--
ALTER TABLE `pdc_assessment`
  MODIFY `assess_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT for table `pdc_questions`
--
ALTER TABLE `pdc_questions`
  MODIFY `ques_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pdc_result`
--
ALTER TABLE `pdc_result`
  MODIFY `PDC_attempt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pdc_schedule`
--
ALTER TABLE `pdc_schedule`
  MODIFY `PDC_SchedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `idStudent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `student_enrolled`
--
ALTER TABLE `student_enrolled`
  MODIFY `idstudent_enrolled` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `student_result`
--
ALTER TABLE `student_result`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `student_schedule_pdc`
--
ALTER TABLE `student_schedule_pdc`
  MODIFY `idstudent_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `student_schedule_tdc`
--
ALTER TABLE `student_schedule_tdc`
  MODIFY `idstudent_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_transaction`
--
ALTER TABLE `student_transaction`
  MODIFY `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tdc_schedule`
--
ALTER TABLE `tdc_schedule`
  MODIFY `TDC_SchedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle_tbl`
--
ALTER TABLE `vehicle_tbl`
  MODIFY `vhcl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
