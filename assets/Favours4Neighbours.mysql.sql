-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema favours4neighbours
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `favours4neighbours` ;

-- -----------------------------------------------------
-- Schema favours4neighbours
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `favours4neighbours` DEFAULT CHARACTER SET utf8 ;
USE `favours4neighbours` ;

-- -----------------------------------------------------
-- Table `favours4neighbours`.`county`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`county` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`county` (
  `ID_county` INT(11) NOT NULL AUTO_INCREMENT,
  `county` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`ID_county`))
ENGINE = InnoDB
AUTO_INCREMENT = 33
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`user` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`user` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Username` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `Active` TINYINT(4) NOT NULL DEFAULT 1,
  `FirstName` VARCHAR(45) NULL DEFAULT NULL,
  `Surname` VARCHAR(45) NOT NULL,
  `AddressLine1` VARCHAR(45) NOT NULL,
  `AddressLine2` VARCHAR(45) NULL DEFAULT NULL,
  `Eircode` VARCHAR(45) NOT NULL,
  `Telephone` VARCHAR(10) NOT NULL,
  `Gender` VARCHAR(10) NULL DEFAULT NULL,
  `IsAdmin` TINYINT(4) NOT NULL DEFAULT 0,
  `DateCreated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `deleted_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `DateModified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `Photo` VARCHAR(45) NULL DEFAULT NULL,
  `Bio` VARCHAR(500) NULL DEFAULT NULL,
  `County` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Username_UNIQUE` (`Username` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 123
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`job`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`job` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`job` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `CreatedBy` INT(11) NOT NULL,
  `JobDetails` VARCHAR(500) NOT NULL,
  `JobStatus` VARCHAR(25) NULL DEFAULT NULL,
  `EquipmentRequired` VARCHAR(100) NOT NULL,
  `DurationEstimate` VARCHAR(45) NOT NULL,
  `JobPrice` FLOAT NULL DEFAULT NULL,
  `DateCreated` DATE NULL DEFAULT NULL,
  `AssignedTo` VARCHAR(45) NULL DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `deleted_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `JobCategory` INT(11) NULL DEFAULT NULL,
  `JobCounty` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_Job_User1_idx` (`CreatedBy` ASC),
  CONSTRAINT `fk_Job_User1`
    FOREIGN KEY (`CreatedBy`)
    REFERENCES `favours4neighbours`.`user` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 123456826
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`jobapplication`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`jobapplication` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`jobapplication` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Job` VARCHAR(45) NOT NULL,
  `User` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `deleted_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `Status` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`jobcategory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`jobcategory` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`jobcategory` (
  `Id` INT(11) NOT NULL,
  `JobCategory` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`tag` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`tag` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`jobtag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`jobtag` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`jobtag` (
  `Job_Id` INT(11) NOT NULL,
  `Tag_Id` INT(11) NOT NULL,
  PRIMARY KEY (`Job_Id`, `Tag_Id`),
  INDEX `fk_Job_has_Tag_Tag1_idx` (`Tag_Id` ASC),
  INDEX `fk_Job_has_Tag_Job1_idx` (`Job_Id` ASC),
  CONSTRAINT `fk_Job_has_Tag_Job1`
    FOREIGN KEY (`Job_Id`)
    REFERENCES `favours4neighbours`.`job` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Job_has_Tag_Tag1`
    FOREIGN KEY (`Tag_Id`)
    REFERENCES `favours4neighbours`.`tag` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`userdetails`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`userdetails` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`userdetails` (
  `ID` INT(11) NOT NULL AUTO_INCREMENT,
  `userFirstName` VARCHAR(45) NOT NULL,
  `userSurname` VARCHAR(45) NOT NULL,
  `userAddress1` VARCHAR(45) NOT NULL,
  `userAddress2` VARCHAR(45) NULL DEFAULT NULL,
  `userEircode` VARCHAR(45) NOT NULL,
  `userPhone` INT(10) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`userjobskill`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`userjobskill` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`userjobskill` (
  `User_Id` INT(11) NOT NULL,
  `Tag_Id` INT(11) NOT NULL,
  PRIMARY KEY (`User_Id`, `Tag_Id`),
  INDEX `fk_User_has_Tag_Tag1_idx` (`Tag_Id` ASC),
  INDEX `fk_User_has_Tag_User1_idx` (`User_Id` ASC),
  CONSTRAINT `fk_User_has_Tag_Tag1`
    FOREIGN KEY (`Tag_Id`)
    REFERENCES `favours4neighbours`.`tag` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Tag_User1`
    FOREIGN KEY (`User_Id`)
    REFERENCES `favours4neighbours`.`user` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`userrole`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`userrole` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`userrole` (
  `Id` INT(11) NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Description` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`userrolelink`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`userrolelink` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`userrolelink` (
  `UserRoleId` INT(11) NOT NULL,
  `UserId` INT(11) NOT NULL,
  PRIMARY KEY (`UserRoleId`, `UserId`),
  INDEX `fk_UserRole_has_User_User1_idx` (`UserId` ASC),
  INDEX `fk_UserRole_has_User_UserRole_idx` (`UserRoleId` ASC),
  CONSTRAINT `fk_UserRole_has_User_User1`
    FOREIGN KEY (`UserId`)
    REFERENCES `favours4neighbours`.`user` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UserRole_has_User_UserRole`
    FOREIGN KEY (`UserRoleId`)
    REFERENCES `favours4neighbours`.`userrole` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `favours4neighbours` ;

-- -----------------------------------------------------
-- procedure GetJobs
-- -----------------------------------------------------

USE `favours4neighbours`;
DROP procedure IF EXISTS `favours4neighbours`.`GetJobs`;

DELIMITER $$
USE `favours4neighbours`$$
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
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure GetMyJobs
-- -----------------------------------------------------

USE `favours4neighbours`;
DROP procedure IF EXISTS `favours4neighbours`.`GetMyJobs`;

DELIMITER $$
USE `favours4neighbours`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMyJobs`(In $_UserID INT)
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
END$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure MyJobs
-- -----------------------------------------------------

USE `favours4neighbours`;
DROP procedure IF EXISTS `favours4neighbours`.`MyJobs`;

DELIMITER $$
USE `favours4neighbours`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `MyJobs`()
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
END$$

DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
