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
	
	
	//Consulta DB
	
	$ventaBD = mysql_query("SELECT * FROM compra_venta WHERE tipoCompraVenta = 2");
	
	//Traduccion de datos
	
	$venta = mysql_fetch_assoc($ventaBD);
	
	//Llenar Lista
	
	while ($venta)
	{
		$lista = $lista.'<tr>
		<td>'.$venta['idCompraVenta'].'</td>
		<td>'.$venta['idCompraVenta'].'</td>
		</tr>';
		$venta = mysql_fetch_assoc($ventaBD);
	}
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>