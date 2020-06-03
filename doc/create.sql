CREATE SCHEMA IF NOT EXISTS `planfi10_20203` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE planfi10_20203;



CREATE TABLE IF NOT EXISTS `planfi10_20203`.`domicilio` (
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

CREATE TABLE IF NOT EXISTS `planfi10_20203`.`centro_educativo` (
  `id` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `cue` VARCHAR(45) NULL DEFAULT NULL,
  `domicilio` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_centro_educativo_domicilio1_idx` (`domicilio` ASC),
  UNIQUE INDEX `cue_UNIQUE` (`cue` ASC),
  CONSTRAINT `fk_centro_educativo_domicilio1`
    FOREIGN KEY (`domicilio`)
    REFERENCES `planfi10_20203`.`domicilio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `planfi10_20203`.`tipo_sede` (
  `id` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `descripcion_UNIQUE` (`descripcion` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `planfi10_20203`.`sede` (
  `id` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `observaciones` TEXT NULL DEFAULT NULL,
  `alta` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `baja` TIMESTAMP NULL DEFAULT NULL,
  `domicilio` VARCHAR(45) NULL DEFAULT NULL,
  `tipo_sede` VARCHAR(45) NULL DEFAULT NULL,
  `centro_educativo` VARCHAR(45) NULL DEFAULT NULL,
  INDEX `fk_sede_domicilio1_idx` (`domicilio` ASC),
  INDEX `fk_sede_tipo_sede1_idx` (`tipo_sede` ASC),
  INDEX `fk_sede_centro_educativo1_idx` (`centro_educativo` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_sede_domicilio1`
    FOREIGN KEY (`domicilio`)
    REFERENCES `planfi10_20203`.`domicilio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sede_tipo_sede1`
    FOREIGN KEY (`tipo_sede`)
    REFERENCES `planfi10_20203`.`tipo_sede` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sede_centro_educativo1`
    FOREIGN KEY (`centro_educativo`)
    REFERENCES `planfi10_20203`.`centro_educativo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `planfi10_20203`.`persona` (
  `id` VARCHAR(45) NOT NULL,
  `nombres` VARCHAR(255) NOT NULL,
  `apellidos` VARCHAR(255) NULL DEFAULT NULL,
  `fecha_nacimiento` DATE NULL DEFAULT NULL,
  `numero_documento` VARCHAR(45) NOT NULL,
  `cuil` VARCHAR(45) NULL DEFAULT NULL,
  `genero` VARCHAR(45) NULL DEFAULT NULL,
  `apodo` VARCHAR(255) NULL DEFAULT NULL,
  `alta` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `domicilio` VARCHAR(45) NULL DEFAULT NULL,
  UNIQUE INDEX `cuil_UNIQUE` (`cuil` ASC),
  UNIQUE INDEX `numero_documento_UNIQUE` (`numero_documento` ASC),
  PRIMARY KEY (`id`),
  INDEX `fk_persona_domicilio1_idx` (`domicilio` ASC),
  CONSTRAINT `fk_persona_domicilio1`
    FOREIGN KEY (`domicilio`)
    REFERENCES `planfi10_20203`.`domicilio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `planfi10_20203`.`cargo` (
  `id` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `descripcion_UNIQUE` (`descripcion` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `planfi10_20203`.`designacion` (
  `id` VARCHAR(45) NOT NULL,
  `desde` DATE NULL DEFAULT NULL,
  `hasta` DATE NULL DEFAULT NULL,
  `cargo` VARCHAR(45) NOT NULL,
  `sede` VARCHAR(45) NOT NULL,
  `persona` VARCHAR(45) NOT NULL,
  `alta` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_designacion_cargo1_idx` (`cargo` ASC),
  INDEX `fk_designacion_sede1_idx` (`sede` ASC),
  INDEX `fk_designacion_persona1_idx` (`persona` ASC),
  CONSTRAINT `fk_designacion_cargo1`
    FOREIGN KEY (`cargo`)
    REFERENCES `planfi10_20203`.`cargo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_designacion_sede1`
    FOREIGN KEY (`sede`)
    REFERENCES `planfi10_20203`.`sede` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_designacion_persona1`
    FOREIGN KEY (`persona`)
    REFERENCES `planfi10_20203`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `planfi10_20203`.`plan` (
  `id` VARCHAR(45) NOT NULL,
  `orientacion` VARCHAR(45) NOT NULL,
  `resolucion` VARCHAR(45) NULL DEFAULT NULL,
  `distribucion_horaria` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `planfi10_20203`.`asignatura` (
  `id` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `formacion` VARCHAR(45) NULL DEFAULT NULL,
  `clasificacion` VARCHAR(45) NULL DEFAULT NULL,
  `codigo` VARCHAR(45) NULL DEFAULT NULL,
  `perfil` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `planfi10_20203`.`modalidad` (
  `id` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `planfi10_20203`.`calendario` (
  `id` VARCHAR(45) NOT NULL,
  `inicio` DATE NOT NULL,
  `fin` DATE NOT NULL,
  `anio` YEAR NOT NULL,
  `semestre` SMALLINT(6) NOT NULL,
  `insertado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `planfi10_20203`.`planificacion` (
  `id` VARCHAR(45) NOT NULL,
  `anio` VARCHAR(45) NOT NULL,
  `semestre` VARCHAR(45) NOT NULL,
  `plan` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_planificacion_plan1_idx` (`plan` ASC),
  CONSTRAINT `fk_planificacion_plan1`
    FOREIGN KEY (`plan`)
    REFERENCES `planfi10_20203`.`plan` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;



CREATE TABLE IF NOT EXISTS `planfi10_20203`.`comision` (
  `id` VARCHAR(45) NOT NULL,
  `turno` VARCHAR(45) NULL DEFAULT NULL,
  `division` VARCHAR(45) NOT NULL,
  `comentario` TEXT NULL DEFAULT NULL,
  `autorizada` TINYINT(1) NOT NULL,
  `apertura` TINYINT(1) NOT NULL,
  `publicada` TINYINT(1) NOT NULL,
  `observaciones` TEXT NULL DEFAULT NULL,
  `alta` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sede` VARCHAR(45) NOT NULL,
  `modalidad` VARCHAR(45) NOT NULL,
  `planificacion` VARCHAR(45) NULL DEFAULT NULL,
  `comision_siguiente` VARCHAR(45) NULL DEFAULT NULL,
  `calendario` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comision_sede1_idx` (`sede` ASC),
  INDEX `fk_comision_comision1_idx` (`comision_siguiente` ASC),
  INDEX `fk_comision_modalidad1_idx` (`modalidad` ASC),
  INDEX `fk_comision_planificacion1_idx` (`planificacion` ASC),
  INDEX `fk_comision_calendario1_idx` (`calendario` ASC),
  CONSTRAINT `fk_comision_sede1`
    FOREIGN KEY (`sede`)
    REFERENCES `planfi10_20203`.`sede` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comision_comision1`
    FOREIGN KEY (`comision_siguiente`)
    REFERENCES `planfi10_20203`.`comision` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comision_modalidad1`
    FOREIGN KEY (`modalidad`)
    REFERENCES `planfi10_20203`.`modalidad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comision_planificacion1`
    FOREIGN KEY (`planificacion`)
    REFERENCES `planfi10_20203`.`planificacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comision_calendario1`
    FOREIGN KEY (`calendario`)
    REFERENCES `planfi10_20203`.`calendario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;





CREATE TABLE IF NOT EXISTS `planfi10_20203`.`curso` (
  `id` VARCHAR(45) NOT NULL,
  `horas_catedra` INT(11) NOT NULL,
  `comision` VARCHAR(45) NOT NULL,
  `asignatura` VARCHAR(45) NOT NULL,
  `alta` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_curso_comision1_idx` (`comision` ASC),
  INDEX `fk_curso_asignatura1_idx` (`asignatura` ASC),
  CONSTRAINT `fk_curso_comision1`
    FOREIGN KEY (`comision`)
    REFERENCES `planfi10_20203`.`comision` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curso_asignatura1`
    FOREIGN KEY (`asignatura`)
    REFERENCES `planfi10_20203`.`asignatura` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `planfi10_20203`.`dia` (
  `id` VARCHAR(45) NOT NULL,
  `numero` SMALLINT(1) NOT NULL,
  `dia` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `numero_UNIQUE` (`numero` ASC),
  UNIQUE INDEX `dia_UNIQUE` (`dia` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;



CREATE TABLE IF NOT EXISTS `planfi10_20203`.`horario` (
  `id` VARCHAR(45) NOT NULL,
  `hora_inicio` TIME NOT NULL,
  `hora_fin` TIME NOT NULL,
  `curso` VARCHAR(45) NOT NULL,
  `dia` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_horario_curso1_idx` (`curso` ASC),
  INDEX `fk_horario_dia1_idx` (`dia` ASC),
  CONSTRAINT `fk_horario_curso1`
    FOREIGN KEY (`curso`)
    REFERENCES `planfi10_20203`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_horario_dia1`
    FOREIGN KEY (`dia`)
    REFERENCES `planfi10_20203`.`dia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `planfi10_20203`.`planilla_docente` (
  `id` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(255) NOT NULL,
  `insertado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `planfi10_20203`.`contralor` (
  `id` VARCHAR(45) NOT NULL,
  `fecha_contralor` DATE NULL DEFAULT NULL,
  `fecha_consejo` DATE NULL DEFAULT NULL,
  `insertado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `planilla_docente` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_contralor_planilla_docente1_idx` (`planilla_docente` ASC),
  CONSTRAINT `fk_contralor_planilla_docente1`
    FOREIGN KEY (`planilla_docente`)
    REFERENCES `planfi10_20203`.`planilla_docente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `planfi10_20203`.`toma` (
  `id` VARCHAR(45) NOT NULL,
  `fecha_toma` DATE NULL DEFAULT NULL,
  `estado` VARCHAR(45) NULL DEFAULT NULL,
  `observaciones` TEXT NULL DEFAULT NULL,
  `comentario` VARCHAR(45) NULL DEFAULT NULL,
  `tipo_movimiento` VARCHAR(45) NOT NULL,
  `estado_contralor` VARCHAR(45) NULL DEFAULT NULL,
  `alta` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `curso` VARCHAR(45) NOT NULL,
  `docente` VARCHAR(45) NULL DEFAULT NULL,
  `reemplazo` VARCHAR(45) NULL DEFAULT NULL,
  `planilla_docente` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_toma_curso1_idx` (`curso` ASC),
  INDEX `fk_toma_persona1_idx` (`docente` ASC),
  INDEX `fk_toma_persona2_idx` (`reemplazo` ASC),
  INDEX `fk_toma_planilla_docente1_idx` (`planilla_docente` ASC),
  CONSTRAINT `fk_toma_curso1`
    FOREIGN KEY (`curso`)
    REFERENCES `planfi10_20203`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_toma_persona1`
    FOREIGN KEY (`docente`)
    REFERENCES `planfi10_20203`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_toma_persona2`
    FOREIGN KEY (`reemplazo`)
    REFERENCES `planfi10_20203`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_toma_planilla_docente1`
    FOREIGN KEY (`planilla_docente`)
    REFERENCES `planfi10_20203`.`planilla_docente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;



CREATE TABLE IF NOT EXISTS `planfi10_20203`.`distribucion_horaria` (
  `id` VARCHAR(45) NOT NULL,
  `horas_catedra` INT(11) NOT NULL,
  `dia` INT(11) NOT NULL,
  `asignatura` VARCHAR(45) NOT NULL,
  `planificacion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_distribucion_horaria_asignatura1_idx` (`asignatura` ASC),
  INDEX `fk_distribucion_horaria_planificacion1_idx` (`planificacion` ASC),
  CONSTRAINT `fk_distribucion_horaria_asignatura1`
    FOREIGN KEY (`asignatura`)
    REFERENCES `planfi10_20203`.`asignatura` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_distribucion_horaria_planificacion1`
    FOREIGN KEY (`planificacion`)
    REFERENCES `planfi10_20203`.`planificacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `planfi10_20203`.`email` (
  `id` VARCHAR(45) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `verificado` TINYINT(1) NOT NULL DEFAULT 0,
  `insertado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eliminado` TIMESTAMP NULL DEFAULT NULL,
  `persona` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_email_persona1_idx` (`persona` ASC),
  CONSTRAINT `fk_email_persona1`
    FOREIGN KEY (`persona`)
    REFERENCES `planfi10_20203`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;



CREATE TABLE IF NOT EXISTS `planfi10_20203`.`telefono` (
  `id` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(45) NULL DEFAULT NULL,
  `prefijo` VARCHAR(45) NULL DEFAULT NULL,
  `numero` VARCHAR(255) NOT NULL,
  `insertado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eliminado` TIMESTAMP NULL DEFAULT NULL,
  `persona` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_telefono_persona1_idx` (`persona` ASC),
  CONSTRAINT `fk_telefono_persona1`
    FOREIGN KEY (`persona`)
    REFERENCES `planfi10_20203`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `planfi10_20203`.`file` (
  `id` VARCHAR(45) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `type` VARCHAR(255) NOT NULL,
  `content` VARCHAR(255) NOT NULL,
  `size` INT(10) UNSIGNED NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;



