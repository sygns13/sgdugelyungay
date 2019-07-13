-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.20-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema bdsgdyungay
--

CREATE DATABASE IF NOT EXISTS bdsgdyungay;
USE bdsgdyungay;

--
-- Definition of table `clasificacions`
--

DROP TABLE IF EXISTS `clasificacions`;
CREATE TABLE `clasificacions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clasificacion` varchar(500) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `borrado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clasificacions`
--

/*!40000 ALTER TABLE `clasificacions` DISABLE KEYS */;
/*!40000 ALTER TABLE `clasificacions` ENABLE KEYS */;


--
-- Definition of table `detalletramites`
--

DROP TABLE IF EXISTS `detalletramites`;
CREATE TABLE `detalletramites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` tinyint(4) DEFAULT NULL,
  `detalleestado` varchar(500) DEFAULT NULL,
  `observacion` text,
  `fechadetalle` date DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `borrado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tramite_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detalletramites_tramites1_idx` (`tramite_id`),
  CONSTRAINT `fk_detalletramites_tramites1` FOREIGN KEY (`tramite_id`) REFERENCES `tramites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detalletramites`
--

/*!40000 ALTER TABLE `detalletramites` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalletramites` ENABLE KEYS */;


--
-- Definition of table `formarecepcions`
--

DROP TABLE IF EXISTS `formarecepcions`;
CREATE TABLE `formarecepcions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forma` varchar(500) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `borrado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formarecepcions`
--

/*!40000 ALTER TABLE `formarecepcions` DISABLE KEYS */;
/*!40000 ALTER TABLE `formarecepcions` ENABLE KEYS */;


--
-- Definition of table `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(500) DEFAULT NULL,
  `apellidos` varchar(500) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `genero` tinyint(4) DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `borrado` tinyint(4) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personas`
--

/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` (`id`,`nombres`,`apellidos`,`dni`,`genero`,`direccion`,`imagen`,`activo`,`borrado`,`create_at`,`update_at`) VALUES 
 (1,'Cristian','Chavez','47331640',1,'Luzuriaga 814',NULL,1,0,NULL,NULL);
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;


--
-- Definition of table `prioridads`
--

DROP TABLE IF EXISTS `prioridads`;
CREATE TABLE `prioridads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prioridad` varchar(500) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `borrado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prioridads`
--

/*!40000 ALTER TABLE `prioridads` DISABLE KEYS */;
/*!40000 ALTER TABLE `prioridads` ENABLE KEYS */;


--
-- Definition of table `tipodocumentos`
--

DROP TABLE IF EXISTS `tipodocumentos`;
CREATE TABLE `tipodocumentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(500) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `borrado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipodocumentos`
--

/*!40000 ALTER TABLE `tipodocumentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipodocumentos` ENABLE KEYS */;


--
-- Definition of table `tipousers`
--

DROP TABLE IF EXISTS `tipousers`;
CREATE TABLE `tipousers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) DEFAULT NULL,
  `descripcion` varchar(2000) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `borrado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipousers`
--

/*!40000 ALTER TABLE `tipousers` DISABLE KEYS */;
INSERT INTO `tipousers` (`id`,`nombre`,`descripcion`,`activo`,`borrado`,`created_at`,`updated_at`) VALUES 
 (1,'Superadministrador','sa',1,0,NULL,NULL),
 (2,'Operario','op',1,0,NULL,NULL),
 (3,'Usuario','usu',1,0,NULL,NULL);
/*!40000 ALTER TABLE `tipousers` ENABLE KEYS */;


--
-- Definition of table `tramites`
--

DROP TABLE IF EXISTS `tramites`;
CREATE TABLE `tramites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expediente` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `prioridad_id` int(11) NOT NULL,
  `origen` tinyint(4) DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT NULL,
  `unidadorganica` varchar(2000) DEFAULT NULL,
  `firma` varchar(500) DEFAULT NULL,
  `cargo` varchar(500) DEFAULT NULL,
  `fechadoc` date DEFAULT NULL,
  `tipodocumento_id` int(11) NOT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `siglas` varchar(500) DEFAULT NULL,
  `formarecepcion_id` int(11) NOT NULL,
  `rutafile` varchar(2000) DEFAULT NULL,
  `folios` int(11) DEFAULT NULL,
  `asunto` text,
  `clasificacion_id` int(11) NOT NULL,
  `numdias` int(11) DEFAULT NULL,
  `formacopia` tinyint(4) DEFAULT NULL,
  `unidadorganica_id` int(11) NOT NULL,
  `detalle` varchar(500) DEFAULT NULL,
  `usuario` varchar(500) DEFAULT NULL,
  `proveidoatencion` text,
  `estado` tinyint(4) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `borrado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tramites_prioridad1_idx` (`prioridad_id`),
  KEY `fk_tramites_tipodocumento1_idx` (`tipodocumento_id`),
  KEY `fk_tramites_formarecepcion1_idx` (`formarecepcion_id`),
  KEY `fk_tramites_clasificacions1_idx` (`clasificacion_id`),
  KEY `fk_tramites_unidadorganicas1_idx` (`unidadorganica_id`),
  KEY `fk_tramites_personas1_idx` (`persona_id`),
  KEY `fk_tramites_users1_idx` (`user_id`),
  CONSTRAINT `fk_tramites_clasificacions1` FOREIGN KEY (`clasificacion_id`) REFERENCES `clasificacions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tramites_formarecepcion1` FOREIGN KEY (`formarecepcion_id`) REFERENCES `formarecepcions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tramites_personas1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tramites_prioridad1` FOREIGN KEY (`prioridad_id`) REFERENCES `prioridads` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tramites_tipodocumento1` FOREIGN KEY (`tipodocumento_id`) REFERENCES `tipodocumentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tramites_unidadorganicas1` FOREIGN KEY (`unidadorganica_id`) REFERENCES `unidadorganicas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tramites_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tramites`
--

/*!40000 ALTER TABLE `tramites` DISABLE KEYS */;
/*!40000 ALTER TABLE `tramites` ENABLE KEYS */;


--
-- Definition of table `unidadorganicas`
--

DROP TABLE IF EXISTS `unidadorganicas`;
CREATE TABLE `unidadorganicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) DEFAULT NULL,
  `siglas` varchar(45) DEFAULT NULL,
  `nombre` varchar(500) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `borrado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Dumping data for table `unidadorganicas`
--

/*!40000 ALTER TABLE `unidadorganicas` DISABLE KEYS */;
/*!40000 ALTER TABLE `unidadorganicas` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `remember_token` varchar(500) DEFAULT NULL,
  `tipouser_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `activo` tinyint(4) DEFAULT NULL,
  `borrado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_users_tipousers_idx` (`tipouser_id`),
  KEY `fk_users_persona1_idx` (`persona_id`),
  CONSTRAINT `fk_users_persona1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_tipousers` FOREIGN KEY (`tipouser_id`) REFERENCES `tipousers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`name`,`email`,`password`,`remember_token`,`tipouser_id`,`persona_id`,`activo`,`borrado`,`created_at`,`updated_at`) VALUES 
 (1,'admin','cristian_7_70@hotmail.com','$2y$10$8R0Wn4QFvXNfiCdfM3XgIO36/Cw.qBEsJ9VMc1wls0pbK4Sx2cjES',NULL,1,1,1,0,'2019-07-12 16:36:42','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
