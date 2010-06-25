<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	
	$pnlmenu->add("activo3",'id="active"');
	$pnlmenu->add("opcion1",'<a href="juntaDirectiva.php">Junta Directiva</a>');
	$pnlmenu->add("opcion2",'<a href="tribunalDisciplinario.php">Tribunal Disciplinario</a>');
	$pnlmenu->add("opcion3",'<a href="asamblea.php">Asamblea</a>');
	$pnlmenu->add("opcion4",'<a href="cargosJuntaDirectiva.php">Cargos Junta Directiva</a>');
	$pnlmenu->add("opcion5",'<a href="cargosTribunalDisciplinario.php">Cargos Tribunal Disciplinario</a>');
	
	$pnlcontent = new Panel("../html/consultarCargoJD.html");	
	
	$result = mysql_query("select * from juntadirectiva");
	$fondo = 'bgcolor="#CCCCCC"';
	
	$listaC = '<tr>
      <td width="175" bgcolor="#999999"><strong>Nombre Cargo</strong></td>
      <td width="183" bgcolor="#999999"><strong>Descripcion Cargo</strong></td>
      <td width="116" bgcolor="#999999">&nbsp;</td>
      <td width="99" bgcolor="#999999">&nbsp;</td>
    </tr>';
	
	
	while ($result1 = mysql_fetch_assoc($result)){
	
	if ($fondo == 'bgcolor="#CCCCCC"')
	$fondo = 'bgcolor="#FFFFFF"';
	else
	$fondo = 'bgcolor="#CCCCCC"';
	$listaC = $listaC.'
    <tr>
      <td width="175" '.$fondo.'>'.$result1['nombreJuntadirectiva'].'</td>
      <td width="183"'.$fondo.'>'.$result1['descripcionJuntadirectiva'].'</td>
      <td width="116"'.$fondo.'><a href="#" onclick="modificarCargoJD('.$result1['idJuntadirectiva'].')">Modificar</a></td>
      <td width="99"'.$fondo.'><a href="#" onclick="eliminarCargoJD('.$result1['idJuntadirectiva'].')">Eliminar</a></td>
    </tr>';
		
	}
	
	$pnlcontent->add("listaCargo",$listaC);


	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
