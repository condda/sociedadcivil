
----------------------------PERSONA------------------------------
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
`nombreCPersona`
)
VALUES 
('18213611',  'Daniel',  'Conde',  '1988-07-11',  'M',  'Venezolano',  'Urb Terrazas del Avila',  '2410461',  '2009-05-07',  'Soltero', NULL),
('12345345',  'Pedro',  'Perez',  '1972-05-11',  'M',  'Venezolano',  'La Urbina',  '3245567',  '1992-05-12',  'Casado',  'Maria de Perez'),
('18933251','Lawrence','Cermeño','1989-11-03','M','Venezolano','Capuchinos','3453234','2006-02-10','Soltero','NULL'),
('19044502','Leonardo','Fraile','1989-01-25','M','Venezolano','El Paraiso','4565678','2004-07-12','Soltero','NULL'),
('20484534','Daniela','Mesquina','1987-07-27','F','Venezolana','Los Naranjos','4532345','2007-09-23','Soltero','NULL');
-------------------------------------------------------------------




---------------------------INSCRIPCION------------------------------

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
('NULL' ,  '2010-02-01',  '1','2010-03-03',  '500',  '1',  '12345345'),
('NULL' ,  '2010-05-07',  '4','NULL' ,       '550',  '2',  '18213611'),
('NULL',   '2010-05-04',  '3','NULL',        '525',  '1',  '18933251'),
('NULL',   '2010-04-20',  '2','NULL',        '700',  '2',  '19044502'),
('NULL',   '2010-02-12',  '5','2010-04-15',  '400',  '1',  '20484534');

-----------------------------------------------------------------------




