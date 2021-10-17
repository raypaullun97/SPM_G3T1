-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 17, 2021 at 02:58 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_register_date` date NOT NULL,
  `end_register_date` date NOT NULL,
  `engineer_id` varchar(50) DEFAULT NULL,
  `no_of_sections` int(11) DEFAULT NULL,
  PRIMARY KEY (`class_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `course_id`, `capacity`, `day`, `start_time`, `end_time`, `start_date`, `end_date`, `start_register_date`, `end_register_date`, `engineer_id`, `no_of_sections`) VALUES
('G1', 'IS216', 3, 3, '16:00:00', '17:00:00', '2021-12-03', '2021-12-05', '2021-10-16', '2021-11-30', '3', NULL),
('G1', 'IS424', 4, 3, '14:30:00', '17:30:00', '2021-11-27', '2021-12-12', '2021-10-01', '2021-11-12', '3', NULL),
('G1', 'IS460', 1, 2, '12:00:00', '15:15:00', '2021-10-17', '2021-10-31', '2021-09-30', '2021-10-10', '3', NULL),
('G2', 'IS212', 40, 5, '12:00:00', '15:15:00', '2021-10-16', '2021-12-01', '2021-09-30', '2021-11-12', '3', 4),
('G2', 'IS424', 1, 3, '14:30:00', '17:30:00', '2021-11-27', '2021-12-12', '2021-10-01', '2021-10-17', '3', NULL),
('G3', 'IS212', 3, 2, '14:30:00', '17:30:00', '2021-10-16', '2021-12-12', '2021-09-28', '2021-11-12', '3', NULL),
('G3', 'IS424', 1, 3, '14:30:00', '17:30:00', '2021-10-17', '2021-10-19', '2021-10-01', '2021-10-16', '3', NULL),
('G4', 'IS212', 1, 3, '12:00:00', '15:15:00', '2021-12-10', '2021-12-07', '2021-09-30', '2021-11-12', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` varchar(50) NOT NULL,
  `course_name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `description`) VALUES
('IS111', 'Programming', 'Good'),
('IS211', 'IDP', 'Ideation'),
('IS212', 'SPM', 'Software Project Management'),
('IS216', 'WAD2', 'Code and Code'),
('IS424', 'DM', 'Data Mining'),
('IS446', 'MCRA', 'Managing Customer Relations Management'),
('IS453', 'FA', 'Financial Analytics'),
('IS460', 'ML', 'Machine Learning');

-- --------------------------------------------------------

--
-- Table structure for table `course_prerequisite`
--

DROP TABLE IF EXISTS `course_prerequisite`;
CREATE TABLE IF NOT EXISTS `course_prerequisite` (
  `course_id` varchar(50) NOT NULL,
  `prerequisite` varchar(50) NOT NULL,
  PRIMARY KEY (`course_id`,`prerequisite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_prerequisite`
--

INSERT INTO `course_prerequisite` (`course_id`, `prerequisite`) VALUES
('IS216', 'IS111'),
('IS446', 'IS424');

-- --------------------------------------------------------

--
-- Table structure for table `course_status`
--

DROP TABLE IF EXISTS `course_status`;
CREATE TABLE IF NOT EXISTS `course_status` (
  `engineer_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_status`
--

INSERT INTO `course_status` (`engineer_id`, `course_id`, `status`) VALUES
('1', 'IS111', 'Completed'),
('1', 'IS211', 'Completed'),
('1', 'IS460', 'Completed'),
('2', 'IS212', 'Completed'),
('4', 'IS111', 'Completed'),
('5', 'IS111', 'Completed'),
('6', 'IS111', 'Completed'),
('6', 'IS216', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `engineer`
--

DROP TABLE IF EXISTS `engineer`;
CREATE TABLE IF NOT EXISTS `engineer` (
  `engineer_id` varchar(50) NOT NULL,
  `engineer_name` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`engineer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `engineer`
--

INSERT INTO `engineer` (`engineer_id`, `engineer_name`, `username`, `first_name`, `last_name`, `status`, `password`) VALUES
('1', 'weilun', 'lwl_1997@hotmail.com', 'wl', 'lim', 'engineer', '123'),
('2', 'lilykong', 'lilykong123@lms.com', 'lily', 'kong', 'engineer', '123'),
('3', 'kankan', 'kankanzhou123@lms.com', 'kankan', 'zhou', 'senior engineer', '123'),
('4', 'jia cheng', 'jcteo@lms.com', 'jc', 'teo', 'engineer', '123'),
('5', 'ian', 'ian@lms.com', 'ian', 'leong', 'engineer', '123'),
('6', 'cheyrl', 'cheryl@lms.com', 'cheryl', 'chee', 'engineer', '123'),
('7', 'jia xiang', 'jiaxiang@lms.com', 'jiaxiang', 'leow', 'engineer', '123'),
('8', 'testing', 'testing@lms.com', 'test', 'ing', 'engineer', '123');

-- --------------------------------------------------------

--
-- Table structure for table `engineer_badges`
--

DROP TABLE IF EXISTS `engineer_badges`;
CREATE TABLE IF NOT EXISTS `engineer_badges` (
  `engineer_id` varchar(50) NOT NULL,
  `badge_name` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`,`badge_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `forum_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`forum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hr`
--

DROP TABLE IF EXISTS `hr`;
CREATE TABLE IF NOT EXISTS `hr` (
  `hr_id` varchar(50) NOT NULL,
  `hr_name` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`hr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `learner_enrollment`
--

DROP TABLE IF EXISTS `learner_enrollment`;
CREATE TABLE IF NOT EXISTS `learner_enrollment` (
  `enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
  `engineer_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`enrollment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `learner_enrollment`
--

INSERT INTO `learner_enrollment` (`enrollment_id`, `engineer_id`, `course_id`, `class_id`, `status`, `type`) VALUES
(34, '2', 'IS212', 'G4', 'Enrolled', NULL),
(35, '2', 'IS424', 'G2', 'Enrolled', NULL),
(36, '1', 'IS460', 'G1', 'Enrolled', NULL),
(60, '1', 'IS424', 'G3', 'Pending', 'Self');

-- --------------------------------------------------------

--
-- Table structure for table `learning_material`
--

DROP TABLE IF EXISTS `learning_material`;
CREATE TABLE IF NOT EXISTS `learning_material` (
  `learning_material_id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `type` varchar(50) NOT NULL,
  `document_name` varchar(256) NOT NULL,
  PRIMARY KEY (`learning_material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `learning_material`
--

INSERT INTO `learning_material` (`learning_material_id`, `section_id`, `class_id`, `course_id`, `description`, `type`, `document_name`) VALUES
(1, 4, 'G2', 'IS212', 'Week 1', '.pptx', 'Data Mining'),
(2, 5, 'G2', 'IS212', 'Week 2', '.pptx', 'Data Mining2'),
(3, 6, 'G2', 'IS212', 'for week 3', '.pptx', 'Data Mining3');

-- --------------------------------------------------------

--
-- Table structure for table `learning_material_complete`
--

DROP TABLE IF EXISTS `learning_material_complete`;
CREATE TABLE IF NOT EXISTS `learning_material_complete` (
  `learning_material_id` varchar(50) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  PRIMARY KEY (`learning_material_id`,`engineer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `learning_material_status`
--

DROP TABLE IF EXISTS `learning_material_status`;
CREATE TABLE IF NOT EXISTS `learning_material_status` (
  `learning_material_id` varchar(50) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`learning_material_id`,`engineer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` varchar(50) NOT NULL,
  `thread_id` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `post_time` time NOT NULL,
  `post_date` date NOT NULL,
  PRIMARY KEY (`post_id`,`thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qualified_courses`
--

DROP TABLE IF EXISTS `qualified_courses`;
CREATE TABLE IF NOT EXISTS `qualified_courses` (
  `engineer_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qualified_courses`
--

INSERT INTO `qualified_courses` (`engineer_id`, `course_id`) VALUES
('3', 'IS111'),
('3', 'IS211'),
('3', 'IS216'),
('3', 'IS424'),
('3', 'IS446'),
('3', 'IS453'),
('8', 'IS424');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `quiz_id` int(11) NOT NULL,
  `question_id` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `option_1` varchar(50) NOT NULL,
  `option_2` varchar(50) NOT NULL,
  `option_3` varchar(50) NOT NULL,
  `option_4` varchar(50) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`quiz_id`,`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`quiz_id`, `question_id`, `description`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `type`) VALUES
(1, '1', 'Did iron man die?', 'True', 'False', 'NIL', 'NIL', 'Answer 1', 'True or False'),
(1, '2', 'Did spiderman die?', 'True', 'False', 'NIL', 'NIL', 'Answer 2', 'True or False');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `quiz_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `section_id` int(11) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `passing_mark` int(11) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `quiz_name` varchar(50) NOT NULL,
  PRIMARY KEY (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `course_id`, `class_id`, `section_id`, `engineer_id`, `passing_mark`, `time_limit`, `type`, `quiz_name`) VALUES
(1, 'IS212', 'G2', 4, '3', 1, 1, '', 'MARVEL'),
(2, 'IS212', 'G2', 5, '3', 2, 4, '', 'MARVEL');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`section_id`,`class_id`,`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `class_id`, `course_id`, `section_name`, `description`) VALUES
(1, 'G1', 'IS424', 'Session 1', 'for week 1'),
(2, 'G1', 'IS424', 'Session 2', 'for week 2'),
(3, 'G1', 'IS424', 'Session 3', 'for week 3'),
(4, 'G2', 'IS212', 'Session 1', 'for week 1'),
(5, 'G2', 'IS212', 'Session 2', 'for week 2'),
(6, 'G2', 'IS212', 'Session 3', 'for week 3');

-- --------------------------------------------------------

--
-- Table structure for table `section_quiz_grade`
--

DROP TABLE IF EXISTS `section_quiz_grade`;
CREATE TABLE IF NOT EXISTS `section_quiz_grade` (
  `attempts` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `mark` int(11) NOT NULL,
  `quiz_id` varchar(50) NOT NULL,
  PRIMARY KEY (`attempts`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section_quiz_grade`
--

INSERT INTO `section_quiz_grade` (`attempts`, `section_id`, `engineer_id`, `class_id`, `course_id`, `mark`, `quiz_id`) VALUES
(8, 4, '1', 'G2', 'IS212', 1, 'IS212G2S4'),
(9, 4, '1', 'G2', 'IS212', 1, 'IS212G2S4'),
(10, 4, '1', 'G2', 'IS212', 0, 'IS212G2S4'),
(11, 4, '1', 'G2', 'IS212', 1, 'IS212G2S4'),
(12, 4, '1', 'G2', 'IS212', 0, 'IS212G2S4'),
(13, 4, '1', 'G2', 'IS212', 0, 'IS212G2S4'),
(14, 4, '1', 'G2', 'IS212', 2, 'IS212G2S4'),
(15, 4, '1', 'G2', 'IS212', 1, 'IS212G2S4'),
(16, 4, '1', 'G2', 'IS212', 2, 'IS212G2S4'),
(17, 4, '1', 'G2', 'IS212', 1, 'IS212G2S4'),
(18, 4, '1', 'G2', 'IS212', 2, 'IS212G2S4');

-- --------------------------------------------------------

--
-- Table structure for table `section_status`
--

DROP TABLE IF EXISTS `section_status`;
CREATE TABLE IF NOT EXISTS `section_status` (
  `section_id` int(11) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `mark` int(11) NOT NULL,
  PRIMARY KEY (`section_id`,`engineer_id`,`class_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section_status`
--

INSERT INTO `section_status` (`section_id`, `engineer_id`, `class_id`, `course_id`, `mark`) VALUES
(1, '1', 'G1', 'IS424', 0),
(2, '1', 'G1', 'IS424', 0),
(3, '1', 'G1', 'IS424', 0);

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

DROP TABLE IF EXISTS `thread`;
CREATE TABLE IF NOT EXISTS `thread` (
  `thread_id` varchar(50) NOT NULL,
  `forum_id` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  PRIMARY KEY (`thread_id`,`forum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trainer_assignment`
--

DROP TABLE IF EXISTS `trainer_assignment`;
CREATE TABLE IF NOT EXISTS `trainer_assignment` (
  `engineer_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`,`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
