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


-- Volcando estructura de base de datos para db_demo
CREATE DATABASE IF NOT EXISTS `db_demo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_demo`;

-- Volcando estructura para tabla db_demo.estados
CREATE TABLE IF NOT EXISTS `estados` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_estado`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_demo.estados: ~3 rows (aproximadamente)
INSERT INTO `estados` (`id_estado`, `estado`) VALUES
	(1, 'activo'),
	(2, 'inactivo'),
	(3, 'eliminado');

-- Volcando estructura para tabla db_demo.sedes
CREATE TABLE IF NOT EXISTS `sedes` (
  `id_sede` int NOT NULL AUTO_INCREMENT,
  `nombre_sede` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_sede`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_demo.sedes: ~4 rows (aproximadamente)
INSERT INTO `sedes` (`id_sede`, `nombre_sede`, `direccion`, `telefono`) VALUES
	(12, 'Sede Centro Javeriano 3', 'Manzana Q Calle 18', '3122402301'),
	(13, 'Sede Centro Javeriano 5', 'Manzana R Calle 125', '3142402312'),
	(14, 'Sede Bebes Sonrientes', 'Calle 12 Barrio Jardin', '3120092301'),
	(15, 'Centro Javeriano Nueva Colombo', 'Calle 12 Carrera 8', '3123402301');

-- Volcando estructura para tabla db_demo.tipos
CREATE TABLE IF NOT EXISTS `tipos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_demo.tipos: ~4 rows (aproximadamente)
INSERT INTO `tipos` (`id`, `tipo_usuario`) VALUES
	(1, 'admin'),
	(2, 'medico'),
	(3, 'empleados'),
	(4, 'vigilantes');

-- Volcando estructura para tabla db_demo.users
CREATE TABLE IF NOT EXISTS `users` (
  `documento` bigint NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `names` varchar(255) DEFAULT NULL,
  `surnames` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_type_user` int DEFAULT NULL,
  `id_state` int DEFAULT NULL,
  `id_sede` int DEFAULT NULL,
  PRIMARY KEY (`documento`) USING BTREE,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_demo.users: ~5 rows (aproximadamente)
INSERT INTO `users` (`documento`, `password`, `names`, `surnames`, `email`, `id_type_user`, `id_state`, `id_sede`) VALUES
	(71233401, NULL, 'Manuel Alejandro', 'Franco', 'manueal123@gmail.com', 2, 2, 12),
	(79464482, 'Admin123456', 'Admin', 'Gestamos', 'admin@gmail.com', 1, 1, NULL),
	(1003240231, NULL, 'Carmen', 'Molina', 'carmen@gmail.com', 2, 1, 13),
	(1006240230, NULL, 'German', 'Moreno', 'german@gmail.com', 2, 1, 14),
	(1008110240, NULL, 'Albeiro', 'Mejia', 'albeiro@gmail.com', 2, 1, 13),
	(1108120759, NULL, 'Amparo', 'Garcia', 'amparo123@gmail.com', 2, 1, 12),
	(1110460410, NULL, 'Alejandro', 'Munoz Garcia', 'alejandro@gmail.com', 2, 1, 15);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
