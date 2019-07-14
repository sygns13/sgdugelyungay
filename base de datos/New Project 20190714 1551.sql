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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clasificacions`
--

/*!40000 ALTER TABLE `clasificacions` DISABLE KEYS */;
INSERT INTO `clasificacions` (`id`,`clasificacion`,`activo`,`borrado`,`created_at`,`updated_at`) VALUES 
 (1,'Silencio Positivo',1,0,NULL,NULL),
 (2,'Silencio Negativo',1,0,NULL,NULL),
 (3,'Automático',1,0,NULL,NULL),
 (4,'Ninguna',1,0,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formarecepcions`
--

/*!40000 ALTER TABLE `formarecepcions` DISABLE KEYS */;
INSERT INTO `formarecepcions` (`id`,`forma`,`activo`,`borrado`,`created_at`,`updated_at`) VALUES 
 (1,'COPIA',1,0,'2019-07-13 00:28:04','2019-07-13 00:34:53'),
 (2,'DIRECTA',1,0,'2019-07-13 00:35:10','2019-07-13 00:36:24'),
 (3,'E-MAIL',1,0,'2019-07-13 00:35:14','2019-07-13 00:35:14'),
 (4,'FAX',1,0,'2019-07-13 00:35:18','2019-07-13 00:35:18'),
 (5,'VÍA WEB',1,0,'2019-07-13 00:36:09','2019-07-13 00:36:09');
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personas`
--

/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` (`id`,`nombres`,`apellidos`,`dni`,`genero`,`direccion`,`imagen`,`activo`,`borrado`,`updated_at`,`created_at`) VALUES 
 (1,'Cristian','Chavez','47331640',1,'Luzuriaga 814',NULL,1,0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
 (2,'mark','moyis','14725836',1,'huaraz','',1,0,'2019-07-13 16:03:53','2019-07-13 16:03:53'),
 (3,'Cristian','Chavez','47331052',1,'HZ','',1,1,'2019-07-13 16:30:26','2019-07-13 16:30:26'),
 (4,'Raul','Quezada','12345685',1,'Hz','',1,0,'2019-07-13 16:32:47','2019-07-13 16:32:47');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prioridads`
--

/*!40000 ALTER TABLE `prioridads` DISABLE KEYS */;
INSERT INTO `prioridads` (`id`,`prioridad`,`activo`,`borrado`,`created_at`,`updated_at`) VALUES 
 (1,'NORMAL',1,0,NULL,NULL),
 (2,'URGENTE',1,0,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipodocumentos`
--

/*!40000 ALTER TABLE `tipodocumentos` DISABLE KEYS */;
INSERT INTO `tipodocumentos` (`id`,`tipo`,`activo`,`borrado`,`created_at`,`updated_at`) VALUES 
 (1,'ACTA',1,0,'2019-07-12 23:30:47','2019-07-12 23:51:02'),
 (2,'ACTA DE INSPECCION',1,0,'2019-07-12 23:51:22','2019-07-12 23:51:22'),
 (3,'ACTA DE VERIFICACION',1,0,'2019-07-12 23:51:27','2019-07-12 23:51:27'),
 (4,'ACTA DE TOLERANCIA',1,0,'2019-07-12 23:51:34','2019-07-12 23:51:34'),
 (5,'ACUERDO REGIONAL',1,0,'2019-07-12 23:51:41','2019-07-12 23:51:41'),
 (6,'AUTO DIRECTORAL',1,0,'2019-07-12 23:51:47','2019-07-12 23:51:47'),
 (7,'AVISO',1,0,'2019-07-12 23:54:29','2019-07-12 23:54:29'),
 (8,'AYUDA MEMORIA',1,0,'2019-07-12 23:54:33','2019-07-12 23:54:33'),
 (9,'BOLETIN',1,0,'2019-07-12 23:54:38','2019-07-12 23:54:38'),
 (10,'CARTA',1,0,'2019-07-12 23:54:42','2019-07-12 23:54:42'),
 (11,'CARTA CIRCULAR',1,0,'2019-07-12 23:54:46','2019-07-12 23:54:46'),
 (12,'CARTA DE DETERMINACION',1,0,'2019-07-12 23:54:53','2019-07-12 23:54:53'),
 (13,'CARTA MULTIPLE',1,0,'2019-07-12 23:54:57','2019-07-12 23:54:57'),
 (14,'CARTA NOTARIAL',1,0,'2019-07-12 23:55:02','2019-07-12 23:55:02'),
 (15,'CASACION',1,0,'2019-07-13 00:15:28','2019-07-13 00:15:28'),
 (16,'CEDULA AGROINDUSTRIAL',1,0,'2019-07-13 00:15:40','2019-07-13 00:15:40'),
 (17,'CEDULA DE NOTIFICACION',1,0,'2019-07-13 00:15:47','2019-07-13 00:15:47'),
 (18,'CERTIFICACION PRESUPUESTAL',1,0,'2019-07-13 00:15:59','2019-07-13 00:15:59'),
 (19,'CERTIFICADO',1,0,'2019-07-13 00:16:07','2019-07-13 00:16:07');
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Dumping data for table `unidadorganicas`
--

/*!40000 ALTER TABLE `unidadorganicas` DISABLE KEYS */;
INSERT INTO `unidadorganicas` (`id`,`codigo`,`siglas`,`nombre`,`activo`,`borrado`,`created_at`,`updated_at`) VALUES 
 (1,NULL,NULL,'ADMINISTRACIÓN MINAS GRA',1,0,'2019-07-13 01:00:08','2019-07-13 01:07:40'),
 (2,'00001','RSCN','ADMINISTRACIÓN - RSCN',1,0,'2019-07-13 01:00:31','2019-07-13 01:07:42'),
 (3,NULL,NULL,'AGENCIA DE COOPERACIÓN TÉCNICA INTERNACIONAL',1,0,'2019-07-13 01:08:12','2019-07-13 01:08:12'),
 (4,NULL,NULL,'ALMACÉN ESPECIALIZADO DE MEDICAMENTOS Y DROGAS - SISMED RSHS',1,0,'2019-07-13 01:08:35','2019-07-13 01:08:35'),
 (5,NULL,NULL,'ALTA DIRECCIÓN',1,0,'2019-07-13 01:08:52','2019-07-13 01:08:52'),
 (6,NULL,NULL,'ÁREA DE ADMINISTRACIÓN - UGEL - A',1,0,'2019-07-13 01:09:07','2019-07-13 01:09:07'),
 (7,NULL,NULL,'AREA DE ADQUISICIONES',1,0,'2019-07-13 01:09:20','2019-07-13 01:09:20'),
 (8,NULL,NULL,'AREA DE ASEGURAMIENTO EN SALUD - RSPS',1,0,'2019-07-13 01:09:31','2019-07-13 01:09:31'),
 (9,NULL,NULL,'AREA DE ASESORIA JURIDICA - UGEL - A',1,0,'2019-07-13 01:09:47','2019-07-13 01:09:47'),
 (10,NULL,NULL,'AREA DE AUDITORIA INTERNA - UGEL A',1,0,'2019-07-13 01:09:58','2019-07-13 01:10:05'),
 (11,NULL,NULL,'AREA DE BIENESTAR PERSONAL RSHS',1,0,'2019-07-13 01:10:16','2019-07-13 01:10:16'),
 (12,NULL,NULL,'AREA DE ESTADÍSTICA E INFORMÁTICA - RSPS',1,0,'2019-07-13 01:10:33','2019-07-13 01:10:33'),
 (13,NULL,NULL,'ÁREA DE GESTIÓN INSTITUCIONAL - UGEL - A',1,0,'2019-07-13 01:10:45','2019-07-13 01:10:56'),
 (14,NULL,NULL,'ÁREA DE GESTIÓN PEDAGÓGICA - UGEL - A',1,0,'2019-07-13 01:11:11','2019-07-13 01:11:11'),
 (15,NULL,NULL,'ÁREA DE LABORATORIOS RSHS',1,0,'2019-07-13 01:11:20','2019-07-13 01:11:20'),
 (16,NULL,NULL,'AREA DE REGISTRO Y LEGAJO DE ESCALAFON',1,0,'2019-07-13 01:11:33','2019-07-13 01:11:33'),
 (17,NULL,NULL,'AREA DE REMUNERACIONES - RSCN',1,0,'2019-07-13 01:11:45','2019-07-13 01:11:45'),
 (18,NULL,NULL,'ÁREA DE SALUD AMBIENTAL RSHS',1,0,'2019-07-13 01:11:56','2019-07-13 01:11:56'),
 (19,NULL,NULL,'AREA DE SECRETARIA TÉCNICA - RSPS',1,0,'2019-07-13 01:12:13','2019-07-13 01:12:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`name`,`email`,`password`,`remember_token`,`tipouser_id`,`persona_id`,`activo`,`borrado`,`created_at`,`updated_at`) VALUES 
 (1,'admin','cristian_7_70@hotmail.com','$2y$10$8R0Wn4QFvXNfiCdfM3XgIO36/Cw.qBEsJ9VMc1wls0pbK4Sx2cjES','hzW5lC00VwBPL83YxoRluJUiuiXBo3TyDH53FeAMQKYCYEkMu9rK2iKR5paV',1,1,1,0,'2019-07-13 01:13:10','0000-00-00 00:00:00'),
 (2,'moyis','moyis@mail.com','$2y$10$62bRs7sv8r4CIloo0dtu1eRWHjBQdkJnix5osu7gie7Pbsd16Jwfe','35GrhjsyInS5SekURhZk4bOMcDRDbHaxV5YvUEtmP6BQMTGz20P2bLVscuD1',3,2,1,0,'2019-07-13 16:29:03','2019-07-13 16:03:53'),
 (3,'crisfer2','crisfernex@gmail.com','$2y$10$179VlkNX5DdEyBqqkCrzCeqjRVb5d4tdsdV4RaKde6bcqycbF1n3y',NULL,3,3,1,1,'2019-07-13 17:45:58','2019-07-13 16:30:26'),
 (4,'crisfer','crisfernex@gmail.com','$2y$10$yU7QlBrayKaiEc.fiQlFkubwJG8vuuoMF9Bxe6TvhhEzB8yDJESbm','40UJ7QfgVIIEFwirXz1lHU3QyINRgCw59wApsGoPfmjRIVDcqiF4csgTItBp',3,4,1,0,'2019-07-13 17:46:15','2019-07-13 17:44:56');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
