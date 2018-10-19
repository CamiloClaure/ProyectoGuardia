<?php
require_once('../Conexion.php');

$nombre = $_POST["nombre"];
$apellidoM = $_POST["apellidoM"];
$apellidoP = $_POST["apellidoP"];
$codigo = $_POST["codigo"];
$carrera = $_POST["carrera"];
$grado = $_POST["lGrado"];
$descripcion = $_POST["descripcion"];
$semestre = $_POST["semestre"];
$celular = $_POST["celular"];
$turno = $_POST["turno"];
$genero = $_POST["genero"];
$correo = $_POST["correo"];


$consulta = "insert into OFICIAL(idoficial,nombre, apellido,apellidoM, semestre,descripcion,celular,flagGuardia,grado,correo,carrera,turno)
            values('$codigo','$nombre','$apellidoP','$apellidoM','$semestre','$descripcion','$celular',0,'$grado','$correo','$carrera','$turno')";


try{
$envio = mysqli_query($conn,$consulta);
if($envio){
    echo '<span>Registro insertado exitosamente</span>
            <script>document.getElementsByClassName("cajaInput").value="";</script>';


}else{
    echo '<script language="javascript">
        alert("No se ha insertado el registro exitosamente! $envio");
    </script>';

}
}catch(Exception $e){

}

#header('Location: Administrador.php');
?>
