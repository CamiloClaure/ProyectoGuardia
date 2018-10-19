<?php
require_once('../Conexion.php');

$nombre = $_POST["nombre"];
$apellido_pat = $_POST["apellidosP"];
$apellido_mat = $_POST["apellidosM"];
$codigo = $_POST["codigo"];
$carrera = $_POST["carrera"];
$semestre = $_POST["semestre"];
$turno = $_POST["turno"];
$genero = $_POST["genero"];
$cargo = $_POST["cargo"];

$sem = $semestre[0];

$consulta = "insert into ESTUDIANTE(codigo, nombre, apellido_pat, apellido_mat,semestre, carrera, turno, genero, cargo,passwd,flagGuardia,telefono)
            values('$codigo','$nombre','$apellido_pat','$apellido_mat',$sem,'$carrera','$turno','$genero','$cargo','$codigo',0,'-')";


$envio = mysqli_query($conn,$consulta);
try{
if($envio){
    echo '<span>Registro insertado exitosamente</span>
            <script>document.getElementsByClassName("cajaInput").value="";</script>';


}else{
    echo '<script language="javascript">
        alert("No se ha insertado el registro exitosamente! '.$envio.'");
    </script>';

}
}catch(Exception $e){

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
#header('Location: Administrador.php');
?>
