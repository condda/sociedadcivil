-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 23-05-2010 a las 16:20:03
-- Versión del servidor: 5.0.51
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Base de datos: `sociedadcivil`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asamblea`
-- 

CREATE TABLE `asamblea` (
  `idAsamblea` int(11) NOT NULL auto_increment,
  `tipoAsamblea` int(11) NOT NULL,
  `descripcionAsamblea` varchar(45) NOT NULL,
  `fechaAsamblea` date NOT NULL,
  `idJuntadirectiva` int(11) NOT NULL,
  PRIMARY KEY  (`idAsamblea`),
  KEY `fk_ASAMBLEA_JUNTADIRECTIVA` (`idJuntadirectiva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `asamblea`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asamblea_avance`
-- 

CREATE TABLE `asamblea_avance` (
  `idAsamblea` int(11) NOT NULL,
  `cedulaPersona` int(11) NOT NULL,
  PRIMARY KEY  (`idAsamblea`,`cedulaPersona`),
  KEY `fk_ASAMBLEA_has_AVANCE_ASAMBLEA` (`idAsamblea`),
  KEY `fk_ASAMBLEA_has_AVANCE_AVANCE` (`cedulaPersona`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `asamblea_avance`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `asamblea_socio`
-- 

CREATE TABLE `asamblea_socio` (
  `idAsamblea` int(11) NOT NULL,
  `cedulaPersona` int(11) NOT NULL,
  PRIMARY KEY  (`cedulaPersona`,`idAsamblea`),
  KEY `fk_SOCIO_has_ASAMBLEA_SOCIO` (`cedulaPersona`),
  KEY `fk_SOCIO_has_ASAMBLEA_ASAMBLEA` (`idAsamblea`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `asamblea_socio`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `avance`
-- 

CREATE TABLE `avance` (
  `cedulaPersona` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`cedulaPersona`),
  KEY `fk_AVANCE_PERSONA` (`cedulaPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `avance`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `avance_benificiario`
-- 

CREATE TABLE `avance_benificiario` (
  `cedulaPersona` int(11) NOT NULL,
  `cedulaBeneficiario` int(11) NOT NULL,
  PRIMARY KEY  (`cedulaPersona`,`cedulaBeneficiario`),
  KEY `fk_AVANCE_has_BENIFICIARIO_AVANCE` (`cedulaPersona`),
  KEY `fk_AVANCE_has_BENIFICIARIO_BENIFICIARIO` (`cedulaBeneficiario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `avance_benificiario`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `benificiario`
-- 

CREATE TABLE `benificiario` (
  `cedulaBeneficiario` int(11) NOT NULL auto_increment,
  `nombreBeneficiario` varchar(45) NOT NULL,
  `apellidoBeneficiario` varchar(45) NOT NULL,
  PRIMARY KEY  (`cedulaBeneficiario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `benificiario`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `compra_venta`
-- 

CREATE TABLE `compra_venta` (
  `idCompraVenta` int(11) NOT NULL auto_increment,
  `tipoCompraVenta` int(11) NOT NULL,
  `montoCompraVenta` int(11) NOT NULL,
  `cantidadCompraVenta` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) default NULL,
  `cedulaPersona` int(11) default NULL,
  PRIMARY KEY  (`idCompraVenta`),
  KEY `fk_COMPRA_VENTA_PRODUCTO_PROV` (`idProducto`,`idProveedor`),
  KEY `fk_COMPRA_VENTA_PERSONA` (`cedulaPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `compra_venta`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cuota`
-- 

CREATE TABLE `cuota` (
  `idCuota` int(11) NOT NULL auto_increment,
  `tipoCuota` int(11) NOT NULL,
  `montoCuota` int(11) NOT NULL,
  PRIMARY KEY  (`idCuota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `cuota`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cuota_avance`
-- 

CREATE TABLE `cuota_avance` (
  `cedulaPersona` int(11) NOT NULL,
  `idCuota` int(11) NOT NULL,
  `fechaCuota` date NOT NULL,
  PRIMARY KEY  (`cedulaPersona`,`idCuota`),
  KEY `fk_AVANCE_has_CUOTA_AVANCE` (`cedulaPersona`),
  KEY `fk_AVANCE_has_CUOTA_CUOTA` (`idCuota`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `cuota_avance`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cuota_socio`
-- 

CREATE TABLE `cuota_socio` (
  `cedulaPersona` int(11) NOT NULL,
  `idCuota` int(11) NOT NULL,
  `fechaCuota` date NOT NULL,
  PRIMARY KEY  (`cedulaPersona`,`idCuota`),
  KEY `fk_SOCIO_has_CUOTA_SOCIO` (`cedulaPersona`),
  KEY `fk_SOCIO_has_CUOTA_CUOTA` (`idCuota`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `cuota_socio`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `egreso`
-- 

CREATE TABLE `egreso` (
  `idEgreso` int(11) NOT NULL auto_increment,
  `tipoEgreso` int(11) NOT NULL,
  `idPrestamo` int(11) default NULL,
  `idFondoEgreso` int(11) default NULL,
  `idSueldo` int(11) default NULL,
  `idCompraVenta` int(11) default NULL,
  PRIMARY KEY  (`idEgreso`),
  KEY `fk_EGRESO_PRESTAMO` (`idPrestamo`),
  KEY `fk_EGRESO_FONDOEGRESO` (`idFondoEgreso`),
  KEY `fk_EGRESO_SUELDO` (`idSueldo`),
  KEY `fk_EGRESO_COMPRA_VENTA` (`idCompraVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `egreso`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `fondo`
-- 

CREATE TABLE `fondo` (
  `idFondo` int(11) NOT NULL auto_increment,
  `nombreFondo` varchar(45) NOT NULL,
  `descripcionFondo` varchar(45) NOT NULL,
  `montoFonro` int(11) NOT NULL,
  `tipoFondo` int(11) NOT NULL,
  PRIMARY KEY  (`idFondo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `fondo`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `fondoegreso`
-- 

CREATE TABLE `fondoegreso` (
  `idFondoEgreso` int(11) NOT NULL auto_increment,
  `descripcionFondoEgreso` varchar(45) NOT NULL,
  `montoFondoEgreso` int(11) NOT NULL,
  `fechaFondoEgreso` date NOT NULL,
  `idFondo` int(11) NOT NULL,
  PRIMARY KEY  (`idFondoEgreso`),
  KEY `fk_EGRESO_FONDO` (`idFondo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `fondoegreso`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `fondoingreso`
-- 

CREATE TABLE `fondoingreso` (
  `idFondoIngreso` int(11) NOT NULL auto_increment,
  `descripcionFondoIngreso` varchar(45) NOT NULL,
  `montoFondoIngreso` int(11) NOT NULL,
  `fechaFondoIngreso` date NOT NULL,
  `idFondo` int(11) NOT NULL,
  PRIMARY KEY  (`idFondoIngreso`),
  KEY `fk_INGRESO_FONDO` (`idFondo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `fondoingreso`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `fondo_avance`
-- 

CREATE TABLE `fondo_avance` (
  `idFondo` int(11) NOT NULL,
  `cedulaPersona` int(11) NOT NULL,
  PRIMARY KEY  (`idFondo`,`cedulaPersona`),
  KEY `fk_FONDO_has_AVANCE_FONDO` (`idFondo`),
  KEY `fk_FONDO_has_AVANCE_AVANCE` (`cedulaPersona`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `fondo_avance`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `fondo_socio`
-- 

CREATE TABLE `fondo_socio` (
  `idFondo` int(11) NOT NULL,
  `cedulaPersona` int(11) NOT NULL,
  PRIMARY KEY  (`idFondo`,`cedulaPersona`),
  KEY `fk_FONDO_has_SOCIO_FONDO` (`idFondo`),
  KEY `fk_FONDO_has_SOCIO_SOCIO` (`cedulaPersona`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `fondo_socio`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `hist_cargo`
-- 

CREATE TABLE `hist_cargo` (
  `cedulaPersona` int(11) NOT NULL,
  `fechaCargo` date NOT NULL,
  `idTribunald` int(11) NOT NULL,
  `idJuntadirectiva` int(11) NOT NULL,
  `idJuntadirectivaOpcional` int(11) default NULL,
  PRIMARY KEY  (`cedulaPersona`,`idJuntadirectiva`,`idTribunald`),
  KEY `fk_JUNTADIRECTIVA_has_SOCIO_SOCIO` (`cedulaPersona`),
  KEY `fk_HIST_CARGO_TRIBUNALD` (`idTribunald`),
  KEY `fk_HIST_CARGO_JUNTADIRECTIVA` (`idJuntadirectiva`),
  KEY `fk_HIST_CARGO_JUNTADIRECTIVA1` (`idJuntadirectivaOpcional`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `hist_cargo`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `hist_pasaje`
-- 

CREATE TABLE `hist_pasaje` (
  `idPasaje` int(11) NOT NULL,
  `idSucursal` int(11) NOT NULL,
  `fechaHistPasaje` date NOT NULL,
  PRIMARY KEY  (`idPasaje`,`idSucursal`),
  KEY `fk_PASAJE_has_SUCURSAL_PASAJE` (`idPasaje`),
  KEY `fk_PASAJE_has_SUCURSAL_SUCURSAL` (`idSucursal`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `hist_pasaje`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `hist_sueldo`
-- 

CREATE TABLE `hist_sueldo` (
  `idJuntadirectiva` int(11) NOT NULL,
  `idSueldo` int(11) NOT NULL,
  `fechaSueldo` date NOT NULL,
  PRIMARY KEY  (`idJuntadirectiva`,`idSueldo`),
  KEY `fk_JUNTADIRECTIVA_has_SUELDO_JUNTADIRECTIVA` (`idJuntadirectiva`),
  KEY `fk_JUNTADIRECTIVA_has_SUELDO_SUELDO` (`idSueldo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `hist_sueldo`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ingreso`
-- 

CREATE TABLE `ingreso` (
  `idINGRESO` int(11) NOT NULL auto_increment,
  `tipoIngreso` int(11) NOT NULL,
  `idMulta` int(11) default NULL,
  `idCuotaSocio` int(11) default NULL,
  `idCuotaAvance` int(11) default NULL,
  `idInscripcion` int(11) default NULL,
  `idCompraVenta` int(11) default NULL,
  `idFondoIngreso` int(11) default NULL,
  PRIMARY KEY  (`idINGRESO`),
  KEY `fk_INGRESO_MULTA` (`idMulta`),
  KEY `fk_INGRESO_CUOTA_SOCIO` (`idCuotaSocio`),
  KEY `fk_INGRESO_CUOTA_AVANCE` (`idCuotaAvance`),
  KEY `fk_INGRESO_INSCRIPCION` (`idInscripcion`),
  KEY `fk_INGRESO_COMPRA_VENTA` (`idCompraVenta`),
  KEY `fk_INGRESO_FONDOINGRESO` (`idFondoIngreso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `ingreso`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `inscripcion`
-- 

CREATE TABLE `inscripcion` (
  `idInscripcion` int(11) NOT NULL auto_increment,
  `fechaInscripcion` date NOT NULL,
  `estatusInscripcion` int(11) NOT NULL,
  `fechaAInscripcion` date default NULL,
  `montoInscripcion` int(11) NOT NULL,
  `tipoInscripcion` int(11) NOT NULL,
  `cedulaPersona` int(11) NOT NULL,
  PRIMARY KEY  (`idInscripcion`),
  KEY `fk_INSCRIPCION_PERSONA` (`cedulaPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Volcar la base de datos para la tabla `inscripcion`
-- 

INSERT INTO `inscripcion` VALUES (3, '2010-02-01', 1, '2010-03-03', 500, 1, 12345345);
INSERT INTO `inscripcion` VALUES (4, '2010-05-07', 4, '0000-00-00', 550, 2, 18213611);
INSERT INTO `inscripcion` VALUES (5, '2010-05-04', 3, '0000-00-00', 525, 1, 18933251);
INSERT INTO `inscripcion` VALUES (6, '2010-04-20', 2, '0000-00-00', 700, 2, 19044502);
INSERT INTO `inscripcion` VALUES (7, '2010-02-12', 5, '2010-04-15', 400, 1, 20484534);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `juntadirectiva`
-- 

CREATE TABLE `juntadirectiva` (
  `idJuntadirectiva` int(11) NOT NULL auto_increment,
  `nombreJuntadirectiva` varchar(45) NOT NULL,
  `descripcionJuntadirectiva` varchar(45) NOT NULL,
  PRIMARY KEY  (`idJuntadirectiva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `juntadirectiva`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `listaie`
-- 

CREATE TABLE `listaie` (
  `idListaIE` int(11) NOT NULL auto_increment,
  `descripcionListaIE` varchar(45) NOT NULL,
  `tipoListaIE` int(11) NOT NULL,
  `idSociedad` int(11) NOT NULL,
  PRIMARY KEY  (`idListaIE`),
  KEY `fk_LISTAIE_SOCIEDAD` (`idSociedad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `listaie`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `lugar`
-- 

CREATE TABLE `lugar` (
  `idLugar` int(11) NOT NULL auto_increment,
  `nombreLugar` varchar(45) NOT NULL,
  `padreLugar` int(11) default NULL,
  PRIMARY KEY  (`idLugar`),
  KEY `fk_LUGAR_LUGAR` (`padreLugar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `lugar`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `multa`
-- 

CREATE TABLE `multa` (
  `idMulta` int(11) NOT NULL auto_increment,
  `montoMulta` int(11) NOT NULL,
  `idSancion` int(11) NOT NULL,
  PRIMARY KEY  (`idMulta`),
  KEY `fk_MULTA_SANCION` (`idSancion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `multa`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `norma`
-- 

CREATE TABLE `norma` (
  `idNorma` int(11) NOT NULL auto_increment,
  `descripcionNorma` varchar(45) NOT NULL,
  `tipoNorma` int(11) NOT NULL,
  PRIMARY KEY  (`idNorma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `norma`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `pasaje`
-- 

CREATE TABLE `pasaje` (
  `idPasaje` int(11) NOT NULL auto_increment,
  `costoPasaje` int(11) NOT NULL,
  `idRuta` int(11) NOT NULL,
  PRIMARY KEY  (`idPasaje`),
  KEY `fk_PASAJE_RUTA` (`idRuta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `pasaje`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `persona`
-- 

CREATE TABLE `persona` (
  `cedulaPersona` int(11) NOT NULL auto_increment,
  `nombrePersona` varchar(45) NOT NULL,
  `apellidoPersona` varchar(45) NOT NULL,
  `fechaNPersona` date NOT NULL,
  `sexoPersona` char(1) NOT NULL,
  `nacionalidadPersona` varchar(45) NOT NULL,
  `direccionPersona` varchar(45) NOT NULL,
  `telefonoPersona` int(11) NOT NULL,
  `fechaLPersona` date NOT NULL,
  `estadoCPersona` varchar(45) NOT NULL,
  `nombreCPersona` varchar(45) default NULL,
  PRIMARY KEY  (`cedulaPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20484535 ;

-- 
-- Volcar la base de datos para la tabla `persona`
-- 

INSERT INTO `persona` VALUES (12345345, 'Pedro', 'Perez', '1972-05-11', 'M', 'Venezolano', 'La Urbina', 3245567, '1992-05-12', 'Casado', 'Maria de Perez');
INSERT INTO `persona` VALUES (18213611, 'Daniel', 'Conde', '1988-07-11', 'M', 'Venezolano', 'Urb Terrazas del Avila', 2410461, '2009-05-07', 'Soltero', NULL);
INSERT INTO `persona` VALUES (18933251, 'Lawrence', 'Cermeño', '1989-11-03', 'M', 'Venezolano', 'Capuchinos', 3453234, '2006-02-10', 'Soltero', 'NULL');
INSERT INTO `persona` VALUES (19044502, 'Leonardo', 'Fraile', '1989-01-25', 'M', 'Venezolano', 'El Paraiso', 4565678, '2004-07-12', 'Soltero', 'NULL');
INSERT INTO `persona` VALUES (20484534, 'Daniela', 'Mesquita', '1987-07-27', 'F', 'Venezolana', 'Los Naranjos', 4532345, '2007-09-23', 'Soltero', 'NULL');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `prestamo`
-- 

CREATE TABLE `prestamo` (
  `idPrestamo` int(11) NOT NULL,
  `montoPrestamo` int(11) NOT NULL,
  PRIMARY KEY  (`idPrestamo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `prestamo`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `prestamo_persona`
-- 

CREATE TABLE `prestamo_persona` (
  `idPrestamo` int(11) NOT NULL,
  `tipoPersona` int(11) NOT NULL,
  `cedulaPersonaA` int(11) default NULL,
  `cedulaPersonaS` int(11) default NULL,
  PRIMARY KEY  (`idPrestamo`),
  KEY `fk_AVANCE_has_PRESTAMO_AVANCE` (`cedulaPersonaA`),
  KEY `fk_AVANCE_has_PRESTAMO_PRESTAMO` (`idPrestamo`),
  KEY `fk_PRESTAMO_PERSONA_SOCIO` (`cedulaPersonaS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `prestamo_persona`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `producto`
-- 

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL auto_increment,
  `nombreProducto` varchar(45) NOT NULL,
  `descripcionProducto` varchar(45) NOT NULL,
  PRIMARY KEY  (`idProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `producto`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `producto_prov`
-- 

CREATE TABLE `producto_prov` (
  `idProducto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `precioProductoProv` int(11) NOT NULL,
  `cantidadProductoProv` int(11) NOT NULL,
  PRIMARY KEY  (`idProducto`,`idProveedor`),
  KEY `fk_PRODUCTO_has_PROVEEDOR_PRODUCTO` (`idProducto`),
  KEY `fk_PRODUCTO_has_PROVEEDOR_PROVEEDOR` (`idProveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `producto_prov`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `proveedor`
-- 

CREATE TABLE `proveedor` (
  `idProveedor` int(11) NOT NULL auto_increment,
  `direccionProveedor` varchar(45) NOT NULL,
  `telefonoProveedor` int(11) NOT NULL,
  `tipoProveedor` int(11) NOT NULL,
  `nombreProveedor` varchar(45) NOT NULL,
  `cedulaProveedor` int(11) default NULL,
  `rifProveedor` varchar(45) default NULL,
  PRIMARY KEY  (`idProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `proveedor`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `requisito`
-- 

CREATE TABLE `requisito` (
  `idRequisito` int(11) NOT NULL auto_increment,
  `descripcionRequisito` varchar(45) NOT NULL,
  `tipoRequisito` int(11) NOT NULL,
  `idSociedad` int(11) NOT NULL,
  PRIMARY KEY  (`idRequisito`),
  KEY `fk_REQUISITO_SOCIEDAD` (`idSociedad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `requisito`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `ruta`
-- 

CREATE TABLE `ruta` (
  `idRuta` int(11) NOT NULL auto_increment,
  `descripcionRuta` varchar(45) NOT NULL,
  PRIMARY KEY  (`idRuta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `ruta`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sancion`
-- 

CREATE TABLE `sancion` (
  `idSancion` int(11) NOT NULL auto_increment,
  `fechaSancion` date NOT NULL,
  `idNorma` int(11) NOT NULL,
  `idTribunald` int(11) NOT NULL,
  PRIMARY KEY  (`idSancion`),
  KEY `fk_SANCION_TRIBUNALD` (`idTribunald`),
  KEY `fk_SANCION_NORMA` (`idNorma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `sancion`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sociedad`
-- 

CREATE TABLE `sociedad` (
  `idSociedad` int(11) NOT NULL auto_increment,
  `telefonoSociedad` int(11) NOT NULL,
  `idLugar` int(11) NOT NULL,
  `cedulaPersona` int(11) NOT NULL,
  PRIMARY KEY  (`idSociedad`),
  KEY `fk_SUCURSAL_LUGAR` (`idLugar`),
  KEY `fk_SUCURSAL_PERSONA` (`cedulaPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `sociedad`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `socio`
-- 

CREATE TABLE `socio` (
  `cedulaPersona` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`cedulaPersona`),
  KEY `fk_SOCIO_PERSONA` (`cedulaPersona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `socio`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `socio_beneficiario`
-- 

CREATE TABLE `socio_beneficiario` (
  `cedulaPersona` int(11) NOT NULL,
  `cedulaBeneficiario` int(11) NOT NULL,
  PRIMARY KEY  (`cedulaPersona`,`cedulaBeneficiario`),
  KEY `fk_SOCIO_has_BENIFICIARIO_SOCIO` (`cedulaPersona`),
  KEY `fk_SOCIO_has_BENIFICIARIO_BENIFICIARIO` (`cedulaBeneficiario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `socio_beneficiario`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sucursal_prov`
-- 

CREATE TABLE `sucursal_prov` (
  `idSucursal` int(11) NOT NULL,
  `idLugar` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  PRIMARY KEY  (`idSucursal`,`idLugar`,`idProveedor`),
  KEY `fk_SUCURSAL_has_PROVEEDOR_SUCURSAL` (`idSucursal`,`idLugar`),
  KEY `fk_SUCURSAL_has_PROVEEDOR_PROVEEDOR` (`idProveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `sucursal_prov`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sueldo`
-- 

CREATE TABLE `sueldo` (
  `idSueldo` int(11) NOT NULL auto_increment,
  `montoSueldo` int(11) NOT NULL,
  PRIMARY KEY  (`idSueldo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `sueldo`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `traspaso`
-- 

CREATE TABLE `traspaso` (
  `cedulaPersona` int(11) NOT NULL,
  `idVehiculo` int(11) NOT NULL,
  `fechaTraspaso` date NOT NULL,
  `traspasoLista` int(11) default NULL,
  PRIMARY KEY  (`cedulaPersona`,`idVehiculo`),
  KEY `fk_SOCIO_has_VEHICULO_SOCIO` (`cedulaPersona`),
  KEY `fk_SOCIO_has_VEHICULO_VEHICULO` (`idVehiculo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `traspaso`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `tribunald`
-- 

CREATE TABLE `tribunald` (
  `idTribunald` int(11) NOT NULL auto_increment,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY  (`idTribunald`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `tribunald`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `vehiculo`
-- 

CREATE TABLE `vehiculo` (
  `idVehiculo` int(11) NOT NULL auto_increment,
  `anoVehiculo` year(4) NOT NULL,
  `estadoVehiculo` varchar(45) NOT NULL,
  `polizaVehiculo` varchar(45) NOT NULL,
  PRIMARY KEY  (`idVehiculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `vehiculo`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `vehiculo_avance`
-- 

CREATE TABLE `vehiculo_avance` (
  `idVehiculo` int(11) NOT NULL,
  `cedulaPersona` int(11) NOT NULL,
  PRIMARY KEY  (`idVehiculo`,`cedulaPersona`),
  KEY `fk_VEHICULO_has_AVANCE_VEHICULO` (`idVehiculo`),
  KEY `fk_VEHICULO_has_AVANCE_AVANCE` (`cedulaPersona`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `vehiculo_avance`
-- 


-- 
-- Filtros para las tablas descargadas (dump)
-- 

-- 
-- Filtros para la tabla `asamblea`
-- 
ALTER TABLE `asamblea`
  ADD CONSTRAINT `fk_ASAMBLEA_JUNTADIRECTIVA` FOREIGN KEY (`idJuntadirectiva`) REFERENCES `juntadirectiva` (`idJuntadirectiva`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `avance`
-- 
ALTER TABLE `avance`
  ADD CONSTRAINT `fk_AVANCE_PERSONA` FOREIGN KEY (`cedulaPersona`) REFERENCES `persona` (`cedulaPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `compra_venta`
-- 
ALTER TABLE `compra_venta`
  ADD CONSTRAINT `fk_COMPRA_VENTA_PERSONA` FOREIGN KEY (`cedulaPersona`) REFERENCES `persona` (`cedulaPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_COMPRA_VENTA_PRODUCTO_PROV` FOREIGN KEY (`idProducto`, `idProveedor`) REFERENCES `producto_prov` (`idProducto`, `idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `egreso`
-- 
ALTER TABLE `egreso`
  ADD CONSTRAINT `fk_EGRESO_COMPRA_VENTA` FOREIGN KEY (`idCompraVenta`) REFERENCES `compra_venta` (`idCompraVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_EGRESO_FONDOEGRESO` FOREIGN KEY (`idFondoEgreso`) REFERENCES `fondoegreso` (`idFondoEgreso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_EGRESO_PRESTAMO` FOREIGN KEY (`idPrestamo`) REFERENCES `prestamo` (`idPrestamo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_EGRESO_SUELDO` FOREIGN KEY (`idSueldo`) REFERENCES `sueldo` (`idSueldo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `fondoegreso`
-- 
ALTER TABLE `fondoegreso`
  ADD CONSTRAINT `fk_EGRESO_FONDO` FOREIGN KEY (`idFondo`) REFERENCES `fondo` (`idFondo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `fondoingreso`
-- 
ALTER TABLE `fondoingreso`
  ADD CONSTRAINT `fk_INGRESO_FONDO` FOREIGN KEY (`idFondo`) REFERENCES `fondo` (`idFondo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `ingreso`
-- 
ALTER TABLE `ingreso`
  ADD CONSTRAINT `fk_INGRESO_COMPRA_VENTA` FOREIGN KEY (`idCompraVenta`) REFERENCES `compra_venta` (`idCompraVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_INGRESO_CUOTA_AVANCE` FOREIGN KEY (`idCuotaAvance`) REFERENCES `cuota_avance` (`idCuota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_INGRESO_CUOTA_SOCIO` FOREIGN KEY (`idCuotaSocio`) REFERENCES `cuota_socio` (`idCuota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_INGRESO_FONDOINGRESO` FOREIGN KEY (`idFondoIngreso`) REFERENCES `fondoingreso` (`idFondoIngreso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_INGRESO_INSCRIPCION` FOREIGN KEY (`idInscripcion`) REFERENCES `inscripcion` (`idInscripcion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_INGRESO_MULTA` FOREIGN KEY (`idMulta`) REFERENCES `multa` (`idMulta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `inscripcion`
-- 
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `fk_INSCRIPCION_PERSONA` FOREIGN KEY (`cedulaPersona`) REFERENCES `persona` (`cedulaPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `listaie`
-- 
ALTER TABLE `listaie`
  ADD CONSTRAINT `fk_LISTAIE_SOCIEDAD` FOREIGN KEY (`idSociedad`) REFERENCES `sociedad` (`idSociedad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `lugar`
-- 
ALTER TABLE `lugar`
  ADD CONSTRAINT `fk_LUGAR_LUGAR` FOREIGN KEY (`padreLugar`) REFERENCES `lugar` (`idLugar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `multa`
-- 
ALTER TABLE `multa`
  ADD CONSTRAINT `fk_MULTA_SANCION` FOREIGN KEY (`idSancion`) REFERENCES `sancion` (`idSancion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `pasaje`
-- 
ALTER TABLE `pasaje`
  ADD CONSTRAINT `fk_PASAJE_RUTA` FOREIGN KEY (`idRuta`) REFERENCES `ruta` (`idRuta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `requisito`
-- 
ALTER TABLE `requisito`
  ADD CONSTRAINT `fk_REQUISITO_SOCIEDAD` FOREIGN KEY (`idSociedad`) REFERENCES `sociedad` (`idSociedad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `sancion`
-- 
ALTER TABLE `sancion`
  ADD CONSTRAINT `fk_SANCION_NORMA` FOREIGN KEY (`idNorma`) REFERENCES `norma` (`idNorma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_SANCION_TRIBUNALD` FOREIGN KEY (`idTribunald`) REFERENCES `tribunald` (`idTribunald`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `sociedad`
-- 
ALTER TABLE `sociedad`
  ADD CONSTRAINT `fk_SUCURSAL_LUGAR` FOREIGN KEY (`idLugar`) REFERENCES `lugar` (`idLugar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_SUCURSAL_PERSONA` FOREIGN KEY (`cedulaPersona`) REFERENCES `persona` (`cedulaPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 
-- Filtros para la tabla `socio`
-- 
ALTER TABLE `socio`
  ADD CONSTRAINT `fk_SOCIO_PERSONA` FOREIGN KEY (`cedulaPersona`) REFERENCES `persona` (`cedulaPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;
