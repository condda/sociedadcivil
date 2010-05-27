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
			$idProducto = $result1['idProducto'];
			$result2 = mysql_query("select Prov.nombreProveedor, Prod.precioProductoProv, Prod.cantidadProductoProv from Producto_prov Prod, Proveedor Prov 
								   where Prod.idProducto = '$idProducto' AND Prod.idProveedor = Prov.idProveedor");
			$result3 = mysql_fetch_assoc($result2);
			
			$listaProducto = $listaProducto.
			'<tr><td>'.$result1['idProducto'].'</td>
			 <td>'.$result1['nombreProducto'].'</td>
			 <td>'.$result1['descripcionProducto'].'</td>
			 
			 <td>'.$result3['nombreProveedor'].'</td>
			 <td>'.$result3['precioProductoProv'].'</td>
			 <td>'.$result3['cantidadProductoProv'].'</td>
			 <td><a href="../php/fConsultarProducto.php?idproducto='.$result1['idProducto'].'">Consultar</a></td>
    		 </tr>';
	}
	$pnlcontent->add("consultarProducto",$listaProducto);
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>