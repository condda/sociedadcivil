<?php

	require_once("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
		
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlcontent = new Panel("../html/crearAsamblea.html");
	
	$pnlmenu->add("activo3",'id="active"');
	$pnlmenu->add("opcion1",'<a href="juntaDirectiva.php">Junta Directiva</a>');
	$pnlmenu->add("opcion2",'<a href="tribunalDisciplinario.php">Tribunal Disciplinario</a>');
	$pnlmenu->add("opcion3",'<a href="asamblea.php">Asamblea</a>');
	$pnlmenu->add("opcion4",'<a href="cagosJuntaDirectiva.php">Cargos Junta Directiva</a>');
	$pnlmenu->add("opcion5",'<a href="cagosTribunalDisciplinario.php">Cargos Tribunal Disciplinario</a>');
	
	
	$tipoAsamblea = $_REQUEST['tipoAsamblea'];
	$descripcion = $_REQUEST['descripcion'];
	
	$ultimoId = $_REQUEST['id'];
	$tipo = $_REQUEST['tipo'];
	
	if($tipo)
	$tipoAsamblea=$tipo;
	

if($tipoAsamblea  || $ultimoId)
{
		
	
						if($tipoAsamblea==1)
						{
							
							$ultimoId=1;
							
							$tabla ='<table width="100%" border="0">
										<tr>
										  <td><strong>Cedula</strong></td>
										  <td><strong>Nombre</strong></td>
										  <td><strong>Apellido</strong></td>
										  <td><strong>Telefono</strong></td>
										  <td><strong>Status</strong></td>
										  <td>&nbsp;</td>
										</tr>
										{miembros}
									  </table>';
									  
									  //Consulta BD
									  
									  $socioBD = mysql_query("SELECT * FROM persona p, socio s 
												  WHERE p.cedulaPersona = s.cedulaPersona");
									  
									//Traduccion de Datps
									
									  $socio = mysql_fetch_assoc($socioBD);
									  
									  $i=0;
									 									  
									  while($socio)
									  {
										  $i++;
										  
											  $listaMiembros = $listaMiembros.'<tr>
											  <td>'.$socio['cedulaPersona'].'</td>
											  <td>'.$socio['nombrePersona'].'</td>
											  <td>'.$socio['apellidoPersona'].'</td>
											  <td>'.$socio['telefonoPersona'].'</td>
									<td><input type=checkbox name="p'.$i.'" id="p'.$i.'" value="'.$socio['cedulaPersona'].'"</td>
											  </tr>';
											  
											  
																																									
										  $socio = mysql_fetch_assoc($socioBD);
									  }
			 
									  
									  
									  //Mostrar Tabla
									  
									  $pnlcontent->add("cont",$i);
									  $pnlcontent->add("titulo","Seleccione Miembros de la Asamblea");
									  $pnlcontent->add("tabla",$tabla);
									  $pnlcontent->add("miembros",$listaMiembros);
			$pnlcontent->add("Finalizar",'<a href="../php/crearAsamblea.php?id='.$ultimoId.'&tipo='.$tipoAsamblea.'">Finalizar</a>');
									  
									  extract ($_POST);
									  
									for ($i=1;$i<=$cont;$i=$i+1)
									{
										if (${'p'.$i})
										{
											echo "AAAAAAAAA";
											
											mysql_query("INSERT into asamblea_socio (idAsamblea,
																					 cedulaPersona)
														Values (1,
																'${'p'.$i}'");
										}
										
									}
									  
						} 
						else
						{
							
							
						}
}
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->show();
		
?>