SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `examinator` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `examinator` ;

-- -----------------------------------------------------
-- Table `examinator`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examinator`.`usuarios` ;

CREATE  TABLE IF NOT EXISTS `examinator`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT ,
  `correo_usuario` VARCHAR(50) NOT NULL ,
  `password_usuario` VARCHAR(10) NOT NULL ,
  `nombre_usuario` VARCHAR(200) NOT NULL ,
  `telefono_usuario` VARCHAR(50) NULL ,
  PRIMARY KEY (`id_usuario`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_usuario_UNIQUE` ON `examinator`.`usuarios` (`id_usuario` ASC) ;

CREATE UNIQUE INDEX `correo_usuario_UNIQUE` ON `examinator`.`usuarios` (`correo_usuario` ASC) ;


-- -----------------------------------------------------
-- Table `examinator`.`examen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examinator`.`examen` ;

CREATE  TABLE IF NOT EXISTS `examinator`.`examen` (
  `id_examen` INT NOT NULL AUTO_INCREMENT ,
  `descripcion_examen` VARCHAR(50) NULL ,
  `nombre_examen` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`id_examen`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_examen_UNIQUE` ON `examinator`.`examen` (`id_examen` ASC) ;


-- -----------------------------------------------------
-- Table `examinator`.`seccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examinator`.`seccion` ;

CREATE  TABLE IF NOT EXISTS `examinator`.`seccion` (
  `id_seccion` INT NOT NULL AUTO_INCREMENT ,
  `id_examen` INT NOT NULL ,
  `nombre_seccion` VARCHAR(50) NOT NULL ,
  `tiempo_seccion` INT NOT NULL ,
  PRIMARY KEY (`id_seccion`) ,
  CONSTRAINT `fk_id_examen`
    FOREIGN KEY (`id_examen` )
    REFERENCES `examinator`.`examen` (`id_examen` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_seccion_UNIQUE` ON `examinator`.`seccion` (`id_seccion` ASC) ;

CREATE INDEX `fk_id_examen_idx` ON `examinator`.`seccion` (`id_examen` ASC) ;


-- -----------------------------------------------------
-- Table `examinator`.`pregunta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examinator`.`pregunta` ;

CREATE  TABLE IF NOT EXISTS `examinator`.`pregunta` (
  `id_pregunta` INT NOT NULL AUTO_INCREMENT ,
  `id_seccion` INT NOT NULL ,
  `pregunta` VARCHAR(200) NOT NULL ,
  `resp1` VARCHAR(100) NULL ,
  `resp2` VARCHAR(100) NULL ,
  `resp3` VARCHAR(100) NULL ,
  `resp4` VARCHAR(100) NULL ,
  `respcor` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_pregunta`) ,
  CONSTRAINT `fk_id_pregunta`
    FOREIGN KEY (`id_seccion` )
    REFERENCES `examinator`.`seccion` (`id_seccion` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_pregunta_UNIQUE` ON `examinator`.`pregunta` (`id_pregunta` ASC) ;

CREATE INDEX `fk_id_pregunta_idx` ON `examinator`.`pregunta` (`id_seccion` ASC) ;


-- -----------------------------------------------------
-- Table `examinator`.`examinado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examinator`.`examinado` ;

CREATE  TABLE IF NOT EXISTS `examinator`.`examinado` (
  `id_examinado` INT NOT NULL AUTO_INCREMENT ,
  `id_examen` INT NOT NULL ,
  `id_usr_registro` INT NOT NULL ,
  `fecha_registro` DATE NOT NULL ,
  `clave_candidato` VARCHAR(10) NOT NULL ,
  `archivo_cv` VARCHAR(30) NULL ,
  `nombre_examinado` VARCHAR(200) NOT NULL ,
  `edad_examinado` INT NOT NULL ,
  `domicilio_examinado` VARCHAR(200) NOT NULL ,
  `curp_examinado` VARCHAR(20) NOT NULL ,
  `email_examinado` VARCHAR(200) NOT NULL ,
  `telefono_examinado` VARCHAR(50) NULL ,
  `celular_examinado` VARCHAR(50) NULL ,
  PRIMARY KEY (`id_examinado`) ,
  CONSTRAINT `fk_id_examen`
    FOREIGN KEY (`id_examen` )
    REFERENCES `examinator`.`examen` (`id_examen` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usr_registro`
    FOREIGN KEY (`id_usr_registro` )
    REFERENCES `examinator`.`usuarios` (`id_usuario` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_examinado_UNIQUE` ON `examinator`.`examinado` (`id_examinado` ASC) ;

CREATE INDEX `fk_id_examen_idx` ON `examinator`.`examinado` (`id_examen` ASC) ;

CREATE UNIQUE INDEX `clave_candidato_UNIQUE` ON `examinator`.`examinado` (`clave_candidato` ASC) ;

CREATE INDEX `fk_usr_registro_idx` ON `examinator`.`examinado` (`id_usr_registro` ASC) ;


-- -----------------------------------------------------
-- Table `examinator`.`respexam`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `examinator`.`respexam` ;

CREATE  TABLE IF NOT EXISTS `examinator`.`respexam` (
  `id_respexam` INT NOT NULL AUTO_INCREMENT ,
  `id_examen` INT NOT NULL ,
  `id_seccion` INT NOT NULL ,
  `id_examinado` INT NOT NULL ,
  `respcorrectas` INT NOT NULL ,
  PRIMARY KEY (`id_respexam`) ,
  CONSTRAINT `fk_id_examen`
    FOREIGN KEY (`id_examen` )
    REFERENCES `examinator`.`examen` (`id_examen` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_seccion`
    FOREIGN KEY (`id_seccion` )
    REFERENCES `examinator`.`seccion` (`id_seccion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_examinado`
    FOREIGN KEY (`id_examinado` )
    REFERENCES `examinator`.`examinado` (`id_examinado` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_respexam_UNIQUE` ON `examinator`.`respexam` (`id_respexam` ASC) ;

CREATE INDEX `fk_id_examen_idx` ON `examinator`.`respexam` (`id_examen` ASC) ;

CREATE INDEX `fk_id_seccion_idx` ON `examinator`.`respexam` (`id_seccion` ASC) ;

CREATE INDEX `fk_id_examinado_idx` ON `examinator`.`respexam` (`id_examinado` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
