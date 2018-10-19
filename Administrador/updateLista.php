<?php 
require_once('../Conexion.php');
session_start();
 $grupo = $_POST["grupo"];
$getListatmp = "delete from LISTA_GUARDIA_VIG
                where grupo = $grupo";
$execConsulta = mysqli_query($conn,$getListatmp);
$getListatmp = "delete from LISTA_GUARDIA
                where grupo = $grupo";
$execConsulta = mysqli_query($conn,$getListatmp);

$setListaGuardia = "insert into LISTA_GUARDIA(OPERACIONES_idAdministrador,grupo,oficial,cargo,fecha)
                    select '".$_SESSION["usuario"]."' as 'OPERACIONES_idAdministrador',grupo, idoficial, cargo, fecha
                    from LISTA_GUARDIA_VIG_TMP
                    where codigoEstudiante = '0'";
$execConsulta = mysqli_query($conn,$setListaGuardia);

$setListaGuardiaVig = "insert into LISTA_GUARDIA_VIG
                        SELECT *
                        FROM LISTA_GUARDIA_VIG_TMP";
$execConsulta = mysqli_query($conn,$setListaGuardiaVig);

$limpiar = "delete from LISTA_GUARDIA_VIG_TMP;";
$cLimpiar = mysqli_query($conn,$limpiar);

echo '<script>bootbox.alert("mssmss '.$grupo.'");</script>';
?>
