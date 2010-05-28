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
	
	extract($_POST);
	$pnlcontent = new Panel("../html/fConsultarBeneficiario.html");
	
	if (($_REQUEST['cedulabeneficiario']) && ($_REQUEST['cedulapersona'])){
		$cedulabeneficiario =  $_REQUEST['cedulabeneficiario'];
		$cedulapersona =  $_REQUEST['cedulapersona'];
		$result = mysql_query("select * from Beneficiario where cedulaBeneficiario = '$cedulabeneficiario'");
		$result1 = mysql_fetch_assoc($result);	
		$result2 = mysql_query("select * from Persona where cedulaPersona = '$cedulapersona'");
		$result3 = mysql_fetch_assoc($result2);			
		$pnlcontent->add("cedula",$result1['cedulaBeneficiario']);					
		$pnlcontent->add("nombre",$result1['nombreBeneficiario']);					
		$pnlcontent->add("apellido",$result1['apellidoBeneficiario']);
		$pnlcontent->add("soAv",$result3['nombrePersona'].' '.$result3['apellidoPersona']);					
		$result = mysql_query("select * from Socio_Beneficiario where cedulaBeneficiario = '$cedulabeneficiario'");
		$result1 = mysql_fetch_assoc($result);	
		if($result1)
			$pnlcontent->add("tipo","Socio");					
		else
			$pnlcontent->add("tipo","Avance");					
	}		
	/* else if ($consultarCedula){
		$result = mysql_query("select * from Producto where idProducto = '$consultarCodigo'");
		$result1 = mysql_fetch_assoc($result);
		$result2 = mysql_query("select * from Producto_Prov where idProducto='$result1[idProducto]'");
		$result3 = mysql_fetch_assoc($result2);
		$result4 = mysql_query("select * from Proveedor where idProveedor='$result3[idProveedor]'");
		$result5 = mysql_fetch_assoc($result4);
		$pnlcontent->add("codigo",$result1['idProducto']);					
		$pnlcontent->add("nombre",$result1['nombreProducto']);					
		$pnlcontent->add("descripcion",$result1['descripcionProducto']);
		$pnlcontent->add("proveedor",$result5['nombreProveedor']);					
		$pnlcontent->add("precio",$result3['precioProductoProv']);					
		$pnlcontent->add("cantidad",$result3['cantidadProductoProv']);		
		FAAAAAAAAAAAAAALTAAAAAAAAAAAAAAA ESTOOOOOOOOOOOOOOOOOOOO
	}*/
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>