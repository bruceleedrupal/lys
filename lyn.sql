-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: lyn
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
  `created_by_id` int(11) DEFAULT NULL,
  `belongs_to_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398B03A8386` (`created_by_id`),
  KEY `IDX_F529939833C857F5` (`belongs_to_id`),
  CONSTRAINT `FK_F529939833C857F5` FOREIGN KEY (`belongs_to_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_F5299398B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (27,5,10.5,3,'2019-11-22 00:00:00',1,2),(28,4,11.5,4,'2019-11-14 16:42:53',NULL,2),(29,6,20.2,4,'2019-11-14 17:36:31',NULL,NULL),(30,7,21.7,5,'2019-11-15 08:22:51',NULL,NULL),(31,7,18,3,'2019-11-15 08:31:31',NULL,NULL),(32,2,6,2,'2019-11-15 10:25:18',NULL,NULL),(33,1,2.5,1,'2019-11-15 10:27:39',NULL,NULL),(34,2,3.5,2,'2019-11-15 10:28:19',NULL,2),(35,2,4.1,2,'2019-11-15 11:21:12',NULL,NULL),(36,8,24.3,4,'2019-11-15 12:34:05',NULL,NULL),(37,2,3.5,2,'2019-11-15 13:52:18',NULL,NULL),(38,19,55.4,6,'2019-11-15 15:18:56',NULL,NULL),(39,5,16,4,'2019-11-15 15:41:33',NULL,NULL),(40,2,5.1,2,'2019-11-15 17:23:50',NULL,NULL),(41,2,4.1,2,'2019-11-15 20:21:01',NULL,NULL),(42,3,13.3,2,'2019-11-15 21:14:44',NULL,NULL),(43,7,21.5,2,'2019-11-17 09:00:02',NULL,NULL),(44,40,114.2,6,'2019-11-17 11:21:33',NULL,NULL),(45,18,40.9,4,'2019-11-17 13:19:25',NULL,NULL),(46,1,1,1,'2019-11-17 15:03:05',NULL,NULL),(47,14,18.6,3,'2019-11-17 16:58:13',NULL,NULL),(48,2,3.6,2,'2019-11-17 19:30:12',NULL,NULL),(49,30,128.9,5,'2019-11-17 21:59:15',NULL,NULL),(51,2,2.6,2,'2019-11-18 08:19:42',NULL,NULL),(52,3,9.6,3,'2019-11-18 08:21:09',NULL,NULL),(53,36,67,5,'2019-11-18 14:08:57',NULL,NULL),(54,3,7.1,3,'2019-11-18 16:11:31',NULL,NULL),(55,4,13,3,'2019-11-18 16:24:16',NULL,NULL),(56,1,1.6,1,'2019-11-18 16:26:16',NULL,NULL),(57,15,23.3,4,'2019-11-18 16:38:26',NULL,NULL),(58,13,21.8,4,'2019-11-18 17:14:39',NULL,NULL),(59,7,20,4,'2019-11-18 17:16:02',NULL,NULL),(60,3,6,2,'2019-11-18 19:53:24',NULL,NULL),(61,1,2.5,1,'2019-11-19 08:56:13',NULL,NULL),(62,10,16.1,3,'2019-11-19 08:57:04',NULL,NULL),(63,34,75.3,6,'2019-11-19 09:21:49',NULL,NULL),(65,2,2.9,2,'2019-11-20 14:47:19',NULL,NULL),(66,1,3.5,1,'2019-11-20 15:42:42',NULL,NULL),(67,25,43.6,7,'2019-11-20 15:59:37',NULL,NULL),(68,21,32.1,2,'2019-11-20 16:53:22',NULL,NULL),(69,1,2.5,1,'2019-11-20 16:57:43',NULL,NULL),(70,1,2.5,1,'2019-11-20 17:17:56',NULL,NULL),(71,1,1.6,1,'2019-11-20 18:18:45',NULL,NULL),(72,33,51.2,7,'2019-11-20 18:19:08',NULL,4),(73,1,2.5,1,'2019-11-20 18:37:16',NULL,NULL),(74,21,64.5,4,'2019-11-20 22:10:39',NULL,NULL),(75,5,12.1,3,'2019-11-22 12:45:17',NULL,NULL),(76,4,8.6,4,'2019-11-22 14:13:16',2,NULL),(77,9,18,6,'2019-11-22 14:14:13',NULL,NULL),(78,15,27.2,7,'2019-11-25 09:02:10',NULL,2),(79,1,1.6,1,'2019-11-25 09:07:55',2,4),(80,2,6.5,2,'2019-11-25 09:10:21',NULL,2),(81,1,2.5,1,'2019-11-25 09:18:55',2,3),(82,3,12.5,3,'2019-11-25 09:19:13',NULL,NULL),(83,16,70.3,5,'2019-11-25 09:22:34',2,2),(84,8,17.5,6,'2019-11-25 16:47:52',1,4),(85,6,14.4,5,'2019-11-11 00:00:00',1,3),(86,13,28.5,4,'2019-11-27 00:00:00',1,3),(87,1,2.5,1,'2019-11-29 17:06:28',NULL,NULL),(88,1,2.5,1,'2019-11-29 17:07:08',NULL,NULL),(89,2,6,2,'2019-11-29 17:09:08',NULL,NULL),(90,1,2.5,1,'2019-11-29 17:19:45',1,NULL),(91,1,2.5,1,'2019-11-29 17:22:27',1,NULL),(92,1,2.5,1,'2019-12-02 12:12:26',1,NULL),(93,5,11,2,'2020-02-12 08:20:47',1,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
INSERT INTO `order_item` VALUES (20,1,27,2,2.5,5),(21,2,27,2,1,2),(22,3,27,1,3.5,3.5),(23,1,28,1,2.5,2.5),(24,2,28,1,1,1),(25,6,28,1,2,2),(26,7,28,1,6,6),(27,5,29,2,1.6,3.2),(28,6,29,1,2,2),(29,7,29,2,6,12),(30,4,29,1,3,3),(31,1,30,1,2.5,2.5),(32,1,31,4,2.5,10),(33,2,31,1,1,1),(34,3,31,2,3.5,7),(35,3,30,2,3.5,7),(36,4,30,1,3,3),(37,5,30,2,1.6,3.2),(38,7,30,1,6,6),(39,1,32,1,2.5,2.5),(40,3,32,1,3.5,3.5),(41,1,33,1,2.5,2.5),(42,1,34,1,2.5,2.5),(43,2,34,1,1,1),(44,1,35,1,2.5,2.5),(45,5,35,1,1.6,1.6),(46,5,36,3,1.6,4.8),(47,7,36,2,6,12),(48,3,36,1,3.5,3.5),(49,6,36,2,2,4),(50,1,37,1,2.5,2.5),(51,2,37,1,1,1),(52,5,38,2,1.6,3.2),(53,2,38,1,1,1),(54,7,38,5,6,30),(55,6,38,5,2,10),(56,8,38,4,1.3,5.2),(57,4,38,2,3,6),(58,4,39,1,3,3),(59,7,39,1,6,6),(60,6,39,1,2,2),(61,1,39,2,2.5,5),(62,3,40,1,3.5,3.5),(63,5,40,1,1.6,1.6),(64,1,41,1,2.5,2.5),(65,5,41,1,1.6,1.6),(66,7,42,2,6,12),(67,8,42,1,1.3,1.3),(68,4,43,6,3,18),(76,3,43,1,3.5,3.5),(82,3,44,20,3.5,70),(85,4,44,3,3,9),(86,8,44,4,1.3,5.2),(87,5,44,10,1.6,16),(90,7,44,2,6,12),(91,6,44,1,2,2),(92,8,45,1,1.3,1.3),(93,5,45,1,1.6,1.6),(94,4,45,11,3,33),(95,2,45,5,1,5),(96,2,46,1,1,1),(98,5,47,6,1.6,9.6),(99,6,47,1,2,2),(100,2,47,7,1,7),(101,6,48,1,2,2),(102,5,48,1,1.6,1.6),(103,8,49,6,1.3,7.8),(104,6,49,4,2,8),(105,5,49,1,1.6,1.6),(106,7,49,18,6,108),(107,3,49,1,3.5,3.5),(111,2,51,1,1,1),(112,5,51,1,1.6,1.6),(113,5,52,1,1.6,1.6),(114,6,52,1,2,2),(115,7,52,1,6,6),(116,8,53,13,1.3,16.9),(117,5,53,6,1.6,9.6),(118,6,53,1,2,2),(119,3,53,9,3.5,31.5),(120,2,53,7,1,7),(121,5,54,1,1.6,1.6),(122,6,54,1,2,2),(123,3,54,1,3.5,3.5),(124,4,55,1,3,3),(125,6,55,2,2,4),(126,5,56,1,1.6,1.6),(127,7,55,1,6,6),(128,8,57,7,1.3,9.1),(129,6,57,5,2,10),(131,1,58,2,2.5,5),(132,3,58,1,3.5,3.5),(133,5,58,1,1.6,1.6),(134,8,58,9,1.3,11.7),(135,4,59,1,3,3),(136,2,59,1,1,1),(137,1,60,2,2.5,5),(138,2,60,1,1,1),(139,2,57,1,1,1),(140,5,57,2,1.6,3.2),(141,1,59,4,2.5,10),(142,1,61,1,2.5,2.5),(143,1,62,2,2.5,5),(144,8,62,7,1.3,9.1),(145,6,62,1,2,2),(146,1,63,2,2.5,5),(147,3,63,5,3.5,17.5),(148,8,63,6,1.3,7.8),(149,7,63,1,6,6),(150,6,63,19,2,38),(151,2,63,1,1,1),(152,7,59,1,6,6),(156,8,65,1,1.3,1.3),(157,5,65,1,1.6,1.6),(158,3,66,1,3.5,3.5),(159,1,67,2,2.5,5),(160,2,67,3,1,3),(161,5,67,2,1.6,3.2),(162,3,67,3,3.5,10.5),(163,1,68,4,2.5,10),(164,1,69,1,2.5,2.5),(165,1,70,1,2.5,2.5),(166,8,68,17,1.3,22.1),(167,5,71,1,1.6,1.6),(171,1,73,1,2.5,2.5),(172,2,72,10,1,10),(173,1,74,11,2.5,27.5),(174,4,74,1,3,3),(175,2,74,4,1,4),(176,7,74,5,6,30),(177,4,67,1,3,3),(178,6,67,1,2,2),(179,8,67,13,1.3,16.9),(180,8,72,8,1.3,10.4),(182,1,75,3,2.5,7.5),(183,4,75,1,3,3),(184,5,75,1,1.6,1.6),(185,1,76,1,2.5,2.5),(186,3,76,1,3.5,3.5),(187,5,76,1,1.6,1.6),(188,2,76,1,1,1),(189,2,77,2,1,2),(190,3,77,2,3.5,7),(192,5,77,2,1.6,3.2),(193,8,77,1,1.3,1.3),(194,6,77,1,2,2),(195,1,72,3,2.5,7.5),(196,5,72,8,1.6,12.8),(197,4,72,1,3,3),(198,3,72,1,3.5,3.5),(199,6,72,2,2,4),(200,1,78,2,2.5,5),(201,2,78,3,1,3),(202,4,78,1,3,3),(203,5,79,1,1.6,1.6),(204,3,80,1,3.5,3.5),(205,4,80,1,3,3),(206,1,81,1,2.5,2.5),(207,7,82,1,6,6),(208,4,82,1,3,3),(209,3,82,1,3.5,3.5),(210,5,83,3,1.6,4.8),(211,7,83,9,6,54),(212,1,83,2,2.5,5),(213,1,84,1,2.5,2.5),(214,5,84,2,1.6,3.2),(215,6,78,2,2,4),(216,5,78,3,1.6,4.8),(217,3,78,1,3.5,3.5),(218,8,78,3,1.3,3.9),(219,1,85,1,2.5,2.5),(220,6,85,1,2,2),(222,8,86,4,1.3,5.2),(223,5,86,3,1.6,4.8),(224,4,86,5,3,15),(225,3,85,2,3.5,7),(226,1,77,1,2.5,2.5),(227,3,83,1,3.5,3.5),(228,4,83,1,3,3),(229,2,84,1,1,1),(230,3,84,1,3.5,3.5),(231,4,84,2,3,6),(232,5,85,1,1.6,1.6),(233,8,85,1,1.3,1.3),(234,1,87,1,2.5,2.5),(235,1,88,1,2.5,2.5),(236,1,89,1,2.5,2.5),(237,3,89,1,3.5,3.5),(238,1,90,1,2.5,2.5),(239,1,91,1,2.5,2.5),(240,3,86,1,3.5,3.5),(241,1,92,1,2.5,2.5),(242,1,93,4,2.5,10),(243,2,93,1,1,1),(244,8,84,1,1.3,1.3);
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
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','[\"ROLE_ADMIN\", \"ROLE_MEMEBER\"]','$argon2i$v=19$m=65536,t=4,p=1$RHVMMnlzcXBzQXI1WlQ1UA$xlpABsGdptuU9jU25fLHoKKARKfBuzlvVeEl6d7f9qk','2020-02-17 08:15:18','2019-11-04 00:00:00'),(2,'李跃能','[\"ROLE_MEMEBER\"]','$argon2i$v=19$m=65536,t=4,p=1$a0paQXU4YmVtQmw0VG5NVQ$QFi8cVtXBYrsmaWcKtHBOxylhEbUwS6tXJpSy6VojIk','2019-11-25 16:41:11','2019-11-22 12:57:40'),(3,'李小翠','{\"1\": \"ROLE_MEMEBER\"}','$argon2i$v=19$m=65536,t=4,p=1$LlJEVnU3aUYvRzk2OWVUNg$f4HLZWxMZaJSc5rueU3GKmSJum69CtJl31HvrOZCUqM','2019-11-29 16:52:49','2019-11-29 12:42:57'),(4,'张美仙','[\"ROLE_MEMEBER\"]','$argon2i$v=19$m=65536,t=4,p=1$dDZvTGhUQXAwc09SSlJ4Lg$SDc8KVl1mXf0906mQBwKXpzS19rRJV/3XFtRPKZWL54',NULL,'2019-11-29 16:08:14');
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

-- Dump completed on 2020-02-17 14:18:11
