<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	$pnlmenu->add("opcion3",'<a href="Comprar.php">Comprar</a>');
	$pnlmenu->add("opcion4",'<a href="Venta.php">Venta</a>');

	
	extract($_POST);
	$pnlcontent = new Panel("../html/fConsultarProveedor.html");
	
	if ($_REQUEST['idproveedor']){
		$idproveedor =  $_REQUEST['idproveedor'];
		$result = mysql_query("select * from Proveedor where idProveedor = '$idproveedor'");
		$result1 = mysql_fetch_assoc($result);	
			
		if ($result1['cedulaProveedor']){
			$pnlcontent->add("tipo","Cedula");
			$pnlcontent->add("cedRif",$result1['cedulaProveedor']);
		}
		else{
			$pnlcontent->add("tipo","Rif");
			$pnlcontent->add("cedRif",$result1['rifProveedor']);
		}
		$pnlcontent->add("nombre",$result1['nombreProveedor']);					
		$pnlcontent->add("direccion",$result1['direccionProveedor']);
		$pnlcontent->add("telefono",$result1['telefonoProveedor']);
	}		
	else if (($ciRif != 0) && ($consultarCedRif)){
			if ($ciRif == 1)
				$result = mysql_query("select * from Proveedor where cedulaProveedor = '$consultarCedRif'");		
			else
				$result = mysql_query("select * from Proveedor where rifProveedor = '$consultarCedRif'");
			$result1 = mysql_fetch_assoc($result);
			if ($result1['cedulaProveedor']){
				$pnlcontent->add("tipo","Cedula");
				$pnlcontent->add("cedRif",$result1['cedulaProveedor']);
			}
			else{
				$pnlcontent->add("tipo","Rif");
				$pnlcontent->add("cedRif",$result1['rifProveedor']);
			}
			$pnlcontent->add("nombre",$result1['nombreProveedor']);					
			$pnlcontent->add("direccion",$result1['direccionProveedor']);
			$pnlcontent->add("telefono",$result1['telefonoProveedor']);	
	}
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>