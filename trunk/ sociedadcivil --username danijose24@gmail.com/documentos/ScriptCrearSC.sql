



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







INSERT INTO  `sociedadcivil`.`ingreso` (
`idIngreso` ,
`tipoIngreso` ,
`idInscripcion`
)
VALUES
('NULL', '3','1'),
('NULL', '3','2'),
('NULL', '3','3'),
('NULL', '3','4'),
('NULL', '3','5'),
('NULL', '3','6'),
('NULL', '3','7'),
('NULL', '3','8'),
('NULL', '3','9'),
('NULL', '3','10'),
('NULL', '3','11'),
('NULL', '3','12'),
('NULL', '3','13');










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
('1',  '5',  '160',  '30'),
('2',  '4',  '80',  '40'),
('3','3','30','60'),
('4','2','80','25'),
('5','1','1200','15');





INSERT INTO  `sociedadcivil`.`ruta` (
`idRuta` ,
`descripcionRuta`
)
VALUES 
('1',  'Av Urdaneta hasta la pastora'),
('2',  'Av romulo gallegos, desde la urbina hasta los dos caminos'),
('3',  'Desde metro de chacaito hasta plaza venezuela'),
('4',  'desde altamira hasta chacao'),
('5',  'metro los dos caminos los chorros');





INSERT INTO  `sociedadcivil`.`sucursal_prov` (
`idSucursal` ,
`idProveedor`
)
VALUES
('1',  '1'),
('1',  '2'),
('1',  '3'),
('1',  '4'),
('1',  '5');




INSERT INTO  `sociedadcivil`.`pasaje` (

`idPasaje` ,
`costoPasaje` ,
`idRuta`
)
VALUES 
('1',  '3',  '1'),
('2',  '2.50',  '2'),
('3',  '2',     '3'),
('4',  '3.50',  '4'),
('5',  '2',     '5');





INSERT INTO  `sociedadcivil`.`hist_pasaje` (
`idPasaje` ,
`idSucursal` ,
`fechaHistPasaje`
)
VALUES 
('1',  '1',  '2009-05-03'),
('2',  '1',  '2008-04-13'),
('3',  '1',  '2008-11-21'),
('4',  '1',  '2010-08-16'),
('5',  '1',  '2010-07-20');





INSERT INTO  `sociedadcivil`.`listaie` (
`idListaIE` ,
`descripcionListaIE` ,
`tipoListaIE` ,
`idSociedad`
)
VALUES 
('1',  'Las cuotas ordinarias que deben cancelar los socios mensualmente (conocidas como finanzas).',  '1',  '1'),
('2',  'Cuotas extraordinarias que pueden ser mensuales (ejemplos: retiros de socios, ayudas por accidentes, vidrios, choques, enfermedad, etc.).',  '1',  '1'),
('3',  'Multas de las cuotas ordinarias.(pagos retrasados ).',  '1',  '1'),
('4',  'Venta de uniformes, avisos, calcomanías.',  '1',  '1'),
('5',  'Venta de repuestos para las unidades de transporte (aceite, motores, etc.).',  '1',  '1'),
('6',  'Pago de sueldo a la Junta Directiva.',  '2',  '1'),
('7',  'Pago de servicios básicos (luz, agua, teléfono, aseo).',  '2',  '1'),
('8',  'Compra de productos de limpieza y otros artículos (café, azúcar, agua mineral, etc.)',  '2',  '1'),
('9',  'Pago a los proveedores de repuestos.',  '2',  '1'),
('10',  'Otros gastos que puedan presentarse.',  '2',  '1');








INSERT INTO  `sociedadcivil`.`norma` (
`idNorma` ,
`descripcionNorma` ,
`tipoNorma`,
`montoNorma`
)
VALUES 
('1',  'Dejar de pagar dos (2) cuotas ordinarias consecutivas.',  '2','NULL'),
('2',  'Contravenir alguna disposición emanada de la Asamblea.',  '2','NULL'),
('3',  'Tener acumuladas tres (3) sanciones consecutivas en un lapso no mayor de sesenta (60) días.',  '2','NULL'),
('4',  'Organizar actos contrarios a los fines de la sociedad.',  '2','NULL'),
('5',  'Desacreditar públicamente a la sociedad o irrespetar a los miembros de los organismos directivos.',  '2','NULL'),
('6',  'Malversar los fondos económicos de la sociedad.',  '2','NULL'),
('7',  'Ausentarse de la sociedad sin causa justificada.',  '2','NULL'),
('8',  'Cometer desfalcos o apropiaciones indebidas.',  '2','NULL'),
('9',  'Al no cancelar las finanzas mensuales ordinarias en el mes subsiguiente, no podrá trabajar el vehículo o el conductor según el caso.',  '1','NULL'),
('10',  'Las finanzas deben ser canceladas los primeros veinte (20) días del mes, pasado los vente días se debe cancelar una multa de 5 BsF.',  '1','5'),
('11',  'Las finanzas deben ser canceladas los primeros veinte (20) días del mes. Al llegar al mes siguiente debe pagar una multa de 10 BsF.',  '1','10');








INSERT INTO  `sociedadcivil`.`juntadirectiva` (
`idJuntadirectiva` ,
`nombreJuntadirectiva` ,
`descripcionJuntadirectiva`
)
VALUES 
('1',  'Presidente',  'Representa legalmente la sociedad civil ante los socios y autoridades del estado.'),
('2',  'Secretario de Organización',  'Coordina todas las actividades de administración y organización de los servicios de la sociedad. Ejerce la vigilancia sobre los libros, documentos y bienes de la sociedad.'),
('3',  'Secretario de Finanzas',  'Recibe todos los ingresos y bienes de la Sociedad, los cuales debe depositar a nombre de la misma en un banco de la localidad. Movilizar los fondos económicos, llevar los libros necesarios.'),
('4',  'Secretario de Tránsito y Reclamo',  'Recibe todos los reclamos de los socios e iniciar la tramitación de los mismos ante la JD.'),
('5',  'Secretario de Actas',  'Debe transcribir en actas, todo lo que se dice (discusiones, acuerdos, etc.) en las reuniones semanales de junta directiva y asambleas.'),
('6',  'Secretario de Cultura y Propaganda',  'Vigila el buen estado de las unidades de transporte (Ejemplo: buen estado de la tapicería, cauchos, pintura, limpieza, avisos de ruta en buen estado, identificación de la ruta, etc.); también de los conductores (Ejemplo: Aseo personal, uniforme, calzado, etc.).'),
('7',  'Secretario de Bienestar Social',  'Visita a nombre de la sociedad a todos aquellos socios que se encuentren imposibilitados de asistir al trabajo por motivos de enfermedad.');










INSERT INTO  `sociedadcivil`.`requisito` (
`idRequisito` ,
`descripcionRequisito` ,
`tipoRequisito` ,
`idSociedad`
)
VALUES 
('1',  'Ser venezolano o residente con más de cinco (5) años en el país.',  '1',  '1'),
('2',  'Ser conductor profesional (poseer licencia de 5º Grado).',  '1',  '1'),
('3',  'Ser propietario del vehículo a inscribir y tenerlo en buenas condiciones de seguridad, funcionamiento y estado de conservación interior / exterior, para cumplir a cabalidad con el servicio.',  '1',  '1'),
('4',  'Documento de propiedad del vehículo. (original y dos copias)',  '1',  '1'),
('5',  'Carta de buena conducta y certificado de residencia (original y dos copias).',  '1',  '1'),
('6',  'Licencia de conducir de 5º grado, vigente (original y dos copias).',  '1',  '1'),
('7',  'Carta de buena conducta del último trabajo (original y dos copias).',  '1',  '1'),
('8',  'Certificado médico de conducir, vigente (original y dos copias).',  '1',  '1'),
('9',  'Cédula de Identidad, vigente (original y dos copias).',  '1',  '1'),
('10',  'Cuatro (4) fotos tipo carnet.',  '1',  '1'),
('11',  'Examen antidoping negativo.',  '1',  '1'),
('12',  'No padecer ningún impedimento físico o mental.',  '1',  '1'),
('13',  'Cancelar en efectivo y al contado su inscripción, la cual pasará íntegramente a beneficio de la organización.',  '1',  '1'),
('14',  'Examen antidoping negativo.',  '1',  '1'),
('15',  'Prestar sus servicios por un período de prueba no menor a treinta(30) días a partir de la fecha de inscripción; quedando dichos aspirantes, sujetos a la aprobación por la Asamblea de Socios o de la Junta Directiva. De no ser aprobado como socio no tendrá derecho a ningún reintegro de dinero.',  '1',  '1'),
('16',  'Tener por los menos un (1) año de afiliación activa.',  '3',  '1'),
('17',  'Examen antidoping negativo.',  '3',  '1'),
('18',  'Estar solventes con sus obligaciones gremiales.',  '3',  '1'),
('19',  'Ser venezolano o residente con más de cinco (5) años en el país.',  '2',  '1'),
('20',  'Ser conductor profesional (poseer licencia de 5º Grado)',  '2',  '1'),
('21',  'Poseer vehiculo propio prestando servicio dentro de la organización',  '3',  '1'),
('22',  'Ser presentado por un Socio solvente y trabajará bajo la única responsabilidad de éste.',  '2',  '1'),
('23',  'Carta de buena conducta y certificado de residencia (original y dos copias).',  '2',  '1'),
('24',  'Licencia de conducir de 5º grado, vigente (original y dos copias).',  '2',  '1'),
('25',  'Carta de buena conducta del último trabajo (original y dos copias).',  '2',  '1'),
('26',  'Certificado médico de conducir, vigente (original y dos copias).',  '2',  '1'),
('27',  'Cédula de Identidad, vigente (original y dos copias).',  '2',  '1'),
('28',  'Cuatro (4) fotos tipo carnet.',  '2',  '1'),
('29',  'Examen antidoping negativo (original y dos copias).',  '2',  '1'),
('30',  'No padecer ningún impedimento físico o mental.',  '2',  '1'),
('31',  'Cancelar su cuota de inscripción, que pasará a fondos de la organización y en ningún caso será reintegrada.',  '2',  '1');







INSERT INTO  `sociedadcivil`.`cuota` (
`idCuota` ,
`tipoCuota` ,
`montoCuota`,
`mesCuota`,
`numeroMesCuota`
)
VALUES 
('1',  '1',  '80','Enero','01'),
('2',  '1',  '60','Febrero','02'),
('3',  '1',  '75','Marzo','03'),
('4',  '1',  '70','Abril','04'),
('5',  '1',  '80','Mayo','05'),
('6',  '1',  '90','Junio','06'),
('7',  '1',  '100','Julio','07'),
('8',  '1',  '95','Agosto','08'),
('9',  '1',  '65','Septiembre','09'),
('10',  '1',  '80','Octubre','10'),
('11',  '1',  '50','Noviembre','11'),
('12',  '1',  '30','Diciembre','12'),
('13',  '2',  '70','Enero','01'),
('14',  '2',  '90','Febrero','02'),
('15',  '2',  '100','Marzo','03'),
('16',  '2',  '30','Abril','04'),
('17',  '2',  '40','Mayo','05'),
('18',  '2',  '90','Junio','06'),
('19',  '2',  '10','Julio','07'),
('20',  '2',  '30','Agosto','08'),
('21',  '2',  '10','Septiembre','09'),
('22',  '2',  '60','Octubre','10'),
('23',  '2',  '70','Noviembre','11'),
('24',  '2',  '90','Diciembre','12');





INSERT INTO  `sociedadcivil`.`cuota_avance` (
`cedulaPersona` ,
`idCuota` ,
`fechaCuota`,
`montoCuotaAvance`
)
VALUES
('15343467',  '3',  '2010-05-03','80'),
('15342942',  '4',  '2010-05-05','80'),
('7887976',  '7',  '2010-05-10','80'),
('6557435',  '8',  '2010-04-30','70'),
('5631234',  '10',  '2010-05-01','80');






INSERT INTO  `sociedadcivil`.`cuota_socio` (
`cedulaPersona` ,
`idCuota` ,
`fechaCuota`,
`montoCuotaSocio`
)
VALUES
('18213611',  '1',  '2010-05-03','80'),
('12345345',  '2',  '2010-05-05','80'),
('18933251',  '5',  '2010-05-10','80'),
('19044502',  '6',  '2010-04-30','70'),
('20484534',  '9',  '2010-05-01','80');







INSERT INTO  `sociedadcivil`.`sueldo` (
`idSueldo` ,
`montoSueldo`
)
VALUES 
('1',  '700'),
('2',  '900'),
('3',  '950'),
('4',  '1000'),
('5',  '1050');






INSERT INTO  `sociedadcivil`.`hist_sueldo` (
`idJuntadirectiva` ,
`idSueldo` ,
`fechaSueldo`
)
VALUES 
('1',  '5',  '2010-05-02'),
('2',  '4',  '2010-03-20'),
('3',  '3',  '2010-02-15'),
('4',  '2',  '2009-11-30'),
('5',  '2',  '2009-10-02'),
('6',  '1',  '2009-11-30'),
('7',  '1',  '2009-11-30');






INSERT INTO  `sociedadcivil`.`tribunald` (
`idTribunald` ,
`nombre`
)
VALUES 
('1',  'Presidente'),
('2',  'Vice-Presidente'),
('3',  'Gerente'),
('4',  'Tesorero'),
('5',  'Secretario');





INSERT INTO  `sociedadcivil`.`fondo` (
`idFondo` ,
`nombreFondo` ,
`descripcionFondo` ,
`montoFondo` ,
`tipoFondo`
)
VALUES 
(NULL ,  'Fondo de Inversión',  'está formado por los bienes presentes y los que en un futuro ingresen a la sociedad por cualquier titulo. Para la fecha cuentan con la oficina sede ubicada en la ciudad de caracas.',  '3000',  '1'),
(NULL ,  'Fondo de Cirugía y Hospitalización',  'Formado por aportes mensuales que hacen los socios y avances, para mantener un monto que pueda cubrir las ayudas que sean solicitadas por sus afiliados. El monto tope será discutido en la Asamblea de Socios o por la Junta Directiva. Se conceden dos (2) veces al año.',  '8000',  '1'),
(NULL ,  'Fondo de Prevención Social Por Fallecimiento del Socio',  'La asociación cancelará por cada socio activo, cien (100) pasajes mínimos a (l) (los) beneficiario(s) que aparezca(n) registrado (s) en los libros de vida del Socio.',  'NULL',  '1'),
(NULL ,  'Fondo de Prevención Social Por retiro voluntario',  'La Asociación concederá un pago de diez (10) pasajes mínimos por año de servicio interrumpido por cada Socio activo. Dicha bonificación se debe cancelar junto a la cuota ordinaria. Los socios pueden recibir esta bonificación después de un (1) año de servicio.',  'NULL',  '1'),
(NULL ,  'Fondo de Accidentes o Choques, Robo e Incendio',  'El monto máximo de cobertura de este fondo lo establece la Asamblea de socios y aplica una (1) vez al año',  '2000',  '1'),
(NULL ,  'Fondo de Préstamos',  'El monto máximo de préstamo lo establece la asamblea de socios. Todos pueden solicitar préstamos, tienen sesenta (60) días para iniciar el proceso de pago. Las cuotas de los pagos serán establecidas por la JD.',  'NULL',  '1');




