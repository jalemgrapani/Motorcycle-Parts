-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2025 at 07:49 AM
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
-- Database: `conceptdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `motorcycle_parts`
--

CREATE TABLE `motorcycle_parts` (
  `part_id` int(11) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `concept` varchar(50) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motorcycle_parts`
--

INSERT INTO `motorcycle_parts` (`part_id`, `part_name`, `concept`, `image_path`, `price`, `stock`) VALUES
(2, 'Morad Akront Rims', 'Thai', 'images/tire rim - thai.jpg', 7500.00, 0),
(3, 'Small Hub With Chrome Rios', 'Thai', 'images/small hub - thai.jpg', 4000.00, 5),
(4, 'Eat My Dust Race Tires', 'Thai', 'images/tire - thai.jpg', 6000.00, 0),
(5, 'Brembo Nickel Caliper 2pot', 'Thai', 'images/nickel 2pot-thai.jpg', 7000.00, 0),
(6, '+3 JRP Swing Arm', 'Thai', 'images/swing arm - thai.jpg', 8000.00, 0),
(7, 'TK Disc', 'Thai', 'images/tk disc - thai.jpg', 6000.00, 0),
(8, 'OverRacing Shock', 'Thai', 'images/overracing - thai.jpg', 9000.00, 0),
(10, 'Brembo Nickel Caliper 4pot', 'Malaysian', 'images/brembo caliper-malay.jpg', 6500.00, 11),
(11, 'Brembo Disc 267mm', 'Malaysian', 'images/brembo disk - malay.jpg', 2200.00, 0),
(12, 'Swits Brake Hose with QR', 'Malaysian', 'images/brake hose - malay.jpg', 3000.00, 0),
(13, 'Dyno Pro Flat Seat', 'Malaysian', 'images/flatseat- malay.jpg', 2800.00, 0),
(14, 'Hylos Mags', 'Malaysian', 'images/hylosmags - malay.jpg', 6000.00, 0),
(15, 'Dynopro Swing Arm +3', 'Malaysian', 'images/swing arm - malaysian.jpg', 4200.00, 0),
(16, 'Maxxis Tires Set', 'Malaysian', 'images/maxxis - malaysian.jpg', 5000.00, 0),
(21, 'Primaxx Tires Set', 'Indonesian', 'images/tire - indo.jpg', 3000.00, 0),
(22, 'BOMX Mags', 'Indonesian', 'images/mags - indo.jpg', 6000.00, 1),
(23, 'Arvi Creation Seat Assembly', 'Indonesian', 'images/seat - indo.jpg', 2800.00, 0),
(25, 'RCB Caliper', 'Circuit', 'images/rcb caliper - circuit.jpg', 4500.00, 0),
(26, 'Black Diamond Disc', 'Circuit', 'images/disk - circuit.jpg', 3600.00, 12),
(27, 'Lever Guard', 'Circuit', 'images/rcb lever guard- circuit.jpg', 1300.00, 0),
(28, 'Pirelli Tires Set', 'Circuit', 'images/race tire - circuit.jpg', 5500.00, 0),
(29, 'RCB Mags', 'Circuit', 'images/mags - circuit.jpg', 6000.00, 0),
(30, 'Racing Seat Assembly', 'Circuit', 'images/racingseat - circuit.jpg', 2500.00, 0),
(31, 'New Custom Part', 'Indonesian', 'https://via.placeholder.com/80', 5000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `partId` int(11) NOT NULL,
  `dateOrdered` date NOT NULL,
  `amount` int(11) NOT NULL,
  `orderStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `user_id`, `partId`, `dateOrdered`, `amount`, `orderStatus`) VALUES
(1, 1, 21, '2025-11-30', 12, 'Pending'),
(2, 1, 22, '2025-11-30', 1, 'Pending'),
(3, 1, 21, '2025-11-30', 1, 'Pending'),
(4, 1, 21, '2025-11-30', 1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(70) NOT NULL,
  `lastName` varchar(70) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cpnumber` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `userlevel` varchar(20) NOT NULL DEFAULT 'customer',
  `isActive` varchar(11) NOT NULL DEFAULT 'YES'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `age`, `address`, `cpnumber`, `username`, `password`, `created_at`, `userlevel`, `isActive`) VALUES
(4, '', '', 0, 'dyan lang st.', '09949226401', 'bbjohn', '123', '2025-11-29 05:34:28', 'customer', 'YES'),
(7, '', '', 0, 'Admin Address', '09123456789', 'admin', '12345', '2025-11-29 07:36:26', 'admin', 'YES'),
(8, 'Jalem Louise', 'Grapani', 21, 'Andrea Paz Pabahay Phase 1, Block 13, Lot 5, Barandal, Calamba City', '09670185414', 'jalemlouisegrapani@gmail.com', '123', '2025-11-30 01:57:08', 'customer', 'YES'),
(9, 'Jalem Louise', 'Grapani', 21, 'Andrea Paz Pabahay Phase 1, Block 13, Lot 5, Barandal, Calamba City', '09670185414', 'jalemgrapani354@gmail.com', '123', '2025-11-30 01:59:59', 'customer', 'YES');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `motorcycle_parts`
--
ALTER TABLE `motorcycle_parts`
  ADD PRIMARY KEY (`part_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `motorcycle_parts`
--
ALTER TABLE `motorcycle_parts`
  MODIFY `part_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
