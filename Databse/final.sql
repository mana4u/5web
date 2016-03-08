-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2016 at 10:11 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@admin.com', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `newsletter` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstName`, `lastName`, `email`, `password`, `newsletter`) VALUES
(4, '1', '1', '1@gmail.com', '*E6CC90B878B948C35E92B003C792C46C58C4AF40', 0),
(5, '3', '3', '3@gmail.com', '*C4E74DDDC9CC9E2FDCDB7F63B127FB638831262E', 0),
(6, '4', '4', '4@gmail.com', '*908BE2B7EB7D7567F7FF98716850F59BA69AA9DB', 0),
(7, '2', '2', '2@gmail.com', '*12033B78389744F3F39AC4CE4CCFCAD6960D8EA0', 0),
(8, '6', '6', '6@gmail.com', '*C3AB9ECDF746570BBF9DCAA9DB3586D25956DC93', 0),
(9, 'Junghan', 'Kim', 'kmana4u@gmail.com', '*3012C423C09F943B5387A4E2E41F846F00D67B61', 0),
(10, 'dasd', 'kim', '1mana4u@naver.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', 0),
(12, '123', '123', '123@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 1),
(13, '23', '12', '32@naver.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', 0),
(20, '123', '23', '12323a2@naver.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', 0),
(21, '123', '23123', 'x2323@naver.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 0),
(24, '323', '1232', '2c23@naver.com', '*962A429C7BB4542923310C7E4A156A3F7FE97CC6', 0),
(26, '23x2', '23sd', 'x2234@gmail.com', '*C1E00ADB0335EFCA26901C4514571AB2EA245C42', 1),
(27, 'x23', '23213', '2312@naver.com', '*B0C0F6DA81AA3819708C74D601828DAA572BDDE6', 0),
(28, 'nasd2', 'rkwek', 'nasd@naver.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `email` varchar(100) NOT NULL,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`email`) VALUES
('kmana4u@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE IF NOT EXISTS `orderitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `order_id`, `product_id`) VALUES
(8, 37, 1),
(9, 37, 1),
(10, 41, 1),
(11, 42, 1),
(12, 43, 2),
(13, 44, 1),
(14, 44, 2),
(15, 44, 3),
(16, 45, 2),
(17, 46, 3),
(18, 46, 5),
(19, 65, 1),
(21, 47, 1),
(22, 47, 1),
(23, 47, 1),
(24, 48, 1),
(30, 50, 1),
(33, 51, 1),
(34, 49, 1),
(35, 52, 1),
(36, 53, 1),
(37, 54, 1),
(38, 55, 3),
(39, 56, 1),
(40, 57, 1),
(41, 58, 1),
(42, 59, 3),
(43, 60, 1),
(45, 62, 1),
(46, 61, 1),
(47, 63, 1),
(48, 63, 2),
(49, 63, 3),
(70, 64, 1),
(72, 64, 5),
(73, 64, 1),
(74, 64, 1),
(76, 66, 0),
(77, 67, 2),
(78, 68, 2),
(79, 69, 2),
(80, 70, 0),
(81, 71, 3),
(82, 72, 3),
(83, 73, 3),
(84, 74, 3),
(85, 75, 3),
(86, 76, 3),
(87, 77, 0),
(88, 78, 0),
(89, 79, 3),
(90, 80, 0),
(91, 81, 0),
(92, 82, 0),
(93, 83, 3),
(94, 84, 3),
(95, 85, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `total` float NOT NULL,
  `Paid` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `date`, `total`, `Paid`) VALUES
(41, 4, '2016-02-03 20:11:18', 278.91, 1),
(42, 4, '2016-02-03 20:11:50', 278.91, 1),
(43, 4, '2016-02-03 20:19:54', 532.87, 1),
(44, 4, '2016-02-03 20:25:26', 654.83, 1),
(45, 9, '2016-02-03 21:10:16', 409.9, 1),
(46, 9, '2016-02-03 21:10:34', 619.82, 1),
(48, 4, '2016-02-18 22:30:05', 309.9, 1),
(49, 4, '2016-02-18 22:31:06', 247.92, 1),
(50, 4, '2016-02-18 22:32:52', 30.99, 1),
(51, 4, '2016-02-18 22:37:26', 30.99, 1),
(52, 4, '2016-02-18 22:37:51', 30.99, 1),
(53, 4, '2016-02-18 22:40:19', 309.9, 1),
(54, 4, '2016-02-18 22:41:08', 30.99, 1),
(55, 4, '2016-02-18 22:41:26', 76, 1),
(56, 4, '2016-02-18 22:41:42', 402.87, 1),
(57, 4, '2016-02-18 22:42:09', 30.99, 1),
(58, 4, '2016-02-18 22:46:18', 340.89, 1),
(59, 4, '2016-02-18 22:46:53', 80, 1),
(60, 4, '2016-02-18 22:46:35', 30.99, 1),
(61, 4, '2016-02-26 01:18:24', 216.93, 1),
(62, 4, '2016-02-18 22:51:58', 30.99, 1),
(63, 12, '2016-03-02 17:22:22', 87.98, 1),
(64, 12, '2016-03-08 01:05:25', 158.96, 1),
(68, 12, '2016-03-07 23:06:27', 0, 1),
(69, 12, '2016-03-07 23:09:12', 42.99, 1),
(79, 12, '2016-03-08 00:09:59', 4, 1),
(84, 12, '2016-03-08 00:40:15', 4, 1),
(85, 12, '2016-03-08 01:05:18', 40.99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `cata` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `promotion` tinyint(4) NOT NULL,
  `freebie` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `cata`, `description`, `image`, `price`, `promotion`, `freebie`) VALUES
(1, 'C++', 2, 'Best C++ x', 'c.jpg', 42.99, 1, 0),
(2, 'JAVA', 2, 'Best JAVA Book', 'java.jpg', 40.99, 0, 1),
(3, 'DVD', 1, 'DVD', 'LI.png', 4, 0, 0),
(4, 'dummy', 1, 'dummy', 'twitter.png', 5.99, 0, 0),
(5, 'Youtube', 3, 'video', 'youtube.png', 29.99, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE IF NOT EXISTS `redeem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(40) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `code` varchar(16) NOT NULL,
  `used` tinyint(11) NOT NULL,
  `price` float NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `redeem`
--

INSERT INTO `redeem` (`id`, `user_email`, `pro_id`, `code`, `used`, `price`, `date`) VALUES
(10, '123@gmail.com', 3, ',-VgM#wscbiN6r$_', 1, 4, '2016-03-07 22:50:58'),
(11, '123@gmail.com', 2, '018yXJ@+gjk93;5O', 1, 40.99, '2016-03-08 01:04:42');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
