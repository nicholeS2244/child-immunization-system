-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2022 at 01:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `child_immune_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `email`, `username`, `password`) VALUES
(1, '', 'admin', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `chart`
--

CREATE TABLE `chart` (
  `chart_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `dose` int(11) NOT NULL,
  `healthcare_id` int(11) NOT NULL,
  `dateofvaccination` date NOT NULL,
  `healthcenter_id` int(11) NOT NULL,
  `vaccinated` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chart`
--

INSERT INTO `chart` (`chart_id`, `child_id`, `vaccine_id`, `dose`, `healthcare_id`, `dateofvaccination`, `healthcenter_id`, `vaccinated`) VALUES
(389, 92, 1, 1, 1, '2022-04-13', 1, 'yes'),
(390, 94, 4, 2, 2, '2020-04-14', 1, 'no'),
(391, 92, 1, 2, 1, '2022-04-18', 1, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `child_tbl`
--

CREATE TABLE `child_tbl` (
  `child_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `dateofbirth` date NOT NULL,
  `placeofbirth` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `fathername` varchar(50) NOT NULL,
  `mothername` varchar(50) NOT NULL,
  `birthheight` int(11) NOT NULL,
  `birthweight` int(11) NOT NULL,
  `sex` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `child_tbl`
--

INSERT INTO `child_tbl` (`child_id`, `parent_id`, `firstname`, `lastname`, `middlename`, `dateofbirth`, `placeofbirth`, `address`, `fathername`, `mothername`, `birthheight`, `birthweight`, `sex`) VALUES
(92, 22, 'Amit', 'Patil', 'Ayush', '2008-02-01', 'Mumbai', 'Mumbai', 'Ayush', 'Anita', 3, 20, 'male'),
(93, 22, 'Amita', 'Patil', 'Ayush', '2010-02-01', 'Mumbai', 'Mumbai', 'Ayush', 'Anita', 2, 15, 'female'),
(94, 18, 'Vivek', 'Rane', 'Vishal', '2020-03-02', 'Dadar', 'Dadar', 'Vishal', 'Vinita', 2, 20, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `id` int(11) NOT NULL,
  `hf` varchar(300) NOT NULL,
  `benefits` varchar(300) NOT NULL,
  `reminders` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guide`
--

INSERT INTO `guide` (`id`, `hf`, `benefits`, `reminders`) VALUES
(12, 'Fruit and vegetables \r\n                    <br>Fruit and vegetables give your child energy, vitamins, anti-oxidants, fibre and water.', 'These nutrients help to protect your baby from diseases later in life, including diseases like heart disease, stroke and some cancers.\r\n                    It’s a good idea to offer your baby fruit and vegetables at every meal and \r\n                    for snacks. Try to choose fruit and vegies of d', 'Wash fruit to remove dirt or chemicals, and leave any edible skin on, because the skin contains nutrients too.');

-- --------------------------------------------------------

--
-- Table structure for table `healthcare_info`
--

CREATE TABLE `healthcare_info` (
  `healthcare_id` int(11) NOT NULL,
  `vaccinatorname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `healthcare_info`
--

INSERT INTO `healthcare_info` (`healthcare_id`, `vaccinatorname`) VALUES
(1, 'Dr Vijay'),
(2, 'Dr Rashmika');

-- --------------------------------------------------------

--
-- Table structure for table `healthcenter_tbl`
--

CREATE TABLE `healthcenter_tbl` (
  `healthcenter_id` int(11) NOT NULL,
  `healthcenter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `healthcenter_tbl`
--

INSERT INTO `healthcenter_tbl` (`healthcenter_id`, `healthcenter`) VALUES
(1, 'kisumu'),
(2, 'nairobi');

-- --------------------------------------------------------

--
-- Table structure for table `parent_tbl`
--

CREATE TABLE `parent_tbl` (
  `parent_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phonenum` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent_tbl`
--

INSERT INTO `parent_tbl` (`parent_id`, `firstname`, `lastname`, `middlename`, `address`, `phonenum`, `email`, `username`, `password`) VALUES
(18, 'Vishal', 'Rane', 'Viraj', 'Vasai', '12341234', 'vishalrane@gmail.com', 'vishalrane', '1234'),
(22, 'Ayush', 'Patil', 'Shubhash', 'Palghar', '12341234', 'ayushpatil@protonmail.com', 'ayushpatil', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine`
--

CREATE TABLE `vaccine` (
  `vaccine_id` int(11) NOT NULL,
  `vaccinename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccine`
--

INSERT INTO `vaccine` (`vaccine_id`, `vaccinename`) VALUES
(1, 'BCG'),
(2, 'Hepatitis B'),
(3, 'Pentavalent '),
(4, 'Oral Polio'),
(5, 'Inactivated Polio'),
(6, 'Pneumococcal Conjugate'),
(7, 'Measles, Mumps, Rubella (MMR)'),
(66, 'Polio');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_information`
--

CREATE TABLE `vaccine_information` (
  `id` int(11) NOT NULL,
  `vaccinename` varchar(100) NOT NULL,
  `information` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccine_information`
--

INSERT INTO `vaccine_information` (`id`, `vaccinename`, `information`) VALUES
(8, 'BCG', 'Protection from: Tuberculosis  <br>\r\nWhen to give: At birth <br>\r\nTuberculosis (TB) is an infection that most often attacks the lungs.'),
(9, 'Hepatitis', 'Protection from: Hepatitis B <br>\r\nWhen to give: At birth <br>\r\nHepatitis B virus is a dangerous liver infection that, when caught as an infant, often shows no symptoms for decades.'),
(10, 'Pentavalent', 'Protection from: Diphtheria, Pertussis, Tetanus, Influenza B and Hepatitis B <br>\r\nWhen to give: 6, 10 and 14 weeks.'),
(11, 'Oral Polio', 'Protection from: Poliovirus <br>\r\nWhen to give: 14 weeks <br>\r\nPolio is a virus that paralyzes 1 in 200 people who get infected.'),
(12, 'INACTIVATED POLIO', 'Protection from: Poliovirus <br>\r\nWhen to give: 14 weeks <br>\r\nPolio is a virus that paralyzes 1 in 200 people who get infected.'),
(13, 'PNEUMOCOCCAL CONJUGATE', 'Protection from: Pneumonia and Meningitis <br>\r\nWhen to give: 6, 10 and 14 weeks <br>\r\nPneumococcal diseases such as pneumonia and meningitis are a common cause of sickness and death worldwide.'),
(14, 'MEASLES, MUMPS, RUBELLA (MMR)', 'Protection from: MEASLES, MUMPS and RUBELLA (MMR)\r\nWhen to give: 9 months and 1 year old <br>\r\nMeasles is a highly contagious disease with symptoms that include fever, runny nose, white spots in the back of the mouth and a rash.'),
(16, 'Polio', 'polio vaccine');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_schedule`
--

CREATE TABLE `vaccine_schedule` (
  `vaccine_id` int(10) NOT NULL,
  `vaccine_name` varchar(20) NOT NULL,
  `min_age` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccine_schedule`
--

INSERT INTO `vaccine_schedule` (`vaccine_id`, `vaccine_name`, `min_age`) VALUES
(1, 'BCG', 10),
(2, 'OPV', 10),
(3, 'Hepatitis B', 10),
(4, 'DPT', 42),
(5, 'OPV', 42),
(6, 'HiB ', 42),
(7, 'Hepatitis B', 42),
(8, 'DPT', 70),
(9, 'OPV', 70),
(10, 'HiB', 70),
(11, 'DPT', 98),
(12, 'OPV', 98),
(13, 'HiB', 98),
(14, 'Hepatitis B', 180),
(15, 'Measles', 270),
(16, 'MMR', 455),
(17, 'DPT', 545),
(18, 'OPV', 545),
(19, 'HiB', 545),
(20, 'Typhoid', 730),
(21, 'DPT', 1460),
(22, 'OPV', 1460),
(23, 'TT', 3650),
(24, 'Rubella', 3650);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `chart`
--
ALTER TABLE `chart`
  ADD PRIMARY KEY (`chart_id`);

--
-- Indexes for table `child_tbl`
--
ALTER TABLE `child_tbl`
  ADD PRIMARY KEY (`child_id`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `healthcare_info`
--
ALTER TABLE `healthcare_info`
  ADD PRIMARY KEY (`healthcare_id`);

--
-- Indexes for table `healthcenter_tbl`
--
ALTER TABLE `healthcenter_tbl`
  ADD PRIMARY KEY (`healthcenter_id`);

--
-- Indexes for table `parent_tbl`
--
ALTER TABLE `parent_tbl`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`vaccine_id`);

--
-- Indexes for table `vaccine_information`
--
ALTER TABLE `vaccine_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccine_schedule`
--
ALTER TABLE `vaccine_schedule`
  ADD PRIMARY KEY (`vaccine_id`),
  ADD UNIQUE KEY `vaccine_id` (`vaccine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chart`
--
ALTER TABLE `chart`
  MODIFY `chart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;

--
-- AUTO_INCREMENT for table `child_tbl`
--
ALTER TABLE `child_tbl`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `guide`
--
ALTER TABLE `guide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `healthcare_info`
--
ALTER TABLE `healthcare_info`
  MODIFY `healthcare_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `healthcenter_tbl`
--
ALTER TABLE `healthcenter_tbl`
  MODIFY `healthcenter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `parent_tbl`
--
ALTER TABLE `parent_tbl`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `vaccine`
--
ALTER TABLE `vaccine`
  MODIFY `vaccine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `vaccine_information`
--
ALTER TABLE `vaccine_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vaccine_schedule`
--
ALTER TABLE `vaccine_schedule`
  MODIFY `vaccine_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
