-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.11.0.7065
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
CREATE DATABASE IF NOT EXISTS `gesti_libros_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `gesti_libros_db`;

-- Volcando estructura para tabla gesti_libros_db.d_general_prestamo
CREATE TABLE IF NOT EXISTS `d_general_prestamo` (
  `id_detalle` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_general` int(11) DEFAULT NULL,
  `id_libro` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detalle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gesti_libros_db.d_general_prestamo: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gesti_libros_db.estado
CREATE TABLE IF NOT EXISTS `estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` tinytext NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gesti_libros_db.estado: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gesti_libros_db.general_prestamos
CREATE TABLE IF NOT EXISTS `general_prestamos` (
  `id_prestamo` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  `fecha_prestamo` date NOT NULL,
  `hora_prestamo` time NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `hora_entrega` time DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_prestamo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gesti_libros_db.general_prestamos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gesti_libros_db.grados
CREATE TABLE IF NOT EXISTS `grados` (
  `id_grado` smallint(6) NOT NULL AUTO_INCREMENT,
  `grado` varchar(50) NOT NULL,
  PRIMARY KEY (`id_grado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gesti_libros_db.grados: ~2 rows (aproximadamente)
INSERT INTO `grados` (`id_grado`, `grado`) VALUES
	(1, '11-A'),
	(2, '10-B');

-- Volcando estructura para tabla gesti_libros_db.libros
CREATE TABLE IF NOT EXISTS `libros` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_libro` tinytext NOT NULL,
  `imagen` longtext DEFAULT NULL,
  `detalle` mediumtext DEFAULT NULL,
  `cantidad_total` int(11) DEFAULT NULL,
  `cantidad_disponible` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gesti_libros_db.libros: ~1 rows (aproximadamente)
INSERT INTO `libros` (`id_libro`, `nombre_libro`, `imagen`, `detalle`, `cantidad_total`, `cantidad_disponible`) VALUES
	(2, 'Harry Potter', 'libro_harry_potter.jpg', 'Prueba del servidor', NULL, NULL);

-- Volcando estructura para tabla gesti_libros_db.tipo_usuario
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gesti_libros_db.tipo_usuario: ~1 rows (aproximadamente)
INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo_usuario`) VALUES
	(1, 'Admin');

-- Volcando estructura para tabla gesti_libros_db.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `documento` bigint(20) NOT NULL,
  `tipo_documento` varchar(100) DEFAULT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_tipo_usuario` smallint(6) DEFAULT NULL,
  `id_estado` smallint(6) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_grado` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gesti_libros_db.usuarios: ~2 rows (aproximadamente)
INSERT INTO `usuarios` (`documento`, `tipo_documento`, `nombres`, `apellidos`, `celular`, `password`, `id_tipo_usuario`, `id_estado`, `fecha_registro`, `fecha_actualizacion`, `id_grado`) VALUES
	(79464482, 'C.C.', 'Alfonso', 'Mejia', '3124508901', NULL, NULL, NULL, '2025-04-19 10:11:39', NULL, 1),
	(1110460410, 'C.C.', 'Administrador', 'Gestor', '3105853668', 'WGVGbUN2QnZuSExsemg5QjdFa1BVUT09OjoZN8tnbOc3uZPY4PrhEmk8', 1, 1, '2024-03-09 15:26:38', '2024-09-20 15:57:09', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
