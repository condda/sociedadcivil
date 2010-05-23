<?
$dbhost="localhost";  // host del MySQL (generalmente localhost)
$dbusuario="root"; // aqui debes ingresar el nombre de usuario
                      // para acceder a la base
$dbpassword="2542019"; // password de acceso para el usuario de la
                      // linea anterior
$db="sociedadcivil";        // Seleccionamos la base con la cual trabajar
$conexion = mysql_connect($dbhost, $dbusuario, $dbpassword) or die ("<center>No se puede conectar con la base de datos\n</center>\n");
mysql_select_db($db, $conexion);
if (!$conexion)
echo "NO CONECTO";
?>
