-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 07:46 PM
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
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `station_id` int(11) NOT NULL,
  `station_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`station_id`, `station_name`) VALUES
(1, 'Gabtoli'),
(2, 'Technical'),
(3, 'Ansar Camp'),
(4, 'Mirpur 1'),
(5, 'Sony Cinema Hall'),
(6, 'Mirpur 2'),
(7, 'Mirpur 10'),
(8, 'Mirpur 11'),
(9, 'Purobi'),
(10, 'Kalshi'),
(11, 'ECB Square'),
(12, 'MES'),
(13, 'Shewra'),
(14, 'Kuril Bishwa Road'),
(15, 'Jamuna Future Park'),
(16, 'Bashundhara'),
(17, 'Nadda'),
(18, 'Notun Bazar'),
(19, 'Bashtola'),
(20, 'Shahjadpur'),
(21, 'Uttar Badda'),
(22, 'Badda'),
(23, 'Madhya Badda'),
(24, 'Merul Badda'),
(25, 'Rampura Bridge'),
(26, 'Banasree'),
(27, 'Demra Staff Quarter'),
(28, 'Fulbaria'),
(29, 'Golap Shah Mazar'),
(30, 'GPO'),
(31, 'Paltan'),
(32, 'Press Club'),
(33, 'High Court'),
(34, 'Matsya Bhaban'),
(35, 'Shahbag'),
(36, 'Bangla Motor'),
(37, 'Kawran Bazar'),
(38, 'Farmgate'),
(39, 'Bijoy Sarani'),
(40, 'Jahangir Gate'),
(41, 'Mohakhali'),
(42, 'Chairman Bari'),
(43, 'Sainik Club'),
(44, 'Banani'),
(45, 'Kakali'),
(46, 'Staff Road'),
(47, 'Kurmitola'),
(48, 'Khilkhet'),
(49, 'Airport'),
(50, 'Jashimuddin (Uttara)'),
(51, 'Rajlakshmi'),
(52, 'House Building'),
(53, 'Abdullahpur'),
(54, 'Gazipur Chowrasta'),
(55, 'Kazipara'),
(56, 'Shewrapara'),
(57, 'Gulshan 1'),
(58, 'Badda Link Road'),
(59, 'Rampura'),
(60, 'Bisshoroad'),
(61, 'Basabo'),
(62, 'Titipara'),
(63, 'Sayedabad'),
(64, 'Jatrabari'),
(65, 'Postogola'),
(66, 'Signboard'),
(67, 'Keraniganj Ghatchar Depot'),
(68, 'Basila'),
(69, 'Mohammadpur Bus Stand'),
(70, 'Shankar'),
(71, 'Jhigatla'),
(72, 'Science Lab'),
(73, 'Motso Bhavan'),
(74, 'Dainik Bangla'),
(75, 'Shapla Chattar'),
(76, 'Notre Dame College'),
(77, 'Ittefaq Mor'),
(78, 'Matual'),
(79, 'Kachpur via Chittagong Road'),
(80, 'Malibaag Moor'),
(81, 'Mouchak'),
(82, 'Malibagh Railgate'),
(83, 'Hazipara'),
(84, 'Rampura Bazar'),
(88, 'Azampur'),
(89, 'Azimpur'),
(90, 'Eden College'),
(91, 'Nilkhet'),
(92, 'New Market'),
(93, 'City College'),
(94, 'Kalabagan'),
(95, 'Panthopoth'),
(96, 'Bot tola'),
(97, 'Nabisco'),
(98, 'Wireless'),
(109, 'Shia Masjid'),
(110, 'Adabor'),
(111, 'Shyamoli'),
(112, 'Sadarghat'),
(113, 'Ray Saheb Bazar'),
(114, 'Naya Bazar'),
(118, 'Kakrail'),
(119, 'Shantinagar'),
(120, 'Malibagh Moor'),
(138, 'Tongi'),
(139, 'Station Road'),
(140, 'Mill Gate'),
(141, 'Board Bazar'),
(142, 'Gazipur Bypass'),
(143, 'Konabari'),
(144, 'Chandra'),
(145, 'Kadamtali'),
(146, 'Keraniganj'),
(147, 'Babubazar'),
(160, 'Merul'),
(247, 'Mirpur 14'),
(252, 'Mazar Road'),
(254, 'Rupnagar'),
(255, 'Beribadh'),
(256, 'Birulia'),
(257, 'Ashulia'),
(258, 'Zirabo'),
(259, 'Fantasy Kingdom'),
(260, 'Nandan Park'),
(261, 'Japan Garden City'),
(262, 'Ring Road'),
(265, 'Shishu Mela'),
(266, 'Agargaon'),
(267, 'Zia Uddyan'),
(269, 'Old Airport'),
(274, 'Kakoli'),
(287, 'Sign Board'),
(288, 'Shonir Akhra'),
(291, 'Mugdapara'),
(292, 'Bashabo'),
(293, 'Khilgaon'),
(320, 'Gazipur Chourasta'),
(355, 'Nobinagar'),
(356, 'Baipayl'),
(357, 'Jamgora'),
(358, 'Ashulia Bazar'),
(359, 'Kamarpara'),
(360, 'Sat rasta'),
(361, 'Dhour'),
(362, 'Tarabo'),
(363, 'Madanpur'),
(364, 'Savar'),
(365, 'Hemayetpur'),
(366, 'Amin Bazar'),
(367, 'Kallyanpur'),
(368, 'Manik Nagar'),
(369, 'TT Para – Kamalapur'),
(370, 'Mogbazar'),
(371, 'Satrasta'),
(372, 'Gabtoli – Mirpur 1'),
(373, 'Mirpur 12'),
(374, 'Pallabi'),
(375, 'Shewrapara – Taltola'),
(376, 'College Gate'),
(377, 'Asad Gate'),
(378, 'Dhanmondi 27'),
(379, 'Dhanmondi 32'),
(380, 'Azimpur – Dhakeshwari'),
(381, 'Khamar Bari'),
(382, 'Kanchpur'),
(383, 'Chittagong Road'),
(384, 'Matuail'),
(385, 'Rayerbag'),
(386, 'Gulistan'),
(387, 'Motijheel'),
(388, 'Vashantek'),
(389, 'Bata Signal'),
(390, 'Jigatola'),
(391, 'Dhanmondi 15'),
(392, 'Star Kabab'),
(393, 'Mohammadpur'),
(394, 'Bosila'),
(395, 'Ghatar Char'),
(396, 'Katabon'),
(397, 'Uttara'),
(398, 'Gazipur'),
(399, 'Shib Bari'),
(400, 'Taltola'),
(401, 'Rajlakshmi House Building'),
(402, 'Motso Vobon'),
(403, 'Malibagg Mor'),
(404, 'Malibagh Rail Gate'),
(405, 'Natun Bazar'),
(406, 'Kuril Bissho Road'),
(407, 'Uttara House Building'),
(408, 'Sony Cenema Hall'),
(409, 'Chashara'),
(410, 'Shibu Market'),
(411, 'Jalkuri'),
(412, 'Metro Hall'),
(413, 'Janapath Moor'),
(414, 'Farmgate Bijoy Sarani'),
(415, 'Purobi Pallabi'),
(416, 'Zirani Bazar'),
(417, 'Vulta'),
(418, 'Chiriyakhana'),
(419, 'Maowa'),
(420, 'Shia Mosque'),
(421, 'Fakirapul'),
(422, 'Dayaganj'),
(423, 'Postagola'),
(424, 'Dholairpar'),
(425, 'Kuril Chourasta'),
(426, 'Shonbari Sreenagar'),
(427, 'Nimtola'),
(428, 'Kuchimura'),
(429, 'Rajendrapur'),
(430, 'Hasnabad'),
(431, 'Jurain'),
(432, 'Chankhar Pul'),
(433, 'Bakshi Bazar'),
(434, 'Darussalam'),
(435, 'Diabari');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`station_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
