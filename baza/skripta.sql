-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema cars
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cars
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cars` DEFAULT CHARACTER SET utf8mb4 ;
USE `cars` ;

-- -----------------------------------------------------
-- Table `cars`.`nalozi`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cars`.`nalozi` (
  `nalog_id` INT NOT NULL AUTO_INCREMENT,
  `tip` INT NOT NULL,
  PRIMARY KEY (`nalog_id`),
  UNIQUE INDEX `korisnik_id_UNIQUE` (`nalog_id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cars`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cars`.`admin` (
  `admin_id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(80) NOT NULL,
  `password` VARCHAR(80) NOT NULL,
  `ime` VARCHAR(45) NULL,
  `prezime` VARCHAR(45) NULL,
  `nalog_id` INT NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE INDEX `admin_id_UNIQUE` (`admin_id` ASC) VISIBLE,
  INDEX `fk_admin_korsinik1_idx` (`nalog_id` ASC) VISIBLE,
  CONSTRAINT `fk_admin_korsinik1`
    FOREIGN KEY (`nalog_id`)
    REFERENCES `cars`.`nalozi` (`nalog_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cars`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cars`.`korisnik` (
  `korisnik_id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(80) NOT NULL,
  `password` VARCHAR(80) NOT NULL,
  `ime` VARCHAR(45) NULL,
  `prezime` VARCHAR(45) NULL,
  `mesto` VARCHAR(45) NOT NULL,
  `mobilni` VARCHAR(45) NOT NULL,
  `nalog_id` INT NOT NULL,
  PRIMARY KEY (`korisnik_id`),
  UNIQUE INDEX `korisnik_id_UNIQUE` (`korisnik_id` ASC) VISIBLE,
  INDEX `fk_zaposleni_korsinik_idx` (`nalog_id` ASC) VISIBLE,
  CONSTRAINT `fk_zaposleni_korsinik`
    FOREIGN KEY (`nalog_id`)
    REFERENCES `cars`.`nalozi` (`nalog_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cars`.`oglasi`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cars`.`oglasi` (
  `oglas_id` INT NOT NULL AUTO_INCREMENT,
  `marka` VARCHAR(45) NOT NULL,
  `godiste` INT NOT NULL,
  `kilometraza` INT NOT NULL,
  `cena` INT NOT NULL,
  `pogon` VARCHAR(45) NOT NULL,
  `menjac` VARCHAR(45) NOT NULL,
  `karoserija` VARCHAR(45) NOT NULL,
  `gorivo` VARCHAR(45) NOT NULL,
  `kubikaza` VARCHAR(45) NOT NULL,
  `snaga` VARCHAR(45) NOT NULL,
  `emisiona_klasa` VARCHAR(45) NOT NULL,
  `broj_vrata` VARCHAR(45) NOT NULL,
  `broj_sedista` VARCHAR(45) NOT NULL,
  `klima` VARCHAR(45) NOT NULL,
  `volan` VARCHAR(45) NOT NULL,
  `opis_oglasa` VARCHAR(1000) NOT NULL,
  `korisnik_id` INT NOT NULL,
  `admin_id` INT NULL,
  PRIMARY KEY (`oglas_id`),
  UNIQUE INDEX `idOglas_UNIQUE` (`oglas_id` ASC) VISIBLE,
  INDEX `fk_Oglas_zaposleni1_idx` (`korisnik_id` ASC) VISIBLE,
  INDEX `fk_Oglas_admin1_idx` (`admin_id` ASC) VISIBLE,
  CONSTRAINT `fk_Oglas_zaposleni1`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `cars`.`korisnik` (`korisnik_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Oglas_admin1`
    FOREIGN KEY (`admin_id`)
    REFERENCES `cars`.`admin` (`admin_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cars`.`slika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cars`.`slika` (
  `slika_id` INT NOT NULL AUTO_INCREMENT,
  `hash` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`slika_id`),
  UNIQUE INDEX `slika_id_UNIQUE` (`slika_id` ASC) VISIBLE,
  UNIQUE INDEX `hash_UNIQUE` (`hash` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cars`.`oglas_ima_sliku`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cars`.`oglas_ima_sliku` (
  `oglas_id` INT NOT NULL,
  `slika_id` INT NOT NULL,
  PRIMARY KEY (`oglas_id`, `slika_id`),
  INDEX `fk_oglas_ima_sliku_slika1_idx` (`slika_id` ASC) VISIBLE,
  CONSTRAINT `fk_oglas_ima_sliku_oglasi1`
    FOREIGN KEY (`oglas_id`)
    REFERENCES `cars`.`oglasi` (`oglas_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_oglas_ima_sliku_slika1`
    FOREIGN KEY (`slika_id`)
    REFERENCES `cars`.`slika` (`slika_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `cars`.`nalozi`
-- -----------------------------------------------------
START TRANSACTION;
USE `cars`;
INSERT INTO `cars`.`nalozi` (`nalog_id`, `tip`) VALUES (1, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `cars`.`admin`
-- -----------------------------------------------------
START TRANSACTION;
USE `cars`;
INSERT INTO `cars`.`admin` (`admin_id`, `email`, `password`, `ime`, `prezime`, `nalog_id`) VALUES (DEFAULT, 'admin@1.1', '$2y$10$17hZo8MY8Bh6gNeU4WmV1uILiRLJceY1eepkomnh9xeG6REj2A8ti', NULL, NULL, 1);

COMMIT;

