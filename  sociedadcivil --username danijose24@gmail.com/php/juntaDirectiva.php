<?php

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	
	$pnlmenu->add("activo7",'id="active"');
	$pnlmenu->add("opcion1",'<a href="juntaDirectiva.php">Junta Directiva</a>');
	$pnlmenu->add("opcion2",'<a href="tribunalDisciplinario.php">Tribunal Disciplinario</a>');
	$pnlmenu->add("opcion3",'<a href="asamblea.php">Asamblea</a>');
	$pnlmenu->add("opcion4",'<a href="cagosJuntaDirectiva.php">Cargos Junta Directiva</a>');
	$pnlmenu->add("opcion5",'<a href="cagosTribunalDisciplinario.php">Cargos Tribunal Disciplinario</a>');
	
	$pnlcontent = new Panel("../html/plantillaCuota.html");
	$pnlcontent->add("nombre","Junta Directiva");
	$pnlcontent->add("crear",'<a href="crearJD.php">Crear Junta Directiva</a>');
	$pnlcontent->add("consultar",'<a href="consultarJD.php">Consultar Junta Directiva</a>');
	

	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	