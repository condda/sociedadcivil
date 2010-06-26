<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";

	 $flag = $_REQUEST['phpFlag'];
	 $idJuntadirectiva = $_REQUEST['phpIdJuntaDirectiva'];
	 $idTribunald = $_REQUEST['phpIdTribunald'];
	 $nombreCargo = $_REQUEST['phpNombreCargo'];
	 $descripcionCargo = $_REQUEST['phpDescripcionCargo'];
	
	
	if (($flag == 2) &&($idJuntadirectiva)){ //eliminar JD
	
	mysql_query ("delete from hist_cargo  where idJuntadirectiva = '$idJuntadirectiva'");
	mysql_query ("delete from juntadirectiva  where idJuntadirectiva = '$idJuntadirectiva'");
	echo "Su operación se ha realizado con exito";
		
	}
	
	if (($flag == 1) &&($idJuntadirectiva)){ //modificar JD
	mysql_query ("update juntadirectiva set nombreJuntadirectiva = '$nombreCargo', descripcionJuntadirectiva = '$descripcionCargo' where idJuntadirectiva = '$idJuntadirectiva'");
	echo "Su operación se ha realizado con exito";
	
	
	
	}
	
	if (($flag == 2) &&($idTribunald)){ //eliminar TD
	
	mysql_query ("delete from hist_cargo  where idTribunald = '$idTribunald'");
	mysql_query ("delete from tribunald  where idTribunald = '$idTribunald'");
	echo "Su operación se ha realizado con exito";
		
	}
	
	
	if (($flag == 1) &&($idTribunald)){ //modificar TD
	mysql_query ("update tribunald set nombre = '$nombreCargo' where idTribunald = '$idTribunald'");
	echo "Su operación se ha realizado con exito";
	
	
	
	}
	
		
	
	include "../db/cerrar_conexion.php";
?>
