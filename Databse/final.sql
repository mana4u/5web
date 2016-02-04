-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2016 at 06:22 AM
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
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `subscription` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstName`, `lastName`, `phone`, `email`, `password`, `subscription`) VALUES
(4, '1', '1', '1', '1@gmail.com', '*E6CC90B878B948C35E92B003C792C46C58C4AF40', 0),
(5, '3', '3', '3', '3', '*C4E74DDDC9CC9E2FDCDB7F63B127FB638831262E', 0),
(6, '4', '4', '4', '4', '*908BE2B7EB7D7567F7FF98716850F59BA69AA9DB', 0),
(7, '2', '2', '2503006248', '2', '*12033B78389744F3F39AC4CE4CCFCAD6960D8EA0', 0),
(8, '6', '6', '6', '6', '*C3AB9ECDF746570BBF9DCAA9DB3586D25956DC93', 0),
(9, 'Junghan', 'Kim', '2503006248', 'kmana4u@gmail.com', '*A4B6157319038724E3560894F7F932C8886EBFCF', 0);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`email`) VALUES
('benleon@msn.com');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE IF NOT EXISTS `orderitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(8, 37, 1, 7),
(9, 37, 1, 11),
(10, 41, 1, 9),
(11, 42, 1, 9),
(12, 43, 2, 13),
(13, 44, 1, 9),
(14, 44, 2, 8),
(15, 44, 3, 12),
(16, 45, 2, 10),
(17, 46, 3, 20),
(18, 46, 5, 18);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `date`, `total`, `Paid`) VALUES
(41, 4, '2016-02-03 20:11:18', 278.91, 1),
(42, 4, '2016-02-03 20:11:50', 278.91, 1),
(43, 4, '2016-02-03 20:19:54', 532.87, 1),
(44, 4, '2016-02-03 20:25:26', 654.83, 1),
(45, 9, '2016-02-03 21:10:16', 409.9, 1),
(46, 9, '2016-02-03 21:10:34', 619.82, 1);

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
  `freebie` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `cata`, `description`, `image`, `price`, `freebie`) VALUES
(1, 'C++', 2, 'Best C++ Book', 'c.jpg', 30.99, 1),
(2, 'JAVA', 2, 'Best JAVA Book', 'java.jpg', 40.99, 0),
(3, 'DVD', 1, 'DVD', '', 4, 0),
(4, 'dummy', 1, 'dummy', '', 5.99, 0),
(5, 'Youtube', 3, 'video', '', 29.99, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
