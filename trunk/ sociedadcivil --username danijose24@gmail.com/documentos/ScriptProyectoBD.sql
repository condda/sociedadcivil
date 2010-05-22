SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `SociedadCivil` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `SociedadCivil`;

-- -----------------------------------------------------
-- Table `SociedadCivil`.`PERSONA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`PERSONA` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`PERSONA` (
  `cedulaPersona` INT NOT NULL AUTO_INCREMENT ,
  `nombrePersona` VARCHAR(45) NOT NULL ,
  `apellidoPersona` VARCHAR(45) NOT NULL ,
  `fechaNPersona` VARCHAR(45) NOT NULL ,
  `sexoPersona` CHAR NOT NULL ,
  `nacionalidadPersona` VARCHAR(45) NOT NULL ,
  `direccionPersona` VARCHAR(45) NOT NULL ,
  `telefonoPersona` INT NOT NULL ,
  `fechaLPersona` VARCHAR(45) NOT NULL ,
  `estadoCPersona` VARCHAR(45) NOT NULL ,
  `nombreCPersona` VARCHAR(45) NULL ,
  PRIMARY KEY (`cedulaPersona`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`VEHICULO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`VEHICULO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`VEHICULO` (
  `idVehiculo` INT NOT NULL AUTO_INCREMENT ,
  `anoVehiculo` YEAR NOT NULL ,
  `estadoVehiculo` VARCHAR(45) NOT NULL ,
  `polizaVehiculo` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idVehiculo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`JUNTADIRECTIVA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`JUNTADIRECTIVA` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`JUNTADIRECTIVA` (
  `idJuntadirectiva` INT NOT NULL AUTO_INCREMENT ,
  `nombreJuntadirectiva` VARCHAR(45) NOT NULL ,
  `descripcionJuntadirectiva` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idJuntadirectiva`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`LUGAR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`LUGAR` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`LUGAR` (
  `idLugar` INT NOT NULL AUTO_INCREMENT ,
  `nombreLugar` VARCHAR(45) NOT NULL ,
  `padreLugar` INT NULL ,
  PRIMARY KEY (`idLugar`) ,
  CONSTRAINT `fk_LUGAR_LUGAR`
    FOREIGN KEY (`padreLugar` )
    REFERENCES `SociedadCivil`.`LUGAR` (`idLugar` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_LUGAR_LUGAR ON `SociedadCivil`.`LUGAR` (`padreLugar` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`SOCIEDAD`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`SOCIEDAD` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`SOCIEDAD` (
  `idSociedad` INT NOT NULL AUTO_INCREMENT ,
  `telefonoSociedad` INT NOT NULL ,
  `idLugar` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idSociedad`) ,
  CONSTRAINT `fk_SUCURSAL_LUGAR`
    FOREIGN KEY (`idLugar` )
    REFERENCES `SociedadCivil`.`LUGAR` (`idLugar` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SUCURSAL_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_SUCURSAL_LUGAR ON `SociedadCivil`.`SOCIEDAD` (`idLugar` ASC) ;

CREATE INDEX fk_SUCURSAL_PERSONA ON `SociedadCivil`.`SOCIEDAD` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`RUTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`RUTA` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`RUTA` (
  `idRuta` INT NOT NULL AUTO_INCREMENT ,
  `descripcionRuta` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idRuta`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`PASAJE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`PASAJE` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`PASAJE` (
  `idPasaje` INT NOT NULL AUTO_INCREMENT ,
  `costoPasaje` INT NOT NULL ,
  `idRuta` INT NOT NULL ,
  PRIMARY KEY (`idPasaje`) ,
  CONSTRAINT `fk_PASAJE_RUTA`
    FOREIGN KEY (`idRuta` )
    REFERENCES `SociedadCivil`.`RUTA` (`idRuta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_PASAJE_RUTA ON `SociedadCivil`.`PASAJE` (`idRuta` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`PRODUCTO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`PRODUCTO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`PRODUCTO` (
  `idProducto` INT NOT NULL AUTO_INCREMENT ,
  `nombreProducto` VARCHAR(45) NOT NULL ,
  `descripcionProducto` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idProducto`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`REQUISITO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`REQUISITO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`REQUISITO` (
  `idRequisito` INT NOT NULL AUTO_INCREMENT ,
  `descripcionRequisito` VARCHAR(45) NOT NULL ,
  `tipoRequisito` INT NOT NULL ,
  `idSociedad` INT NOT NULL ,
  PRIMARY KEY (`idRequisito`) ,
  CONSTRAINT `fk_REQUISITO_SOCIEDAD`
    FOREIGN KEY (`idSociedad` )
    REFERENCES `SociedadCivil`.`SOCIEDAD` (`idSociedad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_REQUISITO_SOCIEDAD ON `SociedadCivil`.`REQUISITO` (`idSociedad` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`NORMA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`NORMA` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`NORMA` (
  `idNorma` INT NOT NULL AUTO_INCREMENT ,
  `descripcionNorma` VARCHAR(45) NOT NULL ,
  `tipoNorma` INT NOT NULL ,
  PRIMARY KEY (`idNorma`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`TRIBUNALD`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`TRIBUNALD` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`TRIBUNALD` (
  `idTribunald` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idTribunald`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`SANCION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`SANCION` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`SANCION` (
  `idSancion` INT NOT NULL AUTO_INCREMENT ,
  `fechaSancion` DATE NOT NULL ,
  `idNorma` INT NOT NULL ,
  `idTribunald` INT NOT NULL ,
  PRIMARY KEY (`idSancion`) ,
  CONSTRAINT `fk_SANCION_TRIBUNALD`
    FOREIGN KEY (`idTribunald` )
    REFERENCES `SociedadCivil`.`TRIBUNALD` (`idTribunald` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SANCION_NORMA`
    FOREIGN KEY (`idNorma` )
    REFERENCES `SociedadCivil`.`NORMA` (`idNorma` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_SANCION_TRIBUNALD ON `SociedadCivil`.`SANCION` (`idTribunald` ASC) ;

CREATE INDEX fk_SANCION_NORMA ON `SociedadCivil`.`SANCION` (`idNorma` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`BENIFICIARIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`BENIFICIARIO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`BENIFICIARIO` (
  `cedulaBeneficiario` INT NOT NULL AUTO_INCREMENT ,
  `nombreBeneficiario` VARCHAR(45) NOT NULL ,
  `apellidoBeneficiario` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`cedulaBeneficiario`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`ASAMBLEA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`ASAMBLEA` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`ASAMBLEA` (
  `idAsamblea` INT NOT NULL AUTO_INCREMENT ,
  `tipoAsamblea` INT NOT NULL ,
  `descripcionAsamblea` VARCHAR(45) NOT NULL ,
  `fechaAsamblea` DATE NOT NULL ,
  `idJuntadirectiva` INT NOT NULL ,
  PRIMARY KEY (`idAsamblea`) ,
  CONSTRAINT `fk_ASAMBLEA_JUNTADIRECTIVA`
    FOREIGN KEY (`idJuntadirectiva` )
    REFERENCES `SociedadCivil`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_ASAMBLEA_JUNTADIRECTIVA ON `SociedadCivil`.`ASAMBLEA` (`idJuntadirectiva` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`SUELDO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`SUELDO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`SUELDO` (
  `idSueldo` INT NOT NULL AUTO_INCREMENT ,
  `montoSueldo` INT NOT NULL ,
  PRIMARY KEY (`idSueldo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`INSCRIPCION`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`INSCRIPCION` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`INSCRIPCION` (
  `idInscripcion` INT NOT NULL AUTO_INCREMENT ,
  `fechaInscripcion` DATE NOT NULL ,
  `estatusInscripcion` INT NOT NULL ,
  `fechaAInscripcion` DATE NULL ,
  `montoInscripcion` INT NULL ,
  `tipoInscripcion` INT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idInscripcion`) ,
  CONSTRAINT `fk_INSCRIPCION_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_INSCRIPCION_PERSONA ON `SociedadCivil`.`INSCRIPCION` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`LISTAIE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`LISTAIE` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`LISTAIE` (
  `idListaIE` INT NOT NULL AUTO_INCREMENT ,
  `descripcionListaIE` VARCHAR(45) NOT NULL ,
  `tipoListaIE` INT NOT NULL ,
  `idSociedad` INT NOT NULL ,
  PRIMARY KEY (`idListaIE`) ,
  CONSTRAINT `fk_LISTAIE_SOCIEDAD`
    FOREIGN KEY (`idSociedad` )
    REFERENCES `SociedadCivil`.`SOCIEDAD` (`idSociedad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_LISTAIE_SOCIEDAD ON `SociedadCivil`.`LISTAIE` (`idSociedad` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`FONDO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`FONDO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`FONDO` (
  `idFondo` INT NOT NULL AUTO_INCREMENT ,
  `nombreFondo` VARCHAR(45) NOT NULL ,
  `descripcionFondo` VARCHAR(45) NOT NULL ,
  `montoFonro` INT NOT NULL ,
  `tipoFondo` INT NOT NULL ,
  PRIMARY KEY (`idFondo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`MULTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`MULTA` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`MULTA` (
  `idMulta` INT NOT NULL AUTO_INCREMENT ,
  `montoMulta` INT NOT NULL ,
  `idSancion` INT NOT NULL ,
  PRIMARY KEY (`idMulta`) ,
  CONSTRAINT `fk_MULTA_SANCION`
    FOREIGN KEY (`idSancion` )
    REFERENCES `SociedadCivil`.`SANCION` (`idSancion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_MULTA_SANCION ON `SociedadCivil`.`MULTA` (`idSancion` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`HIST_PASAJE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`HIST_PASAJE` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`HIST_PASAJE` (
  `idPasaje` INT NOT NULL ,
  `idSucursal` INT NOT NULL ,
  `fechaHistPasaje` DATE NOT NULL ,
  PRIMARY KEY (`idPasaje`, `idSucursal`) ,
  CONSTRAINT `fk_PASAJE_has_SUCURSAL_PASAJE`
    FOREIGN KEY (`idPasaje` )
    REFERENCES `SociedadCivil`.`PASAJE` (`idPasaje` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PASAJE_has_SUCURSAL_SUCURSAL`
    FOREIGN KEY (`idSucursal` )
    REFERENCES `SociedadCivil`.`SOCIEDAD` (`idSociedad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_PASAJE_has_SUCURSAL_PASAJE ON `SociedadCivil`.`HIST_PASAJE` (`idPasaje` ASC) ;

CREATE INDEX fk_PASAJE_has_SUCURSAL_SUCURSAL ON `SociedadCivil`.`HIST_PASAJE` (`idSucursal` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`PROVEEDOR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`PROVEEDOR` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`PROVEEDOR` (
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
-- Table `SociedadCivil`.`SUCURSAL_PROV`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`SUCURSAL_PROV` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`SUCURSAL_PROV` (
  `idSucursal` INT NOT NULL ,
  `idLugar` INT NOT NULL ,
  `idProveedor` INT NOT NULL ,
  PRIMARY KEY (`idSucursal`, `idLugar`, `idProveedor`) ,
  CONSTRAINT `fk_SUCURSAL_has_PROVEEDOR_SUCURSAL`
    FOREIGN KEY (`idSucursal` , `idLugar` )
    REFERENCES `SociedadCivil`.`SOCIEDAD` (`idSociedad` , `idLugar` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SUCURSAL_has_PROVEEDOR_PROVEEDOR`
    FOREIGN KEY (`idProveedor` )
    REFERENCES `SociedadCivil`.`PROVEEDOR` (`idProveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_SUCURSAL_has_PROVEEDOR_SUCURSAL ON `SociedadCivil`.`SUCURSAL_PROV` (`idSucursal` ASC, `idLugar` ASC) ;

CREATE INDEX fk_SUCURSAL_has_PROVEEDOR_PROVEEDOR ON `SociedadCivil`.`SUCURSAL_PROV` (`idProveedor` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`PRODUCTO_PROV`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`PRODUCTO_PROV` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`PRODUCTO_PROV` (
  `idProducto` INT NOT NULL ,
  `idProveedor` INT NOT NULL ,
  `precioProductoProv` INT NOT NULL ,
  `cantidadProductoProv` INT NOT NULL ,
  PRIMARY KEY (`idProducto`, `idProveedor`) ,
  CONSTRAINT `fk_PRODUCTO_has_PROVEEDOR_PRODUCTO`
    FOREIGN KEY (`idProducto` )
    REFERENCES `SociedadCivil`.`PRODUCTO` (`idProducto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PRODUCTO_has_PROVEEDOR_PROVEEDOR`
    FOREIGN KEY (`idProveedor` )
    REFERENCES `SociedadCivil`.`PROVEEDOR` (`idProveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_PRODUCTO_has_PROVEEDOR_PRODUCTO ON `SociedadCivil`.`PRODUCTO_PROV` (`idProducto` ASC) ;

CREATE INDEX fk_PRODUCTO_has_PROVEEDOR_PROVEEDOR ON `SociedadCivil`.`PRODUCTO_PROV` (`idProveedor` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`SOCIO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`SOCIO` (
  `cedulaPersona` INT NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`cedulaPersona`) ,
  CONSTRAINT `fk_SOCIO_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_SOCIO_PERSONA ON `SociedadCivil`.`SOCIO` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`AVANCE` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`AVANCE` (
  `cedulaPersona` INT NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`cedulaPersona`) ,
  CONSTRAINT `fk_AVANCE_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_AVANCE_PERSONA ON `SociedadCivil`.`AVANCE` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`SOCIO_BENEFICIARIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`SOCIO_BENEFICIARIO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`SOCIO_BENEFICIARIO` (
  `cedulaPersona` INT NOT NULL ,
  `cedulaBeneficiario` INT NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `cedulaBeneficiario`) ,
  CONSTRAINT `fk_SOCIO_has_BENIFICIARIO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_BENIFICIARIO_BENIFICIARIO`
    FOREIGN KEY (`cedulaBeneficiario` )
    REFERENCES `SociedadCivil`.`BENIFICIARIO` (`cedulaBeneficiario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_SOCIO_has_BENIFICIARIO_SOCIO ON `SociedadCivil`.`SOCIO_BENEFICIARIO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_SOCIO_has_BENIFICIARIO_BENIFICIARIO ON `SociedadCivil`.`SOCIO_BENEFICIARIO` (`cedulaBeneficiario` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`AVANCE_BENIFICIARIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`AVANCE_BENIFICIARIO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`AVANCE_BENIFICIARIO` (
  `cedulaPersona` INT NOT NULL ,
  `cedulaBeneficiario` INT NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `cedulaBeneficiario`) ,
  CONSTRAINT `fk_AVANCE_has_BENIFICIARIO_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AVANCE_has_BENIFICIARIO_BENIFICIARIO`
    FOREIGN KEY (`cedulaBeneficiario` )
    REFERENCES `SociedadCivil`.`BENIFICIARIO` (`cedulaBeneficiario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_AVANCE_has_BENIFICIARIO_AVANCE ON `SociedadCivil`.`AVANCE_BENIFICIARIO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_AVANCE_has_BENIFICIARIO_BENIFICIARIO ON `SociedadCivil`.`AVANCE_BENIFICIARIO` (`cedulaBeneficiario` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`VEHICULO_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`VEHICULO_AVANCE` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`VEHICULO_AVANCE` (
  `idVehiculo` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idVehiculo`, `cedulaPersona`) ,
  CONSTRAINT `fk_VEHICULO_has_AVANCE_VEHICULO`
    FOREIGN KEY (`idVehiculo` )
    REFERENCES `SociedadCivil`.`VEHICULO` (`idVehiculo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_VEHICULO_has_AVANCE_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_VEHICULO_has_AVANCE_VEHICULO ON `SociedadCivil`.`VEHICULO_AVANCE` (`idVehiculo` ASC) ;

CREATE INDEX fk_VEHICULO_has_AVANCE_AVANCE ON `SociedadCivil`.`VEHICULO_AVANCE` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`TRASPASO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`TRASPASO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`TRASPASO` (
  `cedulaPersona` INT NOT NULL ,
  `idVehiculo` INT NOT NULL ,
  `fechaTraspaso` DATE NOT NULL ,
  `traspasoLista` INT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idVehiculo`) ,
  CONSTRAINT `fk_SOCIO_has_VEHICULO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_VEHICULO_VEHICULO`
    FOREIGN KEY (`idVehiculo` )
    REFERENCES `SociedadCivil`.`VEHICULO` (`idVehiculo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_SOCIO_has_VEHICULO_SOCIO ON `SociedadCivil`.`TRASPASO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_SOCIO_has_VEHICULO_VEHICULO ON `SociedadCivil`.`TRASPASO` (`idVehiculo` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`HIST_CARGO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`HIST_CARGO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`HIST_CARGO` (
  `cedulaPersona` INT NOT NULL ,
  `fechaCargo` DATE NOT NULL ,
  `idTribunald` INT NOT NULL ,
  `idJuntadirectiva` INT NOT NULL ,
  `idJuntadirectivaOpcional` INT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idJuntadirectiva`, `idTribunald`) ,
  CONSTRAINT `fk_JUNTADIRECTIVA_has_SOCIO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_HIST_CARGO_TRIBUNALD`
    FOREIGN KEY (`idTribunald` )
    REFERENCES `SociedadCivil`.`TRIBUNALD` (`idTribunald` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_HIST_CARGO_JUNTADIRECTIVA`
    FOREIGN KEY (`idJuntadirectiva` )
    REFERENCES `SociedadCivil`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_HIST_CARGO_JUNTADIRECTIVA1`
    FOREIGN KEY (`idJuntadirectivaOpcional` )
    REFERENCES `SociedadCivil`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_JUNTADIRECTIVA_has_SOCIO_SOCIO ON `SociedadCivil`.`HIST_CARGO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_HIST_CARGO_TRIBUNALD ON `SociedadCivil`.`HIST_CARGO` (`idTribunald` ASC) ;

CREATE INDEX fk_HIST_CARGO_JUNTADIRECTIVA ON `SociedadCivil`.`HIST_CARGO` (`idJuntadirectiva` ASC) ;

CREATE INDEX fk_HIST_CARGO_JUNTADIRECTIVA1 ON `SociedadCivil`.`HIST_CARGO` (`idJuntadirectivaOpcional` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`HIST_SUELDO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`HIST_SUELDO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`HIST_SUELDO` (
  `idJuntadirectiva` INT NOT NULL ,
  `idSueldo` INT NOT NULL ,
  `fechaSueldo` DATE NOT NULL ,
  PRIMARY KEY (`idJuntadirectiva`, `idSueldo`) ,
  CONSTRAINT `fk_JUNTADIRECTIVA_has_SUELDO_JUNTADIRECTIVA`
    FOREIGN KEY (`idJuntadirectiva` )
    REFERENCES `SociedadCivil`.`JUNTADIRECTIVA` (`idJuntadirectiva` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_JUNTADIRECTIVA_has_SUELDO_SUELDO`
    FOREIGN KEY (`idSueldo` )
    REFERENCES `SociedadCivil`.`SUELDO` (`idSueldo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_JUNTADIRECTIVA_has_SUELDO_JUNTADIRECTIVA ON `SociedadCivil`.`HIST_SUELDO` (`idJuntadirectiva` ASC) ;

CREATE INDEX fk_JUNTADIRECTIVA_has_SUELDO_SUELDO ON `SociedadCivil`.`HIST_SUELDO` (`idSueldo` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`FONDOINGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`FONDOINGRESO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`FONDOINGRESO` (
  `idFondoIngreso` INT NOT NULL AUTO_INCREMENT ,
  `descripcionFondoIngreso` VARCHAR(45) NOT NULL ,
  `montoFondoIngreso` INT NOT NULL ,
  `fechaFondoIngreso` DATE NOT NULL ,
  `idFondo` INT NOT NULL ,
  PRIMARY KEY (`idFondoIngreso`) ,
  CONSTRAINT `fk_INGRESO_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `SociedadCivil`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_INGRESO_FONDO ON `SociedadCivil`.`FONDOINGRESO` (`idFondo` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`FONDOEGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`FONDOEGRESO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`FONDOEGRESO` (
  `idFondoEgreso` INT NOT NULL AUTO_INCREMENT ,
  `descripcionFondoEgreso` VARCHAR(45) NOT NULL ,
  `montoFondoEgreso` INT NOT NULL ,
  `fechaFondoEgreso` DATE NOT NULL ,
  `idFondo` INT NOT NULL ,
  PRIMARY KEY (`idFondoEgreso`) ,
  CONSTRAINT `fk_EGRESO_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `SociedadCivil`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_EGRESO_FONDO ON `SociedadCivil`.`FONDOEGRESO` (`idFondo` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`CUOTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`CUOTA` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`CUOTA` (
  `idCuota` INT NOT NULL AUTO_INCREMENT ,
  `tipoCuota` INT NOT NULL ,
  `montoCuota` INT NOT NULL ,
  PRIMARY KEY (`idCuota`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`ASAMBLEA_SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`ASAMBLEA_SOCIO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`ASAMBLEA_SOCIO` (
  `idAsamblea` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idAsamblea`) ,
  CONSTRAINT `fk_SOCIO_has_ASAMBLEA_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_ASAMBLEA_ASAMBLEA`
    FOREIGN KEY (`idAsamblea` )
    REFERENCES `SociedadCivil`.`ASAMBLEA` (`idAsamblea` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_SOCIO_has_ASAMBLEA_SOCIO ON `SociedadCivil`.`ASAMBLEA_SOCIO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_SOCIO_has_ASAMBLEA_ASAMBLEA ON `SociedadCivil`.`ASAMBLEA_SOCIO` (`idAsamblea` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`ASAMBLEA_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`ASAMBLEA_AVANCE` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`ASAMBLEA_AVANCE` (
  `idAsamblea` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idAsamblea`, `cedulaPersona`) ,
  CONSTRAINT `fk_ASAMBLEA_has_AVANCE_ASAMBLEA`
    FOREIGN KEY (`idAsamblea` )
    REFERENCES `SociedadCivil`.`ASAMBLEA` (`idAsamblea` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ASAMBLEA_has_AVANCE_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_ASAMBLEA_has_AVANCE_ASAMBLEA ON `SociedadCivil`.`ASAMBLEA_AVANCE` (`idAsamblea` ASC) ;

CREATE INDEX fk_ASAMBLEA_has_AVANCE_AVANCE ON `SociedadCivil`.`ASAMBLEA_AVANCE` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`CUOTA_SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`CUOTA_SOCIO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`CUOTA_SOCIO` (
  `cedulaPersona` INT NOT NULL ,
  `idCuota` INT NOT NULL ,
  `fechaCuota` DATE NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idCuota`) ,
  CONSTRAINT `fk_SOCIO_has_CUOTA_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOCIO_has_CUOTA_CUOTA`
    FOREIGN KEY (`idCuota` )
    REFERENCES `SociedadCivil`.`CUOTA` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_SOCIO_has_CUOTA_SOCIO ON `SociedadCivil`.`CUOTA_SOCIO` (`cedulaPersona` ASC) ;

CREATE INDEX fk_SOCIO_has_CUOTA_CUOTA ON `SociedadCivil`.`CUOTA_SOCIO` (`idCuota` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`CUOTA_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`CUOTA_AVANCE` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`CUOTA_AVANCE` (
  `cedulaPersona` INT NOT NULL ,
  `idCuota` INT NOT NULL ,
  `fechaCuota` DATE NOT NULL ,
  PRIMARY KEY (`cedulaPersona`, `idCuota`) ,
  CONSTRAINT `fk_AVANCE_has_CUOTA_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AVANCE_has_CUOTA_CUOTA`
    FOREIGN KEY (`idCuota` )
    REFERENCES `SociedadCivil`.`CUOTA` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_AVANCE_has_CUOTA_AVANCE ON `SociedadCivil`.`CUOTA_AVANCE` (`cedulaPersona` ASC) ;

CREATE INDEX fk_AVANCE_has_CUOTA_CUOTA ON `SociedadCivil`.`CUOTA_AVANCE` (`idCuota` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`FONDO_SOCIO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`FONDO_SOCIO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`FONDO_SOCIO` (
  `idFondo` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idFondo`, `cedulaPersona`) ,
  CONSTRAINT `fk_FONDO_has_SOCIO_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `SociedadCivil`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FONDO_has_SOCIO_SOCIO`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_FONDO_has_SOCIO_FONDO ON `SociedadCivil`.`FONDO_SOCIO` (`idFondo` ASC) ;

CREATE INDEX fk_FONDO_has_SOCIO_SOCIO ON `SociedadCivil`.`FONDO_SOCIO` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`FONDO_AVANCE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`FONDO_AVANCE` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`FONDO_AVANCE` (
  `idFondo` INT NOT NULL ,
  `cedulaPersona` INT NOT NULL ,
  PRIMARY KEY (`idFondo`, `cedulaPersona`) ,
  CONSTRAINT `fk_FONDO_has_AVANCE_FONDO`
    FOREIGN KEY (`idFondo` )
    REFERENCES `SociedadCivil`.`FONDO` (`idFondo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_FONDO_has_AVANCE_AVANCE`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_FONDO_has_AVANCE_FONDO ON `SociedadCivil`.`FONDO_AVANCE` (`idFondo` ASC) ;

CREATE INDEX fk_FONDO_has_AVANCE_AVANCE ON `SociedadCivil`.`FONDO_AVANCE` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`PRESTAMO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`PRESTAMO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`PRESTAMO` (
  `idPrestamo` INT NOT NULL ,
  `montoPrestamo` INT NOT NULL ,
  PRIMARY KEY (`idPrestamo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`PRESTAMO_PERSONA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`PRESTAMO_PERSONA` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`PRESTAMO_PERSONA` (
  `idPrestamo` INT NOT NULL ,
  `tipoPersona` INT NOT NULL ,
  `cedulaPersonaA` INT NULL ,
  `cedulaPersonaS` INT NULL ,
  PRIMARY KEY (`idPrestamo`) ,
  CONSTRAINT `fk_AVANCE_has_PRESTAMO_AVANCE`
    FOREIGN KEY (`cedulaPersonaA` )
    REFERENCES `SociedadCivil`.`AVANCE` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AVANCE_has_PRESTAMO_PRESTAMO`
    FOREIGN KEY (`idPrestamo` )
    REFERENCES `SociedadCivil`.`PRESTAMO` (`idPrestamo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PRESTAMO_PERSONA_SOCIO`
    FOREIGN KEY (`cedulaPersonaS` )
    REFERENCES `SociedadCivil`.`SOCIO` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX fk_AVANCE_has_PRESTAMO_AVANCE ON `SociedadCivil`.`PRESTAMO_PERSONA` (`cedulaPersonaA` ASC) ;

CREATE INDEX fk_AVANCE_has_PRESTAMO_PRESTAMO ON `SociedadCivil`.`PRESTAMO_PERSONA` (`idPrestamo` ASC) ;

CREATE INDEX fk_PRESTAMO_PERSONA_SOCIO ON `SociedadCivil`.`PRESTAMO_PERSONA` (`cedulaPersonaS` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`COMPRA_VENTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`COMPRA_VENTA` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`COMPRA_VENTA` (
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
    REFERENCES `SociedadCivil`.`PRODUCTO_PROV` (`idProducto` , `idProveedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMPRA_VENTA_PERSONA`
    FOREIGN KEY (`cedulaPersona` )
    REFERENCES `SociedadCivil`.`PERSONA` (`cedulaPersona` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_COMPRA_VENTA_PRODUCTO_PROV ON `SociedadCivil`.`COMPRA_VENTA` (`idProducto` ASC, `idProveedor` ASC) ;

CREATE INDEX fk_COMPRA_VENTA_PERSONA ON `SociedadCivil`.`COMPRA_VENTA` (`cedulaPersona` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`EGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`EGRESO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`EGRESO` (
  `idEgreso` INT NOT NULL AUTO_INCREMENT ,
  `tipoEgreso` INT NOT NULL ,
  `idPrestamo` INT NULL ,
  `idFondoEgreso` INT NULL ,
  `idSueldo` INT NULL ,
  `idCompraVenta` INT NULL ,
  PRIMARY KEY (`idEgreso`) ,
  CONSTRAINT `fk_EGRESO_PRESTAMO`
    FOREIGN KEY (`idPrestamo` )
    REFERENCES `SociedadCivil`.`PRESTAMO` (`idPrestamo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EGRESO_FONDOEGRESO`
    FOREIGN KEY (`idFondoEgreso` )
    REFERENCES `SociedadCivil`.`FONDOEGRESO` (`idFondoEgreso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EGRESO_SUELDO`
    FOREIGN KEY (`idSueldo` )
    REFERENCES `SociedadCivil`.`SUELDO` (`idSueldo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EGRESO_COMPRA_VENTA`
    FOREIGN KEY (`idCompraVenta` )
    REFERENCES `SociedadCivil`.`COMPRA_VENTA` (`idCompraVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_EGRESO_PRESTAMO ON `SociedadCivil`.`EGRESO` (`idPrestamo` ASC) ;

CREATE INDEX fk_EGRESO_FONDOEGRESO ON `SociedadCivil`.`EGRESO` (`idFondoEgreso` ASC) ;

CREATE INDEX fk_EGRESO_SUELDO ON `SociedadCivil`.`EGRESO` (`idSueldo` ASC) ;

CREATE INDEX fk_EGRESO_COMPRA_VENTA ON `SociedadCivil`.`EGRESO` (`idCompraVenta` ASC) ;


-- -----------------------------------------------------
-- Table `SociedadCivil`.`INGRESO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SociedadCivil`.`INGRESO` ;

CREATE  TABLE IF NOT EXISTS `SociedadCivil`.`INGRESO` (
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
    REFERENCES `SociedadCivil`.`MULTA` (`idMulta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_CUOTA_SOCIO`
    FOREIGN KEY (`idCuotaSocio` )
    REFERENCES `SociedadCivil`.`CUOTA_SOCIO` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_CUOTA_AVANCE`
    FOREIGN KEY (`idCuotaAvance` )
    REFERENCES `SociedadCivil`.`CUOTA_AVANCE` (`idCuota` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_INSCRIPCION`
    FOREIGN KEY (`idInscripcion` )
    REFERENCES `SociedadCivil`.`INSCRIPCION` (`idInscripcion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_COMPRA_VENTA`
    FOREIGN KEY (`idCompraVenta` )
    REFERENCES `SociedadCivil`.`COMPRA_VENTA` (`idCompraVenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_INGRESO_FONDOINGRESO`
    FOREIGN KEY (`idFondoIngreso` )
    REFERENCES `SociedadCivil`.`FONDOINGRESO` (`idFondoIngreso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX fk_INGRESO_MULTA ON `SociedadCivil`.`INGRESO` (`idMulta` ASC) ;

CREATE INDEX fk_INGRESO_CUOTA_SOCIO ON `SociedadCivil`.`INGRESO` (`idCuotaSocio` ASC) ;

CREATE INDEX fk_INGRESO_CUOTA_AVANCE ON `SociedadCivil`.`INGRESO` (`idCuotaAvance` ASC) ;

CREATE INDEX fk_INGRESO_INSCRIPCION ON `SociedadCivil`.`INGRESO` (`idInscripcion` ASC) ;

CREATE INDEX fk_INGRESO_COMPRA_VENTA ON `SociedadCivil`.`INGRESO` (`idCompraVenta` ASC) ;

CREATE INDEX fk_INGRESO_FONDOINGRESO ON `SociedadCivil`.`INGRESO` (`idFondoIngreso` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
