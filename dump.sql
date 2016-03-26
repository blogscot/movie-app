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
  `image_url` varchar(256) DEFAULT NULL,
  `category` varchar(20) DEFAULT 'General',
  `description` varchar(512) DEFAULT NULL,
  `expires_on` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `isSold` tinyint(1) DEFAULT '0',
  `seller_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adverts`
--

LOCK TABLES `adverts` WRITE;
/*!40000 ALTER TABLE `adverts` DISABLE KEYS */;
INSERT INTO `adverts` VALUES (71,'Avatar',8.99,'http://localhost:8888/uploads/colin/avatar.jpg','Action','This is a fantasy film.','2016-04-09 16:01:02',1,33,'2016-03-26 17:12:57','2016-03-26 17:12:57'),(72,'Thor',9.99,'http://localhost:8888/uploads/colin/thor.jpeg','Action','This is a fantasy film. I should add this category to the list.','2016-04-09 16:02:45',1,33,'2016-03-26 17:11:12','2016-03-26 17:11:12'),(73,'The Silence of the Lambs',7.5,'http://localhost:8888/uploads/colin/lambs.jpeg','Crime','This is a crime movie.','2016-04-23 16:05:26',1,33,'2016-03-26 17:07:22','2016-03-26 17:07:22');
/*!40000 ALTER TABLE `adverts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(128) DEFAULT NULL,
  `note` varchar(128) DEFAULT NULL,
  `advert_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `balance` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (44,'New Ad','Avatar',NULL,33,1.54,8.46,'2016-03-26 17:01:02','2016-03-26 17:01:02'),(45,'Deposit',NULL,NULL,33,5,13.46,'2016-03-26 17:01:23','2016-03-26 17:01:23'),(46,'New Ad','Thor',NULL,33,1.82,11.64,'2016-03-26 17:02:45','2016-03-26 17:02:45'),(47,'New Ad','The Silence of the Lambs',NULL,33,3.08,8.56,'2016-03-26 17:05:26','2016-03-26 17:05:26'),(48,'Purchase','The Silence of the Lambs',73,30,7.5,2.5,'2016-03-26 17:07:22','2016-03-26 17:07:22'),(49,'Deposit',NULL,NULL,30,20,22.5,'2016-03-26 17:10:40','2016-03-26 17:10:40'),(50,'Purchase','Thor',72,30,9.99,12.51,'2016-03-26 17:11:12','2016-03-26 17:11:12'),(51,'Purchase','Avatar',71,30,8.99,3.52,'2016-03-26 17:12:57','2016-03-26 17:12:57');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permissions`
--

LOCK TABLES `user_permissions` WRITE;
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;
INSERT INTO `user_permissions` VALUES (19,22,0,'2016-02-20 01:49:19','2016-02-20 01:49:19'),(18,3,0,'2016-02-20 01:48:23','2016-02-20 01:48:23'),(17,2,0,'2016-02-20 01:47:37','2016-02-20 01:47:37'),(16,1,0,'2016-02-19 23:48:32','2016-02-19 23:48:32'),(20,23,1,'2016-02-29 16:40:24','2016-02-29 16:40:24'),(21,26,0,'2016-03-04 12:07:58','2016-03-04 12:07:58'),(22,27,0,'2016-03-05 13:27:34','2016-03-05 13:27:34'),(23,28,0,'2016-03-26 16:30:09','2016-03-26 16:30:09'),(24,29,0,'2016-03-26 16:33:10','2016-03-26 16:33:10'),(25,30,0,'2016-03-26 16:35:30','2016-03-26 16:35:30'),(26,31,0,'2016-03-26 16:37:50','2016-03-26 16:37:50'),(27,32,0,'2016-03-26 16:38:51','2016-03-26 16:38:51'),(28,33,0,'2016-03-26 16:39:13','2016-03-26 16:39:13');
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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (33,'colin','Colin','C','colin@colin.com','$2y$10$oQCr6E7MCbXs/Z.fxU5TQ.a4B9v9LUqlZS5qkMibLxDRS3y0PpFFy','2016-03-26 16:39:13','2016-03-26 16:39:13'),(32,'john','John','J','john@john.com','$2y$10$f8stl.y1AVd2/EvBirYTx.Avu7X74DTGuwyNfRkI0si7bgoQIz9p2','2016-03-26 16:38:51','2016-03-26 16:38:51'),(30,'iain','Iain','D','iain@iain.com','$2y$10$/9buUOO/Zld1uF6v.AP2bOtmxpvoKLKqOo7L/iw7CXJNVfwohiijq','2016-03-26 16:35:30','2016-03-26 16:35:30'),(31,'sam','Sam','S','sam@sam.com','$2y$10$rybUyw4w1BlPA1G6vOY2q.Gj4rdXGRYq4MM7SlKhLvyBkunrwsuPy','2016-03-26 16:37:50','2016-03-26 16:37:50');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (8,3.52,30,'2016-03-26 16:35:30','2016-03-26 17:12:57'),(9,0,31,'2016-03-26 16:37:50','2016-03-26 16:37:50'),(10,0,32,'2016-03-26 16:38:51','2016-03-26 16:38:51'),(11,35.04,33,'2016-03-26 16:39:13','2016-03-26 17:12:57');
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

-- Dump completed on 2016-03-26 17:15:56
