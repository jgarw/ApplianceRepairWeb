-- MySQL dump 10.13  Distrib 8.0.36, for macos14 (x86_64)
--
-- Host: localhost    Database: WebAssignment2
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `APPLIANCES`
--

DROP TABLE IF EXISTS `APPLIANCES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `APPLIANCES` (
  `applianceID` int(11) NOT NULL AUTO_INCREMENT,
  `applianceName` varchar(255) NOT NULL,
  `applianceType` varchar(255) NOT NULL,
  PRIMARY KEY (`applianceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `APPLIANCES`
--

LOCK TABLES `APPLIANCES` WRITE;
/*!40000 ALTER TABLE `APPLIANCES` DISABLE KEYS */;
/*!40000 ALTER TABLE `APPLIANCES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `APPOINTMENTS`
--

DROP TABLE IF EXISTS `APPOINTMENTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `APPOINTMENTS` (
  `appointmentID` int(11) NOT NULL AUTO_INCREMENT,
  `applianceID` int(11) DEFAULT NULL,
  `technicianID` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  `appointmentDateTime` datetime NOT NULL,
  `reason` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `quote` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`appointmentID`),
  KEY `FK_APPOINTMENT_APPLIANCE` (`applianceID`),
  KEY `FK_APPOINTMENT_TECHNICIAN` (`technicianID`),
  KEY `FK_APPOINTMENT_CUSTOMER` (`customerID`),
  CONSTRAINT `FK_APPOINTMENT_APPLIANCE` FOREIGN KEY (`applianceID`) REFERENCES `APPLIANCES` (`applianceID`),
  CONSTRAINT `FK_APPOINTMENT_CUSTOMER` FOREIGN KEY (`customerID`) REFERENCES `CUSTOMERS` (`customerID`),
  CONSTRAINT `FK_APPOINTMENT_TECHNICIAN` FOREIGN KEY (`technicianID`) REFERENCES `TECHNICIANS` (`technicianID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `APPOINTMENTS`
--

LOCK TABLES `APPOINTMENTS` WRITE;
/*!40000 ALTER TABLE `APPOINTMENTS` DISABLE KEYS */;
/*!40000 ALTER TABLE `APPOINTMENTS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CUSTOMERS`
--

DROP TABLE IF EXISTS `CUSTOMERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CUSTOMERS` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CUSTOMERS`
--

LOCK TABLES `CUSTOMERS` WRITE;
/*!40000 ALTER TABLE `CUSTOMERS` DISABLE KEYS */;
/*!40000 ALTER TABLE `CUSTOMERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CUST_APPLIANCES`
--

DROP TABLE IF EXISTS `CUST_APPLIANCES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CUST_APPLIANCES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) DEFAULT NULL,
  `applianceID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_CUSTOMER_APPLIANCE` (`applianceID`),
  KEY `FK_APPLIANCE_CUSTOMER` (`customerID`),
  CONSTRAINT `FK_APPLIANCE_CUSTOMER` FOREIGN KEY (`customerID`) REFERENCES `CUSTOMERS` (`customerID`),
  CONSTRAINT `FK_CUSTOMER_APPLIANCE` FOREIGN KEY (`applianceID`) REFERENCES `APPLIANCES` (`applianceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CUST_APPLIANCES`
--

LOCK TABLES `CUST_APPLIANCES` WRITE;
/*!40000 ALTER TABLE `CUST_APPLIANCES` DISABLE KEYS */;
/*!40000 ALTER TABLE `CUST_APPLIANCES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TECHNICIANS`
--

DROP TABLE IF EXISTS `TECHNICIANS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `TECHNICIANS` (
  `technicianID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  PRIMARY KEY (`technicianID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TECHNICIANS`
--

LOCK TABLES `TECHNICIANS` WRITE;
/*!40000 ALTER TABLE `TECHNICIANS` DISABLE KEYS */;
/*!40000 ALTER TABLE `TECHNICIANS` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-15 21:58:06
