<?php
try{
require_once('../Conexion.php');

$semestre = $_POST["semestreM"];
$carrera = $_POST["carreraM"];
$sem = getSemestre($semestre);
$carrera = implode("', '",$carrera);
$idFila = 1; 

$limpiar = "delete from LISTA_GUARDIA_VIG_TMP;";
$cLimpiar = mysqli_query($conn,$limpiar);
    
    $consulta = "select codigo, concat(apellido_pat,' ',apellido_mat,' ', nombre) as nombre, carrera, semestre
             from ESTUDIANTE
             where flagGuardia = 0 and (semestre in ($sem)) and (carrera IN ('$carrera')) order by carrera;";
$respuesta = mysqli_query($conn,$consulta);

$tabla = '<form id="formTmpEstModificar">
    <table id="listaEstudiantesModificar" class="table table-striped table-responsive">
    <tr><th>Nro.</th>
    <th>Codigo</th>
    <th>Nombre</th>
    <th>Carrera</th>
    <th>Semestre</th>
    <th>Seleccionar</th></tr>';

while($datos = mysqli_fetch_array($respuesta)){
    $tabla .= '<tr>
                    <td class="nroFila">'.$idFila.'</td>
                    <td>
                    <input type="hidden" name=codigo id="codEst'.$idFila.'" value="'.$datos['codigo'].'">'.$datos['codigo'].'</td>
                    <td>
                    <input type="hidden" name=nombre id="nomEst'.$idFila.'" value="'.$datos['nombre'].'">'.$datos['nombre'].'</td>
                    <td>
                    <input type="hidden" name=cr id="crEst'.$idFila.'" value="'.$datos['carrera'].'">'.$datos['carrera'].'</td>
                    <td>
                    <input type="hidden" name=sem id="semEst'.$idFila.'" value="'.$datos['semestre'].'">'.$datos['semestre'].'</td>
                    <td>
                    <input class="form-check-input position-static movible" type="checkbox" name="codSelectedModificar[]" id="m'.$idFila.'" value="'.$datos['codigo'].'">
                    </td>
                </tr>';
    $idFila += 1;
    
}
$tabla .= '</table></form>';

echo $idFila === 1 ? "No hay informacion del/los cursos seleccionados" : $tabla;

    
}catch(Exception $e){
    echo "No hay informacion para mostrar";
}

function getSemestre($sem){
    $respuesta = "";
    for($i = 0;$i < count($sem);$i++){
            if($i == (count($sem) - 1)){
                $respuesta .= $sem[$i][0];
            }else{
                $respuesta .= $sem[$i][0].',';
            }
        
    }
    return $respuesta;
}
?>


