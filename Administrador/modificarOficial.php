<?php
require_once('../Conexion.php');

$nombre = $_POST["nombre"];
$apellidoM = $_POST["apellidoM"];
$apellidoP = $_POST["apellidoP"];
$codigo = $_POST["codigo"];
$carrera = $_POST["carrera"];
$grado = $_POST["grado"];
$descripcion = $_POST["descripcion"];
$semestre = $_POST["semestre"];
$celular = $_POST["celular"];
$turno = $_POST["turno"];
$genero = $_POST["genero"];
$correo = $_POST["correo"];


$consulta = "update OFICIAL
			set nombre = '$nombre', apellido = '$apellidoP', apellidoM = '$apellidoM', celular = '$celular', carrera = '$carrera' ,semestre = '$carrera', descripcion = '$descripcion', grado = '$grado', turno = '$turno', genero = '$genero',correo = '$correo'
			where idoficial = '$codigo'";

$updatear = mysqli_query($conn,$consulta);

if($updatear){
	echo "Registro modificado exitosamente".$consulta;

}else{
	echo "Registro no fue modificado";


}




 ?>
