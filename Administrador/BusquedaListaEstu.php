<?php
require_once('../Conexion.php');
$grupo = $_REQUEST["q"];
$idFila = 1;

$consultaTabla = "select lgv.grupo,lgv.cargo,ofi.idoficial as codigo,lgv.grado, concat(ofi.nombre ,' ', ofi.apellido ) as nombre,lgv.fecha
                    from OFICIAL ofi 
	                   inner join LISTA_GUARDIA_VIG lgv
	                   on  lgv.idoficial = ofi.idoficial
                    where lgv.codigoEstudiante = '0' and grupo = $grupo and borrado = 0";

$respuestaTablaHeader = mysqli_query($conn,$consultaTabla);

$consultaTabla = "select lgv.grupo,lgv.cargo,lgv.grado , est.codigo,concat(est.apellido_pat,' ',est.apellido_mat,' ', est.nombre) as nombre, est.semestre, est.carrera, lgv.fecha
                        from  LISTA_GUARDIA_VIG lgv
	                       inner join ESTUDIANTE est
	                       on est.codigo = lgv.codigoEstudiante
                           where grupo = $grupo and borrado = 0";

$respuestaTabla = mysqli_query($conn,$consultaTabla);

$tabla = '<table id="listaGuardiaTmp" class="table table-striped table-responsive">
    <tr><th>Nro.</th>
    <th>Grupo</th>
    <th>Cargo</th>
    <th>Codigo</th>
    <th>Grado</th>
    <th>Nombre</th>
    <th>Semestre</th>
    <th>Carrera</th>
    <th>Fecha</th>
    </tr>';

while($datos = mysqli_fetch_array($respuestaTablaHeader)){
    $tabla .= '<tr>
                    <td>'.$idFila.'</td>
                    <td>'.$datos['grupo'].'</td>
                    <td>'.$datos['cargo'].'</td>
                    <td>'.$datos['codigo'].'</td>
                    <td>'.$datos['grado'].'</td>
                    <td>'.$datos['nombre'].'</td>
                    <td>-</td>
                    <td>-</td>
                    <td>'.$datos['fecha'].'</td>
                </tr>';
    $idFila += 1;
    
}

while($datos = mysqli_fetch_array($respuestaTabla)){
    $tabla .= '<tr>
                    <td>'.$idFila.'</td>
                    <td>'.$datos['grupo'].'</td>
                    <td>'.$datos['cargo'].'</td>
                    <td>'.$datos['codigo'].'</td>
                    <td>'.$datos['grado'].'</td>
                    <td>'.$datos['nombre'].'</td>
                    <td>'.$datos['semestre'].'</td>
                    <td>'.$datos['carrera'].'</td>
                    <td>'.$datos['fecha'].'</td>
                </tr>';
    $idFila += 1;
    
}
$tabla .= '</table>';

#-------------------------------------------------


echo $tabla;

#============================================================================================================================================================
/*
$consulta = "select codigo, nombre, apellido_pat  from ESTUDIANTE where codigo in (select codigoEstudiante from LISTA_GUARDIA_VIG where grupo = ".$grupo.")";

$query = mysqli_query($conn,$consulta);

$respuesta = "";
if($query){
     $respuesta = '<table id="ListaGEst">
    <tr><th>Codigo</th>
    <th>Apellido</th>
    <th>Nombre</th></tr>';
    while($datos = mysqli_fetch_array($query)){
       $respuesta .= '<tr class="estudianteX"><td>'.$datos['codigo'].'</td>
                          <td>'.$datos['apellido_pat'].'</td>
                          <td>'.$datos['nombre'].'</td>
                          <td></tr>';
    }
    $respuesta .= '</table>';
}

echo $respuesta;

*/
?>
