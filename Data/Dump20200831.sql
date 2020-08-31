CREATE DATABASE  IF NOT EXISTS `journal` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `journal`;
-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: journal
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.10-MariaDB

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (2,'Ultra-trail : pas d\'UTMB 2020','D\'habitude, 10 000 coureurs participent à l\'incontournable Ultra-trail du Mont-Blanc, annulé cette année. De nombreux traileurs, dont le tenant du titre, l\'Espagnol Pau Capell, se sont quand même aventurés sur les sentiers chamoniards.','utmb-5f4cf08349cea.jpeg'),(3,'Semi-marathon ou 10 km- Bonson','Chaque 11 novembre, les Lieues Foréziennes vous proposent 2 épreuves de course à pied à Bonson dans la Loire:\r - Les 3 Lieues : 10,6 Km\r - Les 5 Lieues : 21,1 Km','lieue-5f4cf56c21d32.jpeg'),(4,'STU 2020','C’est une façon de découvrir la ville autrement. Courir en passant par des endroits insolites et mythiques de la ville. Nous traversons différents quartiers où les coureurs sont encouragés par des animations locales','sainte-5f4cf64cf3f27.jpeg');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'journaliste1@gmail.com','[\"ROLE_ADMIN\"]','$argon2id$v=19$m=65536,t=4,p=1$cU9oVXgwNG13VEMwT013OA$7Z2c7KdQQ2vcwhKV8HesmLaYlT+Y5DgVbORrIFGbMhQ'),(4,'journaliste2@gmail.com','[\"ROLE_ADMIN\"]','$argon2id$v=19$m=65536,t=4,p=1$R1dvbWh6bi9UWjY1UW5wLw$7KT2AqLxti+EjbuWCFZwWPOnj0ccHl1BchAp2jRCwKs'),(5,'journaliste_test@gmail.com','[\"ROLE_ADMIN\"]','$argon2id$v=19$m=65536,t=4,p=1$alNXYzFtSG1Kd3RTYkNhag$nb9scPtSKsdFsnfjJjV1xKfXvdyfVIKPHFbvrO52j/0');
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

-- Dump completed on 2020-08-31 15:48:47
