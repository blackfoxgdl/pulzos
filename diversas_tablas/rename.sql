-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2011 at 05:35 PM
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
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `albumId` int(11) NOT NULL AUTO_INCREMENT,
  `albumUsuarioId` int(11) NOT NULL,
  `albumDefault` tinyint(4) NOT NULL DEFAULT '0',
  `albumNombre` varchar(140) NOT NULL,
  `albumFechaCreacion` int(11) NOT NULL,
  `albumLugar` varchar(140) NOT NULL,
  `albumDescripcion` text NOT NULL,
  `albumFechaModificacion` int(11) NOT NULL,
  PRIMARY KEY (`albumId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`albumId`, `albumUsuarioId`, `albumDefault`, `albumNombre`, `albumFechaCreacion`, `albumLugar`, `albumDescripcion`, `albumFechaModificacion`) VALUES
(3, 1, 1, 'Mis fotos de perfil', 1307118174, 'Mi Perfil', 'Imágenes que he usado como fotos de perfil', 0);

-- --------------------------------------------------------

--
-- Table structure for table `albumsnegocios`
--

CREATE TABLE IF NOT EXISTS `albumsnegocios` (
  `albumId` int(11) NOT NULL AUTO_INCREMENT,
  `albumNegocioId` int(11) NOT NULL,
  `albumNegocioDefault` tinyint(4) NOT NULL DEFAULT '0',
  `albumNombre` varchar(140) COLLATE utf8_bin NOT NULL,
  `albumFechaCreacion` int(11) NOT NULL,
  `albumLugar` varchar(140) COLLATE utf8_bin NOT NULL,
  `albumDescripcion` text COLLATE utf8_bin NOT NULL,
  `albumFechaModificacion` int(11) NOT NULL,
  PRIMARY KEY (`albumId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `albumsnegocios`
--

INSERT INTO `albumsnegocios` (`albumId`, `albumNegocioId`, `albumNegocioDefault`, `albumNombre`, `albumFechaCreacion`, `albumLugar`, `albumDescripcion`, `albumFechaModificacion`) VALUES
(1, 7, 1, 'Mis fotos de perfil', 1307123303, 'Mi Perfil', 'Mis Avatars', 1307123303);

-- --------------------------------------------------------

--
-- Table structure for table `amigos`
--

CREATE TABLE IF NOT EXISTS `amigos` (
  `amigoId` int(11) NOT NULL AUTO_INCREMENT,
  `amigoUsuarioId` int(11) NOT NULL,
  `amigoAmigoId` int(11) NOT NULL,
  `amigoAceptado` tinyint(1) NOT NULL,
  `amigoFechaCreacion` int(11) NOT NULL,
  `amigoTipo` tinyint(4) DEFAULT '0' COMMENT 'se usa para definir si el amigo es empresa o negocio',
  PRIMARY KEY (`amigoId`),
  KEY `amigoUsuarioId` (`amigoUsuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `amigos`
--

INSERT INTO `amigos` (`amigoId`, `amigoUsuarioId`, `amigoAmigoId`, `amigoAceptado`, `amigoFechaCreacion`, `amigoTipo`) VALUES
(1, 1, 14, 0, 1306781684, 0),
(2, 2, 1, 1, 1308003326, 0),
(3, 1, 2, 1, 1308240137, 0),
(6, 1, 12, 1, 1308347005, 1),
(7, 1, 17, 1, 1308684710, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE IF NOT EXISTS `apps` (
  `appId` int(11) NOT NULL AUTO_INCREMENT,
  `appUsuarioId` int(11) NOT NULL,
  `appApiKey` varchar(50) COLLATE utf8_bin NOT NULL,
  `appApiSecret` varchar(50) COLLATE utf8_bin NOT NULL,
  `appUrl` varchar(50) COLLATE utf8_bin NOT NULL,
  `appDescripcion` text COLLATE utf8_bin NOT NULL,
  `appNombre` varchar(30) COLLATE utf8_bin NOT NULL,
  `appEmailSoporte` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`appId`),
  KEY `appUsuarioId` (`appUsuarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`appId`, `appUsuarioId`, `appApiKey`, `appApiSecret`, `appUrl`, `appDescripcion`, `appNombre`, `appEmailSoporte`) VALUES
(3, 2, 'bd8722a3bb4fc7f02e6334825fcdc12b7f209081', '98811811997cc19ecd7a2511d9692f240b6cf8d6', 'pulzos', '¿Que quieres hacer hoy?', 'Pulzos', 'mario@zavordigital.com'),
(4, 2, 'c968e3fbf17f80b6dce5593ee6e385700eb93a4b', '210fce1803d4b4531c66830514d75e6456e7bd15', 'albums', 'Albums con imagenes del usuario', 'Albums', 'mario@zavordigital.com'),
(5, 2, 'a1ecc0ded1dbcf7c3f49e0e3927ef282af16b8da', '8a90538fe48ff4ff89731ebbd143e452c0df6854', 'imagenes', 'Imagenes de los usuarios', 'Imagenes', 'mario@zavordigital.com'),
(6, 2, '560fdebfba0c1478d8c68dea10888bfe1081ccfe', '4e07e406b45402e4b9ed7163df9d1f0c7cc7513b', 'comentarios', 'Comentarios coquetos a los diferentes elementos de interacción', 'Comentarios', 'mario@zavordigital.com'),
(7, 2, '7c132bbeab003954c39960e8b5ddf449add10e73', 'f5986a2af360d36bcb713bd78f60d6aec57ff870', 'invitaciones', 'Invita a tus amigos a llenar lugares de reunión', 'Invitaciones', 'mario@zavordigital.com');

-- --------------------------------------------------------

--
-- Table structure for table `ciudad`
--

CREATE TABLE IF NOT EXISTS `ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre`) VALUES
(1, 'Guadalajara'),
(2, 'Zapopan'),
(3, 'Tonala'),
(4, 'Tlaquepaque'),
(5, 'Tlajomulco'),
(6, 'Zapotlanejo'),
(7, 'Colima');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `comentarioId` int(11) NOT NULL AUTO_INCREMENT,
  `comentarioTexto` varchar(400) NOT NULL,
  `comentarioNegocioId` int(11) NOT NULL,
  `comentarioUsuarioId` int(11) NOT NULL,
  `comentarioPulzoId` int(11) NOT NULL,
  `comentarioCalificacion` int(11) NOT NULL,
  `comentarioAppApiKey` varchar(140) DEFAULT NULL,
  `comentarioElementoId` int(11) DEFAULT NULL,
  PRIMARY KEY (`comentarioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`comentarioId`, `comentarioTexto`, `comentarioNegocioId`, `comentarioUsuarioId`, `comentarioPulzoId`, `comentarioCalificacion`, `comentarioAppApiKey`, `comentarioElementoId`) VALUES
(1, 'muy ricas las micheladas y le restaurant es lo mejor buen ambiente', 7, 17, 27, 5, NULL, NULL),
(2, 'uf muy bueno y excelente comida', 7, 17, 27, 4, NULL, NULL),
(3, 'excelente promociones, regalan pulzos en consumo', 7, 17, 27, 4, NULL, NULL),
(4, 'muy buena la comida y en especial las mariscadas y el ahuachile', 7, 17, 27, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_planes`
--

CREATE TABLE IF NOT EXISTS `comentarios_planes` (
  `comentarioSimpleId` int(11) NOT NULL AUTO_INCREMENT,
  `comentarioSimpleUsuarioId` int(11) NOT NULL,
  `comentarioSimplePlanId` int(11) NOT NULL,
  `comentarioSimpleSubId` tinyint(4) NOT NULL,
  `subcomentarioComentarioId` int(11) DEFAULT '0',
  `comentarioSimple` varchar(400) COLLATE utf8_bin NOT NULL,
  `comentarioSimpleGusta` int(11) DEFAULT '0',
  PRIMARY KEY (`comentarioSimpleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Dumping data for table `comentarios_planes`
--

INSERT INTO `comentarios_planes` (`comentarioSimpleId`, `comentarioSimpleUsuarioId`, `comentarioSimplePlanId`, `comentarioSimpleSubId`, `subcomentarioComentarioId`, `comentarioSimple`, `comentarioSimpleGusta`) VALUES
(1, 1, 5, 0, 0, 'qwqwqwqwqwqw', 2),
(2, 1, 5, 1, 1, 'no seas menso', 0),
(3, 1, 5, 0, 0, 'asdsadasdasd', 0),
(4, 1, 5, 1, 1, 'asdasdasdasdasdasd\nasdasdasdasdasdasd', 0),
(5, 1, 5, 0, 0, 'asdasdasdadasdasd', 1),
(6, 1, 5, 0, 0, 'hoa esto es una prueba', 0),
(7, 1, 5, 1, 3, 'que onda :D', 0),
(8, 1, 5, 1, 5, 'asdasdasdadssad', 0),
(9, 1, 5, 1, 6, 'nueva prueba :D', 2),
(10, 1, 5, 0, 0, 'hola a todos amigos que es el evento 1', 1),
(11, 1, 5, 0, 0, 'uq onsa', 2),
(12, 1, 5, 1, 11, 'asdasdasdasdas', 4);

-- --------------------------------------------------------

--
-- Table structure for table `datosExtraNegocios`
--

CREATE TABLE IF NOT EXISTS `datosExtraNegocios` (
  `extraId` int(11) NOT NULL AUTO_INCREMENT,
  `extraNegocioId` int(11) NOT NULL,
  `extraNombreBanner` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `extraRutaImagen` varchar(400) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`extraId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `datosExtraNegocios`
--


-- --------------------------------------------------------

--
-- Table structure for table `estadocivil`
--

CREATE TABLE IF NOT EXISTS `estadocivil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `estadocivil`
--

INSERT INTO `estadocivil` (`id`, `nombre`) VALUES
(1, 'Seleccione su status de relacion'),
(2, 'Soltero'),
(3, 'Relacion Amorosa'),
(4, 'Complicado'),
(5, 'Casado'),
(6, 'Divorciado'),
(7, 'Viudo');

-- --------------------------------------------------------

--
-- Table structure for table `etiquetas`
--

CREATE TABLE IF NOT EXISTS `etiquetas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_bin NOT NULL,
  `idNegocio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `etiquetas`
--

INSERT INTO `etiquetas` (`id`, `nombre`, `idNegocio`) VALUES
(1, 'Amor', 30),
(2, 'Amistad', 30);

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `eventoId` int(11) NOT NULL AUTO_INCREMENT,
  `eventoAccion` varchar(140) NOT NULL,
  `eventoFecha` int(11) NOT NULL,
  `eventoFechaCreacion` int(11) NOT NULL,
  `eventoDescripcion` text NOT NULL,
  `eventoLugar` int(11) DEFAULT NULL,
  PRIMARY KEY (`eventoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `eventos`
--


-- --------------------------------------------------------

--
-- Table structure for table `giro`
--

CREATE TABLE IF NOT EXISTS `giro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(140) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=24 ;

--
-- Dumping data for table `giro`
--

INSERT INTO `giro` (`id`, `nombre`) VALUES
(1, 'Ayuda a tu comunidad'),
(2, 'Cafés'),
(3, 'Casinos'),
(4, 'Conciertos y Eventos'),
(5, 'Cursos y Talleres'),
(6, 'De compras'),
(7, 'Esotérico'),
(8, 'Eventos Religiosos'),
(9, 'Expos y ferias'),
(10, 'Fiesta Local'),
(11, 'Fuera de lo Comun'),
(12, 'Otros'),
(13, 'Puntos Turísticos'),
(14, 'Restaurantes'),
(15, 'Salud y Belleza'),
(16, 'Servicios'),
(17, 'Solo Cultura'),
(18, 'Teatro y Cine'),
(19, 'Viajes y Tours'),
(20, 'Vida Activa'),
(21, 'Vida Familiar'),
(22, 'Vida Nocturna'),
(23, 'Vida Política');

-- --------------------------------------------------------

--
-- Table structure for table `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `imagenId` int(11) NOT NULL AUTO_INCREMENT,
  `imagenAlbumId` int(11) NOT NULL,
  `imagenAvatar` tinyint(4) NOT NULL,
  `imagenNombre` varchar(140) NOT NULL,
  `imagenDescripcion` text NOT NULL,
  `imagenRuta` varchar(300) NOT NULL,
  `imagenFechaCreacion` int(11) NOT NULL,
  `imagenFechaModificacion` int(11) NOT NULL,
  PRIMARY KEY (`imagenId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `imagenes`
--

INSERT INTO `imagenes` (`imagenId`, `imagenAlbumId`, `imagenAvatar`, `imagenNombre`, `imagenDescripcion`, `imagenRuta`, `imagenFechaCreacion`, `imagenFechaModificacion`) VALUES
(3, 3, 0, 'q', 'q', 'statics/img_usuarios/1/3/b78a52b820d13967f02a2fed98ba0349.jpeg', 1307118182, 1307118182),
(4, 3, 0, 'aa', 'aaa', 'statics/img_usuarios/1/3/e08c0289b6c5658e96f50334853c64aa.jpeg', 1308680009, 1308680009),
(5, 3, 0, '', '', 'statics/img_usuarios/1/3/6a6e017e08da0ce0bb9e78c151af6021.jpeg', 1308690699, 1308690699),
(6, 3, 0, '', '', 'statics/img_usuarios/1/3/745efbdb85354f5acd47b18e603b4dbb.jpg', 1308690914, 1308690914),
(7, 3, 0, '', '', 'statics/img_usuarios/1/3/e0926b619adc558f1cb262fdc76dc290.jpeg', 1308691564, 1308691564),
(8, 3, 0, '', '', 'statics/img_usuarios/1/3/1bf22a780265c8c103cb54c34331b227.jpg', 1308691582, 1308691582),
(9, 3, 1, '', '', 'statics/img_usuarios/1/3/9b1e3093c52f2c9b5197f66dff994bfe.jpeg', 1308691587, 1308691587);

-- --------------------------------------------------------

--
-- Table structure for table `imagennegocios`
--

CREATE TABLE IF NOT EXISTS `imagennegocios` (
  `imagenId` int(11) NOT NULL AUTO_INCREMENT,
  `imagenNegocioAlbumId` int(11) NOT NULL,
  `imagenNegocioAvatar` tinyint(1) NOT NULL,
  `imagenNegocioNombre` varchar(140) COLLATE utf8_bin NOT NULL,
  `imagenNegocioDescripcion` text COLLATE utf8_bin NOT NULL,
  `imagenNegocioRuta` varchar(300) COLLATE utf8_bin NOT NULL,
  `imagenFechaCreacion` int(11) NOT NULL,
  `imagenFechaModificacion` int(11) NOT NULL,
  PRIMARY KEY (`imagenId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `imagennegocios`
--

INSERT INTO `imagennegocios` (`imagenId`, `imagenNegocioAlbumId`, `imagenNegocioAvatar`, `imagenNegocioNombre`, `imagenNegocioDescripcion`, `imagenNegocioRuta`, `imagenFechaCreacion`, `imagenFechaModificacion`) VALUES
(1, 1, 1, 'Logo', 'Mi primer Avatar', 'statics/img_negocios/7/1/72ec9d0eb58d012ed244f7e0c5e09f9b.jpeg', 1307123406, 1307123406),
(2, 2, 0, 'a', 'a', 'statics/img_negocios/7/2/2a62d461c8af768edfc3bcb3e6b56747.jpg', 1307597258, 1307597258);

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `inboxId` int(11) NOT NULL AUTO_INCREMENT,
  `inboxUsuarioId` int(11) NOT NULL,
  `inboxUsuarioRecibeId` int(11) NOT NULL,
  `inboxMensaje` text NOT NULL,
  `inboxAsunto` varchar(200) NOT NULL,
  `inboxStatus` tinyint(4) NOT NULL,
  `inboxFecha` int(11) NOT NULL,
  PRIMARY KEY (`inboxId`),
  KEY `inboxUsuarioId` (`inboxUsuarioId`),
  KEY `inboxUsuarioRecibeId` (`inboxUsuarioRecibeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `inbox`
--


-- --------------------------------------------------------

--
-- Table structure for table `inboxn`
--

CREATE TABLE IF NOT EXISTS `inboxn` (
  `inboxnId` int(11) NOT NULL AUTO_INCREMENT,
  `inboxnUsuarioId` int(11) NOT NULL,
  `inboxnUsuarioRecibeId` int(11) NOT NULL,
  `inboxnMensaje` text NOT NULL,
  `inboxnAsunto` varchar(200) NOT NULL,
  `inboxnStatus` tinyint(4) NOT NULL,
  `inboxnFecha` int(11) NOT NULL,
  PRIMARY KEY (`inboxnId`),
  KEY `inboxnUsuarioId` (`inboxnUsuarioId`,`inboxnUsuarioRecibeId`),
  KEY `inboxnUsuarioRecibeId` (`inboxnUsuarioRecibeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `inboxn`
--

INSERT INTO `inboxn` (`inboxnId`, `inboxnUsuarioId`, `inboxnUsuarioRecibeId`, `inboxnMensaje`, `inboxnAsunto`, `inboxnStatus`, `inboxnFecha`) VALUES
(1, 17, 1, 'si llega y se guarda en la base de datos', 'hola', 0, 1308267201),
(4, 1, 17, 'necesito que me ayuden chingado ayuda!!!!!', 'me desespero', 1, 1308267587),
(6, 1, 14, 'Saludos amiga!!!', 'hola', 1, 1308349147);

-- --------------------------------------------------------

--
-- Table structure for table `invitaciones`
--

CREATE TABLE IF NOT EXISTS `invitaciones` (
  `invitacionId` int(11) NOT NULL AUTO_INCREMENT,
  `invitacionInvitadoId` int(11) NOT NULL,
  `invitacionFechaHora` varchar(400) COLLATE utf8_bin NOT NULL,
  `invitacionAceptado` tinyint(4) NOT NULL DEFAULT '0',
  `invitacionPlanId` int(11) NOT NULL,
  PRIMARY KEY (`invitacionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `invitaciones`
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
  `invitacionPersonalAceptadoId` tinyint(3) NOT NULL COMMENT '0 neutro, 1 aceptado, 2 rechazado, 3 quizas',
  `invitacionPersonalMensaje` varchar(400) COLLATE utf8_bin NOT NULL,
  `invitacionPersonalStatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'status de visualizacion de mensaje, 0 visto, 1 no visto',
  PRIMARY KEY (`invitacionPersonalId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `invitacionpersonal`
--

INSERT INTO `invitacionpersonal` (`invitacionPersonalId`, `invitacionUsuarioPersonalId`, `invitacionInvitadoPersonalId`, `invitacionPersonalPlanId`, `invitacionPersonalAceptadoId`, `invitacionPersonalMensaje`, `invitacionPersonalStatus`) VALUES
(1, 14, 1, 5, 1, '1', 0),
(2, 1, 2, 5, 0, '1', 1),
(3, 1, 14, 6, 0, 'asdasdasd', 1),
(4, 1, 14, 7, 0, 'ultimo', 1),
(5, 1, 2, 7, 0, 'ultimo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `negocios`
--

CREATE TABLE IF NOT EXISTS `negocios` (
  `negocioId` int(11) NOT NULL AUTO_INCREMENT,
  `negocioUsuarioId` int(11) NOT NULL,
  `negocioNombre` varchar(140) COLLATE utf8_bin NOT NULL,
  `negocioGiro` varchar(140) COLLATE utf8_bin NOT NULL,
  `negocioDireccion` varchar(400) COLLATE utf8_bin NOT NULL,
  `negocioDescripcion` text COLLATE utf8_bin,
  `negocioEmail` varchar(140) COLLATE utf8_bin NOT NULL,
  `negocioTelefono` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `negocioSitioWeb` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `negocioHorario` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `negocioPais` int(11) NOT NULL,
  `negocioCiudad` int(11) NOT NULL,
  `negocioLatitud` int(11) DEFAULT NULL,
  `negocioLongitud` int(11) DEFAULT NULL,
  `negocioImagenId` int(11) DEFAULT NULL,
  `negocioFechaCreacion` int(11) NOT NULL,
  `negocioFechaModificacion` int(11) NOT NULL,
  PRIMARY KEY (`negocioId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `negocios`
--

INSERT INTO `negocios` (`negocioId`, `negocioUsuarioId`, `negocioNombre`, `negocioGiro`, `negocioDireccion`, `negocioDescripcion`, `negocioEmail`, `negocioTelefono`, `negocioSitioWeb`, `negocioHorario`, `negocioPais`, `negocioCiudad`, `negocioLatitud`, `negocioLongitud`, `negocioImagenId`, `negocioFechaCreacion`, `negocioFechaModificacion`) VALUES
(1, 9, 'La Chata de Guadalajara', '5', 'Zona Centro 126', 'Saborear los diferentes platillos preparados con esmero y deliciosos ingredientes secretos, marcan la pauta de la mejor comida tradicional de nuestra ciudad.', 'lachata@gmail.com', NULL, NULL, NULL, 1, 1, NULL, NULL, 0, 1306279044, 1306279044),
(2, 10, 'Benitos Pizza & Pasta', '5', 'Av. La Paz 2481', 'Restaurant bar, una tradicion culinaria en pastas', 'benitos@gmail.com', NULL, NULL, NULL, 1, 1, NULL, NULL, 0, 1306279658, 1306279658),
(3, 11, 'Restaurant El Pargo', '2', 'Av. La Paz 2140', 'Disfruta de Mariscos frescos en el restaurant familiar El Pargo', 'pargo@gmail.com', NULL, NULL, NULL, 1, 1, NULL, NULL, 0, 1306280064, 1306280064),
(4, 12, 'il Diavolo', '5', 'López Cotilla 1904', 'Restaurant de Comida Italiana donde podras disfrutar de las mejores pizzas con los mejores quesos asi como de las pastas', 'diavolo@gmail.com', NULL, NULL, NULL, 1, 1, NULL, NULL, 0, 1306280385, 1306280385),
(5, 13, 'CANTA Y NO LLORES', '5', 'López Mateos Sur', '*\n    * 2\n    * 2\n\n    * 1\n    * 2\n    * 3 Title text 2\n      Content text...\n\nKaraoke Bar\n\nTe invitamos a conocer un nuevo lugar en donde cantar, bailar y sacar a ese artista interno podría hacerte divertir mucho. Canta y no llores es un karaoke bar en donde tú y tus amigos podrán pasar un rato muy agradable, con canciones actualizadas y un excelente ambiente.', 'cantaynollores@gmail.com', NULL, NULL, NULL, 1, 1, NULL, NULL, 0, 1306280707, 1306280707),
(7, 17, 'Mariscos Alex', '14', 'Isla Cozumel #335', 'Mariscos con diversos platillos que hay en el mejor restaurant. Aqui podras disfrutar de un excelente ambiente familiar. Disfruta de nuestras especialidades de la casa y llevate un excelente sabor de boca con nuestros platillos.', 'mariscos@gmail.com', '12-15-18-19', 'http://www.mariscos.com.mx', 'Lunes a Domingos 12 a 7 pm', 1, 1, NULL, NULL, NULL, 1306958469, 1308691643);

-- --------------------------------------------------------

--
-- Table structure for table `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pais`
--

INSERT INTO `pais` (`id`, `nombre`) VALUES
(1, 'Mexico');

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `usuarioId` int(11) NOT NULL,
  `acercaDe` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `escuela` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `escuela2` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `escuela3` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `escuela4` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `ubicacion` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `intereses` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `localidad` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `profesion` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `relaciones` int(11) DEFAULT '1',
  PRIMARY KEY (`usuarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`usuarioId`, `acercaDe`, `escuela`, `escuela2`, `escuela3`, `escuela4`, `ubicacion`, `intereses`, `localidad`, `profesion`, `relaciones`) VALUES
(1, '', 'Universidad de Guadalajara', 'Preparatorio #12', 'Escuela Secundaria Tecnica #139', 'Valentin Gomez Farias #871', NULL, '', '', '', 4),
(2, '', '', NULL, NULL, NULL, NULL, '', '', '', 1),
(14, '', '', '', '', NULL, NULL, '', '', '', 2),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE IF NOT EXISTS `planes` (
  `planId` int(11) NOT NULL AUTO_INCREMENT,
  `planUsuarioId` int(11) NOT NULL,
  `planTipo` smallint(6) NOT NULL,
  `planFechaCreacion` int(11) NOT NULL,
  `planExito` int(11) NOT NULL,
  `planElementoId` int(11) NOT NULL,
  `planMensaje` varchar(400) NOT NULL,
  `planLugar` int(11) DEFAULT NULL,
  PRIMARY KEY (`planId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `planes`
--


-- --------------------------------------------------------

--
-- Table structure for table `planesusuarios`
--

CREATE TABLE IF NOT EXISTS `planesusuarios` (
  `planId` int(11) NOT NULL AUTO_INCREMENT,
  `planUsuarioId` int(11) NOT NULL,
  `planTipo` smallint(6) DEFAULT NULL,
  `planMensaje` text COLLATE utf8_bin NOT NULL,
  `planImagenRuta` varchar(400) COLLATE utf8_bin DEFAULT '0',
  `planFechaInicio` int(11) NOT NULL,
  `planFechaFin` int(11) NOT NULL,
  `planHoraInicio` varchar(140) COLLATE utf8_bin NOT NULL,
  `planHoraFin` varchar(140) COLLATE utf8_bin NOT NULL,
  `planDescripcion` varchar(5000) COLLATE utf8_bin NOT NULL,
  `planFechaCreacion` int(11) NOT NULL,
  `planLugar` varchar(400) COLLATE utf8_bin NOT NULL,
  `planInvitados` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`planId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `planesusuarios`
--

INSERT INTO `planesusuarios` (`planId`, `planUsuarioId`, `planTipo`, `planMensaje`, `planImagenRuta`, `planFechaInicio`, `planFechaFin`, `planHoraInicio`, `planHoraFin`, `planDescripcion`, `planFechaCreacion`, `planLugar`, `planInvitados`) VALUES
(1, 1, NULL, 'Fiesta en casa de Carlos', '0', 1309582800, 1309669200, '18:00 pm', '04:00 am', 'Fiesta para que termine de llorar y pague una peda, el no sabe pero pues que se entere el mismo dia y pague por lloron', 1309215196, 'Casa de Carlos carretera a chapala', '14,'),
(2, 2, NULL, 'Carne Asada', '0', 1309582800, 1309582800, '18:00 pm', '18:00 pm', 'Se hara una carne asada para los amigos, lo unico que debemos de llevar y ponernos de acuerdo es divir las bebidas, quien las llevara, quien llevara las botanas etc, pero esp lo hacempos desde aqui en la plataforma.', 1309273991, 'Terraza de mi casa, casa de ustedes tambien XD', '1,'),
(4, 1, NULL, '1', '0', 1293861600, 1293861600, '1', '1', '1', 1309363055, '1', '14,2,'),
(5, 14, NULL, '1', '0', 1293861600, 1293861600, '1', '1', '1', 1309363092, '1', '14,2,'),
(6, 1, NULL, 'asdasdasd', '0', 1293861600, 0, 'asdasdasd', '', 'sdasdasdasd', 1309537988, 'asdasda', '14,'),
(7, 1, NULL, 'ultimo', '0', 1293861600, 0, '44', '', 'iltuimamsjdfsdjfsf', 1309540158, 'ultima', '14,2,');

-- --------------------------------------------------------

--
-- Table structure for table `pulzos`
--

CREATE TABLE IF NOT EXISTS `pulzos` (
  `pulzoId` int(11) NOT NULL AUTO_INCREMENT,
  `pulzoUsuarioId` int(11) NOT NULL,
  `pulzoSubcategoria` int(11) DEFAULT '0',
  `pulzoTitulo` varchar(200) NOT NULL,
  `pulzoAccion` varchar(400) NOT NULL,
  `pulzoUbicacion` varchar(200) DEFAULT NULL,
  `pulzoFechaInicio` int(11) DEFAULT NULL,
  `pulzoDuracionReto` varchar(400) DEFAULT NULL COMMENT 'duracion del reto para los usuarios, tiempo que dura el pulzo',
  `pulzoHora` varchar(150) DEFAULT NULL,
  `pulzoFechaFin` int(11) DEFAULT NULL,
  `pulzoHoraFin` varchar(150) DEFAULT '0',
  `pulzoImagenRuta` varchar(300) DEFAULT '0',
  `pulzoNumeroAsistentes` int(11) DEFAULT '0',
  `pulzoTipoComunicacion` int(11) NOT NULL,
  `pulzoAvisoLegal` varchar(400) DEFAULT '0',
  `pulzoTipoEventoId` int(11) DEFAULT '0',
  `pulzoExperienciaId` varchar(150) DEFAULT '0',
  `pulzoPaqueteIncluye` longtext,
  `pulzoTipo` tinyint(4) DEFAULT '0' COMMENT 'El status 0 es pulzo, el 1 es reto, el 2 es experiencia',
  `pulzoFechaCreacion` int(11) NOT NULL,
  `pulzoLatitud` decimal(10,6) DEFAULT NULL,
  `pulzoLongitud` decimal(10,6) DEFAULT NULL,
  PRIMARY KEY (`pulzoId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `pulzos`
--

INSERT INTO `pulzos` (`pulzoId`, `pulzoUsuarioId`, `pulzoSubcategoria`, `pulzoTitulo`, `pulzoAccion`, `pulzoUbicacion`, `pulzoFechaInicio`, `pulzoDuracionReto`, `pulzoHora`, `pulzoFechaFin`, `pulzoHoraFin`, `pulzoImagenRuta`, `pulzoNumeroAsistentes`, `pulzoTipoComunicacion`, `pulzoAvisoLegal`, `pulzoTipoEventoId`, `pulzoExperienciaId`, `pulzoPaqueteIncluye`, `pulzoTipo`, `pulzoFechaCreacion`, `pulzoLatitud`, `pulzoLongitud`) VALUES
(1, 1, 0, 'Descuento en Platillos', '15% de descuento en tu cuenta al pedir los platillos del dia para ti y tu pareja.', 'Zona Centro #126', 1306299600, NULL, NULL, 1306299600, '0', '0', NULL, 0, '0', 0, '0', NULL, 0, 1306279184, '20.675096', '-103.346529'),
(2, 2, 0, 'Copas de Vino', 'Te regalamos dos copas de vino tinto al pedir como aperitivo una pizza de queso chedar', 'Av. La Paz 2481', 1306299600, NULL, NULL, 1306299600, '0', '0', NULL, 0, '0', 0, '0', NULL, 0, 1306279712, '20.672269', '-103.379609'),
(3, 3, 0, 'Botana Gratis', 'En la solicitud del menu numero 3 te regalamos una Botella de tequila para que disfrutes tus mariscos al maximo en el Pargo', 'Av. La Paz 2140', 1306299600, NULL, NULL, 1306299600, '0', '0', NULL, 0, '0', 0, '0', NULL, 0, 1306280149, '20.672389', '-103.370769'),
(4, 4, 0, 'Descuento en Consumo', 'Te damos un 10% de descuento en tu consumo al asistir con 6 amigos al restaurant il Diavolo', 'López Cotilla 1904', 1306299600, NULL, NULL, 1306299600, '0', '0', NULL, 0, '0', 0, '0', NULL, 0, 1306280537, '20.673624', '-103.376315'),
(5, 5, 0, 'Botella Gratis', 'En la compra de tu botella te regalamos 6 refrescos para que la disfrutes co0n tus amigos en el Karaoke Bar CANTA Y NO LLORES', 'López Mateos Sur', 1306299600, NULL, NULL, 1306299600, '0', '0', NULL, 0, '0', 0, '0', NULL, 0, 1306280869, '20.646880', '-103.404682'),
(22, 7, 0, 'Postres Gratis', 'Postre gratis en la compra de tu mariscada familiar, ademas te bonificamos el 15% de tu cuenta final en pulzos, para que gastes donde tu desees', NULL, 1307077200, NULL, '16 horas', 1307163600, '0', '0', NULL, 0, '0', 0, '0', NULL, 0, 1307048998, NULL, NULL),
(23, 7, 0, 'Tarde de Micheladas', 'Se te bonificara el 15 por ciento de tu cuenta total si supera los 400 pesos ademas de que si traes a 10 amigos te regalamos una cubeta de cervezas o una ronda de micheladas', NULL, 1307250000, NULL, 'a partir de 16:00 horas', 1307250000, '0', '0', NULL, 0, '0', 0, '0', NULL, 0, 1307055961, NULL, NULL),
(26, 7, 0, 'Mariscada con pulzos', 'Se bonificara el 15% en pulzos al pedir tu mariscada ademas del 10% de tu cuenta total en pulzos', NULL, 1307250000, NULL, 'a partir de las 12 horas', 1307336400, '0', './statics/img_eventos/7/1307144994/ef8e4563946f68149f9b627e258b8e99.jpg', NULL, 0, '0', 0, '0', NULL, 0, 1307144994, NULL, NULL),
(27, 7, 0, 'Micheladas Gratis', 'Te damos micheladas gratis a ti y a tus amigos al momento de comentar en pulzos sobre nuestro negocios', NULL, 1307250000, NULL, 'a partir de 16:00 horas', 1307250000, '0', './statics/img_eventos/7/1307145565/8cae8b9ce82381975607be3bb9743305.jpg', NULL, 0, '0', 0, '0', NULL, 0, 1307145565, NULL, NULL),
(28, 7, 0, 'nuevo reto de prueba', 'nuevo reto de una prueba para conocer como se vera el reto', NULL, 1313384400, '0', NULL, NULL, '0', '0', 0, 1, 'no nos hacemos responsables de nada', 1, '0', NULL, 1, 1307977813, NULL, NULL),
(30, 7, 0, 'prueba de experiencias de vida', 'esta es una nueva prueba de como debe quedar los pulzos de experiencias de vida', NULL, 1294207200, NULL, NULL, 1293861600, '0', '0', 0, 2, 'no me hago responsable de los errores que vayan apareciendo, que para eso los voy a solucionar poco a poco', 0, 'Amor,Amistad', 'noc que invluye pero necesitamos ya tenermo y me tardo un chingo en desarrollar en los dos perfiles', 2, 1308245602, NULL, NULL),
(42, 7, 0, 'nueva prueba', 'prueb', NULL, 1293861600, NULL, '12', 1293861600, '12', '0', 0, 3, 'prueba', 0, '0', NULL, 0, 1309064604, NULL, NULL),
(43, 7, 0, '1', '1', NULL, 1293861600, NULL, '1', 1293861600, '1', '0', 0, 1, '1', 0, '0', NULL, 0, 1309066227, NULL, NULL),
(44, 7, 4, '2', '2', NULL, 1293861600, NULL, '2', 1293861600, '2', '0', 0, 1, '2', 0, '0', NULL, 0, 1309131940, NULL, NULL),
(45, 7, 2, 'q', 'q', NULL, 1293861600, NULL, 'q', 1293861600, 'q', '0', 0, 1, 'q', 0, '0', NULL, 0, 1309301641, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pulzosneg`
--

CREATE TABLE IF NOT EXISTS `pulzosneg` (
  `pulzosnegId` int(11) NOT NULL AUTO_INCREMENT,
  `pulzosnegNegocioId` int(11) NOT NULL,
  `pulzosnegAccion` varchar(400) COLLATE utf8_bin NOT NULL,
  `pulzosnegFechaCreacion` int(11) NOT NULL,
  PRIMARY KEY (`pulzosnegId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pulzosneg`
--


-- --------------------------------------------------------

--
-- Table structure for table `seguidores`
--

CREATE TABLE IF NOT EXISTS `seguidores` (
  `seguidorId` int(11) NOT NULL AUTO_INCREMENT,
  `seguidorUsuarioId` int(11) NOT NULL,
  `seguidorNegocioId` int(11) NOT NULL,
  `seguidorFechaCreacion` int(11) NOT NULL,
  PRIMARY KEY (`seguidorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `seguidores`
--

INSERT INTO `seguidores` (`seguidorId`, `seguidorUsuarioId`, `seguidorNegocioId`, `seguidorFechaCreacion`) VALUES
(1, 1, 7, 1308684710);

-- --------------------------------------------------------

--
-- Table structure for table `subcategorias`
--

CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `idGiro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=148 ;

--
-- Dumping data for table `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `nombre`, `idGiro`) VALUES
(1, 'Voluntarios', 1),
(2, 'Eventos', 1),
(3, 'Actividades', 1),
(4, 'Banda y popular', 4),
(5, 'Cabaret', 4),
(6, 'Electrónica / Dance', 4),
(7, 'Festival', 4),
(8, 'Jazz y Blues', 4),
(9, 'Latino', 4),
(10, 'Mariachi y tradicional', 4),
(11, 'Música Clásica', 4),
(12, 'Música del Mundo', 4),
(13, 'New Age', 4),
(14, 'Pop', 4),
(15, 'Rap / Hip-hop', 4),
(16, 'Reggaetón', 4),
(17, 'Rock Alternativo', 4),
(18, 'Rock Clásico', 4),
(19, 'Rock Metalero', 4),
(20, 'Otros', 4),
(21, 'Capacitación Profesional', 5),
(22, 'Clases Particulares', 5),
(23, 'Cocina', 5),
(24, 'Conferencias', 5),
(25, 'Danza', 5),
(26, 'Espirituales', 5),
(27, 'Fuera de lo Comun', 5),
(28, 'Idiomas', 5),
(29, 'Infantiles', 5),
(30, 'Informática', 5),
(31, 'Música', 5),
(32, 'Salud', 5),
(33, 'Superación Personal', 5),
(34, 'Varios', 5),
(35, 'Accesorios', 6),
(36, 'Automotriz', 6),
(37, 'Centros Comerciales', 6),
(38, 'Comercio General', 6),
(39, 'Decoración', 6),
(40, 'Electrónica', 6),
(41, 'Gourmet', 6),
(42, 'Jardinería', 6),
(43, 'Joyería', 6),
(44, 'Librería', 6),
(45, 'Misceláneo', 6),
(46, 'Muebles', 6),
(47, 'Papelerías', 6),
(48, 'Perfumes', 6),
(49, 'Regalos y sorpresas', 6),
(50, 'Ropa', 6),
(51, 'Varios', 6),
(52, 'Zapatos', 6),
(53, 'Alemán', 14),
(54, 'Americana', 14),
(55, 'Antojitos', 14),
(56, 'Argentina', 14),
(57, 'Bistró', 14),
(58, 'Brasileña', 14),
(59, 'Bufete', 14),
(60, 'Campestre', 14),
(61, 'China', 14),
(62, 'Cocina de Autor', 14),
(63, 'Colombiana', 14),
(64, 'Comida Rapida', 14),
(65, 'Deli', 14),
(66, 'Desayunos', 14),
(67, 'Ensaladas', 14),
(68, 'Española', 14),
(69, 'Fondues', 14),
(70, 'Francesa', 14),
(71, 'Fusíon', 14),
(72, 'Hindú', 14),
(73, 'Hostería', 14),
(74, 'Italiana', 14),
(75, 'Latina', 14),
(76, 'Mariscos', 14),
(77, 'Mediterránea', 14),
(78, 'Mexicana', 14),
(79, 'Naturista', 14),
(80, 'Pastelería', 14),
(81, 'Pollería', 14),
(82, 'Sándwiches', 14),
(83, 'Sushi / Japonesa', 14),
(84, 'Tailandesa', 14),
(85, 'Taquerías', 14),
(86, 'Varios', 14),
(87, 'Vegetariana', 14),
(88, 'Estética', 15),
(89, 'Holístico', 15),
(90, 'Manicure', 15),
(91, 'Maquillaje', 15),
(92, 'Masajes', 15),
(93, 'Medicina', 15),
(94, 'Pedicura', 15),
(95, 'Spa', 15),
(96, 'Varios', 15),
(97, 'Para el Hogar', 16),
(98, 'Profesionales', 16),
(99, 'Varios', 16),
(100, 'Arte Urbano', 17),
(101, 'Centro Cultural', 17),
(102, 'Escultura', 17),
(103, 'Exposiciones Varias', 17),
(104, 'Fotografía', 17),
(105, 'Moderno', 17),
(106, 'Museos', 17),
(107, 'Pintura', 17),
(108, 'Varias', 17),
(109, 'Fin de semana', 19),
(110, 'Hoteles', 19),
(111, 'Ida y vuelta', 19),
(112, 'Vacaciones', 19),
(113, 'Clubes y Gimnasios', 20),
(114, 'Entrenador Particular', 20),
(115, 'Eventos deportivos', 20),
(116, 'Exhibiciones', 20),
(117, 'Torneos', 20),
(118, 'Varios', 20),
(119, 'Infantil', 21),
(120, 'Actividades', 21),
(121, 'Educativos', 21),
(122, 'Eventos', 21),
(123, 'Antros', 22),
(124, 'Bares', 22),
(125, 'Botaneros', 22),
(126, 'Discotecas', 22),
(127, 'Diversidad', 22),
(128, 'Litros', 22),
(129, 'Micheladas', 22),
(130, 'Solo autos', 22),
(131, 'Varios', 22),
(132, 'Reuniones', 23),
(133, 'Marchas', 23),
(134, 'Activistas', 23),
(135, 'Congregaciones', 23),
(136, 'Debates', 23),
(137, 'Denuncia', 23),
(138, 'Varios', 23),
(139, 'Cafes', 2),
(140, 'Casinos', 3),
(141, 'Esoterico', 7),
(142, 'Eventos Religiosos', 8),
(143, 'Expos y Ferias', 9),
(144, 'Fuera de lo Comun', 10),
(145, 'Otros', 11),
(146, 'Puntos Turisticos', 12),
(147, 'Teatro y Cine', 18);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `apellidos` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(140) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(60) COLLATE utf8_bin NOT NULL,
  `sexo` tinyint(1) DEFAULT '2',
  `edad` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `pais` int(11) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `creacion` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `codigoActivacion` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `codigoRecuperacion` varchar(140) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `statusRecuperacion` tinyint(1) DEFAULT '1',
  `statusEU` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `username`, `email`, `password`, `sexo`, `edad`, `pais`, `ciudad`, `creacion`, `codigoActivacion`, `codigoRecuperacion`, `statusRecuperacion`, `statusEU`) VALUES
(1, 'Ruben', 'Cortes Mendoza', NULL, 'ruben@zavordigital.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 1, '1986-03-19 00:00:00', 1, 1, '0000-00-00 00:00:00', NULL, '0', 1, 0),
(2, 'Pamela Noemi', 'Hernandez', NULL, 'pamela@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 0, '1989-06-12 00:00:00', 1, 1, '0000-00-00 00:00:00', NULL, '0', 1, 0),
(9, 'La Chata de Guadalajara', NULL, NULL, 'lachata@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-05-24 18:17:24', 'f440147182488d791cb41bebe8857c85a9207bf1', '0', 1, 1),
(10, 'Benitos Pizza & Pasta', NULL, NULL, 'benitos@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-05-24 18:27:38', 'e62f471bf9cd905c61c780d2305d32640f6782f0', '0', 1, 1),
(11, 'Restaurant El Pargo', NULL, NULL, 'pargo@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-05-24 18:34:24', 'ec46a2845ae7c8c7095f9fbf0bead3b48b116985', '0', 1, 1),
(12, 'il Diavolo', NULL, NULL, 'diavolo@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-05-24 18:39:45', 'bb36151e8c82a9cc5653a517bece41b063315b4e', '0', 1, 1),
(13, 'CANTA Y NO LLORES', NULL, NULL, 'cantaynollores@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-05-24 18:45:07', '2c6a5c31b1e137e6e7422d168ad7fe6284c98a87', '0', 1, 1),
(14, 'Mariela Isabel', 'Lopez Moya', NULL, 'mariela@hotmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 0, '1987-12-12 00:00:00', 1, 1, '0000-00-00 00:00:00', NULL, '0', 1, 0),
(15, 'Juanita', 'Lechon', NULL, 'juanita@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '1979-11-17 00:00:00', 1, 1, '0000-00-00 00:00:00', NULL, '0', 1, 0),
(17, 'Mariscos Alex', NULL, NULL, 'mariscos@gmail.com', 'a7f777085d138db9b48ffe43d7659dbba0752813', 2, '0000-00-00 00:00:00', NULL, NULL, '2011-06-01 15:01:09', '0cff4509f67a74065c389d41a35d5c96baa79eaf', '0', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `amigos_ibfk_1` FOREIGN KEY (`amigoUsuarioId`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inbox`
--
ALTER TABLE `inbox`
  ADD CONSTRAINT `inbox_ibfk_1` FOREIGN KEY (`inboxUsuarioId`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `inbox_ibfk_2` FOREIGN KEY (`inboxUsuarioRecibeId`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
