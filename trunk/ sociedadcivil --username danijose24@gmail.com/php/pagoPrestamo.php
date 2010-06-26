<?php

		require_once("../classes/Panel.php");
		include "../db/conexion.php";
		
		$pnlmain = new Panel("../html/main.html");
		$pnlmenu = new Panel("../html/menu.html");
		$pnlcontent = new Panel("../html/pagoPrestamo.html");
		
		$pnlmenu->add("activo6",'id="active"');		//Coloca en Verde el link de Prestamo
		
		//Colocar Links
		
		$pnlmenu->add("opcion1",'<a href="solicitarPrestamo.php">Solicitar Prestamo</a>');
		$pnlmenu->add("opcion2",'<a href="condicionesPrestamo.php">Junta Directiva - Condiciones de Prestamo</a>');
		$pnlmenu->add("opcion3",'<a href="listaFactura.php">Consultar Factura de Prestamos</a>');
		$pnlmenu->add("opcion4",'<a href="cancelarPrestamo.php">Cancelar Cuota de Prestamo</a>');
		
		$seleccion = $_REQUEST['cedula'];
		
		$solicitanteBD = mysql_query("Select * from persona, prestamo_persona, prestamo 
														where prestamo.idPrestamo = prestamo_persona.idPrestamo AND
														'$seleccion' = prestamo_persona.cedulaPersona");
		
		$solicitante = mysql_fetch_assoc($solicitanteBD);
		
		//Llenar
		
		$pnlcontent->add("cedula",$solicitante['cedulaPersona']);
		$pnlcontent->add("nombre",$solicitante['nombrePersona']);
		$pnlcontent->add("apellido",$solicitante['apellidoPersona']);
		$pnlcontent->add("monto",$solicitante['montoPrestamo']);
		$pnlcontent->add("fecha",$solicitante['fechaPrestamo']);
		$pnlcontent->add("nCuotas",$solicitante['cuotaPrestamo']);
		$pnlcontent->add("montoCuota",$solicitante['montoCuotaPrestamo']);
		$n = $solicitante['cuotaPrestamo'];
		
		for($i=1; $i<=$n; $i++)
		{
			$datos = $datos.'<option value="'.$i.'">'.$i.'</option>';
		}
		
		$pago = $_REQUEST['cuota'];
		
		if($pago!=0)
		{
			$cuotasPagadas = $n-$pago;
			
			$id = $solicitante['idPrestamo'];
			
			mysql_query("UPDATE prestamo set cuotaPrestamo ='$cuotasPagadas'
						where idPrestamo = '$id' ");
			if($cuotasPagadas==0)
			{
				mysql_query("UPDATE prestamo_persona set estadoPrestamo = 3
							where idPrestamo = '$id' ");
			}
			for($i=1; $i<=$pago;$i++)
			{
				mysql_query("INSERT INTO ingreso (idPrestamo) values ('$id')");
			}
			
			$montoCancelado = $pago*$solicitante['montoCuotaPrestamo'];
			
			$pnlcontent->add("mensaje","Pago realizado con exito se han cancelado BsF $montoCancelado.");
		}
		
		$pnlcontent->add("lista",$datos);
		$pnlmain->add("content",$pnlcontent);
		$pnlmain->add("menu",$pnlmenu);
		$pnlmain->show();
		
?>