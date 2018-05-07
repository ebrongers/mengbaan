-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (armv7l)
--
-- Host: localhost    Database: baaskarrendb
-- ------------------------------------------------------
-- Server version	5.5.31-0+wheezy1

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
-- Table structure for table `Kleuren`
--

DROP TABLE IF EXISTS `Kleuren`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Kleuren` (
  `KleurID` int(11) NOT NULL AUTO_INCREMENT,
  `kleur1` varchar(20) DEFAULT NULL,
  `kleur2` varchar(20) DEFAULT NULL,
  `KleurNaam` varchar(30) NOT NULL,
  PRIMARY KEY (`KleurID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Kleuren`
--

LOCK TABLES `Kleuren` WRITE;
/*!40000 ALTER TABLE `Kleuren` DISABLE KEYS */;
INSERT INTO `Kleuren` VALUES (1,'340444','DCCBE1','Beaconsfield'),(2,'4317BD',NULL,'Blauw'),(3,'4317BD','8003DF','Cassis'),(4,'8E7506',NULL,'Delfsblauw'),(5,'7F5F01',NULL,'Driekleur'),(6,NULL,NULL,'Geel'),(7,NULL,NULL,'Zuiver geel'),(8,NULL,NULL,'Gemengd'),(9,NULL,NULL,'Lemon'),(10,NULL,NULL,'Marina'),(11,NULL,NULL,'Oranje'),(12,NULL,NULL,'Oranje/geel'),(13,NULL,NULL,'Oranje'),(14,NULL,NULL,'Paars/geel'),(15,NULL,NULL,'Paars/wit'),(16,NULL,NULL,'Perquinetta'),(17,NULL,NULL,'Rood'),(18,NULL,NULL,'Rood/geel'),(19,NULL,NULL,'Rood/oranje'),(20,NULL,NULL,'Roze'),(21,NULL,NULL,'Wit'),(22,NULL,NULL,'Zuiver wit'),(23,NULL,NULL,'Roze/Wit'),(24,NULL,NULL,'Roze/Geel'),(25,NULL,NULL,'Copperfield'),(26,NULL,NULL,'Wit+Oog'),(27,NULL,NULL,'Deep Marina'),(28,NULL,NULL,'Geel+Oog'),(29,NULL,NULL,'Paars'),(30,NULL,NULL,'Leeg'),(31,NULL,NULL,'Kleur 1'),(32,NULL,NULL,'Kleur 2'),(33,NULL,NULL,'Kleur 3'),(34,NULL,NULL,'Kleur 4');
/*!40000 ALTER TABLE `Kleuren` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Producten`
--

DROP TABLE IF EXISTS `Producten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Producten` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductNaam` char(30) DEFAULT NULL,
  PRIMARY KEY (`ProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Producten`
--

LOCK TABLES `Producten` WRITE;
/*!40000 ALTER TABLE `Producten` DISABLE KEYS */;
INSERT INTO `Producten` VALUES (1,'Ageratum'),(2,'Arabis'),(3,'Begonia'),(4,'Bellis'),(5,'Cornuta'),(6,'Impatiens'),(7,'Lavandula'),(8,'Lobelia'),(9,'Mirablis'),(10,'Nemesia'),(11,'Petunia'),(12,'Salvia'),(13,'Saxifraga'),(14,'Tagetes'),(15,'Verbena'),(16,'Viola'),(17,'Primula'),(18,'Leeg');
/*!40000 ALTER TABLE `Producten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Recepten`
--

DROP TABLE IF EXISTS `Recepten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Recepten` (
  `ReceptID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `ReceptNaam` char(30) DEFAULT NULL,
  `ProductLaag1` tinyint(4) DEFAULT NULL,
  `ProductLaag2` tinyint(4) DEFAULT NULL,
  `ProductLaag3` tinyint(4) DEFAULT NULL,
  `ProductLaag4` tinyint(4) DEFAULT NULL,
  `ProductLaag5` tinyint(4) DEFAULT NULL,
  `ProductLaag6` tinyint(4) DEFAULT NULL,
  `ProductLaag7` tinyint(4) DEFAULT NULL,
  `ProductLaag8` tinyint(4) DEFAULT NULL,
  `ProductLaag9` tinyint(4) DEFAULT NULL,
  `ProductLaag10` tinyint(4) DEFAULT NULL,
  `ProductLaag11` tinyint(4) DEFAULT NULL,
  `KleurLaag1` tinyint(4) DEFAULT NULL,
  `KleurLaag2` tinyint(4) DEFAULT NULL,
  `KleurLaag3` tinyint(4) DEFAULT NULL,
  `KleurLaag4` tinyint(4) DEFAULT NULL,
  `KleurLaag5` tinyint(4) DEFAULT NULL,
  `KleurLaag6` tinyint(4) DEFAULT NULL,
  `KleurLaag7` tinyint(4) DEFAULT NULL,
  `KleurLaag8` tinyint(4) DEFAULT NULL,
  `KleurLaag9` tinyint(4) DEFAULT NULL,
  `KleurLaag10` tinyint(4) DEFAULT NULL,
  `KleurLaag11` tinyint(4) DEFAULT NULL,
  `label` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ReceptID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Recepten`
--

LOCK TABLES `Recepten` WRITE;
/*!40000 ALTER TABLE `Recepten` DISABLE KEYS */;
INSERT INTO `Recepten` VALUES (4,'ec mix',5,16,16,16,16,18,18,18,18,18,18,30,30,30,30,30,30,30,30,30,30,30,NULL),(5,'UNIVEG TOOM',16,16,16,16,16,16,16,5,5,5,5,1,1,1,1,1,1,1,1,1,1,1,NULL),(7,'ec 24p',5,16,16,16,16,18,18,18,18,18,18,30,30,30,30,30,30,30,30,30,30,30,NULL),(8,'interm\rkt f1',16,16,16,16,16,16,16,16,16,16,16,15,3,28,8,21,17,28,29,10,3,30,NULL),(9,'AH KARREN',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,NULL);
/*!40000 ALTER TABLE `Recepten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opdrachten`
--

DROP TABLE IF EXISTS `opdrachten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opdrachten` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `klantorder` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `label` int(11) DEFAULT NULL,
  `verwerkt` int(11) DEFAULT NULL,
  `orderaantal` int(11) DEFAULT NULL,
  `gemiddelde` int(11) DEFAULT NULL,
  `runonce` int(11) DEFAULT NULL,
  `prevkarren` int(11) DEFAULT NULL,
  `OpdrComm` char(30) DEFAULT NULL,
  `ProductLaag1` tinyint(4) DEFAULT NULL,
  `ProductLaag2` tinyint(4) DEFAULT NULL,
  `ProductLaag3` tinyint(4) DEFAULT NULL,
  `ProductLaag4` tinyint(4) DEFAULT NULL,
  `ProductLaag5` tinyint(4) DEFAULT NULL,
  `ProductLaag6` tinyint(4) DEFAULT NULL,
  `ProductLaag7` tinyint(4) DEFAULT NULL,
  `ProductLaag8` tinyint(4) DEFAULT NULL,
  `ProductLaag9` tinyint(4) DEFAULT NULL,
  `ProductLaag10` tinyint(4) DEFAULT NULL,
  `ProductLaag11` tinyint(4) DEFAULT NULL,
  `KleurLaag1` tinyint(4) DEFAULT NULL,
  `KleurLaag2` tinyint(4) DEFAULT NULL,
  `KleurLaag3` tinyint(4) DEFAULT NULL,
  `KleurLaag4` tinyint(4) DEFAULT NULL,
  `KleurLaag5` tinyint(4) DEFAULT NULL,
  `KleurLaag6` tinyint(4) DEFAULT NULL,
  `KleurLaag7` tinyint(4) DEFAULT NULL,
  `KleurLaag8` tinyint(4) DEFAULT NULL,
  `KleurLaag9` tinyint(4) DEFAULT NULL,
  `KleurLaag10` tinyint(4) DEFAULT NULL,
  `KleurLaag11` tinyint(4) DEFAULT NULL,
  `VullenLaag1` tinyint(4) DEFAULT NULL,
  `VullenLaag2` tinyint(4) DEFAULT NULL,
  `VullenLaag3` tinyint(4) DEFAULT NULL,
  `VullenLaag4` tinyint(4) DEFAULT NULL,
  `VullenLaag5` tinyint(4) DEFAULT NULL,
  `VullenLaag6` tinyint(4) DEFAULT NULL,
  `VullenLaag7` tinyint(4) DEFAULT NULL,
  `VullenLaag8` tinyint(4) DEFAULT NULL,
  `VullenLaag9` tinyint(4) DEFAULT NULL,
  `VullenLaag10` tinyint(4) DEFAULT NULL,
  `VullenLaag11` tinyint(4) DEFAULT NULL,
  `volgorder` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opdrachten`
--

LOCK TABLES `opdrachten` WRITE;
/*!40000 ALTER TABLE `opdrachten` DISABLE KEYS */;
/*!40000 ALTER TABLE `opdrachten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'baaskarrendb'
--

--
-- Dumping routines for database 'baaskarrendb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-08  0:00:18
