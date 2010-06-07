<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo5",'id="active"');
	$pnlmenu->add("opcion1",'<a href="cuotaOrdinaria.php">Cuota Ordinaria</a>');
	$pnlmenu->add("opcion2",'<a href="cuotaExtraordinaria.php">Cuota Extraordinaria</a>');
	
	
	$pnlcontent = new Panel ("../html/cuotaExtraordinaria.html");
	
	$result = mysql_query ("select * from fondo");
	while ($result1 = mysql_fetch_assoc($result)){
		
		$listaFondo = $listaFondo.'<option value="'.$result1['idFondo'].'">'.$result1['nombreFondo'].'</option>';
	}
	
	
	$pnlcontent->add("listaFondo",$listaFondo);
	
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	