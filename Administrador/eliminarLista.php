<?php
require_once('../Conexion.php');
$grupo = $_POST["borrar"];
$consultaFecha = "select fecha
                  from LISTA_GUARDIA
                  where grupo = $grupo";
$query = mysqli_query($conn,$consultaFecha);
$dato = mysqli_fetch_array($query);
$fechaGuardia = $dato['fecha'];
if(validateDate(date('Y-m-d'),$fechaGuardia)){
    $consultaDel = "update LISTA_GUARDIA
    set borrado = 1
    where grupo = $grupo";
$query = mysqli_query($conn,$consultaDel);
$consultaDel = "update LISTA_GUARDIA_VIG
    set borrado = 1
    where grupo = $grupo";
$query = mysqli_query($conn,$consultaDel);

echo "Lista eliminada exitosamente";

}else{
    echo "No es posible borrar lista, fecha invalida -> ".$fechaGuardia;

}

function validateDate($hoy,$fechaGuardia){
    
    if($hoy > $fechaGuardia){
        return false;
    }else{
        return true;
    }
}
?>