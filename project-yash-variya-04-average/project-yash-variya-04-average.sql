-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2023 at 07:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-yash-variya-04-average`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(12, 'dhruv tilwa', 'dhruv@gmil.com', '12345678', 1, '2023-03-30 10:20:25', '2023-03-30 13:56:08'),
(13, 'rohit patel', 'Rohit@gmail.com', 'rohit@1234', 0, '2023-03-30 10:22:05', NULL),
(14, 'raaj parmar', 'raaj@5454.com', 'raaj@1234', 2, '2023-03-30 10:22:29', '2023-03-30 22:13:53'),
(15, 'rishabh patel', 'rishabh@gmail.com', 'rishbh@1234', 1, '2023-03-30 10:22:51', '2023-03-30 13:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) NOT NULL,
  `parent_id` tinyint(4) NOT NULL,
  `path` varchar(100) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `status` tinyint(10) NOT NULL,
  `discription` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `path`, `name`, `status`, `discription`, `created_at`, `updated_at`) VALUES
(41, 0, NULL, 'Bedroom', 1, 'good', '2023-03-31 11:41:37', NULL),
(42, 41, NULL, 'Beds', 2, 'good', '2023-03-31 11:42:08', NULL),
(45, 44, NULL, 'beds', 1, 'good', '2023-03-31 14:52:12', NULL),
(46, 45, NULL, 'chair', 1, 'good', '2023-03-31 14:52:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `costomeraddress`
--

CREATE TABLE `costomeraddress` (
  `address_id` int(10) NOT NULL,
  `costomer_id` int(10) NOT NULL,
  `address` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `costomeraddress`
--

INSERT INTO `costomeraddress` (`address_id`, `costomer_id`, `address`, `city`, `state`, `country`, `zipcode`, `updated_at`) VALUES
(82, 165, 'ahemdabad', 'ahembada', 'gujarat', 'india', 784578, '2023-04-02 23:36:09'),
(83, 166, 'katargam', 'surat', 'gujrat', 'india', 395004, '2023-04-02 23:38:48'),
(84, 167, 'vadodara', 'vadodara', 'gujrat', 'idnia', 987549, '2023-04-02 23:37:37'),
(85, 168, 'v.v.nagar', 'anand', 'gujarat', 'india', 989898, '2023-04-02 23:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `costomer_id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `mobile` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`costomer_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(165, 'ramesh', 'patel', 'ramesh@1234', '1', 968788488, '1', '2023-04-02 23:36:09', NULL),
(166, 'mukesh', 'Soni', 'mukesh@gmail.com', '1', 989898897, '1', '2023-04-02 23:36:55', '2023-04-02 23:38:48'),
(167, 'ratan', 'tank', 'ratan@gmail.com', '1', 2147483647, '1', '2023-04-02 23:37:37', NULL),
(168, 'ram', 'bhai', 'ram@gmail.com', '1', 2147483647, '1', '2023-04-02 23:38:29', '2023-04-02 23:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_method_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_method_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(10, 'upi', '1', '2023-03-14 14:47:34', '2023-04-02 03:18:22'),
(11, 'gpay', '2', '2023-03-14 14:47:45', NULL),
(12, 'banking system', '1', '2023-03-14 14:47:54', '2023-03-14 14:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(20) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `cost` int(20) NOT NULL,
  `price` int(20) NOT NULL,
  `sku` int(20) NOT NULL,
  `status` enum('1','2') NOT NULL,
  `quantity` int(20) NOT NULL,
  `discription` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL,
  `material` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `cost`, `price`, `sku`, `status`, `quantity`, `discription`, `color`, `material`, `created_at`, `updated_at`) VALUES
(290, 'charger', 1500, 2000, 1578, '1', 10, 'good qualityty', 'black', 'awesome', '2023-04-01 17:19:40', NULL),
(291, 'Mobiles', 50000, 45100, 1548, '', 10, 'good qualityty', 'red', 'nice', '2023-04-01 17:20:18', '2023-04-01 17:21:38'),
(292, 'eurbuds', 2000, 3000, 4578, '1', 10, 'awesome', 'grey', 'awesome', '2023-04-01 17:20:58', NULL),
(293, 'Laptops', 10000, 30000, 4578, '2', 10, 'awesome', 'blue', 'good', '2023-04-01 17:21:30', '2023-04-03 23:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `image_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `image` varchar(20) NOT NULL,
  `thumbnail` tinyint(4) NOT NULL,
  `small` tinyint(4) NOT NULL,
  `base` tinyint(4) NOT NULL,
  `gallery` int(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`image_id`, `product_id`, `name`, `image`, `thumbnail`, `small`, `base`, `gallery`, `status`, `created_at`, `updated_at`) VALUES
(209, 290, 'Lenova', '209.jpg', 0, 0, 1, 1, 1, '2023-04-03 23:12:30', '2023-04-03 23:16:58'),
(210, 290, 'Hp', '210.jpg', 1, 0, 0, 1, 2, '2023-04-03 23:12:44', '2023-04-03 23:16:58'),
(211, 290, 'Mac book', '211.jpg', 0, 1, 0, 0, 1, '2023-04-03 23:13:05', '2023-04-03 23:16:58'),
(213, 291, 'realme', '213.jpg', 0, 1, 0, 0, 1, '2023-04-03 23:17:45', '2023-04-03 23:18:52'),
(214, 291, 'mi', '214.jpg', 1, 0, 0, 1, 2, '2023-04-03 23:18:09', '2023-04-03 23:18:52'),
(215, 291, 'i phone', '215.jpg', 0, 0, 1, 0, 1, '2023-04-03 23:18:37', '2023-04-03 23:18:52'),
(216, 292, 'boat', '216.png', 0, 0, 1, 1, 1, '2023-04-03 23:19:37', '2023-04-03 23:20:19'),
(217, 292, 'noise', '217.jpeg', 1, 0, 0, 0, 2, '2023-04-03 23:19:53', '2023-04-03 23:20:19'),
(218, 292, 'realme', '218.jpg', 0, 1, 0, 0, 1, '2023-04-03 23:20:09', '2023-04-03 23:20:19'),
(219, 293, 'lenova', '219.png', 0, 1, 0, 0, 2, '2023-04-03 23:20:54', '2023-04-03 23:21:44'),
(220, 293, 'mac book', '220.jpg', 1, 0, 0, 1, 2, '2023-04-03 23:21:11', '2023-04-03 23:21:44'),
(221, 293, 'hp', '221.jpg', 0, 0, 1, 1, 2, '2023-04-03 23:21:35', '2023-04-03 23:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesman_id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `mobile` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `company` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesman_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(67, 'mukesh', 'tank', 'user@gmail.com', '1', 98989898, '', 'the one', '2023-04-02 23:55:12', '2023-04-02 23:56:10'),
(68, 'ramesh', 'dayal', 'ramesh@gmail.com', '1', 98989898, '1', 'tcs', '2023-04-02 23:56:59', NULL),
(69, 'dhaval', 'tank', 'dhaval@gmail.com', '1', 98989, '', 'the enfochips', '2023-04-02 23:57:45', NULL),
(70, 'ronak', 'patel', 'nikunj@gmail.com', '1', 989898910, '2', 'cybercoms', '2023-04-02 23:58:30', '2023-04-02 23:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `salesmanaddress`
--

CREATE TABLE `salesmanaddress` (
  `address_id` int(10) NOT NULL,
  `salesman_id` int(10) NOT NULL,
  `address` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesmanaddress`
--

INSERT INTO `salesmanaddress` (`address_id`, `salesman_id`, `address`, `city`, `state`, `country`, `zipcode`, `updated_at`) VALUES
(46, 67, 'v.v.nagar', 'anand', 'gujarat', 'india', 235078, '2023-04-02 23:56:11'),
(47, 68, 'baroda', 'vadodara', 'gujrat', 'india', 889898, '2023-04-02 23:56:59'),
(48, 69, 'ahemdabad', 'ahemdabad', 'gujrat', 'india', 989898, '2023-04-02 23:57:45'),
(49, 70, 'katargam', 'surat', 'gujrat', 'india', 395004, '2023-04-02 23:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `salesman_price`
--

CREATE TABLE `salesman_price` (
  `entity_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `salesman_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `shipping_method_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `amount` int(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`shipping_method_id`, `name`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(13, 'buses', 5000, '1', '2023-03-14 14:43:44', '2023-04-02 15:03:47'),
(14, 'Airs', 8000, '2', '2023-03-14 14:44:41', '2023-04-02 15:08:33'),
(15, 'Rail', 6500, '1', '2023-03-14 14:44:57', '2023-03-14 14:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `mobile` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `discription` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `discription`, `created_at`, `updated_at`) VALUES
(51, 'mukesh', 'jena', 'mukesh@gmail.com', '1', 875478787, '1', 'Employee', '2023-04-02 23:41:10', '2023-04-02 23:41:53'),
(52, 'sanjay', 'danger', 'sanjay@gmail.com', '1', 989889898, '1', 'student', '2023-04-02 23:42:43', NULL),
(53, 'rohit', 'purohit', 'rohit@gmail.com', '1', 2147483647, '1', 'manager', '2023-04-02 23:43:32', NULL),
(54, 'karan', 'sharma', 'karan@gmail.com', '1', 98989898, '1', 'student', '2023-04-02 23:44:18', '2023-04-02 23:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `vendoraddress`
--

CREATE TABLE `vendoraddress` (
  `address_id` int(10) NOT NULL,
  `vendor_id` int(10) NOT NULL,
  `address` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendoraddress`
--

INSERT INTO `vendoraddress` (`address_id`, `vendor_id`, `address`, `city`, `state`, `country`, `zipcode`, `updated_at`) VALUES
(33, 51, 'vastrapur', 'ahemdabad', 'gujrat', 'india', 397848, '2023-04-02 23:41:53'),
(34, 52, 'v.v.nagar', 'anand', 'gujrat', 'india', 235787, '2023-04-02 23:42:43'),
(35, 53, 'baroda', 'vadodara', 'gujrat', 'india', 989898, '2023-04-02 23:43:32'),
(36, 54, 'katargam', 'surat', 'gujarat', 'india', 395004, '2023-04-02 23:44:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `costomeraddress`
--
ALTER TABLE `costomeraddress`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `costomeraddress_ibfk_1` (`costomer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`costomer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `salesmanaddress`
--
ALTER TABLE `salesmanaddress`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `salesman_id` (`salesman_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`shipping_method_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendoraddress`
--
ALTER TABLE `vendoraddress`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `costomeraddress`
--
ALTER TABLE `costomeraddress`
  MODIFY `address_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `costomer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_method_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `image_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesman_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `salesmanaddress`
--
ALTER TABLE `salesmanaddress`
  MODIFY `address_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `salesman_price`
--
ALTER TABLE `salesman_price`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `shipping_method_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `vendoraddress`
--
ALTER TABLE `vendoraddress`
  MODIFY `address_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `costomeraddress`
--
ALTER TABLE `costomeraddress`
  ADD CONSTRAINT `costomeraddress_ibfk_1` FOREIGN KEY (`costomer_id`) REFERENCES `customer` (`costomer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesmanaddress`
--
ALTER TABLE `salesmanaddress`
  ADD CONSTRAINT `salesmanaddress_ibfk_1` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD CONSTRAINT `salesman_price_ibfk_1` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salesman_price_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendoraddress`
--
ALTER TABLE `vendoraddress`
  ADD CONSTRAINT `vendoraddress_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
