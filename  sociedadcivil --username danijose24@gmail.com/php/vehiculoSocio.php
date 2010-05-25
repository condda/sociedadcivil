	<?php
	
    require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/vehiculoSocio.html");
	$mensajeError = "Ya existe un vehiculo con ese numero de placa!!!.";
	$pnlmenu->add("activo1",'id="active"');
    $pnlmain->add("menu",$pnlmenu);
	
	$placa = $_REQUEST['placa'];
	$año = $_REQUEST['año'];
	$estado = $_REQUEST['estado'];
	$poliza = $_REQUEST['poliza'];
	
	if($placa)
	{//if 1
		
		$result =  mysql_query ("SELECT idVehiculo FROM vehiculo WHERE idVehiculo = '$placa'");
		
		if ($result1 = mysql_fetch_assoc($result))
		{//if 2
			$pnlcontent->add("mensaje",$mensajeError);
		}//if 2
		else
		{//else 1
		
			mysql_query (" INSERT INTO vehiculo (
												 idVehiculo,
												 anoVehiculo,
												 estadoVehiculo,
												 polizaVehiculo
												 )
						 VALUES					 (
												  '$placa',
												  '$año',
												  '$estado',
												  '$poliza'
												  )");
			
		
		
			
		}//else 1
		
	}//if 1
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	
	
?>