<?php

	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	echo $flag = $_REQUEST['phpFlag'];
	echo $idHistCargo = $_REQUEST['phpIdHistCargo'];
	
	
	if ($flag == 1){
		
		mysql_query ("delete from hist_cargo where idHistCargo = '$idHistCargo'");

		echo "Su operacion se ha realizado con exito";	
	}
	
	include "../db/cerrar_conexion.php";
?>