SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



CREATE SCHEMA IF NOT EXISTS `sociedadCivil` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;

USE `sociedadCivil`;


-- -----------------------------------------------------
-- Table `sociedadCivil`.`PERSONA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`PERSONA` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`PERSONA` (
  `cedulaPersona` INT NOT NULL ,
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
-- Table `sociedadCivil`.`VEHICULO`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `sociedadCivil`.`VEHICULO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`VEHICULO` (
  `idVehiculo` INT NOT NULL AUTO_INCREMENT ,
  `anoVehiculo` YEAR NOT NULL ,
  `estadoVehiculo` VARCHAR(45) NOT NULL ,
  `polizaVehiculo` INT(11) NOT NULL ,
  PRIMARY KEY (`idVehiculo`) )
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`JUNTADIRECTIVA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`JUNTADIRECTIVA` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`JUNTADIRECTIVA` (
  `idJuntadirectiva` INT NOT NULL AUTO_INCREMENT ,
  `nombreJuntadirectiva` VARCHAR(45) NOT NULL ,
  `descripcionJuntadirectiva` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idJuntadirectiva`) )
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`LUGAR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`LUGAR` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`LUGAR` (
  `idLugar` INT NOT NULL AUTO_INCREMENT ,
  `nombreLugar` VARCHAR(45) NOT NULL ,
  `padreLugar` INT NULL ,
  PRIMARY KEY (`idLugar`) ,
  CONSTRAINT `fk_LUGAR_LUGAR`
    FOREIGN KEY (`padreLugar` )
    REFERENCES `sociedadCivil`.`LUGAR` (`idLugar` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_LUGAR_LUGAR ON `sociedadCivil`.`LUGAR` (`padreLugar` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`SOCIEDAD`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`SOCIEDAD` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`SOCIEDAD` (
  `idSociedad` INT NOT NULL AUTO_INCREMENT ,
  `telefonoSociedad` INT NOT NULL ,
  `idLugar` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idSociedad`) ,
  CONSTRAINT `fk_SUCURSAL_LUGAR`
    FOREIGN KEY (`idLugar` )
    REFERENCES `sociedadCivil`.`LUGAR` (`idLugar` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SUCURSAL_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_SUCURSAL_LUGAR ON `sociedadCivil`.`SOCIEDAD` (`idLugar` ASC) ;


CREATE INDEX fk_SUCURSAL_PERSONA ON `sociedadCivil`.`SOCIEDAD` (`cedulaPersona` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`RUTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`RUTA` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`RUTA` (
  `idRuta` INT NOT NULL AUTO_INCREMENT ,
  `descripcionRuta` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idRuta`) )
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`PASAJE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`PASAJE` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`PASAJE` (
  `idPasaje` INT NOT NULL AUTO_INCREMENT ,
  `costoPasaje` INT NOT NULL ,
  `idRuta` INT NOT NULL ,
  PRIMARY KEY (`idPasaje`) ,
  CONSTRAINT `fk_PASAJE_RUTA`
    FOREIGN KEY (`idRuta` )
    REFERENCES `sociedadCivil`.`RUTA` (`idRuta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_PASAJE_RUTA ON `sociedadCivil`.`PASAJE` (`idRuta` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`PRODUCTO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`PRODUCTO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`PRODUCTO` (
  `idProducto` INT NOT NULL AUTO_INCREMENT ,
  `nombreProducto` VARCHAR(45) NOT NULL ,
  `descripcionProducto` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idProducto`) )
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`REQUISITO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`REQUISITO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`REQUISITO` (
  `idRequisito` INT NOT NULL AUTO_INCREMENT ,
  `descripcionRequisito` VARCHAR(45) NOT NULL ,
  `tipoRequisito` INT NOT NULL ,
  `idSociedad` INT NOT NULL ,
  PRIMARY KEY (`idRequisito`) ,
  CONSTRAINT `fk_REQUISITO_SOCIEDAD`
    FOREIGN KEY (`idSociedad` )
    REFERENCES `sociedadCivil`.`SOCIEDAD` (`idSociedad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_REQUISITO_SOCIEDAD ON `sociedadCivil`.`REQUISITO` (`idSociedad` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`NORMA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`NORMA` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`NORMA` (
  `idNorma` INT NOT NULL AUTO_INCREMENT ,
  `descripcionNorma` VARCHAR(45) NOT NULL ,
  `tipoNorma` INT NOT NULL ,
  PRIMARY KEY (`idNorma`) )
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`TRIBUNALD`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`TRIBUNALD` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`TRIBUNALD` (
  `idTribunald` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idTribunald`) )
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`SANCION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`SANCION` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`SANCION` (
  `idSancion` INT NOT NULL AUTO_INCREMENT ,
  `fechaSancion` DATE NOT NULL ,
  `idNorma` INT NOT NULL ,
  `idTribunald` INT NOT NULL ,
  PRIMARY KEY (`idSancion`) ,
  CONSTRAINT `fk_SANCION_TRIBUNALD`
    FOREIGN KEY (`idTribunald` )
    REFERENCES `sociedadCivil`.`TRIBUNALD` (`idTribunald` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SANCION_NORMA`
    FOREIGN KEY (`idNorma` )
    REFERENCES `sociedadCivil`.`NORMA` (`idNorma` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_SANCION_TRIBUNALD ON `sociedadCivil`.`SANCION` (`idTribunald` ASC) ;


CREATE INDEX fk_SANCION_NORMA ON `sociedadCivil`.`SANCION` (`idNorma` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`BENEFICIARIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`BENEFICIARIO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`BENEFICIARIO` (
  `cedulaBeneficiario` INT NOT NULL AUTO_INCREMENT ,
  `nombreBeneficiario` VARCHAR(45) NOT NULL ,
  `apellidoBeneficiario` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`cedulaBeneficiario`) )
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`ASAMBLEA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`ASAMBLEA` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`ASAMBLEA` (
  `idAsamblea` INT NOT NULL AUTO_INCREMENT ,
  `tipoAsamblea` INT NOT NULL ,
  `descripcionAsamblea` VARCHAR(45) NOT NULL ,
  `fechaAsamblea` DATE NOT NULL ,
  `idJuntadirectiva` INT NOT NULL ,
  PRIMARY KEY (`idAsamblea`) ,
  CONSTRAINT `fk_ASAMBLEA_JUNTADIRECTIVA`
    FOREIGN KEY (`idJuntadirectiva` )
    REFERENCES `sociedadCivil`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_ASAMBLEA_JUNTADIRECTIVA ON `sociedadCivil`.`ASAMBLEA` (`idJuntadirectiva` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`SUELDO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`SUELDO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`SUELDO` (
  `idSueldo` INT NOT NULL AUTO_INCREMENT ,
  `montoSueldo` INT NOT NULL ,
  PRIMARY KEY (`idSueldo`) )
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`INSCRIPCION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`INSCRIPCION` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`INSCRIPCION` (
  `idInscripcion` INT NOT NULL AUTO_INCREMENT ,
  `fechaInscripcion` DATE NOT NULL ,
  `estatusInscripcion` INT NOT NULL ,
  `fechaAInscripcion` DATE NOT NULL ,
  `montoInscripcion` INT NOT NULL ,
  `tipoInscripcion` INT NOT NULL ,
  PRIMARY KEY (`idInscripcion`) ,
  CONSTRAINT `fk_INSCRIPCION_PERSONA`
    FOREIGN KEY (`tipoInscripcion` )
    REFERENCES `sociedadCivil`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_INSCRIPCION_PERSONA ON `sociedadCivil`.`INSCRIPCION` (`tipoInscripcion` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`LISTAIE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`LISTAIE` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`LISTAIE` (
  `idListaIE` INT NOT NULL AUTO_INCREMENT ,
  `descripcionListaIE` VARCHAR(45) NOT NULL ,
  `tipoListaIE` INT NOT NULL ,
  `idSociedad` INT NOT NULL ,
  PRIMARY KEY (`idListaIE`) ,
  CONSTRAINT `fk_LISTAIE_SOCIEDAD`
    FOREIGN KEY (`idSociedad` )
    REFERENCES `sociedadCivil`.`SOCIEDAD` (`idSociedad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_LISTAIE_SOCIEDAD ON `sociedadCivil`.`LISTAIE` (`idSociedad` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`FONDO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`FONDO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`FONDO` (
  `idFondo` INT NOT NULL AUTO_INCREMENT ,
  `nombreFondo` VARCHAR(45) NOT NULL ,
  `descripcionFondo` VARCHAR(45) NOT NULL ,
  `montoFonro` INT NOT NULL ,
  `tipoFondo` INT NOT NULL ,
  PRIMARY KEY (`idFondo`) )
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`MULTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`MULTA` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`MULTA` (
  `idMulta` INT NOT NULL AUTO_INCREMENT ,
  `montoMulta` INT NOT NULL ,
  `idSancion` INT NOT NULL ,
  PRIMARY KEY (`idMulta`) ,
  CONSTRAINT `fk_MULTA_SANCION`
    FOREIGN KEY (`idSancion` )
    REFERENCES `sociedadCivil`.`SANCION` (`idSancion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_MULTA_SANCION ON `sociedadCivil`.`MULTA` (`idSancion` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`HIST_PASAJE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`HIST_PASAJE` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`HIST_PASAJE` (
  `idPasaje` INT NOT NULL ,
  `idSucursal` INT NOT NULL ,
  `fechaHistPasaje` DATE NOT NULL ,
  PRIMARY KEY (`idPasaje`, `idSucursal`) ,
  CONSTRAINT `fk_PASAJE_has_SUCURSAL_PASAJE`
    FOREIGN KEY (`idPasaje` )
    REFERENCES `sociedadCivil`.`PASAJE` (`idPasaje` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PASAJE_has_SUCURSAL_SUCURSAL`
    FOREIGN KEY (`idSucursal` )
    REFERENCES `sociedadCivil`.`SOCIEDAD` (`idSociedad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_PASAJE_has_SUCURSAL_PASAJE ON `sociedadCivil`.`HIST_PASAJE` (`idPasaje` ASC) ;


CREATE INDEX fk_PASAJE_has_SUCURSAL_SUCURSAL ON `sociedadCivil`.`HIST_PASAJE` (`idSucursal` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`PROVEEDOR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`PROVEEDOR` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`PROVEEDOR` (
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
-- Table `sociedadCivil`.`SUCURSAL_PROV`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`SUCURSAL_PROV` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`SUCURSAL_PROV` (
  `idSucursal` INT NOT NULL ,
  `idLugar` INT NOT NULL ,
  `idProveedor` INT NOT NULL ,
  PRIMARY KEY (`idSucursal`, `idLugar`, `idProveedor`) ,
  CONSTRAINT `fk_SUCURSAL_has_PROVEEDOR_SUCURSAL`
    FOREIGN KEY (`idSucursal` , `idLugar` )
    REFERENCES `sociedadCivil`.`SOCIEDAD` (`idSociedad` , `idLugar` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SUCURSAL_has_PROVEEDOR_PROVEEDOR`
    FOREIGN KEY (`idProveedor` )
    REFERENCES `sociedadCivil`.`PROVEEDOR` (`idProveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_SUCURSAL_has_PROVEEDOR_SUCURSAL ON `sociedadCivil`.`SUCURSAL_PROV` (`idSucursal` ASC, `idLugar` ASC) ;


CREATE INDEX fk_SUCURSAL_has_PROVEEDOR_PROVEEDOR ON `sociedadCivil`.`SUCURSAL_PROV` (`idProveedor` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`PRODUCTO_PROV`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`PRODUCTO_PROV` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`PRODUCTO_PROV` (
  `idProducto` INT NOT NULL ,
  `idProveedor` INT NOT NULL ,
  `precioProductoProv` INT NOT NULL ,
  `cantidadProductoProv` INT NOT NULL ,
  PRIMARY KEY (`idProducto`, `idProveedor`) ,
  CONSTRAINT `fk_PRODUCTO_has_PROVEEDOR_PRODUCTO`
    FOREIGN KEY (`idProducto` )
    REFERENCES `sociedadCivil`.`PRODUCTO` (`idProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PRODUCTO_has_PROVEEDOR_PROVEEDOR`
    FOREIGN KEY (`idProveedor` )
    REFERENCES `sociedadCivil`.`PROVEEDOR` (`idProveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_PRODUCTO_has_PROVEEDOR_PRODUCTO ON `sociedadCivil`.`PRODUCTO_PROV` (`idProducto` ASC) ;


CREATE INDEX fk_PRODUCTO_has_PROVEEDOR_PROVEEDOR ON `sociedadCivil`.`PRODUCTO_PROV` (`idProveedor` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`SOCIO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`SOCIO` (
  `cedulaPersona` INT NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`cedulaPersona`) ,
  CONSTRAINT `fk_SOCIO_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_SOCIO_PERSONA ON `sociedadCivil`.`SOCIO` (`cedulaPersona` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`AVANCE` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`AVANCE` (
  `cedulaPersona` INT NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`cedulaPersona`) ,
  CONSTRAINT `fk_AVANCE_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_AVANCE_PERSONA ON `sociedadCivil`.`AVANCE` (`cedulaPersona` ASC) ;




-- -----------------------------------------------------
-- Table `sociedadCivil`.`SOCIO_BENEFICIARIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`SOCIO_BENEFICIARIO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`SOCIO_BENEFICIARIO` (
  `cedulaPersona` INT NOT NULL ,
  `cedulaBeneficiario` INT NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `cedulaBeneficiario`) ,
  CONSTRAINT `fk_SOCIO_has_BENEFICIARIO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_BENEFICIARIO_BENEFICIARIO`
    FOREIGN KEY (`cedulaBeneficiario` )
    REFERENCES `sociedadCivil`.`BENEFICIARIO` (`cedulaBeneficiario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_SOCIO_has_BENEFICIARIO_SOCIO ON `sociedadCivil`.`SOCIO_BENEFICIARIO` (`cedulaPersona` ASC) ;


CREATE INDEX fk_SOCIO_has_BENEFICIARIO_BENEFICIARIO ON `sociedadCivil`.`SOCIO_BENEFICIARIO` (`cedulaBeneficiario` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`AVANCE_BENEFICIARIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`AVANCE_BENEFICIARIO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`AVANCE_BENEFICIARIO` (
  `cedulaPersona` INT NOT NULL ,
  `cedulaBeneficiario` INT NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `cedulaBeneficiario`) ,
  CONSTRAINT `fk_AVANCE_has_BENEFICIARIO_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AVANCE_has_BENEFICIARIO_BENEFICIARIO`
    FOREIGN KEY (`cedulaBeneficiario` )
    REFERENCES `sociedadCivil`.`BENEFICIARIO` (`cedulaBeneficiario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_AVANCE_has_BENEFICIARIO_AVANCE ON `sociedadCivil`.`AVANCE_BENEFICIARIO` (`cedulaPersona` ASC) ;


CREATE INDEX fk_AVANCE_has_BENEFICIARIO_BENEFICIARIO ON `sociedadCivil`.`AVANCE_BENEFICIARIO` (`cedulaBeneficiario` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`VEHICULO_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`VEHICULO_AVANCE` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`VEHICULO_AVANCE` (
  `idVehiculo` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idVehiculo`, `cedulaPersona`) ,
  CONSTRAINT `fk_VEHICULO_has_AVANCE_VEHICULO`
    FOREIGN KEY (`idVehiculo` )
    REFERENCES `sociedadCivil`.`VEHICULO` (`idVehiculo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_VEHICULO_has_AVANCE_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_VEHICULO_has_AVANCE_VEHICULO ON `sociedadCivil`.`VEHICULO_AVANCE` (`idVehiculo` ASC) ;


CREATE INDEX fk_VEHICULO_has_AVANCE_AVANCE ON `sociedadCivil`.`VEHICULO_AVANCE` (`cedulaPersona` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`TRASPASO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`TRASPASO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`TRASPASO` (
  `cedulaPersona` INT NOT NULL ,
  `idVehiculo` INT NOT NULL ,
  `fechaTraspaso` DATE NOT NULL ,
 `traspadoLista` INT NOT NULL, PRIMARY KEY (`cedulaPersona`, `idVehiculo`) ,
  CONSTRAINT `fk_SOCIO_has_VEHICULO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_VEHICULO_VEHICULO`
    FOREIGN KEY (`idVehiculo` )
    REFERENCES `sociedadCivil`.`VEHICULO` (`idVehiculo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_SOCIO_has_VEHICULO_SOCIO ON `sociedadCivil`.`TRASPASO` (`cedulaPersona` ASC) ;


CREATE INDEX fk_SOCIO_has_VEHICULO_VEHICULO ON `sociedadCivil`.`TRASPASO` (`idVehiculo` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`HIST_CARGO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`HIST_CARGO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`HIST_CARGO` (
  `cedulaPersona` INT NOT NULL ,
  `fechaCargo` DATE NOT NULL ,
  `idTribunald` INT NOT NULL ,
  `idJuntadirectiva` INT NOT NULL ,
  `idJuntadirectivaOpcional` INT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idJuntadirectiva`, `idTribunald`) ,
  CONSTRAINT `fk_JUNTADIRECTIVA_has_SOCIO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_HIST_CARGO_TRIBUNALD`
    FOREIGN KEY (`idTribunald` )
    REFERENCES `sociedadCivil`.`TRIBUNALD` (`idTribunald` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_HIST_CARGO_JUNTADIRECTIVA`
    FOREIGN KEY (`idJuntadirectiva` )
    REFERENCES `sociedadCivil`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_HIST_CARGO_JUNTADIRECTIVA1`
    FOREIGN KEY (`idJuntadirectivaOpcional` )
    REFERENCES `sociedadCivil`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_JUNTADIRECTIVA_has_SOCIO_SOCIO ON `sociedadCivil`.`HIST_CARGO` (`cedulaPersona` ASC) ;
CREATE INDEX fk_HIST_CARGO_TRIBUNALD ON `sociedadCivil`.`HIST_CARGO` (`idTribunald` ASC) ;


CREATE INDEX fk_HIST_CARGO_JUNTADIRECTIVA ON `sociedadCivil`.`HIST_CARGO` (`idJuntadirectiva` ASC) ;


CREATE INDEX fk_HIST_CARGO_JUNTADIRECTIVA1 ON `sociedadCivil`.`HIST_CARGO` (`idJuntadirectivaOpcional` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`HIST_SUELDO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`HIST_SUELDO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`HIST_SUELDO` (
  `idJuntadirectiva` INT NOT NULL ,
  `idSueldo` INT NOT NULL ,
  `fechaSueldo` DATE NOT NULL ,
  PRIMARY KEY (`idJuntadirectiva`, `idSueldo`) ,
  CONSTRAINT `fk_JUNTADIRECTIVA_has_SUELDO_JUNTADIRECTIVA`
    FOREIGN KEY (`idJuntadirectiva` )
    REFERENCES `sociedadCivil`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_JUNTADIRECTIVA_has_SUELDO_SUELDO`
    FOREIGN KEY (`idSueldo` )
    REFERENCES `sociedadCivil`.`SUELDO` (`idSueldo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_JUNTADIRECTIVA_has_SUELDO_JUNTADIRECTIVA ON `sociedadCivil`.`HIST_SUELDO` (`idJuntadirectiva` ASC) ;


CREATE INDEX fk_JUNTADIRECTIVA_has_SUELDO_SUELDO ON `sociedadCivil`.`HIST_SUELDO` (`idSueldo` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`FONDOINGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`FONDOINGRESO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`FONDOINGRESO` (
  `idFondoIngreso` INT NOT NULL AUTO_INCREMENT ,
  `descripcionFondoIngreso` VARCHAR(45) NOT NULL ,
  `montoFondoIngreso` INT NOT NULL ,
  `fechaFondoIngreso` DATE NOT NULL ,
  `idFondo` INT NOT NULL ,
  PRIMARY KEY (`idFondoIngreso`) ,
  CONSTRAINT `fk_INGRESO_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `sociedadCivil`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_INGRESO_FONDO ON `sociedadCivil`.`FONDOINGRESO` (`idFondo` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`FONDOEGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`FONDOEGRESO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`FONDOEGRESO` (
  `idFondoEgreso` INT NOT NULL AUTO_INCREMENT ,
  `descripcionFondoEgreso` VARCHAR(45) NOT NULL ,
  `montoFondoEgreso` INT NOT NULL ,
  `fechaFondoEgreso` DATE NOT NULL ,
  `idFondo` INT NOT NULL ,
  PRIMARY KEY (`idFondoEgreso`) ,
  CONSTRAINT `fk_EGRESO_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `sociedadCivil`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_EGRESO_FONDO ON `sociedadCivil`.`FONDOEGRESO` (`idFondo` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`CUOTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`CUOTA` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`CUOTA` (
  `idCuota` INT NOT NULL AUTO_INCREMENT ,
  `tipoCuota` INT NOT NULL ,
  `montoCuota` INT NOT NULL ,
  PRIMARY KEY (`idCuota`) )
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`ASAMBLEA_SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`ASAMBLEA_SOCIO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`ASAMBLEA_SOCIO` (
  `idAsamblea` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idAsamblea`) ,
  CONSTRAINT `fk_SOCIO_has_ASAMBLEA_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_ASAMBLEA_ASAMBLEA`
    FOREIGN KEY (`idAsamblea` )
    REFERENCES `sociedadCivil`.`ASAMBLEA` (`idAsamblea` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_SOCIO_has_ASAMBLEA_SOCIO ON `sociedadCivil`.`ASAMBLEA_SOCIO` (`cedulaPersona` ASC) ;


CREATE INDEX fk_SOCIO_has_ASAMBLEA_ASAMBLEA ON `sociedadCivil`.`ASAMBLEA_SOCIO` (`idAsamblea` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`ASAMBLEA_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`ASAMBLEA_AVANCE` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`ASAMBLEA_AVANCE` (
  `idAsamblea` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idAsamblea`, `cedulaPersona`) ,
  CONSTRAINT `fk_ASAMBLEA_has_AVANCE_ASAMBLEA`
    FOREIGN KEY (`idAsamblea` )
    REFERENCES `sociedadCivil`.`ASAMBLEA` (`idAsamblea` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ASAMBLEA_has_AVANCE_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_ASAMBLEA_has_AVANCE_ASAMBLEA ON `sociedadCivil`.`ASAMBLEA_AVANCE` (`idAsamblea` ASC) ;


CREATE INDEX fk_ASAMBLEA_has_AVANCE_AVANCE ON `sociedadCivil`.`ASAMBLEA_AVANCE` (`cedulaPersona` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`CUOTA_SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`CUOTA_SOCIO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`CUOTA_SOCIO` (
  `cedulaPersona` INT NOT NULL ,
  `idCuota` INT NOT NULL ,
  `fechaCuota` DATE NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idCuota`) ,
  CONSTRAINT `fk_SOCIO_has_CUOTA_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_CUOTA_CUOTA`
    FOREIGN KEY (`idCuota` )
    REFERENCES `sociedadCivil`.`CUOTA` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_SOCIO_has_CUOTA_SOCIO ON `sociedadCivil`.`CUOTA_SOCIO` (`cedulaPersona` ASC) ;


CREATE INDEX fk_SOCIO_has_CUOTA_CUOTA ON `sociedadCivil`.`CUOTA_SOCIO` (`idCuota` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`CUOTA_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`CUOTA_AVANCE` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`CUOTA_AVANCE` (
  `cedulaPersona` INT NOT NULL ,
  `idCuota` INT NOT NULL ,
  `fechaCuota` DATE NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idCuota`) ,
  CONSTRAINT `fk_AVANCE_has_CUOTA_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AVANCE_has_CUOTA_CUOTA`
    FOREIGN KEY (`idCuota` )
    REFERENCES `sociedadCivil`.`CUOTA` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_AVANCE_has_CUOTA_AVANCE ON `sociedadCivil`.`CUOTA_AVANCE` (`cedulaPersona` ASC) ;


CREATE INDEX fk_AVANCE_has_CUOTA_CUOTA ON `sociedadCivil`.`CUOTA_AVANCE` (`idCuota` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`FONDO_SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`FONDO_SOCIO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`FONDO_SOCIO` (
  `idFondo` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idFondo`, `cedulaPersona`) ,
  CONSTRAINT `fk_FONDO_has_SOCIO_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `sociedadCivil`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FONDO_has_SOCIO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_FONDO_has_SOCIO_FONDO ON `sociedadCivil`.`FONDO_SOCIO` (`idFondo` ASC) ;


CREATE INDEX fk_FONDO_has_SOCIO_SOCIO ON `sociedadCivil`.`FONDO_SOCIO` (`cedulaPersona` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`FONDO_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`FONDO_AVANCE` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`FONDO_AVANCE` (
  `idFondo` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idFondo`, `cedulaPersona`) ,
  CONSTRAINT `fk_FONDO_has_AVANCE_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `sociedadCivil`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FONDO_has_AVANCE_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_FONDO_has_AVANCE_FONDO ON `sociedadCivil`.`FONDO_AVANCE` (`idFondo` ASC) ;


CREATE INDEX fk_FONDO_has_AVANCE_AVANCE ON `sociedadCivil`.`FONDO_AVANCE` (`cedulaPersona` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`PRESTAMO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`PRESTAMO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`PRESTAMO` (
  `idPrestamo` INT NOT NULL ,
  `montoPrestamo` INT NOT NULL ,
  PRIMARY KEY (`idPrestamo`) )
ENGINE = InnoDB;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`PRESTAMO_PERSONA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`PRESTAMO_PERSONA` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`PRESTAMO_PERSONA` (
  `idPrestamo` INT NOT NULL ,
  `tipoPersona` INT NOT NULL ,
  `cedulaPersonaA` INT NULL ,
  `cedulaPersonaS` INT NULL ,
  PRIMARY KEY (`idPrestamo`) ,
  CONSTRAINT `fk_AVANCE_has_PRESTAMO_AVANCE`
    FOREIGN KEY (`cedulaPersonaA` )
    REFERENCES `sociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AVANCE_has_PRESTAMO_PRESTAMO`
    FOREIGN KEY (`idPrestamo` )
    REFERENCES `sociedadCivil`.`PRESTAMO` (`idPrestamo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PRESTAMO_PERSONA_SOCIO`
    FOREIGN KEY (`cedulaPersonaS` )
    REFERENCES `sociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


CREATE INDEX fk_AVANCE_has_PRESTAMO_AVANCE ON `sociedadCivil`.`PRESTAMO_PERSONA` (`cedulaPersonaA` ASC) ;


CREATE INDEX fk_AVANCE_has_PRESTAMO_PRESTAMO ON `sociedadCivil`.`PRESTAMO_PERSONA` (`idPrestamo` ASC) ;


CREATE INDEX fk_PRESTAMO_PERSONA_SOCIO ON `sociedadCivil`.`PRESTAMO_PERSONA` (`cedulaPersonaS` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`COMPRA_VENTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`COMPRA_VENTA` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`COMPRA_VENTA` (
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
    REFERENCES `sociedadCivil`.`PRODUCTO_PROV` (`idProducto` , `idProveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMPRA_VENTA_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `sociedadCivil`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_COMPRA_VENTA_PRODUCTO_PROV ON `sociedadCivil`.`COMPRA_VENTA` (`idProducto` ASC, `idProveedor` ASC) ;


CREATE INDEX fk_COMPRA_VENTA_PERSONA ON `sociedadCivil`.`COMPRA_VENTA` (`cedulaPersona` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`EGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`EGRESO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`EGRESO` (
  `idEgreso` INT NOT NULL AUTO_INCREMENT ,
  `tipoEgreso` INT NOT NULL ,
  `idPrestamo` INT NULL ,
  `idFondoEgreso` INT NULL ,
  `idSueldo` INT NULL ,
  `idCompraVenta` INT NULL ,
  PRIMARY KEY (`idEgreso`) ,
  CONSTRAINT `fk_EGRESO_PRESTAMO`
    FOREIGN KEY (`idPrestamo` )
    REFERENCES `sociedadCivil`.`PRESTAMO` (`idPrestamo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EGRESO_FONDOEGRESO`
    FOREIGN KEY (`idFondoEgreso` )
    REFERENCES `sociedadCivil`.`FONDOEGRESO` (`idFondoEgreso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EGRESO_SUELDO`
    FOREIGN KEY (`idSueldo` )
    REFERENCES `sociedadCivil`.`SUELDO` (`idSueldo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EGRESO_COMPRA_VENTA`
    FOREIGN KEY (`idCompraVenta` )
    REFERENCES `sociedadCivil`.`COMPRA_VENTA` (`idCompraVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_EGRESO_PRESTAMO ON `sociedadCivil`.`EGRESO` (`idPrestamo` ASC) ;


CREATE INDEX fk_EGRESO_FONDOEGRESO ON `sociedadCivil`.`EGRESO` (`idFondoEgreso` ASC) ;


CREATE INDEX fk_EGRESO_SUELDO ON `sociedadCivil`.`EGRESO` (`idSueldo` ASC) ;


CREATE INDEX fk_EGRESO_COMPRA_VENTA ON `sociedadCivil`.`EGRESO` (`idCompraVenta` ASC) ;





-- -----------------------------------------------------
-- Table `sociedadCivil`.`INGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sociedadCivil`.`INGRESO` ;


CREATE  TABLE IF NOT EXISTS `sociedadCivil`.`INGRESO` (
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
    REFERENCES `sociedadCivil`.`MULTA` (`idMulta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_CUOTA_SOCIO`
    FOREIGN KEY (`idCuotaSocio` )
    REFERENCES `sociedadCivil`.`CUOTA_SOCIO` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_CUOTA_AVANCE`
    FOREIGN KEY (`idCuotaAvance` )
    REFERENCES `sociedadCivil`.`CUOTA_AVANCE` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_INSCRIPCION`
    FOREIGN KEY (`idInscripcion` )
    REFERENCES `sociedadCivil`.`INSCRIPCION` (`idInscripcion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_COMPRA_VENTA`
    FOREIGN KEY (`idCompraVenta` )
    REFERENCES `sociedadCivil`.`COMPRA_VENTA` (`idCompraVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_FONDOINGRESO`
    FOREIGN KEY (`idFondoIngreso` )
    REFERENCES `sociedadCivil`.`FONDOINGRESO` (`idFondoIngreso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX fk_INGRESO_MULTA ON `sociedadCivil`.`INGRESO` (`idMulta` ASC) ;


CREATE INDEX fk_INGRESO_CUOTA_SOCIO ON `sociedadCivil`.`INGRESO` (`idCuotaSocio` ASC) ;


CREATE INDEX fk_INGRESO_CUOTA_AVANCE ON `sociedadCivil`.`INGRESO` (`idCuotaAvance` ASC) ;


CREATE INDEX fk_INGRESO_INSCRIPCION ON `sociedadCivil`.`INGRESO` (`idInscripcion` ASC) ;


CREATE INDEX fk_INGRESO_COMPRA_VENTA ON `sociedadCivil`.`INGRESO` (`idCompraVenta` ASC) ;


CREATE INDEX fk_INGRESO_FONDOINGRESO ON `sociedadCivil`.`INGRESO` (`idFondoIngreso` ASC) ;




SET SQL_MODE=@OLD_SQL_MODE;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
