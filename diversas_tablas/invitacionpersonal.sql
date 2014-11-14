-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2011 at 04:42 PM
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
-- Table structure for table `invitacionpersonal`
--

CREATE TABLE IF NOT EXISTS `invitacionpersonal` (
  `invitacionPersonalId` int(11) NOT NULL AUTO_INCREMENT,
  `invitacionUsuarioPersonalId` int(11) NOT NULL,
  `invitacionInvitadoPersonalId` int(11) NOT NULL,
  `invitacionPersonalPlanId` int(11) NOT NULL,
  `invitacionPersonalAceptadoId` tinyint(3) NOT NULL COMMENT '0 neutro, 1 aceptado, 2 rechazado',
  `invitacionPersonalMensaje` varchar(400) COLLATE utf8_bin NOT NULL,
  `invitacionPersonalStatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'status de visualizacion de mensaje, 0 visto, 1 no visto',
  PRIMARY KEY (`invitacionPersonalId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `invitacionpersonal`
--

INSERT INTO `invitacionpersonal` (`invitacionPersonalId`, `invitacionUsuarioPersonalId`, `invitacionInvitadoPersonalId`, `invitacionPersonalPlanId`, `invitacionPersonalAceptadoId`, `invitacionPersonalMensaje`, `invitacionPersonalStatus`) VALUES
(1, 14, 1, 5, 0, '1', 1),
(2, 1, 2, 5, 0, '1', 1);
