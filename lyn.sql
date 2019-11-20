-- MySQL dump 10.13  Distrib 5.7.28, for Linux (x86_64)
--
-- Host: localhost    Database: lyn
-- ------------------------------------------------------
-- Server version	5.7.28-0ubuntu0.18.04.4

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
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `items_total` int(11) DEFAULT NULL,
  `price_total` double DEFAULT NULL,
  `items_single` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398B03A8386` (`created_by_id`),
  CONSTRAINT `FK_F5299398B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (27,5,10.5,3,'2019-11-14 14:18:57','2019-11-14 17:27:56',NULL),(28,4,11.5,4,'2019-11-14 16:42:53','2019-11-14 17:34:28',NULL),(29,6,20.2,4,'2019-11-14 17:36:31','2019-11-14 18:09:13',NULL),(30,7,21.7,5,'2019-11-15 08:22:51','2019-11-15 08:35:09',NULL),(31,7,18,3,'2019-11-15 08:31:31','2019-11-15 08:32:25',NULL),(32,2,6,2,'2019-11-15 10:25:18','2019-11-15 10:25:25',NULL),(33,1,2.5,1,'2019-11-15 10:27:39','2019-11-15 10:27:39',NULL),(34,2,3.5,2,'2019-11-15 10:28:19','2019-11-15 10:29:52',NULL),(35,2,4.1,2,'2019-11-15 11:21:12','2019-11-15 11:21:16',NULL),(36,8,24.3,4,'2019-11-15 12:34:05','2019-11-15 12:35:15',NULL),(37,2,3.5,2,'2019-11-15 13:52:18','2019-11-15 13:52:22',NULL),(38,19,55.4,6,'2019-11-15 15:18:56','2019-11-15 15:42:27',NULL),(39,5,16,4,'2019-11-15 15:41:33','2019-11-15 16:49:49',NULL),(40,2,5.1,2,'2019-11-15 17:23:50','2019-11-15 17:23:51',NULL),(41,2,4.1,2,'2019-11-15 20:21:01','2019-11-15 20:53:46',NULL),(42,3,13.3,2,'2019-11-15 21:14:44','2019-11-15 21:18:49',NULL),(43,7,21.5,2,'2019-11-17 09:00:02','2019-11-17 11:19:00',NULL),(44,40,114.2,6,'2019-11-17 11:21:33','2019-11-17 12:20:25',NULL),(45,18,40.9,4,'2019-11-17 13:19:25','2019-11-17 14:09:20',NULL),(46,1,1,1,'2019-11-17 15:03:05','2019-11-17 15:03:05',NULL),(47,14,18.6,3,'2019-11-17 16:58:13','2019-11-17 17:01:54',NULL),(48,2,3.6,2,'2019-11-17 19:30:12','2019-11-17 19:30:15',NULL),(49,30,128.9,5,'2019-11-17 21:59:15','2019-11-17 22:04:41',NULL),(51,2,2.6,2,'2019-11-18 08:19:42','2019-11-18 08:19:45',NULL),(52,3,9.6,3,'2019-11-18 08:21:09','2019-11-18 08:21:13',NULL),(53,36,67,5,'2019-11-18 14:08:57','2019-11-18 14:11:11',NULL),(54,3,7.1,3,'2019-11-18 16:11:31','2019-11-18 16:15:22',NULL),(55,4,13,3,'2019-11-18 16:24:16','2019-11-18 16:27:17',NULL),(56,1,1.6,1,'2019-11-18 16:26:16','2019-11-18 16:26:16',NULL),(57,15,23.3,4,'2019-11-18 16:38:26','2019-11-20 14:34:57',NULL),(58,13,21.8,4,'2019-11-18 17:14:39','2019-11-18 17:15:32',NULL),(59,7,20,4,'2019-11-18 17:16:02','2019-11-19 18:11:04',NULL),(60,3,6,2,'2019-11-18 19:53:24','2019-11-18 20:42:24',NULL),(61,1,2.5,1,'2019-11-19 08:56:13','2019-11-19 08:56:13',NULL),(62,10,16.1,3,'2019-11-19 08:57:04','2019-11-19 09:20:04',NULL),(63,34,75.3,6,'2019-11-19 09:21:49','2019-11-19 09:24:27',NULL),(65,2,2.9,2,'2019-11-20 14:47:19','2019-11-20 14:47:27',1),(66,1,3.5,1,'2019-11-20 15:42:42','2019-11-20 15:42:42',1),(67,6,15.6,4,'2019-11-20 15:59:37','2019-11-20 16:12:49',1),(68,1,2.5,1,'2019-11-20 16:53:22','2019-11-20 16:53:22',1),(69,1,2.5,1,'2019-11-20 16:57:43','2019-11-20 16:57:44',NULL);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `item_order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double DEFAULT NULL,
  `price_total` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_52EA1F094584665A` (`product_id`),
  KEY `IDX_52EA1F09E192A5F3` (`item_order_id`),
  CONSTRAINT `FK_52EA1F094584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_52EA1F09E192A5F3` FOREIGN KEY (`item_order_id`) REFERENCES `order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
INSERT INTO `order_item` VALUES (20,1,27,2,2.5,5),(21,2,27,2,1,2),(22,3,27,1,3.5,3.5),(23,1,28,1,2.5,2.5),(24,2,28,1,1,1),(25,6,28,1,2,2),(26,7,28,1,6,6),(27,5,29,2,1.6,3.2),(28,6,29,1,2,2),(29,7,29,2,6,12),(30,4,29,1,3,3),(31,1,30,1,2.5,2.5),(32,1,31,4,2.5,10),(33,2,31,1,1,1),(34,3,31,2,3.5,7),(35,3,30,2,3.5,7),(36,4,30,1,3,3),(37,5,30,2,1.6,3.2),(38,7,30,1,6,6),(39,1,32,1,2.5,2.5),(40,3,32,1,3.5,3.5),(41,1,33,1,2.5,2.5),(42,1,34,1,2.5,2.5),(43,2,34,1,1,1),(44,1,35,1,2.5,2.5),(45,5,35,1,1.6,1.6),(46,5,36,3,1.6,4.8),(47,7,36,2,6,12),(48,3,36,1,3.5,3.5),(49,6,36,2,2,4),(50,1,37,1,2.5,2.5),(51,2,37,1,1,1),(52,5,38,2,1.6,3.2),(53,2,38,1,1,1),(54,7,38,5,6,30),(55,6,38,5,2,10),(56,8,38,4,1.3,5.2),(57,4,38,2,3,6),(58,4,39,1,3,3),(59,7,39,1,6,6),(60,6,39,1,2,2),(61,1,39,2,2.5,5),(62,3,40,1,3.5,3.5),(63,5,40,1,1.6,1.6),(64,1,41,1,2.5,2.5),(65,5,41,1,1.6,1.6),(66,7,42,2,6,12),(67,8,42,1,1.3,1.3),(68,4,43,6,3,18),(76,3,43,1,3.5,3.5),(82,3,44,20,3.5,70),(85,4,44,3,3,9),(86,8,44,4,1.3,5.2),(87,5,44,10,1.6,16),(90,7,44,2,6,12),(91,6,44,1,2,2),(92,8,45,1,1.3,1.3),(93,5,45,1,1.6,1.6),(94,4,45,11,3,33),(95,2,45,5,1,5),(96,2,46,1,1,1),(98,5,47,6,1.6,9.6),(99,6,47,1,2,2),(100,2,47,7,1,7),(101,6,48,1,2,2),(102,5,48,1,1.6,1.6),(103,8,49,6,1.3,7.8),(104,6,49,4,2,8),(105,5,49,1,1.6,1.6),(106,7,49,18,6,108),(107,3,49,1,3.5,3.5),(111,2,51,1,1,1),(112,5,51,1,1.6,1.6),(113,5,52,1,1.6,1.6),(114,6,52,1,2,2),(115,7,52,1,6,6),(116,8,53,13,1.3,16.9),(117,5,53,6,1.6,9.6),(118,6,53,1,2,2),(119,3,53,9,3.5,31.5),(120,2,53,7,1,7),(121,5,54,1,1.6,1.6),(122,6,54,1,2,2),(123,3,54,1,3.5,3.5),(124,4,55,1,3,3),(125,6,55,2,2,4),(126,5,56,1,1.6,1.6),(127,7,55,1,6,6),(128,8,57,7,1.3,9.1),(129,6,57,5,2,10),(131,1,58,2,2.5,5),(132,3,58,1,3.5,3.5),(133,5,58,1,1.6,1.6),(134,8,58,9,1.3,11.7),(135,4,59,1,3,3),(136,2,59,1,1,1),(137,1,60,2,2.5,5),(138,2,60,1,1,1),(139,2,57,1,1,1),(140,5,57,2,1.6,3.2),(141,1,59,4,2.5,10),(142,1,61,1,2.5,2.5),(143,1,62,2,2.5,5),(144,8,62,7,1.3,9.1),(145,6,62,1,2,2),(146,1,63,2,2.5,5),(147,3,63,5,3.5,17.5),(148,8,63,6,1.3,7.8),(149,7,63,1,6,6),(150,6,63,19,2,38),(151,2,63,1,1,1),(152,7,59,1,6,6),(156,8,65,1,1.3,1.3),(157,5,65,1,1.6,1.6),(158,3,66,1,3.5,3.5),(159,1,67,1,2.5,2.5),(160,2,67,1,1,1),(161,5,67,1,1.6,1.6),(162,3,67,3,3.5,10.5),(163,1,68,1,2.5,2.5),(164,1,69,1,2.5,2.5);
/*!40000 ALTER TABLE `order_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'ASUS R541UA-DM1287T-8',2.5,'2019-11-12 16:34:26','2019-11-15 21:09:09'),(2,'Apple Mac',1,'2019-11-12 16:35:43','2019-11-15 10:31:42'),(3,'Dell Inspiro',3.5,'2019-11-12 16:35:58','2019-11-15 10:31:48'),(4,'模具a',3,'2019-11-14 17:31:55','2019-11-14 17:31:55'),(5,'模具d',1.6,'2019-11-14 17:32:08','2019-11-14 17:32:08'),(6,'传真3',2,'2019-11-14 17:32:17','2019-11-14 17:32:17'),(7,'传真4',6,'2019-11-14 17:32:28','2019-11-14 17:32:28'),(8,'椅子',1.3,'2019-11-15 15:20:34','2019-11-15 15:20:34');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','brucelee.drupal@gmail.com','brucelee.drupal@gmail.com',1,'WEzrHADT/Seetxxd5ATL.gId.uSWVU354DEaTJ3FHg4','$argon2i$v=19$m=65536,t=4,p=1$eXVwTFIuVW8vSmFqclcwcQ$25ferxiWy+qXN3/wSKOLQKqOodGBPpY4fKKmHpZe1pw','2019-11-20 16:57:53',NULL,NULL,'a:0:{}');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-20 17:16:31
