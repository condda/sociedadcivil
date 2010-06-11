<?php

		require_once("../classes/Panel.php");
		include "../db/conexion.php";
		
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel ("../html/facturaPrestamo.html");
		
		$pnlmenu->add("activo6",'id="active"');		//Coloca en Verde el link de Prestamo
			
		//Colocar Links
		
		$pnlmenu->add("opcion1",'<a href="solicitarPrestamo.php">Solicitar Prestamo</a>');
		$pnlmenu->add("opcion2",'<a href="condicionesPrestamo.php">Junta Directiva - Condiciones de Prestamo</a>');
		$pnlmenu->add("opcion3",'<a href="listaFactura.php">Consultar Factura de Prestamos</a>');
		
		//Request
		
		$idPrestamo = $_REQUEST['idPrestamo'];
		
		//Consulta BD
		
		$solicitanteBD = mysql_query("SELECT * FROM prestamo, prestamo_persona, persona WHERE
									 prestamo.idPrestamo = '$idPrestamo' AND
									 prestamo_persona.idPrestamo = '$idPrestamo' AND
									 persona.cedulaPersona = prestamo_persona.cedulaPersona");
		//Traduccion de datos
		
		$solicitante = mysql_fetch_assoc($solicitanteBD);
		
		//Llenado de campos
		
		$pnlcontent->add("nombre",$solicitante['nombrePersona']);
		$pnlcontent->add("apellido",$solicitante['apellidoPersona']);
		$pnlcontent->add("cedula",$solicitante['cedulaPersona']);
		$pnlcontent->add("total",$solicitante['montoPrestamo']);
		
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>