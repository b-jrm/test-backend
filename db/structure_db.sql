# ************************************************************
# Sequel Pro SQL dump
#
# Development Backend
# Brayan Julian Rodriguez Moreno
#
# https://github.com/b-jrm
#
# Host: 127.0.0.1
# Database: intelcost_bienes
# Generation Time: 2021-08-26 17:14:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table orders
# ------------------------------------------------------------


# CIUDADES
DROP TABLE IF EXISTS `ciudades`;

CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL DEFAULT ''
  PRIMARY KEY (`id_ciudad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

# TIPO
DROP TABLE IF EXISTS `tipos`;

CREATE TABLE `tipos` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL DEFAULT ''
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

DROP TABLE IF EXISTS `bienes`;

CREATE TABLE `bienes` (
  `id_bien` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(30) NOT NULL DEFAULT '',
  `ciudad_id` int NOT NULL,
  `telefono` varchar(30) NOT NULL DEFAULT '',
  `codigo_postal` varchar(15) NOT NULL DEFAULT '',
  `tipo_id` int NOT NULL,
  `precio` decimal(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_bien`),
  FOREIGN KEY ('ciudad_id') REFERENCES ciudades('id_ciudad'),
  FOREIGN KEY ('tipo_id') REFERENCES tipos('id_tipo')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 PACK_KEYS=0;

LOCK TABLES `bienes` WRITE;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
