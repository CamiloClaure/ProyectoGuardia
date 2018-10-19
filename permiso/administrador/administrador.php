<?php
session_start();
?>

<!DOCTYPE html>
<html  onload="ocultar()">
<head>
	<title> Estudiante </title>
    <link rel="stylesheet" type="text/css" href="..\Estilos\estiloEstudiantes.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    

    <!--<link rel="stylesheet" href="../Estilos/estiloAdmin.css">-->
  <link rel="shortcut icon" type="image/x-icon" href="..\Imagenes\iconoEmi.ico">
</head>
<body id="bodyEstudiante">
	<header>
    <div id="divHeader"><img id="imgDiv" src="..\Imagenes\logo500.png" width="20%" height="20%">
      <h3 id="encabezadoUsuario"><?php echo $_SESSION['usuario'];?></h3>
     
    </div>
  </header>
  
  <hr>
  <center>
    <div class="barra">
     <ul>
      <li onclick="insertar()">Lista Guardia</li>
      <li >             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Solicitudes
</button>  </li>
      <li onclick="pruebaAjax('Insertar.html',mostrarMenu)">Administrar estudiantes</li>
      <li>Crear lista</li>
      </ul>
        

 
  </div>
  <br>
  <hr>
 
</center>

    
    

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Permisos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 <?php

$serverName = "LAPTOP-RV8CGFPK\SQLEXPRESS"; //serverName\instanceName
$connectionInfo = array( "Database"=>"dbguardia", "UID"=>"Alexander", "PWD"=>"1049284");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if($conn){
	echo "<script>alert('Formulario enviado correctamente');</script>"; 
}
else
{
echo"no se pudo conectar";
}
?>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Codigo:</span>
  </div>
    <input type="text" id="sucodigo" name="sucodigo" class="form-control" placeholder="Introduzca el codigo del estudiante que sera aceptado su cambio" aria-label="Username" aria-describedby="basic-addon1">
</div>
          <table class="table">
  <thead class="thead-blue">
    <tr>
<!--      <th scope="col">#</th>-->
      <th scope="col">Nombre</th>
      <th scope="col">Codigo</th>
      <th scope="col">Fecha de guardia</th>
      <th scope="col">Fecha de cambio de guardia</th>
      <th scope="col">Comentario</th>
      <th scope="col">Nombre cambio</th>
      <th scope="col">Codigo cambio </th>
    </tr>
  </thead>
  <tbody id="tablaYeic">
      <?php
          $insertar = "SELECT nombre,codigopermiso,fechadeguard,fechadecamb,comentario,nombre_cam,codig_cam FROM PERMISO where banderapermiso=0"; 
          $consulta = sqlsrv_query($conn,$insertar);
  if($consulta){        
           while($rs=sqlsrv_fetch_array($consulta)) 
  { 
    echo '<tr>' 
           .'<td>'.$rs['nombre'].'</td>' 
           .'<td>'.$rs['codigopermiso'].'</td>'
           .'<td>'.$rs['fechadeguard'].'</td>' 
           .'<td>'.$rs['fechadecamb'].'</td>' 
           .'<td>'.$rs['comentario'].'</td>' 
         .'<td>'.$rs['nombre_cam'].'</td>' 
         .'<td>'.$rs['codig_cam'].'</td>' 
        
           .'</tr>'; 
  }}
          ?>

  </tbody>
</table>
          
          

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="pruebaAjax()">Aceptar el cambio </button>
      </div>
    </div>
  </div>
</div>
      <!-- Modal -->
    
    
<div id="na"></div>
<script type="text/javascript">
          function pruebaAjax(str){
              var sucod = document.getElementById("sucodigo").value;
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          document.getElementById("tablaYeic").innerHTML=this.responseText;
          
          }
           };
          xhttp.open("GET", "change.php?cod="+sucod, true);
          xhttp.send();
        }
       
</script>
<!--<script src="inicioSesion.js"></script>-->
     
</body>
</html>
