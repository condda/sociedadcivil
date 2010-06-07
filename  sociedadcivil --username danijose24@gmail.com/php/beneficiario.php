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
	$pnlcontent = new Panel("../html/crearBeneficiario.html");

	$pnlcontent = new Panel("../html/plantillaContent.html");
	
	$pnlcontent->add("nombre",'Beneficiario');
	$pnlcontent->add("crear",'<a href="fCrearBeneficiario.php">Crear Beneficiario</a>');
	$pnlcontent->add("modificar",'<a href="modificarBeneficiario.php">Modificar Beneficiario</a>');
	$pnlcontent->add("eliminar",'<a href="eliminarBeneficiario.php">Eliminar Beneficiario</a>');
	$pnlcontent->add("consultar",'<a href="consultarBeneficiario.php">Consultar Beneficiario</a>');
	
	$pnlmain->add("content",$pnlcontent);
	
	
	$pnlcontent->add("nombre","Beneficiario");
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	