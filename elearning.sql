-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 11:44 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity_log`
--

CREATE TABLE `tbl_activity_log` (
  `ID` int(11) NOT NULL,
  `USER_ID` varchar(20) NOT NULL,
  `ACTION` text NOT NULL,
  `DATE` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE `tbl_announcement` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(30) NOT NULL,
  `CONTENT` text NOT NULL,
  `USER_ID` varchar(30) NOT NULL,
  `CLASS` varchar(30) NOT NULL,
  `DATE` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answers`
--

CREATE TABLE `tbl_answers` (
  `ID` int(11) NOT NULL,
  `STUDENT_ID` int(11) NOT NULL,
  `QUESTION_ID` int(11) NOT NULL,
  `QUIZ_ID` int(11) NOT NULL,
  `USER_ANSWER` varchar(30) NOT NULL,
  `CORRECT_ANSWER` varchar(30) NOT NULL,
  `DATE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assignment`
--

CREATE TABLE `tbl_assignment` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(30) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `UPLOADER` varchar(30) NOT NULL,
  `CLASS_ID` varchar(30) NOT NULL,
  `FILE_NAME` text NOT NULL,
  `PATH` text NOT NULL,
  `DATE` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `CLASS_ID` int(11) NOT NULL,
  `CLASS_CODE` varchar(30) NOT NULL,
  `SUBJECT_ID` int(11) NOT NULL,
  `FACULTY_ID` varchar(11) NOT NULL,
  `SCHOOL_YEAR_ID` varchar(11) NOT NULL,
  `SEMESTER` varchar(11) NOT NULL,
  `DATE` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class_student`
--

CREATE TABLE `tbl_class_student` (
  `CLASS_STUDENT_ID` int(11) NOT NULL,
  `CLASS_ID` varchar(11) NOT NULL,
  `STUDENT_ID` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty`
--

CREATE TABLE `tbl_faculty` (
  `FACULTY_ID` varchar(30) NOT NULL,
  `FIRST_NAME` varchar(30) NOT NULL,
  `LAST_NAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `IMAGE` text,
  `STATUS` varchar(11) NOT NULL,
  `DATE` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions`
--

CREATE TABLE `tbl_questions` (
  `ID` int(11) NOT NULL,
  `QUIZ_ID` int(11) NOT NULL,
  `QUESTION` text NOT NULL,
  `CHOICES_A` varchar(30) NOT NULL,
  `CHOICES_B` varchar(30) NOT NULL,
  `CHOICES_C` varchar(30) NOT NULL,
  `CHOICES_D` varchar(30) NOT NULL,
  `ANSWER` varchar(30) NOT NULL,
  `DATE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_questions`
--

INSERT INTO `tbl_questions` (`ID`, `QUIZ_ID`, `QUESTION`, `CHOICES_A`, `CHOICES_B`, `CHOICES_C`, `CHOICES_D`, `ANSWER`, `DATE`) VALUES
(3, 2, '1 plus 1', '3', '1', '9', '2', 'D', '2018-01-26 06:04 AM'),
(4, 2, 'What is my name', 'Tom', 'Mat', 'Ken', 'Krizo', 'B', '2018-01-26 10:02 PM'),
(5, 3, '1 plus 1', 'asd', 'asd', 'asd', 'asdad', 'A', '2019-05-04 11:51 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quizes`
--

CREATE TABLE `tbl_quizes` (
  `ID` int(11) NOT NULL,
  `QUIZ_TITLE` text NOT NULL,
  `CLASS_ID` int(11) NOT NULL,
  `TEACHER_ID` int(11) NOT NULL,
  `DATE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_status`
--

CREATE TABLE `tbl_quiz_status` (
  `ID` int(11) NOT NULL,
  `QUIZ_ID` int(11) NOT NULL,
  `STUDENT_ID` int(11) NOT NULL,
  `ITEMS` varchar(30) NOT NULL,
  `SCORE` varchar(30) NOT NULL,
  `STATUS` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school_yr`
--

CREATE TABLE `tbl_school_yr` (
  `ID` int(11) NOT NULL,
  `SCHOOL_YEAR` varchar(20) NOT NULL,
  `STATUS` varchar(20) NOT NULL,
  `DATE` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_school_yr`
--

INSERT INTO `tbl_school_yr` (`ID`, `SCHOOL_YEAR`, `STATUS`, `DATE`) VALUES
(1, '2017-2018', 'ACTIVE', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `STUDENT_ID` varchar(30) NOT NULL,
  `FIRST_NAME` varchar(30) NOT NULL,
  `LAST_NAME` varchar(30) NOT NULL,
  `COURSE` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `IMAGE` text,
  `STATUS` varchar(11) NOT NULL,
  `DATE` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `SUBJECT_ID` int(11) NOT NULL,
  `SUBJECT_CODE` varchar(11) NOT NULL,
  `SUBJECT_TITLE` varchar(30) NOT NULL,
  `DATE` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `USER_ID` varchar(30) NOT NULL,
  `FIRST_NAME` varchar(30) DEFAULT NULL,
  `LAST_NAME` varchar(30) DEFAULT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `DATE` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`USER_ID`, `FIRST_NAME`, `LAST_NAME`, `PASSWORD`, `DATE`) VALUES
('admin', 'admin', '', 'admin', '2019-05-17 08:03 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_log`
--

CREATE TABLE `tbl_user_log` (
  `ID` int(11) NOT NULL,
  `USER_ID` varchar(20) NOT NULL,
  `DATE` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_log`
--

INSERT INTO `tbl_user_log` (`ID`, `USER_ID`, `DATE`) VALUES
(285, 'admin', '2019-05-23 12:11 PM'),
(284, 'admin', '2019-05-21 03:31 PM'),
(283, 'admin', '2019-05-21 03:31 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_answers`
--
ALTER TABLE `tbl_answers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_assignment`
--
ALTER TABLE `tbl_assignment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`CLASS_ID`);

--
-- Indexes for table `tbl_class_student`
--
ALTER TABLE `tbl_class_student`
  ADD PRIMARY KEY (`CLASS_STUDENT_ID`);

--
-- Indexes for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  ADD PRIMARY KEY (`FACULTY_ID`);

--
-- Indexes for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_quizes`
--
ALTER TABLE `tbl_quizes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_quiz_status`
--
ALTER TABLE `tbl_quiz_status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_school_yr`
--
ALTER TABLE `tbl_school_yr`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`STUDENT_ID`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`SUBJECT_ID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Indexes for table `tbl_user_log`
--
ALTER TABLE `tbl_user_log`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_activity_log`
--
ALTER TABLE `tbl_activity_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=418;

--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_answers`
--
ALTER TABLE `tbl_answers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_assignment`
--
ALTER TABLE `tbl_assignment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `CLASS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_class_student`
--
ALTER TABLE `tbl_class_student`
  MODIFY `CLASS_STUDENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_quizes`
--
ALTER TABLE `tbl_quizes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quiz_status`
--
ALTER TABLE `tbl_quiz_status`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_school_yr`
--
ALTER TABLE `tbl_school_yr`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `SUBJECT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user_log`
--
ALTER TABLE `tbl_user_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
