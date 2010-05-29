<?php
	
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	/********INICIO*************/
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/consultarVehiculo.html");	
	$pnlmenu->add("activo3",'id="active"');
	
	$placa = $_REQUEST['lista'];
	
		/**********BASE DE DATOS***********/
		
		$result =  mysql_query ("SELECT * FROM vehiculo");
		
		if ($result1 = mysql_fetch_assoc($result))
		{
			while($result1)
			{
						$datos = $datos.'<option value="'.$result1['placaVehiculo'].'">'.$result1['placaVehiculo'].'</option>';						
						$result1= mysql_fetch_assoc($result);
			}
			
			$result2 =  mysql_query ("SELECT * FROM vehiculo V, traspaso T, persona P WHERE V.placaVehiculo = '$placa'
									 and V.idVehiculo = T.idVehiculo and T.cedulaPersona = P.cedulaPersona");
			
			
			
			
			
			/*************************************/

			if($result3 = mysql_fetch_assoc($result2))
			{
				$listar = $listar.'<tr>
				<td>'.$result3['nombrePersona'].' '.$result3['apellidoPersona'].'</td>
				<td>'.$result3['anoVehiculo'].'</td>
				<td>'.$result3['estadoVehiculo'].'</td>
				<td>'.$result3['polizaVehiculo'].'</td>
				</tr>';
			}
			else
			{
				//$pnlcontent->add("mensaje","NOOOOOOOOOOOO");
			}
		}
		else
		{
			
		}
		
		
	/************FINAL*****************/	
	$pnlcontent->add("listaVehiculos",$datos);
	$pnlcontent->add("lista",$listar);
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);


	$pnlmain->show();
	
	
?>