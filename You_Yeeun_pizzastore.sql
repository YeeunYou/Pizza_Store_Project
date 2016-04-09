-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2015 at 08:23 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `You_Yeeun_pizzastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblCart`
--

CREATE TABLE IF NOT EXISTS `tblCart` (
  `cart_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(10) NOT NULL,
  `size` varchar(35) NOT NULL,
  `dough` varchar(35) NOT NULL,
  `sauce` varchar(35) NOT NULL,
  `cheese` varchar(35) NOT NULL,
  `veggie` varchar(35) NOT NULL,
  `meat` varchar(35) NOT NULL,
  `seasoning` varchar(35) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblCustomers`
--

CREATE TABLE IF NOT EXISTS `tblCustomers` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  `lastname` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `streetNumber` int(35) NOT NULL,
  `streetName` varchar(35) NOT NULL,
  `aptNumber` int(35) NOT NULL,
  `city` varchar(35) NOT NULL,
  `province` varchar(2) NOT NULL,
  `postalCode` varchar(6) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblOrders`
--

CREATE TABLE IF NOT EXISTS `tblOrders` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `pizza_id` int(10) NOT NULL,
  `dateOrdered` date NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblPizza`
--

CREATE TABLE IF NOT EXISTS `tblPizza` (
  `pizza_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `size` varchar(35) NOT NULL,
  `dough` varchar(35) NOT NULL,
  `sauce` varchar(35) NOT NULL,
  `cheese` varchar(35) NOT NULL,
  `veggie` varchar(35) NOT NULL,
  `meat` varchar(35) NOT NULL,
  `seasoning` varchar(35) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`pizza_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
