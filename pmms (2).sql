-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2023 at 07:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmms`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `nid_licence_no` varchar(100) NOT NULL,
  `joining_date` date DEFAULT NULL,
  `role` enum('Driver','Helper') NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `assigned_vehicle` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `full_name`, `phone_number`, `nid_licence_no`, `joining_date`, `role`, `salary`, `assigned_vehicle`) VALUES
(1, 'MR PABITRO DAY', '01677389828', '000000000', '2023-04-09', 'Driver', 12000.00, 'CMD 81-2009'),
(5, 'MD ARAFAT', '01835474298', '000000', '2022-10-01', 'Driver', 11500.00, 'CMD 81-2009'),
(6, 'MD KUTUB ', '01928074498', '000000', '0000-00-00', 'Helper', 5800.00, 'CMD 81-2009'),
(7, 'MD RASHED', '01640-834491', '000000', '2022-10-01', 'Driver', 10000.00, 'CMD 810732'),
(8, 'MD MAMUN ', '01312-420349', '000000', '0000-00-00', 'Driver', 10000.00, 'CME-810275'),
(9, 'MD SHIFUL ISLAM', '01818-935383', '000000', '2022-06-01', 'Driver', 10000.00, 'CMD 810732'),
(10, 'MD NAYEEM', '01971-640512', '000000', '2022-10-01', 'Driver', 9500.00, 'CME-810275'),
(11, 'MD TIPO', '01612-737613', '000000', '2023-08-01', 'Driver', 10000.00, 'CMD 81-3532'),
(12, 'MD FARUK', '01672-901927', '000000', '2023-06-01', 'Driver', 15000.00, 'CM- CHA-51-1719'),
(13, 'MR RIPON', '01740255994', '000000', '2018-01-01', 'Helper', 6400.00, 'CMD 810732'),
(14, 'MD DEWALOR', '01818471455', '000000', '2021-01-01', 'Helper', 6000.00, 'CMD 81-2009'),
(15, 'MD RAKIB', '01321903530', '000000', '0000-00-00', 'Helper', 5200.00, 'CMD 810732'),
(16, 'MD KAISER', '01677087370', '000000', '2023-04-01', 'Helper', 5500.00, 'CME-810275'),
(17, 'MD AYOUB UDDIN', '01864309386', '000000', '2023-03-01', 'Helper', 5600.00, 'CME-810275'),
(18, 'MD ISMILE', '', '000000', '2023-08-01', 'Helper', 5500.00, 'CMD 81-3532');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expense_name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `vehicle_number` varchar(20) NOT NULL,
  `expense_date` date NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `paid_amount` varchar(255) NOT NULL,
  `due_amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_name`, `amount`, `vehicle_number`, `expense_date`, `vendor`, `paid_amount`, `due_amount`) VALUES
(8, 'document renew', 242000.00, 'CMD 81-3532', '2023-08-09', 'joy', '67777', '174223.00'),
(9, 'parts galas ', 15000.00, 'CME-810275', '2023-08-09', 'ovi', '5000', '10000.00'),
(10, 'luking galas', 600.00, 'CMD 81-2009', '2023-08-09', 'chy', '600', '0.00'),
(11, 'hose pife', 300.00, 'CMD 810732', '2023-08-12', 'joy', '300', '0.00'),
(12, 'site cover', 12000.00, 'CM- CHA-51-1719', '2023-08-09', 'chy', '12000', '0.00'),
(13, 'DOcument renew', 15000.00, 'CMD 81-2009', '2023-08-10', 'hjuyi', '6000', '9000'),
(15, 'Paint', 1000.00, 'CME-810275', '2023-08-24', 'hjuyi', '500', '500'),
(16, 'document renew', 10000.00, 'CM- CHA-51-1719', '2023-07-14', 'hjuyi', '6000', '4000');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_rate`
--

CREATE TABLE `fuel_rate` (
  `id` int(11) NOT NULL,
  `fuel_rate` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fuel_rate`
--

INSERT INTO `fuel_rate` (`id`, `fuel_rate`) VALUES
(1, 109);

-- --------------------------------------------------------

--
-- Table structure for table `fuel_record`
--

CREATE TABLE `fuel_record` (
  `id` int(11) NOT NULL,
  `vehicle_number` varchar(255) DEFAULT NULL,
  `fuel_liter` decimal(10,2) DEFAULT NULL,
  `fuel_rate` decimal(10,2) DEFAULT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `fuel_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fuel_record`
--

INSERT INTO `fuel_record` (`id`, `vehicle_number`, `fuel_liter`, `fuel_rate`, `driver_name`, `fuel_date`) VALUES
(16, 'CME-810275', 20.00, 109.00, 'MD MAMUN ', '2023-06-22'),
(17, 'CME-810275', 20.00, 109.00, 'MR PABITRO DAY', '2023-06-22'),
(18, 'CMD 81-3532', 20.00, 109.00, 'MD RASHED', '2023-08-09'),
(19, 'CME-810275', 20.00, 109.00, 'MR PABITRO DAY', '2023-08-31'),
(20, 'CME-810275', 20.00, 109.00, 'MD RASHED', '2023-07-13'),
(22, 'CM- CHA-51-1719', 23.00, 109.00, 'MD RASHED', '2023-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `trip_record`
--

CREATE TABLE `trip_record` (
  `id` int(11) NOT NULL,
  `trip_name` varchar(255) DEFAULT NULL,
  `vehicle_number` varchar(20) DEFAULT NULL,
  `qnt` decimal(10,0) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `driver_allowance` decimal(10,2) DEFAULT NULL,
  `helper_allowance` decimal(10,2) DEFAULT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `helper_name` varchar(255) DEFAULT NULL,
  `trip_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_record`
--

INSERT INTO `trip_record` (`id`, `trip_name`, `vehicle_number`, `qnt`, `amount`, `driver_allowance`, `helper_allowance`, `driver_name`, `helper_name`, `trip_date`) VALUES
(4, 'Export - 40', 'CMD 810732', 0, 2269.00, 130.00, 70.00, 'MD ARAFAT', 'MR RIPON', '2023-08-17'),
(5, 'OCL', 'CME-810275', 0, 450.00, 30.00, 20.00, 'MD TIPO', 'MD KAISER', '2023-08-17'),
(7, 'Export - 40', 'CMD 81-2009', 0, 2269.00, 130.00, 70.00, 'MR PABITRO DAY', 'MR RIPON', '2023-08-01'),
(8, 'OCL', 'CMD 81-2009', 0, 450.00, 30.00, 20.00, 'MD RASHED', 'MD DEWALOR', '2023-07-20'),
(12, 'Export - 40', 'CME-810275', 2, 4538.00, 260.00, 140.00, 'MD MAMUN ', 'MR RIPON', '2023-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `trip_type`
--

CREATE TABLE `trip_type` (
  `id` int(11) NOT NULL,
  `trip_name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `driver_allowance` decimal(10,2) NOT NULL,
  `helper_allowance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_type`
--

INSERT INTO `trip_type` (`id`, `trip_name`, `amount`, `driver_allowance`, `helper_allowance`) VALUES
(2, 'Export - 20', 1991.00, 130.00, 70.00),
(3, 'Export - 40', 2269.00, 130.00, 70.00),
(5, 'Empty ', 1795.00, 105.00, 75.00),
(6, 'Import ', 3105.00, 260.00, 150.00),
(7, 'OCL', 450.00, 30.00, 20.00),
(8, 'SAPL', 600.00, 30.00, 20.00),
(9, 'EBL', 1880.00, 105.00, 75.00),
(10, 'ACDL', 2000.00, 105.00, 75.00),
(11, 'ICL', 1027.00, 105.00, 75.00),
(12, 'TOKEN', 250.00, 100.00, 40.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `password`, `profile_picture`) VALUES
(1, 'Hare Krishna', 'harekrishna', 'harekrishna@krishna.com', '01970018651', '$2y$10$AwwzlEE2YoDrwIIrx3yUr.tXhvIFldZWrXHdAxPFa7vf5NURJh1.u', 'assets/img/profile_pic/harekrishna_HD-wallpaper-lord-krishna-thumbnail.jpg'),
(6, 'Dayal Chowdhury', 'dayalchy', 'dayal.chy251@gmail.com', '01970018651', '$2y$10$Bi5dgJkFYORPncSKhwMhiOL1ueqwIxc15LUIqCX4oBXceBihD9Veq', 'assets/img/profile_pic/image_2023-08-02_191256393.png'),
(8, 'Ovi Chowdhury', 'ovichy', 'ovi.chy4041@gmail.com', '01970018651', '$2y$10$feLkoeHUZaYEYSI9uzZ3Ku6kNGc3BIsCP7fTbGKFnnQ/iCK84e.pu', 'assets/img/profile_pic/formal pic.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `vehicle_number`, `created_at`) VALUES
(1, 'CME-810275', '2023-08-03 16:49:20'),
(15, 'CMD 810732', '2023-08-07 17:06:35'),
(16, 'CMD 81-2009', '2023-08-07 17:07:12'),
(17, 'CMD 81-3532', '2023-08-07 17:08:33'),
(18, 'CM- CHA-51-1719', '2023-08-07 17:58:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuel_rate`
--
ALTER TABLE `fuel_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuel_record`
--
ALTER TABLE `fuel_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_record`
--
ALTER TABLE `trip_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_type`
--
ALTER TABLE `trip_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `fuel_rate`
--
ALTER TABLE `fuel_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fuel_record`
--
ALTER TABLE `fuel_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `trip_record`
--
ALTER TABLE `trip_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trip_type`
--
ALTER TABLE `trip_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
