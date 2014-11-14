-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2011 at 04:39 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pulzos_bueno`
--

-- --------------------------------------------------------

--
-- Table structure for table `productos_categorias`
--

CREATE TABLE IF NOT EXISTS `productos_categorias` (
  `prodCatId` int(11) NOT NULL AUTO_INCREMENT,
  `product_category` varchar(400) COLLATE utf8_bin DEFAULT '0',
  `idOfertas` int(11) DEFAULT '0',
  PRIMARY KEY (`prodCatId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='tabla donde se guardan los productos o categoruas' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `productos_categorias`
--

