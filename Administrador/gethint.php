<?php
require_once('../Conexion.php');
$q = $_REQUEST["q"];

if ($q !== "") {
    $q = strtoupper($q);


$consulta = "select semestre, turno, nombre, apellido_pat,apellido_mat, carrera, cargo, genero, codigo from ESTUDIANTE where codigo like '%$q%' LIMIT 1";

$query = mysqli_query($conn,$consulta);
}
$respuesta = "";
if($query){
    while($datos = mysqli_fetch_array($query)){
       $respuesta = $datos['semestre'] ."," .$datos['turno']."," .$datos['nombre']."," .$datos['apellido_pat'] .$datos['apellido_mat']."," .$datos['carrera']."," .$datos['cargo']."," .$datos['genero']."," .$datos['codigo'];
    }
}

echo $respuesta === "" ? "No, existe" : $respuesta;
?>
