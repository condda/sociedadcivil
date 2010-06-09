<?php

		require_once("../classes/Panel.php");
		include "../db/conexion.php";
		include "date.php";
		
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel ("../html/xmodificarVehiculo.html");
		$pnlmenu->add("activo3",'id="active"');		//Coloca en Verde el link de Vehiculo
		
		//Request de la variable del PHP anterior
		
		$placaChimba = $_REQUEST['placaVehiculo'];
		

		
		//Buscar Dstos del Vehiculo
		
		$vehiculoBD = mysql_query ("SELECT * FROM vehiculo WHERE placaVehiculo = '$placaChimba'");
			 			
		//Buscar Socios
		
		$sociosBD = mysql_query ("SELECT * FROM persona, socio WHERE persona.cedulaPersona = socio.cedulaPersona"); 
		
		//Traduccion de Datos
		
		$vehiculo = mysql_fetch_assoc($vehiculoBD);
		
		$socio = mysql_fetch_assoc($sociosBD);
		
		$id = $vehiculo['idVehiculo'];
		
		
	
		
		
		//Rellenar lista de socios
		
		while ($socio)
		{
			$listaSocio = $listaSocio.'<option value ="'.$socio['cedulaPersona'].'">'.$socio['nombrePersona'].' '.
			$socio['apellidoPersona'].' '.'CI: '.$socio['cedulaPersona'].'</option>';
			
			$socio = mysql_fetch_assoc($sociosBD);
			
			
		}
		
		// Rellenar Campos
		
		$pnlcontent->add("placa",$placaChimba);
		$pnlcontent->add("año",$vehiculo['anoVehiculo']);
		$pnlcontent->add("estado",$vehiculo['estadoVehiculo']);
		$pnlcontent->add("poliza",$vehiculo['polizaVehiculo']);
		
		//REQUEST
		
		$socio = $_REQUEST['lista'];
		$estado = $_REQUEST['estado'];
		$poliza = $_REQUEST['poliza'];
		$placa = $_REQUEST['placa'];
		
		//Actualizar Base de Datos
		
	if($socio!=0)
{	
		
		//Busco el traspaso
		
		$traspasoBD = mysql_query ("SELECT * FROM traspaso WHERE idVehiculo = '$id'");
		
		$traspaso = mysql_fetch_assoc($traspasoBD);
		
			
		//Se actualiza la Tabla Vehiculo
		
		mysql_query (" UPDATE vehiculo SET 
								   						placaVehiculo = '$placa',
														estadoVehiculo = '$estado',
														polizaVehiculo = '$poliza',
														placaVehiculo = '$placa'
														
						WHERE placaVehiculo = '$placaChimba'");
		//Actuaizar traspaso
		
			if($traspaso['cedulaPersona'] != $socio)
			{
				//Se modifica el registro del dueño anterior colocando en listaTraspaso 1
						
						mysql_query("UPDATE traspaso SET
																listaTraspaso=1									
									where idVehiculo='$id' AND cedulaPersona = '$socio'");
						
				//Se registra el nuevo dueño		
						
						mysql_query ("INSERT INTO traspaso (
											cedulaPersona,
											idVehiculo,
											fechaTraspaso,
											listaTraspaso											
											)
					 VALUES(
							'$socio',
							'$id',
							'$date1',
							0
							)");
			}

		
														
								   
}
		else
$pnlcontent->add("mensaje","Debe Seleccionar un Socio");
		
		$pnlcontent->add("listaSocios",$listaSocio);
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>
