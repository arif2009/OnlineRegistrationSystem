-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2012 at 09:44 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbonlineregistration`
--
CREATE DATABASE `dbonlineregistration` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbonlineregistration`;

-- --------------------------------------------------------

--
-- Table structure for table `adviser`
--

CREATE TABLE IF NOT EXISTS `adviser` (
  `AdviserId` varchar(6) NOT NULL,
  `AdviserName` varchar(60) NOT NULL,
  `DepartmentId` varchar(3) NOT NULL,
  `ContractNumber` varchar(18) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`AdviserId`),
  UNIQUE KEY `Email` (`Email`),
  KEY `AdvDeptFK` (`DepartmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adviser`
--

INSERT INTO `adviser` (`AdviserId`, `AdviserName`, `DepartmentId`, `ContractNumber`, `Email`) VALUES
('A00001', 'Md. Shohidul Islam', 'C06', '01921764949', 'shohidulcse@yahoo.com'),
('A00002', 'Md. Mahbub Alam', 'C06', '', 'emahbub.cse@gmail.com'),
('A00003', 'Md. Abdul Mannan', 'E05', '', 'mamannan91@duet.ac.bd'),
('A00004', 'Md. Zakir Hossain', 'E05', '', 'mzakir99@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `adviser_image`
--

CREATE TABLE IF NOT EXISTS `adviser_image` (
  `AdviserId` varchar(6) NOT NULL,
  `Image` longblob,
  `FileSize` int(10) unsigned DEFAULT NULL,
  `FileType` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`AdviserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adviser_image`
--

INSERT INTO `adviser_image` (`AdviserId`, `Image`, `FileSize`, `FileType`) VALUES
('A00001', NULL, NULL, NULL),
('A00002', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `completed_semister`
--

CREATE TABLE IF NOT EXISTS `completed_semister` (
  `StudentId` varchar(6) NOT NULL,
  `FirstYsecondS` varchar(15) NOT NULL,
  `SecondYfirstS` varchar(15) NOT NULL,
  `SecondYsecondS` varchar(15) NOT NULL,
  `ThirdYfirstS` varchar(15) NOT NULL,
  `ThirdYsecondS` varchar(15) NOT NULL,
  `FourthYfirstS` varchar(15) NOT NULL,
  `FourthYsecondS` varchar(15) NOT NULL,
  KEY `ComsemStdinfoFK` (`StudentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `completed_semister`
--

INSERT INTO `completed_semister` (`StudentId`, `FirstYsecondS`, `SecondYfirstS`, `SecondYsecondS`, `ThirdYfirstS`, `ThirdYsecondS`, `FourthYfirstS`, `FourthYsecondS`) VALUES
('074051', 'completed', 'completed', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete'),
('074040', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete'),
('074007', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete'),
('074057', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete', 'uncomplete');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `DepartmentId` varchar(3) NOT NULL,
  `DepartmentName` varchar(35) NOT NULL,
  `FacultyId` varchar(4) NOT NULL,
  `DegreeAward` varchar(3) NOT NULL,
  PRIMARY KEY (`DepartmentId`),
  KEY `DeptFacFK` (`FacultyId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DepartmentId`, `DepartmentName`, `FacultyId`, `DegreeAward`) VALUES
('B01', 'Biomedical Department', 'FM03', 'yes'),
('C01', 'Civil Engineering', 'FC01', 'yes'),
('C02', 'Chemistry', 'FC01', 'no'),
('C06', 'Computer Science & Engineering', 'FE02', 'yes'),
('E05', 'Electrical & Electronic Engineering', 'FE02', 'yes'),
('H09', 'Humanities', 'FM03', 'no'),
('M03', 'Mathematics', 'FC01', 'no'),
('M07', 'Mechanical Engineering', 'FM03', 'yes'),
('P04', 'Physics', 'FC01', 'no'),
('T08', 'Textile Engineering', 'FM03', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `StudentId` varchar(6) NOT NULL,
  `Year` varchar(3) NOT NULL,
  `Semister` varchar(3) NOT NULL,
  `GPA` float NOT NULL,
  `DownloadStatus` varchar(3) DEFAULT NULL,
  `CreditPerSemister` float NOT NULL,
  PRIMARY KEY (`StudentId`,`Year`,`Semister`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `FacultyId` varchar(4) NOT NULL,
  `FacultyName` varchar(4) NOT NULL,
  `Location` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`FacultyId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`FacultyId`, `FacultyName`, `Location`) VALUES
('FC01', 'CE', 'Gazipur'),
('FE02', 'EEE', 'Gazipur'),
('FM03', 'ME', 'Gazipur');

-- --------------------------------------------------------

--
-- Table structure for table `marks_info`
--

CREATE TABLE IF NOT EXISTS `marks_info` (
  `StudentId` varchar(6) NOT NULL,
  `session` varchar(8) DEFAULT NULL,
  `SubjectCode` varchar(15) NOT NULL,
  `SubjectOfYear` varchar(3) NOT NULL,
  `SubjectOfSemister` varchar(3) NOT NULL,
  `GPA` float DEFAULT '0',
  `GradeLetter` varchar(2) DEFAULT NULL,
  `Cardit` float NOT NULL,
  `Status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`StudentId`,`SubjectCode`),
  KEY `MrkinfoTotsubFK` (`SubjectCode`),
  KEY `MrkinfoStdinfoFK` (`StudentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marks_info`
--

INSERT INTO `marks_info` (`StudentId`, `session`, `SubjectCode`, `SubjectOfYear`, `SubjectOfSemister`, `GPA`, `GradeLetter`, `Cardit`, `Status`) VALUES
('074007', NULL, 'Ch-143', '1st', '2nd', 0, '0', 3, 'registered'),
('074007', NULL, 'Ch-144', '1st', '2nd', 0, NULL, 0.75, 'registered'),
('074007', NULL, 'CSE-111', '1st', '2nd', 0, NULL, 4, 'registered'),
('074007', NULL, 'CSE-112', '1st', '2nd', 0, NULL, 1.5, 'registered'),
('074007', NULL, 'CSE-114', '1st', '2nd', 0, NULL, 0.75, 'registered'),
('074007', NULL, 'Hum-143', '1st', '2nd', 0, NULL, 3, 'registered'),
('074007', NULL, 'Math-143', '1st', '2nd', 0, NULL, 4, 'registered'),
('074007', NULL, 'Ph-143', '1st', '2nd', 0, NULL, 3, 'registered'),
('074007', NULL, 'Ph-144', '1st', '2nd', 0, NULL, 0.75, 'registered'),
('074040', NULL, 'Ch-143', '1st', '2nd', 0, 'F', 3, 'registered'),
('074040', NULL, 'Ch-144', '1st', '2nd', 2, 'D', 0.75, 'registered'),
('074040', NULL, 'CSE-111', '1st', '2nd', 0, '0', 4, 'registered'),
('074040', NULL, 'CSE-112', '1st', '2nd', 0, '0', 1.5, 'registered'),
('074040', NULL, 'CSE-114', '1st', '2nd', 0, '0', 0.75, 'registered'),
('074040', NULL, 'Hum-143', '1st', '2nd', 0, '0', 3, 'registered'),
('074040', NULL, 'Math-143', '1st', '2nd', 0, '0', 4, 'registered'),
('074040', NULL, 'Ph-143', '1st', '2nd', 0, '0', 3, 'registered'),
('074040', NULL, 'Ph-144', '1st', '2nd', 0, '0', 0.75, 'registered'),
('074051', NULL, 'Ch-143', '1st', '2nd', 3, 'B', 3, 'registered'),
('074051', NULL, 'Ch-144', '1st', '2nd', 3, 'B', 0.75, 'registered'),
('074051', NULL, 'CSE-111', '1st', '2nd', 3.25, 'B+', 4, 'registered'),
('074051', NULL, 'CSE-112', '1st', '2nd', 2.75, 'B-', 1.5, 'registered'),
('074051', NULL, 'CSE-114', '1st', '2nd', 2, 'D', 0.75, 'registered'),
('074051', NULL, 'CSE-210', '2nd', '1st', 2.5, 'C+', 1.5, 'registered'),
('074051', NULL, 'CSE-211', '2nd', '1st', 3.5, 'A-', 3, 'registered'),
('074051', NULL, 'CSE-212', '2nd', '1st', 2.5, 'C+', 1.5, 'registered'),
('074051', NULL, 'CSE-213', '2nd', '1st', 4, 'A+', 3, 'registered'),
('074051', NULL, 'CSE-221', '2nd', '1st', 2.5, 'C+', 3, 'registered'),
('074051', NULL, 'CSE-222', '2nd', '1st', 4, 'A+', 0.75, 'registered'),
('074051', NULL, 'EEE-255', '2nd', '1st', 2.75, 'B-', 3, 'registered'),
('074051', NULL, 'EEE-256', '2nd', '1st', 3, 'B', 0.75, 'registered'),
('074051', NULL, 'Hum-143', '1st', '2nd', 3, 'B', 3, 'registered'),
('074051', NULL, 'Math-143', '1st', '2nd', 3.75, 'A', 4, 'registered'),
('074051', NULL, 'Math-241', '2nd', '1st', 2.75, 'B-', 4, 'registered'),
('074051', NULL, 'Ph-143', '1st', '2nd', 2.75, 'B-', 3, 'registered'),
('074051', NULL, 'Ph-144', '1st', '2nd', 2, 'D', 0.75, 'registered'),
('074057', NULL, 'Ch-143', '1st', '2nd', 3.25, 'B+', 3, 'registered'),
('074057', NULL, 'Ch-144', '1st', '2nd', 2.5, 'C+', 0.75, 'registered'),
('074057', NULL, 'CSE-111', '1st', '2nd', 0, '0', 4, 'registered'),
('074057', NULL, 'CSE-112', '1st', '2nd', 0, '0', 1.5, 'registered'),
('074057', NULL, 'CSE-114', '1st', '2nd', 0, '0', 0.75, 'registered'),
('074057', NULL, 'Hum-143', '1st', '2nd', 0, '0', 3, 'registered'),
('074057', NULL, 'Math-143', '1st', '2nd', 0, '0', 4, 'registered'),
('074057', NULL, 'Ph-143', '1st', '2nd', 0, '0', 3, 'registered'),
('074057', NULL, 'Ph-144', '1st', '2nd', 0, '0', 0.75, 'registered');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `RegistrationStarted` varchar(3) DEFAULT NULL,
  `ResultPublish` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `description`, `RegistrationStarted`, `ResultPublish`) VALUES
(4, 'Arif', 'Arifur Rahman Sazal', NULL, NULL),
(5, 'Registration Started', 'Registration Will be held 12/12/2012 to 25/12/2015. All student of 1st,2nd,3rd and 4th year are do this\r\n1)Paid registration fee\r\n2)Submit registration no\r\n3)Finally Submit', NULL, NULL),
(6, 'Registration Started', 'Registration Will be held 12/02/2012 to 25/02/2012. All student of 1st,2nd,3rd and 4th year are do this\r\n1)Paid registration fee\r\n2)Submit registration no\r\n3)Finally Submit', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password`
--

CREATE TABLE IF NOT EXISTS `password` (
  `Id` varchar(6) NOT NULL,
  `Password` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password`
--

INSERT INTO `password` (`Id`, `Password`) VALUES
('074001', 'd0Gyc6fAjKhUzAdrL5YtVQw33JmEvPo4cwz7BIHoA8APJWWe8fiah/flrITGwdfGbCdVeaFiUN0S4OH1FHPr4g=='),
('074004', 'jCAO5AY+XK+cPjvtHPPU2H8UIUV4TyzRByyI8fMMegeEdWXwyB0JWCx7OvLgUAHluplZr1X6VqRELrIjE8djsg=='),
('074007', 'huY4CgtT9/2wbfifH2ZGhzNUuumBRj/F5SVF8Amw8ioXLhZWT1AopTzpuGYY90ySSNMrrVmsLehKFFAmJoG9bQ=='),
('074009', 'tYZmSdE/8jziFCcaNFaun0I7Ahs+86ywp4W+UMXR/t93ZbYvy+rDOBuyMobXeZYuoqZI9hGlHgAIBFR3JpEoeA=='),
('074040', 'sVW3NHUYXCs/255SIa/lIlGLb6/DW4HXt+vvTzTZQbktBUmwclkTozH5ZvjuLoe0ag0Re5Byhzwib6hVUw2MTA=='),
('074051', '9/QwYOS+DeLFo5NR6PRqZsTrDXOQsgeXylRqyLiw+eaXURyq6Ue2yZTXCzhjvhuOz7+uJKwoissNWL3oqojTOg=='),
('074052', 'TqTFzqkZEWPSrNCVeI4J/XDWm9FTkW0O/KnwihXcSwUbZ56OzFvxoWfR0/D6gSuxsSWerY+2G3jSgYKlkf151Q=='),
('074053', 'O8r7mzcR1B34T1ZVrjINXa9VVOcRQ5FzNGa5VT77cc8KUakDoT2TmRPBFn9r+k23gB/uKQ3+fGZKrIqOJUbx4g=='),
('074057', 'Y1S4W/tnHI4GS/by8fAQ4lQxBVGE2X78H5Kte47aeEwR86FOyGKOQbqMb1seF4MKe9xa00KIwYzp7EWTlKMj0w=='),
('A00001', '9/QwYOS+DeLFo5NR6PRqZsTrDXOQsgeXylRqyLiw+eaXURyq6Ue2yZTXCzhjvhuOz7+uJKwoissNWL3oqojTOg=='),
('A00002', '2yfGgroklNSyPD9gs90T/9JhKSXoFawRESFN1zWFcXncAfV/wGLARwVKvhg8DKl6pAST10Di31Y2cb23VTdAZQ=='),
('A00003', 'GvxyFQlC7aLF2yiRGplOHQEzWRowV1EnpI7JuSQ3By/q9uf3m/5TIzdiHngVsVEeW45bOF2HtQjPqIL/o+mGLA=='),
('A00004', 'RLEkJfGI1ZqZovXiC9GwOEDN/2/qQewkC7kKzmqSnc5gBpSdjzGwc4Zq1x3H9Vh3OxbTE8nQUVY32w/mnEAoGw=='),
('R12345', 'rpmjod7KaaSFYQhN0A0LthVpz5FuALleNDy+cZRagwuhcZCGTeHjBx9kL9NkOJsdwWf4Ej2k8Ot2/fkuu9H0+A==');

-- --------------------------------------------------------

--
-- Table structure for table `registration_info`
--

CREATE TABLE IF NOT EXISTS `registration_info` (
  `StudentId` varchar(6) DEFAULT NULL,
  `AdviserId` varchar(6) DEFAULT NULL,
  `RegistrationStatus` varchar(15) DEFAULT NULL,
  `ReceiveNo` varchar(40) NOT NULL,
  `RequiredSubject` varchar(255) DEFAULT NULL,
  `TakenSubject` varchar(255) DEFAULT NULL,
  `YearSemister` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ReceiveNo`),
  KEY `ReginfoStdinfoFK` (`StudentId`),
  KEY `ReginfoAdvFK` (`AdviserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration_info`
--

INSERT INTO `registration_info` (`StudentId`, `AdviserId`, `RegistrationStatus`, `ReceiveNo`, `RequiredSubject`, `TakenSubject`, `YearSemister`) VALUES
('074051', 'A00001', 'registered', '123456', 'CSE-210,CSE-211,CSE-212,CSE-213,CSE-221,CSE-222,EEE-255,EEE-256,Math-241', 'CSE-210,CSE-211,CSE-212,CSE-213,CSE-221,CSE-222,EEE-255,EEE-256,Math-241', '2nd/1st'),
('074007', 'A00001', 'registered', '789542', 'Ch-143,Ch-144,CSE-111,CSE-112,CSE-114,Hum-143,Math-143,Ph-143,Ph-144', 'Ch-143,Ch-144,CSE-111,CSE-112,CSE-114,Hum-143,Math-143,Ph-143,Ph-144', '1st/2nd');

-- --------------------------------------------------------

--
-- Table structure for table `sessional`
--

CREATE TABLE IF NOT EXISTS `sessional` (
  `StudentId` varchar(6) NOT NULL,
  `SubjectCode` varchar(15) NOT NULL,
  `Assesment_1` float DEFAULT '0',
  `Assesment_2` float DEFAULT NULL,
  `Assesment_3` float DEFAULT NULL,
  `Assesment_4` float DEFAULT NULL,
  `Quize` float DEFAULT '0',
  `Attendance` float DEFAULT '0',
  `GPA` float DEFAULT NULL,
  `GradeLetter` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`StudentId`,`SubjectCode`),
  KEY `SessStdinfoFK` (`StudentId`),
  KEY `SessTotsubFK` (`SubjectCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessional`
--

INSERT INTO `sessional` (`StudentId`, `SubjectCode`, `Assesment_1`, `Assesment_2`, `Assesment_3`, `Assesment_4`, `Quize`, `Attendance`, `GPA`, `GradeLetter`) VALUES
('074040', 'Ch-144', 10, 0, 0, 0, 20, 10, 2, 'D'),
('074040', 'CSE-112', 0, 0, 0, 0, 0, 0, 0, '0'),
('074040', 'CSE-114', 0, 0, 0, 0, 0, 0, 0, '0'),
('074040', 'Ph-144', 0, 0, 0, 0, 0, 0, 0, '0'),
('074051', 'Ch-144', 10, 10, 10, 2, 30, 10, 3, 'B'),
('074051', 'CSE-112', 10, 8, 6, 3, 10, 20, 2.75, 'B-'),
('074051', 'CSE-114', 10, 10, 0, 6, 10, 8, 2, 'D'),
('074051', 'CSE-210', 10, 8, 5, 2, 10, 15, 2.5, 'C+'),
('074051', 'CSE-212', 8, 8, 5, 4, 15, 10, 2.5, 'C+'),
('074051', 'CSE-222', 10, 20, 10, 0, 30, 10, 4, 'A+'),
('074051', 'EEE-256', 2, 10, 8, 1, 30, 10, 3, 'B'),
('074051', 'Ph-144', 10, 9, 7, 0, 10, 5, 2, 'D'),
('074057', 'Ch-144', 10, 0, 0, 10, 20, 10, 2.5, 'C+'),
('074057', 'CSE-112', 0, 0, 0, 0, 0, 0, 0, '0'),
('074057', 'CSE-114', 0, 0, 0, 0, 0, 0, 0, '0'),
('074057', 'Ph-144', 0, 0, 0, 0, 0, 0, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `student_image`
--

CREATE TABLE IF NOT EXISTS `student_image` (
  `StudentId` varchar(6) NOT NULL,
  `Image` longblob,
  `FileSize` int(10) unsigned DEFAULT NULL,
  `FileType` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`StudentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_image`
--

INSERT INTO `student_image` (`StudentId`, `Image`, `FileSize`, `FileType`) VALUES
('074051', NULL, NULL, NULL),
('074052', NULL, NULL, NULL),
('074053', NULL, NULL, NULL),
('074057', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE IF NOT EXISTS `student_info` (
  `StudentId` varchar(6) NOT NULL,
  `StudentName` varchar(60) NOT NULL,
  `FathersName` varchar(60) NOT NULL,
  `MothersName` varchar(60) NOT NULL,
  `PresentAddress` text,
  `ParmanentAddress` text,
  `ContractNumber` varchar(18) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Sex` varchar(6) NOT NULL,
  `DepartmentId` varchar(3) NOT NULL,
  `AdviserId` varchar(6) DEFAULT NULL,
  `AdmitDate` date NOT NULL,
  PRIMARY KEY (`StudentId`),
  UNIQUE KEY `Email` (`Email`),
  KEY `StdinfoAdvFK` (`AdviserId`),
  KEY `StdinfoDeptFK` (`DepartmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`StudentId`, `StudentName`, `FathersName`, `MothersName`, `PresentAddress`, `ParmanentAddress`, `ContractNumber`, `Email`, `Sex`, `DepartmentId`, `AdviserId`, `AdmitDate`) VALUES
('074001', 'Md. Rabiul-alam', 'FFFFF', 'MMMM', '', '', '01722 988161', 'robi_alam@gmail.com', 'male', 'C06', 'A00001', '2008-02-14'),
('074004', 'Abdullah Al  Maruf', 'FFFFFF', 'MMMMM', '', '', '01818 252671', 'eng.maruf@gmail.com', 'male', 'C06', NULL, '2008-03-04'),
('074007', 'Md. Mamun', 'FFFFFF', 'MMMMM', '', '', '01714842862', 'mamun@gmail.com', 'male', 'C06', 'A00001', '2012-03-15'),
('074009', 'Md. Saidur', 'FFFFF', 'MMMM', '', '', '01723343613', 'saidur.duet@gmail.com', 'male', 'E05', 'A00003', '2008-02-06'),
('074040', 'Manish Chakma', 'FFFFFF', 'MMMMM', '', '', '01198277765', 'manish.chakma@gmail.com', 'male', 'C06', 'A00001', '2008-03-21'),
('074051', 'Arifur Rahman', 'Aziz', 'Mahmuda', '', '', '01721654450', 'arif.rahman2009@gmail.com', 'male', 'C06', 'A00001', '2008-03-08'),
('074052', 'Gaus Munsi', 'FFFFF', 'MMMM', '', '', '01710503240', 'gaus_duet_09@yahoo.com', 'male', 'C06', 'A00001', '2009-02-11'),
('074053', 'Sumona Sarker', 'FFFFF', 'MMMM', '', '', '01912728872', 'sumana_duet@yahoo.com', 'female', 'C06', 'A00001', '2009-02-12'),
('074057', 'Sudeept a Roy', 'FFFF', 'MMMM', '', '', '01710021744', 'sudeepta.duet@gmail.com', 'male', 'C06', 'A00001', '2008-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `theory`
--

CREATE TABLE IF NOT EXISTS `theory` (
  `StudentId` varchar(6) NOT NULL,
  `SubjectCode` varchar(15) NOT NULL,
  `ClassTest_1` float DEFAULT '0',
  `ClassTest_2` float DEFAULT '0',
  `ClassTest_3` float DEFAULT '0',
  `ClassTest_4` float DEFAULT '0',
  `ClassTest_5` float DEFAULT '0',
  `Attendance` float DEFAULT '0',
  `FinalExam` float DEFAULT '0',
  `GPA` float DEFAULT NULL,
  `GradeLetter` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`StudentId`,`SubjectCode`),
  KEY `TheoryStdinfoFK` (`StudentId`),
  KEY `TheoryTotsubFK` (`SubjectCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theory`
--

INSERT INTO `theory` (`StudentId`, `SubjectCode`, `ClassTest_1`, `ClassTest_2`, `ClassTest_3`, `ClassTest_4`, `ClassTest_5`, `Attendance`, `FinalExam`, `GPA`, `GradeLetter`) VALUES
('074007', 'Ch-143', 0, 0, 0, 0, 0, 0, 0, 0, '0'),
('074040', 'Ch-143', 10, 12, 14, 0, 0, 0, 10, 0, 'F'),
('074040', 'CSE-111', 0, 0, 0, 0, 0, 0, 0, 0, '0'),
('074040', 'Hum-143', 0, 0, 0, 0, 0, 0, 0, 0, '0'),
('074040', 'Math-143', 0, 0, 0, 0, 0, 0, 0, 0, '0'),
('074040', 'Ph-143', 0, 0, 0, 0, 0, 0, 0, 0, '0'),
('074051', 'Ch-143', 10, 15, 10, 12, 14, 30, 100, 3, 'B'),
('074051', 'CSE-111', 10, 15, 13, 10, 0, 0, 150, 3.25, 'B+'),
('074051', 'CSE-211', 10, 10, 10, 20, 0, 20, 150, 3.5, 'A-'),
('074051', 'CSE-213', 10, 15, 9, 8, 0, 25, 200, 4, 'A+'),
('074051', 'CSE-221', 10, 9, 2, 0, 0, 22, 120, 2.5, 'C+'),
('074051', 'EEE-255', 1, 12, 14, 14, 3, 20, 111, 2.75, 'B-'),
('074051', 'Hum-143', 10, 10, 13, 14, 0, 0, 140, 3, 'B'),
('074051', 'Math-143', 15, 9, 13, 10, 0, 0, 190, 3.75, 'A'),
('074051', 'Math-241', 12, 12, 14, 5, 0, 20, 115, 2.75, 'B-'),
('074051', 'Ph-143', 13, 14, 8, 10, 0, 0, 120, 2.75, 'B-'),
('074057', 'Ch-143', 10, 0, 15, 0, 10, 30, 140, 3.25, 'B+'),
('074057', 'CSE-111', 0, 0, 0, 0, 0, 0, 0, 0, '0'),
('074057', 'Hum-143', 0, 0, 0, 0, 0, 0, 0, 0, '0'),
('074057', 'Math-143', 0, 0, 0, 0, 0, 0, 0, 0, '0'),
('074057', 'Ph-143', 0, 0, 0, 0, 0, 0, 0, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `total_subject`
--

CREATE TABLE IF NOT EXISTS `total_subject` (
  `SubjectCode` varchar(15) NOT NULL,
  `SubjectTitle` varchar(60) NOT NULL,
  `DepartmentId` varchar(3) NOT NULL,
  `SubjectOfYear` varchar(3) NOT NULL,
  `SubjectOfSemister` varchar(3) NOT NULL,
  `Cardit` float NOT NULL,
  PRIMARY KEY (`SubjectCode`),
  KEY `TotsubDeptFK` (`DepartmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `total_subject`
--

INSERT INTO `total_subject` (`SubjectCode`, `SubjectTitle`, `DepartmentId`, `SubjectOfYear`, `SubjectOfSemister`, `Cardit`) VALUES
('Ch-143', 'Chemistry-II', 'C06', '1st', '2nd', 3),
('Ch-144', 'Chemistry-II Sessional', 'C06', '1st', '2nd', 0.75),
('CSE-111', 'Computer Basic & Programming', 'C06', '1st', '2nd', 4),
('CSE-112', 'Computer Basic & Programming Sessional', 'C06', '1st', '2nd', 1.5),
('CSE-114', 'Drawing & CAD Project Sessional', 'C06', '1st', '2nd', 0.75),
('CSE-210', 'Visual Programming Sessional', 'C06', '2nd', '1st', 1.5),
('CSE-211', 'Stryctured & Object Oriented Programming', 'C06', '2nd', '1st', 3),
('CSE-212', 'Stryctured & Object Oriented Programming Sessional', 'C06', '2nd', '1st', 1.5),
('CSE-213', 'Discrete Mathematics', 'C06', '2nd', '1st', 3),
('CSE-221', 'Digital Logic Design', 'C06', '2nd', '1st', 3),
('CSE-222', 'Digital Logic Design Sessionam', 'C06', '2nd', '1st', 0.75),
('EEE-255', 'Electronics Devices & Circuits', 'C06', '2nd', '1st', 3),
('EEE-256', 'Electronics Devices & Circuits Sessional', 'C06', '2nd', '1st', 0.75),
('Hum-143', 'English and Economics', 'C06', '1st', '2nd', 3),
('Math-143', 'Mathematics-II', 'C06', '1st', '2nd', 4),
('Math-241', 'Mathematics-III', 'C06', '2nd', '1st', 4),
('Ph-143', 'Physics-II', 'C06', '1st', '2nd', 3),
('Ph-144', 'Physics-II Sessional', 'C06', '1st', '2nd', 0.75);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adviser`
--
ALTER TABLE `adviser`
  ADD CONSTRAINT `AdvDeptFK` FOREIGN KEY (`DepartmentId`) REFERENCES `department` (`DepartmentId`);

--
-- Constraints for table `completed_semister`
--
ALTER TABLE `completed_semister`
  ADD CONSTRAINT `ComsemStdinfoFK` FOREIGN KEY (`StudentId`) REFERENCES `student_info` (`StudentId`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `DeptFacFK` FOREIGN KEY (`FacultyId`) REFERENCES `faculty` (`FacultyId`);

--
-- Constraints for table `download`
--
ALTER TABLE `download`
  ADD CONSTRAINT `DownloadStdinfoFK` FOREIGN KEY (`StudentId`) REFERENCES `student_info` (`StudentId`);

--
-- Constraints for table `marks_info`
--
ALTER TABLE `marks_info`
  ADD CONSTRAINT `MrkinfoStdinfoFK` FOREIGN KEY (`StudentId`) REFERENCES `student_info` (`StudentId`),
  ADD CONSTRAINT `MrkinfoTotsubFK` FOREIGN KEY (`SubjectCode`) REFERENCES `total_subject` (`SubjectCode`);

--
-- Constraints for table `registration_info`
--
ALTER TABLE `registration_info`
  ADD CONSTRAINT `ReginfoAdvFK` FOREIGN KEY (`AdviserId`) REFERENCES `adviser` (`AdviserId`),
  ADD CONSTRAINT `ReginfoStdinfoFK` FOREIGN KEY (`StudentId`) REFERENCES `student_info` (`StudentId`);

--
-- Constraints for table `sessional`
--
ALTER TABLE `sessional`
  ADD CONSTRAINT `SessStdinfoFK` FOREIGN KEY (`StudentId`) REFERENCES `student_info` (`StudentId`),
  ADD CONSTRAINT `SessTotsubFK` FOREIGN KEY (`SubjectCode`) REFERENCES `total_subject` (`SubjectCode`);

--
-- Constraints for table `student_info`
--
ALTER TABLE `student_info`
  ADD CONSTRAINT `StdinfoAdvFK` FOREIGN KEY (`AdviserId`) REFERENCES `adviser` (`AdviserId`),
  ADD CONSTRAINT `StdinfoDeptFK` FOREIGN KEY (`DepartmentId`) REFERENCES `department` (`DepartmentId`);

--
-- Constraints for table `theory`
--
ALTER TABLE `theory`
  ADD CONSTRAINT `TheoryStdinfoFK` FOREIGN KEY (`StudentId`) REFERENCES `student_info` (`StudentId`),
  ADD CONSTRAINT `TheoryTotsubFK` FOREIGN KEY (`SubjectCode`) REFERENCES `total_subject` (`SubjectCode`);

--
-- Constraints for table `total_subject`
--
ALTER TABLE `total_subject`
  ADD CONSTRAINT `TotsubDeptFK` FOREIGN KEY (`DepartmentId`) REFERENCES `department` (`DepartmentId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
