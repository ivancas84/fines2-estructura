-- MySQL Workbench Synchronization
-- Generated: 2019-11-25 19:26
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: ivan

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `fines2_2020` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;

CREATE TABLE IF NOT EXISTS `fines2_2020`.`centro_educativo` (
  `id` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `cue` VARCHAR(45) NULL DEFAULT NULL,
  `domicilio` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_centro_educativo_domicilio1_idx` (`domicilio` ASC) ,
  UNIQUE INDEX `cue_UNIQUE` (`cue` ASC) ,
  CONSTRAINT `fk_centro_educativo_domicilio1`
    FOREIGN KEY (`domicilio`)
    REFERENCES `fines2_2020`.`domicilio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `fines2_2020`.`domicilio` (
  `id` VARCHAR(45) NOT NULL,
  `calle` VARCHAR(45) NOT NULL,
  `entre` VARCHAR(45) NULL DEFAULT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `piso` VARCHAR(45) NULL DEFAULT NULL,
  `departamento` VARCHAR(45) NULL DEFAULT NULL,
  `barrio` VARCHAR(255) NULL DEFAULT NULL,
  `localidad` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `fines2_2020`.`sede` (
  `id` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `observaciones` TEXT NULL DEFAULT NULL,
  `alta` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `baja` TIMESTAMP NULL DEFAULT NULL,
  `domicilio` VARCHAR(45) NULL DEFAULT NULL,
  `tipo_sede` VARCHAR(45) NULL DEFAULT NULL,
  `centro_educativo` VARCHAR(45) NULL DEFAULT NULL,
  INDEX `fk_sede_domicilio1_idx` (`domicilio` ASC) ,
  INDEX `fk_sede_tipo_sede1_idx` (`tipo_sede` ASC) ,
  INDEX `fk_sede_centro_educativo1_idx` (`centro_educativo` ASC) ,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_sede_domicilio1`
    FOREIGN KEY (`domicilio`)
    REFERENCES `fines2_2020`.`domicilio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sede_tipo_sede1`
    FOREIGN KEY (`tipo_sede`)
    REFERENCES `fines2_2020`.`tipo_sede` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sede_centro_educativo1`
    FOREIGN KEY (`centro_educativo`)
    REFERENCES `fines2_2020`.`centro_educativo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `fines2_2020`.`tipo_sede` (
  `id` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
