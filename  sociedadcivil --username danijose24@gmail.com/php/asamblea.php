<?php

	require_once("../classes/Panel.php");
	include "../db/conexion.php";
		
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlcontent = new Panel("../html/plantillaContent.html");
	
	$pnlmenu->add("activo3",'id="active"');
	$pnlmenu->add("opcion1",'<a href="juntaDirectiva.php">Junta Directiva</a>');
	$pnlmenu->add("opcion2",'<a href="tribunalDisciplinario.php">Tribunal Disciplinario</a>');
	$pnlmenu->add("opcion3",'<a href="asamblea.php">Asamblea</a>');
	$pnlmenu->add("opcion4",'<a href="cagosJuntaDirectiva.php">Cargos Junta Directiva</a>');
	$pnlmenu->add("opcion5",'<a href="cagosTribunalDisciplinario.php">Cargos Tribunal Disciplinario</a>');
	
	$pnlcontent->add("nombre","Asamblea");
	$pnlcontent->add("crear",'<a href="crearAsamblea.php">Crear Asamblea</a>');
	$pnlcontent->add("consultar",'<a href="consultarAsamblea.php">Consultar Asamblea</a>');
	$pnlcontent->add("eliminar",'<a href="eliminarAsamblea.php">Eliminar Asamblea</a>');
	$pnlcontent->add("modificar",'<a href="modificarAsamblea.php">Modificar Asamblea</a>');
		
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->show();
		
?>