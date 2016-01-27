-- MySQL dump 10.13  Distrib 5.6.26, for Win64 (x86_64)
--
-- Host: localhost    Database: compfundationdb
-- ------------------------------------------------------
-- Server version	5.6.26-log

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
-- Current Database: `compfundationdb`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `compfundationdb` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `compfundationdb`;

--
-- Table structure for table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abonnement` (
  `abo_id` int(11) NOT NULL AUTO_INCREMENT,
  `abo_libelle` varchar(100) NOT NULL,
  `abo_dureemini` int(11) NOT NULL,
  `abo_dureemaxi` int(11) NOT NULL,
  `abo_description` text NOT NULL,
  PRIMARY KEY (`abo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abonnement`
--

LOCK TABLES `abonnement` WRITE;
/*!40000 ALTER TABLE `abonnement` DISABLE KEYS */;
INSERT INTO `abonnement` VALUES (1,'premium',6,24,'Abonnement premium, de meilleurs résultats mieux ciblés et des infos exclusives.');
/*!40000 ALTER TABLE `abonnement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appliquer`
--

DROP TABLE IF EXISTS `appliquer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appliquer` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_idtarif` int(11) DEFAULT NULL,
  `app_idabonnement` int(11) DEFAULT NULL,
  `app_datedebut` date DEFAULT NULL,
  PRIMARY KEY (`app_id`),
  KEY `fk_apptarif` (`app_idtarif`),
  KEY `fk_appabo` (`app_idabonnement`),
  CONSTRAINT `fk_appabo` FOREIGN KEY (`app_idabonnement`) REFERENCES `abonnement` (`abo_id`),
  CONSTRAINT `fk_apptarif` FOREIGN KEY (`app_idtarif`) REFERENCES `tarif` (`tar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appliquer`
--

LOCK TABLES `appliquer` WRITE;
/*!40000 ALTER TABLE `appliquer` DISABLE KEYS */;
/*!40000 ALTER TABLE `appliquer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `concerne`
--

DROP TABLE IF EXISTS `concerne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `concerne` (
  `conc_iddomaine` int(11) NOT NULL,
  `conc_idrecherche` int(11) NOT NULL,
  PRIMARY KEY (`conc_iddomaine`,`conc_idrecherche`),
  KEY `fk_idrecherche` (`conc_idrecherche`),
  CONSTRAINT `fk_iddomaine` FOREIGN KEY (`conc_iddomaine`) REFERENCES `domaine` (`dom_id`),
  CONSTRAINT `fk_idrecherche` FOREIGN KEY (`conc_idrecherche`) REFERENCES `recherche` (`rec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `concerne`
--

LOCK TABLES `concerne` WRITE;
/*!40000 ALTER TABLE `concerne` DISABLE KEYS */;
/*!40000 ALTER TABLE `concerne` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `ctc_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctc_nom` varchar(100) NOT NULL,
  `ctc_prenom` varchar(100) NOT NULL,
  `ctc_email` varchar(100) NOT NULL,
  `ctc_telephone` varchar(12) NOT NULL,
  `ctc_idorganisme` int(11) DEFAULT NULL,
  PRIMARY KEY (`ctc_id`),
  KEY `fk_organisme` (`ctc_idorganisme`),
  CONSTRAINT `fk_organisme` FOREIGN KEY (`ctc_idorganisme`) REFERENCES `organisme` (`org_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domaine`
--

DROP TABLE IF EXISTS `domaine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domaine` (
  `dom_id` int(11) NOT NULL AUTO_INCREMENT,
  `dom_libelle` varchar(100) NOT NULL,
  `dom_iddomaineparent` int(11) NOT NULL,
  PRIMARY KEY (`dom_id`),
  KEY `fk_domsup` (`dom_iddomaineparent`),
  CONSTRAINT `fk_domsup` FOREIGN KEY (`dom_iddomaineparent`) REFERENCES `domaine` (`dom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domaine`
--

LOCK TABLES `domaine` WRITE;
/*!40000 ALTER TABLE `domaine` DISABLE KEYS */;
INSERT INTO `domaine` VALUES (1,'informatique',1),(2,'sécurité ',1),(3,'management',2),(4,'marketing',2),(5,'développement d\'applications',1),(6,'développement web',1),(7,'bureautique',3),(8,'développement JAVA',1),(9,'développement JEE',1),(10,'Word',3),(11,'Access',3),(12,'Excel',3),(13,'VBA',1),(14,'développement PHP',1),(15,'développement SQL',1);
/*!40000 ALTER TABLE `domaine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estcompetent`
--

DROP TABLE IF EXISTS `estcompetent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estcompetent` (
  `comp_iddomaine` int(11) NOT NULL,
  `comp_idniveau` int(11) NOT NULL,
  `comp_idintervenant` int(11) NOT NULL,
  PRIMARY KEY (`comp_iddomaine`,`comp_idniveau`,`comp_idintervenant`),
  KEY `fk_compniveau` (`comp_idniveau`),
  KEY `fk_compintervant` (`comp_idintervenant`),
  CONSTRAINT `fk_compdomaine` FOREIGN KEY (`comp_iddomaine`) REFERENCES `domaine` (`dom_id`),
  CONSTRAINT `fk_compintervant` FOREIGN KEY (`comp_idintervenant`) REFERENCES `intervenant` (`int_id`),
  CONSTRAINT `fk_compniveau` FOREIGN KEY (`comp_idniveau`) REFERENCES `niveau` (`niv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estcompetent`
--

LOCK TABLES `estcompetent` WRITE;
/*!40000 ALTER TABLE `estcompetent` DISABLE KEYS */;
/*!40000 ALTER TABLE `estcompetent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intervenant`
--

DROP TABLE IF EXISTS `intervenant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intervenant` (
  `int_id` int(11) NOT NULL AUTO_INCREMENT,
  `int_nom` varchar(100) NOT NULL,
  `int_prenom` varchar(100) NOT NULL,
  `int_email` varchar(100) NOT NULL,
  `int_telephone` varchar(12) NOT NULL,
  `int_fax` varchar(12) NOT NULL,
  `int_statutcotisation` int(11) NOT NULL,
  PRIMARY KEY (`int_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervenant`
--

LOCK TABLES `intervenant` WRITE;
/*!40000 ALTER TABLE `intervenant` DISABLE KEYS */;
INSERT INTO `intervenant` VALUES (1,'Rograsque','Théolien','theolien@gmail.com','0660956332','0674752322',1),(2,'Oupal','Isiode ','isiode@gmail.com','0660956333','0674752323',1),(3,'Apeybeux','Armène','armene@gmail.com','0660956334','0674752324',1),(4,'Nibrirosque','Adolus','adolus@gmail.com','0660956335','0674752325',1),(5,'Telame','Amadélis','amadelis@gmail.com','0660956336','0674752326',1),(6,'Marevrenc','Eugénio','eugenio@gmail.com','0660956337','0674752327',1),(7,'Dornosse','Hénéri','heneri@gmail.com','0660956338','0674752328',1);
/*!40000 ALTER TABLE `intervenant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveau`
--

DROP TABLE IF EXISTS `niveau`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `niveau` (
  `niv_id` int(11) NOT NULL AUTO_INCREMENT,
  `niv_libelle` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`niv_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveau`
--

LOCK TABLES `niveau` WRITE;
/*!40000 ALTER TABLE `niveau` DISABLE KEYS */;
INSERT INTO `niveau` VALUES (1,'débutant'),(2,'intermédiaire'),(3,'expert');
/*!40000 ALTER TABLE `niveau` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisme`
--

DROP TABLE IF EXISTS `organisme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisme` (
  `org_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_nom` varchar(100) NOT NULL,
  `org_email` varchar(100) NOT NULL,
  `org_telephone` varchar(100) NOT NULL,
  `org_codepostal` varchar(100) NOT NULL,
  `org_ville` varchar(100) NOT NULL,
  `org_statutcotisation` int(11) DEFAULT NULL,
  PRIMARY KEY (`org_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisme`
--

LOCK TABLES `organisme` WRITE;
/*!40000 ALTER TABLE `organisme` DISABLE KEYS */;
INSERT INTO `organisme` VALUES (1,'Le poulet blanc','pouletblanc@gmail.com','0628543247','33000','bordeaux',1),(2,'La plume du voyageur','plumeduvoyageur@gmail.com','0628543248','75000','paris',1),(3,'Le dortoir d\'Ulis','dortoirdulis@gmail.com','0628543249','13000','marseille',1);
/*!40000 ALTER TABLE `organisme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posseder`
--

DROP TABLE IF EXISTS `posseder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posseder` (
  `poss_id` int(11) NOT NULL AUTO_INCREMENT,
  `poss_idintervenant` int(11) DEFAULT NULL,
  `poss_idorganisme` int(11) DEFAULT NULL,
  `poss_idabonnement` int(11) DEFAULT NULL,
  `poss_datedebut` date DEFAULT NULL,
  `poss_datefin` date DEFAULT NULL,
  PRIMARY KEY (`poss_id`),
  KEY `posseder_intervenant_fk` (`poss_idintervenant`),
  KEY `posseder_organisme_fk` (`poss_idorganisme`),
  KEY `posseder_abonnement_fk` (`poss_idabonnement`),
  CONSTRAINT `posseder_abonnement_fk` FOREIGN KEY (`poss_idabonnement`) REFERENCES `abonnement` (`abo_id`),
  CONSTRAINT `posseder_intervenant_fk` FOREIGN KEY (`poss_idintervenant`) REFERENCES `intervenant` (`int_id`),
  CONSTRAINT `posseder_organisme_fk` FOREIGN KEY (`poss_idorganisme`) REFERENCES `organisme` (`org_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posseder`
--

LOCK TABLES `posseder` WRITE;
/*!40000 ALTER TABLE `posseder` DISABLE KEYS */;
/*!40000 ALTER TABLE `posseder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recherche`
--

DROP TABLE IF EXISTS `recherche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recherche` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `rec_date` date NOT NULL,
  `rec_heure` time NOT NULL,
  `rec_codepostal` char(5) NOT NULL,
  `rec_ville` varchar(100) NOT NULL,
  `rec_description` text,
  `rec_active` int(11) NOT NULL,
  `rec_datelimiteintervention` date NOT NULL,
  `rec_nombrejoursintervention` int(11) NOT NULL,
  `rec_idorganisme` int(11) DEFAULT NULL,
  `rec_idctcorigine` int(11) DEFAULT NULL,
  `rec_titre` varchar(100) NOT NULL,
  PRIMARY KEY (`rec_id`),
  KEY `fk_recorganisme` (`rec_idorganisme`),
  KEY `fk_reccontact` (`rec_idctcorigine`),
  CONSTRAINT `fk_reccontact` FOREIGN KEY (`rec_idctcorigine`) REFERENCES `contact` (`ctc_id`),
  CONSTRAINT `fk_recorganisme` FOREIGN KEY (`rec_idorganisme`) REFERENCES `organisme` (`org_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recherche`
--

LOCK TABLES `recherche` WRITE;
/*!40000 ALTER TABLE `recherche` DISABLE KEYS */;
/*!40000 ALTER TABLE `recherche` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarif`
--

DROP TABLE IF EXISTS `tarif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarif` (
  `tar_id` int(11) NOT NULL AUTO_INCREMENT,
  `tar_montanthtannuel` varchar(100) NOT NULL,
  PRIMARY KEY (`tar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarif`
--

LOCK TABLES `tarif` WRITE;
/*!40000 ALTER TABLE `tarif` DISABLE KEYS */;
INSERT INTO `tarif` VALUES (1,'99 ');
/*!40000 ALTER TABLE `tarif` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-27 12:12:05
