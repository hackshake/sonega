-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2016 at 06:49 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friend1` varchar(50) NOT NULL,
  `friend2` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `notification` int(1) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend1`, `friend2`, `status`, `notification`, `date`) VALUES
('abhi1994', 'shash95', 1, 1, '2016-04-29'),
('abhi1994', 'ak6', 1, 1, '2016-04-29'),
('abhi1994', 'janitor', 1, 1, '2016-04-29'),
('abhi1994', 'vd', 1, 1, '2016-04-29'),
('dewa', 'shash95', 1, 1, '2016-05-01'),
('shash95', 'ak6', 1, 1, '2016-05-01'),
('shash95', 'balder', 1, 0, '2016-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`) VALUES
(1, 'Counter Strike'),
(2, 'Age of Empires-2'),
(3, 'Age Of Empires-3'),
(4, 'Call Of Duty'),
(5, 'Fifa 13'),
(6, 'Fifa 14'),
(7, 'Fifa 15'),
(8, 'Fifa 16'),
(9, 'WWE 2K16'),
(10, 'Blur'),
(11, 'Dota 2');

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `id` int(2) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`id`, `name`) VALUES
(2, 'A Block'),
(3, 'B Block'),
(4, 'B-Annex'),
(5, 'C Block'),
(6, 'D Block'),
(7, 'D Annex'),
(8, 'E Block'),
(9, 'F Block'),
(10, 'G Block'),
(11, 'H Block'),
(12, 'J Block'),
(13, 'K Block'),
(14, 'L Block'),
(15, 'M Block'),
(16, 'N Block'),
(17, 'P Block');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `uname` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `block` varchar(2) NOT NULL,
  `room` int(4) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`uname`, `password`, `fname`, `lname`, `dob`, `gmail`, `block`, `room`, `alias`, `image`) VALUES
('shash95', '', 'Shashwat', 'Shukla', '1995-08-15', 'shashwatshukla.2013@vit.ac.in', '3', 237, '', '1931281_968059446615402_3174551355575591935_n.jpg'),
('abhi1994', '', 'Abhishek', 'Dey', '1994-12-14', 'abhishek.dey2013@vit.ac.in', '11', 943, '', 'IMG_1128.JPG'),
('janitor', '', 'Nikhil', 'Verma', '1995-01-13', 'nikhilverma.2013@vit.ac.in', '2', 406, '', 'default.jpg'),
('vd', '', 'Vidyanshu', 'Das', '1994-08-16', 'vidyanshu.2013@vit.ac.in', '3', 237, '', 'IMG_1418.JPG'),
('ak6', '', 'Akshay', 'Anand', '1994-12-25', 'akshay.2013@vit.ac.in', '', 0, '', 'default.jpg'),
('baua', '', 'Geetesh', 'Tripathi', '1994-12-14', 'geetesh.2013@vit.ac.in', '', 0, '', 'IMG_1180.JPG'),
('balder', '', 'Rishav', 'Pathak', '1994-07-11', 'rishav.2013@vit.ac.in', '', 0, '', 'default.jpg'),
('alphaQ', '', 'Aditya', 'Gupta', '1995-10-11', 'aditya.2013@vit.ac.in', '', 0, '', 'default.jpg'),
('dewa', '', 'Abhishek', 'Dewangan', '1994-01-31', 'dewangan.2013@vit.ac.in', '11', 943, '', 'default.jpg'),
('aunty', '', 'Pranay', 'Kumar', '1994-11-11', 'pranay.2013@vit.ac.in', '', 0, '', 'default.jpg'),
('sourabh', '', 'sourabh', 'sharma', '1994-03-25', 'sourabh.sharma2013@vit.ac.in', '14', 703, '', 'default.jpg'),
('sethji', '', 'Nishant', 'nigam', '1994-11-07', 'nishant.nigam2013@vit.ac.in', '14', 947, 'nish', 'default.jpg'),
('sourabh1', '', 'satish', 'satish', '2016-05-17', 'satish1@vit.ac.in', '', 0, '122', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `userid` varchar(20) NOT NULL,
  `parameter` varchar(10) NOT NULL,
  `game1` int(1) NOT NULL DEFAULT '0',
  `game2` int(1) NOT NULL DEFAULT '0',
  `game3` int(1) NOT NULL DEFAULT '0',
  `game4` int(1) NOT NULL DEFAULT '0',
  `game5` int(1) NOT NULL DEFAULT '0',
  `game6` int(1) NOT NULL DEFAULT '0',
  `game7` int(1) NOT NULL DEFAULT '0',
  `game8` int(1) NOT NULL DEFAULT '0',
  `game9` int(1) NOT NULL DEFAULT '0',
  `game10` int(1) NOT NULL DEFAULT '0',
  `game11` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`userid`, `parameter`, `game1`, `game2`, `game3`, `game4`, `game5`, `game6`, `game7`, `game8`, `game9`, `game10`, `game11`) VALUES
('abhi1994', 'acbd', 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0),
('ak6', 'acbd', 1, 1, 0, 0, 0, 0, 1, 0, 1, 0, 1),
('alphaQ', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('aunty', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('balder', 'acd', 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 1),
('baua', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('dewa', 'b', 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0),
('janitor', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('sethji', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('shash95', 'acbd', 1, 1, 1, 0, 1, 1, 1, 0, 1, 0, 0),
('sourabh', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('sourabh1', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('vd', 'cbd', 0, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `uname` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`uname`, `password`, `active`) VALUES
('shash95', 'hello123', 1),
('abhi1994', 'deyvil', 1),
('janitor', 'munich', 1),
('vd', 'vdeee', 1),
('ak6', 'gaming', 1),
('baua', 'chotu', 1),
('balder', 'pathak', 1),
('alphaQ', 'dotaguy', 1),
('dewa', 'ojas', 1),
('aunty', 'aunty', 1),
('sourabh', '1234', 1),
('sethji', '12345', 1),
('sourabh1', 'ss', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `sender` varchar(20) NOT NULL,
  `reciever` varchar(20) NOT NULL,
  `reqid` int(7) NOT NULL,
  `game` int(2) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `notification` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`sender`, `reciever`, `reqid`, `game`, `message`, `date`, `status`, `notification`) VALUES
('abhi1994', 'shash95', 3, 1, 'H Block vs B Block?', '2016-04-26', 1, 1),
('shash95', 'ak6', 4, 1, 'Bhai khelo yaar!', '2016-04-25', 1, 1),
('vd', 'shash95', 5, 2, '2 v 2?', '2016-04-25', 1, 1),
('shash95', 'alphaQ', 6, 5, 'hello', '2016-04-27', 1, 1),
('sourabh', 'vd', 7, 6, 'aaja launde', '2016-04-25', 1, 1),
('sourabh', 'sourabh1', 8, 1, 'ddd', '2016-03-15', 0, 0),
('abhi1994', 'janitor', 10, 4, 'Bring it on!', '2016-05-13', 1, 1),
('abhi1994', 'shash95', 11, 1, 'Best of 5?', '2016-05-27', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`reqid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `reqid` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
