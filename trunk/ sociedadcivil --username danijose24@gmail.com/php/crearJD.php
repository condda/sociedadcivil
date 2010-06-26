<?php

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	
	$pnlmenu->add("activo3",'id="active"');
	
	$pnlmenu->add("opcion1",'<a href="juntaDirectiva.php">Junta Directiva</a>');
	$pnlmenu->add("opcion2",'<a href="tribunalDisciplinario.php">Tribunal Disciplinario</a>');
	$pnlmenu->add("opcion3",'<a href="asamblea.php">Asamblea</a>');
	$pnlmenu->add("opcion4",'<a href="cargosJuntaDirectiva.php">Cargos Junta Directiva</a>');
	$pnlmenu->add("opcion5",'<a href="cargosTribunalDisciplinario.php">Cargos Tribunal Disciplinario</a>');
	$pnlmenu->add("opcion6",'<a href="Sanciones.php">Sanciones</a>');
	
	$pnlcontent = new Panel("../html/crearJD.html");
	$pnlcontent->add("nombre","Junta Directiva");
	$pnlcontent->add("crear",'<a href="crearJD.php">Crear Junta Directiva</a>');
	$pnlcontent->add("consultar",'<a href="consultarJD.php">Consultar Junta Directiva</a>');
	
	
	$result = mysql_query ("select S.cedulaPersona, P.nombrePersona, P.apellidoPersona, I.fechaAInscripcion from persona P, socio S, inscripcion I where S.cedulaPersona = P.cedulaPersona AND S.cedulaPersona = I.cedulaPersona");
	
	while ($result1 = mysql_fetch_assoc($result)){
		$diasTranscurridos = 0;
		$diasTranscurridos = floor(abs(strtotime($date1) - strtotime($result1['fechaAInscripcion']))/86400);
		
		if ($diasTranscurridos>365){
		$listaS = $listaS.'<option value="'.$result1['cedulaPersona'].'">'.$result1['nombrePersona']." ".$result1['apellidoPersona'].'</option>';
		}
	
	
	}
	
	$result = mysql_query ("select * from juntadirectiva");
	
	while ($result1 = mysql_fetch_assoc($result)){
		
		$listaJD = $listaJD.'<option value="'.$result1['idJuntadirectiva'].'">'.$result1['nombreJuntadirectiva'].'</option>';
		}
	
	
	
	
	$pnlcontent->add("ListaSocio",$listaS);
	$pnlcontent->add("ListaCargo",$listaJD);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	