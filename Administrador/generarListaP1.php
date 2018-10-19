<?php
require_once('../Conexion.php');
$grupo = (integer)$_POST["grupo"];
/*
$semestre = $_POST["semestre"];
$carrera = $_POST["carrera"];
$sem = getSemestre($semestre);
*/
$fecha = $_POST["fecha"];
$fecha_actual = new DateTime(date('Y-m-d'));
$fecha_actual = $fecha_actual->format('Y-m-d');

$JefeR = explode("-",$_POST["jefeRonda"]) ;
$CapS = explode("-",$_POST["capServicio"]);
$estudiantes = $_POST["codSelected"];
$idFila = 1; 

$codigoJefe = $JefeR[count($JefeR)-1];
$codigoCap = $CapS[count($CapS)-1];

$gradoJefe = explode(" ",$JefeR[0]);
$gjefe = $gradoJefe[0];

$gradoCap = explode(" ",$CapS[0]);
$gcap = $gradoCap[0];


$estudiantes = getEstudiantes($estudiantes);

$fechaVal =  validateDate($fecha,$conn);
if($fechaVal){

    $insertaHeaderLista = "insert into LISTA_GUARDIA_VIG_TMP(idoficial,codigoEstudiante,grado, grupo,cargo, fecha,flagPermiso)
                            values ('$codigoJefe','0','$gjefe','$grupo','Jefe de ronda','$fecha','0')";
    $consulta = mysqli_query($conn,$insertaHeaderLista);
    $insertaHeaderLista = "insert into LISTA_GUARDIA_VIG_TMP(idoficial,codigoEstudiante,grado, grupo,cargo, fecha,flagPermiso)
                            values ('$codigoCap','0','$gcap','$grupo','Cap. de servicio','$fecha','0')";
    $consulta = mysqli_query($conn,$insertaHeaderLista);
      
    $consultaMananaH = "insert into LISTA_GUARDIA_VIG_TMP(idoficial,codigoEstudiante,grado, grupo,cargo, fecha,flagPermiso)
                        select 0 as 'idoficial', codigo,'Est.', $grupo as 'grupo','Numero' as 'cargo', '$fecha' as 'fecha', 0 as 'flagPermiso' 
                        from ESTUDIANTE
                        where flagGuardia = 0 and (codigo IN ('$estudiantes')) limit 100;";
    $respuesta = mysqli_query($conn,$consultaMananaH);
    
    
    /*$consultaTabla = "select lgv.grupo  , ofi.apellido , est.codigo as 'Codigo est',  est.semestre, est.nombre, lgv.fecha, est.carrera
                    from OFICIAL ofi 
                        right join LISTA_GUARDIA_VIG_TMP lgv
                            on  lgv.idoficial = ofi.idoficial
                        left join ESTUDIANTE est
                            on est.codigo = lgv.codigoEstudiante
                    where lgv.grupo = $grupo";
    #$respuestaTabla = mysqli_query($conn,$consultaTabla);
    */
    
    
    #-------------------------------------------------
    
    $consultaTabla = "select lgv.grupo,lgv.cargo,ofi.idoficial as codigo,lgv.grado, concat(ofi.nombre ,' ', ofi.apellido ) as nombre,lgv.fecha
                        from OFICIAL ofi 
                           inner join LISTA_GUARDIA_VIG_TMP lgv
                           on  lgv.idoficial = ofi.idoficial
                        where lgv.codigoEstudiante = '0'";
    
    $respuestaTablaHeader = mysqli_query($conn,$consultaTabla);
    
    $consultaTabla = "select lgv.grupo,lgv.cargo,lgv.grado , est.codigo,concat(est.apellido_pat,' ',est.apellido_mat,' ', est.nombre) as nombre, est.semestre, est.carrera, lgv.fecha
                            from  LISTA_GUARDIA_VIG_TMP lgv
                               inner join ESTUDIANTE est
                               on est.codigo = lgv.codigoEstudiante";
    
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
    $tabla .= "</table><script>$('#btnCrearLista').attr('disabled',false);</script>";
    
    #-------------------------------------------------
    
    
    echo $tabla;
}else{
    echo "Ocurrio un error, fecha invalida. Intentelo de nuevo con otra fecha<script>$('#btnCrearLista').attr('disabled',true);</script>";
}



function validateDate($fechaGuardia,$conn){
    
    $varCambio = "call validateDate('$fechaGuardia',@respuesta)";
    $query = mysqli_query($conn,$varCambio);
    $dato = "select @respuesta as respuesta";
    $respuesta = mysqli_fetch_array(mysqli_query($conn,$dato));
    
   
    return $respuesta["respuesta"];
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

function getEstudiantes($est){
    $respuesta = array();
    for($i = 0;$i < count($est);$i++){
           if(isset($est[$i])){
              $respuesta[] = $est[$i];
           }
        
    }

    $respuesta = implode("', '",$respuesta);
    return $respuesta;
}
?>