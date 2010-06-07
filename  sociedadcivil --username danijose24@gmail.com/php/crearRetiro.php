<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlcontent = new Panel("../html/crearRetiro.html");

	extract ($_POST);
	if($razon==1)
		$pnlcontent->add("razon",'Crear Retiro por fallecimiento');
	else
		$pnlcontent->add("razon",'Crear Retiro voluntario');
	
	$pnlcontent->add("razonR",'$razon');
	
	if ($listaSoAv1==1){
		$pnlcontent->add("tipo",'Socio');
		$pnlcontent->add("soAv",'1');
		$result = mysql_query("select Socio.cedulaPersona, 
							  Persona.nombrePersona, 
							  Persona.apellidoPersona from Socio,Persona 
							  where Socio.cedulaPersona = Persona.cedulaPersona order by Persona.apellidoPersona asc;");
		while($result1 = mysql_fetch_assoc($result)){
			extract($result1);
			$listaPersonas = $listaPersonas.'<option value="'.$cedulaPersona.'">'.$apellidoPersona.', '.$nombrePersona.'</option>';
		}
		$pnlcontent->add("opcion",$listaPersonas);					
	}
	else if ($listaSoAv1==2){
		$pnlcontent->add("tipo",'Avance');
		$pnlcontent->add("soAv",'2');
		$result = mysql_query("select Avance.cedulaPersona, 
							  Persona.nombrePersona, 
							  Persona.apellidoPersona from Avance,Persona 
							  where Avance.cedulaPersona = Persona.cedulaPersona order by Persona.apellidoPersona asc;");
		while($result1 = mysql_fetch_assoc($result)){
			extract($result1);
			$listaPersonas = $listaPersonas.'<option value="'.$cedulaPersona.'">'.$apellidoPersona.', '.$nombrePersona.'</option>';
		}
		$pnlcontent->add("opcion",$listaPersonas);					
	}

	
		
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>