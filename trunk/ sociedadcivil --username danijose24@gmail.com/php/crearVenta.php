<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlcontent = new Panel ("../html/crearVenta.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	$pnlmenu->add("opcion3",'<a href="Comprar.php">Comprar</a>');
	$pnlmenu->add("opcion4",'<a href="Venta.php">Venta</a>');
	
	//Consulta BD
	
	$productoBD = mysql_query("SELECT * FROM producto, producto_prov p WHERE producto.idProducto = p.idProducto");
	
	//Traduccion de datos
	
	$producto = mysql_fetch_assoc($productoBD);
	
	//Listar
	
	while($producto)
	{
		$lista = $lista.'<tr>
		<td>'.$producto['nombreProducto'].'</td>
		<td>'.$producto['descripcionProducto'].'</td>
		<td>'.$producto['precioProductoProv'].'</td>
		<td>'.$producto['cantidadProductoProv'].'</td>
		<td><a href="realizarVenta.php?idProducto='.$producto['idProducto'].'">Realizar Venta</a></td>
		</tr>';
		$producto = mysql_fetch_assoc($productoBD);
	}
	
	$pnlcontent->add("listaProducto",$lista);
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>