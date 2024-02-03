-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: couvoiturage
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `commune`
--

DROP TABLE IF EXISTS `commune`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commune` (
  `id_commune` int(10) NOT NULL AUTO_INCREMENT,
  `Nom_Commune` varchar(20) NOT NULL,
  `Coordonne_X` float NOT NULL,
  `Coordonne_Y` float NOT NULL,
  `Wilaya` varchar(20) NOT NULL,
  PRIMARY KEY (`id_commune`),
  KEY `C1` (`Wilaya`),
  CONSTRAINT `C1` FOREIGN KEY (`Wilaya`) REFERENCES `wilaya` (`Nom_wilaya`)
) ENGINE=InnoDB AUTO_INCREMENT=1624 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commune`
--

LOCK TABLES `commune` WRITE;
/*!40000 ALTER TABLE `commune` DISABLE KEYS */;
INSERT INTO `commune` VALUES (1601,'Alger centre',3.32,36.36,'Alger'),(1602,'Said hamdin',3.03,36.452,'Alger'),(1611,'Bouzareah',3.01,36.47,'Alger'),(1621,'Bab ezzouar',3.11,36.43,'Alger'),(1622,'Ben aknoun',3.003,36.455,'Alger'),(1623,'Dalybrahim',2.59,36.45,'Alger');
/*!40000 ALTER TABLE `commune` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `demand_reservation`
--

DROP TABLE IF EXISTS `demand_reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `demand_reservation` (
  `Passager` bigint(12) NOT NULL,
  `Trajet` int(20) NOT NULL,
  PRIMARY KEY (`Passager`,`Trajet`),
  KEY `c10` (`Trajet`),
  CONSTRAINT `C9` FOREIGN KEY (`Passager`) REFERENCES `utilisateur` (`Matrecule`),
  CONSTRAINT `c10` FOREIGN KEY (`Trajet`) REFERENCES `trajet` (`id_trajet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `demand_reservation`
--

LOCK TABLES `demand_reservation` WRITE;
/*!40000 ALTER TABLE `demand_reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `demand_reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `Passagere` bigint(12) NOT NULL,
  `Trajet` int(20) NOT NULL,
  PRIMARY KEY (`Passagere`,`Trajet`),
  KEY `C7` (`Trajet`),
  CONSTRAINT `C6` FOREIGN KEY (`Passagere`) REFERENCES `utilisateur` (`Matrecule`),
  CONSTRAINT `C7` FOREIGN KEY (`Trajet`) REFERENCES `trajet` (`id_trajet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (202031063511,2),(2020231063566,3);
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trajet`
--

DROP TABLE IF EXISTS `trajet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trajet` (
  `id_trajet` int(20) NOT NULL AUTO_INCREMENT,
  `Chauffeur` bigint(12) NOT NULL,
  `Lieu_depart` int(10) NOT NULL,
  `Lieu_arrive` int(10) NOT NULL,
  `Date_depart` date NOT NULL,
  `Heur_depart` time NOT NULL,
  `NbR_place_max` int(3) NOT NULL,
  PRIMARY KEY (`id_trajet`),
  KEY `C3` (`Lieu_depart`),
  KEY `C4` (`Lieu_arrive`),
  KEY `C5` (`Chauffeur`),
  CONSTRAINT `C3` FOREIGN KEY (`Lieu_depart`) REFERENCES `commune` (`id_commune`),
  CONSTRAINT `C4` FOREIGN KEY (`Lieu_arrive`) REFERENCES `commune` (`id_commune`),
  CONSTRAINT `C5` FOREIGN KEY (`Chauffeur`) REFERENCES `utilisateur` (`Matrecule`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trajet`
--

LOCK TABLES `trajet` WRITE;
/*!40000 ALTER TABLE `trajet` DISABLE KEYS */;
INSERT INTO `trajet` VALUES (1,202031062222,1601,1623,'2024-01-09','06:45:00',4),(2,202031063533,1611,1623,'2024-01-08','13:00:00',4),(3,202031063533,1621,1611,'2024-01-08','18:00:00',4);
/*!40000 ALTER TABLE `trajet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateur` (
  `Matrecule` bigint(12) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Telephone` int(10) NOT NULL,
  `Role` varchar(20) NOT NULL,
  PRIMARY KEY (`Matrecule`),
  UNIQUE KEY `email` (`Email`),
  UNIQUE KEY `tlf` (`Telephone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (191931067787,'Mokrani','adem','mokrani@gmail.com','mokrani',556743219,'client'),(202031062222,'zemmouri','amin','amin@gmail.com','amin',2147483647,'chauffeur'),(202031063511,'chouri','rania','rania@gamil.com','rania',655123221,'client'),(202031063533,'younes','amalou','younes@gmail.com','111',765432109,'chauffeur'),(2020231063566,'zouaoui','douaa','douaa0gamil.com','123',776554321,'client');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wilaya`
--

DROP TABLE IF EXISTS `wilaya`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wilaya` (
  `Nom_wilaya` varchar(20) NOT NULL,
  PRIMARY KEY (`Nom_wilaya`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wilaya`
--

LOCK TABLES `wilaya` WRITE;
/*!40000 ALTER TABLE `wilaya` DISABLE KEYS */;
INSERT INTO `wilaya` VALUES ('Alger'),('Annaba'),('Blida'),('Oran');
/*!40000 ALTER TABLE `wilaya` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-27 15:41:17
