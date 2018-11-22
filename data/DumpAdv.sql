-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: advauto
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Table structure for table `adverts`
--

DROP TABLE IF EXISTS `adverts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adverts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_id` int(11) DEFAULT NULL,
  `mileage` int(11) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adverts`
--

LOCK TABLES `adverts` WRITE;
/*!40000 ALTER TABLE `adverts` DISABLE KEYS */;
INSERT INTO `adverts` VALUES (108,6,12454,'123','456'),(110,3,12454,'456456','456'),(116,2,5555,'5555','3333'),(117,3,456,'11111111','456'),(118,2,1231,'55555','2123123123'),(119,2,4545,'456456','2132'),(120,5,55555,'555888','54453453'),(121,5,88888,'6666','666'),(122,1,11000,'123123','1231584856'),(123,8,78,'78','789');
/*!40000 ALTER TABLE `adverts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adverts_options`
--

DROP TABLE IF EXISTS `adverts_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adverts_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advert_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adverts_options`
--

LOCK TABLES `adverts_options` WRITE;
/*!40000 ALTER TABLE `adverts_options` DISABLE KEYS */;
INSERT INTO `adverts_options` VALUES (116,110,3),(117,110,4),(126,108,3),(152,116,1),(153,116,2),(154,116,4),(155,116,5),(156,117,2),(157,117,3),(158,118,1),(159,118,2),(160,119,2),(161,119,3),(162,120,2),(163,120,3),(164,121,2),(165,121,5),(166,122,2),(167,122,3),(168,123,1);
/*!40000 ALTER TABLE `adverts_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'BMW'),(2,'Audi'),(3,'Mersedes'),(4,'Subaru'),(5,'LADA');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `advert_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (105,'f5/f8/ad26819a471318d24631fa5055036712a87e.jpg',110),(106,'9c/3d/cb1f9185a314ea25d51aed3b5881b32f420c.jpg',110),(115,'f5/f8/ad26819a471318d24631fa5055036712a87e.jpg',108),(129,'30/42/0d1a9afb2bcb60335812569af4435a59ce17.jpg',116),(130,'1b/46/05b0e20ceccf91aa278d10e81fad64e24e27.jpg',116),(131,'f5/f8/ad26819a471318d24631fa5055036712a87e.jpg',117),(132,'9c/3d/cb1f9185a314ea25d51aed3b5881b32f420c.jpg',117),(133,'3b/15/be84aff20b322a93c0b9aaa62e25ad33b4b4.jpg',118),(134,'54/c2/f1a1eb6f12d681a5c7078421a5500cee02ad.jpg',118),(135,'d9/97/e1c37edc05ad87d03603e32ad495ee2cfce1.jpg',119),(136,'df/7b/e9dc4f467187783aca68c7ce98e4df2172d0.jpg',119),(137,'30/42/0d1a9afb2bcb60335812569af4435a59ce17.jpg',120),(138,'1b/46/05b0e20ceccf91aa278d10e81fad64e24e27.jpg',120),(139,'f5/f8/ad26819a471318d24631fa5055036712a87e.jpg',121),(140,'d9/97/e1c37edc05ad87d03603e32ad495ee2cfce1.jpg',121),(141,'1b/46/05b0e20ceccf91aa278d10e81fad64e24e27.jpg',121),(142,'30/42/0d1a9afb2bcb60335812569af4435a59ce17.jpg',122),(143,'1b/46/05b0e20ceccf91aa278d10e81fad64e24e27.jpg',122),(144,'9c/3d/cb1f9185a314ea25d51aed3b5881b32f420c.jpg',123);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1542631637),('m181119_123412_create_brands_table',1542631658),('m181119_123446_create_models_table',1542631658),('m181119_123507_create_options_table',1542631659),('m181119_123534_create_adverts_options_table',1542631659),('m181119_123602_create_adverts_table',1542631659),('m181119_123627_create_images_table',1542631660);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,'M5',1),(2,'A8',2),(3,'Impreza',4),(4,'X6',1),(5,'S 63',3),(6,'S 222',3),(7,'Granta',5),(8,'Vesta',5);
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'ABS'),(2,'ESP'),(3,'Датчик дождя'),(4,'Подушка безопасности'),(5,'Сигнализация');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-22 11:05:13
