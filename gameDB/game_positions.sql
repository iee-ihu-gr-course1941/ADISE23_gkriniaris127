-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: game
-- ------------------------------------------------------
-- Server version	5.5.5-10.11.4-MariaDB-1~deb12u1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `positions` (
  `position` tinyint(4) NOT NULL,
  `yellowX` tinyint(4) NOT NULL,
  `yellowY` tinyint(4) NOT NULL,
  `redX` tinyint(4) NOT NULL,
  `redY` tinyint(4) NOT NULL,
  `blueX` tinyint(4) NOT NULL,
  `blueY` tinyint(4) NOT NULL,
  `greenX` tinyint(4) NOT NULL,
  `greenY` tinyint(4) NOT NULL,
  PRIMARY KEY (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (1,7,2,9,14,2,9,14,7),(2,7,3,9,13,3,9,13,7),(3,7,4,9,12,4,9,12,7),(4,7,5,9,11,5,9,11,7),(5,7,6,9,10,6,9,10,7),(6,6,7,10,9,7,10,9,6),(7,5,7,11,9,7,11,9,5),(8,4,7,12,9,7,12,9,4),(9,3,7,13,9,7,13,9,3),(10,2,7,14,9,7,14,9,2),(11,1,7,15,9,7,15,9,1),(12,1,8,15,8,8,15,8,1),(13,1,9,15,7,9,15,7,1),(14,2,9,14,7,9,14,7,2),(15,3,9,13,7,9,13,7,3),(16,4,9,12,7,9,12,7,4),(17,5,9,11,7,9,11,7,5),(18,6,9,10,7,9,10,7,6),(19,7,10,9,6,10,9,6,7),(20,7,11,9,5,11,9,5,7),(21,7,12,9,4,12,9,4,7),(22,7,13,9,3,13,9,3,7),(23,7,14,9,2,14,9,2,7),(24,7,15,9,1,15,9,1,7),(25,8,15,8,1,15,8,1,8),(26,9,15,7,1,15,7,1,9),(27,9,14,7,2,14,7,2,9),(28,9,13,7,3,13,7,3,9),(29,9,12,7,4,12,7,4,9),(30,9,11,7,5,11,7,5,9),(31,9,10,7,6,10,7,6,9),(32,10,9,6,7,9,6,7,10),(33,11,9,5,7,9,5,7,11),(34,12,9,4,7,9,4,7,12),(35,13,9,3,7,9,3,7,13),(36,14,9,2,7,9,2,7,14),(37,15,9,1,7,9,1,7,15),(38,15,8,1,8,8,1,8,15),(39,15,7,1,9,7,1,9,15),(40,14,7,2,9,7,2,9,14),(41,13,7,3,9,7,3,9,13),(42,12,7,4,9,7,4,9,12),(43,11,7,5,9,7,5,9,11),(44,10,7,6,9,7,6,9,10),(45,9,6,7,10,6,7,10,9),(46,9,5,7,11,5,7,11,9),(47,9,4,7,12,4,7,12,9),(48,9,3,7,13,3,7,13,9),(49,9,2,7,14,2,7,14,9),(50,9,1,7,15,1,7,15,9),(51,8,1,8,15,1,8,15,8),(52,8,2,8,14,2,8,14,8),(53,8,3,8,13,3,8,13,8),(54,8,4,8,12,4,8,12,8),(55,8,5,8,11,5,8,11,8),(56,8,6,8,10,6,8,10,8),(57,8,7,8,9,7,8,9,8),(58,4,3,12,13,3,12,13,4),(59,3,3,13,13,3,13,13,3),(60,3,4,13,12,4,13,12,3),(61,4,4,12,12,4,12,12,4);
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-30  4:26:31
