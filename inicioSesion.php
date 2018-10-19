<?php
require_once("Conexion.php");

$usuario = $_POST["Usuario"];
$pass = $_POST["Contraseña"];
$resultado;

$strConsulta = "CALL spLogin('$pass','$usuario',@resultado)";
$consulta = mysqli_query( $conn, $strConsulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
$str1Consulta = "select @resultado as respuesta";
$consulta1= mysqli_query( $conn, $str1Consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
$datos = mysqli_fetch_array($consulta1);
$contra = $datos["respuesta"];
if ($contra=="estudiante") {
	session_start();
    $_SESSION['usuario'] = $usuario;
   $_SESSION['pass'] = $pass;
	  header('Location: Estudiante\Estudiante.php');
}
else{

	if($contra=="administrador")
         {
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['pass'] = $contra;
         	header('Location: Administrador\Administrador2.0.php');
         }
         else
         {
         
         	header('Location:index.html');


         }

     }  

?>