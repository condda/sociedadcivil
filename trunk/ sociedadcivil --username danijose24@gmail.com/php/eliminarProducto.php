<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
		
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	
	$pnlcontent = new Panel("../html/eliminarProducto.html");
	
	$eliminarProducto = $_REQUEST['eliminarProducto'];
	if ($eliminarProducto){
		$result = mysql_query("select idProducto from Producto where nombreProducto = '$eliminarProducto'");
		$result1 = mysql_fetch_assoc($result);
		if (!$result1['idProducto']){
			$pnlcontent->add("mensaje","Este Producto no existe dentro de la Sociedad!");
			$pnlcontent->add("eliminarProducto",$eliminarProducto);					
		}
		else{
			mysql_query("DELETE FROM Producto where idProducto = '$result1[idProducto]'");
			$pnlmenu = new Panel("../html/menu.html");
			$pnlmenu->add("activo",'id="active"');
			$pnlmain = new Panel("../html/main.html");
			$pnlmain->add("nombre","Producto");
			$pnlmain->add("mensaje","Fue eliminado exitosamente!");
			$pnlcontent = new Panel("../html/contentPrincipal.html");		
		}
	}
	else{
		$pnlcontent->add("mensaje","Todos los campos son obligatorios!");
		$pnlcontent->add("eliminarProducto",$eliminarCedRif);					
	}

	if ($_REQUEST['idProducto']){
		$idProducto = $_REQUEST['idProducto'];
		mysql_query("DELETE FROM Producto where idProducto = '$idProducto'");
		$pnlmain->add("nombre","Producto");
		$pnlmain->add("mensaje","Fue eliminado exitosamente!");
		}
		
	$result = mysql_query("select * from Producto");
		
	while ($result1 = mysql_fetch_assoc($result)){
			$listaProducto = $listaProducto.'<tr>
			    <td>'.$result1['idProducto'].'</td>
			    <td>'.$result1['nombreProducto'].'</td>
      			<td>'.$result1['descripcionProducto'].'</td>
      			<td>'.$result1['descripcionProducto'].'</td>
      			<td>'.$result1['descripcionProducto'].'</td>
      			<td><a href="../php/eliminarProducto.php?idproveedor='.$result1['idProducto'].'">Eliminar</a></td>
    			</tr>';
	}
	$pnlcontent->add("eliminarProducto",$listaProducto);
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>