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
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `bus_id` int(11) NOT NULL,
  `bus_name` varchar(100) NOT NULL,
  `capacity` enum('small','medium','large') NOT NULL,
  `air_conditioned` tinyint(1) NOT NULL,
  `accepts_student_pass` tinyint(1) NOT NULL,
  `wheelchair_accessible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`bus_id`, `bus_name`, `capacity`, `air_conditioned`, `accepts_student_pass`, `wheelchair_accessible`) VALUES
(72, 'VIP 27', 'medium', 0, 1, 0),
(71, 'Victor Classic', 'medium', 0, 1, 0),
(70, 'Thikana Express', 'medium', 0, 1, 0),
(69, 'Salsabil', 'medium', 0, 1, 0),
(68, 'Runway Express', 'medium', 0, 1, 0),
(67, 'Rangdhanu Express', 'medium', 0, 1, 0),
(66, 'Rajdhani Super', 'medium', 0, 1, 0),
(65, 'Procheshta', 'medium', 0, 1, 0),
(64, 'Pallabi Super', 'medium', 0, 1, 0),
(63, 'Nur E Makka', 'medium', 0, 1, 0),
(62, 'Mirpur Transport Service', 'medium', 0, 1, 0),
(61, 'Meghla', 'medium', 0, 1, 0),
(60, 'Lal Sabuj (AC)', 'medium', 1, 0, 0),
(59, 'Himachal', 'medium', 0, 1, 0),
(58, 'Green Anabil', 'medium', 0, 1, 0),
(57, 'Gazipur Paribahan', 'medium', 0, 1, 0),
(56, 'First Ten', 'medium', 0, 1, 0),
(55, 'Falgun', 'medium', 0, 1, 0),
(54, 'Elite', 'medium', 0, 1, 0),
(53, 'Dhaka Paribahan', 'medium', 0, 1, 0),
(52, 'Dewan', 'medium', 0, 1, 0),
(51, 'City Link', 'medium', 0, 1, 0),
(50, 'Champion', 'medium', 0, 1, 0),
(49, 'BRTC Mirpur Route', 'large', 0, 1, 1),
(48, 'BRTC Motijheel Route', 'large', 0, 1, 1),
(47, 'BRTC Uttara Route', 'large', 0, 1, 1),
(46, 'BRTC Elevated Expressway Bus Route', 'large', 0, 1, 1),
(45, 'BRTC Shyamoli Route', 'large', 0, 1, 1),
(44, 'Bikash', 'medium', 0, 1, 0),
(43, 'Bikalpa', 'medium', 0, 1, 0),
(42, 'Basumati', 'medium', 0, 1, 0),
(41, 'Balaka', 'medium', 0, 1, 0),
(40, 'Baishakhi', 'medium', 0, 1, 0),
(39, 'Asmani', 'medium', 0, 1, 0),
(38, 'Ashulia Classic', 'medium', 0, 1, 0),
(35, 'Alif Route 2 - আলিফ', 'medium', 0, 1, 0),
(34, 'Alif Route 1 - আলিফ 1', 'medium', 0, 1, 0),
(32, 'Akik - আকিক', 'medium', 0, 1, 0),
(31, 'Akash AC Version - আকাশ এ/সি', 'medium', 1, 0, 0),
(30, 'Akash - আকাশ', 'medium', 0, 1, 0),
(29, 'Ajmeri Glory - আজমেরী গ্লোরী', 'medium', 1, 0, 0),
(28, 'Active Paribahan - এক্টিভ পরিবহন', 'medium', 0, 1, 0),
(27, 'BRTC Kuril Service', 'large', 0, 1, 1),
(25, 'BRTC Airport Service', 'large', 0, 1, 1),
(24, 'Winner - উইনার', 'medium', 0, 1, 0),
(23, 'Turag - তুরাগ', 'small', 0, 1, 0),
(22, 'Salsabil - ছালছাবিল', 'medium', 0, 1, 0),
(21, 'Raida - রাইদা', 'medium', 0, 1, 0),
(20, 'Prajapati - প্রজাপতি', 'small', 0, 1, 0),
(19, 'Gulshan Chaka - গুলশান চাকা (AC)', 'medium', 1, 0, 1),
(18, 'Green Dhaka - গ্রীন ঢাকা (AC)', 'medium', 1, 0, 0),
(17, 'Dhaka Nagar Poribohon - ঢাকা নগর পরিবহন', 'medium', 0, 1, 0),
(16, 'Anabil Super - অনাবিল সুপার', 'medium', 0, 1, 0),
(15, 'Alif - আলিফ', 'medium', 0, 1, 0),
(14, 'Airport Bangabandhu Avenue Paribahan - এয়ারপোর্ট বঙ্গবন্ধু এভিনিউ পরিবহন', 'medium', 0, 1, 0),
(13, 'Achim Paribahan - আছিম পরিবহন', 'medium', 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`bus_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
