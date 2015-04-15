-- MySQL Script generated by MySQL Workbench
-- 04/06/15 19:56:08
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema MAIL
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `MAIL` ;

-- -----------------------------------------------------
-- Schema MAIL
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `MAIL` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `MAIL` ;

-- -----------------------------------------------------
-- Table `MAIL`.`Genders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MAIL`.`Genders` ;

CREATE TABLE IF NOT EXISTS `MAIL`.`Genders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `MAIL`.`User_Types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MAIL`.`User_Types` ;

CREATE TABLE IF NOT EXISTS `MAIL`.`User_Types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `MAIL`.`Departments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MAIL`.`Departments` ;

CREATE TABLE IF NOT EXISTS `MAIL`.`Departments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `MAIL`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MAIL`.`Users` ;

CREATE TABLE IF NOT EXISTS `MAIL`.`Users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `department_id` INT NULL,
  `gender_id` INT NULL,
  `user_type_id` INT NULL,
  `password` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `first_name` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `last_name` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`, `email`),
  INDEX `gender_id_idx` (`gender_id` ASC),
  INDEX `department_id_idx` (`department_id` ASC),
  INDEX `user_type_id_idx` (`user_type_id` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `MAIL`.`Mails`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MAIL`.`Mails` ;

CREATE TABLE IF NOT EXISTS `MAIL`.`Mails` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NULL,
  `subject` VARCHAR(1000) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `content` VARCHAR(1000) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `people_id_idx` (`user_id` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `MAIL`.`Files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MAIL`.`Files` ;

CREATE TABLE IF NOT EXISTS `MAIL`.`Files` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mail_id` INT NULL,
  `name` VARCHAR(1000) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `mail_id_idx` (`mail_id` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `MAIL`.`Mark_States`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MAIL`.`Mark_States` ;

CREATE TABLE IF NOT EXISTS `MAIL`.`Mark_States` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `MAIL`.`Recipients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MAIL`.`Recipients` ;

CREATE TABLE IF NOT EXISTS `MAIL`.`Recipients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `mark_state_id` INT NULL,
  `mail_id` INT NULL,
  `user_id` INT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `to_id_idx` (`user_id` ASC),
  INDEX `mail_id_idx` (`mail_id` ASC),
  INDEX `mark_state_id_idx` (`mark_state_id` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `MAIL`.`Notices`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MAIL`.`Notices` ;

CREATE TABLE IF NOT EXISTS `MAIL`.`Notices` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NULL,
  `name` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `people_id_idx` (`user_id` ASC))
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
