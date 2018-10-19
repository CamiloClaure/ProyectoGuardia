<?php
require_once('../Conexion.php');

$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$codigo = $_POST["codigo"];//este nel
$carrera = $_POST["carrera"];
$semestre = $_POST["semestre"];
$turno = $_POST["turno"];
$genero = $_POST["genero"];
$cargo = $_POST["cargo"];

$consulta = "update ESTUDIANTE
			set nombre = '$nombre', apellido_pat = '$apellidos', carrera = '$carrera' , semestre = '$semestre' , turno = '$turno' , genero = '$genero' , cargo = '$cargo'
			where codigo = '$codigo' ";

$updatear = mysqli_query($conn,$consulta);

if($updatear){
	echo "Registro modificado exitosamente";

}else{
	echo "Registro no fue modificado";


}




 ?>
