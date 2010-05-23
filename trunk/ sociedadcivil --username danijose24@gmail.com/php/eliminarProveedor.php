<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	
	
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	
	$pnlcontent = new Panel("../html/eliminarProveedor.html");
	
	
	if ($_REQUEST['idproveedor']){
		$idproveedor = $_REQUEST['idproveedor'];
		mysql_query("DELETE FROM proveedor where idProveedor = '$idproveedor'");
		
		
		}
		
	
	
	$result = mysql_query("select * from Proveedor");
	
	
	while ($result1 = mysql_fetch_assoc($result)){
		
		if ($result1['cedulaProveedor'] != NULL){
		
		$listaProveedores = $listaProveedores.'<tr>
      <td>'.$result1['cedulaProveedor'].'</td>
      <td>'.$result1['nombreProveedor'].'</td>
      <td width="200">'.$result1['direccionProveedor'].'</td>
      <td>'.$result1['telefonoProveedor'].'</td>
      <td><a href="../php/eliminarProveedor.php?idproveedor='.$result1['idProveedor'].'">Eliminar</a></td>
    </tr>';
		}
		
		else if ($result1['rifProveedor'] != NULL){
		
		$listaProveedores = $listaProveedores.'<tr>
      <td>'.$result1['rifProveedor'].'</td>
      <td>'.$result1['nombreProveedor'].'</td>
      <td width="200">'.$result1['direccionProveedor'].'</td>
      <td>'.$result1['telefonoProveedor'].'</td>
      <td><a href="../php/eliminarProveedor.php?idproveedor='.$result1['idProveedor'].'">Eliminar</a></td>
    </tr>';
		}
		
		
	}
	$pnlcontent->add("eliminarProveedor",$listaProveedores);
	
	
	
	
		

	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>