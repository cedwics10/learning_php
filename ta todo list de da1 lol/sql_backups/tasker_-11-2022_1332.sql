-- MariaDB dump 10.19  Distrib 10.4.25-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: tasker
-- ------------------------------------------------------
-- Server version	10.4.25-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (43,1,'twenty campuss');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membres`
--

DROP TABLE IF EXISTS `membres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `role` char(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membres`
--

LOCK TABLES `membres` WRITE;
/*!40000 ALTER TABLE `membres` DISABLE KEYS */;
INSERT INTO `membres` VALUES (1,'jeanpierre','$2y$10$1QRCAiY3d45X9pHWFG/vi.f5D6GsL647aJlyPIOQ0BfHnILqkreni','avatars/jeanpierre.jpg','a'),(2,'yoooooooooo','$2y$10$5blvI3pk/KuNL3rYvWWFOO/.duDoaoBNRZRKs/JIeHE9YdHTBRWd6','avatars/./yoooooooooo','m'),(3,'jeanpierrejeanpierre','$2y$10$E2jgc1xDLZPMW4C.ojiv0u4vjN6OeNPu/IgNzd55fFUj6LxVDWd6G','avatars/./jeanpierrejeanpierre','m'),(4,'jeanbanane','$2y$10$EnORMqauvPF3SCmCgyCBh.aeJbXl3kRX0ecdddS0RMTgOdxlme.gC','avatars/./jeanbanane','m'),(5,'paulpierre','$2y$10$n2nvHu5BpY4sjLZYEONpvO2buwL1xkLMLFja2A7erkHT4OLWWFKXS','avatars/./paulpierre','m'),(6,'cocococo','$2y$10$17du5ExynVCjo42UVwllRu7zYZKNx1.gqyRWlMwwc1OYQQkQXWfoG','','m');
/*!40000 ALTER TABLE `membres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taches`
--

DROP TABLE IF EXISTS `taches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `nom_tache` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rappel` timestamp NULL DEFAULT NULL,
  `importance` tinyint(4) NOT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `taches` (`id_categorie`),
  CONSTRAINT `taches` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taches`
--

LOCK TABLES `taches` WRITE;
/*!40000 ALTER TABLE `taches` DISABLE KEYS */;
INSERT INTO `taches` VALUES (40,1,43,'Manger des pâtes','efaefazea','2022-11-08 06:15:38','2022-11-03 23:00:00',3,1),(41,1,43,'La petite chambre tranquille','','2022-11-08 06:15:33','2022-11-05 23:00:00',1,0);
/*!40000 ALTER TABLE `taches` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-10 13:32:59
