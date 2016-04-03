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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adverts`
--

LOCK TABLES `adverts` WRITE;
/*!40000 ALTER TABLE `adverts` DISABLE KEYS */;
INSERT INTO `adverts` VALUES (71,'Avatar',8.99,'http://localhost:8888/uploads/colin/avatar.jpg','Action','This is a fantasy film.','2016-04-09 16:01:02',0,33,'2016-03-26 17:43:13','2016-03-26 17:12:57'),(72,'Thor',9.99,'http://localhost:8888/uploads/colin/thor.jpeg','Action','This is a fantasy film. I should add this category to the list.','2016-05-09 16:02:45',1,32,'2016-04-03 12:01:58','2016-04-03 12:01:58'),(73,'The Silence of the Lambs',7.5,'http://localhost:8888/uploads/colin/lambs.jpeg','Crime','This is a crime movie.','2016-04-23 16:05:26',0,33,'2016-03-26 17:45:21','2016-03-26 17:07:22'),(74,'The Broken',8.88,'http://localhost:8888/uploads/iain/thebroken.jpeg','Romance','This is a romance film.','2016-04-09 17:03:14',0,30,'2016-04-03 11:52:31','2016-04-03 11:36:40'),(78,'TestFilm',3.45,'http://localhost:8888/uploads/iain/avatar.jpg','Action','Hoo!','2016-04-24 15:47:16',0,30,'2016-04-03 15:47:16','2016-04-03 15:47:16');
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
  `title` varchar(128) DEFAULT NULL,
  `reason` varchar(128) DEFAULT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `balance` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (68,NULL,'Deposit',30,0,10,40.86,'2016-04-03 15:44:43','2016-04-03 15:44:43'),(69,NULL,'Withdrawal',30,0,20,20.86,'2016-04-03 15:45:17','2016-04-03 15:45:17'),(70,'TestFilm','New Ad',0,30,2.1,18.76,'2016-04-03 15:47:16','2016-04-03 15:47:16');
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
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permissions`
--

LOCK TABLES `user_permissions` WRITE;
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;
INSERT INTO `user_permissions` VALUES (25,30,1,'2016-03-26 16:35:30','2016-03-26 16:35:30'),(26,31,0,'2016-03-26 16:37:50','2016-03-26 16:37:50'),(27,32,0,'2016-03-26 16:38:51','2016-03-26 16:38:51'),(28,33,0,'2016-03-26 16:39:13','2016-03-26 16:39:13');
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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (8,18.76,30,'2016-03-26 16:35:30','2016-04-03 15:47:16'),(9,0,31,'2016-03-26 16:37:50','2016-03-26 16:37:50'),(10,39.97,32,'2016-03-26 16:38:51','2016-04-03 12:01:58'),(11,25.05,33,'2016-03-26 16:39:13','2016-04-03 12:01:58');
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

-- Dump completed on 2016-04-03 16:48:46
