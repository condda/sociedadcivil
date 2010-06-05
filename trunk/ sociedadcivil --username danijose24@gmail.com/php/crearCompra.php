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

	$pnlcontent = new Panel("../html/crearCompra.html");
	


	$result = mysql_query ("select * from proveedor");
	
	
	while ($result1 = mysql_fetch_assoc($result)){
		
		$listaProveedor = $listaProveedor.'<option value="'.$result1['idProveedor'].'">'.$result1['nombreProveedor'].'</option>';

	}
	
	
	$pnlcontent->add("proveedor",$listaProveedor);
	$pnlmain->add("content",$pnlcontent);
	
	
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);

	
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	