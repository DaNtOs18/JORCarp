-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para jor_carp
CREATE DATABASE IF NOT EXISTS `jor_carp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `jor_carp`;

-- Volcando estructura para tabla jor_carp.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `cus_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cus_name` varchar(255) NOT NULL,
  `cus_nif` varchar(255) NOT NULL,
  `cus_address1` varchar(255) NOT NULL,
  `cus_address2` varchar(255) NOT NULL,
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla jor_carp.customers: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Volcando estructura para tabla jor_carp.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = Blocked; 1 = Validated',
  `user_privilege` int(11) NOT NULL DEFAULT '0' COMMENT '0 = User; 1 = Admin',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla jor_carp.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`user_id`, `user_name`, `user_mail`, `user_password`, `user_status`, `user_privilege`) VALUES
	(1, 'José', 'jorcarp@webmaster.com', '662eaa47199461d01a623884080934ab', 1, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
