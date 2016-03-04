-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: advert_db
-- ------------------------------------------------------
-- Server version	5.5.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adverts`
--

DROP TABLE IF EXISTS `adverts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adverts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `category` varchar(20) DEFAULT 'General',
  `description` varchar(512) DEFAULT NULL,
  `ad_rate` double NOT NULL DEFAULT '0',
  `isSold` tinyint(1) DEFAULT '0',
  `seller_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adverts`
--

LOCK TABLES `adverts` WRITE;
/*!40000 ALTER TABLE `adverts` DISABLE KEYS */;
INSERT INTO `adverts` VALUES (27,'Rocky',1.23,'Action','The story of rambo before Rambo.',10.5,0,3,'2016-03-03 11:09:49','2016-03-03 12:09:49'),(28,'Rambo II',3.5,'Thriller','The sequel.',10.1666666667,0,2,'2016-03-02 17:54:10','2016-03-02 18:53:34'),(29,'Rambo III',3.75,'Action','Yet more rambo.',10.25,0,2,'2016-03-03 09:55:45','2016-03-03 10:55:45'),(30,'Rocky',10,'Action','This is the best boxing movie ever!',10.5833333333,0,2,'2016-03-03 09:55:31','2016-03-03 10:55:31'),(31,'2001',1.99,'Scifi','A Space Odyssey.',10.25,0,2,'2016-03-03 11:02:35','2016-03-03 12:02:35'),(32,'A Wonderful Life',2.5,'Family','Possibly one of the best family movies ever made. Starring Jimmy Stewart.',11,0,3,'2016-03-03 12:11:05','2016-03-03 12:11:05'),(33,'The Wizard of Oz',3.95,'Family','The flying monkeys is the best bit.',10.5833333333,0,22,'2016-03-03 17:45:30','2016-03-03 18:45:30');
/*!40000 ALTER TABLE `adverts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permissions`
--

LOCK TABLES `user_permissions` WRITE;
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;
INSERT INTO `user_permissions` VALUES (19,22,0,'2016-02-20 01:49:19','2016-02-20 01:49:19'),(18,3,0,'2016-02-20 01:48:23','2016-02-20 01:48:23'),(17,2,0,'2016-02-20 01:47:37','2016-02-20 01:47:37'),(16,1,0,'2016-02-19 23:48:32','2016-02-19 23:48:32'),(20,23,1,'2016-02-29 16:40:24','2016-02-29 16:40:24'),(21,26,0,'2016-03-04 12:07:58','2016-03-04 12:07:58');
/*!40000 ALTER TABLE `user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `firstname` varchar(35) NOT NULL,
  `surname` varchar(35) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'iain','iain','d','iain@gmail.com','$2y$10$LptN.IYG3NtMJvplvBKDXO7FH/WJhx8EbmB.Wk3fMZ3JSHkuDoBTK','2016-02-20 01:46:39','2016-02-20 01:46:39'),(1,'john','john','k','johnwkay95@gmail.com','$2y$10$LptN.IYG3NtMJvplvBKDXO7FH/WJhx8EbmB.Wk3fMZ3JSHkuDoBTK','2016-02-19 23:48:32','2016-02-19 23:48:44'),(2,'colin','colin','k','colin@gmail.com','$2y$10$LptN.IYG3NtMJvplvBKDXO7FH/WJhx8EbmB.Wk3fMZ3JSHkuDoBTK','2016-02-20 01:46:14','2016-02-20 01:46:14'),(23,'blogscot','Iain','Diamond','b@bb.com','$2y$10$Ga0CsQclPBsnfY.Cfba9.uBVvYTj6cuOJib9jUh4dqyHd2XSJRfga','2016-02-29 16:40:24','2016-02-29 16:40:24'),(26,'kev','Kevin','McDonald','k@k.com','$2y$10$AEpVQs99sT3rL3Qvogt66eXsSirIPm0FDomKYA.22zPplv/oKYo5e','2016-03-04 12:07:58','2016-03-04 12:07:58');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `balance` double NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (1,10,1,'2016-03-04 12:07:58','2016-03-04 12:07:58'),(2,10,2,'2016-03-04 12:07:58','2016-03-04 12:07:58'),(3,10,3,'2016-03-04 12:07:58','2016-03-04 12:07:58'),(4,10,23,'2016-03-04 12:07:58','2016-03-04 12:07:58'),(5,10,26,'2016-03-04 12:07:58','2016-03-04 12:07:58');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-04 11:11:36
