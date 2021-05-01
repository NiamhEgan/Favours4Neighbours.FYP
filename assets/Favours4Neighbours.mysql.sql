create Schema `favours4neighbours`;
use favours4neighbours;

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
  `JobStatus` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `job_key` (`JobDetails`,`CreatedBy`,`created_at`),
  KEY `fk_Job_User1_idx` (`CreatedBy`),
  KEY `fk_Job_Status_idx` (`JobStatus`),
  KEY `fk_Job_Assigned_idx` (`AssignedTo`),
  CONSTRAINT `fk_Job_Assigned` FOREIGN KEY (`AssignedTo`) REFERENCES `user` (`Id`),
  CONSTRAINT `fk_Job_Status` FOREIGN KEY (`JobStatus`) REFERENCES `jobstatus` (`Id`),
  CONSTRAINT `fk_Job_User1` FOREIGN KEY (`CreatedBy`) REFERENCES `user` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=123456852 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job`
--

LOCK TABLES `job` WRITE;
/*!40000 ALTER TABLE `job` DISABLE KEYS */;
INSERT INTO `job` VALUES (123457,123,124,'1 hour','No',200,15,'Shopping ',10,1,'2021-03-15 19:52:43','2021-03-15 19:52:43','2021-04-26 09:52:31'),(123456806,NULL,123,'4 hours','No',200,15,'Painitng ',30,1,'2021-04-03 06:57:25','2021-04-03 12:57:25','2021-04-03 06:57:25'),(123456834,NULL,123,'2 hours','none',206,14,'Farming help needed ',5,2,'2021-04-20 06:10:15','2021-04-20 12:10:15','2021-04-20 06:10:45'),(123456835,124,125,'2 hours','equipment provided',202,16,'Outdoor fence needs painting approx 10 meters ',20,2,'2021-04-20 06:30:52','2021-04-20 12:30:52','2021-04-20 06:36:27'),(123456837,NULL,126,'2 hours','Lawnmower',201,5,'   Gardening work neededmoving lawns ',30,1,'2021-04-21 03:25:14','2021-04-21 09:25:14','2021-05-01 09:58:28'),(123456838,NULL,126,'1 hour','car',207,1,'   shopping collected',15,2,'2021-04-21 03:37:16','2021-04-21 09:37:16','2021-05-01 07:07:46'),(123456839,NULL,127,'20 minutes','Car',207,18,'   Shopping Collection',7,2,'2021-04-26 15:59:13','2021-04-26 21:59:13','2021-04-26 15:59:13'),(123456840,NULL,124,'2 hours','Ladder',205,9,'   outdoor lighting needs changing ',0,2,'2021-04-27 10:49:23','2021-04-27 16:49:23','2021-04-27 10:49:23'),(123456841,NULL,128,'30 mins','car',207,18,'   collect shopping from tesco',5,1,'2021-04-28 07:57:38','2021-04-28 13:57:38','2021-04-28 07:57:38'),(123456842,NULL,128,'30 mins','Toolbox',200,16,'   Fix trek 4460',25,2,'2021-04-28 13:14:14','2021-04-28 19:14:14','2021-05-01 03:50:12'),(123456843,NULL,126,'30 minutes','Lead provided',210,8,'   Need very friendly  Elderly Golden Lab Walked ',15,2,'2021-05-01 10:14:43','2021-05-01 16:14:43','2021-05-01 10:14:43'),(123456844,NULL,126,'2 hours ','Please bring your own gloves',201,8,'   Need 3 5ft flowerbeds weeded at the front of the house',20,2,'2021-05-01 10:18:47','2021-05-01 16:18:47','2021-05-01 10:18:47'),(123456845,NULL,126,'4 hours','equipment provided',203,8,'   outdoor fence needs painting approx. 6 meters ',50,2,'2021-05-01 10:21:33','2021-05-01 16:21:33','2021-05-01 10:21:33'),(123456846,NULL,126,'1 hour','equipment provided ',200,8,'   need 2 bicycle chains replaced and put back on ',20,1,'2021-05-01 10:25:34','2021-05-01 16:25:34','2021-05-01 10:31:39'),(123456847,NULL,126,'5 hours ','Hedge Cutter',204,8,'   Hedge Cutting needed for large garen perimeter',75,2,'2021-05-01 10:29:46','2021-05-01 16:29:46','2021-05-01 10:29:46'),(123456848,128,136,'30 mins','Lightbulbs provided please bring your own Screwdrivers ',205,5,'Need 6 outdoor lights changed ',10,2,'2021-05-01 13:06:50','2021-05-01 19:06:50','2021-05-01 16:21:00'),(123456851,130,136,'dkgnwsldngeldknb','sfnbgkjlsfdnbglkjbl',200,5,'bgfekjadesbfkjdasbfgkjdsabgkj  ',47,2,'2021-05-01 17:39:09','2021-05-01 23:39:09','2021-05-01 17:47:02');
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
  `Applicant` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` int NOT NULL DEFAULT '2',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `key_job_applicat` (`Job`,`Applicant`),
  KEY `fk_jobapplicationstatus_idx` (`Status`),
  CONSTRAINT `fk_jobapplicationstatus` FOREIGN KEY (`Status`) REFERENCES `jobapplicationstatus` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobapplication`
--

LOCK TABLES `jobapplication` WRITE;
/*!40000 ALTER TABLE `jobapplication` DISABLE KEYS */;
INSERT INTO `jobapplication` VALUES (28,123456831,123,'2021-04-24 07:31:19','2021-04-24 13:31:19','2021-04-24 07:31:19',2),(34,123456827,127,'2021-04-26 05:36:44','2021-04-26 11:36:44','2021-04-26 05:36:44',2),(35,123456830,126,'2021-04-26 05:37:58','2021-04-26 11:37:58','2021-04-26 05:37:58',2),(36,123456806,127,'2021-04-26 08:18:42','2021-04-26 14:18:42','2021-04-26 08:18:42',2),(37,123456831,127,'2021-04-26 14:28:27','2021-04-26 20:28:27','2021-04-26 14:28:27',2),(38,123456837,127,'2021-04-26 14:41:12','2021-04-26 20:41:12','2021-05-01 07:19:46',4),(39,123456828,126,'2021-04-27 04:11:24','2021-04-27 10:11:24','2021-04-27 04:11:24',2),(40,123456834,124,'2021-04-27 10:48:00','2021-04-27 16:48:00','2021-04-27 10:48:00',2),(41,123456840,126,'2021-04-27 10:53:52','2021-04-27 16:53:52','2021-04-27 10:53:52',3),(42,123456839,126,'2021-04-27 15:27:14','2021-04-27 21:27:14','2021-04-27 15:27:14',4),(43,123456838,123,'2021-04-28 06:55:56','2021-04-28 12:55:56','2021-05-01 07:07:46',1),(44,123456841,126,'2021-04-28 08:00:43','2021-04-28 14:00:43','2021-05-01 13:52:43',3),(45,123456840,128,'2021-04-28 09:33:00','2021-04-28 15:33:00','2021-04-28 09:33:00',2),(46,123456834,128,'2021-04-28 09:40:19','2021-04-28 15:40:19','2021-04-28 09:40:19',2),(47,123456842,126,'2021-04-28 13:52:52','2021-04-28 19:52:52','2021-05-01 03:50:12',1),(48,123456829,126,'2021-05-01 09:59:20','2021-05-01 15:59:20','2021-05-01 09:59:20',2),(49,123456847,136,'2021-05-01 12:46:24','2021-05-01 18:46:24','2021-05-01 14:00:20',3),(50,123456848,133,'2021-05-01 13:31:47','2021-05-01 19:31:47','2021-05-01 13:46:27',1),(51,123456848,130,'2021-05-01 13:35:15','2021-05-01 19:35:15','2021-05-01 13:46:15',3),(52,123456848,128,'2021-05-01 13:51:58','2021-05-01 19:51:58','2021-05-01 16:20:59',1),(53,123456848,129,'2021-05-01 14:08:38','2021-05-01 20:08:38','2021-05-01 14:08:38',2),(54,123456851,130,'2021-05-01 17:46:18','2021-05-01 23:46:18','2021-05-01 17:47:02',1);
/*!40000 ALTER TABLE `jobapplication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobapplicationstatus`
--

DROP TABLE IF EXISTS `jobapplicationstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobapplicationstatus` (
  `Id` int NOT NULL,
  `Name` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name_UNIQUE` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobapplicationstatus`
--

LOCK TABLES `jobapplicationstatus` WRITE;
/*!40000 ALTER TABLE `jobapplicationstatus` DISABLE KEYS */;
INSERT INTO `jobapplicationstatus` VALUES (1,'Accepted'),(2,'Pending'),(3,'Rejected'),(4,'Withdrawn');
/*!40000 ALTER TABLE `jobapplicationstatus` ENABLE KEYS */;
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
INSERT INTO `jobcategory` VALUES (200,'Bike Repairs'),(201,'Gardening'),(202,'Outdoor Repair Work'),(203,'Painting - Outdoors'),(204,'Hedge Cutting'),(205,'Change Lightbulbs - Outdoor'),(206,'Farming'),(207,'Shopping'),(208,'Collection'),(209,'Technical Support'),(210,'Dog Walking'),(211,'Drop/Collect Pet from Vet');
/*!40000 ALTER TABLE `jobcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobstatus`
--

DROP TABLE IF EXISTS `jobstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobstatus` (
  `Id` int NOT NULL,
  `Name` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name_UNIQUE` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobstatus`
--

LOCK TABLES `jobstatus` WRITE;
/*!40000 ALTER TABLE `jobstatus` DISABLE KEYS */;
INSERT INTO `jobstatus` VALUES (1,'Completed'),(2,'Open');
/*!40000 ALTER TABLE `jobstatus` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (123,'neaegan','aab1cb844c7663565888980086184921d0365a15','neaegan@gmail.com',1,'Niamh','Egan','Derry','','V95TV05','0874609667',NULL,1,'2021-04-13 16:10:30','2021-04-13 22:10:30','2021-04-28 14:30:53',NULL,NULL,1),(124,'jane.doe','aab1cb844c7663565888980086184921d0365a15','jane.doe@lit.ie',0,'Jane','Doe','LIT','Moylish','V95TV05','081 123 12',NULL,0,'2021-04-16 10:17:47','2021-04-16 16:17:47','2021-04-16 10:17:47',NULL,NULL,1),(125,'testtest','aab1cb844c7663565888980086184921d0365a15','test@gmail.com',1,'Test','Test','Derry','','V98TY56','0874564569',NULL,0,'2021-04-20 06:23:54','2021-04-20 12:23:54','2021-04-20 06:23:54',NULL,NULL,1),(126,'pault','2c08e8f5884750a7b99f6f2f342fc638db25ff31','pault@gmail.com',1,'Paul','Test','Lahinch','Ennistymon','V95 97456','0874567891',NULL,0,'2021-04-21 03:24:17','2021-04-21 09:24:17','2021-05-01 07:31:45',NULL,NULL,1),(127,'admin','aab1cb844c7663565888980086184921d0365a15','admin@gmail.com',1,'Sarah','Ryan','Favours4Neighbours','','V95TV89','061 711200',NULL,1,'2021-04-24 09:59:43','2021-04-24 09:59:43','2021-04-27 14:31:30',NULL,NULL,6),(128,'jryan','aab1cb844c7663565888980086184921d0365a15','jr@gmail.com',1,'joan','ryan','Limerick','','V95 97456','056 123456',NULL,0,'2021-04-28 07:55:47','2021-04-28 13:55:47','2021-04-28 14:32:00',NULL,NULL,1),(129,'bhaugh','aab1cb844c7663565888980086184921d0365a15','bhaugh@gmail.com',1,'Brid','Haugh','Killybegs','','V89TY29','0874567891',NULL,0,'2021-05-01 10:35:20','2021-05-01 16:35:20','2021-05-01 15:49:00',NULL,NULL,1),(130,'slonge','aab1cb844c7663565888980086184921d0365a15','slonge@gmail.com',1,'Sarah','Longe','Dromore','','V89 456','0894567891',NULL,0,'2021-05-01 11:52:28','2021-05-01 17:52:28','2021-05-01 11:52:28',NULL,NULL,1),(133,'ccurtin','aab1cb844c7663565888980086184921d0365a15','cc@gmail.com',1,'Ciara','Curtin','Clahane','Liscannor','V95 789','0894561234',NULL,0,'2021-05-01 11:59:40','2021-05-01 17:59:40','2021-05-01 11:59:40',NULL,NULL,1),(136,'Myers','aab1cb844c7663565888980086184921d0365a15','mmyers@gmail.com',1,'Mike','Myers','Liscannor Road','Lahinch','V89 123','056789456',NULL,0,'2021-05-01 12:05:46','2021-05-01 18:05:46','2021-05-01 12:19:32',NULL,NULL,1),(137,'Mdaly','aab1cb844c7663565888980086184921d0365a15','mdaly@gmail.com',1,'Mary','Daly','Derry','','h456','0894561234',NULL,0,'2021-05-01 17:52:39','2021-05-01 23:52:39','2021-05-01 17:52:39',NULL,NULL,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'favours4neighbours'
--
/*!50003 DROP PROCEDURE IF EXISTS `GetAllCompletedJobs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllCompletedJobs`()
BEGIN
SELECT `job`.`Id` as Id,
    `job`.`JobDetails`,
    `job`.`created_at`,
    `job`.`updated_at`,
    
    
    AssignedToUser.`Id` as AssignedId,
    AssignedToUser.`Username` as AssignedUsername,
    concat(`AssignedToUser`.`FirstName`, " ", `AssignedToUser`.`Surname`) as AssignedUserFullName,
  
    `CreatedByUser`.`Id` as CreatedByUserId,
    `CreatedByUser`.`Username` as CreatedByUsername,
    concat(`CreatedByUser`.`FirstName`, " ", `CreatedByUser`.`Surname`) as CreatedByUserFullName


FROM `favours4neighbours`.`job`
	Left Join `user` AssignedToUser
		On `job`.`AssignedTo` = AssignedToUser.`Id`
	Left Join `user` CreatedByUser
		On `job`.`CreatedBy` = CreatedByUser.`Id`
	WHERE `job`.`JobStatus` = 1 -- 1 marks completed jobs
    ;
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
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
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
-- `job`.`JobCounty`,
    `county`.`county` as JobCounty,

    `user`.`Username` as AssignedUsername,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as AssignedUserFullName,
    
    `jobcategory`.`Id` as JobCategoryId,
    `jobcategory`.`JobCategory`


FROM `favours4neighbours`.`job`
	Left Join `user`
		On `job`.`CreatedBy` = `user`.`Id`
	Left Join `jobcategory`
		On `job`.`JobCategory` = `jobcategory`.`Id`
	Inner Join `county`
		On `job`.`JobCounty` = `county`.`ID_county`

WHERE `job`.`CreatedBy` != $_UserID
	AND `job`.`AssignedTo` is null -- Availible Jobs
	AND `job`.`JobStatus` = 2 -- 2 MEANS jOB IS OPEN,

ORDER BY
	  `job`.`updated_at` DESC
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationsAcceptedViewByApplicant` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationsAcceptedViewByApplicant`(IN `$ApplicantId` INT)
BEGIN
CAll GetJobApplicationsViewByApplicantAndStatus($ApplicantId, 1); -- 1 is for Accepted
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationsPendingViewByApplicant` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationsPendingViewByApplicant`(IN `$ApplicantId` INT)
BEGIN
CAll GetJobApplicationsViewByApplicantAndStatus($ApplicantId, 2); -- 2 is for Pending
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationsRecievedView` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationsRecievedView`(IN `$_UserID` INT)
BEGIN
SELECT  `jobapplication`.`Id`,
    `jobapplication`.`created_at`,

    `user`.`Id` as UserId,
    `user`.`Username` as Username,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as UserFullName,
    
    `job`.`Id` as JobId,
    `job`.`JobDetails`
FROM `jobapplication`
	Inner Join `job`
		On `jobapplication`.`Job` = `Job`.`Id`
	Inner Join `user`
		On `jobapplication`.`Applicant` = `user`.`Id`
WHERE `job`.`CreatedBy` = $_UserId
	AND `job`.`AssignedTo` is null -- Availible Jobs
    AND `jobapplication`.`Status` = 2 -- Job STATUS IS OPEN
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationsRejectedViewByApplicant` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationsRejectedViewByApplicant`(IN `$ApplicantId` INT)
BEGIN
CAll GetJobApplicationsViewByApplicantAndStatus($ApplicantId, 3); -- 3 is for Rejected
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
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
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
		On `jobapplication`.`Applicant` = `user`.`Id`
	Left Join `job`
		On `jobapplication`.`Job` = `jobapplication`.`Job`;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationsViewByApplicant` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationsViewByApplicant`(IN `$_ApplicantId` INT)
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
		On `jobapplication`.`Applicant` = `user`.`Id`
WHERE `jobapplication`.`Applicant` = $_ApplicantId
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationsViewByApplicantAndStatus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationsViewByApplicantAndStatus`(IN $ApplicantId INT, In $StatusId INT)
BEGIN
SELECT  `jobapplication`.`Id`,
    `jobapplication`.`created_at`,
    
    `user`.`Username` as Username,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as UserFullName,
    
    `job`.`Id` as JobId,
    `job`.`JobDetails`,
    `job`.`created_at`
FROM `jobapplication`
	Inner Join `job`
		On `jobapplication`.`Job` = `Job`.`Id`
	Inner Join `user`
		On `jobapplication`.`Applicant` = `user`.`Id`
WHERE `jobapplication`.`Applicant` = $ApplicantId
	AND `jobapplication`.`Status` = $StatusId
;
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
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
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
		On `jobapplication`.`Applicant` = `user`.`Id`
WHERE `jobapplication`.`Job` = $_JobId
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobApplicationsWithdrawnViewByApplicant` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobApplicationsWithdrawnViewByApplicant`(IN `$ApplicantId` INT)
BEGIN
CAll GetJobApplicationsViewByApplicantAndStatus($ApplicantId, 4); -- 4 is Withdrawn
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
/*!50003 DROP PROCEDURE IF EXISTS `GetJobsCompletedByApplicant` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobsCompletedByApplicant`(IN $applicantId INT)
BEGIN
SELECT `job`.`Id` as Id,
    `job`.`JobDetails`,
    `job`.`JobPrice`,
    `job`.`EquipmentRequired`,
    `job`.`DurationEstimate`,
    `job`.`created_at`,
    `job`.`updated_at`,
    
    AssignedToUser.`Id` as AssignedId,
    AssignedToUser.`Username` as AssignedUsername,
    concat(`AssignedToUser`.`FirstName`, " ", `AssignedToUser`.`Surname`) as AssignedUserFullName,
  
    `CreatedByUser`.`Id` as CreatedByUserId,
    `CreatedByUser`.`Username` as CreatedByUsername,
    concat(`CreatedByUser`.`FirstName`, " ", `CreatedByUser`.`Surname`) as CreatedByUserFullName

FROM `favours4neighbours`.`job`
	Left Join `user` AssignedToUser
		On `job`.`AssignedTo` = AssignedToUser.`Id`
	Left Join `user` CreatedByUser
		On `job`.`CreatedBy` = CreatedByUser.`Id`
WHERE `job`.`JobStatus` = 1 -- 1 marks completed jobs
	AND  `job`.`AssignedTo` = $applicantId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetJobViewById` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetJobViewById`(IN `$jobId` INT)
BEGIN
SELECT `job`.`Id` as Id,
    `job`.`CreatedBy`,
    `job`.`JobDetails`,
    `job`.`JobStatus`,
    `job`.`EquipmentRequired`,
    `job`.`DurationEstimate`,
    `job`.`JobPrice`,
    `job`.`AssignedTo`,
    `job`.`updated_at`,
    `county`.`county` as JobCounty,

    `user`.`Username` as AssignedUsername,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as AssignedUserFullName,
    
    `jobcategory`.`Id` as JobCategoryId,
    `jobcategory`.`JobCategory`

FROM `favours4neighbours`.`job`
	Left Join `user`
		On `job`.`CreatedBy` = `user`.`Id`
	Inner Join `jobcategory`
		On `job`.`JobCategory` = `jobcategory`.`Id`
	Inner Join `county`
		On `job`.`JobCounty` = `county`.`ID_county`

WHERE `job`.`Id` = $jobId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GetMyCompletedJobs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMyCompletedJobs`(IN `$_UserID` INT)
BEGIN
SELECT `job`.`Id` as Id,
    `job`.`JobDetails`,
    `job`.`CreatedBy`,
  
    `user`.`Id` as AssignedId,
    `user`.`Username` as AssignedUsername,
    concat(`user`.`FirstName`, " ", `user`.`Surname`) as AssignedUserFullName,
    
    `JobStatus`.`Id` as JobStatusId,
    `JobStatus`.`Name` as JobStatus


FROM `favours4neighbours`.`job`
	Left Join `user`
		On `job`.`AssignedTo` = `user`.`Id`
	Left Join `JobStatus`
		On `job`.`JobStatus` = `JobStatus`.`Id`
        
WHERE `job`.`AssignedTo` = $_UserID;
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
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
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

    `user`.`Id` as AssignedId,
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
/*!50003 DROP PROCEDURE IF EXISTS `SearchUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SearchUser`(IN $searchInput VARCHAR(45))
BEGIN
SELECT `user`.`Id`,
    `user`.`Username`,
    `user`.`Password`,
    `user`.`email`,
    `user`.`Active`,
    `user`.`FirstName`,
    `user`.`Surname`,
    `user`.`AddressLine1`,
    `user`.`AddressLine2`,
    `user`.`Eircode`,
    `user`.`Telephone`,
    `user`.`Gender`,
    `user`.`IsAdmin`,
    `user`.`DateCreated`,
    `user`.`deleted_at`,
    `user`.`DateModified`,
    `user`.`Photo`,
    `user`.`Bio`,
    `user`.`County`
FROM `favours4neighbours`.`user`
WHERE
    `user`.`Username` like $searchInput
	OR `user`.`FirstName` like $searchInput
    Or `user`.`Surname` like $searchInput
    OR `user`.`email` like $searchInput
    OR `user`.`Telephone` like $searchInput
	OR `user`.`Id` like $searchInput
;
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

-- Dump completed on 2021-05-02  0:05:51
