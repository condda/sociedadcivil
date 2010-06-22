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
	$pnlcontent = new Panel("../html/consultarRetiro2.html");	
	
	$result = mysql_query("SELECT fa.idFondoAvance, fa.idFondo, p.cedulaPersona, p.nombrePersona, p.apellidoPersona, fa.montoFondoAvance, fa.fechaFondoAvance, b.cedulaBeneficiario, b.nombreBeneficiario, b.apellidoBeneficiario
FROM persona p, fondo_avance fa, beneficiario b, avance a, avance_beneficiario ab
WHERE (
fa.idFondo =  '3'
AND fa.cedulaPersona = a.cedulaPersona
AND a.cedulaPersona = p.cedulaPersona
AND a.cedulaPersona = ab.cedulaPersona
AND fa.cedulaBeneficiario = ab.cedulaBeneficiario
AND ab.cedulaBeneficiario = b.cedulaBeneficiario
)");
	while ($result1 = mysql_fetch_assoc($result)){
		extract($result1);
		$listaRetiro = $listaRetiro.
		'<tr>
      	<td>'.$idFondoAvance.'</td>
		  <td>Fallecimiento</td>
		  <td>'.$cedulaPersona.'</td>
		  <td>'.$nombrePersona.'</td>
		  <td>'.$apellidoPersona.'</td>
		  <td>'.$cedulaBeneficiario.'</td>
		  <td>'.$nombreBeneficiario.'</td>
		  <td>'.$apellidoBeneficiario.'</td>
		  <td>'.$montoFondoAvance.' Bsf.</td>
		  <td>'.$fechaFondoAvance.'</td>  
		</tr>';
	}	/*<td><a href="../php/consultarRetiro.php?idFondoAvance='.$idFondoAvance.
		  '&cedulaPersona='.$cedulaPersona.'&cedulaBeneficiario='.$cedulaBeneficiario.'">Consultar</a></td>*/
	
	$result = mysql_query("SELECT fa.idFondoAvance, fa.idFondo, p.cedulaPersona, p.nombrePersona, p.apellidoPersona, fa.montoFondoAvance, fa.fechaFondoAvance
FROM persona p, fondo_avance fa, avance a
WHERE (
fa.idFondo =  '4'
AND fa.cedulaPersona = a.cedulaPersona
AND a.cedulaPersona = p.cedulaPersona
)");
	while ($result1 = mysql_fetch_assoc($result)){
		extract($result1);
		$listaRetiro = $listaRetiro.
		'<tr>
      	<td>'.$idFondoAvance.'</td>
		  <td>Voluntario</td>
		  <td>'.$cedulaPersona.'</td>
		  <td>'.$nombrePersona.'</td>
		  <td>'.$apellidoPersona.'</td>
		  <td>----------</td>
		  <td>----------</td>
		  <td>----------</td>
		  <td>'.$montoFondoAvance.' Bsf.</td>
		  <td>'.$fechaFondoAvance.'</td>	  
		</tr>';
		/*<td><a href="../php/consultarRetiro.php?idFondoAvance='.$idFondoAvance.
		  '&cedulaPersona='.$cedulaPersona.'&cedulaBeneficiario='.$cedulaBeneficiario.'">Consultar</a></td>*/
	}
	$pnlcontent->add("consultarRetiro",$listaRetiro);
		
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>