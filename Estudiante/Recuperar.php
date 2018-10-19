
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="..\Estilos\estiloEstudiantes.css" />

</head>
<body id="bodyTabla">
<?php
require_once('../Conexion.php');
$consulta = "select * from ESTUDIANTE";

$respuesta = mysqli_query($conn,$consulta);
$nro = 1;
if($respuesta){
   echo '<table id="tablaLoquilla">
    <tr><th>Nro</th>
    <th>CODIGO  </th>
    <th>SEMESTRE</th>
    <th>APELLIDOS</th>
    <th>NOMBRES</th>
    <th>OBS</th></tr>';



    while($datos = mysqli_fetch_array($respuesta)){
        echo '<tr><td>'.$nro.'</td>
        <td>'.$datos['codigo'].'</td>
        <td>'.$datos['semestre'].'°</td>
        <td>'.$datos['apellido'].'</td>
        <td>'.$datos['nombre'].'</td>
        <td>'. 'N/A'.'</td></tr>';
        $nro = $nro +  1;
    }
    echo '</table>';
}
?>
</body>
</html>
