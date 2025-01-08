-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 07:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `routewise_schema`
--

-- --------------------------------------------------------

--
-- Table structure for table `buspassinfo`
--

CREATE TABLE `buspassinfo` (
  `BusPassID` char(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `NIDNumber` varchar(20) NOT NULL,
  `BusName` varchar(255) NOT NULL,
  `BoardingPoint` varchar(255) NOT NULL,
  `DropoffPoint` varchar(255) NOT NULL,
  `ValidMonth` varchar(20) NOT NULL,
  `PaymentStatus` enum('Paid','Unpaid') NOT NULL,
  `Year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buspassinfo`
--

INSERT INTO `buspassinfo` (`BusPassID`, `Name`, `NIDNumber`, `BusName`, `BoardingPoint`, `DropoffPoint`, `ValidMonth`, `PaymentStatus`, `Year`) VALUES
('1317724238', 'Sazin', '1289128941', '25', '50', '14', 'February', 'Paid', 2025),
('2539303879', 'Karim', '1234561', '21', '62', '64', 'January', 'Unpaid', 2025),
('3090298419', 'Zayan Zaman', '891248912', '21', '50', '22', 'February', 'Paid', 2025),
('5098180667', 'Tester', '1000000', '18', '25', '85', 'January', 'Paid', 2025),
('5310933749', 'Sajid', '125125125', '13', '13', '12', 'January', 'Paid', 2025),
('6202989192', 'Sajidul', '125125125', '22', '63', '65', 'January', 'Paid', 2025),
('8040563491', 'Khorshed', '9187199247', '23', '103', '61', 'January', 'Unpaid', 2025),
('8416975991', 'Shahriar', '991411114', '24', '98', '57', 'February', 'Paid', 2025),
('8817633737', 'Zayan 1', '12345', '13', '2', '4', 'January', 'Paid', 2025);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buspassinfo`
--
ALTER TABLE `buspassinfo`
  ADD PRIMARY KEY (`BusPassID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
