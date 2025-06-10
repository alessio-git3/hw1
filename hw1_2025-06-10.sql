# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Database: hw1
# Generation Time: 2025-06-10 20:08:48 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table pagamenti
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pagamenti`;

CREATE TABLE `pagamenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stato_pagamento` varchar(255) DEFAULT NULL,
  `timeT` varchar(255) DEFAULT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payer_id` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `second_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `totale` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `pagamenti_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `pagamenti` WRITE;
/*!40000 ALTER TABLE `pagamenti` DISABLE KEYS */;

INSERT INTO `pagamenti` (`id`, `user_id`, `stato_pagamento`, `timeT`, `payment_id`, `payer_id`, `first_name`, `second_name`, `email`, `totale`)
VALUES
	(1,7,'approved','2025-06-10T20:03:19Z','PAYID-NBEI67Y5DN15291BC480524A','JGMUCEPVKGFHE','John','','sb-nipfv41334071@personal.example.com','EUR695.00'),
	(2,7,'approved','2025-06-10T20:05:26Z','PAYID-NBEI77Q55H8275744958425W','JGMUCEPVKGFHE','John','','sb-nipfv41334071@personal.example.com','EUR1585.00'),
	(3,9,'approved','2025-06-10T20:06:45Z','PAYID-NBEJATI3JB72462Y79489344','JGMUCEPVKGFHE','John','','sb-nipfv41334071@personal.example.com','EUR350.00');

/*!40000 ALTER TABLE `pagamenti` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazionalita` varchar(255) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `data_nascita` date NOT NULL,
  `prefisso_telefono` varchar(255) NOT NULL,
  `numero_telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `nazionalita`, `titolo`, `name`, `surname`, `data_nascita`, `prefisso_telefono`, `numero_telefono`, `email`, `password`)
VALUES
	(2,'AF','2','Pippa','Lanza','2002-03-01','+39','1234567890','test1@gmail.com','$2y$10$zc.5DgYdKu4CJrQ151q4deKxf3VjPUmnbYEFW7XQdUIQ42DhGTCqy'),
	(3,'AR','UOMO','Alla','Ddvcxvx','2002-01-04','+44','1234567890','test2@gmail.com','$2y$10$dObZCIFb28gBfjKLsRMn1eg7hh0J3lMD0nKPclofd4eNOKjHMIcfm'),
	(4,'IT','2','Alessio','Meli','2003-10-26','+39','3284418256','test3@icloud.com','$2y$10$oKxuKRNX4J6Cq83WiaTM0ukrBQdor6kc6dG0Tn3L7W2QwMw/Wl5EK'),
	(5,'IN','PREFERISCO NON SPECIFICARLO','Puzza','Ascelle','1999-05-07','+91','1234567890','test5@gmail.com','$2y$10$/3PKDPtUxXJMBbpfF8tt1.y8Dc6zOB/FxxIgmghaKpNlRKqFw24R2'),
	(6,'CN','DONNA','Cin','Cion','2003-08-07','+86','1234567890','test6@icloud.com','$2y$10$o5GGM1L9I7bCkijpQ0mKCumXG.DIceqNwc0JGZWKUucg41g94JVY6'),
	(7,'CU','UOMO','Miguel Da Cuba','Prado','1976-08-09','+1','1234567890','test7@gmail.com','$2y$10$gmA1Yl4SccyJ9XGpv6oWWuD6veyQ1xpBHSSq/7/BQ.QcnBjcYFB/6'),
	(8,'IT','UOMO','Alessio','Meli','2003-10-26','+39','3284418256','alessio.meli2003@icloud.com','$2y$10$dyI1qr6rHiGixan8C1/cA.5lDCA/t6D9ei3Bz3Msr9IMpgkxANY/S'),
	(9,'DE','DONNA','Angela','Merkel','1954-07-17','+49','1234567890','test9@gmail.com','$2y$10$NO4MjKb7sLBbyQXU/nG7pOYoA4sK97./2DH6LPf/OLZl2o1GqSqeK');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
