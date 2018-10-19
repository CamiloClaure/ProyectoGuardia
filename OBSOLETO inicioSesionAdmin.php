<?php
require_once("Conexion.php");

$usuario = $_POST["Usuario"];
$pass = $_POST["Contraseña"];

$strConsulta = "select codigo from OPERACIONES where nombre = '$usuario'";
$consulta = mysqli_query($conn,$strConsulta);

$datos = mysqli_fetch_array($consulta);
$contra = $datos["codigo"];
if($contra == $pass && $pass != ""){
    echo "lo hiciste";
   session_start();
   $_SESSION['usuario'] = $usuario;
   $_SESSION['pass'] = $contra;
    header('Location: Administrador\Administrador2.0.php');
}else{
    header('Location: inicioAdmin.html');

}

?>
