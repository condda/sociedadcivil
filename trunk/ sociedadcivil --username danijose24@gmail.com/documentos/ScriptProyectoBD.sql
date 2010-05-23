SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb`;

-- -----------------------------------------------------
-- Table `mydb`.`PERSONA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PERSONA` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`PERSONA` (
  `cedulaPersona` INT NOT NULL AUTO_INCREMENT ,
  `nombrePersona` VARCHAR(45) NOT NULL ,
  `apellidoPersona` VARCHAR(45) NOT NULL ,
  `fechaNPersona` DATE NOT NULL ,
  `sexoPersona` CHAR NOT NULL ,
  `nacionalidadPersona` VARCHAR(45) NOT NULL ,
  `direccionPersona` VARCHAR(45) NOT NULL ,
  `telefonoPersona` INT NOT NULL ,
  `fechaLPersona` DATE NOT NULL ,
  `estadoCPersona` VARCHAR(45) NOT NULL ,
  `nombreCPersona` VARCHAR(45) NULL ,
  PRIMARY KEY (`cedulaPersona`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`VEHICULO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`VEHICULO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`VEHICULO` (
  `idVehiculo` INT NOT NULL AUTO_INCREMENT ,
  `anoVehiculo` YEAR NOT NULL ,
  `estadoVehiculo` VARCHAR(45) NOT NULL ,
  `polizaVehiculo` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idVehiculo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`JUNTADIRECTIVA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`JUNTADIRECTIVA` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`JUNTADIRECTIVA` (
  `idJuntadirectiva` INT NOT NULL AUTO_INCREMENT ,
  `nombreJuntadirectiva` VARCHAR(45) NOT NULL ,
  `descripcionJuntadirectiva` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idJuntadirectiva`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`LUGAR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`LUGAR` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`LUGAR` (
  `idLugar` INT NOT NULL AUTO_INCREMENT ,
  `nombreLugar` VARCHAR(45) NOT NULL ,
  `padreLugar` INT NULL ,
  PRIMARY KEY (`idLugar`) ,
  CONSTRAINT `fk_LUGAR_LUGAR`
    FOREIGN KEY (`padreLugar` )
    REFERENCES `mydb`.`LUGAR` (`idLugar` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_LUGAR_LUGAR ON `mydb`.`LUGAR` (`padreLugar` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`SOCIEDAD`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`SOCIEDAD` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`SOCIEDAD` (
  `idSociedad` INT NOT NULL AUTO_INCREMENT ,
  `telefonoSociedad` INT NOT NULL ,
  `idLugar` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idSociedad`) ,
  CONSTRAINT `fk_SUCURSAL_LUGAR`
    FOREIGN KEY (`idLugar` )
    REFERENCES `mydb`.`LUGAR` (`idLugar` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SUCURSAL_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_SUCURSAL_LUGAR ON `mydb`.`SOCIEDAD` (`idLugar` ASC) ;

CREATE INDEX fk_SUCURSAL_PERSONA ON `mydb`.`SOCIEDAD` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`RUTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`RUTA` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`RUTA` (
  `idRuta` INT NOT NULL AUTO_INCREMENT ,
  `descripcionRuta` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idRuta`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`PASAJE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PASAJE` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`PASAJE` (
  `idPasaje` INT NOT NULL AUTO_INCREMENT ,
  `costoPasaje` INT NOT NULL ,
  `idRuta` INT NOT NULL ,
  PRIMARY KEY (`idPasaje`) ,
  CONSTRAINT `fk_PASAJE_RUTA`
    FOREIGN KEY (`idRuta` )
    REFERENCES `mydb`.`RUTA` (`idRuta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_PASAJE_RUTA ON `mydb`.`PASAJE` (`idRuta` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`PRODUCTO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PRODUCTO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`PRODUCTO` (
  `idProducto` INT NOT NULL AUTO_INCREMENT ,
  `nombreProducto` VARCHAR(45) NOT NULL ,
  `descripcionProducto` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idProducto`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`REQUISITO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`REQUISITO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`REQUISITO` (
  `idRequisito` INT NOT NULL AUTO_INCREMENT ,
  `descripcionRequisito` VARCHAR(45) NOT NULL ,
  `tipoRequisito` INT NOT NULL ,
  `idSociedad` INT NOT NULL ,
  PRIMARY KEY (`idRequisito`) ,
  CONSTRAINT `fk_REQUISITO_SOCIEDAD`
    FOREIGN KEY (`idSociedad` )
    REFERENCES `mydb`.`SOCIEDAD` (`idSociedad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_REQUISITO_SOCIEDAD ON `mydb`.`REQUISITO` (`idSociedad` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`NORMA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`NORMA` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`NORMA` (
  `idNorma` INT NOT NULL AUTO_INCREMENT ,
  `descripcionNorma` VARCHAR(45) NOT NULL ,
  `tipoNorma` INT NOT NULL ,
  PRIMARY KEY (`idNorma`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`TRIBUNALD`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`TRIBUNALD` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`TRIBUNALD` (
  `idTribunald` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idTribunald`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`SANCION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`SANCION` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`SANCION` (
  `idSancion` INT NOT NULL AUTO_INCREMENT ,
  `fechaSancion` DATE NOT NULL ,
  `idNorma` INT NOT NULL ,
  `idTribunald` INT NOT NULL ,
  PRIMARY KEY (`idSancion`) ,
  CONSTRAINT `fk_SANCION_TRIBUNALD`
    FOREIGN KEY (`idTribunald` )
    REFERENCES `mydb`.`TRIBUNALD` (`idTribunald` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SANCION_NORMA`
    FOREIGN KEY (`idNorma` )
    REFERENCES `mydb`.`NORMA` (`idNorma` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_SANCION_TRIBUNALD ON `mydb`.`SANCION` (`idTribunald` ASC) ;

CREATE INDEX fk_SANCION_NORMA ON `mydb`.`SANCION` (`idNorma` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`BENIFICIARIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`BENIFICIARIO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`BENIFICIARIO` (
  `cedulaBeneficiario` INT NOT NULL AUTO_INCREMENT ,
  `nombreBeneficiario` VARCHAR(45) NOT NULL ,
  `apellidoBeneficiario` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`cedulaBeneficiario`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ASAMBLEA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ASAMBLEA` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`ASAMBLEA` (
  `idAsamblea` INT NOT NULL AUTO_INCREMENT ,
  `tipoAsamblea` INT NOT NULL ,
  `descripcionAsamblea` VARCHAR(45) NOT NULL ,
  `fechaAsamblea` DATE NOT NULL ,
  `idJuntadirectiva` INT NOT NULL ,
  PRIMARY KEY (`idAsamblea`) ,
  CONSTRAINT `fk_ASAMBLEA_JUNTADIRECTIVA`
    FOREIGN KEY (`idJuntadirectiva` )
    REFERENCES `mydb`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_ASAMBLEA_JUNTADIRECTIVA ON `mydb`.`ASAMBLEA` (`idJuntadirectiva` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`SUELDO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`SUELDO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`SUELDO` (
  `idSueldo` INT NOT NULL AUTO_INCREMENT ,
  `montoSueldo` INT NOT NULL ,
  PRIMARY KEY (`idSueldo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`INSCRIPCION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`INSCRIPCION` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`INSCRIPCION` (
  `idInscripcion` INT NOT NULL AUTO_INCREMENT ,
  `fechaInscripcion` DATE NOT NULL ,
  `estatusInscripcion` INT NOT NULL ,
  `fechaAInscripcion` DATE NOT NULL ,
  `montoInscripcion` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idInscripcion`) ,
  CONSTRAINT `fk_INSCRIPCION_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_INSCRIPCION_PERSONA ON `mydb`.`INSCRIPCION` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`LISTAIE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`LISTAIE` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`LISTAIE` (
  `idListaIE` INT NOT NULL AUTO_INCREMENT ,
  `descripcionListaIE` VARCHAR(45) NOT NULL ,
  `tipoListaIE` INT NOT NULL ,
  `idSociedad` INT NOT NULL ,
  PRIMARY KEY (`idListaIE`) ,
  CONSTRAINT `fk_LISTAIE_SOCIEDAD`
    FOREIGN KEY (`idSociedad` )
    REFERENCES `mydb`.`SOCIEDAD` (`idSociedad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_LISTAIE_SOCIEDAD ON `mydb`.`LISTAIE` (`idSociedad` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`FONDO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`FONDO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`FONDO` (
  `idFondo` INT NOT NULL AUTO_INCREMENT ,
  `nombreFondo` VARCHAR(45) NOT NULL ,
  `descripcionFondo` VARCHAR(45) NOT NULL ,
  `montoFonro` INT NOT NULL ,
  `tipoFondo` INT NOT NULL ,
  PRIMARY KEY (`idFondo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`MULTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`MULTA` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`MULTA` (
  `idMulta` INT NOT NULL AUTO_INCREMENT ,
  `montoMulta` INT NOT NULL ,
  `idSancion` INT NOT NULL ,
  PRIMARY KEY (`idMulta`) ,
  CONSTRAINT `fk_MULTA_SANCION`
    FOREIGN KEY (`idSancion` )
    REFERENCES `mydb`.`SANCION` (`idSancion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_MULTA_SANCION ON `mydb`.`MULTA` (`idSancion` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`HIST_PASAJE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`HIST_PASAJE` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`HIST_PASAJE` (
  `idPasaje` INT NOT NULL ,
  `idSucursal` INT NOT NULL ,
  `fechaHistPasaje` DATE NOT NULL ,
  PRIMARY KEY (`idPasaje`, `idSucursal`) ,
  CONSTRAINT `fk_PASAJE_has_SUCURSAL_PASAJE`
    FOREIGN KEY (`idPasaje` )
    REFERENCES `mydb`.`PASAJE` (`idPasaje` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PASAJE_has_SUCURSAL_SUCURSAL`
    FOREIGN KEY (`idSucursal` )
    REFERENCES `mydb`.`SOCIEDAD` (`idSociedad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_PASAJE_has_SUCURSAL_PASAJE ON `mydb`.`HIST_PASAJE` (`idPasaje` ASC) ;

CREATE INDEX fk_PASAJE_has_SUCURSAL_SUCURSAL ON `mydb`.`HIST_PASAJE` (`idSucursal` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`PROVEEDOR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PROVEEDOR` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`PROVEEDOR` (
  `idProveedor` INT NOT NULL AUTO_INCREMENT ,
  `direccionProveedor` VARCHAR(45) NOT NULL ,
  `telefonoProveedor` INT NOT NULL ,
  `tipoProveedor` INT NOT NULL ,
  `nombreProveedor` VARCHAR(45) NOT NULL ,
  `cedulaProveedor` INT NULL ,
  `rifProveedor` VARCHAR(45) NULL ,
  PRIMARY KEY (`idProveedor`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`SUCURSAL_PROV`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`SUCURSAL_PROV` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`SUCURSAL_PROV` (
  `idSucursal` INT NOT NULL ,
  `idLugar` INT NOT NULL ,
  `idProveedor` INT NOT NULL ,
  PRIMARY KEY (`idSucursal`, `idLugar`, `idProveedor`) ,
  CONSTRAINT `fk_SUCURSAL_has_PROVEEDOR_SUCURSAL`
    FOREIGN KEY (`idSucursal` , `idLugar` )
    REFERENCES `mydb`.`SOCIEDAD` (`idSociedad` , `idLugar` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SUCURSAL_has_PROVEEDOR_PROVEEDOR`
    FOREIGN KEY (`idProveedor` )
    REFERENCES `mydb`.`PROVEEDOR` (`idProveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_SUCURSAL_has_PROVEEDOR_SUCURSAL ON `mydb`.`SUCURSAL_PROV` (`idSucursal` ASC, `idLugar` ASC) ;

CREATE INDEX fk_SUCURSAL_has_PROVEEDOR_PROVEEDOR ON `mydb`.`SUCURSAL_PROV` (`idProveedor` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`PRODUCTO_PROV`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PRODUCTO_PROV` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`PRODUCTO_PROV` (
  `idProducto` INT NOT NULL ,
  `idProveedor` INT NOT NULL ,
  `precioProductoProv` INT NOT NULL ,
  `cantidadProductoProv` INT NOT NULL ,
  PRIMARY KEY (`idProducto`, `idProveedor`) ,
  CONSTRAINT `fk_PRODUCTO_has_PROVEEDOR_PRODUCTO`
    FOREIGN KEY (`idProducto` )
    REFERENCES `mydb`.`PRODUCTO` (`idProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PRODUCTO_has_PROVEEDOR_PROVEEDOR`
    FOREIGN KEY (`idProveedor` )
    REFERENCES `mydb`.`PROVEEDOR` (`idProveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_PRODUCTO_has_PROVEEDOR_PRODUCTO ON `mydb`.`PRODUCTO_PROV` (`idProducto` ASC) ;

CREATE INDEX fk_PRODUCTO_has_PROVEEDOR_PROVEEDOR ON `mydb`.`PRODUCTO_PROV` (`idProveedor` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`SOCIO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`SOCIO` (
  `cedulaPersona` INT NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`cedulaPersona`) ,
  CONSTRAINT `fk_SOCIO_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_SOCIO_PERSONA ON `mydb`.`SOCIO` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`AVANCE` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`AVANCE` (
  `cedulaPersona` INT NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`cedulaPersona`) ,
  CONSTRAINT `fk_AVANCE_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_AVANCE_PERSONA ON `mydb`.`AVANCE` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`SOCIO_BENEFICIARIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`SOCIO_BENEFICIARIO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`SOCIO_BENEFICIARIO` (
  `cedulaPersona` INT NOT NULL ,
  `cedulaBeneficiario` INT NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `cedulaBeneficiario`) ,
  CONSTRAINT `fk_SOCIO_has_BENIFICIARIO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_BENIFICIARIO_BENIFICIARIO`
    FOREIGN KEY (`cedulaBeneficiario` )
    REFERENCES `mydb`.`BENIFICIARIO` (`cedulaBeneficiario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_SOCIO_has_BENIFICIARIO_SOCIO ON `mydb`.`SOCIO_BENEFICIARIO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_SOCIO_has_BENIFICIARIO_BENIFICIARIO ON `mydb`.`SOCIO_BENEFICIARIO` (`cedulaBeneficiario` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`AVANCE_BENIFICIARIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`AVANCE_BENIFICIARIO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`AVANCE_BENIFICIARIO` (
  `cedulaPersona` INT NOT NULL ,
  `cedulaBeneficiario` INT NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `cedulaBeneficiario`) ,
  CONSTRAINT `fk_AVANCE_has_BENIFICIARIO_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AVANCE_has_BENIFICIARIO_BENIFICIARIO`
    FOREIGN KEY (`cedulaBeneficiario` )
    REFERENCES `mydb`.`BENIFICIARIO` (`cedulaBeneficiario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_AVANCE_has_BENIFICIARIO_AVANCE ON `mydb`.`AVANCE_BENIFICIARIO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_AVANCE_has_BENIFICIARIO_BENIFICIARIO ON `mydb`.`AVANCE_BENIFICIARIO` (`cedulaBeneficiario` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`VEHICULO_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`VEHICULO_AVANCE` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`VEHICULO_AVANCE` (
  `idVehiculo` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idVehiculo`, `cedulaPersona`) ,
  CONSTRAINT `fk_VEHICULO_has_AVANCE_VEHICULO`
    FOREIGN KEY (`idVehiculo` )
    REFERENCES `mydb`.`VEHICULO` (`idVehiculo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_VEHICULO_has_AVANCE_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_VEHICULO_has_AVANCE_VEHICULO ON `mydb`.`VEHICULO_AVANCE` (`idVehiculo` ASC) ;

CREATE INDEX fk_VEHICULO_has_AVANCE_AVANCE ON `mydb`.`VEHICULO_AVANCE` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`TRASPASO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`TRASPASO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`TRASPASO` (
  `cedulaPersona` INT NOT NULL ,
  `idVehiculo` INT NOT NULL ,
  `fechaTraspaso` DATE NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idVehiculo`) ,
  CONSTRAINT `fk_SOCIO_has_VEHICULO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_VEHICULO_VEHICULO`
    FOREIGN KEY (`idVehiculo` )
    REFERENCES `mydb`.`VEHICULO` (`idVehiculo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_SOCIO_has_VEHICULO_SOCIO ON `mydb`.`TRASPASO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_SOCIO_has_VEHICULO_VEHICULO ON `mydb`.`TRASPASO` (`idVehiculo` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`HIST_CARGO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`HIST_CARGO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`HIST_CARGO` (
  `cedulaPersona` INT NOT NULL ,
  `fechaCargo` DATE NOT NULL ,
  `idTribunald` INT NOT NULL ,
  `idJuntadirectiva` INT NOT NULL ,
  `idJuntadirectivaOpcional` INT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idJuntadirectiva`, `idTribunald`) ,
  CONSTRAINT `fk_JUNTADIRECTIVA_has_SOCIO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_HIST_CARGO_TRIBUNALD`
    FOREIGN KEY (`idTribunald` )
    REFERENCES `mydb`.`TRIBUNALD` (`idTribunald` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_HIST_CARGO_JUNTADIRECTIVA`
    FOREIGN KEY (`idJuntadirectiva` )
    REFERENCES `mydb`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_HIST_CARGO_JUNTADIRECTIVA1`
    FOREIGN KEY (`idJuntadirectivaOpcional` )
    REFERENCES `mydb`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_JUNTADIRECTIVA_has_SOCIO_SOCIO ON `mydb`.`HIST_CARGO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_HIST_CARGO_TRIBUNALD ON `mydb`.`HIST_CARGO` (`idTribunald` ASC) ;

CREATE INDEX fk_HIST_CARGO_JUNTADIRECTIVA ON `mydb`.`HIST_CARGO` (`idJuntadirectiva` ASC) ;

CREATE INDEX fk_HIST_CARGO_JUNTADIRECTIVA1 ON `mydb`.`HIST_CARGO` (`idJuntadirectivaOpcional` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`HIST_SUELDO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`HIST_SUELDO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`HIST_SUELDO` (
  `idJuntadirectiva` INT NOT NULL ,
  `idSueldo` INT NOT NULL ,
  `fechaSueldo` DATE NOT NULL ,
  PRIMARY KEY (`idJuntadirectiva`, `idSueldo`) ,
  CONSTRAINT `fk_JUNTADIRECTIVA_has_SUELDO_JUNTADIRECTIVA`
    FOREIGN KEY (`idJuntadirectiva` )
    REFERENCES `mydb`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_JUNTADIRECTIVA_has_SUELDO_SUELDO`
    FOREIGN KEY (`idSueldo` )
    REFERENCES `mydb`.`SUELDO` (`idSueldo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_JUNTADIRECTIVA_has_SUELDO_JUNTADIRECTIVA ON `mydb`.`HIST_SUELDO` (`idJuntadirectiva` ASC) ;

CREATE INDEX fk_JUNTADIRECTIVA_has_SUELDO_SUELDO ON `mydb`.`HIST_SUELDO` (`idSueldo` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`FONDOINGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`FONDOINGRESO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`FONDOINGRESO` (
  `idFondoIngreso` INT NOT NULL AUTO_INCREMENT ,
  `descripcionFondoIngreso` VARCHAR(45) NOT NULL ,
  `montoFondoIngreso` INT NOT NULL ,
  `fechaFondoIngreso` DATE NOT NULL ,
  `idFondo` INT NOT NULL ,
  PRIMARY KEY (`idFondoIngreso`) ,
  CONSTRAINT `fk_INGRESO_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `mydb`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_INGRESO_FONDO ON `mydb`.`FONDOINGRESO` (`idFondo` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`FONDOEGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`FONDOEGRESO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`FONDOEGRESO` (
  `idFondoEgreso` INT NOT NULL AUTO_INCREMENT ,
  `descripcionFondoEgreso` VARCHAR(45) NOT NULL ,
  `montoFondoEgreso` INT NOT NULL ,
  `fechaFondoEgreso` DATE NOT NULL ,
  `idFondo` INT NOT NULL ,
  PRIMARY KEY (`idFondoEgreso`) ,
  CONSTRAINT `fk_EGRESO_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `mydb`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_EGRESO_FONDO ON `mydb`.`FONDOEGRESO` (`idFondo` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`CUOTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`CUOTA` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`CUOTA` (
  `idCuota` INT NOT NULL AUTO_INCREMENT ,
  `tipoCuota` INT NOT NULL ,
  `montoCuota` INT NOT NULL ,
  PRIMARY KEY (`idCuota`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ASAMBLEA_SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ASAMBLEA_SOCIO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`ASAMBLEA_SOCIO` (
  `idAsamblea` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idAsamblea`) ,
  CONSTRAINT `fk_SOCIO_has_ASAMBLEA_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_ASAMBLEA_ASAMBLEA`
    FOREIGN KEY (`idAsamblea` )
    REFERENCES `mydb`.`ASAMBLEA` (`idAsamblea` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_SOCIO_has_ASAMBLEA_SOCIO ON `mydb`.`ASAMBLEA_SOCIO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_SOCIO_has_ASAMBLEA_ASAMBLEA ON `mydb`.`ASAMBLEA_SOCIO` (`idAsamblea` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`ASAMBLEA_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`ASAMBLEA_AVANCE` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`ASAMBLEA_AVANCE` (
  `idAsamblea` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idAsamblea`, `cedulaPersona`) ,
  CONSTRAINT `fk_ASAMBLEA_has_AVANCE_ASAMBLEA`
    FOREIGN KEY (`idAsamblea` )
    REFERENCES `mydb`.`ASAMBLEA` (`idAsamblea` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ASAMBLEA_has_AVANCE_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_ASAMBLEA_has_AVANCE_ASAMBLEA ON `mydb`.`ASAMBLEA_AVANCE` (`idAsamblea` ASC) ;

CREATE INDEX fk_ASAMBLEA_has_AVANCE_AVANCE ON `mydb`.`ASAMBLEA_AVANCE` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`CUOTA_SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`CUOTA_SOCIO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`CUOTA_SOCIO` (
  `cedulaPersona` INT NOT NULL ,
  `idCuota` INT NOT NULL ,
  `fechaCuota` DATE NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idCuota`) ,
  CONSTRAINT `fk_SOCIO_has_CUOTA_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_CUOTA_CUOTA`
    FOREIGN KEY (`idCuota` )
    REFERENCES `mydb`.`CUOTA` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_SOCIO_has_CUOTA_SOCIO ON `mydb`.`CUOTA_SOCIO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_SOCIO_has_CUOTA_CUOTA ON `mydb`.`CUOTA_SOCIO` (`idCuota` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`CUOTA_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`CUOTA_AVANCE` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`CUOTA_AVANCE` (
  `cedulaPersona` INT NOT NULL ,
  `idCuota` INT NOT NULL ,
  `fechaCuota` DATE NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idCuota`) ,
  CONSTRAINT `fk_AVANCE_has_CUOTA_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AVANCE_has_CUOTA_CUOTA`
    FOREIGN KEY (`idCuota` )
    REFERENCES `mydb`.`CUOTA` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_AVANCE_has_CUOTA_AVANCE ON `mydb`.`CUOTA_AVANCE` (`cedulaPersona` ASC) ;

CREATE INDEX fk_AVANCE_has_CUOTA_CUOTA ON `mydb`.`CUOTA_AVANCE` (`idCuota` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`FONDO_SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`FONDO_SOCIO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`FONDO_SOCIO` (
  `idFondo` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idFondo`, `cedulaPersona`) ,
  CONSTRAINT `fk_FONDO_has_SOCIO_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `mydb`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FONDO_has_SOCIO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_FONDO_has_SOCIO_FONDO ON `mydb`.`FONDO_SOCIO` (`idFondo` ASC) ;

CREATE INDEX fk_FONDO_has_SOCIO_SOCIO ON `mydb`.`FONDO_SOCIO` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`FONDO_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`FONDO_AVANCE` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`FONDO_AVANCE` (
  `idFondo` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idFondo`, `cedulaPersona`) ,
  CONSTRAINT `fk_FONDO_has_AVANCE_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `mydb`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FONDO_has_AVANCE_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_FONDO_has_AVANCE_FONDO ON `mydb`.`FONDO_AVANCE` (`idFondo` ASC) ;

CREATE INDEX fk_FONDO_has_AVANCE_AVANCE ON `mydb`.`FONDO_AVANCE` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`PRESTAMO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PRESTAMO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`PRESTAMO` (
  `idPrestamo` INT NOT NULL ,
  `montoPrestamo` INT NOT NULL ,
  PRIMARY KEY (`idPrestamo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`PRESTAMO_PERSONA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`PRESTAMO_PERSONA` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`PRESTAMO_PERSONA` (
  `idPrestamo` INT NOT NULL ,
  `tipoPersona` INT NOT NULL ,
  `cedulaPersonaA` INT NULL ,
  `cedulaPersonaS` INT NULL ,
  PRIMARY KEY (`idPrestamo`) ,
  CONSTRAINT `fk_AVANCE_has_PRESTAMO_AVANCE`
    FOREIGN KEY (`cedulaPersonaA` )
    REFERENCES `mydb`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AVANCE_has_PRESTAMO_PRESTAMO`
    FOREIGN KEY (`idPrestamo` )
    REFERENCES `mydb`.`PRESTAMO` (`idPrestamo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PRESTAMO_PERSONA_SOCIO`
    FOREIGN KEY (`cedulaPersonaS` )
    REFERENCES `mydb`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_AVANCE_has_PRESTAMO_AVANCE ON `mydb`.`PRESTAMO_PERSONA` (`cedulaPersonaA` ASC) ;

CREATE INDEX fk_AVANCE_has_PRESTAMO_PRESTAMO ON `mydb`.`PRESTAMO_PERSONA` (`idPrestamo` ASC) ;

CREATE INDEX fk_PRESTAMO_PERSONA_SOCIO ON `mydb`.`PRESTAMO_PERSONA` (`cedulaPersonaS` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`COMPRA_VENTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`COMPRA_VENTA` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`COMPRA_VENTA` (
  `idCompraVenta` INT NOT NULL AUTO_INCREMENT ,
  `tipoCompraVenta` INT NOT NULL ,
  `montoCompraVenta` INT NOT NULL ,
  `cantidadCompraVenta` INT NOT NULL ,
  `idProducto` INT NOT NULL ,
  `idProveedor` INT NULL ,
  `cedulaPersona` INT NULL ,
  PRIMARY KEY (`idCompraVenta`) ,
  CONSTRAINT `fk_COMPRA_VENTA_PRODUCTO_PROV`
    FOREIGN KEY (`idProducto` , `idProveedor` )
    REFERENCES `mydb`.`PRODUCTO_PROV` (`idProducto` , `idProveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMPRA_VENTA_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `mydb`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_COMPRA_VENTA_PRODUCTO_PROV ON `mydb`.`COMPRA_VENTA` (`idProducto` ASC, `idProveedor` ASC) ;

CREATE INDEX fk_COMPRA_VENTA_PERSONA ON `mydb`.`COMPRA_VENTA` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`EGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`EGRESO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`EGRESO` (
  `idEgreso` INT NOT NULL AUTO_INCREMENT ,
  `tipoEgreso` INT NOT NULL ,
  `idPrestamo` INT NULL ,
  `idFondoEgreso` INT NULL ,
  `idSueldo` INT NULL ,
  `idCompraVenta` INT NULL ,
  PRIMARY KEY (`idEgreso`) ,
  CONSTRAINT `fk_EGRESO_PRESTAMO`
    FOREIGN KEY (`idPrestamo` )
    REFERENCES `mydb`.`PRESTAMO` (`idPrestamo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EGRESO_FONDOEGRESO`
    FOREIGN KEY (`idFondoEgreso` )
    REFERENCES `mydb`.`FONDOEGRESO` (`idFondoEgreso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EGRESO_SUELDO`
    FOREIGN KEY (`idSueldo` )
    REFERENCES `mydb`.`SUELDO` (`idSueldo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EGRESO_COMPRA_VENTA`
    FOREIGN KEY (`idCompraVenta` )
    REFERENCES `mydb`.`COMPRA_VENTA` (`idCompraVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_EGRESO_PRESTAMO ON `mydb`.`EGRESO` (`idPrestamo` ASC) ;

CREATE INDEX fk_EGRESO_FONDOEGRESO ON `mydb`.`EGRESO` (`idFondoEgreso` ASC) ;

CREATE INDEX fk_EGRESO_SUELDO ON `mydb`.`EGRESO` (`idSueldo` ASC) ;

CREATE INDEX fk_EGRESO_COMPRA_VENTA ON `mydb`.`EGRESO` (`idCompraVenta` ASC) ;


-- -----------------------------------------------------
-- Table `mydb`.`INGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`INGRESO` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`INGRESO` (
  `idINGRESO` INT NOT NULL AUTO_INCREMENT ,
  `tipoIngreso` INT NOT NULL ,
  `idMulta` INT NULL ,
  `idCuotaSocio` INT NULL ,
  `idCuotaAvance` INT NULL ,
  `idInscripcion` INT NULL ,
  `idCompraVenta` INT NULL ,
  `idFondoIngreso` INT NULL ,
  PRIMARY KEY (`idINGRESO`) ,
  CONSTRAINT `fk_INGRESO_MULTA`
    FOREIGN KEY (`idMulta` )
    REFERENCES `mydb`.`MULTA` (`idMulta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_CUOTA_SOCIO`
    FOREIGN KEY (`idCuotaSocio` )
    REFERENCES `mydb`.`CUOTA_SOCIO` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_CUOTA_AVANCE`
    FOREIGN KEY (`idCuotaAvance` )
    REFERENCES `mydb`.`CUOTA_AVANCE` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_INSCRIPCION`
    FOREIGN KEY (`idInscripcion` )
    REFERENCES `mydb`.`INSCRIPCION` (`idInscripcion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_COMPRA_VENTA`
    FOREIGN KEY (`idCompraVenta` )
    REFERENCES `mydb`.`COMPRA_VENTA` (`idCompraVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_FONDOINGRESO`
    FOREIGN KEY (`idFondoIngreso` )
    REFERENCES `mydb`.`FONDOINGRESO` (`idFondoIngreso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_INGRESO_MULTA ON `mydb`.`INGRESO` (`idMulta` ASC) ;

CREATE INDEX fk_INGRESO_CUOTA_SOCIO ON `mydb`.`INGRESO` (`idCuotaSocio` ASC) ;

CREATE INDEX fk_INGRESO_CUOTA_AVANCE ON `mydb`.`INGRESO` (`idCuotaAvance` ASC) ;

CREATE INDEX fk_INGRESO_INSCRIPCION ON `mydb`.`INGRESO` (`idInscripcion` ASC) ;

CREATE INDEX fk_INGRESO_COMPRA_VENTA ON `mydb`.`INGRESO` (`idCompraVenta` ASC) ;

CREATE INDEX fk_INGRESO_FONDOINGRESO ON `mydb`.`INGRESO` (`idFondoIngreso` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
