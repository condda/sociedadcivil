	<?php
	
    require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/vehiculoAvance.html");
	$mensajeError = "No existe un vehiculo con ese numero de placa registrado en la sociedad!!!.";
	$pnlmenu->add("activo1",'id="active"');
    $pnlmain->add("menu",$pnlmenu);
	
	$placa = $_REQUEST['placa'];

	
	if($placa)
	{//if 1
		
		$result =  mysql_query ("SELECT idVehiculo FROM vehiculo WHERE idVehiculo = '$placa'");
		
		if (!($result1 = mysql_fetch_assoc($result)))
		{//if 2
			$pnlcontent->add("mensaje",$mensajeError);
		}//if 2
		else
		{//else 1
		
			mysql_query (" INSERT INTO vehiculo_avance (
												 idVehiculo												 
												 )
						 VALUES					 (
												  '$placa'
												  )");			
		}//else 1
		
	}//if 1
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	
	
?>