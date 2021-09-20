CREATE DATABASE IF NOT EXISTS `lms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lms`;

DROP TABLE IF EXISTS `hr`;
CREATE TABLE IF NOT EXISTS `hr` (
  `hr_id` varchar(50) NOT NULL,
  `hr_name` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50)  NOT NULL,
  `password` varchar(256)  NOT NULL,
  PRIMARY KEY (`hr_id`)
) ;

DROP TABLE IF EXISTS `engineer`;
CREATE TABLE IF NOT EXISTS `engineer` (
  `engineer_id` varchar(50) NOT NULL,
  `engineer_name` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50)  NOT NULL,
  `status` varchar(50)  NOT NULL,
  `password` varchar(256)  NOT NULL,
  PRIMARY KEY (`engineer_id`)
) ;
DROP TABLE IF EXISTS `learner_enrollment`;
CREATE TABLE IF NOT EXISTS `learner_enrollment` (
  `enrollment_id` varchar(50) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  PRIMARY KEY (`enrollment_id`)
) ;
DROP TABLE IF EXISTS `trainer_assignment`;
CREATE TABLE IF NOT EXISTS `trainer_assignment` (
  `engineer_id` varchar(50) NOT NULL,
  `class_id` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`, `class_id`)
) ;
DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_id` varchar(50) NOT NULL,
  `course_name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`course_id`)
) ;
DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `section_id` varchar(50) NOT NULL,
  `class_id` varchar(256) NOT NULL,
  `section_name` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`section_id`)
) ;
DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_id` varchar(50) NOT NULL ,
  `course_io` varchar(50) NOT NULL,
  `capacity` int NOT NULL,
  `day` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_register_date` date NOT NULL,
  `end_register_date` date NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `no_of_sections` int NOT NULL,
  PRIMARY KEY (`class_id`)
); 
DROP TABLE IF EXISTS `qualified_courses`;
CREATE TABLE IF NOT EXISTS `qualified_courses` (
  `engineer_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`, `course_id`)
) ;
DROP TABLE IF EXISTS `course_status`;
CREATE TABLE IF NOT EXISTS `course_status` (
  `engineer_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`, `course_id`)
) ;
DROP TABLE IF EXISTS `section_status`;
CREATE TABLE IF NOT EXISTS `section_status` (
  `section_id` varchar(50) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `mark` int NOT NULL,
  PRIMARY KEY (`section_id`, `engineer_id`)
) ;
DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `quiz_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  `passing_mark` int NOT NULL,
  `time_limit` int NOT NULL,
  PRIMARY KEY (`quiz_id`)
) ;
DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `quiz_id` varchar(50) NOT NULL,
  `question_no` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `option_1` varchar(50) NOT NULL,
  `option_2` varchar(50) NOT NULL,
  `option_3` varchar(50) NOT NULL,
  `option_4` varchar(50) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`quiz_id`, `question_no`)
) ;
DROP TABLE IF EXISTS `learning_material`;
CREATE TABLE IF NOT EXISTS `learning_material` (
  `learning_material_id` varchar(50) NOT NULL,
  `section_id` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `type` varchar(50) NOT NULL,
  `document_name` varchar(256) NOT NULL,
  PRIMARY KEY (`learning_material_id`)
) ;
DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `forum_id` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`forum_id`)
) ;
DROP TABLE IF EXISTS `thread`;
CREATE TABLE IF NOT EXISTS `forum` (
  `thread_id` varchar(50) NOT NULL,
  `forum_id` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `engineer_id` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`)
) ;
DROP TABLE IF EXISTS `course_prerequisite`;
CREATE TABLE IF NOT EXISTS `course_prerequisite` (
  `course_id` varchar(50) NOT NULL,
  `prerequisite` varchar(50) NOT NULL,
  PRIMARY KEY (`course_id`, `prerequisite`)
) ;
DROP TABLE IF EXISTS `engineer_badges`;
CREATE TABLE IF NOT EXISTS `engineer_badges` (
  `engineer_id` varchar(50) NOT NULL,
  `badges_name` varchar(50) NOT NULL,
  PRIMARY KEY (`engineer_id`, `badges_name`)
) ;


-- Table structure for table `engineer`
INSERT INTO `engineer` VALUES
('1', 'kankan', 'kankanzhou123@lms.com', "kankan", "zhou", "learner", "123"),
('2', 'lilykong', 'lilykong123@lms.com', "lily", "kong", "trainer", "123");


-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/  
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 13, 2020 at 05:50 AM
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
