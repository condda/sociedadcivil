<?php

	require_once("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
		
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlcontent = new Panel("../html/verAsamblea.html");
	
	$pnlmenu->add("activo3",'id="active"');
	$pnlmenu->add("opcion1",'<a href="juntaDirectiva.php">Junta Directiva</a>');
	$pnlmenu->add("opcion2",'<a href="tribunalDisciplinario.php">Tribunal Disciplinario</a>');
	$pnlmenu->add("opcion3",'<a href="asamblea.php">Asamblea</a>');
	$pnlmenu->add("opcion4",'<a href="cagosJuntaDirectiva.php">Cargos Junta Directiva</a>');
	$pnlmenu->add("opcion5",'<a href="cagosTribunalDisciplinario.php">Cargos Tribunal Disciplinario</a>');
	
	$id = $_REQUEST['id'];
	
	$asambleaBD = mysql_query("SELECT * from asamblea a
							  where a.idAsamblea = '$id'");
	
	$asamblea = mysql_fetch_assoc($asambleaBD);
		
		if($asamblea['tipoAsamblea']==1)
		{
			$tipoA = "Asamblea de Socios";
			$scBD = mysql_query("SELECT * from asamblea_socio a
							  where a.idAsamblea = '$id'");
			$sc = mysql_fetch_assoc($scBD);
		}
		else
		{
			$tipoA = "Asamblea de Avances";
			$scBD = mysql_query("SELECT * from asamblea_socio a
							  where a.idAsamblea = '$id'");
			$sc = mysql_fetch_assoc($scBD);
		}
	
	$pnlcontent->add("id",$asamblea['idAsamblea']);
	$pnlcontent->add("fecha",$asamblea['fechaAsamblea']);
	$pnlcontent->add("descripcion",$asamblea['descripcionAsamblea']);
	$pnlcontent->add("tipo",$tipoA);
	
	$tabla ='<table width="100%" border="0">
										<tr>
										  <td><strong>Cedula</strong></td>
										  <td><strong>Nombre</strong></td>
										  <td><strong>Apellido</strong></td>
										  <td><strong>Telefono</strong></td>
										  <td>&nbsp;</td>
										</tr>
										{miembros}
									  </table>';
									  
									  if($asamblea['tipoAsamblea']==1)
									  {
									    //Consulta BD
									  
									  $avanceBD = mysql_query("SELECT * FROM persona p, avance s 
												  WHERE p.cedulaPersona = s.cedulaPersona");
									  
									//Traduccion de Datps
									
									  $avance = mysql_fetch_assoc($avanceBD);
									  
								//	  $i=0;
									 									  
									  while($avance)
									  {
									//	  $i++;
										  
											  $listaMiembros = $listaMiembros.'<tr>
											  <td>'.$avance['cedulaPersona'].'</td>
											  <td>'.$avance['nombrePersona'].'</td>
											  <td>'.$avance['apellidoPersona'].'</td>
											  <td>'.$avance['telefonoPersona'].'</td>
											  </tr>';								  
											  
											  $cedula = $avance['cedulaPersona'];
											  
											  mysql_query("INSERT into asamblea_avance (idAsamblea, cedulaPersona)
																					   VALUES ('$ultimoId','$cedula')");
											  																														
										  $avance = mysql_fetch_assoc($avanceBD);
									  }
									 }
									 else
									 {
										 	  //Consulta BD
									  
									  $socioBD = mysql_query("SELECT * FROM persona p, socio s 
												  WHERE p.cedulaPersona = s.cedulaPersona");
									  
									//Traduccion de Datps
									
									  $socio = mysql_fetch_assoc($socioBD);
									  
								//	  $i=0;
									 									  
									  while($socio)
									  {
									//	  $i++;
										  
											  $listaMiembros = $listaMiembros.'<tr>
											  <td>'.$socio['cedulaPersona'].'</td>
											  <td>'.$socio['nombrePersona'].'</td>
											  <td>'.$socio['apellidoPersona'].'</td>
											  <td>'.$socio['telefonoPersona'].'</td>
											  </tr>';								  
											  
											  $cedula = $socio['cedulaPersona'];
											  
											  mysql_query("INSERT into asamblea_socio (idAsamblea, cedulaPersona)
																					   VALUES ('$ultimoId','$cedula')");
											  																														
										  $socio = mysql_fetch_assoc($socioBD);
									  }
										 
									 }
									  $pnlcontent->add("titulo","Miembros convocados a la Asamblea");
									  $pnlcontent->add("tabla",$tabla);
									  $pnlcontent->add("miembros",$listaMiembros);
	
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->show();
		
?>