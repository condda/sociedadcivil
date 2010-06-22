<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	$pnlcontent = new Panel("../html/crearRetiro.html");

	extract ($_POST);
	if ($listaSoAv1==1){
		$pnlcontent->add("tipo",'Socio');
		$pnlcontent->add("soAv",'1');
		$result = mysql_query("select Socio.cedulaPersona, 
							  Persona.nombrePersona, 
							  Persona.apellidoPersona from Socio,Persona 
							  where Socio.cedulaPersona = Persona.cedulaPersona and Persona.estatusPersona is NULL order by Persona.apellidoPersona asc;");
		while($result1 = mysql_fetch_assoc($result)){
			extract($result1);
			$listaPersonas = $listaPersonas.'<option value="'.$cedulaPersona.'">'.$apellidoPersona.', '.$nombrePersona.'</option>';
		}
		$pnlcontent->add("opcion",$listaPersonas);	
		
		$result = mysql_query("SELECT p.costoPasaje FROM pasaje p WHERE p.idPasaje = (
								SELECT h1.idPasaje
								FROM hist_pasaje h1
								WHERE h1.fechaHistPasaje
								IN (
								
								SELECT MAX( h2.fechaHistPasaje ) 
								FROM hist_pasaje h2
								))");
		$result1 = mysql_fetch_assoc($result);
		extract($result1);
		
		$montoCalcu=$costoPasaje*100;
		
		$result = mysql_query("select count(p.cedulaPersona) as count from socio s, persona p where s.cedulaPersona=p.cedulaPersona and p.estatusPersona is NULL;");
		$result1 = mysql_fetch_assoc($result);
		extract($result1);
		
		$montoCalcu=$montoCalcu*$count;
		$pnlcontent->add("monto",$montoCalcu);	
	}
	else if ($listaSoAv1==2){
		$pnlcontent->add("tipo",'Avance');
		$pnlcontent->add("soAv",'2');
		$result = mysql_query("select Avance.cedulaPersona, 
							  Persona.nombrePersona, 
							  Persona.apellidoPersona from Avance,Persona 
							  where Avance.cedulaPersona = Persona.cedulaPersona and Persona.estatusPersona is NULL order by Persona.apellidoPersona asc;");
		while($result1 = mysql_fetch_assoc($result)){
			extract($result1);
			$listaPersonas = $listaPersonas.'<option value="'.$cedulaPersona.'">'.$apellidoPersona.', '.$nombrePersona.'</option>';
		}
		$pnlcontent->add("opcion",$listaPersonas);	
		
		$result = mysql_query("SELECT p.costoPasaje FROM pasaje p WHERE p.idPasaje = (
								SELECT h1.idPasaje
								FROM hist_pasaje h1
								WHERE h1.fechaHistPasaje
								IN (
								
								SELECT MAX( h2.fechaHistPasaje ) 
								FROM hist_pasaje h2
								))");
		$result1 = mysql_fetch_assoc($result);
		extract($result1);
		
		$montoCalcu=$costoPasaje*100;
		
		$result = mysql_query("select count(p.cedulaPersona) as count from avance a, persona p where a.cedulaPersona=p.cedulaPersona and p.estatusPersona is NULL;");
		$result1 = mysql_fetch_assoc($result);
		extract($result1);
		
		$montoCalcu=$montoCalcu*$count;
		$pnlcontent->add("monto",$montoCalcu);	
	}
	
	if($flagInsertar==11){
		$result = mysql_query("insert into fondoegreso (idFondoEgreso,
														descripcionFondoEgreso,
														 montoFondoEgreso,
														 fechaFondoEgreso,
														 idFondo) values
														(NULL,
														 '$descripcion',
														 '$monto',
														 '$date1',
														 '3')");
		
		$ultimoId = mysql_insert_id(); 
		mysql_query("insert into egreso (tipoEgreso,
										idFondoEgreso) values
										('5',
										'$ultimoId')");

		if($soAv==1){
				mysql_query("UPDATE persona SET estatusPersona = '0' WHERE cedulaPersona = '$listaSoAv2'");				
					for ($i=1;$i<=$cont;$i=$i+1)
					{
						if (${'b'.$i})
							mysql_query("insert into fondo_socio (idFondoSocio,
																   idFondo,
																   cedulaPersona,
																   montoFondoSocio,
																   fechaFondoSocio,
																   cedulaBeneficiario) values 
																	(NULL,
																	 '3',
																	 '$listaSoAv2',
																	 '$flagMonto',
																	 '$date1',
																	 '${'b'.$i}')");															
					}		
		}
		else if($soAv==2){
				mysql_query("UPDATE persona SET estatusPersona = '0' WHERE cedulaPersona = '$listaSoAv2'");				
					for ($i=1;$i<=$cont;$i=$i+1)
					{
						if (${'b'.$i})
							mysql_query("insert into fondo_avance (idFondoAvance,
																   idFondo,
																   cedulaPersona,
																   montoFondoAvance,
																   fechaFondoAvance,
																   cedulaBeneficiario) values 
																	(NULL,
																	 '3',
																	 '$listaSoAv2',
																	 '$flagMonto',
																	 '$date1',
																	 '${'b'.$i}')");								
					}		
		}
		$pnlmenu = new Panel("../html/menu.html");
		$pnlmenu->add("activo",'id="active"');
		$pnlmain = new Panel("../html/main.html");
		$pnlmain->add("nombre","Retiro por fallecimiento");
		$pnlmain->add("mensaje","Fue registrado exitosamente!");
		$pnlcontent = new Panel("../html/contentPrincipal.html");		

	}
	
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>