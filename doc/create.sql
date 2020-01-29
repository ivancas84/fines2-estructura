CREATE TABLE IF NOT EXISTS `domicilio` (
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

CREATE TABLE IF NOT EXISTS `centro_educativo` (
  `id` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `cue` VARCHAR(45) NULL DEFAULT NULL,
  `domicilio` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_centro_educativo_domicilio1_idx` (`domicilio` ASC),
  UNIQUE INDEX `cue_UNIQUE` (`cue` ASC),
  CONSTRAINT `fk_centro_educativo_domicilio1`
    FOREIGN KEY (`domicilio`)
    REFERENCES `domicilio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `tipo_sede` (
  `id` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `descripcion_UNIQUE` (`descripcion` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `sede` (
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
    REFERENCES `domicilio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sede_tipo_sede1`
    FOREIGN KEY (`tipo_sede`)
    REFERENCES `tipo_sede` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sede_centro_educativo1`
    FOREIGN KEY (`centro_educativo`)
    REFERENCES `centro_educativo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `persona` (
  `id` VARCHAR(45) NOT NULL,
  `nombres` VARCHAR(255) NOT NULL,
  `apellidos` VARCHAR(255) NULL DEFAULT NULL,
  `fecha_nacimiento` DATE NULL DEFAULT NULL,
  `numero_documento` VARCHAR(45) NOT NULL,
  `cuil` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `genero` VARCHAR(45) NULL DEFAULT NULL,
  `apodo` VARCHAR(255) NULL DEFAULT NULL,
  `alta` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  UNIQUE INDEX `cuil_UNIQUE` (`cuil` ASC),
  UNIQUE INDEX `numero_documento_UNIQUE` (`numero_documento` ASC),
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `cargo` (
  `id` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `descripcion_UNIQUE` (`descripcion` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `designacion` (
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
    REFERENCES `cargo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_designacion_sede1`
    FOREIGN KEY (`sede`)
    REFERENCES `sede` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_designacion_persona1`
    FOREIGN KEY (`persona`)
    REFERENCES `persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `plan` (
  `id` VARCHAR(45) NOT NULL,
  `orientacion` VARCHAR(45) NOT NULL,
  `resolucion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `orientacion_UNIQUE` (`orientacion` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `asignatura` (
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

CREATE TABLE IF NOT EXISTS `carga_horaria` (
  `id` VARCHAR(45) NOT NULL,
  `anio` VARCHAR(45) NOT NULL,
  `semestre` VARCHAR(45) NOT NULL,
  `horas_catedra` VARCHAR(45) NOT NULL,
  `plan` VARCHAR(45) NOT NULL,
  `asignatura` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_carga_horaria_plan1_idx` (`plan` ASC),
  INDEX `fk_carga_horaria_asignatura1_idx` (`asignatura` ASC),
  CONSTRAINT `fk_carga_horaria_plan1`
    FOREIGN KEY (`plan`)
    REFERENCES `plan` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carga_horaria_asignatura1`
    FOREIGN KEY (`asignatura`)
    REFERENCES `asignatura` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `modalidad` (
  `id` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `comision` (
  `id` VARCHAR(45) NOT NULL,
  `turno` VARCHAR(45) NULL DEFAULT NULL,
  `division` VARCHAR(45) NOT NULL,
  `anio` VARCHAR(45) NULL DEFAULT NULL,
  `semestre` VARCHAR(45) NULL DEFAULT NULL,
  `comentario` TEXT NULL DEFAULT NULL,
  `autorizada` TINYINT(1) NOT NULL,
  `apertura` TINYINT(1) NOT NULL,
  `publicada` TINYINT(1) NOT NULL,
  `fecha_anio` YEAR NULL DEFAULT NULL,
  `fecha_semestre` INT(11) NULL DEFAULT NULL,
  `observaciones` TEXT NULL DEFAULT NULL,
  `alta` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sede` VARCHAR(45) NOT NULL,
  `plan` VARCHAR(45) NOT NULL,
  `modalidad` VARCHAR(45) NOT NULL,
  `comision_siguiente` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comision_sede1_idx` (`sede` ASC),
  INDEX `fk_comision_comision1_idx` (`comision_siguiente` ASC),
  INDEX `fk_comision_plan1_idx` (`plan` ASC),
  INDEX `fk_comision_modalidad1_idx` (`modalidad` ASC),
  CONSTRAINT `fk_comision_sede1`
    FOREIGN KEY (`sede`)
    REFERENCES `sede` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comision_comision1`
    FOREIGN KEY (`comision_siguiente`)
    REFERENCES `comision` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comision_plan1`
    FOREIGN KEY (`plan`)
    REFERENCES `plan` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comision_modalidad1`
    FOREIGN KEY (`modalidad`)
    REFERENCES `modalidad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `curso` (
  `id` VARCHAR(45) NOT NULL,
  `observaciones` TEXT NULL DEFAULT NULL,
  `comision` VARCHAR(45) NOT NULL,
  `carga_horaria` VARCHAR(45) NOT NULL,
  `alta` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_curso_comision1_idx` (`comision` ASC),
  INDEX `fk_curso_carga_horaria1_idx` (`carga_horaria` ASC),
  CONSTRAINT `fk_curso_comision1`
    FOREIGN KEY (`comision`)
    REFERENCES `comision` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curso_carga_horaria1`
    FOREIGN KEY (`carga_horaria`)
    REFERENCES `carga_horaria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `dia` (
  `id` VARCHAR(45) NOT NULL,
  `numero` SMALLINT(1) NOT NULL,
  `dia` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `numero_UNIQUE` (`numero` ASC),
  UNIQUE INDEX `dia_UNIQUE` (`dia` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `horario` (
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
    REFERENCES `curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_horario_dia1`
    FOREIGN KEY (`dia`)
    REFERENCES `dia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `toma` (
  `id` VARCHAR(45) NOT NULL,
  `fecha_toma` DATE NULL DEFAULT NULL,
  `fecha_inicio` DATE NULL DEFAULT NULL,
  `fecha_fin` DATE NULL DEFAULT NULL,
  `fecha_contralor` DATE NULL DEFAULT NULL,
  `fecha_consejo` DATE NULL DEFAULT NULL,
  `estado` VARCHAR(45) NULL DEFAULT NULL,
  `observaciones` TEXT NULL DEFAULT NULL,
  `comentario` VARCHAR(45) NULL DEFAULT NULL,
  `tipo_movimiento` VARCHAR(45) NOT NULL,
  `estado_contralor` VARCHAR(45) NULL DEFAULT NULL,
  `alta` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `curso` VARCHAR(45) NOT NULL,
  `docente` VARCHAR(45) NULL DEFAULT NULL,
  `reemplazo` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_toma_curso1_idx` (`curso` ASC),
  INDEX `fk_toma_persona1_idx` (`docente` ASC),
  INDEX `fk_toma_persona2_idx` (`reemplazo` ASC),
  CONSTRAINT `fk_toma_curso1`
    FOREIGN KEY (`curso`)
    REFERENCES `curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_toma_persona1`
    FOREIGN KEY (`docente`)
    REFERENCES `persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_toma_persona2`
    FOREIGN KEY (`reemplazo`)
    REFERENCES `persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

