-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: lyn
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.18.04.1

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (27,5,10.5,3,'2019-11-14 14:18:57','2019-11-14 17:27:56'),(28,4,11.5,4,'2019-11-14 16:42:53','2019-11-14 17:34:28'),(29,6,20.2,4,'2019-11-14 17:36:31','2019-11-14 18:09:13'),(30,7,21.7,5,'2019-11-15 08:22:51','2019-11-15 08:35:09'),(31,7,18,3,'2019-11-15 08:31:31','2019-11-15 08:32:25'),(32,2,6,2,'2019-11-15 10:25:18','2019-11-15 10:25:25'),(33,1,2.5,1,'2019-11-15 10:27:39','2019-11-15 10:27:39'),(34,2,3.5,2,'2019-11-15 10:28:19','2019-11-15 10:29:52'),(35,2,4.1,2,'2019-11-15 11:21:12','2019-11-15 11:21:16'),(36,8,24.3,4,'2019-11-15 12:34:05','2019-11-15 12:35:15'),(37,2,3.5,2,'2019-11-15 13:52:18','2019-11-15 13:52:22'),(38,19,55.4,6,'2019-11-15 15:18:56','2019-11-15 15:42:27'),(39,5,16,4,'2019-11-15 15:41:33','2019-11-15 16:49:49'),(40,2,5.1,2,'2019-11-15 17:23:50','2019-11-15 17:23:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item`
--

LOCK TABLES `order_item` WRITE;
/*!40000 ALTER TABLE `order_item` DISABLE KEYS */;
INSERT INTO `order_item` VALUES (20,1,27,2,2.5,5),(21,2,27,2,1,2),(22,3,27,1,3.5,3.5),(23,1,28,1,2.5,2.5),(24,2,28,1,1,1),(25,6,28,1,2,2),(26,7,28,1,6,6),(27,5,29,2,1.6,3.2),(28,6,29,1,2,2),(29,7,29,2,6,12),(30,4,29,1,3,3),(31,1,30,1,2.5,2.5),(32,1,31,4,2.5,10),(33,2,31,1,1,1),(34,3,31,2,3.5,7),(35,3,30,2,3.5,7),(36,4,30,1,3,3),(37,5,30,2,1.6,3.2),(38,7,30,1,6,6),(39,1,32,1,2.5,2.5),(40,3,32,1,3.5,3.5),(41,1,33,1,2.5,2.5),(42,1,34,1,2.5,2.5),(43,2,34,1,1,1),(44,1,35,1,2.5,2.5),(45,5,35,1,1.6,1.6),(46,5,36,3,1.6,4.8),(47,7,36,2,6,12),(48,3,36,1,3.5,3.5),(49,6,36,2,2,4),(50,1,37,1,2.5,2.5),(51,2,37,1,1,1),(52,5,38,2,1.6,3.2),(53,2,38,1,1,1),(54,7,38,5,6,30),(55,6,38,5,2,10),(56,8,38,4,1.3,5.2),(57,4,38,2,3,6),(58,4,39,1,3,3),(59,7,39,1,6,6),(60,6,39,1,2,2),(61,1,39,2,2.5,5),(62,3,40,1,3.5,3.5),(63,5,40,1,1.6,1.6);
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
INSERT INTO `product` VALUES (1,'ASUS R541UA',2.5,'2019-11-12 16:34:26','2019-11-15 10:31:36'),(2,'Apple Mac',1,'2019-11-12 16:35:43','2019-11-15 10:31:42'),(3,'Dell Inspiro',3.5,'2019-11-12 16:35:58','2019-11-15 10:31:48'),(4,'模具a',3,'2019-11-14 17:31:55','2019-11-14 17:31:55'),(5,'模具d',1.6,'2019-11-14 17:32:08','2019-11-14 17:32:08'),(6,'传真3',2,'2019-11-14 17:32:17','2019-11-14 17:32:17'),(7,'传真4',6,'2019-11-14 17:32:28','2019-11-14 17:32:28'),(8,'椅子',1.3,'2019-11-15 15:20:34','2019-11-15 15:20:34');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-15 17:34:17
