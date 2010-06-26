<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
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
	
	
	$pnlcontent = new Panel("../html/fModificarInscripcion.html");
	
	$modificarCodigo =  $_REQUEST['modificarCodigo'];
	
	$idInscripcion =  $_REQUEST['codigo'];
	$fechaInscripcion = $_REQUEST['fecha'];
	$nombrePersona = $_REQUEST['nombre'];
	 $estatusInscripcion =  $_REQUEST['estatusInscripcion'];
	 $tipoInscripcion =  $_REQUEST['tipoInscripcion'];
	$fechaAInscripcion =  $_REQUEST['fechaAInscripcion'];
	$montoInscripcion =  $_REQUEST['monto'];
	
	
	if ($tipoInscripcion == "Socio")
	$tipoInscripcion = 1;
	if ($tipoInscripcion == "Avance")
	$tipoInscripcion = 2;
	
	
	
	if ($_REQUEST['idInscripcion']){
		$idInscripcion =  $_REQUEST['idInscripcion'];

		
		$result =  mysql_query ("SELECT I.fechaInscripcion as fechaInscripcion, I.idInscripcion as idInscripcion, I.tipoInscripcion as tipoInscripcion, I.estatusInscripcion as estatusInscripcion,I.fechaAInscripcion as fechaAInscripcion,I.montoInscripcion as montoInscripcion,P.nombrePersona as nombrePersona  , P.apellidoPersona as apellidoPersona FROM persona P, Inscripcion I  WHERE I.idInscripcion = '$idInscripcion' AND I.cedulaPersona = P.cedulaPersona ");
		$result1 = mysql_fetch_assoc($result);
		$pnlcontent->add("codigo",$result1['idInscripcion']);					
		$pnlcontent->add("fecha",$result1['fechaInscripcion']);					
		$pnlcontent->add("nombre",$result1['nombrePersona']);
	
		if ($result1['fechaAInscripcion'] != '0000-00-00'){
			
				$pnlcontent->add("fechaAdmision1",'<input name="fechaAInscripcion" type="text" id="fechaAInscripcion" value="'.$result1['fechaAInscripcion'].'" />');			
			$pnlcontent->add("fechaAdmision","Fecha Admision");	
			
			if ($result1['estatusInscripcion'] == '5')
				$pnlcontent->add("estatus","Expulsado");
			
			else if ($result1['estatusInscripcion'] == '1'){
			
			$pnlcontent->add("estatus",'<select name="estatusInscripcion" id="estatusInscripcion">
			<option value="1"  selected="selected">Aprobado</option>
			<option value="6"  {estatus6}>Suspendido</option>
			<option value="5" {estatus5}>Expulsado</option></select>');	
			$pnlcontent->add("botonModificar",'<input type="submit" name="button" id="button" value="Modificar" />');
			}
			else if ($result1['estatusInscripcion'] == '6'){
				
				$pnlcontent->add("estatus",'<select name="estatusInscripcion" id="estatusInscripcion">
			<option value="1" >Aprobado</option>
			<option value="6"  selected="selected">Suspendido</option>
			<option value="5" {estatus5}>Expulsado</option></select>');	
			$pnlcontent->add("botonModificar",'<input type="submit" name="button" id="button" value="Modificar" />');
			
		

			}
		}
		else{

			
			  if ($result1['estatusInscripcion'] == '2')
			$pnlcontent->add("estatus","Rechazado");		
			
			
			else if ($result1['estatusInscripcion'] == '3'){

			$pnlcontent->add("estatus",'<select name="estatusInscripcion" id="estatusInscripcion">
        <option value="1" >Aprobado</option>
        <option value="2" {estatus2}>Rechazado</option>
        <option value="3" selected="selected">En Espera</option>
        <option value="4" {estatus4}>Prueba</option>
        <option value="5" {estatus5}>Expulsado</option> 
		</select>');
			
			$pnlcontent->add("botonModificar",'<input type="submit" name="button" id="button" value="Modificar" />');
			}
			
			
			else if ($result1['estatusInscripcion'] == '4'){

			$pnlcontent->add("estatus",'<select name="estatusInscripcion" id="estatusInscripcion">
        <option value="1"  >Aprobado</option>
        <option value="2" {estatus2}>Rechazado</option>
        <option value="3" {estatus3}>En Espera</option>
        <option value="4" selected="selected">Prueba</option>
        <option value="5" {estatus5}>Expulsado</option>
		</select>');		
			$pnlcontent->add("botonModificar",'<input type="submit" name="button" id="button" value="Modificar" />');
			}
			
			else if ($result1['estatusInscripcion'] == '5')
			$pnlcontent->add("estatus","Expulsado");	
			
			
	
			
			
		}
		
		
		if (($result1['estatusInscripcion'] == '5') || ($result1['estatusInscripcion'] == '2') || ($result1['estatusInscripcion'] == '6')){
			
			if ($result1['tipoInscripcion'] == '1')
			
				$pnlcontent->add("selectTipo",'<input name="tipoInscripcion" type="text" id="tipoInscripcion"  value="Socio" readonly="readonly"/>');	
				
			else if ($result1['tipoInscripcion'] == '2')
			
				$pnlcontent->add("selectTipo",'<input name="tipoInscripcion" type="text" id="tipoInscripcion"  value="Avance" readonly="readonly"/>');	
		}
		else{

			if ($result1['tipoInscripcion'] == '1'){

				$pnlcontent->add("selectTipo",'<select name="tipoInscripcion" id="tipoInscripcion">
          <option value="1" selected="selected">Socio</option>
          <option value="2"{selectTipo1}>Avance</option>
        </select>');
			}
			else if ($result1['tipoInscripcion'] == '2'){
			
				$pnlcontent->add("selectTipo",'<select name="tipoInscripcion" id="tipoInscripcion">
          <option value="1" {selectTipo}>Socio</option>
          <option value="2" selected="selected">Avance</option>
        </select>');	
			}
		}

		
		
		
		$pnlcontent->add("monto",$result1['montoInscripcion']);					
		
	}
	
	
	else if ($modificarCodigo){
		

		$result =  mysql_query ("SELECT I.fechaInscripcion as fechaInscripcion, I.idInscripcion as idInscripcion, I.tipoInscripcion as tipoInscripcion, I.estatusInscripcion as estatusInscripcion,I.fechaAInscripcion as fechaAInscripcion,I.montoInscripcion as montoInscripcion,P.nombrePersona as nombrePersona  , P.apellidoPersona as apellidoPersona FROM persona P, Inscripcion I  WHERE I.idInscripcion = '$modificarCodigo' AND I.cedulaPersona = P.cedulaPersona ");
			$result1 = mysql_fetch_assoc($result);
			
			
		$pnlcontent->add("codigo",$result1['idInscripcion']);					
		$pnlcontent->add("fecha",$result1['fechaInscripcion']);					
		$pnlcontent->add("nombre",$result1['nombrePersona']);
		
		if ($result1['fechaAInscripcion'] != '0000-00-00'){
			$pnlcontent->add("fechaAdmision1",'<input name="fechaAInscripcion" type="text" id="fechaAInscripcion" value="'.$result1['fechaAInscripcion'].'" />');			
			$pnlcontent->add("fechaAdmision","Fecha Admision");	
			
			if ($result1['estatusInscripcion'] == '5')
				$pnlcontent->add("estatus","Expulsado");
			
			else if ($result1['estatusInscripcion'] == '1'){
				$pnlcontent->add("estatus",'<select name="estatusInscripcion" id="estatusInscripcion">
				<option value="1"  selected="selected">Aprobado</option>
				<option value="6" {estatus6} >Suspendido</option>
				<option value="5" {estatus5}>Expulsado</option></select>');	
				$pnlcontent->add("botonModificar",'<input type="submit" name="button" id="button" value="Modificar" />');
			}
			else if ($result1['estatusInscripcion'] == '6'){
				
				$pnlcontent->add("estatus",'<select name="estatusInscripcion" id="estatusInscripcion">
			<option value="1" >Aprobado</option>
			<option value="6"  selected="selected">Suspendido</option>
			<option value="5" {estatus5}>Expulsado</option></select>');	
			$pnlcontent->add("botonModificar",'<input type="submit" name="button" id="button" value="Modificar" />');
				
			}
			
		
		
		}
		else{

			
			  if ($result1['estatusInscripcion'] == '2')
			$pnlcontent->add("estatus","Rechazado");		
			
			
			else if ($result1['estatusInscripcion'] == '3'){
			$pnlcontent->add("estatus",'<select name="estatusInscripcion" id="estatusInscripcion">
        <option value="1" >Aprobado</option>
        <option value="2" {estatus2}>Rechazado</option>
        <option value="3" selected="selected">En Espera</option>
        <option value="4" {estatus4}>Prueba</option>
        <option value="5" {estatus5}>Expulsado</option>
		</select>');	
			$pnlcontent->add("botonModificar",'<input type="submit" name="button" id="button" value="Modificar" />');
			}
			else if ($result1['estatusInscripcion'] == '4'){

			$pnlcontent->add("estatus",'<select name="estatusInscripcion" id="estatusInscripcion">
        <option value="1"  >Aprobado</option>
        <option value="2" {estatus2}>Rechazado</option>
        <option value="3" {estatus3}>En Espera</option>
        <option value="4" selected="selected">Prueba</option>
        <option value="5" {estatus5}>Expulsado</option>
		</select>');		
			$pnlcontent->add("botonModificar",'<input type="submit" name="button" id="button" value="Modificar" />');
			}
			
			
			else if ($result1['estatusInscripcion'] == '5')
			$pnlcontent->add("estatus","Expulsado");	
			
			
			
			
		}
		
		if (($result1['estatusInscripcion'] == '5') || ($result1['estatusInscripcion'] == '2') || ($result1['estatusInscripcion'] == '6')){
			if ($result1['tipoInscripcion'] == '1')
			
				$pnlcontent->add("selectTipo",'<input name="tipoInscripcion" type="text" id="tipoInscripcion"  value="Socio" readonly="readonly"/>');	
				
			else if ($result1['tipoInscripcion'] == '2')
			
				$pnlcontent->add("selectTipo",'<input name="tipoInscripcion" type="text" id="tipoInscripcion"  value="Avance" readonly="readonly"/>');	
			}
		else{
			
			if ($result1['tipoInscripcion'] == '1')
				$pnlcontent->add("selectTipo",'<select name="tipoInscripcion" id="tipoInscripcion">
          <option value="1" selected="selected">Socio</option>
          <option value="2"{selectTipo1}>Avance</option>
        </select>');
				
			else if ($result1['tipoInscripcion'] == '2')
				$pnlcontent->add("selectTipo",'<select name="tipoInscripcion" id="tipoInscripcion">
          <option value="1" {selectTipo}>Socio</option>
          <option value="2" selected="selected">Avance</option>
        </select>');	
		}

		
		
		
		$pnlcontent->add("monto",$result1['montoInscripcion']);					
			
	}
	
	
	
	
	
	else if (($estatusInscripcion) && ($tipoInscripcion)){
		
		
		if (($fechaAInscripcion == '0000-00-00') && ($estatusInscripcion == '1')){
			$fechaAInscripcion = $date1;
			
		}		

		
		
		
		mysql_query("update inscripcion set
		estatusInscripcion='$estatusInscripcion',
		tipoInscripcion='$tipoInscripcion', fechaAInscripcion = '$fechaAInscripcion' where idInscripcion='$idInscripcion'");
		
		$pnlmenu = new Panel("../html/menu.html");
		$pnlmenu->add("activo",'id="active"');
		$pnlmain = new Panel("../html/main.html");
		$pnlmain->add("nombre","Producto");
		$pnlmain->add("mensaje","Fue modificado exitosamente!");
		$pnlcontent = new Panel("../html/contentPrincipal.html");		
	}

	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>