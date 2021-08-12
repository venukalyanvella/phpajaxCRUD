-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2021 at 08:39 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `orginazation`
--

CREATE TABLE `orginazation` (
  `id` int(11) NOT NULL,
  `orginazation` varchar(100) NOT NULL,
  `centers` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `collage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orginazation`
--

INSERT INTO `orginazation` (`id`, `orginazation`, `centers`, `state`, `collage`) VALUES
(1, 'xyz college', 'xyz college', 'Mp', 'Abc college'),
(2, 'xyz college', 'xyz college', 'Mp', 'Abc college'),
(3, 'xyz college', 'xyz college', 'Up', 'mbncollege'),
(4, 'xyz', 'nelloor', 'Ap', 'Abc college'),
(5, 'mln', 'xyz college', 'BH', 'mncollege'),
(6, 'advz', 'bumil', 'Mp', 'Abc college'),
(7, 'RDD ', 'rdf college', 'Up', 'nhcncollege');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `studentName` varchar(100) NOT NULL,
  `studentEmail` varchar(255) NOT NULL,
  `studentMobile` varchar(10) NOT NULL,
  `studentAddress` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'Active-1, inactive-0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `organization_id`, `center_id`, `state_id`, `college_id`, `studentName`, `studentEmail`, `studentMobile`, `studentAddress`, `status`) VALUES
(4, 452, 445, 26, 178, 'test2', 'test2@gmail.com', '7412588520', 'tests24', 0),
(5, 0, 445, 26, 178, 'test27', 'test17@gmail.com', '7412588520', 'tests17', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orginazation`
--
ALTER TABLE `orginazation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orginazation`
--
ALTER TABLE `orginazation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
