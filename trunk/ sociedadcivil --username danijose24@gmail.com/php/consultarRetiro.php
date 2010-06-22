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
	$pnlcontent = new Panel("../html/consultarRetiro.html");	
	
	$result = mysql_query("SELECT distinct fs.idFondoSocio, fs.idFondo, p.cedulaPersona, p.nombrePersona, p.apellidoPersona, fs.montoFondoSocio, fs.fechaFondoSocio, b.cedulaBeneficiario, b.nombreBeneficiario, b.apellidoBeneficiario
FROM persona p, fondo_socio fs, beneficiario b, socio s, socio_beneficiario sb
WHERE (
fs.idFondo =  '3'
AND fs.cedulaPersona = s.cedulaPersona
AND s.cedulaPersona = p.cedulaPersona
AND s.cedulaPersona = sb.cedulaPersona
AND fs.cedulaBeneficiario = sb.cedulaBeneficiario
AND sb.cedulaBeneficiario = b.cedulaBeneficiario
)");
	while ($result1 = mysql_fetch_assoc($result)){
		extract($result1);
		$listaRetiro = $listaRetiro.
		'<tr>
      	<td>'.$idFondoSocio.'</td>
		  <td>Fallecimiento</td>
		  <td>'.$cedulaPersona.'</td>
		  <td>'.$nombrePersona.'</td>
		  <td>'.$apellidoPersona.'</td>
		  <td>'.$cedulaBeneficiario.'</td>
		  <td>'.$nombreBeneficiario.'</td>
		  <td>'.$apellidoBeneficiario.'</td>
		  <td>'.$montoFondoSocio.' Bsf.</td>
		  <td>'.$fechaFondoSocio.'</td>  
		</tr>';
	}	/*<td><a href="../php/consultarRetiro.php?idFondoSocio='.$idFondoSocio.
		  '&cedulaPersona='.$cedulaPersona.'&cedulaBeneficiario='.$cedulaBeneficiario.'">Consultar</a></td>*/
	
	$result = mysql_query("SELECT fs.idFondoSocio, fs.idFondo, p.cedulaPersona, p.nombrePersona, p.apellidoPersona, fs.montoFondoSocio, fs.fechaFondoSocio
FROM persona p, fondo_socio fs, Socio s
WHERE (
fs.idFondo =  '4'
AND fs.cedulaPersona = s.cedulaPersona
AND s.cedulaPersona = p.cedulaPersona
)");
	while ($result1 = mysql_fetch_assoc($result)){
		extract($result1);
		$listaRetiro = $listaRetiro.
		'<tr>
      	<td>'.$idFondoSocio.'</td>
		  <td>Voluntario</td>
		  <td>'.$cedulaPersona.'</td>
		  <td>'.$nombrePersona.'</td>
		  <td>'.$apellidoPersona.'</td>
		  <td>----------</td>
		  <td>----------</td>
		  <td>----------</td>
		  <td>'.$montoFondoSocio.' Bsf.</td>
		  <td>'.$fechaFondoSocio.'</td>	  
		</tr>';
		/*<td><a href="../php/consultarRetiro.php?idFondoSocio='.$idFondoSocio.
		  '&cedulaPersona='.$cedulaPersona.'&cedulaBeneficiario='.$cedulaBeneficiario.'">Consultar</a></td>*/
	}
	$pnlcontent->add("consultarRetiro",$listaRetiro);
		
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);
	$pnlmain->show();
	include "../db/cerrar_conexion.php";
?>