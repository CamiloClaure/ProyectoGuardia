<?php
session_start();
try {
$user = $_SESSION['usuario'];
require_once("../Conexion.php");
$pass = $_SESSION['pass'];
$resultado;

$str1Consulta = "select fecha  from LISTA_GUARDIA_VIG where codigoEstudiante='$pass' ";
$consulta1= mysqli_query( $conn, $str1Consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
$datos = mysqli_fetch_array($consulta1);
$fecha = explode(" ",$datos["fecha"]);
$fecha =new DateTime($fecha[0]);
$fecha = $fecha->format ('Y-m-d');


} catch (Exception $e) {
    session_destroy();
    header('Location: ..\index.html');

}?>

<!DOCTYPE html>
<html>
<head>
    <title> Estudiante </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\Estilos\estiloEstudiantes.css">
    <link rel="shortcut icon" type="image/x-icon" href="..\Imagenes\iconoEmi.ico">
    <link rel="stylesheet" type="text/css" href="../Estilos/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Estilos/css/fullcalendar.css">
    <script src="../Estilos/js/jquery.min.js"></script>
    <script  src="../Estilos/js/moment.min.js"></script>

    <script src="..\Estilos\bootstrap\js\bootstrap.min.js"></script>
    <script  src="../Estilos/js/fullcalendar.js"></script>
    <script src="../Estilos/js/es.js"></script>
    <script src="Acciones.js"></script>
     <link rel="stylesheet" type="text/css" href="../Estilos/estilopermiso.css"><!-- Recientemente agregado -->
</head>
<body id="bodyEstudiante" onload="cargarLista();">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-start" >
        <div class="container-fluid" id="fBack">
            <img src="../Imagenes/logo20.png" id="pageLogo">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Solicitud" href="#">Solicitudes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cartas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="imprimir();">Imprimir</a>
                    </li>
                    <li class="nav-item">
                        <h5 class="nav-link"><?php echo $fecha[0];?></h5>
                    </li>

                </ul>
                <div class="bg-dark  "><a class="nav-link" id="salir" href="#">Salir</a></div>
            </div>
        </div>
    </nav>

    <hr>

    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-2" id="menuLateralIz">
                <div class="card border-dark " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <div class="card-header text-white bg-dark" >Opciones</div>
                  <div class="card-body p-0">

                   <div class="nav flex-column nav-pills text-white  bg-secondary " id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <a class="nav-link text-white active" id="v-pills-inicio-tab" data-toggle="pill" href="#v-pills-inicio" role="tab" aria-controls="v-pills-inicio" aria-selected="true">Listas</a>
      <a class="nav-link text-white" id="v-pills-seguridad-tab" data-toggle="pill" href="#v-pills-seguridad" role="tab" aria-controls="v-pills-seguridad" aria-selected="false">Seguridad</a>
      <a class="nav-link text-white" id="v-pills-chat-tab" data-toggle="pill" href="#v-pills-chat" role="tab" aria-controls="v-pills-chat" aria-selected="false">Formulario</a>
      <a class="nav-link text-white" id="v-pills-otros-tab" data-toggle="pill" href="#v-pills-otros" role="tab" aria-controls="v-pills-otros" aria-selected="false">Otros</a>
    </div>
                  </div>
              </div>

          </div>
          <div class="col-xs-12 col-sm-6 col-md-7" id="contenedorCentral">
            <div class="tab-content " id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-inicio" role="tabpanel" aria-labelledby="v-pills-inicio-tab">
        <!-- primera tab -->
            <h1 style="vertical-align: middle;">Listas de guardia</h1>
            <hr>
            <h3>Las listas son las siguientes</h3>
            <div id="calendarioWeb" style="vertical-align: middle;">

            </div>
            <!-- fin de la primera tab --></div>
      <div class="tab-pane fade" id="v-pills-seguridad" role="tabpanel" aria-labelledby="v-pills-seguridad-tab">

        <!-- Comienzo del cambio de contrasenha
        action="cambioPass.php" 
         
            -->
        <form class="needs-validation" id="validar"  method="POST">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom00">Codigo</label>
      <input type="input" class="form-control cajaInput" id="validationCustom00" placeholder="Codigo" required name="user">

    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">Contraseña actual</label>
      <input type="password" class="form-control cajaInput" id="validationCustom01" placeholder="Contraseña actual" required name="passwd">

    </div>
  </div>

  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="nuevaPass">Contraseña nueva</label>
      <input type="password" class="form-control cajaInput" id="nuevaPass" placeholder="Contraseña nueva" required name="newPass">
      <div class="invalid-tooltip">
        La contraseña debe ser de 7 caracteres o mas.
      </div>
    </div>

    <div class="col-md-6 mb-3">
      <label for="confirmPass">Confirmar contraseña</label>
      <input type="password" class="form-control cajaInput" id="confirmPass" placeholder="Confirmar contraseña" required name="requiredPass">
      <div class="invalid-tooltip">
        Las contraseñas no coinciden.
      </div>
    </div>
  </div>

  <button class="btn btn-primary" id="btnValidar" disabled type="button">Cambiar</button>
  <div id="respuestaPass"></div>
</form>

      </div>
      <div class="tab-pane fade" id="v-pills-chat" role="tabpanel" aria-labelledby="v-pills-chat-tab">
      <!-- Comienzo del formulario de Permisos -->

      <form class="formPermisoAlex" method="post" enctype="multipart/form-data" action="codigo.php" >
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
        </form>

        <!-- Fin del formulario -->

      </div>
      <div class="tab-pane fade" id="v-pills-otros" role="tabpanel" aria-labelledby="v-pills-otros-tab">Insertar alguna opcion aqui</div>
    </div>

        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div id="Calendario"></div>
        </div>

    </div>
</div>

<script>
     $(document).ready(function(){
         $('#Calendario').fullCalendar({
             header:{
                 left:'today,prev,next',
                 center:'title',
                 right:'month,basicWeek,basicDay,agendaWeek,agendaDay'
             },
             //custombuttons:{
               //  Miboton:{
                 ////  click:function(){
                     //    alert("Accion del boton");
                     //}
                 //}
             //},
             //dayClick:function(date,jsEvent,view){
               //  alert("Valor seleccionado:"+date.format());
                 //alert("Vista actual"+view.name);-
                 //$(this).css('background-color','red');
             //}
         });
     })   
        $fechajs = '<?php echo $fecha;?>';
        $('#Calendario').fullCalendar({
            defaultDate:'2018-09-17',
            events: [
                {
                    titleFormat: '\'Hello, World!\'', 
                    center:'Guardiola',
                    start: $fechajs,
                    end: $fechajs,
                    overlap: false,
                    rendering: 'background',
                    color: 'black'
                }
            ]
        });
function imprimir(){
window.print();
}
    
   
      document.getElementById("btnValidar").addEventListener('click',function(){
        var url = "cambioPass.php";                                      

        $.ajax({                        
           type: "POST",                 
           url: url,                    
           data: $("#validar").serialize(),
           success: function(data)            
           {
             $('#respuestaPass').html(data);           
           }
         });
      });
    
</script>

<div id="modalNewStd" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mostrar Estudiantes</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">

              <div class="row">
                 <div class="col-sm-12" id="tempEst"></div>
                 


                 </div>
             </div>
         </div>
     </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
</div>
</div>

<script>//Para cambio de password
var validado = false;
var confirmado = false;
var formulario = document.getElementById('validar');
    
document.getElementById('nuevaPass').addEventListener('keyup',function(){
  if (document.getElementById('nuevaPass').value.length < 7) {
    //form.classList.add('was-validated');
    document.getElementById('nuevaPass').classList.add('is-invalid');
       validado = false;
    validar(validado,confirmado);
     
}
else{
  document.getElementById('nuevaPass').classList.remove('is-invalid');
  document.getElementById('nuevaPass').classList.add('is-valid');
    validado = true;
   validar(validado,confirmado);
}
});
document.getElementById('confirmPass').addEventListener('keyup',function(){
  if (document.getElementById('confirmPass').value != document.getElementById('nuevaPass').value) {
    //form.classList.add('was-validated');
    document.getElementById('confirmPass').classList.add('is-invalid');
      confirmado = false;
      validar(validado,confirmado);
     
     
}
else{
  document.getElementById('confirmPass').classList.remove('is-invalid');
  document.getElementById('confirmPass').classList.add('is-valid');
    confirmado = true; 
    validar(validado,confirmado);
    
}
});
function validar(valid, confirm){
    

   if(valid && confirm){
       $('#btnValidar').attr('disabled',false);
      }else{
         $('#btnValidar').attr('disabled',true);
      }

    }
// Fin del cambio de password</script>
</body>
</html>
