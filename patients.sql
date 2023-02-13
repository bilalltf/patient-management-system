-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: patients
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `evaluation_traitement`
--

DROP TABLE IF EXISTS `evaluation_traitement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluation_traitement` (
  `id_evaluation_traitement` int NOT NULL AUTO_INCREMENT,
  `N_sejour` varchar(255) NOT NULL,
  `nom_trait` varchar(255) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `type_e` set('TDM','TEP','IRM','Scintigraphie os','Marqueur') DEFAULT NULL,
  `SETE` set('SD','RP','RC','PD','iRECIST','Oligoprogression') DEFAULT NULL,
  `type_iRECIST` set('iUPD','iCPD','iSD','iPR','iCR') DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `stop_obligoprogression` set('oui','non') DEFAULT NULL,
  `Nadir` set('oui','non') DEFAULT NULL,
  PRIMARY KEY (`id_evaluation_traitement`,`N_sejour`,`nom_trait`),
  KEY `nom_trait` (`nom_trait`),
  KEY `N_sejour` (`N_sejour`),
  CONSTRAINT `evaluation_traitement_ibfk_1` FOREIGN KEY (`nom_trait`) REFERENCES `traitement` (`nom_trait`) ON DELETE CASCADE,
  CONSTRAINT `evaluation_traitement_ibfk_2` FOREIGN KEY (`N_sejour`) REFERENCES `patient` (`N_sejour`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluation_traitement`
--

LOCK TABLES `evaluation_traitement` WRITE;
/*!40000 ALTER TABLE `evaluation_traitement` DISABLE KEYS */;
INSERT INTO `evaluation_traitement` VALUES (4,'1345332','Taxotere 2','2017-12-07','','TDM','PD','','2018-12-06','',NULL),(5,'1345332','Taxotere','2016-12-06','','TDM','iRECIST','iCPD','2020-06-08','',NULL);
/*!40000 ALTER TABLE `evaluation_traitement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patient` (
  `N_sejour` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `age` int DEFAULT NULL,
  `medecin_referent` varchar(255) DEFAULT NULL,
  `type_histolog` varchar(255) DEFAULT NULL,
  `date_diagnostic` date DEFAULT NULL,
  `biologie_moleculaire` varchar(255) DEFAULT NULL,
  `marqueur_ADN` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`N_sejour`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES ('1345332','Bilal','Mba','1994-04-26',23,'Dr. PLUVY','Adénocarcinome pulmonaire','2014-10-20','PDL1 1% ALK - ROS1 -','KRAS g12c'),('1345333','Arnaud','Dichand','1999-04-26',23,'Dr. PLUVY','Adénocarcinome pulmonaire','2015-11-24','PDL1 1% ALK - ROS1 -','KRAS g12c');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prelevement_biopsie_fmi_adnc`
--

DROP TABLE IF EXISTS `prelevement_biopsie_fmi_adnc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prelevement_biopsie_fmi_adnc` (
  `id_prelevement_b_f_a` int NOT NULL AUTO_INCREMENT,
  `N_sejour` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `resultat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_prelevement_b_f_a`,`N_sejour`),
  KEY `N_sejour` (`N_sejour`),
  CONSTRAINT `prelevement_biopsie_fmi_adnc_ibfk_1` FOREIGN KEY (`N_sejour`) REFERENCES `patient` (`N_sejour`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prelevement_biopsie_fmi_adnc`
--

LOCK TABLES `prelevement_biopsie_fmi_adnc` WRITE;
/*!40000 ALTER TABLE `prelevement_biopsie_fmi_adnc` DISABLE KEYS */;
INSERT INTO `prelevement_biopsie_fmi_adnc` VALUES (2,'1345332','2015-05-20','','KRAS c12c');
/*!40000 ALTER TABLE `prelevement_biopsie_fmi_adnc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reduction_dose_traitement`
--

DROP TABLE IF EXISTS `reduction_dose_traitement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reduction_dose_traitement` (
  `id_red_dose_traitement` int NOT NULL AUTO_INCREMENT,
  `N_sejour` varchar(255) NOT NULL,
  `nom_trait` varchar(255) NOT NULL,
  `reduction` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id_red_dose_traitement`,`N_sejour`,`nom_trait`),
  KEY `nom_trait` (`nom_trait`),
  KEY `N_sejour` (`N_sejour`),
  CONSTRAINT `reduction_dose_traitement_ibfk_1` FOREIGN KEY (`nom_trait`) REFERENCES `traitement` (`nom_trait`) ON DELETE CASCADE,
  CONSTRAINT `reduction_dose_traitement_ibfk_2` FOREIGN KEY (`N_sejour`) REFERENCES `patient` (`N_sejour`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reduction_dose_traitement`
--

LOCK TABLES `reduction_dose_traitement` WRITE;
/*!40000 ALTER TABLE `reduction_dose_traitement` DISABLE KEYS */;
INSERT INTO `reduction_dose_traitement` VALUES (1,'1345332','Taxotere',25,'2015-05-25');
/*!40000 ALTER TABLE `reduction_dose_traitement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `toxicite_traitement`
--

DROP TABLE IF EXISTS `toxicite_traitement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `toxicite_traitement` (
  `id_toxicite_traitement` int NOT NULL AUTO_INCREMENT,
  `N_sejour` varchar(255) NOT NULL,
  `nom_trait` varchar(255) NOT NULL,
  `type_t` varchar(255) DEFAULT NULL,
  `grade` set('0','1','2','3','4','5') DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `fin` set('oui','non') DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`id_toxicite_traitement`,`N_sejour`,`nom_trait`),
  KEY `nom_trait` (`nom_trait`),
  KEY `N_sejour` (`N_sejour`),
  CONSTRAINT `toxicite_traitement_ibfk_1` FOREIGN KEY (`nom_trait`) REFERENCES `traitement` (`nom_trait`) ON DELETE CASCADE,
  CONSTRAINT `toxicite_traitement_ibfk_2` FOREIGN KEY (`N_sejour`) REFERENCES `patient` (`N_sejour`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toxicite_traitement`
--

LOCK TABLES `toxicite_traitement` WRITE;
/*!40000 ALTER TABLE `toxicite_traitement` DISABLE KEYS */;
INSERT INTO `toxicite_traitement` VALUES (1,'1345332','Taxotere','Anémie','4','2015-05-25','oui','2015-06-02'),(2,'1345332','Taxotere','Neuropathie','2','2015-06-02','oui','2015-08-15');
/*!40000 ALTER TABLE `toxicite_traitement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `traitement`
--

DROP TABLE IF EXISTS `traitement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `traitement` (
  `nom_trait` varchar(255) NOT NULL,
  `N_sejour` varchar(255) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`nom_trait`,`N_sejour`),
  KEY `N_sejour` (`N_sejour`),
  CONSTRAINT `traitement_ibfk_1` FOREIGN KEY (`N_sejour`) REFERENCES `patient` (`N_sejour`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `traitement`
--

LOCK TABLES `traitement` WRITE;
/*!40000 ALTER TABLE `traitement` DISABLE KEYS */;
INSERT INTO `traitement` VALUES ('Carboplatine Pemetrexed Pembro','1345332','2015-11-24','2016-03-13'),('Carboplatine Pemetrexed Pembro 22','1345333','2015-11-12','2016-03-13'),('Navelbine','1345332','2015-11-20','2015-11-27'),('Navelbine','1345333','2016-11-20','2015-11-29'),('Taxotere','1345332','2015-03-13','2020-06-08'),('Taxotere','1345333','2016-03-13','2015-06-20'),('Taxotere 2','1345332','2016-12-06',NULL);
/*!40000 ALTER TABLE `traitement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `traitement_local`
--

DROP TABLE IF EXISTS `traitement_local`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `traitement_local` (
  `nom_trait_local` varchar(255) NOT NULL,
  `N_sejour` varchar(255) NOT NULL,
  `type_trait_loc` varchar(255) DEFAULT NULL,
  `type_radiotherapie` varchar(255) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nom_trait_local`,`N_sejour`),
  KEY `N_sejour` (`N_sejour`),
  CONSTRAINT `traitement_local_ibfk_1` FOREIGN KEY (`N_sejour`) REFERENCES `patient` (`N_sejour`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `traitement_local`
--

LOCK TABLES `traitement_local` WRITE;
/*!40000 ALTER TABLE `traitement_local` DISABLE KEYS */;
INSERT INTO `traitement_local` VALUES ('tl1','1345332','Radiothérapie','Stéréotaxique','2017-12-05','2018-12-06','marseille');
/*!40000 ALTER TABLE `traitement_local` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-13  2:42:21
