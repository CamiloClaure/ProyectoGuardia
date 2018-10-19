<?php
session_start();



 echo ' <form class="formPermisoAlex" method="post" enctype="multipart/form-data" action="codigo.php" >
     <h2 class="formularioH">Formulario</h2>

     <input class="miInput" type="text" name="Nombre" placeholder="nombre">
     <input class="miInput" type="text" name="codigo" placeholder="Codigo">
      <input class="miInput" type="text" name="nombredecambio" placeholder="nombre del estudiante de cambio">
        <input class="miInput" type="text" name="codigocam" placeholder="Codigo del estudiante de cambio">
     <h3>Fecha de guardia actual</h3>
     <input class="miInput" type="date" name="Fecha" >
     <h3>Fecha de cambio de guardia</h3>
     <input class="miInput" type="date" name="Fechacambio" >
     <textarea class="miInput" name="mensaje" placeholder="Explique su motivo del cambio de guardia"></textarea>
     <input class="miInput" type="file" name="archivo" value="Archivo">

     <input class="miInput" type="submit" name="enviar" id="boton" value="Enviar" >
   </form>'
?>
