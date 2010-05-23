<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	
	$pnlcontent = new Panel("../html/crearProveedor.html");
	
	$cedRif = $_REQUEST['cedRif'];
	$nombre = $_REQUEST['nombre'];
	$direccion = $_REQUEST['direccion'];
	$telefono = $_REQUEST['telefono'];
	$ciRif = $_REQUEST['ciRif'];
	if (($cedRif) && ($nombre) && ($direccion) && ($telefono) && ($ciRif!=0)){
		if ($ciRif==1)
		{
			$result = mysql_query("select idProveedor from Proveedor where cedulaProveedor = '$cedRif'");
			$pnlcontent->add("cedulaS",'selected="selected"');
		}
		else if ($ciRif==2)
		{
			$result = mysql_query("select idProveedor from Proveedor where rifProveedor = '$cedRif'");
			$pnlcontent->add("rifS",'selected="selected"');
		}
		$result1 = mysql_fetch_assoc($result);
		if ($result1['idProveedor']){
			$pnlcontent->add("mensaje","Este Proveedor ya existe dentro de la Sociedad!");
			$pnlcontent->add("nombre",$nombre);					
			$pnlcontent->add("direccion",$direccion);
			$pnlcontent->add("telefono",$telefono);
			$pnlcontent->add("cedRif",$cedRif);
		}
		else if ($ciRif==1){
			mysql_query("insert into Proveedor (
			direccionProveedor,
			telefonoProveedor,
			tipoProveedor,
			nombreProveedor,
			cedulaProveedor,
			rifProveedor) values ('$direccion','$telefono','1','$nombre','$cedRif','NULL')");
			$pnlmenu = new Panel("../html/menu.html");
			$pnlmenu->add("activo",'id="active"');
			$pnlmain = new Panel("../html/main.html");
			$pnlmain->add("nombre","Proveedor");
			$pnlmain->add("mensaje","Fue registrado exitosamente!");
			$pnlcontent = new Panel("../html/contentPrincipal.html");		
		}
			
		else if ($ciRif==2){
			mysql_query("insert into Proveedor (
			'direccionProveedor',
			'telefonoProveedor',
			'tipoProveedor',
			'nombreProveedor',
			'cedulaProveedor',
			'rifProveedor') values ('$direccion','$telefono','2','$nombre','NULL',$cedRif')");
			$pnlmenu = new Panel("../html/menu.html");
			$pnlmenu->add("activo",'id="active"');
			$pnlmain = new Panel("../html/main.html");
			$pnlmain->add("nombre","Proveedor");
			$pnlmain->add("mensaje","Fue registrado exitosamente!");
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