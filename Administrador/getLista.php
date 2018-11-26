<?php
require_once('../Conexion.php');
$grupo = $_POST["group"];
$fecha = $_POST["date"];
$idFila = 1; 
$consulta = "SELECT idoficial, fecha
             FROM LISTA_GUARDIA_VIG
             WHERE grupo = $grupo";

if(validateDate(date('Y-m-d'),$fecha)){
    $query = mysqli_query($conn,$consulta);
    $salida = "<script>";
    $datos = mysqli_fetch_array($query);
    $salida .= '$("#selectModificarJefe").val("'.$datos["idoficial"].'").attr("selected","selected");';
    $fecha = $datos["fecha"];
    $fecha = explode(" ",$fecha);
    $datos = mysqli_fetch_array($query);
    $salida .= '$("#selectModificarCap").val("'.$datos["idoficial"].'").attr("selected","selected");';
    
    $salida .= '$("#igrupoModif").val("'.$grupo.'");';
    $salida .= '$("#ifechaModif").val("'.$fecha[0].'");';
    $salida .= '</script>';
    $consultaTabla = "select est.codigo,concat(est.apellido_pat,' ',est.apellido_mat,' ', est.nombre) as nombre, est.semestre, est.carrera
                            from  LISTA_GUARDIA_VIG lgv
                               inner join ESTUDIANTE est
                               on est.codigo = lgv.codigoEstudiante
                               where grupo = $grupo";
    $respuestaTabla = mysqli_query($conn,$consultaTabla);
    
    $salida .= '<form id="frmReadyToSendStudents"><table id="listaGuardiaModifcarT" class="table table-striped table-responsive">
        <tr><th>Nro.</th>
        
        <th>Codigo</th>
       
        <th>Nombre</th>
        <th>Carrera</th>
        <th>Semestre</th>
        <th>Seleccionar</th></tr>
        </tr>';
    
    while($datos = mysqli_fetch_array($respuestaTabla)){
        $salida .= '<tr class="nroFila" value="'.$datos['codigo'].'">
                        <td >'.$idFila.'</td>
                       
                        <td>'.$datos['codigo'].'</td>
                       
                        <td>'.$datos['nombre'].'</td>
                        <td>'.$datos['carrera'].'</td>
                        <td>'.$datos['semestre'].'</td>
                        <td>
                        <input class="form-check-input position-static" type="checkbox" name="codSelectedModificar[]" checked="checked" id="'.$idFila.'" value="'.$datos['codigo'].'">
                        </td>
                    </tr>';
        $idFila += 1;
        
    }
    $salida .= '</table></form>';
        
    echo $salida;
    

}else{
    echo "No es posible realizar esta accion, fecha invalida";

}



function validateDate($hoy,$fechaGuardia){
    
    if($hoy > $fechaGuardia){
        return false;
    }else{
        return true;
    }
}
?>