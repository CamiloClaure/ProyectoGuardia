<?php
require_once('../Conexion.php');
$q = $_REQUEST["q"];

if ($q !== "") {
    $q = strtoupper($q);


$consulta = "select nombre, apellido, apellidoM, celular, carrera ,semestre, descripcion, grado, turno, genero,correo,idoficial from OFICIAL where idoficial like '%$q%' LIMIT 1";

$query = mysqli_query($conn,$consulta);
}
$respuesta = "";
if($query){
    while($datos = mysqli_fetch_array($query)){
       $respuesta = $datos['nombre'] ."," .$datos['apellido']."," .$datos['apellidoM']."," .$datos['celular']."," .$datos['carrera']."," .$datos['semestre']."," .$datos['descripcion']."," .$datos['grado']."," .$datos['turno']."," .$datos['genero']."," .$datos['correo']."," .$datos['idoficial'];
    }
}

echo $respuesta === "" ? "No, existe" : $respuesta;
?>
