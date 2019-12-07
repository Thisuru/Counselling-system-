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
  `treatmentScore` int(11) NOT NULL, 
  PRIMARY KEY  (`counselorId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counselor`
--

INSERT INTO `counselor` (`name`, `dob`, `gender`, `category`, `email`, `password`,`state`) VALUES
('counselor', '23/05/2019', 'Male', 'category1', 'counselor@gmail.com', 'test123','0');

-- DROP TABLE `patient`

CREATE TABLE if not exists `patient`(
  `patientId` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `IsAnswered` BIT(1) NOT NULL,
  PRIMARY KEY  (`patientId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `patient` (`name`, `dob`, `gender`, `email`, `password`,`IsAnswered`) VALUES
('patient', '23/05/2019', 'Male', 'patient@gmail.com', 'test123',false);


CREATE TABLE if not exists `patient_marks`(
   `markId` int(11) NOT NULL auto_increment,
  `patientId` int(11) NOT NULL,
  `marks` varchar(50) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  PRIMARY KEY  (`markId`),
  FOREIGN KEY (patientId)
        REFERENCES patient(patientId)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE if not exists `questionnaire`(
  `questionId` int(11) NOT NULL auto_increment,
  `question` varchar(250) NOT NULL,
  `answer1` varchar(250) NOT NULL,
  `answer2` varchar(250) NOT NULL,
  `answer3` varchar(250) NOT NULL,
  `answer4` varchar(250) NOT NULL, 
  PRIMARY KEY  (`questionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('TestQ', 'testA1', 'testA2', 'test3', 'test4'),
('TestQ', 'testA1', 'testA2', 'test3', 'test4');
INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 1', 'I do not feel sad', 'I feel sad', 'I am sad all the time and I can not snap out of it', 'I am so sad and unhappy that I can not stand it');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 2', 'I am not particularly discouraged about the future', 'I feel discouraged about the future', 'I feel I have nothing to look forward to', 'I feel the future is hopeless and that things cannot improve');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 3', 'I do not feel like a failure', 'I feel I have failed more than the average person', 'As I look back on my life, all I can see is a lot of failures', 'I feel I am a complete failure as a person');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 4', 'I get as much satisfaction out of things as I used to', 'I don not enjoy things the way I used to', 'I don not get real satisfaction out of anything anymore', 'I am dissatisfied or bored with everything');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 5', 'I don not feel particularly guilty', 'I feel guilty a good part of the time', 'I feel quite guilty most of the time', 'I feel guilty all of the time');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 6', 'I don not feel I am being punished', 'I feel I may be punished', 'I expect to be punished', 'I feel I am being punished');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 7', 'I don not feel disappointed in myself', 'I am disappointed in myself', 'I am disgusted with myself', 'I hate myself');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 8', 'I don not feel I am any worse than anybody else', 'I am critical of myself for my weaknesses or mistakes', 'I blame myself all the time for my faults', 'I blame myself for everything bad that happens');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 9', 'I don not have any thoughts of killing myself', 'I have thoughts of killing myself, but I would not carry them out', 'I would like to kill myself', 'I would kill myself if I had the chance');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 10', 'I don not cry any more than usual', 'I cry more now than I used to', 'I cry all the time now', 'I used to be able to cry, but now I can not cry even though I want to');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 11', 'I am no more irritated by things than I ever was', 'I am slightly more irritated now than usual', 'I am quite annoyed or irritated a good deal of the time', 'I feel irritated all the time');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 12', 'I am no more irritated by things than I ever was', 'I am slightly more irritated now than usual', 'I am quite annoyed or irritated a good deal of the time', 'I feel irritated all the time');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 13', 'I make decisions about as well as I ever could', 'I put off making decisions more than I used to', 'I have greater difficulty in making decisions more than I used to', 'I can not make decisions at all anymore');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 14', 'I don not feel that I look any worse than I used to', 'I am worried that I am looking old or unattractive', 'I feel there are permanent changes in my appearance that make me look unattractive', 'I believe that I look ugly');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 15', 'I can work about as well as before', 'It takes an extra effort to get started at doing something', 'I have to push myself very hard to do anything', 'I can not do any work at all');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 16', 'I can sleep as well as usual', 'I don not sleep as well as I used to', 'I wake up 1-2 hours earlier than usual and find it hard to get back to sleep', 'I wake up several hours earlier than I used to and cannot get back to sleep');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 17', 'I don not get more tired than usual', 'I get tired more easily than I used to', 'I get tired from doing almost anything', 'I am too tired to do anything');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 18', 'My appetite is no worse than usual', 'My appetite is not as good as it used to be', 'My appetite is much worse now', 'I have no appetite at all anymore');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 19', 'I haven not lost much weight, if any, lately', 'I have lost more than five pounds', 'I have lost more than ten pounds', 'I have lost more than fifteen pounds');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 20', 'I am no more worried about my health than usual', 'I am worried about physical problems like aches, pains, upset stomach, or constipation', 'I am very worried about physical problems and it is hard to think of much else', 'I am so worried about my physical problems that I cannot think of anything else');

INSERT INTO `questionnaire` (`question`, `answer1`, `answer2`, `answer3`, `answer4`) VALUES
('Question 21', 'I have not noticed any recent change in my interest in sex', 'I am less interested in sex than I used to be', 'I have almost no interest in sex', 'I have lost interest in sex completely');



CREATE TABLE if not exists `answers`(
  `patientId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `date_time` varchar(250) NOT NULL,
  `answer` varchar(250) NOT NULL,
  `score` varchar(250) NOT NULL,
    FOREIGN KEY (patientId)
        REFERENCES patient(patientId)
        ON DELETE CASCADE,
      FOREIGN KEY (questionId)
        REFERENCES questionnaire(questionId)
        ON DELETE CASCADE  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE if not exists `patient_select_counselor`(
  `patientId` int(11) NOT NULL,
  `counselorId` int(11) NOT NULL,
  `date_time` varchar(50) NOT NULL,
    FOREIGN KEY (patientId)
        REFERENCES patient(patientId)
        ON DELETE CASCADE,
      FOREIGN KEY (counselorId)
        REFERENCES counselor(counselorId)
        ON DELETE CASCADE  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



