<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
		
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo2",'id="active"');
	$pnlmenu->add("opcion1",'<a href="producto.php">Producto</a>');
	$pnlmenu->add("opcion2",'<a href="proveedor.php">Proveedor</a>');
	
	$pnlcontent = new Panel("../html/modificarProveedor.html");
	
	$modificarCedRif = $_REQUEST['modificarCedRif'];
	if (($modificarCedRif) && ($ciRif!=0)){
		if ($ciRif==1)
			$result = mysql_query("select idProveedor from Proveedor where cedulaProveedor = '$modificarCedRif'");		
		else if ($ciRif==2)
			$result = mysql_query("select idProveedor from Proveedor where rifProveedor = '$modificarCedRif'");
		$result1 = mysql_fetch_assoc($result);
		if (!$result1){
			$pnlcontent->add("mensaje","Este Proveedor no existe dentro de la Sociedad!");
			$pnlcontent->add("modificarCedRif",$modificarCedRif);					
		}
	}
	else{
		$pnlcontent->add("mensaje","Todos los campos son obligatorios!");
		$pnlcontent->add("modificarCedRif",$modificarCedRif);					
	}
		
	$result = mysql_query("select * from Proveedor");
	
	while ($result1 = mysql_fetch_assoc($result)){
		#extract($result1);
		if ($result1['cedulaProveedor'] != 0){
			$listaProveedores = $listaProveedores.'<tr>
			    <td>'.$result1['cedulaProveedor'].'</td>
			    <td>'.$result1['nombreProveedor'].'</td>
      			<td width="200">'.$result1['direccionProveedor'].'</td>
      			<td>'.$result1['telefonoProveedor'].'</td>
      			<td><a href="../php/fModificarProveedor.php?idproveedor='.$result1['idProveedor'].'">Modificar</a></td>
    			</tr>';
		}
		else if ($result1['rifProveedor'] != NULL){
			$listaProveedores = $listaProveedores.'<tr>
      			<td>'.$result1['rifProveedor'].'</td>
      			<td>'.$result1['nombreProveedor'].'</td>
      			<td width="200">'.$result1['direccionProveedor'].'</td>
      			<td>'.$result1['telefonoProveedor'].'</td>
      			<td><a href="../php/fModificarProveedor.php?idproveedor='.$result1['idProveedor'].'">Modificar</a></td>
    			</tr>';
		}
	}
	$pnlcontent->add("modificarProveedor",$listaProveedores);
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>