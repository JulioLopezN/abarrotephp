-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.13-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para abarrotephp
CREATE DATABASE IF NOT EXISTS `abarrotephp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `abarrotephp`;


-- Volcando estructura para tabla abarrotephp.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla abarrotephp.categorias: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `descripcion`) VALUES
	(1, 'Fruta'),
	(2, 'Verdura'),
	(3, 'Lacteo'),
	(4, 'Carniceria'),
	(5, 'Panaderia');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;


-- Volcando estructura para tabla abarrotephp.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(13) NOT NULL,
  `concepto` varchar(100) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `cantidad` int(6) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `imagen_url` varchar(128) DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `FK_productos_categorias` (`categoria_id`),
  CONSTRAINT `FK_productos_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla abarrotephp.productos: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id`, `codigo`, `concepto`, `precio`, `costo`, `cantidad`, `unidad`, `categoria_id`, `imagen_url`, `descripcion`) VALUES
	(1, 10001, 'Naranja', 3.00, 2.50, 5, 'Pieza', 1, '10001.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
	(2, 10002, 'Salchicha', 2.00, 1.50, 4, 'Pieza', 4, '10002.jpg', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
	(5, 10004, 'Queso Chihuahua', 4.00, 5.00, 5, 'Paquete', 3, '10004.jpg', 'Ut at tortor interdum, blandit justo non, imperdiet ante.'),
	(9, 10006, 'Cocacola', 12.00, 8.00, 10, 'Saco', 2, '10006.jpg', 'Aenean suscipit sem ac ante dignissim, vel rhoncus ex hendrerit.'),
	(10, 10007, 'Tenedor', 10.00, 6.00, 7, 'Fardo', 3, '10007.jpg', 'Mauris ut euismod ligula. Integer mattis rutrum consectetur. Cras congue mauris quis ullamcorper pretium. Donec erat libero, aliquet non pretium eget.');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
