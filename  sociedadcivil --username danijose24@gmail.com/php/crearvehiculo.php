<?php
	
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	/********INICIO*************/
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/crearVehiculo.html");	
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	
	$cedula = $_REQUEST['lista'];
	$placa = $_REQUEST['placa'];
	$anio = $_REQUEST['anio'];
	$estado = $_REQUEST['estado'];
	$poliza = $_REQUEST['poliza'];

	
	/**********BASE DE DATOS***********/
	
	$result =  mysql_query ("SELECT idVehiculo FROM vehiculo WHERE idVehiculo = '$placa'");
	$resultSocio =  mysql_query ("SELECT cedulaPersona FROM socio WHERE cedulaPersona = '$cedula'");
	$resultInfo =  mysql_query ("SELECT * FROM persona P, socio S WHERE S.cedulaPersona = P.cedulaPersona");

if($cedula)
{
	if ($result1= mysql_fetch_assoc($result))
	{
		$pnlcontent->add("mensaje","El vehiculo ya ha sido registrado.");
	}
	else if (!($result2= mysql_fetch_assoc($resultSocio)))
	
	{
		$pnlcontent->add("mensaje","No existe un socio registrado con esa cedula.");
	}
	else
	{
		mysql_query ("INSERT INTO vehiculo (
											placaVehiculo,
											anoVehiculo,
											estadoVehiculo,
											polizaVehiculo
											)
					 VALUES(
							'$placa',
							'$anio',
							'$estado',
							'$poliza'
							)");
		
		$id =  mysql_query ("SELECT idVehiculo FROM vehiculo WHERE placaVehiculo = '$placa'");
		$id1= mysql_fetch_assoc($id);
		$grr = $id1['idVehiculo'];
		
		mysql_query ("INSERT INTO traspaso (
											cedulaPersona,
											idVehiculo,
											fechaTraspaso,
											listaTraspaso											
											)
					 VALUES(
							'$cedula',
							'$grr',
							'$date1',
							0
							)");
		$pnlcontent->add("mensaje","Vehiculo Registrado Exitosamente!!!");
		
	
	}
}
	 if (!($result3= mysql_fetch_assoc($resultInfo)))
	{
		$pnlcontent->add("mensaje","No hay socios registrados");
	}
	else while($result3)
		{

			
			$datos = $datos.'<option value="'.$result3['cedulaPersona'].'">'.$result3['nombrePersona'].' '
			.$result3['apellidoPersona'].'</option>';
			
					
			$result3= mysql_fetch_assoc($resultInfo);			
		}

					 					
	
		
	/************FINAL*****************/	
	
	$pnlcontent->add("listaSocios",$datos);
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);


	$pnlmain->show();
	
	
?>