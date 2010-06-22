<?php
	session_start();
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	include "date.php";

	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	$pnlmain->add("menu",$pnlmenu);
	
	$pnlcontent = new Panel("../html/consultarPasaje.html");
	
	extract ($_POST);
	
	$result = mysql_query("select hp.fechaHistPasaje, p.costoPasaje from hist_pasaje hp, pasaje p where p.idPasaje=hp.idPasaje order by hp.fechaHistPasaje asc");
	while($result1 = mysql_fetch_assoc($result)){
		extract($result1);
		$listaPasaje = $listaPasaje.'<tr>
									  <td align="center">'.$fechaHistPasaje.'</td>
									  <td align="center">'.$costoPasaje.' Bsf.</td>
									</tr>';
	}
	$pnlcontent->add("listaPasaje",$listaPasaje);
			
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>
	