<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";

	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlcontent = new Panel("../html/crearPasaje.html");

	extract ($_POST);
	
	$result = mysql_query("select * from ruta");
		while($result1 = mysql_fetch_assoc($result)){
			extract($result1);
			$listaPasaje = $listaPasaje.'<option value="'.$idRuta.'">'.$descripcionRuta.'</option>';
		}
		$pnlcontent->add("opcion",$listaPasaje);
		
	if(($costo) && ($listaRuta!=0)){
		$result = mysql_query("INSERT INTO pasaje (
					`idPasaje` ,
					`costoPasaje` ,
					`idRuta`
					)
					VALUES (
					NULL , '$costo', '$listaRuta'
					)");
		
		$ultimoId = mysql_insert_id(); 
		mysql_query("INSERT INTO hist_pasaje (
					`idPasaje` ,
					`idSucursal` ,
					`fechaHistPasaje`
					)
					VALUES (
					'$ultimoId', '1', '$date1'
					)");
							
		$pnlmenu = new Panel("../html/menu.html");
		$pnlmenu->add("activo",'id="active"');
		$pnlmenu->add("opcion1",'<a href="../php/pasaje.php">Pasaje</a>');
		$pnlmain = new Panel("../html/main.html");
		$pnlmain->add("nombre","Pasaje");
		$pnlmain->add("mensaje","Fue registrado exitosamente!");
		$pnlcontent = new Panel("../html/contentPrincipal.html");		
	}
	else
		$pnlcontent->add("mensaje",'Debe introducir todos los campos!');

	
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	