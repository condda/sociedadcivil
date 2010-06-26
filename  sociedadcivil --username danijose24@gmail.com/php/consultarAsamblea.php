<?php

	require_once("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
		
	$pnlmenu = new Panel("../html/menu.html");
	$pnlmain = new Panel("../html/main.html");
	$pnlcontent = new Panel("../html/consultarAsamblea.html");
	
	$pnlmenu->add("activo3",'id="active"');
	$pnlmenu->add("opcion1",'<a href="juntaDirectiva.php">Junta Directiva</a>');
	$pnlmenu->add("opcion2",'<a href="tribunalDisciplinario.php">Tribunal Disciplinario</a>');
	$pnlmenu->add("opcion3",'<a href="asamblea.php">Asamblea</a>');
	$pnlmenu->add("opcion4",'<a href="cagosJuntaDirectiva.php">Cargos Junta Directiva</a>');
	$pnlmenu->add("opcion5",'<a href="cagosTribunalDisciplinario.php">Cargos Tribunal Disciplinario</a>');
	
	//Consultar BD
	
	$asambleaBD = mysql_query("SELECT * FROM asamblea a");
	
	$asamblea = mysql_fetch_assoc($asambleaBD);
	
	while($asamblea)
	{
		if($asamblea['tipoAsamblea']==1)
		{
			$tipoA = "Asamblea de Socios";
		}
		else
		{
			$tipoA = "Asamblea de Avances";
		}
		$listaA = $listaA.'<tr>
		<td>'.$asamblea['idAsamblea'].'</td>
		<td>'.$asamblea['fechaAsamblea'].'</td>
		<td>'.$asamblea['descripcionAsamblea'].'</td>
		<td>'.$tipoA.'</td>
		<td><a href="../php/verAsamblea.php?id='.$asamblea['idAsamblea'].'">Detalles de Asamblea</a></td>
		</tr>';
			$asamblea = mysql_fetch_assoc($asambleaBD);
	}
	
	
	$pnlcontent->add("lista",$listaA);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->show();
		
?>