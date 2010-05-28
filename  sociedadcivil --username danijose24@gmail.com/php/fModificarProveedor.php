<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	
	extract($_POST);
	/*$cedRif = $_REQUEST['cedRif'];
	$nombre = $_REQUEST['nombre'];
	$direccion = $_REQUEST['direccion'];
	$telefono = $_REQUEST['telefono'];
	$ciRif = $_REQUEST['ciRif'];
	$modificarCedRif = $_REQUEST['modificarCedRif'];*/
	$pnlcontent = new Panel("../html/fModificarProveedor.html");
	
	if ($_REQUEST['idproveedor']){
		$idproveedor =  $_REQUEST['idproveedor'];
		$result = mysql_query("select * from Proveedor where idProveedor = '$idproveedor'");
		$result1 = mysql_fetch_assoc($result);	
			
		if ($result1['cedulaProveedor']){
			$pnlcontent->add("cedulaS",'selected="selected"');
			$pnlcontent->add("cedRif",$result1['cedulaProveedor']);
		}
		else{
			$pnlcontent->add("rifS",'selected="selected"');
			$pnlcontent->add("cedRif",$result1['rifProveedor']);
		}
		$pnlcontent->add("nombre",$result1['nombreProveedor']);					
		$pnlcontent->add("direccion",$result1['direccionProveedor']);
		$pnlcontent->add("telefono",$result1['telefonoProveedor']);
		}
	else if (($ciRif != 0) && ($modificarCedRif)){
		if ($ciRif == 1)
			$result = mysql_query("select * from Proveedor where cedulaProveedor = '$modificarCedRif'");		
		else
			$result = mysql_query("select * from Proveedor where rifProveedor = '$modificarCedRif'");
		$result1 = mysql_fetch_assoc($result);
		if ($result1['cedulaProveedor']){
			$pnlcontent->add("cedulaS",'selected="selected"');
			$pnlcontent->add("cedRif",$result1['cedulaProveedor']);
		}
		else{
			$pnlcontent->add("rifS",'selected="selected"');
			$pnlcontent->add("cedRif",$result1['rifProveedor']);
		}
		$pnlcontent->add("nombre",$result1['nombreProveedor']);					
		$pnlcontent->add("direccion",$result1['direccionProveedor']);
		$pnlcontent->add("telefono",$result1['telefonoProveedor']);	
	}
	else if (($nombre) && ($direccion) && ($telefono) && ($ciRif!=0)){
		if ($ciRif==1){
			mysql_query("update Proveedor set
			direccionProveedor='$direccion',
			telefonoProveedor='$telefono',
			tipoProveedor='1',
			nombreProveedor='$nombre',
			cedulaProveedor='$cedRif',
			rifProveedor=NULL where cedulaProveedor='$cedRif'");
			$pnlmenu = new Panel("../html/menu.html");
			$pnlmenu->add("activo",'id="active"');
			$pnlmain = new Panel("../html/main.html");
			$pnlmain->add("nombre","Proveedor");
			$pnlmain->add("mensaje","Fue modificado exitosamente!");
			$pnlcontent = new Panel("../html/contentPrincipal.html");		
		}
		else if ($ciRif==2){
			mysql_query("update Proveedor set
			direccionProveedor='$direccion',
			telefonoProveedor='$telefono',
			tipoProveedor='2',
			nombreProveedor='$nombre',
			rifProveedor='$cedRif',
			cedulaProveedor=NULL where rifProveedor='$cedRif'");
			$pnlmenu = new Panel("../html/menu.html");
			$pnlmenu->add("activo",'id="active"');
			$pnlmain = new Panel("../html/main.html");
			$pnlmain->add("nombre","Proveedor");
			$pnlmain->add("mensaje","Fue modificado exitosamente!");
			$pnlcontent = new Panel("../html/contentPrincipal.html");		
		}
	}
	else{
		$pnlcontent->add("mensaje","Todos los campos son obligatorios!");
		$pnlcontent->add("nombre",$nombre);					
		$pnlcontent->add("direccion",$direccion);
		$pnlcontent->add("telefono",$telefono);
		$pnlcontent->add("cedRif",$cedRif);
	}		
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>