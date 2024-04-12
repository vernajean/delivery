-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2024 at 04:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `activity_type` varchar(255) NOT NULL,
  `subType` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `name`, `activity_type`, `subType`, `timestamp`) VALUES
(1, '8', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-26 11:33:33'),
(2, '8', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-26 11:36:58'),
(3, '8', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-26 11:36:58'),
(4, '8', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-26 11:36:58'),
(5, '', '', 'Logout', '', '2024-02-26 11:36:58'),
(6, '8', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-26 11:36:58'),
(7, '', '', 'Logout', '', '2024-02-26 11:47:58'),
(8, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(9, '8', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-27 13:18:02'),
(10, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(11, '2', 'furniture', 'Login', 'user (Furniture)', '2024-02-27 13:18:02'),
(12, '5', 'admin (Furniture)', 'Login', 'admin (Furniture)', '2024-02-27 13:18:02'),
(13, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(14, '8', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-27 13:18:02'),
(15, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(16, '5', 'admin (Furniture)', 'Login', 'admin (Furniture)', '2024-02-27 13:18:02'),
(17, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(18, '6', 'admin (Goods)', 'Login', 'admin (Goods)', '2024-02-27 13:18:02'),
(19, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(20, '7', 'admin (Product)', 'Login', 'admin (Product)', '2024-02-27 13:18:02'),
(21, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(22, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(23, '1', 'E-Toy', 'Login', 'user (E-toy)', '2024-02-27 13:18:02'),
(24, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(25, '1', 'E-Toy', 'Login', 'user (E-toy)', '2024-02-27 13:18:02'),
(26, '8', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-27 13:18:02'),
(27, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(28, '8', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-27 13:18:02'),
(29, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(30, '1', 'E-Toy', 'Login', 'user (E-toy)', '2024-02-27 13:18:02'),
(31, '1', 'E-Toy', 'Login', 'user (E-toy)', '2024-02-27 13:18:02'),
(32, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(33, '1', 'E-Toy', 'Login', 'user (E-toy)', '2024-02-27 13:18:02'),
(34, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(35, '1', 'E-Toy', 'Login', 'user (E-toy)', '2024-02-27 13:18:02'),
(36, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(37, '1', 'E-Toy', 'Login', 'user (E-toy)', '2024-02-27 13:18:02'),
(38, '1', 'E-Toy', 'Login', 'user (E-toy)', '2024-02-27 13:18:02'),
(39, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(40, '1', 'E-Toy', 'Login', 'user (E-toy)', '2024-02-27 13:18:02'),
(41, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(42, '1', 'E-Toy', 'Login', 'user (E-toy)', '2024-02-27 13:18:02'),
(43, '', '', 'Logout', '', '2024-02-27 13:18:02'),
(44, '1', 'E-Toy', 'Login', 'user (E-toy)', '2024-02-27 13:18:02'),
(45, '', '', 'Logout', '', '2024-02-27 13:25:21'),
(46, '2', 'furniture', 'Login', 'user (Furniture)', '2024-02-27 13:25:21'),
(47, '', '', 'Logout', '', '2024-02-27 13:31:01'),
(48, '3', 'Goods user', 'Login', 'user (Goods)', '2024-02-27 13:31:01'),
(49, '', '', 'Logout', '', '2024-02-27 13:35:25'),
(50, '4', 'product user', 'Login', 'user (Product)', '2024-02-27 13:35:25'),
(51, '', '', 'Logout', '', '2024-02-27 13:36:24'),
(52, '4', 'product user', 'Login', 'user (Product)', '2024-02-27 13:36:24'),
(53, '8', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-28 01:12:30'),
(54, '', '', 'Logout', '', '2024-02-28 01:24:39'),
(55, '7', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-28 01:24:39'),
(56, '', '', 'Logout', '', '2024-02-28 01:24:39'),
(57, '8', 'E-toy User', 'Login', 'user (E-toy)', '2024-02-28 01:24:39'),
(58, '', '', 'Logout', '', '2024-02-28 01:56:00'),
(59, '7', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-28 01:56:00'),
(60, '', '', 'Logout', '', '2024-02-28 01:56:00'),
(61, '7', 'E-Toy', 'Login', 'admin (E-toy)', '2024-02-28 01:56:00'),
(70, '', '', 'Logout', '', '2024-02-28 02:23:37'),
(71, '8', 'E-toy User', 'Login', 'user (E-toy)', '2024-02-28 02:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `image`, `product_type`) VALUES
(1, 'asdasd', '', 'furniture'),
(2, 'asdsad', 'Screen Shot 2024-02-24 at 12.02.35 AM.png', 'E-toy'),
(3, 'adds', 'Screen Shot 2024-02-25 at 9.27.58 AM.png', 'Product'),
(4, 'asas', 'Screen Shot 2024-02-24 at 12.03.43 AM.png', 'E-toy'),
(5, 'as', 'Screen Shot 2024-02-24 at 12.03.09 AM.png', 'furniture'),
(6, 'sss', 'Screen Shot 2024-02-19 at 3.47.06 PM.png', 'Goods');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `address`, `email`, `number`, `role`, `type`) VALUES
(1, 'asas', 'as', 'as@gmail.com', '0909', 'Manager', 'staff (E-toy)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `address`, `email`, `number`, `username`, `password`, `user_type`) VALUES
(1, 'furniture user', 'furniture', 'furniture@gmail.com', '0', 'furniture', '1234', 'user (Furniture)'),
(2, 'Goods user', 'goods', 'goods@gmail.com', '0', 'goods', '1234', 'user (Goods)'),
(3, 'product user', 'product', 'product@gmail.com', '00', 'product', '1234', 'user (Product)'),
(4, 'admin (Furniture)', '', '', '0', 'admin1', 'admin1', 'admin (Furniture)'),
(5, 'admin (Goods)', '', '', '0', 'admin2', 'admin2', 'admin (Goods)'),
(6, 'admin (Product)', '', '', '0', 'admin3', 'admin3', 'admin (Product)'),
(7, 'E-Toy', 'ad', 'asdaa@gmail.com', '0', 'admin', 'admin', 'admin (E-toy)'),
(8, 'E-toy User', 'E-toy', 'E-toy@gmail.com', '0', 'toy', '1234', 'user (E-toy)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
