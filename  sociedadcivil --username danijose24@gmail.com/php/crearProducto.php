<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	
	$pnlcontent = new Panel("../html/crearProducto.html");
	
	
	$result = mysql_query("select * from Proveedor");
	
	
	while ($result1 = mysql_fetch_assoc($result)){
		
		$listaProveedores = $listaProveedores.'<option value="'.$result1['idProveedor'].'">'.$result1['nombreProveedor'].'</option>';
		
	}
	$pnlcontent->add("opcion",$listaProveedores);
	
	
	


	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>