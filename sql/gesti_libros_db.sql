-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para gesti_libros_db
CREATE DATABASE IF NOT EXISTS `gesti_libros_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gesti_libros_db`;

-- Volcando estructura para tabla gesti_libros_db.detallep
CREATE TABLE IF NOT EXISTS `detallep` (
  `id_detalle` bigint NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint NOT NULL,
  `id_prestamo` bigint NOT NULL,
  PRIMARY KEY (`id_detalle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gesti_libros_db.estado
CREATE TABLE IF NOT EXISTS `estado` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `estado` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gesti_libros_db.grados
CREATE TABLE IF NOT EXISTS `grados` (
  `id_grado` smallint NOT NULL AUTO_INCREMENT,
  `grado` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_grado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gesti_libros_db.libros
CREATE TABLE IF NOT EXISTS `libros` (
  `id_libro` int NOT NULL AUTO_INCREMENT,
  `nombre_libro` tinytext COLLATE utf8mb4_general_ci NOT NULL,
  `imagen` longtext COLLATE utf8mb4_general_ci,
  `detalle` mediumtext COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_libro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gesti_libros_db.prestamo
CREATE TABLE IF NOT EXISTS `prestamo` (
  `id_prestamo` bigint NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora_prestamo` time NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `id_estado` int NOT NULL,
  PRIMARY KEY (`id_prestamo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla gesti_libros_db.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `documento` bigint NOT NULL,
  `tipo_documento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombres` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `celular` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_tipo_usuario` smallint NOT NULL DEFAULT '0',
  `id_estado` smallint NOT NULL DEFAULT '0',
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_grado` smallint DEFAULT NULL,
  PRIMARY KEY (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `tipo_usuario` (
	`id_tipo_usuario` INT(11) NOT NULL AUTO_INCREMENT,
	`tipo_usuario` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id_tipo_usuario`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=2
;


-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
