<?php
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo3",'id="active"');
	
	$pnlmenu->add("opcion1",'<a href="juntaDirectiva.php">Junta Directiva</a>');
	$pnlmenu->add("opcion2",'<a href="tribunalDisciplinario.php">Tribunal Disciplinario</a>');
	$pnlmenu->add("opcion3",'<a href="asamblea.php">Asamblea</a>');
	$pnlmenu->add("opcion4",'<a href="cargosJuntaDirectiva.php">Cargos Junta Directiva</a>');
	$pnlmenu->add("opcion5",'<a href="cargosTribunalDisciplinario.php">Cargos Tribunal Disciplinario</a>');
	$pnlmenu->add("opcion6",'<a href="Sanciones.php">Sanciones</a>');
	
	$pnlcontent = new Panel("../html/plantillaCuota.html");
	$pnlcontent->add("nombre","Tribunal Disciplinario");
	$pnlcontent->add("crear",'<a href="crearTD.php">Crear Tribunal Disciplinario</a>');
	$pnlcontent->add("consultar",'<a href="consultarTD.php">Consultar Tribunal Disciplinario</a>');
	
	

	$pnlmain->add("content",$pnlcontent);

	
	$pnlmain->add("menu",$pnlmenu);

	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>