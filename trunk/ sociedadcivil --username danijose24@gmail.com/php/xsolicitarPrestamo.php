 <?php
		require_once("../classes/Panel.php");
		require('../fpdf16/fpdf.php');
		include "../db/conexion.php";
		include "date.php";
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel("../html/xsolicitarPrestamo.html");
		$pnlmenu->add("activo6",'id="active"');		//Coloca en Verde el link de Prestamo
		
		$pnlmenu->add("opcion1",'<a href="solicitarPrestamo.php">Solicitar Prestamo</a>');
		$pnlmenu->add("opcion2",'<a href="condicionesPrestamo.php">Junta Directiva - Condiciones de Prestamo</a>');
		$pnlmenu->add("opcion3",'<a href="listaFactura.php">Consultar Factura de Prestamos</a>');
		$pnlmenu->add("opcion4",'<a href="cancelarPrestamo.php">Cancelar Cuota de Prestamo</a>');
		//Variable del otro Php
		
		$cedula = $_REQUEST['cedula'];
		
		//Consulta de la Base de datos
		
		$solicitanteBD = mysql_query ("SELECT * FROM persona,prestamo_persona WHERE persona.cedulaPersona='$cedula' AND 
									  prestamo_persona.cedulaPersona ='$cedula'");
								
		//Traduccion de Datos
		
		$solicitante = mysql_fetch_assoc($solicitanteBD);
		
		$id = $solicitante['idPrestamo'];
		
		$prestamoBD = mysql_query("SELECT * FROM prestamo p, prestamo_persona pp WHERE p.idPrestamo = '$id' and
								  pp.idPrestamo = '$id'");
		
		$prestamo = mysql_fetch_assoc($prestamoBD);
		
		//Llenado de Campos
		
		$pnlcontent->add("cedula",$solicitante['cedulaPersona']);
		$pnlcontent->add("solicitante",$solicitante['nombrePersona'].' '.$solicitante['apellidoPersona']);
		$pnlcontent->add("cuota",$prestamo['cuotaPrestamo']);
		$pnlcontent->add("montoMaximo",$prestamo['montoPrestamo']);
		
		$numeroCuota = $prestamo['cuotaPrestamo'];
		
		//REQUEST
		
		$montoSolicitado = $_REQUEST['montoSolicitado'];
		
		if($montoSolicitado && ($montoSolicitado <= $prestamo['montoPrestamo']) )
		{
			if($prestamo['estadoPrestamo']==1)
			{
				$pnlcontent->add("mensaje","El prestamo ya ha sido otorgado.");
			}
			else
			{
				$montoCuota = $montoSolicitado/$numeroCuota;
				
				mysql_query ("UPDATE prestamo SET montoPrestamo = '$montoSolicitado' WHERE idPrestamo='$id'");
				mysql_query ("UPDATE prestamo_persona SET estadoPrestamo = 1, montoCuotaPrestamo = '$montoCuota'
							 WHERE idPrestamo='$id'");
				
				//Registro del egreso
				
				mysql_query("INSERT into egreso (idPrestamo, tipoEgreso)
							VALUES ('$id',
									6)");
			}
	
						
		}
		else if ($montoSolicitado > $prestamo['montoPrestamo'])
		{
			$pnlcontent->add("mensaje","El monto solicitado excede su monto permitido.");
		}
	
		
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
?>