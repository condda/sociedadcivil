<?php
	
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	$pnlmenu->add("activo3",'id="active"');
	
	
		$cedula = $_REQUEST['listaB'];
		$placaB  = $_REQUEST['placa'];
		$estado = $_REQUEST['socio'];
		$poliza   = $_REQUEST['poliza'];
	
if ((!cedula) && ($placaB) && ($estado) && ($poliza)){
	$pnlcontent = new Panel ("../html/modificarVehiculo.html");	
	//LLENA LA PESTAÑA DE PLACAS
	
			$result =  mysql_query ("SELECT * FROM vehiculo");	
	
			while($result1= mysql_fetch_assoc($result))
			{
						$datos = $datos.'<option value="'.$result1['placaVehiculo'].'">'.$result1['placaVehiculo'].'</option>';						
						
			}
			
			//LEO DATOS DE LA PESTAÑA
			
			if($datos)
			{
				//LEO Dato placa de la pestaña
				
				$placa = $_REQUEST['lista'];
				
				//Informacion de los Scios
				
				$result2 =  mysql_query ("SELECT * FROM persona P, socio S WHERE S.cedulaPersona = P.cedulaPersona");
				
				$result3 = mysql_fetch_assoc($result2);
				
				//Informacion del Dueño
				
				$result4 =  mysql_query ("SELECT * FROM vehiculo V, traspaso T, persona P WHERE V.placaVehiculo = '$placa'
									 and V.idVehiculo = T.idVehiculo and T.cedulaPersona = P.cedulaPersona");
				
				$result5 = mysql_fetch_assoc($result4);
			
				
				//Cambio de Pagina a Datos de Vehiculo 
				
				//SOLO SI LEYO PLACA
		
			}
			$pnlcontent->add("listaVehiculos",$datos);
}
	else{
			
				if($placa)
				{
					
					$pnlcontent = new Panel ("../html/modificarDatosVehiculo.html");
					
					//LLeno la pestaña de socios
					
						while($result3)
						{
							
							$listaSocio = $listaSocio.'<option value="'.$result3['cedulaPersona'].'">'.$result3['nombrePersona'].
							' '.$result3['apellidoPersona'].'</option>';
							
							$result3 = mysql_fetch_assoc($result2);									
									
						}
						
						$pnlcontent->add("listaSocios",$listaSocio);
						
					//LLenar las etiquetas
					
					$pnlcontent->add("placa",$result5['placaVehiculo']);
					$pnlcontent->add("estado",$result5['estadoVehiculo']);
					$pnlcontent->add("poliza",$result5['polizaVehiculo']);
					
					//REQUEST
					
					
					
					//Extraigo ID del VEHICULO
					
					$idVehi = $result5['idVehiculo'];
					
					//ACTUALIZAR
					
							
					mysql_query("update vehiculo set
					placaVehiculo='$placaB',
					estadoVehiculo='$estado',
					polizaVehiculo='$poliza'
					
					where idVehiculo='$idVehi'");
					
					//SI ES EL MISMO DUEÑO
					
					if($cedula == $result5['cedulaPersona'])
					{
						//NO HAGO NADA EN TRASPASO
					}
					else
					{
						//MODIFICO TRASPASO DEL DUEÑO ANTERIOR LISTATRASPASO = 1
						
						mysql_query("update traspaso set
									listaTraspaso='1'
									
									where idVehiculo='$idVehi'");
						
						//CREO UNA NUEVA TUPLA PARA EL NUEVO DUEÑO
						
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
			}
	
	
	
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);


	$pnlmain->show();
	
	
?>