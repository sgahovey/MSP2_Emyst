-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: emyst_db
-- ------------------------------------------------------
-- Server version	8.0.43

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20251203105722','2025-12-03 10:57:44',963),('DoctrineMigrations\\Version20251204094120','2025-12-04 09:41:45',532),('DoctrineMigrations\\Version20251205070451','2025-12-05 10:42:22',135),('DoctrineMigrations\\Version20251205111357','2025-12-05 11:14:10',115),('DoctrineMigrations\\Version20251209040813','2025-12-09 04:09:32',109),('DoctrineMigrations\\Version20251209054044','2025-12-09 05:43:21',330);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercice`
--

DROP TABLE IF EXISTS `exercice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `exercice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `repetitions` int NOT NULL,
  `charge` int DEFAULT NULL,
  `duree` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercice`
--

LOCK TABLES `exercice` WRITE;
/*!40000 ALTER TABLE `exercice` DISABLE KEYS */;
INSERT INTO `exercice` VALUES (1,'image/pompe.jpg','Pompe',10,0,'00:00:00'),(2,'image/squat.jpg','Squat',20,10,'00:00:00'),(3,'image/fente.jpg','Fente',15,0,'00:00:00'),(4,'image/traction.jpg','Traction',10,0,'00:00:00'),(5,NULL,'Développé couché',10,50,'00:00:00'),(6,NULL,'Gainage',0,0,'00:01:00');
/*!40000 ALTER TABLE `exercice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objectif`
--

DROP TABLE IF EXISTS `objectif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `objectif` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valeur_cible` int NOT NULL,
  `date_limite` datetime NOT NULL,
  `type_objectif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E2F86851A76ED395` (`user_id`),
  CONSTRAINT `FK_E2F86851A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objectif`
--

LOCK TABLES `objectif` WRITE;
/*!40000 ALTER TABLE `objectif` DISABLE KEYS */;
INSERT INTO `objectif` VALUES (1,75,'2025-12-31 08:29:00','Sèche musculaire',1),(2,90,'2025-12-31 08:42:00','Prise de masse',2);
/*!40000 ALTER TABLE `objectif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seance`
--

DROP TABLE IF EXISTS `seance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `seance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_entrainement` datetime NOT NULL,
  `type_seance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree` time NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DF7DFD0EA76ED395` (`user_id`),
  CONSTRAINT `FK_DF7DFD0EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seance`
--

LOCK TABLES `seance` WRITE;
/*!40000 ALTER TABLE `seance` DISABLE KEYS */;
INSERT INTO `seance` VALUES (1,'2025-01-10 18:00:00','Full body','01:15:00',1),(2,'2025-01-12 19:00:00','Cardio','00:45:00',1),(3,'2025-01-15 17:00:00','Haut du corps','01:05:00',1),(4,'2025-01-17 18:30:00','Bas du corps','00:55:00',1),(5,'2025-01-20 20:00:00','HIIT','00:30:00',1),(6,'2025-01-22 18:45:00','Renforcement','01:10:00',1),(7,'2025-01-25 16:00:00','Abdos','00:25:00',1),(8,'2025-01-27 17:30:00','Pliométrie','00:40:00',1),(9,'2025-12-08 10:00:00','Full body','00:45:00',1),(10,'2025-12-09 10:00:00','Full body','00:50:00',1),(11,'2025-12-07 10:00:00','Cardio','00:30:00',1);
/*!40000 ALTER TABLE `seance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seance_exercice`
--

DROP TABLE IF EXISTS `seance_exercice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `seance_exercice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ordre` int NOT NULL,
  `seances_id` int NOT NULL,
  `exercices_id` int NOT NULL,
  `repetitions` int NOT NULL,
  `charge` int NOT NULL,
  `duree` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8A3473510F09302` (`seances_id`),
  KEY `IDX_8A34735192C7251` (`exercices_id`),
  CONSTRAINT `FK_8A3473510F09302` FOREIGN KEY (`seances_id`) REFERENCES `seance` (`id`),
  CONSTRAINT `FK_8A34735192C7251` FOREIGN KEY (`exercices_id`) REFERENCES `exercice` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seance_exercice`
--

LOCK TABLES `seance_exercice` WRITE;
/*!40000 ALTER TABLE `seance_exercice` DISABLE KEYS */;
INSERT INTO `seance_exercice` VALUES (1,1,1,1,15,0,'00:02:00'),(2,2,1,2,20,10,'00:02:30'),(3,3,1,4,10,0,'00:01:30'),(4,1,2,3,30,0,'00:05:00'),(5,2,2,2,25,5,'00:03:00'),(6,1,3,1,20,0,'00:02:30'),(7,2,3,4,12,0,'00:02:00'),(8,1,4,2,20,15,'00:03:00'),(9,2,4,3,20,0,'00:03:00'),(10,1,5,1,10,0,'00:01:00'),(11,2,5,2,15,5,'00:01:00'),(12,3,5,3,10,0,'00:01:00'),(13,1,6,1,12,0,'00:02:00'),(14,2,6,2,18,12,'00:02:30'),(15,1,7,1,25,0,'00:02:00'),(16,1,8,3,20,0,'00:02:30'),(17,2,8,2,15,10,'00:02:00'),(18,1,9,5,10,50,'00:00:00'),(19,2,9,2,8,70,'00:00:00'),(20,3,9,6,0,0,'00:01:00'),(21,1,10,5,12,55,'00:00:00'),(22,2,10,2,8,75,'00:00:00'),(23,3,10,6,0,0,'00:01:10'),(24,1,11,6,0,0,'00:02:00');
/*!40000 ALTER TABLE `seance_exercice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taille` double DEFAULT NULL,
  `poids` double DEFAULT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'test@gmail.com','[]','$2y$13$jiPl5k.B4WQXXy5h93ghxep0CCd0gsgIS1b4Dfiz03FldEjSpFkSC',1.78,90,'2025-12-05 10:42:22','test'),(2,'test2@gmail.com','[]','$2y$13$jiPl5k.B4WQXXy5h93ghxep0CCd0gsgIS1b4Dfiz03FldEjSpFkSC',1.8,80,'2025-12-08 08:33:00','test2');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'emyst_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-11 10:24:40
