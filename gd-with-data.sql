-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 10:34 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gd-esport`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `ID` varchar(10) NOT NULL,
  `author` varchar(255) NOT NULL DEFAULT 'A csapatunk',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teammembers`
--

CREATE TABLE `teammembers` (
  `ID` varchar(10) NOT NULL,
  `teamID` varchar(10) NOT NULL,
  `memberID` varchar(10) NOT NULL,
  `owner` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teammembers`
--

INSERT INTO `teammembers` (`ID`, `teamID`, `memberID`, `owner`) VALUES
('02oeF3h4pl', 'DC839YGqZu', 'nhHn0xgDKw', 0),
('0Y43R0iLDY', 'T92fg0xXCS', 'CvMnpt1WAg', 0),
('1hPtyVF0m1', 'nx4XgPWUSS', 'aaVlqFfDPn', 1),
('5JXdYKOv0C', '5oKCLxxrQx', 'aEchJiutKc', 0),
('678r8gD2mR', 'vVrjda8x0j', 'mHWidJn1Ux', 0),
('bGcAdc2unT', 'DC839YGqZu', 'InY54ouKqG', 1),
('DAlvb5RZWJ', '5oKCLxxrQx', 'ERpFAZIIEz', 1),
('env7xickoM', 'nx4XgPWUSS', 'LCLaRL8aom', 0),
('f3Okc3gNfn', 'vVrjda8x0j', 'hmxDsoKYto', 0),
('GNyaCHAmDi', 'nx4XgPWUSS', 'uWi0eAYqu1', 0),
('JgYnn5Pmaz', 'vVrjda8x0j', 'S6Q8b4GaBM', 0),
('L8t8Y9TkQj', 'DC839YGqZu', 'U7kPCUCWkv', 0),
('LlOsnwHsS1', '5oKCLxxrQx', 'gWAUzhMrwB', 0),
('nHGrk0uLeb', 'nx4XgPWUSS', 'PWUJW9TRsJ', 0),
('nXojA581Mk', 'vVrjda8x0j', '7ZjzqIEkSc', 0),
('PSKaJ5nmD0', 'DC839YGqZu', 'G2AvadIw0F', 0),
('r9NICN5jSz', 'vVrjda8x0j', 'nlzCmW1G1S', 1),
('SF87YkKeW4', '5oKCLxxrQx', 'aHzZztFnea', 0),
('SzUoakCv8T', 'nx4XgPWUSS', '0MqUbM4hMy', 0),
('XiQyo1KVZM', 'T92fg0xXCS', 'NN5K5PTaIK', 1),
('XNbXRCwJvA', 'DC839YGqZu', 'Yr14Liyd4e', 0),
('xtuVe3EQJ4', '5oKCLxxrQx', 'lf65orFyDA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `ID` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `registered` date NOT NULL,
  `invite` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`ID`, `name`, `registered`, `invite`) VALUES
('5oKCLxxrQx', 'TeamPG', '2022-02-24', 'oa6PAnbujQ'),
('DC839YGqZu', 'TheSiegers', '2022-02-24', 'szMEKgjhDJ'),
('nx4XgPWUSS', 'RSG', '2022-02-24', '5ywSbz4Fzx'),
('T92fg0xXCS', 'ByteFight', '2022-02-24', '9wZHQgVgTQ'),
('vVrjda8x0j', 'RecruitMains', '2022-02-24', '3zQxBN8G2T');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `ID` varchar(10) NOT NULL,
  `userID` varchar(10) NOT NULL,
  `joinedTeam` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` text NOT NULL,
  `county` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `hash`, `email`, `fullname`, `county`, `birthdate`, `admin`) VALUES
('0MqUbM4hMy', 'PredatoR', '$2y$10$Z4TKsqftk1mb4.349R0CiuENcoTFx1WasLWuVD8PcfEPyr5i9rtRG', 'ragadozo@gdesport.com', 'Albert Fazekas', 'veszprem', '1998-07-02', 0),
('7ZjzqIEkSc', 'JettoMan', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'jajokubson@gdesport.com', 'Endre Szilágyi', 'jasznagykunszolnok', '1999-03-02', 0),
('a9LavaBVom', 'ComicSans', '$2y$10$By44EFAkSZfNpp.9e8F0Ve.cYcTG4UMmcblNS./.CIYjg0OEBJbIm', 'taleunder@gdesport.com', 'Vasas Ferenc', 'pest', '2003-10-25', 0),
('aaVlqFfDPn', '_DonQ_', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'dongihote@gdesport.com', 'Benedek Sándor', 'pest', '2000-06-21', 0),
('aEchJiutKc', 'TiciaN', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'tician@gdesport.com', 'Kis Ticián', 'bacskiskun', '2002-12-23', 0),
('aHzZztFnea', 'Mr_Worldwide', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'pitbull@gdesport.com', 'Kovács Márton', 'zala', '2004-01-13', 0),
('CvMnpt1WAg', 'xXLétraXx', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'matyaskiraly@gdesport.com', 'Mátyás László', 'vas', '1988-12-15', 0),
('ERpFAZIIEz', 'hicupalot', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'pinter@gdesport.com', 'Zétény Pintér', 'borsodabaujzemplen', '1999-11-27', 0),
('G2AvadIw0F', 'DTB___', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'klombo@gdesport.com', 'Benedek Varga', 'budapest', '2002-10-08', 0),
('gWAUzhMrwB', 'abham', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'horikristof@gdesport.com', 'Kristóf Horváth', 'borsodabaujzemplen', '2004-07-11', 0),
('hmxDsoKYto', 'Krisztofer', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'fromro@gdesport.com', 'Kristóf Takács', 'hajdubihar', '2000-11-02', 0),
('InY54ouKqG', 'yoraZiBear', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'zamtup@gdesport.com', 'Bence Vincze', 'hajdubihar', '1985-05-31', 0),
('LCLaRL8aom', 'skydeszka', '$2y$10$By44EFAkSZfNpp.9e8F0Ve.cYcTG4UMmcblNS./.CIYjg0OEBJbIm', 'deszka@gmail.com', 'Ormándi Norbert', 'bacskiskun', '2003-09-29', 0),
('lf65orFyDA', 'XaleSS', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'jajo@gdesport.com', 'Zsombor Kis', 'jasznagykunszolnok', '2004-08-29', 0),
('mHWidJn1Ux', 'hIrEdKiLlEr', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'galuska@gdesport.com', 'Kevin Gál', 'baranya', '1999-05-23', 0),
('nhHn0xgDKw', 'balintgamer_2003', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'kiskoma@gdesport.com', 'Kis Bálint', 'zala', '2003-12-03', 0),
('nlzCmW1G1S', 'tromWolf', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'repture@gdesport.com', 'László Fodor', 'veszprem', '1985-10-28', 0),
('NN5K5PTaIK', 'pu$$yKiller', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'vereshurka@gdesport.com', 'Mihály Veres', 'vas', '1992-04-01', 0),
('PWUJW9TRsJ', 'Trond', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'loporta@gdesport.com', 'Milán Deák', 'bekes', '1989-05-11', 0),
('rziG5xC9oZ', '', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'foglaltmar@gdesport.com', 'János Pataki', 'budapest', '1987-12-02', 0),
('S6Q8b4GaBM', 'Jost_OpecZ', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'semonic@gdesport.com', 'Zoltán Pintér', 'budapest', '1999-05-23', 0),
('U7kPCUCWkv', 'idan', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'fodrospitec@gdesport.com', 'Noel Fodor', 'borsodabaujzemplen', '2003-12-14', 0),
('uWi0eAYqu1', 'MikeTheSpike', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'deakferi@gdesport.com', 'Kevin Deák', 'csongrad', '2003-10-14', 0),
('Yr14Liyd4e', 'YesSir', '$2y$10$IPmrfQDWNiK/ecOk4mRPjuayMxriVJ1HZtEcTn3RBlGX1gYIa.hCa', 'olisrac@gdesport.com', 'Kiss Olivér', 'bekes', '2002-03-17', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `teammembers`
--
ALTER TABLE `teammembers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MemberID` (`memberID`),
  ADD KEY `TeamID` (`teamID`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Invite` (`invite`) USING BTREE,
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teammembers`
--
ALTER TABLE `teammembers`
  ADD CONSTRAINT `MemberID` FOREIGN KEY (`memberID`) REFERENCES `users` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `TeamID` FOREIGN KEY (`teamID`) REFERENCES `teams` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
