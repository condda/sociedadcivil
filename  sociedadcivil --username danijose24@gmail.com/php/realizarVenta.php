<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlcontent = new Panel ("../html/realizarVenta.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	$pnlmenu->add("opcion3",'<a href="Comprar.php">Comprar</a>');
	$pnlmenu->add("opcion4",'<a href="Venta.php">Venta</a>');
	
	//REQUEST
	
	$idProducto = $_REQUEST['idProducto'];
	
	//Consulta BD
	
	$clienteBD = mysql_query("SELECT * FROM persona, producto, producto_prov p WHERE producto.idProducto = '$idProducto'
							 AND p.idProducto = '$idProducto'");
	
	//Traduccion de datos
	
	$cliente = mysql_fetch_assoc($clienteBD);
	
	//Llenar lista
	
	while($cliente)
			{
						$lista = $lista.'<option value="'.$cliente['cedulaPersona'].'">'.$cliente['nombrePersona'].' '
						.$cliente['apelldioPersona'].' CI: '.$cliente['cedulaPersona'].'</option>';						
						$cliente= mysql_fetch_assoc($clienteBD);
			}
	//Llenar Campos
	
		//Consulta BD
	
	$clienteBD = mysql_query("SELECT * FROM  producto, producto_prov p WHERE producto.idProducto = '$idProducto'
							 AND p.idProducto = '$idProducto'");
	
	//Traduccion de datos
	
	$cliente = mysql_fetch_assoc($clienteBD);
	
	
	$pnlcontent->add("producto",$cliente['nombreProducto'] );
	$pnlcontent->add("precio",$cliente['precioProductoProv'] );
	$pnlcontent->add("cantidad", $cliente['cantidadProductoProv']);
	
		
	$pedido = $_REQUEST['pedido'];
	$cedula = $_REQUEST['listaCliente'];
	
	
	
	if($pedido && ($pedido <= $cliente['cantidadProductoProv'] ) && $cedula )
	{
		$cantidad = $cliente['cantidadProductoProv'] - $pedido;
		
		mysql_query("UPDATE producto_prov SET cantidadProductoProv = '$cantidad' WHERE idProducto = '$idProducto'");
		
		$montoVenta = $pedido * $cliente['precioProductoProv'] ;
		
		$idCompraventaBD = mysql_query("INSERT INTO compra_venta (
											   tipoCompraVenta,
											   montoCompraVenta,
											   cantidadCompraVenta,
											   idProducto,
											   cedulaPersona
											   )
					VALUES						(
												 2,
												 '$montoVenta',
												 '$pedido',
												 '$idProducto',
												 '$cedula'							 												 
												 )");
		$ultimoID = mysql_insert_id();
		
		mysql_query ("INSERT INTO ingreso (
										   tipoIngreso,
										   idCompraVenta
										   )
					 VALUES					(
											 4,
											 '$ultimoID'
											 )");
	}
	else if(!($cedula))
	{
		$pnlcontent->add("mensaje","Debe seleccionar un cliente");
	}
	if($pedido > $cliente['cantidadProductoProv'] ) 
	$pnlcontent->add("mensaje","La cantidad solicitada excede a la disponibilidad");
		
	$pnlcontent->add("listaProducto",$lista);	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>