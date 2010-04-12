<?php
	session_start();
	$pathFix = dirname(__FILE__);
	require_once ("$pathFix/Panel.php");
	include "../db/conexion.php";

	if ($_SESSION['usuario']){
		$pnlmain = new Panel("../html/index.html");
		$pnlmain->add("nombre",$_SESSION['nombre']);	
		$pnlmain->add("apellido",$_SESSION['apellido']);			
		$pnlcontent = new Panel("../html/content.html");
	}
	else{	
		$pnlmain = new Panel("../html/login.html");
		$usuario = $_REQUEST['usuario'];
		$contrasena = $_REQUEST['contrasena'];
	}
	
	if (($usuario)&&($contrasena)){
		$result = mysql_query("SELECT empleado_nombre, empleado_apellido FROM empleado WHERE empleado_cedula = '$usuario' AND empleado_contrasena = '$contrasena'",$conexion);	
		$result1 = mysql_fetch_assoc($result);

		if ($result1){
			$pnlmain = new Panel("../html/index.html");
			$pnlcontent = new Panel("../html/content.html");
			
			$usuario_nombre = $result1['empleado_nombre'];
			$usuario_apellido = $result1['empleado_apellido'];	
			$pnlmain->add("nombre",$usuario_nombre);	
			$pnlmain->add("apellido",$usuario_apellido);	
			session_start();
			$_SESSION['usuario'] = $usuario;
			$_SESSION['nombre'] = $usuario_nombre;
			$_SESSION['apellido'] = $usuario_apellido;
			
		}
		else{
			$pnlmain->add("error","El nombre de usuario o contraseña son incorrectos");	
			$pnlmain->add("usuario",$usuario);	
		}
	}
	
	$pnlmain->add("CONTENT",$pnlcontent);	
	include "../db/cerrar_conexion.php";
?>
	