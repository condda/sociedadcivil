<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
		
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	
	$pnlcontent = new Panel("../html/consultarProducto.html");
	
	$consultarProducto = $_REQUEST['consultarProducto'];
	if ($consultarProducto){
		$result = mysql_query("select idProducto from Producto where idProducto = '$consultarProducto'");		
		$result1 = mysql_fetch_assoc($result);
		if (!$result1){
			$pnlcontent->add("mensaje","Este Producto no existe dentro de la Sociedad!");
			$pnlcontent->add("consultarProducto",$consultarProducto);					
		}
	}
	else{
		$pnlcontent->add("mensaje","Todos los campos son obligatorios!");
		$pnlcontent->add("consultarProducto",$consultarProducto);					
	}

	$result = mysql_query("select * from Producto");
		
	while ($result1 = mysql_fetch_assoc($result)){
			$listaProducto = $listaProducto.
			'<tr><td>'.$result1['idProducto'].'</td>
			 <td>'.$result1['nombreProducto'].'</td>
			 <td>'.$result1['descripcionProducto'].'</td>
			 <td>'.$result1['proveedor'].'</td>
			 <td>'.$result1['precio'].'</td>
			 <td>'.$result1['cantidad'].'</td>
			 <td><a href="../php/fConsultarProducto.php?idproducto='.$result1['idProducto'].'">Consultar</a></td>
    		 </tr>';
	}
	$pnlcontent->add("consultarProducto",$listaProducto);
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>