-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2019 at 07:55 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatmessages`
--

CREATE TABLE if not exists `chatmessages` (
  `id` int(11) NOT NULL auto_increment,      
  `counsellor` varchar(50) NOT NULL,
  `patient` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatmessages`
--

INSERT INTO `chatmessages` (`counsellor`, `patient`, `message`, `timestamp`) VALUES
('Tharindu', 'roshana', 'hi', '2019-07-01 05:11:57'),
('Tharindu', 'roshana', 'damn', '2019-07-01 05:12:13'),
('Tharindu', 'roshana', 'how are you?', '2019-07-01 05:20:36'),
('Tharindu', 'roshana', 'wow', '2019-07-01 05:23:06'),
('Tharindu', 'roshana', 'whats is my name?', '2019-07-01 09:30:39'),
('Tharindu', 'roshana', 'whats is my name?', '2019-07-02 14:30:22'),
('Tharindu', 'roshana', 'hi', '2019-07-03 13:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE if not exists `music` (
  `music_id` int(11) NOT NULL auto_increment,
  `music_path` varchar(500) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  PRIMARY KEY  (`music_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`music_path`, `admin_email`, `admin_name`, `title`, `description`, `date_time`, `category`) VALUES
('16209938502643_4cd4.mp3', 'tharindu@gmail.com', 'Tharindu', 'Music Title', 'desc', '2019-May-19_12:23', NULL),
('43358393Alan Walker - Faded [128].mp3', 'tharindu@gmail.com', 'Tharindu', 'second', 'test', '2019-May-19_12:24', 'study_mode_music'),
('1633405548Daddy_Ai_Kale.mp3', 'tharindu@gmail.com', 'Tharindu', 'title 3', 'hey', '2019-May-19_12:30', NULL),
('1470197519bb3.mp3', 'aaa@aaa.com', 'Tharindu', 'new', 'new', '2019-Jun-22_01:12', 'encourage_music'),
('168699000704 Sorry.mp3', 'tharindu@gmail.com', 'Tharindu', 'hey', 'Crocodile buns', '2019-Jul-03_12:49', 'encourage_music'),
('1909204890Daddy_Ai_Kale.mp3', 'tharindu@gmail.com', 'Tharindu', 'Test Music', 'Music desc', '2019-Jul-03_03:31', 'meditation_music');

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE TABLE if not exists `news_feed` (
  `article_no` int(11) NOT NULL auto_increment,
  `admin_email` varchar(50) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `photo_path` varchar(500) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  PRIMARY KEY  (`article_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_feed`
--

INSERT INTO `news_feed` (`admin_email`, `admin_name`, `description`, `photo_path`, `date_time`) VALUES
('tharindu@gmail.com', 'Tharindu', 'hey there', '125791644back.png', '2019-May-18_08:11'),
('tharindu@gmail.com', 'Tharindu', 'Description goes here', 'male-reporter.png', '2019-May-18_08:21'),
('tharindu@gmail.com', 'Tharindu', 'Description goes hereDescription goes hereDescription goes hereDescription goes hereDescription goes hereDescription goes hereDescription goes hereDescription goes here', '2053559457wall2.png', '2019-May-18_08:38'),
('aaa@aaa.com', 'Tharindu', 'new', '537609415back.png', '2019-Jun-22_01:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

-- CREATE TABLE if not exists `users` (
--   `name` varchar(50) NOT NULL,
--   `dob` varchar(50) NOT NULL,
--   `gender` varchar(50) NOT NULL,
--   `account_type` varchar(50) NOT NULL,
--   `email` varchar(50) NOT NULL,
--   `password` varchar(50) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

-- INSERT INTO `users` (`name`, `dob`, `gender`, `account_type`, `email`, `password`) VALUES
-- ('Tharindu', '23/05/2019', 'Male', 'Counsellor', 'aa@aa.com', '123'),
-- ('Tharindu', '01/06/2019', 'Male', 'Patient', 'aaa@aaa.com', '123'),
-- ('hey', '07/05/2019', 'Female', 'Counsellor', 'hey@hey.com', '123'),
-- ('Tharindu', '07/05/2019', 'Male', 'Counsellor', 'rtharinduroshana@yahoo.com', '123'),
-- ('Tharindu', '07/05/2019', 'Male', 'Admin', 'tharindu@gmail.com', '123');



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Table structure for table `admin`
--

CREATE TABLE if not exists `admin` (
  `adminId` int(11) NOT NULL auto_increment,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY  (`adminId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counselor`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@gmail.com','admn123');

-- DROP TABLE counselor;

CREATE TABLE if not exists `counselor`(
  `counselorId` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `state` BIT(1) NOT NULL,
  PRIMARY KEY  (`counselorId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counselor`
--

INSERT INTO `counselor` (`name`, `dob`, `gender`, `category`, `email`, `password`,`state`) VALUES
('counselor', '23/05/2019', 'Male', 'category1', 'counselor@gmail.com', 'test123','0');

CREATE TABLE if not exists `patient`(
  `patientId` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY  (`patientId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `patient` (`name`, `dob`, `gender`, `email`, `password`) VALUES
('patient', '23/05/2019', 'Male', 'patient@gmail.com', 'test123');


CREATE TABLE if not exists `patient_marks`(
   `questionId` int(11) NOT NULL auto_increment,
  `patientId` int(11) NOT NULL,
  `marks` varchar(50) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  PRIMARY KEY  (`questionId`),
  FOREIGN KEY (patientId)
        REFERENCES patient(patientId)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;