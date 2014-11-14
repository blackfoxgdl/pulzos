-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 30, 2012 at 06:17 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.7

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
-- Table structure for table `bancos`
--

CREATE TABLE IF NOT EXISTS `bancos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id del banco',
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Nombre del banco',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabla donde se manejaran los bancos de mexico para las trasn' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `bancos`
--

INSERT INTO `bancos` (`id`, `nombre`) VALUES
(1, 'Selecciona un banco'),
(2, 'BBVA Bancomer'),
(3, 'Santander Serfin'),
(4, 'Banorte'),
(5, 'Scotiabank Inverlat'),
(6, 'Banamex'),
(7, 'HSBC'),
(8, 'Banregio'),
(9, 'Ixe'),
(10, 'Inbursa'),
(11, 'Bansi');
