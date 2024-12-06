-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 09:02 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delivery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `fullname`, `address`, `email`, `contact_number`, `username`, `password`, `usertype`, `date_created`) VALUES
(1, 'Sam Paul', 'Bunga, Padre Burgos, Southern Leyte', 'sampaul@gmail.com', '09454845464', 'SamPaul', '827ccb0eea8a706c4c34a16891f84e7b', 'Vendor', '2024-02-29 21:06:19'),
(2, 'Shomoy', 'San Isidro, Tomas Oppus, Southern Leyte', 'Shomoy@gmail.com', '09786543521', 'Shomoy', '99cd382daa1e38248e922bfd99047986', 'Customer', '2024-03-02 14:35:03'),
(3, 'Ryan Escobal', 'Looc', 'ryan@gmail.com', '09238239233', 'Ryan', '131b98dac8609f781484f08c22a8abaa', 'Courier', '2024-03-02 17:00:50'),
(4, 'Rhian Trimucha', 'bogo', 'thrimsda@gmail.com', '09822712732', 'Rhian', '8f986adea2853aa3905eca629601775d', 'Courier', '2024-03-02 17:03:08'),
(5, 'Admin', 'San Isidro', 'admin@admin.com', '0927382732', 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'Admin', '2024-03-02 17:26:01'),
(6, 'Lykzellemae', 'malitbog', 'lykzellemae@gmail.com', '09700684637', 'zellegray ', '8c9149d2ccbb2162b1630d5ed260932e', 'Customer', '2024-03-04 14:02:39'),
(7, 'Cashier', 'San Isidro', 'cashier@cashier.com', '0956548845', 'cashier', '827ccb0eea8a706c4c34a16891f84e7b', 'Cashier', '2024-03-04 15:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `declined_items`
--

CREATE TABLE `declined_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `date_declined` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `account_id` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `account_id`, `activity`, `date_created`) VALUES
(1, '1', 'Login into the system.', '2024-02-29 21:24:09'),
(2, '1', 'Login into the system.', '2024-03-02 13:45:31'),
(3, '1', 'Logout', '2024-03-02 14:33:58'),
(4, '2', 'Login into the system.', '2024-03-02 14:35:12'),
(5, '2', 'Login into the system.', '2024-03-02 14:40:43'),
(6, '2', 'Logout', '2024-03-02 14:40:53'),
(7, '2', 'Login into the system.', '2024-03-02 14:41:01'),
(8, '1', 'Login into the system.', '2024-03-02 14:47:52'),
(9, '2', 'Logout', '2024-03-02 14:56:08'),
(10, '2', 'Login into the system.', '2024-03-02 14:56:21'),
(11, '2', 'Logout', '2024-03-02 16:59:41'),
(12, '1', 'Login into the system.', '2024-03-02 17:03:27'),
(13, '1', 'Logout', '2024-03-02 17:19:45'),
(14, '1', 'Login into the system.', '2024-03-02 17:27:21'),
(15, '1', 'Logout', '2024-03-02 18:05:38'),
(16, '4', 'Login into the system.', '2024-03-02 18:06:26'),
(17, '4', 'Logout', '2024-03-02 18:14:47'),
(18, '3', 'Login into the system.', '2024-03-02 18:14:56'),
(19, '1', 'Login into the system.', '2024-03-02 18:39:11'),
(20, '3', 'Logout', '2024-03-02 18:47:08'),
(21, '1', 'Login into the system.', '2024-03-02 18:47:20'),
(22, '1', 'Logout', '2024-03-02 18:50:41'),
(23, '3', 'Login into the system.', '2024-03-02 18:50:48'),
(24, '3', 'Logout', '2024-03-02 19:34:29'),
(25, '1', 'Login into the system.', '2024-03-02 19:34:39'),
(26, '1', 'Logout', '2024-03-02 19:41:05'),
(27, '3', 'Login into the system.', '2024-03-02 19:41:16'),
(28, '3', 'Logout', '2024-03-02 19:46:10'),
(29, '2', 'Login into the system.', '2024-03-02 19:46:30'),
(30, '1', 'Logout', '2024-03-02 19:55:51'),
(31, '3', 'Login into the system.', '2024-03-02 19:56:00'),
(32, '2', 'Logout', '2024-03-02 19:56:41'),
(33, '1', 'Login into the system.', '2024-03-02 19:56:50'),
(34, '1', 'Logout to the system.', '2024-03-02 20:01:45'),
(35, '2', 'Login into the system.', '2024-03-02 20:01:53'),
(36, '2', 'Logout to the system.', '2024-03-02 20:06:57'),
(37, '3', 'Logout to the system.', '2024-03-02 20:08:17'),
(38, '5', 'Login into the system.', '2024-03-02 20:09:09'),
(39, '2', 'Login into the system.', '2024-03-02 20:12:16'),
(40, '5', 'Logout to the system.', '2024-03-02 20:20:33'),
(41, '2', 'Login into the system.', '2024-03-02 20:20:50'),
(42, '1', 'Login into the system.', '2024-03-02 20:21:37'),
(43, '1', 'Adding new product.', '2024-03-02 20:22:33'),
(44, '2', 'Item added to his/her cart.', '2024-03-02 20:22:47'),
(45, '2', 'Bought an item.', '2024-03-02 20:23:07'),
(46, '1', 'Accept and handed the parcel to the courier.', '2024-03-02 20:24:30'),
(47, '4', 'Login into the system.', '2024-03-02 20:25:21'),
(48, '4', 'Item paid successfully.', '2024-03-02 20:26:10'),
(49, '1', 'Login into the system.', '2024-03-04 13:55:39'),
(50, '1', 'Logout to the system.', '2024-03-04 13:56:00'),
(51, '6', 'Login into the system.', '2024-03-04 14:03:06'),
(52, '6', 'Logout to the system.', '2024-03-04 14:04:02'),
(53, '1', 'Login into the system.', '2024-03-04 14:04:26'),
(54, '1', 'Logout to the system.', '2024-03-04 14:05:20'),
(55, '7', 'Login into the system.', '2024-03-04 15:47:58'),
(56, '7', 'Login into the system.', '2024-03-04 22:36:46'),
(57, '7', 'Approved the payment.', '2024-03-04 23:02:35'),
(58, '7', 'Approved the payment.', '2024-03-04 23:02:55'),
(59, '7', 'Logout to the system.', '2024-03-04 23:28:45'),
(60, '5', 'Login into the system.', '2024-03-04 23:28:53'),
(61, '1', 'Password has been reset.', '2024-03-04 23:42:03'),
(62, '5', 'Logout to the system.', '2024-03-04 23:51:37'),
(63, '1', 'Login into the system.', '2024-03-04 23:51:47'),
(64, '1', 'Update the product.', '2024-03-05 00:15:07'),
(65, '1', 'Delete a product.', '2024-03-05 00:21:24'),
(66, '1', 'Update the product.', '2024-03-05 00:21:48'),
(67, '1', 'Logout to the system.', '2024-03-05 00:22:00'),
(68, '2', 'Login into the system.', '2024-03-05 00:22:23'),
(69, '2', 'Login into the system.', '2024-03-05 12:05:14'),
(70, '2', 'Item added to his/her cart.', '2024-03-05 12:05:23'),
(71, '7', 'Login into the system.', '2024-03-05 12:28:43'),
(72, '7', 'Approved the payment.', '2024-03-05 12:29:54'),
(73, '7', 'Logout to the system.', '2024-03-05 12:36:36'),
(74, '2', 'Login into the system.', '2024-03-05 12:36:46'),
(75, '2', 'Bought an item.', '2024-03-05 12:37:10'),
(76, '2', 'Logout to the system.', '2024-03-05 13:28:09'),
(77, '1', 'Login into the system.', '2024-03-05 13:28:43'),
(78, '1', 'Accept and handed the parcel to the courier.', '2024-03-05 13:30:55'),
(79, '2', 'Login into the system.', '2024-03-05 13:31:14'),
(80, '1', 'Accept and handed the parcel to the courier.', '2024-03-05 13:32:36'),
(81, '1', 'Logout to the system.', '2024-03-05 13:36:58'),
(82, '4', 'Login into the system.', '2024-03-05 13:37:08'),
(83, '4', 'Item paid successfully.', '2024-03-05 13:37:18'),
(84, '4', 'Logout to the system.', '2024-03-05 13:38:46'),
(85, '7', 'Login into the system.', '2024-03-05 13:39:14'),
(86, '7', 'Approved the payment.', '2024-03-05 13:39:21'),
(87, '2', 'Logout to the system.', '2024-03-05 13:47:28'),
(88, '1', 'Login into the system.', '2024-03-05 13:47:39'),
(89, '1', 'Logout to the system.', '2024-03-05 13:48:59'),
(90, '3', 'Login into the system.', '2024-03-05 13:49:51'),
(91, '3', 'Logout to the system.', '2024-03-05 13:50:00'),
(92, '5', 'Login into the system.', '2024-03-05 13:50:07'),
(93, '7', 'Logout to the system.', '2024-03-05 13:51:40'),
(94, '2', 'Login into the system.', '2024-03-05 13:51:50'),
(95, '2', 'Item added to his/her cart.', '2024-03-05 13:51:55'),
(96, '2', 'Bought an item.', '2024-03-05 13:52:49'),
(97, '5', 'Logout to the system.', '2024-03-05 13:53:11'),
(98, '1', 'Login into the system.', '2024-03-05 13:53:20'),
(99, '1', 'Accept and handed the parcel to the courier.', '2024-03-05 13:54:19'),
(100, '1', 'Logout to the system.', '2024-03-05 13:54:47'),
(101, '3', 'Login into the system.', '2024-03-05 13:54:56'),
(102, '3', 'Item paid successfully.', '2024-03-05 13:56:30'),
(103, '3', 'Logout to the system.', '2024-03-05 13:57:55'),
(104, '7', 'Login into the system.', '2024-03-05 13:58:16'),
(105, '7', 'Approved the payment.', '2024-03-05 14:00:04'),
(106, '2', 'Rate a product.', '2024-03-05 15:08:49'),
(107, '7', 'Logout to the system.', '2024-03-05 15:09:36'),
(108, '5', 'Login into the system.', '2024-03-05 15:09:43'),
(109, '5', 'Logout to the system.', '2024-03-05 15:25:59'),
(110, '2', 'Login into the system.', '2024-03-05 15:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `order_status` int(11) NOT NULL COMMENT '0 - cart;\r\n1 - bought;\r\n2 - on deliver;\r\n3 - completed;\r\n4 - declined\r\n5- waiting to accept the payment',
  `payment_confirm` int(11) DEFAULT NULL COMMENT '1 - confirmed\r\n0 - not confirmed',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_track`
--

CREATE TABLE `order_track` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `track` text NOT NULL,
  `account_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `deleted_product` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `image`, `product_type`, `description`, `price`, `quantity`, `account_id`, `deleted_product`) VALUES
(2, 'p1', 'Screenshot_20231106-152803.png', 'Furniture', 'p1 description', '5500', 6, 1, 0),
(3, 's1', 'restau.png', 'E-Toy', 's1 description', '110', 7, 1, 0),
(6, 'Sample Product', 'Screenshot_20230216_044223.png', 'Goods', 'Sample description', '400', 8, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comments` text NOT NULL,
  `account_id` int(11) NOT NULL,
  `date_rated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `order_id`, `rating`, `comments`, `account_id`, `date_rated`) VALUES
(1, 6, 5, 'dadw dadad wadaw', 2, '2024-03-05 15:08:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `declined_items`
--
ALTER TABLE `declined_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_track`
--
ALTER TABLE `order_track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `declined_items`
--
ALTER TABLE `declined_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_track`
--
ALTER TABLE `order_track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
