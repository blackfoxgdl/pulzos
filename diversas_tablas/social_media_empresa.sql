-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2011 at 07:04 PM
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
-- Table structure for table `social_media_empresa`
--

CREATE TABLE IF NOT EXISTS `social_media_empresa` (
  `socialEmpresaId` int(11) NOT NULL AUTO_INCREMENT,
  `uidFacebook` varchar(400) COLLATE utf8_bin NOT NULL,
  `tokenFacebook` varchar(400) COLLATE utf8_bin NOT NULL,
  `twitter_oauth` varchar(400) COLLATE utf8_bin NOT NULL,
  `twitter_oauth_secret` varchar(400) COLLATE utf8_bin NOT NULL,
  `mensajeFacebook` varchar(400) COLLATE utf8_bin NOT NULL,
  `mensajeTwitter` varchar(150) COLLATE utf8_bin NOT NULL,
  `socialEmpresaUsuarioId` int(11) NOT NULL,
  PRIMARY KEY (`socialEmpresaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Social media de parte de la empresa' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `social_media_empresa`
--

