-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

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
-- Table `favours4neighbours`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`User` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`User` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Username` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NULL,
  `Active` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Username_UNIQUE` (`Username` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`UserRole`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`UserRole` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`UserRole` (
  `Id` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `Description` VARCHAR(45) NULL,
  PRIMARY KEY (`Id`),
  UNIQUE INDEX `Name_UNIQUE` (`Name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`UserRoleLink`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`UserRoleLink` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`UserRoleLink` (
  `UserRoleId` INT NOT NULL,
  `UserId` INT NOT NULL,
  PRIMARY KEY (`UserRoleId`, `UserId`),
  INDEX `fk_UserRole_has_User_User1_idx` (`UserId` ASC),
  INDEX `fk_UserRole_has_User_UserRole_idx` (`UserRoleId` ASC),
  CONSTRAINT `fk_UserRole_has_User_UserRole`
    FOREIGN KEY (`UserRoleId`)
    REFERENCES `favours4neighbours`.`UserRole` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UserRole_has_User_User1`
    FOREIGN KEY (`UserId`)
    REFERENCES `favours4neighbours`.`User` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`Job`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`Job` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`Job` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `CreatedBy` INT NOT NULL,
  `DateCreated` DATETIME NULL,
  INDEX `fk_Job_User1_idx` (`CreatedBy` ASC),
  PRIMARY KEY (`Id`),
  CONSTRAINT `fk_Job_User1`
    FOREIGN KEY (`CreatedBy`)
    REFERENCES `favours4neighbours`.`User` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`Tag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`Tag` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`Tag` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`JobTag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`JobTag` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`JobTag` (
  `Job_Id` INT NOT NULL,
  `Tag_Id` INT NOT NULL,
  PRIMARY KEY (`Job_Id`, `Tag_Id`),
  INDEX `fk_Job_has_Tag_Tag1_idx` (`Tag_Id` ASC),
  INDEX `fk_Job_has_Tag_Job1_idx` (`Job_Id` ASC),
  CONSTRAINT `fk_Job_has_Tag_Job1`
    FOREIGN KEY (`Job_Id`)
    REFERENCES `favours4neighbours`.`Job` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Job_has_Tag_Tag1`
    FOREIGN KEY (`Tag_Id`)
    REFERENCES `favours4neighbours`.`Tag` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `favours4neighbours`.`UserJobSkill`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `favours4neighbours`.`UserJobSkill` ;

CREATE TABLE IF NOT EXISTS `favours4neighbours`.`UserJobSkill` (
  `User_Id` INT NOT NULL,
  `Tag_Id` INT NOT NULL,
  PRIMARY KEY (`User_Id`, `Tag_Id`),
  INDEX `fk_User_has_Tag_Tag1_idx` (`Tag_Id` ASC),
  INDEX `fk_User_has_Tag_User1_idx` (`User_Id` ASC),
  CONSTRAINT `fk_User_has_Tag_User1`
    FOREIGN KEY (`User_Id`)
    REFERENCES `favours4neighbours`.`User` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_has_Tag_Tag1`
    FOREIGN KEY (`Tag_Id`)
    REFERENCES `favours4neighbours`.`Tag` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
