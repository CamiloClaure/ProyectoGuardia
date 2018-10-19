<?php
require_once('../Conexion.php');

$limpiar = "delete from LISTA_GUARDIA_VIG_TMP;";
$cLimpiar = mysqli_query($conn,$limpiar);
?>