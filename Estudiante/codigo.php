 <?php

 require_once('../Conexion.php');


 if(!empty($_POST)){
  if($_FILES['archivo']['name']<>"")
  {
   require_once('../Libreria/class.upload.php-master/src/class.upload.php');
   $handle = new upload($_FILES['archivo']);
   $nn=date('d_m_Y_H_i_s_').rand();
   if ($handle->uploaded) {
    $handle->file_new_name_body   = $_POST['codigo'];
    $handle->image_resize         = false;
    $handle->image_x              = 100;
    $handle->image_ratio_y        = true;
    $handle->process('ArchivosPermiso/');

    $nombreest=$_POST["Nombre"];
    $codigoest=$_POST["codigo"];
    $fechaguard=$_POST["Fecha"];
    $fechacambio=$_POST["Fechacambio"];
    $mensaje=$_POST["mensaje"];
    $band=0;
    $nombrecam=$_POST["nombredecambio"];
    $codigcam=$_POST["codigocam"];
    $insertar= "insert into PERMISO(nombre,fechadelaguard,fechadelcamb,comentario,bandera_permiso,nombre_cam,codig_cam,documento,codigoEST)
    values (?,?,?,?,?,?,?,?,?)";

    $valores = array($nombreest,$fechaguard,$fechacambio,$mensaje,$band,$nombrecam,$codigcam,$nn,$codigoest);
    $consulta = mysqli_query($conn,$insertar,$valores);
    if ($conn) {

      $handle->clean();
      echo '<script>alert("Solicitud enviada!");</script>';
      header('Location: /Estudiante/Estudiante.php');
    } else {
      echo 'error : ' . $handle->error;
    }
  }


}


}



?>
