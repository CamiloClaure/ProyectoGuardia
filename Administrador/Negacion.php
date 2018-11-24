<?php
  $sucodigo = $_REQUEST["cod"];
  require_once('../Conexion.php');
$respuesta ="";
      if(7 >=7||$sucodigo!="")
      {

        $insertar = "update PERMISOS
                    SET bandera_permiso = 2
                 WHERE codigoEst = '$sucodigo'";

        $consulta = mysqli_query($conn,$insertar);


          $insertar2 = "select nombre,codigoEst,fechadelaguard,fechadelcamb,comentario,nombre_cam,codig_cam FROM PERMISOS where bandera_permiso=0";
          $consulta = mysqli_query($conn,$insertar2);
  if($consulta){
           while($rs=mysqli_fetch_array($consulta))
  {
    $respuesta = '<tr>'
          .'<td>'.$rs['nombre'].'</td>'
           .'<td>'.$rs['codigoEst'].'</td>'
           .'<td>'.$rs['fechadelaguard'].'</td>'
           .'<td>'.$rs['fechadelcamb'].'</td>'
           .'<td>'.$rs['comentario'].'</td>'
         .'<td>'.$rs['nombre_cam'].'</td>'
         .'<td>'.$rs['codig_cam'].'</td>'
           .'</tr>';
  }}




      }

echo $respuesta;

?>
