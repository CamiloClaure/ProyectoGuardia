<?php
require_once("Conexion.php");

$usuario = $_POST["Usuario"];
$pass = $_POST["Contraseña"];

$strConsulta = "select passwd from ESTUDIANTE where nombre = '$usuario'";
$consulta = mysqli_query($conn,$strConsulta);

$datos = mysqli_fetch_array($consulta);
$contra = $datos["passwd"];
if($contra == $pass && $pass != ""){
    echo "lo hiciste";
   session_start();
   $_SESSION['usuario'] = $usuario;
   $_SESSION['pass'] = $contra;
    header('Location: Estudiante\Estudiante.php');
}else{
    header('Location: index.html');
	echo "<script>alert('$contra');</script>";

}

?>
