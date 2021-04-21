-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: favours4neighbours
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `county`
--

DROP TABLE IF EXISTS `county`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `county` (
  `ID_county` int NOT NULL AUTO_INCREMENT,
  `county` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_county`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `county`
--

LOCK TABLES `county` WRITE;
/*!40000 ALTER TABLE `county` DISABLE KEYS */;
INSERT INTO `county` VALUES (1,'Antrim'),(2,'Armagh'),(3,'Carlow'),(4,'Cavan'),(5,'Clare'),(6,'Cork'),(7,'Derry'),(8,'Donegal'),(9,'Down'),(10,'Dublin'),(11,'Fermanagh'),(12,'Galway'),(13,'Kerry'),(14,'Kildare'),(15,'Kilkenny'),(16,'Laois'),(17,'Leitrim'),(18,'Limerick'),(19,'Longford '),(20,'Louth'),(21,'Mayo'),(22,'Meath'),(23,'Monaghan'),(24,'Offaly'),(25,'Roscommon'),(26,'Sligo'),(27,'Tipperary'),(28,'Tyrone'),(29,'Waterford'),(30,'Westmeath'),(31,'Wexford'),(32,'Wicklow');
/*!40000 ALTER TABLE `county` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `AssignedTo` int DEFAULT NULL,
  `CreatedBy` int NOT NULL,
  `DurationEstimate` varchar(45) NOT NULL,
  `EquipmentRequired` varchar(100) NOT NULL,
  `JobCategory` int NOT NULL,
  `JobCounty` int NOT NULL,
  `JobDetails` varchar(500) NOT NULL,
  `JobPrice` float DEFAULT NULL,
  `JobStatus` varchar(25) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  KEY `fk_Job_User1_idx` (`CreatedBy`),
  CONSTRAINT `fk_Job_User1` FOREIGN KEY (`CreatedBy`) REFERENCES `user` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=123456839 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (123456,NULL,123,'4 hours','Yes Lawnmower',200,15,'Lawn Cutting needed for garden  TEST IF UPDATED',0,NULL,'2021-03-15 19:52:43','2021-03-15 19:52:43','2021-04-20 10:43:23'),(123457,123,123,'1 hour','No',200,15,'Shopping ',10,'New','2021-03-15 19:52:43','2021-03-15 19:52:43','2021-03-15 19:52:43'),(1234579,123,123,'1 hour','No',200,15,'Shopping ',10,'New','2021-03-15 19:52:43','2021-03-15 19:52:43','2021-03-15 19:52:43'),(123456806,NULL,123,'4 hours','No',200,15,'Painitng ',30,NULL,'2021-04-03 06:57:25','2021-04-03 12:57:25','2021-04-03 06:57:25'),(123456807,NULL,123,'2 hours','',202,15,'Fix a old bike',20,NULL,'2021-04-03 07:32:23','2021-04-03 13:32:23','2021-04-20 14:19:52'),(123456826,NULL,123,'30 mins','Car',200,1,'Fix a old bike',5,NULL,'2021-04-16 09:41:06','2021-04-16 15:41:06','2021-04-16 09:41:06'),(123456827,NULL,123,'30 mins','Car',200,1,'Fix a old bike',5,NULL,'2021-04-16 09:43:09','2021-04-16 15:43:09','2021-04-16 09:43:09'),(123456828,NULL,123,'30 mins','Car',200,1,'Fix a old bike',5,NULL,'2021-04-16 09:46:15','2021-04-16 15:46:15','2021-04-16 09:46:15'),(123456829,NULL,123,'Tested``','Tested',200,1,'Tested',123,NULL,'2021-04-16 09:46:45','2021-04-16 15:46:45','2021-04-16 09:46:45'),(123456830,NULL,123,'Tested``','Tested',200,1,'Tested',123,NULL,'2021-04-16 09:47:53','2021-04-16 15:47:53','2021-04-16 09:47:53'),(123456831,NULL,124,'30 mins','Car',200,1,'Fix a old bike',0,NULL,'2021-04-16 09:48:16','2021-04-16 15:48:16','2021-04-16 12:34:28'),(123456832,NULL,124,'30 mins','Car',201,1,'ZFinal Test',24.99,NULL,'2021-04-16 09:53:07','2021-04-16 15:53:07','2021-04-16 09:53:07'),(123456833,NULL,124,'30 mins','Car',200,1,'ZzFinal Test',25.99,NULL,'2021-04-16 09:55:04','2021-04-16 15:55:04','2021-04-16 09:55:04'),(123456834,NULL,123,'2 hours','none',206,14,'Farming help needed ',5,NULL,'2021-04-20 06:10:15','2021-04-20 12:10:15','2021-04-20 06:10:45'),(123456835,124,125,'2 hours','equipment provided',202,16,'Outdoor fence needs painting approx 10 meters ',20,NULL,'2021-04-20 06:30:52','2021-04-20 12:30:52','2021-04-20 06:36:27'),(123456837,NULL,126,'2 hours','Lawnmower',201,5,'   Gardening work neededmoving lawns ',30,NULL,'2021-04-21 03:25:14','2021-04-21 09:25:14','2021-04-21 03:26:13'),(123456838,NULL,126,'1 hour','car',207,1,'   shopping collected',15,NULL,'2021-04-21 03:37:16','2021-04-21 09:37:16','2021-04-21 03:37:16');
/*!40000 ALTER TABLE `job` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobapplication`
--

DROP TABLE IF EXISTS `jobapplication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobapplication` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Job` int NOT NULL,
  `User` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` int DEFAULT '1',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobapplication`
--

LOCK TABLES `jobapplication` WRITE;
/*!40000 ALTER TABLE `jobapplication` DISABLE KEYS */;
INSERT INTO `jobapplication` VALUES (6,123456831,123,'2021-04-16 11:28:33','2021-04-16 17:28:33','2021-04-16 12:34:28',2),(7,123456832,123,'2021-04-16 11:28:39','2021-04-16 17:28:39','2021-04-16 11:28:39',1),(8,123456831,123,'2021-04-16 11:29:02','2021-04-16 17:29:02','2021-04-16 11:29:02',1),(9,123456833,123,'2021-04-20 06:08:32','2021-04-20 12:08:32','2021-04-20 06:08:32',1),(10,123456826,125,'2021-04-20 06:28:58','2021-04-20 12:28:58','2021-04-20 06:28:58',1),(11,123456826,125,'2021-04-20 06:29:24','2021-04-20 12:29:24','2021-04-20 06:29:24',1),(12,123456832,125,'2021-04-20 06:38:50','2021-04-20 12:38:50','2021-04-20 06:38:50',1),(13,123456832,125,'2021-04-20 06:39:25','2021-04-20 12:39:25','2021-04-20 06:39:25',1),(14,123456832,125,'2021-04-20 06:39:38','2021-04-20 12:39:38','2021-04-20 06:39:38',1),(15,123456832,125,'2021-04-20 06:40:04','2021-04-20 12:40:04','2021-04-20 06:40:04',1),(16,123456834,125,'2021-04-20 06:50:56','2021-04-20 12:50:56','2021-04-20 06:50:56',1),(17,123456835,123,'2021-04-20 07:16:49','2021-04-20 13:16:49','2021-04-20 07:16:49',1),(18,123456835,123,'2021-04-20 07:17:32','2021-04-20 13:17:32','2021-04-20 07:17:32',1),(19,123456831,123,'2021-04-20 07:38:20','2021-04-20 13:38:20','2021-04-20 07:38:20',1),(20,123456831,123,'2021-04-20 11:25:59','2021-04-20 17:25:59','2021-04-20 11:25:59',1),(21,123456832,123,'2021-04-20 13:20:55','2021-04-20 19:20:55','2021-04-20 13:20:55',1),(22,123456832,123,'2021-04-20 13:22:24','2021-04-20 19:22:25','2021-04-20 13:22:24',1),(23,123456807,126,'2021-04-21 03:26:56','2021-04-21 09:26:56','2021-04-21 03:26:56',1),(24,123456807,126,'2021-04-21 03:27:03','2021-04-21 09:27:03','2021-04-21 03:27:03',1),(25,123456834,126,'2021-04-21 03:39:28','2021-04-21 09:39:28','2021-04-21 03:39:28',1),(26,123456835,126,'2021-04-21 03:42:07','2021-04-21 09:42:07','2021-04-21 03:42:07',1);
/*!40000 ALTER TABLE `jobapplication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobcategory`
--

DROP TABLE IF EXISTS `jobcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobcategory` (
  `Id` int NOT NULL,
  `JobCategory` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobcategory`
--

LOCK TABLES `jobcategory` WRITE;
/*!40000 ALTER TABLE `jobcategory` DISABLE KEYS */;
INSERT INTO `jobcategory` VALUES (200,'Bike Repairs'),(201,'Gardening'),(202,'Painting - Indoor'),(203,'Painting - Outdoors'),(204,'Change Lightbulbs - Indoor'),(205,'Change Lightbulbs - Outdoor'),(206,'Farming'),(207,'Shopping'),(208,'Collection'),(209,'Technical Support');
/*!40000 ALTER TABLE `jobcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobtag`
--

DROP TABLE IF EXISTS `jobtag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobtag` (
  `Job_Id` int NOT NULL,
  `Tag_Id` int NOT NULL,
  PRIMARY KEY (`Job_Id`,`Tag_Id`),
  KEY `fk_Job_has_Tag_Tag1_idx` (`Tag_Id`),
  KEY `fk_Job_has_Tag_Job1_idx` (`Job_Id`),
  CONSTRAINT `fk_Job_has_Tag_Job1` FOREIGN KEY (`Job_Id`) REFERENCES `job` (`Id`),
  CONSTRAINT `fk_Job_has_Tag_Tag1` FOREIGN KEY (`Tag_Id`) REFERENCES `tag` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobtag`
--

LOCK TABLES `jobtag` WRITE;
/*!40000 ALTER TABLE `jobtag` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobtag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name_UNIQUE` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `Active` tinyint NOT NULL DEFAULT '1',
  `FirstName` varchar(45) DEFAULT NULL,
  `Surname` varchar(45) NOT NULL,
  `AddressLine1` varchar(45) NOT NULL,
  `AddressLine2` varchar(45) DEFAULT NULL,
  `Eircode` varchar(45) NOT NULL,
  `Telephone` varchar(10) NOT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `IsAdmin` tinyint NOT NULL DEFAULT '0',
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateModified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Photo` varchar(45) DEFAULT NULL,
  `Bio` varchar(500) DEFAULT NULL,
  `County` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Username_UNIQUE` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (123,'neaegan','aab1cb844c7663565888980086184921d0365a15','neaegan@gmail.com',1,'Niamh','Egan','Derry','','V95TV05','0874609667',NULL,1,'2021-04-13 16:10:30','2021-04-13 22:10:30','2021-04-21 03:19:40',NULL,NULL,1),(124,'jane.doe','aab1cb844c7663565888980086184921d0365a15','jane.doe@lit.ie',1,'Jane','Doe','LIT','Moylish','V95TV05','081 123 12',NULL,0,'2021-04-16 10:17:47','2021-04-16 16:17:47','2021-04-16 10:17:47',NULL,NULL,1),(125,'testtest','aab1cb844c7663565888980086184921d0365a15','test@gmail.com',1,'Test','Test','Derry','','V98TY56','0874564569',NULL,0,'2021-04-20 06:23:54','2021-04-20 12:23:54','2021-04-20 06:23:54',NULL,NULL,1),(126,'pault','aab1cb844c7663565888980086184921d0365a15','pault@gmail.com',1,'Paul','Test','Lahinch','Ennistymon','V95 97456','0874567891',NULL,0,'2021-04-21 03:24:17','2021-04-21 09:24:17','2021-04-21 03:24:17',NULL,NULL,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userdetails`
--

DROP TABLE IF EXISTS `userdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userdetails` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `userFirstName` varchar(45) NOT NULL,
  `userSurname` varchar(45) NOT NULL,
  `userAddress1` varchar(45) NOT NULL,
  `userAddress2` varchar(45) DEFAULT NULL,
  `userEircode` varchar(45) NOT NULL,
  `userPhone` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userdetails`
--

LOCK TABLES `userdetails` WRITE;
/*!40000 ALTER TABLE `userdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `userdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userjobskill`
--

DROP TABLE IF EXISTS `userjobskill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userjobskill` (
  `User_Id` int NOT NULL,
  `Tag_Id` int NOT NULL,
  PRIMARY KEY (`User_Id`,`Tag_Id`),
  KEY `fk_User_has_Tag_Tag1_idx` (`Tag_Id`),
  KEY `fk_User_has_Tag_User1_idx` (`User_Id`),
  CONSTRAINT `fk_User_has_Tag_Tag1` FOREIGN KEY (`Tag_Id`) REFERENCES `tag` (`Id`),
  CONSTRAINT `fk_User_has_Tag_User1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userjobskill`
--

LOCK TABLES `userjobskill` WRITE;
/*!40000 ALTER TABLE `userjobskill` DISABLE KEYS */;
/*!40000 ALTER TABLE `userjobskill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userrole`
--

DROP TABLE IF EXISTS `userrole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userrole` (
  `Id` int NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name_UNIQUE` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userrole`
--

LOCK TABLES `userrole` WRITE;
/*!40000 ALTER TABLE `userrole` DISABLE KEYS */;
/*!40000 ALTER TABLE `userrole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userrolelink`
--

DROP TABLE IF EXISTS `userrolelink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userrolelink` (
  `UserRoleId` int NOT NULL,
  `UserId` int NOT NULL,
  PRIMARY KEY (`UserRoleId`,`UserId`),
  KEY `fk_UserRole_has_User_User1_idx` (`UserId`),
  KEY `fk_UserRole_has_User_UserRole_idx` (`UserRoleId`),
  CONSTRAINT `fk_UserRole_has_User_User1` FOREIGN KEY (`UserId`) REFERENCES `user` (`Id`),
  CONSTRAINT `fk_UserRole_has_User_UserRole` FOREIGN KEY (`UserRoleId`) REFERENCES `userrole` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userrolelink`
--

LOCK TABLES `userrolelink` WRITE;
/*!40000 ALTER TABLE `userrolelink` DISABLE KEYS */;
/*!40000 ALTER TABLE `userrolelink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'favours4neighbours'
--
/*!50003 DROP PROCEDURE IF EXISTS `GetAvailableJobs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAvailableJobs`(IN `$_UserID` INT)
BEGIN
SELECT `job`.`Id` as Id,
    `job`.`JobDetails`,
    `job`.`JobStatus`,
    `job`.`EquipmentRequired`,
    `job`.`DurationEstimate`,
    `job`.`JobPrice`,
    `job`.`AssignedTo`,
    `job`.`updated_at`,
    `job`.`JobCategory`,
    `job`.`JobCounty`,

    `user`.`Username` as AssignedUsername,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as AssignedUserFullName,
    
    `jobcategory`.`Id` as JobCategoryId,
    `jobcategory`.`JobCategory`


FROM `favours4neighbours`.`job`
	Left Join `user`
		On `job`.`CreatedBy` = `user`.`Id`
	Left Join `jobcategory`
		On `job`.`JobCategory` = `jobcategory`.`Id`

WHERE `job`.`CreatedBy` != $_UserID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetAvailableJobsView` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAvailableJobsView`(IN `$_UserID` INT)
BEGIN
SELECT `job`.`Id` as Id,
    `job`.`JobDetails`,
    `job`.`JobStatus`,
    `job`.`EquipmentRequired`,
    `job`.`DurationEstimate`,
    `job`.`JobPrice`,
    `job`.`AssignedTo`,
    `job`.`updated_at`,
    `job`.`JobCategory`,
    `job`.`JobCounty`,

    `user`.`Username` as AssignedUsername,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as AssignedUserFullName,
    
    `jobcategory`.`Id` as JobCategoryId,
    `jobcategory`.`JobCategory`


FROM `favours4neighbours`.`job`
	Left Join `user`
		On `job`.`CreatedBy` = `user`.`Id`
	Left Join `jobcategory`
		On `job`.`JobCategory` = `jobcategory`.`Id`

WHERE `job`.`CreatedBy` != $_UserID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationsByViewUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationsByViewUser`(IN `$_UserID` INT)
BEGIN
SELECT  `jobapplication`.`Id`,
    `jobapplication`.`created_at`,
    `jobapplication`.`Status`,
    
    `user`.`Username` as Username,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as UserFullName,
    
    `job`.`Id` as JobId,
    `job`.`JobDetails`,
    `job`.`created_at`
FROM `jobapplication`
	Inner Join `job`
		On `jobapplication`.`Job` = `Job`.`Id`
	Inner Join `user`
		On `jobapplication`.`User` = `user`.`Id`
WHERE `jobapplication`.`User` = $_UserId
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationsView` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationsView`()
BEGIN
SELECT `jobapplication`.`Id`,
    `jobapplication`.`created_at`,
    `jobapplication`.`Status`,
    
    `user`.`Username` as Username,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as UserFullName,
    
    `job`.`Id` as JobId,
    `job`.`JobDetails`,
    `job`.`created_at`
FROM `jobapplication`
	Left Join `user`
		On `jobapplication`.`User` = `user`.`Id`
	Left Join `job`
		On `jobapplication`.`Job` = `jobapplication`.`Job`;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationsViewByJob` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationsViewByJob`(IN `$_JobId` INT)
BEGIN
SELECT `jobapplication`.`Id`,
    `jobapplication`.`created_at`,
    `jobapplication`.`Status`,
    
    `user`.`Id` as UserId,
    `user`.`Username` as Username,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as UserFullName

FROM `jobapplication`
	Inner Join `user`
		On `jobapplication`.`User` = `user`.`Id`
WHERE `jobapplication`.`Job` = $_JobId
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationsViewByUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationsViewByUser`(IN `$_UserID` INT)
BEGIN
SELECT  `jobapplication`.`Id`,
    `jobapplication`.`created_at`,
    `jobapplication`.`Status`,
    
    `job`.`Id` as JobId,
    `job`.`JobDetails`
FROM `jobapplication`
	Inner Join `job`
		On `jobapplication`.`Job` = `Job`.`Id`
WHERE `jobapplication`.`User` = $_UserId
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationView` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationView`()
BEGIN
SELECT `jobapplication`.`Id`,
    `jobapplication`.`created_at`,
    `jobapplication`.`Status`,
    
    `user`.`Username` as Username,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as UserFullName,
    
    `job`.`Id` as JobId,
    `job`.`JobDetails`,
    `job`.`created_at`
FROM `jobapplication`
	Left Join `user`
		On `jobapplication`.`User` = `user`.`Id`
	Left Join `job`
		On `jobapplication`.`Job` = `jobapplication`.`Job`;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobs`()
BEGIN
SELECT `job`.`Id` as Id,
    `job`.`JobDetails`,
    `job`.`JobStatus`,
    `job`.`EquipmentRequired`,
    `job`.`DurationEstimate`,
    `job`.`JobPrice`,
    `job`.`AssignedTo`,
    `job`.`updated_at`,
    `job`.`JobCategory`,
    `job`.`JobCounty`,

    `user`.`Username` as AssignedUsername,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as AssignedUserFullName,
    
    `jobcategory`.`Id` as JobCategoryId,
    `jobcategory`.`JobCategory`


FROM `favours4neighbours`.`job`
	Left Join `user`
		On `job`.`CreatedBy` = `user`.`Id`
	Left Join `jobcategory`
		On `job`.`JobCategory` = `jobcategory`.`Id`;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetMyJobApplicationsView` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMyJobApplicationsView`(IN `$_UserID` INT)
BEGIN
SELECT  `jobapplication`.`Id`,
    `jobapplication`.`created_at`,
    `jobapplication`.`Status`,
    
    `user`.`Username` as Username,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as UserFullName,
    
    `job`.`Id` as JobId,
    `job`.`JobDetails`,
    `job`.`created_at`
FROM `jobapplication`
	Inner Join `job`
		On `jobapplication`.`Job` = `Job`.`Id`
	Inner Join `user`
		On `jobapplication`.`User` = `user`.`Id`
WHERE `jobapplication`.`User` = $_UserId
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetMyJobs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMyJobs`(IN `$_UserID` INT)
BEGIN
SELECT `job`.`Id` as Id,
    `job`.`JobDetails`,
    `job`.`JobStatus`,
    `job`.`EquipmentRequired`,
    `job`.`DurationEstimate`,
    `job`.`JobPrice`,
    `job`.`AssignedTo`,
    `job`.`updated_at`,
    `job`.`JobCategory`,
    `job`.`JobCounty`,

    `user`.`Username` as AssignedUsername,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as AssignedUserFullName,
    
    `jobcategory`.`Id` as JobCategoryId,
    `jobcategory`.`JobCategory`


FROM `favours4neighbours`.`job`
	Left Join `user`
		On `job`.`CreatedBy` = `user`.`Id`
	Left Join `jobcategory`
		On `job`.`JobCategory` = `jobcategory`.`Id`
        
WHERE `job`.`CreatedBy` = $_UserID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-21 21:35:03
