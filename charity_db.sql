-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2021 at 03:13 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charity_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `don_id` int(11) NOT NULL,
  `don_date` date NOT NULL,
  `don_time` time NOT NULL,
  `currency` varchar(4) NOT NULL,
  `cardnumber` varchar(20) NOT NULL,
  `receipt` varchar(500) NOT NULL,
  `amount` float NOT NULL,
  `recommandation` varchar(255) DEFAULT NULL,
  `req_id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `donor_id` int(11) NOT NULL,
  `donor_fname` varchar(40) NOT NULL,
  `donor_lname` varchar(20) DEFAULT NULL,
  `donor_email` varchar(40) NOT NULL,
  `donor_pwd` varchar(500) NOT NULL,
  `donor_country` varchar(20) NOT NULL,
  `donor_city` varchar(20) NOT NULL,
  `donor_img` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`donor_id`, `donor_fname`, `donor_lname`, `donor_email`, `donor_pwd`, `donor_country`, `donor_city`, `donor_img`) VALUES
(6, 'thedonor mkuu', '', 'thedonor@gmail.com', '$2y$10$NJ9VMdLArf87NymDmLCWceIL.kipHsNYALIjN.mlv88mltO38ACPm', 'zimbabwe', 'dodoma1', '1626026165profil.PNG'),
(10, 'herode', '', 'herode@gmail.com', '$2y$10$wJtl2Pyh80sCagTv6gn7QeQS3MM9X7XtWTiayr0TeGJ8hCUKg8ru2', '', '', 'user.png'),
(11, 'god', '', 'girls@gmail.com', '$2y$10$Tl6R1twcLF/wFiBi7HjqgeHMj.MPdKjjSCt1sZktybZW8aoz71T2C', '', '', 'user.png'),
(14, 'thedonor', '', 'donor@gmail.com', '$2y$10$uo0qP8./kf4ZePUSP5sP6.60GNVn/etEDtfkro5Ach5VCvSTutdNm', 'Tanzania', 'dodoma', '1626028616profil.PNG'),
(18, 'khalid', '', 'khal', '$2y$10$D6pfk.aPlWrwgSRsUvJiauKkNAil/rMGyE7kiDJCKEHYFgvtZ93XS', '', '', 'user.png'),
(19, 'khalid', '', 'thewinner@gmail.com', '$2y$10$zMOZID01F1cQKwU0BSxpgubI3T7BAJOeOAtYnREYAsu.m57o.wIFG', 'Anguilla', 'unknown', 'user.png'),
(20, 'thewinner', '', 'thewinner@gmail.com', '$2y$10$aBvLPdedq3uXnT.H0k9t/ODisWTaTIzHoxEekmUH4.lDCcs69YHkm', '', '', 'user.png');

-- --------------------------------------------------------

--
-- Table structure for table `ngo`
--

CREATE TABLE `ngo` (
  `NGO_id` int(11) NOT NULL,
  `NGO_name` varchar(150) NOT NULL,
  `NGO_country` varchar(10) DEFAULT NULL,
  `NGO_city` varchar(10) DEFAULT NULL,
  `NGO_email` varchar(30) NOT NULL,
  `NGO_password` varchar(500) NOT NULL,
  `NGO_phoneno` varchar(15) DEFAULT NULL,
  `NGO_status` varchar(10) DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `NGO_img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ngo`
--

INSERT INTO `ngo` (`NGO_id`, `NGO_name`, `NGO_country`, `NGO_city`, `NGO_email`, `NGO_password`, `NGO_phoneno`, `NGO_status`, `admin_id`, `NGO_img`) VALUES
(30, 'UDOSO', '', '', 'udoso@gmail.com', '$2y$10$9IZjqvWXhE.FlfqekKc4COOteNJHiYLIM39ZQf8IOcLQQmwDNNHcO', '', 'ordinary', 0, 'ngo.jpg'),
(31, 'holy gospel', '', '', 'gospel@gmail.com', '$2y$10$UbuYCAD0RdSAtHHcdMCtd.Wpw.7pc0gH9MmhoUxigsbEjjrbbTClu', '', 'ordinary', 0, 'ngo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ngo_uploads`
--

CREATE TABLE `ngo_uploads` (
  `upload_id` int(11) NOT NULL,
  `path` varchar(100) NOT NULL,
  `upload_date` date NOT NULL,
  `upload_time` time NOT NULL,
  `NGO_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `req_id` int(11) NOT NULL,
  `request_time` date NOT NULL DEFAULT current_timestamp(),
  `title` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `budget` int(11) NOT NULL,
  `strategy` varchar(255) DEFAULT NULL,
  `status` varchar(6) NOT NULL,
  `NGO_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`req_id`, `request_time`, `title`, `description`, `budget`, `strategy`, `status`, `NGO_id`) VALUES
(117, '0000-00-00', 'MICHANGO YA KUNUNUA GARI', 'UDOSO imekua haina gari kwa muda mrefu na viongozi wamekua wakitembea kwa mguu mpaka viatu vinaisha haraka. hivo basi tunaomba kila mwanafunzi wa CIVE aweze kuchangia ili tuweze kununua gari la UDOSO...', 50000, '', 'open', 30),
(118, '0000-00-00', 'FUNDS FOR A NEW ALBUM', 'we are gospel team from the central church and we would love to request for funds for our new album that to be released the next year. thank you!!', 0, '', 'open', 31);

-- --------------------------------------------------------

--
-- Table structure for table `request_images`
--

CREATE TABLE `request_images` (
  `imageID` int(11) NOT NULL,
  `imageURL` varchar(60) NOT NULL,
  `requestID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_images`
--

INSERT INTO `request_images` (`imageID`, `imageURL`, `requestID`) VALUES
(34, '20210622_102948.jpg', 117),
(35, '20210622_104638.jpg', 117),
(36, '6hkkkk.PNG', 118),
(37, '1621808763profil.png', 118),
(38, 'user5-128x128.jpg', 118);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`don_id`),
  ADD KEY `req_key` (`req_id`),
  ADD KEY `don_key` (`donor_id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`donor_id`);

--
-- Indexes for table `ngo`
--
ALTER TABLE `ngo`
  ADD PRIMARY KEY (`NGO_id`);

--
-- Indexes for table `ngo_uploads`
--
ALTER TABLE `ngo_uploads`
  ADD PRIMARY KEY (`upload_id`),
  ADD KEY `ngo_upload_key` (`NGO_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `ngo_key` (`NGO_id`);

--
-- Indexes for table `request_images`
--
ALTER TABLE `request_images`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `reqkey` (`requestID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `don_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ngo`
--
ALTER TABLE `ngo`
  MODIFY `NGO_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ngo_uploads`
--
ALTER TABLE `ngo_uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `request_images`
--
ALTER TABLE `request_images`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `don_key` FOREIGN KEY (`donor_id`) REFERENCES `donor` (`donor_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `req_key` FOREIGN KEY (`req_id`) REFERENCES `requests` (`req_id`) ON DELETE CASCADE;

--
-- Constraints for table `ngo_uploads`
--
ALTER TABLE `ngo_uploads`
  ADD CONSTRAINT `ngo_upload_key` FOREIGN KEY (`NGO_id`) REFERENCES `ngo` (`NGO_id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `ngo_key` FOREIGN KEY (`NGO_id`) REFERENCES `ngo` (`NGO_id`) ON DELETE CASCADE;

--
-- Constraints for table `request_images`
--
ALTER TABLE `request_images`
  ADD CONSTRAINT `reqkey` FOREIGN KEY (`requestID`) REFERENCES `requests` (`req_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
