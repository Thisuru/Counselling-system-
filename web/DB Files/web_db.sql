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

CREATE TABLE `chatmessages` (
  `id` int(11) NOT NULL,
  `counsellor` varchar(50) NOT NULL,
  `patient` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatmessages`
--

INSERT INTO `chatmessages` (`id`, `counsellor`, `patient`, `message`, `timestamp`) VALUES
(17, 'Tharindu', 'roshana', 'hi', '2019-07-01 05:11:57'),
(18, 'Tharindu', 'roshana', 'damn', '2019-07-01 05:12:13'),
(19, 'Tharindu', 'roshana', 'how are you?', '2019-07-01 05:20:36'),
(20, 'Tharindu', 'roshana', 'wow', '2019-07-01 05:23:06'),
(21, 'Tharindu', 'roshana', 'whats is my name?', '2019-07-01 09:30:39'),
(22, 'Tharindu', 'roshana', 'whats is my name?', '2019-07-02 14:30:22'),
(23, 'Tharindu', 'roshana', 'hi', '2019-07-03 13:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `music_id` int(11) NOT NULL,
  `music_path` varchar(500) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`music_id`, `music_path`, `admin_email`, `admin_name`, `title`, `description`, `date_time`, `category`) VALUES
(2, '16209938502643_4cd4.mp3', 'tharindu@gmail.com', 'Tharindu', 'Music Title', 'desc', '2019-May-19_12:23', NULL),
(3, '43358393Alan Walker - Faded [128].mp3', 'tharindu@gmail.com', 'Tharindu', 'second', 'test', '2019-May-19_12:24', 'study_mode_music'),
(4, '1633405548Daddy_Ai_Kale.mp3', 'tharindu@gmail.com', 'Tharindu', 'title 3', 'hey', '2019-May-19_12:30', NULL),
(5, '1470197519bb3.mp3', 'aaa@aaa.com', 'Tharindu', 'new', 'new', '2019-Jun-22_01:12', 'encourage_music'),
(6, '168699000704 Sorry.mp3', 'tharindu@gmail.com', 'Tharindu', 'hey', 'Crocodile buns', '2019-Jul-03_12:49', 'encourage_music'),
(7, '1909204890Daddy_Ai_Kale.mp3', 'tharindu@gmail.com', 'Tharindu', 'Test Music', 'Music desc', '2019-Jul-03_03:31', 'meditation_music');

-- --------------------------------------------------------

--
-- Table structure for table `news_feed`
--

CREATE TABLE `news_feed` (
  `article_no` int(11) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `photo_path` varchar(500) NOT NULL,
  `date_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_feed`
--

INSERT INTO `news_feed` (`article_no`, `admin_email`, `admin_name`, `description`, `photo_path`, `date_time`) VALUES
(21, 'tharindu@gmail.com', 'Tharindu', 'hey there', '125791644back.png', '2019-May-18_08:11'),
(22, 'tharindu@gmail.com', 'Tharindu', 'Description goes here', 'male-reporter.png', '2019-May-18_08:21'),
(23, 'tharindu@gmail.com', 'Tharindu', 'Description goes hereDescription goes hereDescription goes hereDescription goes hereDescription goes hereDescription goes hereDescription goes hereDescription goes here', '2053559457wall2.png', '2019-May-18_08:38'),
(24, 'aaa@aaa.com', 'Tharindu', 'new', '537609415back.png', '2019-Jun-22_01:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `dob`, `gender`, `account_type`, `email`, `password`) VALUES
('Tharindu', '23/05/2019', 'Male', 'Counsellor', 'aa@aa.com', '123'),
('Tharindu', '01/06/2019', 'Male', 'Patient', 'aaa@aaa.com', '123'),
('hey', '07/05/2019', 'Female', 'Counsellor', 'hey@hey.com', '123'),
('Tharindu', '07/05/2019', 'Male', 'Counsellor', 'rtharinduroshana@yahoo.com', '123'),
('Tharindu', '07/05/2019', 'Male', 'Admin', 'tharindu@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatmessages`
--
ALTER TABLE `chatmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`music_id`);

--
-- Indexes for table `news_feed`
--
ALTER TABLE `news_feed`
  ADD PRIMARY KEY (`article_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatmessages`
--
ALTER TABLE `chatmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `music_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `news_feed`
--
ALTER TABLE `news_feed`
  MODIFY `article_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
