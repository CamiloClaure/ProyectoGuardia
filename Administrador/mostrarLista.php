<?php
session_start();
require_once('../Conexion.php');
$consulta = "select concat(ofi.apellido,' ',ofi.nombre) as 'oficial',grupo,fecha,cantidad_permisos,cargo
from LISTA_GUARDIA lg
inner join OFICIAL ofi
on ofi.idoficial = lg.oficial
where cargo = 'Cap. de servicio' and borrado = 0";
$respuesta = mysqli_query($conn,$consulta);
$salida = "";
$id = 1;
if($respuesta){
     $salida = '<table id="ListaG" class="table table-striped table-responsive">
    <tr><th>Grupo</th>
    <th>Capitan de servicio</th>
    <th>Cargo</th>
    <th>Fecha</th>
    <th>Cantidad Permisos</th>
    <th>Acciones</th></tr>';

while($datos = mysqli_fetch_array($respuesta)){
    $salida .=  '<tr>
                   <td><input type="hidden" name=grupo id="grupo'.$id.'" value="'.$datos['grupo'].'">'.$datos['grupo'].'
                   </td>
                    <td>
                        <input type="hidden" name=grupo class="cap'.$id.'" value="'.$datos['oficial'].'">'.$datos['oficial'].'
                    </td>
                    <td>
                        <input type="hidden" name=grupo class="jefe'.$id.'" value="'.$datos['cargo'].'">'.$datos['cargo'].'
                    </td>
                    <td>
                        <input type="hidden" name=grupo class="fecha'.$id.'" value="'.$datos['fecha'].'">'.$datos['fecha'].'
                    </td>
                    <td>
                        <input type="hidden" name=grupo class="per'.$id.'" value="'.$datos['cantidad_permisos'].'">'. $datos['cantidad_permisos'].'
                    </td>
                    <td>   
                        <button name="'.$datos['grupo'].'" class="btn btn-sm btn-info btn-show p-0 visualizar" data-toggle="modal" data-target="#modalNewStd" alt="Mostrar"><img class="blanco" fill="none" name="'.$datos['grupo'].'" src="../Imagenes/svgMostrar.png" alt="Mostrar lista"/></button>
                        <button name="'.$datos['grupo'].'" class="btn btn-sm btn-info btn-show p-0" data-toggle="modal" data-target="#editarLista"><img class="modificarLista blanco" fill="none" name="'.$datos['grupo'].'" src="../Imagenes/svgEditarPNG.png" alt="Editar lista"/></button>
                        <button name="'.$datos['grupo'].'" class="btn btn-sm btn-info p-0"><img class="borrar blanco"  value="'.$datos['grupo'].'" name="'.$datos['grupo'].'" fill="none" src="../Imagenes/svgEliminar.png" alt="Eliminar lista"/></button>
                    </td>

        </tr>';
    $id += 1;
}
    $salida .= '</table>';

}
echo $salida;
?>
