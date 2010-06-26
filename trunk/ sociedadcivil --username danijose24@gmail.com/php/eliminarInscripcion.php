<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
		
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	
	
	$pnlcontent = new Panel("../html/eliminarInscripcion.html");
	
	$eliminarCodigo = $_REQUEST['eliminarCodigo'];
	
	
	if ($eliminarCodigo){
		$result = mysql_query("select idInscripcion from Inscripcion where idInscripcion = '$eliminarCodigo'");
		$result1 = mysql_fetch_assoc($result);
		if (!$result1['idInscripcion']){
			$pnlcontent->add("mensaje","Esta Inscripcion no existe dentro de la Sociedad!");
			$pnlcontent->add("eliminarCodigo",$eliminarCodigo);					
		}
		else{
			mysql_query("DELETE FROM Ingreso where idInscripcion = '$result1[idInscripcion]'");
			mysql_query("DELETE FROM Inscripcion where idInscripcion = '$result1[idInscripcion]'");
			$pnlmenu = new Panel("../html/menu.html");
			$pnlmenu->add("activo",'id="active"');
			$pnlmain = new Panel("../html/main.html");
			$pnlmain->add("nombre","Inscripcion");
			$pnlmain->add("mensaje","Fue eliminado exitosamente!");
			$pnlcontent = new Panel("../html/contentPrincipal.html");		
		}
	}
	else{
		$pnlcontent->add("mensaje","Todos los campos son obligatorios!");
		$pnlcontent->add("eliminarCodigo",$eliminarCodigo);					
	}
	
	
	if ($_REQUEST['idInscripcion']){

		$idInscripcion = $_REQUEST['idInscripcion'];
		


		mysql_query("DELETE FROM Ingreso where idInscripcion = '$idInscripcion'");
		mysql_query("DELETE FROM Inscripcion where idInscripcion = '$idInscripcion'");
		$pnlmain->add("nombre","Inscripcion");
		$pnlmain->add("mensaje","Fue eliminado exitosamente!");
	}
		
	$result = mysql_query("SELECT I.fechaInscripcion as fechaInscripcion, I.idInscripcion as idInscripcion, I.tipoInscripcion as tipoInscripcion, I.estatusInscripcion as estatusInscripcion,I.fechaAInscripcion as fechaAInscripcion,I.montoInscripcion as montoInscripcion,P.nombrePersona as nombrePersona  , P.apellidoPersona as apellidoPersona FROM persona P, Inscripcion I WHERE I.cedulaPersona= P.cedulaPersona");
		
	while ($result1 = mysql_fetch_assoc($result)){
		
		if ($result1['tipoInscripcion'] == '1')
				$tipoInscripcion = "Socio";
				
			else
			$tipoInscripcion = "Avance";
			
			if ($result1['fechaAInscripcion'] == '0000-00-00')
			$fechaAInscripcion = "No admitido";
			else
			$fechaAInscripcion = $result1['fechaAInscripcion'];
			
			if ($result1['estatusInscripcion'] == '1')
				$estatusInscripcion = "Aprobado";
			else if ($result1['estatusInscripcion'] == '2')
				$estatusInscripcion = "Rechazado";
			else if ($result1['estatusInscripcion'] == '3')
				$estatusInscripcion = "En Espera";
			else if ($result1['estatusInscripcion'] == '4')
				$estatusInscripcion = "Periodo de Prueba";
			else if ($result1['estatusInscripcion'] == '5')
				$estatusInscripcion = "Expulsado";
				else if ($result1['estatusInscripcion'] == '6')
				$estatusInscripcion = "Suspendido";
			
			
				$listaInscripcion = $listaInscripcion.'<tr>
				<td align="center">'.$result1['fechaInscripcion'].'</td>
				<td align="center">'.$result1['idInscripcion'].'</td>
				<td align="center">'.$tipoInscripcion.'</td>
				<td align="center">'.$result1['nombrePersona'].' '.$result1['apellidoPersona'].'</td>
				<td align="center">'.$estatusInscripcion .'</td>
				<td align="center">'.$fechaAInscripcion.'</td>
				<td align="center">'.$result1['montoInscripcion'].'</td>
				<td><a href="../php/eliminarInscripcion.php?idInscripcion='.$result1['idInscripcion'].'">Eliminar</a></td></tr>';	 
		
	}
	$pnlcontent->add("listaInscripcion",$listaInscripcion);
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>