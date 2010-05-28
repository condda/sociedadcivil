



INSERT INTO  `sociedadcivil`.`lugar` (
`idLugar` ,
`nombreLugar` ,
`padreLugar`
)
VALUES 
('1',  'Venezuela', NULL),
('2',  'Estado Miranda',  '1'),
('3', 'Caracas', '2'),
('4', 'Municipio Libertador', '3'),
('5', 'Av. Urdaneta','4');


INSERT INTO `sociedadcivil`.`sociedad` (
`idSociedad`, 
`telefonoSociedad`, 
`idLugar`, 
`descripcionSociedad`)
 VALUES 
(NULL, '2324456', '5','La Sociedad Civil Colinas de Bello Monte ha decidido contratar sus servicios para la construcción de
una Base de Datos y un Sistema de Gestión Administrativa, que satisfaga nuestras necesidades y reglas de
negocio.
La Sociedad Civil fue fundada en 1958 y está formada por conductores profesionales de camionetas,
minibuses y autobuses clasificados “por puesto”, firmantes del Acta Constitutiva de la organización. El objeto
de la sociedad es mejorar las condiciones de vida de sus afiliados, representarlos ante cualquier organismo
público o privado, fomentar la fuente principal de trabajo de sus socios, estimular la colaboración mutua y la
protección social de sus miembros, haciendo uso de todos los medios lícitos a su alcance. El domicilio de la
Sociedad es la ciudad de Caracas, pero podrá establecer oficinas, sucursales, delegaciones, filiales o
terminales en otras ciudades del país.
Para la consecución de sus fines, la Sociedad, además de organizar eficientemente el servicio de
transporte de personas que prestan sus socios, fomentará y desarrollará otras fuentes de trabajo e ingresos que
serán de la exclusiva propiedad, responsabilidad y beneficios de sus socios, mediante acuerdos de Asamblea o
Junta Directiva. La Sociedad no tiene carácter mercantil, pero puede efectuar toda clase de operaciones,
negociaciones y transacciones comerciales a objeto de cumplir con los fines para la cual fue creada.
La Sociedad se rige por su Acta Constitutiva y sus Estatutos Sociales para su funcionamiento y para
todas las gestiones que realice. En todo lo no previsto, se regirá por las Leyes de la República que estén en
vigencia y le sean aplicables.');



INSERT INTO  `sociedadcivil`.`persona` (
`cedulaPersona` ,
`nombrePersona` ,
`apellidoPersona` ,
`fechaNPersona` ,
`sexoPersona` ,
`nacionalidadPersona` ,
`direccionPersona` ,
`telefonoPersona` ,
`fechaLPersona` ,
`estadoCPersona` ,
`nombreCPersona`,
`idSociedad`
)
VALUES 
('18213611',  'Daniel',  'Conde',  '1988-07-11',  'M',  'Venezolano',  'Urb Terrazas del Avila',  '2410461',  '2009-05-07',  'Soltero', '','1'),
('12345345',  'Pedro',  'Perez',  '1972-05-11',  'M',  'Venezolano',  'La Urbina',  '3245567',  '1992-05-12',  'Casado',  'Maria de Perez','1'),
('18933251','Lawrence','Cermeño','1989-11-03','M','Venezolano','Capuchinos','3453234','2006-02-10','Soltero','','1'),
('19044502','Leonardo','Fraile','1989-01-25','M','Venezolano','El Paraiso','4565678','2004-07-12','Soltero','','1'),
('20484534','Daniela','Mesquita','1987-07-27','F','Venezolano','Los Naranjos','4532345','2007-09-23','Soltero','','1'),
('15343467','Elio','Conde','1985-05-01','M','Venezolano','Los chorros','4533456','2003-03-14','Soltero','','1'),
('15342942','Alberto','Conde','1983-09-19','M','Venezolano','Lomas del Avila','2555467','2001-01-28','Casado','Nailibeth de Conde','1'),
('7887976','Jesus','Ramirez','1978-04-12','M','Venezolano','La Yaguara','4457786','2000-03-16','Soltero','','1'),
('6557435','Juan','Fermin','1981-02-18','M','Venezolano','Las Adjuntas','6512384','2001-03-15','Soltero','','1'),
('9886324','Carla','Acosta','1975-05-18','M','Venezolano','Petare','3426678','1998-10-23','Soltero','','1'),
('5667323','Luis','Quintero','1978-03-20','M','Venezolano','Carapita','5487692','2002-02-27','Soltero','','1'),
('5631234','Armando','Rodriguez','1982-01-17','M','Venezolano','Carapita','4352278','2001-03-20','Soltero','','1'),
('7865332','Pedro','Aponte','1978-03-19','M','Venezolano','Chacao','2358359','2000-08-14','Soltero','','1');







INSERT INTO  `sociedadcivil`.`inscripcion` (
`idInscripcion` ,
`fechaInscripcion` ,
`estatusInscripcion` ,
`fechaAInscripcion` ,
`montoInscripcion` ,
`tipoInscripcion` ,
`cedulaPersona`
)
VALUES
('NULL',   '2009-02-01',  '1','2009-03-03',  '500',  '1',  '18213611'),
('NULL',   '2009-02-12',  '1','2009-03-15',  '400',  '1',  '12345345'),
('NULL',   '2009-03-15',  '1','2009-04-23',  '430',  '1',  '18933251'),
('NULL',   '2009-03-18',  '1','2009-04-20',  '480',  '1',  '19044502'),
('NULL',   '2009-03-21',  '1','2009-04-27',  '460',  '1',  '20484534'),
('NULL',   '2009-04-13',  '1','2009-05-20',  '470',  '2',  '15343467'),
('NULL',   '2009-04-14',  '1','2009-05-18',  '520',  '2',  '15342942'),
('NULL',   '2009-04-15',  '1','2009-05-23',  '540',  '2',  '7887976'),
('NULL',   '2009-05-29',  '1','2009-07-03',  '620',  '2',  '6557435'),
('NULL',   '2009-05-30',  '1','2009-07-05',  '380',  '2',  '5631234'),
('NULL',   '2010-05-07',  '4','NULL' ,       '550',  '2',  '9886324'),
('NULL',   '2010-05-04',  '3','NULL',        '525',  '1',  '5667323'),
('NULL',   '2010-04-20',  '2','NULL',        '700',  '2',  '7865332');



INSERT INTO  `sociedadcivil`.`socio` (
`cedulaPersona`
)
VALUES
('18213611'),
('12345345'),
('18933251'),
('19044502'),
('20484534');




INSERT INTO  `sociedadcivil`.`avance` (
`cedulaPersona`
)
VALUES
('15343467'),
('15342942'),
('7887976'),
('6557435'),
('5631234');


INSERT INTO  `sociedadcivil`.`beneficiario` (
`cedulaBeneficiario` ,
`nombreBeneficiario` ,
`apellidoBeneficiario`
)
VALUES 
('13456542',  'Juan',  'Amorin'), 
('19345234',  'Patricia',  'Fuenmayor'),
('12345323','Maria','Machado'),
('17889091','Jorge','Gavidia'),
('15667897','Kevin','Cermeno'),
('13476234','Andres','Sanchez'),
('16578932','Marcos','Bifferi'),
('17426162','Armando','Antonini'),
('12970121','Anthony','Da Silva'),
('13719823','Nailibeth','Parra');




INSERT INTO  `sociedadcivil`.`socio_beneficiario` (
`cedulaPersona` ,
`cedulaBeneficiario`
)
VALUES 
('18213611','13456542'),
('12345345','19345234'),
('18933251','12345323'),
('19044502','17889091'),
('20484534','15667897');





INSERT INTO  `sociedadcivil`.`avance_beneficiario` (
`cedulaBeneficiario`,
`cedulaPersona` 
)
VALUES 
('13456234',  '15343467'),
('16578932',  '15342942'),
('17426162',  '7887976'),
('12970121',  '6557435'),
('13719823',  '5631234');







INSERT INTO  `sociedadcivil`.`traspaso` (
`idVehiculo` ,
`cedulaPersona`,
`fechaTraspaso`,
`listaTraspaso`
)
VALUES 
('13',  '18213611', '2009-02-01', '0'),
('14',  '12345345', '2009-02-12', '0'),
('15',  '18933251', '2009-03-15', '0'),
('16', '19044502', '2009-03-18', '0'),
('17', '20484534', '2009-03-21', '0'),
('18', '5667323', '2010-05-04', '0');





INSERT INTO  `sociedadcivil`.`vehiculo_avance` (
`idVehiculo` ,
`cedulaPersona`,
`fechaVehiculoAvance`
)
VALUES 
('7',  '15343467', '2010-01-25'),
('8',  '15342942', '2010-02-14'),
('9',  '7887976', '2010-01-28'),
('10', '6557435', '2010-01-10'),
('11', '5631234', '2010-03-25'),
('12', '7865332', '2010-01-27'),
('13', '9886324', '2010-03-29');




INSERT INTO  `sociedadcivil`.`vehiculo` (
`idVehiculo` ,
`placaVehiculo` ,
`anoVehiculo` ,
`estadoVehiculo` ,
`polizaVehiculo`
)
VALUES 
(NULL ,'12143'  ,'1987',  'Vehiculo en buen estado',  '23424'),
(NULL, '14536' ,'1994',  'Vehiculo perfectas condiciones', '21345'),
(NULL, '11232' ,'1999',  'El vehiculo esta en condiciones ideales', '24556'),
(NULL, '11622' ,'2003',  'Este vehiculo se encuentra en buenas condiciones', '22334'),
(NULL, '45323' ,'1988', 'transporte chevrolet de 50 puestos en buen estado', '19778'),
(NULL, '12143' ,'1997', 'mercedes benz de 100 puestos excelente condiciones', '19778'),
(NULL, '76856' ,'1989', 'alkon apto para trabajar', '19778'),
(NULL, '87953' ,'1999', 'vehiculo chevrolet en buen estado', '19778'),
(NULL, '98345' ,'2000', 'en buen estado', '19778'),
(NULL, '76898' ,'2001', 'condiciones aceptables para transportar', '19778'),
(NULL, '10989' ,'1995', 'chocado pero puede trabajar', '19778'),
(NULL, '89786' ,'1992', 'transporte en buenas condiciones mecanicas', '19778'),
(NULL, '45457' ,'1991', 'vehiculo en condiciones ideales', '19778');











INSERT INTO  `sociedadcivil`.`proveedor` (
`idProveedor` ,
`direccionProveedor` ,
`telefonoProveedor` ,
`tipoProveedor` ,
`nombreProveedor` ,
`cedulaProveedor` ,
`rifProveedor`
)
VALUES 
(NULL ,  'mariperez',  '2315566',  '2',  'Repuestos Mariperez', 'NULL' ,  'J-1223434'),
(NULL ,  'la pastora',  '2324456',  '1',  'Marcos Abreu',  '15678976', 'NULL'),
(NULL, 'la urbina', '3456782', '1', 'Mario Dominguez', '12456378', 'NULL'),
(NULL, 'los chorros', '2346899', '2', 'Toyomax Respuestos y Servicios', 'NULL', 'J-4678865'),
(NULL, 'el paraiso','7232212','1','Juan Escobar','11343665','NULL');





INSERT INTO  `sociedadcivil`.`producto` (
`idProducto` ,
`nombreProducto` ,
`descripcionProducto`
)
VALUES 
('1' , 'Camisa',  'Camisa de uniforme estandar'),
('2' , 'Pantalon',  'pantalon del uniforme'),
('3', 'Carnet', 'carnet de socios y avances'),
('4', 'Aceite', ' aceite de motor'),
('5', 'Cauchos firestone', ' Cauchos de 17"');








INSERT INTO  `sociedadcivil`.`producto_prov` (
`idProducto` ,
`idProveedor` ,
`precioProductoProv` ,
`cantidadProductoProv`
)
VALUES 
('4',  '5',  '160',  '30'),
('3',  '4',  '80',  '40'),
('5','7','30','60'),
('6','3','80','25'),
('7','6','1200','15');






















