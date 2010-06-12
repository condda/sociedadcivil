<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlcontent = new Panel ("../html/consultarVenta.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	$pnlmenu->add("opcion3",'<a href="Comprar.php">Comprar</a>');
	$pnlmenu->add("opcion4",'<a href="Venta.php">Venta</a>');
	
	
	//Consulta BD
	
	$ventaBD = mysql_query("SELECT * FROM compra_venta cv, producto p, producto_prov prov, persona
						   WHERE cv.tipoCompraVenta = 2 AND cv.idProducto = p.idProducto AND cv.idProducto = prov.idProducto
						   AND cv.cedulaPersona = persona.cedulaPersona");
	//Traduccion de Datos
	
	$venta = mysql_fetch_assoc($ventaBD);
	
	//Listar ventas
	
	while($venta)
	{
		$lista = $lista.'<tr>
		<td>'.$venta['idCompraVenta'].'</td>
		<td>'.$venta['nombreProducto'].'</td>
		<td>'.$venta['cantidadCompraVenta'].'</td>
		<td>'.$venta['montoCompraVenta'].'</td>
		<td><a href="facturaVenta.php?idVenta='.$venta['idCompraVenta'].'" >Consultar Venta</a></td>
		</tr>';
		
		$venta = mysql_fetch_assoc($ventaBD);
	}
	
	
	$pnlcontent->add("listaVenta",$lista);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>