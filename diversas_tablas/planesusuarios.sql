-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2011 at 06:00 PM
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
-- Table structure for table `planesusuarios`
--

CREATE TABLE IF NOT EXISTS `planesusuarios` (
  `planId` int(11) NOT NULL AUTO_INCREMENT,
  `planUsuarioId` int(11) DEFAULT NULL,
  `planAmigoUsuarioId` int(11) DEFAULT '0' COMMENT 'Se usara para saber si un usuario ha posteado en tu wall',
  `planTipo` smallint(6) DEFAULT NULL,
  `planMensaje` text COLLATE utf8_bin,
  `planImagenId` varchar(400) COLLATE utf8_bin DEFAULT '0',
  `planFechaInicio` int(11) DEFAULT NULL,
  `planFechaFin` int(11) DEFAULT NULL,
  `planHoraInicio` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `planHoraFin` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `planDescripcion` varchar(5000) COLLATE utf8_bin NOT NULL,
  `planFechaCreacion` int(11) NOT NULL,
  `planLugar` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `planDireccion` varchar(400) COLLATE utf8_bin NOT NULL,
  `planInvitados` text COLLATE utf8_bin,
  `planEsEmpresa` int(11) DEFAULT '0' COMMENT 'Saber si el plan es directamente con una empresa o no',
  `planIdEmpresa` int(11) DEFAULT NULL COMMENT 'id de la empresa en la que se esta armando el plan',
  `planEmpresaPosteo` int(11) DEFAULT '0' COMMENT 'id de la empresa que realizo un comentario o posteo',
  `planEmpresaPulzoId` int(11) DEFAULT '0' COMMENT 'Id de la tabla de pulzos donde se posteo el plan, para conocer a cual pertenece el plan',
  PRIMARY KEY (`planId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=128 ;

--
-- Dumping data for table `planesusuarios`
--

INSERT INTO `planesusuarios` (`planId`, `planUsuarioId`, `planAmigoUsuarioId`, `planTipo`, `planMensaje`, `planImagenId`, `planFechaInicio`, `planFechaFin`, `planHoraInicio`, `planHoraFin`, `planDescripcion`, `planFechaCreacion`, `planLugar`, `planDireccion`, `planInvitados`, `planEsEmpresa`, `planIdEmpresa`, `planEmpresaPosteo`, `planEmpresaPulzoId`) VALUES
(1, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'prueba 1', 1314720846, NULL, '', NULL, 0, NULL, 0, 0),
(2, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'hola\n', 1314725317, NULL, '', NULL, 0, NULL, 0, 0),
(3, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'hola a tosos\nsdfsdf\n', 1314725330, NULL, '', NULL, 0, NULL, 0, 0),
(4, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasdasd\nasdasd\n', 1314725359, NULL, '', NULL, 0, NULL, 0, 0),
(5, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasdasdasd\n\n\n', 1314725549, NULL, '', NULL, 0, NULL, 0, 0),
(6, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd\nsdfsdf\n\n\n\n\n\n', 1314725605, NULL, '', NULL, 0, NULL, 0, 0),
(9, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'ddddd', 1314733669, NULL, '', NULL, 0, NULL, 0, 0),
(10, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'hola', 1314748798, NULL, '', NULL, 0, NULL, 0, 0),
(11, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'hola hola', 1314748810, NULL, '', NULL, 0, NULL, 0, 0),
(12, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'chingado', 1314748826, NULL, '', NULL, 0, NULL, 0, 0),
(13, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'chingado', 1314748933, NULL, '', NULL, 0, NULL, 0, 0),
(14, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'hhhhhhh', 1314748959, NULL, '', NULL, 0, NULL, 0, 0),
(15, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'ttttttttt', 1314748969, NULL, '', NULL, 0, NULL, 0, 0),
(16, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'ash', 1314748999, NULL, '', NULL, 0, NULL, 0, 0),
(17, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'ttttt\n', 1314749019, NULL, '', NULL, 0, NULL, 0, 0),
(18, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314809706, NULL, '', NULL, 0, NULL, 0, 0),
(19, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314809706, NULL, '', NULL, 0, NULL, 0, 0),
(20, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314809706, NULL, '', NULL, 0, NULL, 0, 0),
(21, 2, 0, NULL, 'asdasdasd', '0', 1314766800, NULL, '12:00 pm', NULL, 'asdasdasdasd', 1314814470, 'asdasdasd', 'asdasdasd', '1,', 0, NULL, 0, 0),
(22, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'eeeeee', 1314831012, NULL, '', NULL, 0, NULL, 0, 0),
(23, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'eeeeee', 1314831012, NULL, '', NULL, 0, NULL, 0, 0),
(24, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'wwwww', 1314831268, NULL, '', NULL, 0, NULL, 0, 0),
(25, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'werwerewr', 1314831272, NULL, '', NULL, 0, NULL, 0, 0),
(26, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'weewrwerewr', 1314831276, NULL, '', NULL, 0, NULL, 0, 0),
(27, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'hollaaaaaaa', 1314831289, NULL, '', NULL, 0, NULL, 0, 0),
(28, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'hola carlos como estas???', 1314831303, NULL, '', NULL, 0, NULL, 0, 0),
(29, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'fffff', 1314833277, NULL, '', NULL, 0, NULL, 0, 0),
(30, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'qwqwqwqw', 1314833360, NULL, '', NULL, 0, NULL, 0, 0),
(31, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'rrrrrrr', 1314833398, NULL, '', NULL, 0, NULL, 0, 0),
(32, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'rrrr', 1314833402, NULL, '', NULL, 0, NULL, 0, 0),
(33, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'rrrrrr', 1314833405, NULL, '', NULL, 0, NULL, 0, 0),
(34, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasdasd', 1314833485, NULL, '', NULL, 0, NULL, 0, 0),
(35, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'gola', 1314888581, NULL, '', NULL, 0, NULL, 0, 0),
(36, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'wwwwwwww', 1314888606, NULL, '', NULL, 0, NULL, 0, 0),
(37, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasdasdasd', 1314889107, NULL, '', NULL, 0, NULL, 0, 0),
(38, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'hola como estas???', 1314889129, NULL, '', NULL, 0, NULL, 0, 0),
(39, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, '¿Qué quieres hacer hoy?sdfsdfsdf', 1314893958, NULL, '', NULL, 0, NULL, 0, 0),
(40, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 1314896872, NULL, '', NULL, 0, NULL, 0, 0),
(41, 2, 1, 2, 'te ha enviado un saludo', '0', 0, 0, '0', '0', '0', 1314898796, '0', '0', '0', 0, NULL, 0, 0),
(42, 1, 0, NULL, 'asdasdasd', '0', 1314853200, NULL, '12:00 pm', NULL, 'asdasdasd', 1314901520, 'asdasd', 'asdasd', '2,', 0, NULL, 0, 0),
(43, 2, 1, 4, 'si ha pulzado en tu plan', '0', 0, 0, '0', '0', '0', 1314901546, '0', '0', '0', 0, NULL, 0, 0),
(44, 1, 0, NULL, 'a', '0', 1314853200, NULL, '12:00 pm', NULL, 'a', 1314902089, 'a', 'a', '2,', 0, NULL, 0, 0),
(45, 2, 1, 5, 'no ha pulzado en tu plan', '0', 0, 0, '0', '0', '0', 1314902109, '0', '0', '0', 0, NULL, 0, 0),
(46, 1, 0, NULL, 'qwe', '0', 1314853200, NULL, '12:00 pm', NULL, 'qwe', 1314902380, 'qwe', 'qwe', '2,', 0, NULL, 0, 0),
(47, 2, 1, 4, 'si ha pulzado en tu plan', '0', 0, 0, '0', '0', '0', 1314902395, '0', '0', '0', 0, NULL, 0, 0),
(48, 1, 0, NULL, 'Reunion en vvvvvv', '0', 1314853200, NULL, '12:00 pm', NULL, 'wwwwwwwwwwwwwwwwwwwwwwwww', 1314903063, 'vvvvvv', 'vvvvvv', '2,', 1, 27, 0, 0),
(49, 2, 1, 4, 'si ha pulzado en tu plan', '0', 0, 0, '0', '0', '0', 1314914343, '0', '0', '0', 0, NULL, 0, 0),
(50, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'Ruben Alonso ha compartido un link contigo.', 1314918698, NULL, '', NULL, 0, NULL, 0, 0),
(51, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'Ruben Alonso ha compartido una foto contigo.', 1314918711, NULL, '', NULL, 0, NULL, 0, 0),
(52, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'Ruben Alonso ha compartido un link contigo.', 1314918843, NULL, '', NULL, 0, NULL, 0, 0),
(53, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314918847, NULL, '', NULL, 0, NULL, 0, 0),
(54, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'Ruben Alonso ha compartido una foto contigo.', 1314918853, NULL, '', NULL, 0, NULL, 0, 0),
(55, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'sdfsdfsdfsdfsdf', 1314919874, NULL, '', NULL, 0, NULL, 0, 0),
(56, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasdasds', 1314920102, NULL, '', NULL, 0, NULL, 0, 0),
(57, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314920148, NULL, '', NULL, 0, NULL, 0, 0),
(58, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'prueba nueva', 1314920156, NULL, '', NULL, 0, NULL, 0, 0),
(59, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'a', 1314920164, NULL, '', NULL, 0, NULL, 0, 0),
(60, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'a', 1314920167, NULL, '', NULL, 0, NULL, 0, 0),
(61, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'a', 1314920169, NULL, '', NULL, 0, NULL, 0, 0),
(62, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'q', 1314920172, NULL, '', NULL, 0, NULL, 0, 0),
(63, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'e', 1314920174, NULL, '', NULL, 0, NULL, 0, 0),
(64, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'r', 1314920177, NULL, '', NULL, 0, NULL, 0, 0),
(65, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 't', 1314920181, NULL, '', NULL, 0, NULL, 0, 0),
(66, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'y', 1314920183, NULL, '', NULL, 0, NULL, 0, 0),
(67, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'u', 1314920185, NULL, '', NULL, 0, NULL, 0, 0),
(68, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asd', 1314920225, NULL, '', NULL, 0, NULL, 0, 0),
(69, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asd', 1314920230, NULL, '', NULL, 0, NULL, 0, 0),
(70, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, '\nweerewrewrwer', 1314920248, NULL, '', NULL, 0, NULL, 0, 0),
(71, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'jjjjjjjj', 1314920290, NULL, '', NULL, 0, NULL, 0, 0),
(72, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'kkkkkllll', 1314920298, NULL, '', NULL, 0, NULL, 0, 0),
(73, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'rtrtrtrtrtrt', 1314920339, NULL, '', NULL, 0, NULL, 0, 0),
(74, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'ererer', 1314920344, NULL, '', NULL, 0, NULL, 0, 0),
(75, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'tttttttt', 1314920367, NULL, '', NULL, 0, NULL, 0, 0),
(76, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314920410, NULL, '', NULL, 0, NULL, 0, 0),
(77, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'ASAsaSAsaSAs', 1314920416, NULL, '', NULL, 0, NULL, 0, 0),
(78, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'AAsasssssssssss', 1314920426, NULL, '', NULL, 0, NULL, 0, 0),
(79, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'rrrrrrr', 1314920432, NULL, '', NULL, 0, NULL, 0, 0),
(80, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'rrrrrrrr', 1314920437, NULL, '', NULL, 0, NULL, 0, 0),
(81, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'hola', 1314920473, NULL, '', NULL, 0, NULL, 0, 0),
(82, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasdasd', 1314920483, NULL, '', NULL, 0, NULL, 0, 0),
(83, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasdasd', 1314920483, NULL, '', NULL, 0, NULL, 0, 0),
(84, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'vvvvvvvvv', 1314920492, NULL, '', NULL, 0, NULL, 0, 0),
(85, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'vvvbbbbbbb', 1314920587, NULL, '', NULL, 0, NULL, 0, 0),
(86, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'tytytytytytyty', 1314920605, NULL, '', NULL, 0, NULL, 0, 0),
(87, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'tytytytytytytyt', 1314920614, NULL, '', NULL, 0, NULL, 0, 0),
(88, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'uuuuuuuuuuu', 1314920634, NULL, '', NULL, 0, NULL, 0, 0),
(89, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'ooooooooooooo', 1314920640, NULL, '', NULL, 0, NULL, 0, 0),
(90, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'nueva', 1314920669, NULL, '', NULL, 0, NULL, 0, 0),
(91, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'sdfsdfsdfsdfsdfsdfsdfdsfsdfsdfdsf', 1314920675, NULL, '', NULL, 0, NULL, 0, 0),
(92, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'sdfsdfsdfsdfsdfsdfsdfdsfsdfsdfdsf', 1314920675, NULL, '', NULL, 0, NULL, 0, 0),
(93, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'qqq', 1314920687, NULL, '', NULL, 0, NULL, 0, 0),
(94, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'yyyy', 1314920695, NULL, '', NULL, 0, NULL, 0, 0),
(95, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'yyyy', 1314920695, NULL, '', NULL, 0, NULL, 0, 0),
(96, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'yyyy', 1314920695, NULL, '', NULL, 0, NULL, 0, 0),
(97, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'clearTimeout(refreshId);', 1314920734, NULL, '', NULL, 0, NULL, 0, 0),
(98, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'clearTimeout(refreshId);', 1314920932, NULL, '', NULL, 0, NULL, 0, 0),
(99, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'clearTimeout(refreshId);', 1314920932, NULL, '', NULL, 0, NULL, 0, 0),
(100, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 1314920939, NULL, '', NULL, 0, NULL, 0, 0),
(101, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 1314920944, NULL, '', NULL, 0, NULL, 0, 0),
(102, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'rrrrrrrrrrrrrrtttttttttttttttttttttttttttttttttttttt', 1314920953, NULL, '', NULL, 0, NULL, 0, 0),
(103, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314921183, NULL, '', NULL, 0, NULL, 0, 0),
(104, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314921183, NULL, '', NULL, 0, NULL, 0, 0),
(105, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314921183, NULL, '', NULL, 0, NULL, 0, 0),
(106, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314921183, NULL, '', NULL, 0, NULL, 0, 0),
(107, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314921183, NULL, '', NULL, 0, NULL, 0, 0),
(108, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314921183, NULL, '', NULL, 0, NULL, 0, 0),
(109, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314921183, NULL, '', NULL, 0, NULL, 0, 0),
(110, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314921183, NULL, '', NULL, 0, NULL, 0, 0),
(111, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314921183, NULL, '', NULL, 0, NULL, 0, 0),
(112, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314921183, NULL, '', NULL, 0, NULL, 0, 0),
(113, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'asdasdasd', 1314921183, NULL, '', NULL, 0, NULL, 0, 0),
(114, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'a', 1314921351, NULL, '', NULL, 0, NULL, 0, 0),
(115, 1, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'er', 1314921736, NULL, '', NULL, 0, NULL, 0, 0),
(116, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'er', 1314921741, NULL, '', NULL, 0, NULL, 0, 0),
(117, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'er', 1314921741, NULL, '', NULL, 0, NULL, 0, 0),
(118, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'er', 1314921744, NULL, '', NULL, 0, NULL, 0, 0),
(119, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'rt', 1314921748, NULL, '', NULL, 0, NULL, 0, 0),
(120, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', 1314921751, NULL, '', NULL, 0, NULL, 0, 0),
(121, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'ttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt', 1314921760, NULL, '', NULL, 0, NULL, 0, 0),
(122, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy\n', 1314921796, NULL, '', NULL, 0, NULL, 0, 0),
(123, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'tttttttttttttttttttttttttttttyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 1314921807, NULL, '', NULL, 0, NULL, 0, 0),
(124, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'tyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 1314921812, NULL, '', NULL, 0, NULL, 0, 0),
(125, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'tyyttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt', 1314921818, NULL, '', NULL, 0, NULL, 0, 0),
(126, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 1314921822, NULL, '', NULL, 0, NULL, 0, 0),
(127, 2, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', 1314921826, NULL, '', NULL, 0, NULL, 0, 0);
