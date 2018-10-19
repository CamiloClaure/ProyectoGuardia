<?php
require_once('../Conexion.php');

$grupo = getGrupo($conn);
$grupo += 1;

$consulta = "select concat(grado,' ',apellido) as oficialSuperior,idoficial from OFICIAL where descripcion like 'Superior'";
$respuesta = mysqli_query($conn,$consulta);

$oficial = ' <div class="col-sm-6"> <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lJefe">Jefe de ronda</span>
                                    </div>
                                    <div name="jefeRonda" placeholder="jefeRonda" class="form-control"  aria-label="jefeRonda" aria-describedby="lJefe">

                                    <select id="selectModificarJefe" class="form-control form-control-sm" name="jefeRonda">
                                    <option selected="true" disabled>Seleccionar</option>';
while($datos = mysqli_fetch_array($respuesta)){
    $oficial .= '<option value="'.$datos['oficialSuperior'].'-'.$datos['idoficial'].'">'.$datos['oficialSuperior'].'-'.$datos['idoficial'].'</option>';
}
$oficial .= '</select></div></div></div>';

$consulta = "select concat(grado,' ',apellido) as oficialSubalterno, idoficial from OFICIAL where descripcion like 'Subalterno'";
$respuesta = mysqli_query($conn,$consulta);

$oficial .= '<div class="col-sm-6"> <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lCap">Capitan de servicio</span>
                                    </div>
                                    
                                    <div name="capServicio" placeholder="capServicio" class="form-control"  aria-label="capServicio" aria-describedby="lCap">
                                    <select id="selectModificarCap" class="form-control form-control-sm" name="capServicio" placeholder="Seleccionar">
                                    <option selected="true" disabled>Seleccionar</option>';
while($datos = mysqli_fetch_array($respuesta)){
    $oficial.= '<option value="'.$datos['oficialSubalterno'].'-'.$datos['idoficial'].'">'.$datos['oficialSubalterno'].'-'.$datos['idoficial'].'</option>';
}
$oficial .= '</select></div></div></div><script>document.getElementById("igrupo").value = '.$grupo.';</script>';
echo $oficial;

function getGrupo($conn){
    $strGrup = "select grupo from LISTA_GUARDIA order by grupo desc limit 1";
    $grupo = mysqli_fetch_array(mysqli_query($conn,$strGrup));
    return $grupo[0];
}
?>