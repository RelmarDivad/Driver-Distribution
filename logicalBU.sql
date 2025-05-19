-- MySQL dump 10.13  Distrib 5.7.24, for Win64 (x86_64)
--
-- Host: localhost    Database: storesupply
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery` (
  `truckid` char(2) NOT NULL,
  `regionid` char(2) NOT NULL,
  `productid` char(4) NOT NULL,
  PRIMARY KEY (`truckid`,`regionid`,`productid`),
  KEY `productid` (`productid`),
  KEY `regionid` (`regionid`),
  CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`),
  CONSTRAINT `delivery_ibfk_2` FOREIGN KEY (`truckid`) REFERENCES `truck` (`truckid`),
  CONSTRAINT `delivery_ibfk_3` FOREIGN KEY (`regionid`) REFERENCES `region` (`regionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery`
--

LOCK TABLES `delivery` WRITE;
/*!40000 ALTER TABLE `delivery` DISABLE KEYS */;
INSERT INTO `delivery` VALUES ('T1','R1','P001'),('T1','R1','P003'),('T2','R1','P003'),('T1','R2','P001'),('T1','R2','P002'),('T1','R2','P003'),('T2','R2','P001'),('T2','R2','P002');
/*!40000 ALTER TABLE `delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver` (
  `driverid` char(4) NOT NULL,
  `licensenum` decimal(6,0) NOT NULL,
  `drivername` varchar(25) NOT NULL,
  `drivertruck` char(2) NOT NULL,
  PRIMARY KEY (`driverid`),
  KEY `drivertruck` (`drivertruck`),
  CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`drivertruck`) REFERENCES `truck` (`truckid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver`
--

LOCK TABLES `driver` WRITE;
/*!40000 ALTER TABLE `driver` DISABLE KEYS */;
INSERT INTO `driver` VALUES ('D001',123456,'Quinn','T1'),('D002',995371,'Marco','T2'),('D003',898765,'Olivia','T3');
/*!40000 ALTER TABLE `driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `empid` char(4) NOT NULL,
  `dateofhire` date NOT NULL,
  `LName` varchar(25) NOT NULL,
  `Fname` varchar(25) NOT NULL,
  `StoreNum` char(2) NOT NULL,
  `regionid` char(2) NOT NULL,
  `manager` char(4) DEFAULT NULL,
  PRIMARY KEY (`empid`),
  KEY `regionid` (`regionid`),
  KEY `StoreNum` (`StoreNum`),
  KEY `manager` (`manager`),
  CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`regionid`) REFERENCES `region` (`regionid`),
  CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`StoreNum`) REFERENCES `store` (`StoreNum`),
  CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`manager`) REFERENCES `employee` (`empid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES ('E001','2021-01-30','Anderson','Niklas','S1','R1','E003'),('E002','2020-02-29','Schwartz','Sarah','S1','R1','E003'),('E003','2016-12-25','Lim','Elliot','S1','R1','E004'),('E004','2011-11-11','Bilhorn','Luke','S3','R2',NULL),('E005','2018-08-11','Trotti','Matthew','S1','R1','E003');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `employeesins1r1`
--

DROP TABLE IF EXISTS `employeesins1r1`;
/*!50001 DROP VIEW IF EXISTS `employeesins1r1`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `employeesins1r1` AS SELECT 
 1 AS `empid`,
 1 AS `dateofhire`,
 1 AS `LName`,
 1 AS `Fname`,
 1 AS `StoreNum`,
 1 AS `regionid`,
 1 AS `manager`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `manufacturedproducts`
--

DROP TABLE IF EXISTS `manufacturedproducts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturedproducts` (
  `productid` char(4) NOT NULL,
  `manufName` varchar(25) NOT NULL,
  `amountsent` int(11) NOT NULL,
  `bulkprice` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`productid`,`manufName`),
  KEY `manufName` (`manufName`),
  CONSTRAINT `manufacturedproducts_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`),
  CONSTRAINT `manufacturedproducts_ibfk_2` FOREIGN KEY (`manufName`) REFERENCES `manufacturer` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturedproducts`
--

LOCK TABLES `manufacturedproducts` WRITE;
/*!40000 ALTER TABLE `manufacturedproducts` DISABLE KEYS */;
INSERT INTO `manufacturedproducts` VALUES ('P001','KimChem',30,3.48),('P001','PohlyIndustries',50,3.48),('P002','KimChem',40,6.78),('P003','PohlyIndustries',50,5.00);
/*!40000 ALTER TABLE `manufacturedproducts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturer` (
  `Name` varchar(25) NOT NULL,
  `productioncapability` int(11) NOT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturer`
--

LOCK TABLES `manufacturer` WRITE;
/*!40000 ALTER TABLE `manufacturer` DISABLE KEYS */;
INSERT INTO `manufacturer` VALUES ('KimChem',34),('PohlyIndustries',55),('VanDrunenRus',80);
/*!40000 ALTER TABLE `manufacturer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `productid` char(4) NOT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES ('P001',5.35),('P002',10.00),('P003',5.78);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region` (
  `regionid` char(2) NOT NULL,
  `regionname` varchar(7) NOT NULL,
  PRIMARY KEY (`regionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES ('R1','South\r'),('R2','North\r'),('R3','West');
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks` (
  `StoreNum` char(2) NOT NULL,
  `regionid` char(2) NOT NULL,
  `productid` char(4) NOT NULL,
  `amount` int(11) NOT NULL,
  `deal` int(11) DEFAULT NULL,
  PRIMARY KEY (`StoreNum`,`regionid`,`productid`),
  KEY `regionid` (`regionid`),
  KEY `productid` (`productid`),
  CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`regionid`) REFERENCES `region` (`regionid`),
  CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`StoreNum`) REFERENCES `store` (`StoreNum`),
  CONSTRAINT `stocks_ibfk_3` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` VALUES ('S1','R1','P001',20,20),('S2','R2','P001',50,40),('S2','R2','P002',50,NULL);
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `store` (
  `StoreNum` char(2) NOT NULL,
  `regionid` char(2) NOT NULL,
  PRIMARY KEY (`StoreNum`,`regionid`),
  KEY `regionid` (`regionid`),
  CONSTRAINT `store_ibfk_1` FOREIGN KEY (`regionid`) REFERENCES `region` (`regionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store`
--

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` VALUES ('S1','R1'),('S2','R1'),('S1','R2'),('S2','R2'),('S3','R2'),('S1','R3');
/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `truck`
--

DROP TABLE IF EXISTS `truck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `truck` (
  `truckid` char(2) NOT NULL,
  `truckmodel` varchar(25) NOT NULL,
  `owner` char(4) NOT NULL,
  PRIMARY KEY (`truckid`),
  KEY `owner` (`owner`),
  CONSTRAINT `truck_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `driver` (`driverid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `truck`
--

LOCK TABLES `truck` WRITE;
/*!40000 ALTER TABLE `truck` DISABLE KEYS */;
INSERT INTO `truck` VALUES ('T1','Ford','D001'),('T2','Nissan','D001'),('T3','Ford','D002');
/*!40000 ALTER TABLE `truck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `truckservice`
--

DROP TABLE IF EXISTS `truckservice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `truckservice` (
  `truckid` char(2) NOT NULL,
  `regionid` char(2) NOT NULL,
  PRIMARY KEY (`truckid`,`regionid`),
  KEY `regionid` (`regionid`),
  CONSTRAINT `truckservice_ibfk_1` FOREIGN KEY (`truckid`) REFERENCES `truck` (`truckid`),
  CONSTRAINT `truckservice_ibfk_2` FOREIGN KEY (`regionid`) REFERENCES `region` (`regionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `truckservice`
--

LOCK TABLES `truckservice` WRITE;
/*!40000 ALTER TABLE `truckservice` DISABLE KEYS */;
INSERT INTO `truckservice` VALUES ('T1','R1'),('T2','R2'),('T3','R3');
/*!40000 ALTER TABLE `truckservice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `employeesins1r1`
--

/*!50001 DROP VIEW IF EXISTS `employeesins1r1`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = cp850 */;
/*!50001 SET character_set_results     = cp850 */;
/*!50001 SET collation_connection      = cp850_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `employeesins1r1` AS select `employee`.`empid` AS `empid`,`employee`.`dateofhire` AS `dateofhire`,`employee`.`LName` AS `LName`,`employee`.`Fname` AS `Fname`,`employee`.`StoreNum` AS `StoreNum`,`employee`.`regionid` AS `regionid`,`employee`.`manager` AS `manager` from `employee` where ((`employee`.`StoreNum` = 'S1') and (`employee`.`regionid` = 'r1')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-19 15:31:44
