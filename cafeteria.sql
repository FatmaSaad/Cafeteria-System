-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 01:37 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafeteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `room_number` int(11) NOT NULL,
  `ext` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`user_id`, `user_name`, `email`, `password`, `room_number`, `ext`, `image`, `deleted`) VALUES
(1, 'fatma_s3@yahoo.com', 'fatma_s3@yahoo.com', '123', 5, 33, NULL, 0),
(3, 'fatmatttt', 'fatmasaad313@gmail.com', '$2y$10$Ye6ALIh7pyfIQi1ITy2l5eTaUQT9NLQr2LmWeZtGbuBbIhQE2e/3C', 5, 5, '../uploads/FB_IMG_1524339648861.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `state` enum('ordered','processing','delivered') NOT NULL DEFAULT 'ordered',
  `total_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_notes` varchar(100) DEFAULT NULL,
  `room_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `date`, `state`, `total_price`, `user_id`, `order_notes`, `room_number`) VALUES
(1, '2020-03-15 19:22:08', 'ordered', 198, 3, '7', 8),
(2, '2020-03-15 19:22:10', 'ordered', 198, 3, '7', 8),
(3, '2020-03-15 19:22:12', 'ordered', 198, 3, '7', 8),
(4, '2020-03-15 19:26:53', 'ordered', 198, 3, '7', 8),
(5, '2020-03-15 19:27:11', 'ordered', 198, 3, '7', 8),
(6, '2020-03-15 19:27:27', 'ordered', 198, 3, '7', 8),
(7, '2020-03-15 19:33:56', 'ordered', 198, 3, '7', 8),
(8, '2020-03-15 19:34:30', 'ordered', 198, 3, '7', 8),
(9, '2020-03-15 19:35:17', 'ordered', 198, 3, '7', 8),
(10, '2020-03-15 19:35:42', 'ordered', 198, 3, '7', 8),
(11, '2020-03-15 19:35:57', 'ordered', 198, 3, '7', 8),
(12, '2020-03-15 19:37:48', 'ordered', 198, 3, '7', 8),
(13, '2020-03-15 19:38:04', 'ordered', 198, 3, '7', 8),
(14, '2020-03-15 19:42:06', 'ordered', 132, 3, 'fffffffffffff', 2),
(20, '2020-03-16 00:26:52', 'ordered', 2, 3, 'fffffffffffff', 5),
(21, '2020-03-16 00:27:44', 'ordered', 2, 3, 'fffffffffffff', 5),
(22, '2020-03-16 00:28:29', 'ordered', 2, 3, 'fffffffffffff', 5),
(23, '2020-03-16 00:29:04', 'ordered', 2, 3, 'fffffffffffff', 5),
(24, '2020-03-16 00:30:21', 'ordered', 15, 3, 'fffffffffffff', 5),
(25, '2020-03-16 00:32:33', 'ordered', 3, 3, 'fffffffffffff', 5),
(26, '2020-03-16 00:32:56', 'ordered', 11, 3, 'fffffffffffff', 5),
(27, '2020-03-16 00:35:33', 'ordered', 6, 3, 'fffffffffffff11111111111111', -14),
(28, '2020-03-16 00:36:28', 'ordered', 11, 3, 'fffffffffffff11111111111111', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `product_amount`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 1, 0),
(4, 1, 0),
(5, 1, 0),
(6, 1, 0),
(12, 1, 4),
(12, 2, 2),
(13, 1, 4),
(13, 2, 2),
(14, 1, 3),
(14, 2, 1),
(20, 1, 2),
(21, 1, 2),
(22, 1, 2),
(23, 1, 2),
(24, 2, 3),
(25, 1, 3),
(26, 1, 1),
(26, 2, 2),
(27, 1, 1),
(27, 2, 1),
(28, 1, 1),
(28, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `deleted_product` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `image`, `category`, `deleted_product`) VALUES
(1, 'tt', 1, 'apple.jpg', 'orange', 0),
(2, 'tt', 5, 'orange.jpg', 'orange', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `ext` (`ext`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `clients` (`user_id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
