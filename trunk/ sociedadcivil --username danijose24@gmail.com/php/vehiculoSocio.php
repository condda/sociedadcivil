	<?php
	
    require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/vehiculoSocio.html");
	
	$mensajeError = "Ya existe un vehiculo con ese numero de placa!!!.";
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	$tipo = 1;

	$pnlcontent->add("tipo",$tipo);
	
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	
	
    $pnlmain->add("menu",$pnlmenu);
	
	if (!$cedulaPersona){
	$cedulaPersona = $_REQUEST['id'];
	$pnlcontent->add("campoOcultoCedulaPersona",$cedulaPersona);
	}
	else{
	$cedulaPersona = $_REQUEST['cedulaPersona'];
	$pnlcontent->add("campoOcultoCedulaPersona",$cedulaPersona);
	}
	
	$cuentaVehiculo = $_REQUEST['cuentaVehiculo'];
//	echo $cuentaVehiculo;
	$placa = $_REQUEST['placa'];
	$ano = $_REQUEST['ano'];
	$estado = $_REQUEST['estado'];
	$poliza = $_REQUEST['poliza'];
	
	if($placa)
	{//if 1
		
		$result =  mysql_query ("SELECT idVehiculo FROM vehiculo WHERE placaVehiculo = '$placa'");
		
		if ($result1 = mysql_fetch_assoc($result))
		{//if 2
			$pnlcontent->add("mensaje",$mensajeError);
		}//if 2
		else
		{//else 1
		$pnlcontent->add("cuenta",1);
			mysql_query (" INSERT INTO vehiculo (
												 idVehiculo,
												 anoVehiculo,
												 estadoVehiculo,
												 polizaVehiculo,
												 placaVehiculo
												 )
						 VALUES					 (
												  'NULL',
												  '$ano',
												  '$estado',
												  '$poliza',
												  '$placa'
												  )");
			
			$result =  mysql_query ("SELECT idVehiculo FROM vehiculo WHERE placaVehiculo = '$placa' order by idVehiculo desc limit 1");
			$result1 = mysql_fetch_assoc($result);
			
			$idVehiculo = $result1['idVehiculo'];
			
			mysql_query (" INSERT INTO traspaso (
												 cedulaPersona,
												 idVehiculo,
												 fechaTraspaso,
												 listaTraspaso)
						 VALUES					 (
												  '$cedulaPersona',
												  '$idVehiculo',
												  '$date1',
												  '0'
												  )");
			$pnlcontent->add("finalizar",'<a href="../classes/Site.php">Finalizar</a>');
			
		
		
			
		}//else 1
		
	}//if 1
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	
	
?>