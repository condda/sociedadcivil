<?php
	
	require_once ("../classes/Panel.php");
	include "../db/conexion.php";
	
	/********INICIO*************/
	
	$pnlmain = new Panel("../html/main.html");
	$pnlmenu = new Panel("../html/menu.html");
	$pnlcontent = new Panel ("../html/eliminarVehiculo.html");	
	$pnlmenu->add("activo1",'id="active"');
	$pnlmenu->add("opcion1",'<a href="socio.php">Socio</a>');
	$pnlmenu->add("opcion2",'<a href="avance.php">Avance</a>');
	$pnlmenu->add("opcion3",'<a href="beneficiario.php">Beneficiario</a>');
	$pnlmenu->add("opcion4",'<a href="retiro.php">Retirar Socio/Avance</a>');
	$pnlmenu->add("opcion5",'<a href="Inscripcion.php">Inscripcion</a>');
	$pnlmenu->add("opcion6",'<a href="vehiculo.php">Vehiculo</a>');
	$pnlmenu->add("opcion7",'<a href="pasaje.php">Pasaje</a>');
	
	$placa = $_REQUEST['lista'];
	$opcion = $_REQUEST['opcion'];
	
		/**********BASE DE DATOS***********/
		
		$result =  mysql_query ("SELECT * FROM vehiculo");
		
		if ($result1 = mysql_fetch_assoc($result))
		{
			while($result1)
			{
						$datos = $datos.'<option value="'.$result1['placaVehiculo'].'">'.$result1['placaVehiculo'].'</option>';						
						$result1= mysql_fetch_assoc($result);
			}
			
			$result2 =  mysql_query ("SELECT * FROM vehiculo V, traspaso T, persona P WHERE V.placaVehiculo = '$placa'
									 and V.idVehiculo = T.idVehiculo and T.cedulaPersona = P.cedulaPersona");		
			
			
			/*************************************/

			if($result3 = mysql_fetch_assoc($result2))
			{
				$listar = $listar.'<tr>
				<td>'.$result3['nombrePersona'].' '.$result3['apellidoPersona'].'</td>
				<td>'.$result3['anoVehiculo'].'</td>
				<td>'.$result3['estadoVehiculo'].'</td>
				<td>'.$result3['polizaVehiculo'].'</td>
				</tr>';
			}
			else
			{
			//	$pnlcontent->add("mensaje","NOOOOOOOOOOOO");
			}
			
			if($opcion == '1')
			{
				
				$grr = mysql_query ("SELECT idVehiculo FROM vehiculo v WHERE v.placaVehiculo = '$placa'");
				
				$guau = mysql_fetch_assoc($grr);
				$idV = $guau['idVehiculo'];
				
				mysql_query (" DELETE FROM traspaso WHERE idVehiculo = '$idV' and listaTraspaso = '0' ");
				
				mysql_query (" DELETE FROM vehiculo WHERE idVehiculo = '$idV'");
				
				
		
					
			}
		}
	
		
		
	/************FINAL*****************/	
	$pnlcontent->add("listaVehiculos",$datos);
	$pnlcontent->add("lista",$listar);
	$pnlmain->add("menu",$pnlmenu);
	$pnlmain->add("content",$pnlcontent);


	$pnlmain->show();
	
	
?>