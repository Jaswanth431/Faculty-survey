-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2022 at 10:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faculty_survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty_data`
--

CREATE TABLE `faculty_data` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `section` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_data`
--

INSERT INTO `faculty_data` (`id`, `name`, `subject`, `section`) VALUES
(9, 'MR. Ram', 'PHYSICS', 'A1'),
(10, 'MR K Rhagav', 'CHEMISTRY', 'A1'),
(11, 'Madhu Mohan', 'TELUGU', 'A1'),
(12, 'Ram Mohan', 'ENGLISH', 'A1'),
(13, 'Mr Rajendra prasad', 'MATHEMATICS', 'A1'),
(14, 'Veera Raghavendra Rao', 'INFORMATION TECHNOLOGY', 'A1');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` int(10) NOT NULL,
  `clg_id` varchar(10) NOT NULL,
  `hall_ticket` int(12) NOT NULL,
  `section` varchar(8) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `clg_id`, `hall_ticket`, `section`, `name`) VALUES
(7, 'O170431', 12345678, 'A1', 'Jadda Jaswanth kumar'),
(8, 'O170703', 11122233, 'A1', 'Sikhinam Ajay kumar'),
(9, 'O170453', 11111111, 'A1', 'bavireddy nagababu');

-- --------------------------------------------------------

--
-- Table structure for table `survey_data`
--

CREATE TABLE `survey_data` (
  `id` int(10) NOT NULL,
  `clg_id` varchar(10) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `faculty` varchar(50) NOT NULL,
  `q1` varchar(20) NOT NULL,
  `q2` varchar(20) NOT NULL,
  `q3` varchar(20) NOT NULL,
  `q4` varchar(20) NOT NULL,
  `q5` varchar(20) NOT NULL,
  `q6` varchar(20) NOT NULL,
  `q7` varchar(20) NOT NULL,
  `q8` varchar(20) NOT NULL,
  `q9` varchar(20) NOT NULL,
  `q10` varchar(20) NOT NULL,
  `comments` varchar(200) NOT NULL,
  `avg` float NOT NULL,
  `submitted` varchar(5) NOT NULL,
  `section` varchar(10) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_data`
--

INSERT INTO `survey_data` (`id`, `clg_id`, `subject`, `faculty`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `comments`, `avg`, `submitted`, `section`, `time`) VALUES
(1, 'O170431', 'MATHEMATICS', 'Mr Rajendra prasad', 'good', 'good', 'good', 'very_poor', 'poor', 'poor', 'poor', 'fair', 'fair', 'fair', 'hhhh', 2.8, 'yes', 'A1', '2022-07-13 13:53:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty_data`
--
ALTER TABLE `faculty_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_data`
--
ALTER TABLE `survey_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faculty_data`
--
ALTER TABLE `faculty_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202022;

--
-- AUTO_INCREMENT for table `survey_data`
--
ALTER TABLE `survey_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
