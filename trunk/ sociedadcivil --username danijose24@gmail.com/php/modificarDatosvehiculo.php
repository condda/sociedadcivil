<?php
	
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	/********INICIO*************/
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/modificarVehiculo.html");	
	$pnlmenu->add("activo3",'id="active"');
	
	$placa = $_REQUEST['lista'];
	$cedula = $_REQUEST['lista'];
	$placaB= $_REQUEST['placa'];
	$estado= $_REQUEST['estado'];
	$poliza= $_REQUEST['poliza'];
	

	

	
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
				$cedulaAux = $result3['cedulaPersona'];
				$anioAux = $result3['anoVehiculo'];
				$idVehi =$result3['idVehiculo'];
				
				$resultInfo =  mysql_query ("SELECT * FROM persona P, socio S WHERE S.cedulaPersona = P.cedulaPersona");
				
 		while($result4 = mysql_fetch_assoc($resultInfo))
		{
			
			$dato = $dato.'<option value="'.$result4['cedulaPersona'].'">'.$result4['nombrePersona'].' '
			.$result4['apellidoPersona'].'</option>';		
					
					
		}
			
			
				$pnlcontent = new Panel ("../html/modificarDatosVehiculo.html");
				$pnlcontent->add ("placa",$lista);
				$pnlcontent->add ("estado",$result3['estadoVehiculo']);
				$pnlcontent->add ("poliza",$result3['polizaVehiculo']);
				$pnlcontent->add ("listaSocios",$dato);
				
				$cedula = $_REQUEST['lista'];
				$placaB= $_REQUEST['placa'];
				$estado= $_REQUEST['estado'];
				$poliza= $_REQUEST['poliza'];
				$placa = NULL;
				if($cedula==$cedulaAux)
				{
					echo  $cedula;
					echo "AAAAAAAAAAAAAAAAAAAAA";
					$traspaso=0;
					
					mysql_query("update vehiculo set
					placaVehiculo='$placaB',
					estadoVehiculo='$estado',
					anoVehiculo ='$anioAux',
					polizaVehiculo='$poliza'
					
					where idVehiculo='$idVehi'");
					
				}
				else
				{
					$traspaso=1;
					
					mysql_query("update vehiculo set
					placaVehiculo='$placaB',
					estadoVehiculo='$estado',
					anoVehiculo ='$anioAux',
					polizaVehiculo='$poliza'
					
					where idVehiculo='$idVehi'");
					
					mysql_query("update traspaso set
					listaTraspaso='$traspaso'
					
									
					where idVehiculo='$idVehi'");
					
					mysql_query ("INSERT INTO traspaso (
											cedulaPersona,
											idVehiculo,
											fechaTraspaso,
											listaTraspaso											
											)
					 VALUES(
							'$cedula',
							'$idVehi',
							'$date1',
							0
							)");
					
				}
				
				
				
				
			}
			else
			{
			//	$pnlcontent->add("mensaje","NOOOOOOOOOOOO");
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