<?php
	
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	
	$pnlmenu->add("activo5",'id="active"');
	
	$pnlmenu->add("opcion1",'<a href="pagoCuota.php">Pago de cuotas</a>');	
	$pnlmenu->add("opcion2",'<a href="administrarCuota.php">Administrar cuotas</a>');
	
	$pnlcontent = new Panel("../html/consultarCuota2.html");
	
	$result = mysql_query("select * from cuota_socio CS, persona P, cuota C where CS.cedulaPersona = P.cedulaPersona AND CS.idCuota = C.idCuota");
	
	$result1 = mysql_fetch_assoc($result);
	
	if ($result1){
		listaM = '<tr><td></tr>';	
	}


	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";


?>