/*
Navicat MySQL Data Transfer

Source Server         : LOCAL SERVER
Source Server Version : 50133
Source Host           : localhost:3306
Source Database       : bdcajita

Target Server Type    : MYSQL
Target Server Version : 50133
File Encoding         : 65001

Date: 2014-03-20 15:58:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for banco
-- ----------------------------
DROP TABLE IF EXISTS `banco`;
CREATE TABLE `banco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `elim` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Table structure for caja_depositos
-- ----------------------------
DROP TABLE IF EXISTS `caja_depositos`;
CREATE TABLE `caja_depositos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_caja_miembro` int(255) DEFAULT NULL,
  `id_banco` int(255) DEFAULT NULL,
  `n_trans` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `monto` float(255,0) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_estatus` int(255) DEFAULT NULL,
  `elim` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_caja_miembro` (`id_caja_miembro`),
  KEY `id_banco` (`id_banco`),
  KEY `id_estatus_cd` (`id_estatus`),
  CONSTRAINT `id_estatus_cd` FOREIGN KEY (`id_estatus`) REFERENCES `estatus` (`id`),
  CONSTRAINT `id_banco` FOREIGN KEY (`id_banco`) REFERENCES `banco` (`id`),
  CONSTRAINT `id_caja_miembro` FOREIGN KEY (`id_caja_miembro`) REFERENCES `caja_miembro` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Table structure for caja_miembro
-- ----------------------------
DROP TABLE IF EXISTS `caja_miembro`;
CREATE TABLE `caja_miembro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_miembro` int(255) DEFAULT NULL,
  `id_caja_monto` int(255) DEFAULT NULL,
  `id_caja_prestamo` int(255) DEFAULT NULL,
  `cantidad` int(255) DEFAULT NULL,
  `elim` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_miembro` (`id_miembro`),
  KEY `id_monto` (`id_caja_monto`),
  KEY `id_caja_prestamo` (`id_caja_prestamo`),
  CONSTRAINT `id_caja_prestamo` FOREIGN KEY (`id_caja_prestamo`) REFERENCES `caja_prestamos` (`id`),
  CONSTRAINT `id_miembro` FOREIGN KEY (`id_miembro`) REFERENCES `miembro` (`id`),
  CONSTRAINT `id_monto` FOREIGN KEY (`id_caja_monto`) REFERENCES `caja_montos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Table structure for caja_montos
-- ----------------------------
DROP TABLE IF EXISTS `caja_montos`;
CREATE TABLE `caja_montos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monto` float(255,0) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `elim` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Table structure for caja_prestamos
-- ----------------------------
DROP TABLE IF EXISTS `caja_prestamos`;
CREATE TABLE `caja_prestamos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_porcentaje_interes` int(255) DEFAULT NULL,
  `monto_prestamo` float(255,0) DEFAULT NULL,
  `abonado` float(255,0) DEFAULT NULL,
  `elim` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_porcentaje_interes` (`id_porcentaje_interes`),
  CONSTRAINT `id_porcentaje_interes` FOREIGN KEY (`id_porcentaje_interes`) REFERENCES `porcentaje_intereses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Table structure for estatus
-- ----------------------------
DROP TABLE IF EXISTS `estatus`;
CREATE TABLE `estatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Table structure for miembro
-- ----------------------------
DROP TABLE IF EXISTS `miembro`;
CREATE TABLE `miembro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(255) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` varchar(11) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `id_perfil` int(1) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuario` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `clave` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `elim` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_perfil` (`id_perfil`),
  CONSTRAINT `id_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Table structure for perfil
-- ----------------------------
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `elim` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Table structure for porcentaje_intereses
-- ----------------------------
DROP TABLE IF EXISTS `porcentaje_intereses`;
CREATE TABLE `porcentaje_intereses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `porcentaje` int(255) DEFAULT NULL,
  `id_tipo` int(255) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `elim` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_intereses` (`id_tipo`),
  CONSTRAINT `id_tipo_intereses` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_intereses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- ----------------------------
-- Table structure for tipo_intereses
-- ----------------------------
DROP TABLE IF EXISTS `tipo_intereses`;
CREATE TABLE `tipo_intereses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
