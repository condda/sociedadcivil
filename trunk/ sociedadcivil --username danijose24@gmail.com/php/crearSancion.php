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
	
	$pnlcontent = new Panel("../html/crearSancion.html");
	
	$result = mysql_query ("select * from norma where montoNorma = 0");
	
	while ($result1 = mysql_fetch_assoc($result)){
										
	$listaN = $listaN.'<option value="'.$result1['idNorma'].'">'.$result1['descripcionNorma'].'</option>';
	
	}
	
	$result = mysql_query ("select * from tribunald");
	
	while ($result1 = mysql_fetch_assoc($result)){
										
	$listaT = $listaT.'<option value="'.$result1['idTribunald'].'">'.$result1['nombre'].'</option>';
	
	}

	

	$pnlcontent->add("ListaNorma",$listaN);
	$pnlcontent->add("ListaTribunal",$listaT);

	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	$pnlmain->show();
	
	include "../db/cerrar_conexion.php";
?>