<?php
session_start();
?>
<!DOCTYPE html>

<html>
<head>
  <title>Permisos</title>
  <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="../../Estilos/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../Estilos/estiloEstudiantes.css">

        <link rel="shortcut icon" type="image/x-icon" href="../../Imagenes/iconoEmi.ico">
  <link rel="stylesheet" type="text/css" href="../../Estilos/estilopermiso.css">
</head>

<body>
  <header>
            <div id="divHeader"><img id="imgDiv" src="../../Imagenes/logo500.png" width="20%" height="20%">
                <h3 id="encabezadoUsuario"><?php echo $_SESSION['usuario'];?></h3>

            </div>
        </header>

        <hr>
        <center>
            <div class="barra">
                <ul>
                    <li onclick="holamundo()">Lista Guardia</li>
                    <li>Asistencia</li>
                    <li><a class="btn  btn-primary btn-sm" href="">Solicitudes</a></li>
                    <li>Cartas</li>
                </ul>
            </div>
            <br>
            <hr>
        </center>
  <form class="formPermisoAlex" method="post" enctype="multipart/form-data" action="codigo.php" >
    <h2>Formulario</h2>

    <input type="text" name="Nombre" placeholder="nombre">
    <input type="text" name="codigo" placeholder="Codigo">
     <input type="text" name="nombredecambio" placeholder="nombre del estudiante de cambio">
       <input type="text" name="codigocam" placeholder="Codigo del estudiante de cambio">
    <h3>Fecha de guardia actual</h3>
    <input type="date" name="Fecha" >
    <h3>Fecha de cambio de guardia</h3>
    <input type="date" name="Fechacambio" >
    <textarea name="mensaje" placeholder="Explique su motivo del cambio de guardia"></textarea>
    <input type="file" name="archivo" value="Archivo">

    <input type="submit" name="enviar" id="boton" value="Enviar" >
  </form>
  <footer>

  </footer>
</body>
</html>
