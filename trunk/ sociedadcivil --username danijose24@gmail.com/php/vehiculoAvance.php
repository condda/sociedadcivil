	<?php
	
    require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/vehiculoAvance.html");
	
	$mensajeError = "No existe un vehiculo con ese numero de placa registrado en la sociedad!!!.";
	$pnlmenu->add("activo1",'id="active"');
    $pnlmain->add("menu",$pnlmenu);
	$tipo = 2;

	$pnlcontent->add("tipo",$tipo);
		
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	
	$placa = $_REQUEST['placa'];

	if (!$cedulaPersona){
		$cedulaPersona = $_REQUEST['id'];
		$pnlcontent->add("campoOcultoCedulaPersona",$cedulaPersona);
	}
	else{
		$cedulaPersona = $_REQUEST['cedulaPersona'];
		$pnlcontent->add("campoOcultoCedulaPersona",$cedulaPersona);
	}
	
	
	if($placa)
	{//if 1
		
		$result =  mysql_query ("SELECT idVehiculo FROM vehiculo WHERE placaVehiculo = '$placa'");
		
		if (!($result1 = mysql_fetch_assoc($result)))
		{//if 2
			$pnlcontent->add("mensaje",$mensajeError);
		}//if 2
		else
		{//else 1
		
		$pnlcontent->add("cuenta",1);
			
			$result =  mysql_query ("SELECT idVehiculo FROM vehiculo WHERE placaVehiculo = '$placa' order by idVehiculo desc limit 1");
			$result1 = mysql_fetch_assoc($result);
			
			$idVehiculo = $result1['idVehiculo'];
			
			
			mysql_query (" INSERT INTO vehiculo_avance (
												 idVehiculo,
												 cedulaPersona,
												 fechaVehiculoAvance
												 )
						 VALUES					 (
												  '$idVehiculo',
												  '$cedulaPersona',
												  '$date1'
												  )");			
		}//else 1
		
	}//if 1
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	
	
?>