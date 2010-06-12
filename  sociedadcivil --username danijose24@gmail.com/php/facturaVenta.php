<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlcontent = new Panel ("../html/facturaVenta.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	$pnlmenu->add("opcion3",'<a href="Comprar.php">Comprar</a>');
	$pnlmenu->add("opcion4",'<a href="Venta.php">Venta</a>');
	
	//Request
	
	$idVenta = $_REQUEST['idVenta'];
	
		
	//Consulta BD
	
	$ventaBD = mysql_query("SELECT * FROM compra_venta cv, producto p, producto_prov prov, persona
						   WHERE cv.tipoCompraVenta = 2 AND cv.idCompraVenta = '$idVenta' AND
						   cv.idProducto = p.idProducto AND cv.idProducto = prov.idProducto
						   AND cv.cedulaPersona = persona.cedulaPersona");
	//Traduccion de Datos
	
	$venta = mysql_fetch_assoc($ventaBD);
	
	//Llenar Campos
	
	$pnlcontent->add("idVenta",$venta['idCompraVenta']);
	$pnlcontent->add("producto",$venta['nombreProducto']);
	$pnlcontent->add("descripcion",$venta['descripcionProducto']);
	$pnlcontent->add("cantidad",$venta['cantidadCompraVenta']);
	$pnlcontent->add("monto",$venta['montoCompraVenta']);
	$pnlcontent->add("cedula",$venta['cedulaPersona']);
	$pnlcontent->add("nombre",$venta['nombrePersona']);
	$pnlcontent->add("apellido",$venta['apellidoPersona']);
	$pnlcontent->add("telefono",$venta['telefonoPersona']);
	
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>