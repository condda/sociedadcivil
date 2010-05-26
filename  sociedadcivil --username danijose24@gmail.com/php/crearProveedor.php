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
	
	$numeroProducto = $_REQUEST['NumeroProducto'];
	
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
			cedulaProveedor) values ('$direccion','$telefono','1','$nombre','$cedRif')");
			
			
			$result = mysql_query("select idProveedor from Proveedor where cedulaProveedor = '$cedRif' order by idProveedor desc limit 1");
			$result1 = mysql_fetch_assoc($result);
			$idProveedor = $result1['idProveedor'];
			
			
			$i = 1;
			while ($i<=$numeroProducto){	
				$idProducto = $_REQUEST['codigoProducto'.$i];
				$nombreProducto = $_REQUEST['nombreProducto'.$i];
				$descripcionProducto = $_REQUEST['descripcionProducto'.$i];
				
				$cantidadProducto = $_REQUEST['cantidadProducto'.$i];
				$precioProducto = $_REQUEST['precioProducto'.$i];
			
				mysql_query("insert into Producto (
				idProducto,
				nombreProducto,
				descripcionProducto)
				values ('$idProducto','$nombreProducto','$descripcionProducto')");
				
				
				mysql_query("insert into Producto_Prov (
				idProducto,
				idProveedor,
				precioProductoProv,
				cantidadProductoProv)
				values ('$idProducto','$idProveedor','$precioProducto','$cantidadProducto')");
				
				$i = $i+1;
				
			}
			
			
			$pnlmenu = new Panel("../html/menu.html");
			$pnlmenu->add("activo",'id="active"');
			$pnlmain = new Panel("../html/main.html");
			$pnlmain->add("nombre","Proveedor");
			$pnlmain->add("mensaje","Fue registrado exitosamente!");
			$pnlcontent = new Panel("../html/contentPrincipal.html");		
			
		
		}
			
		else if ($ciRif==2){
			mysql_query("insert into Proveedor (
			direccionProveedor,
			telefonoProveedor,
			tipoProveedor,
			nombreProveedor,
			rifProveedor) values ('$direccion','$telefono','2','$nombre','$cedRif')");
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