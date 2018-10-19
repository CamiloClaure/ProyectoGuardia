<?php
  $sucodigo = $_REQUEST["cod"];
$respuesta ="";
      if(7 >=7||$sucodigo!="")
      {
         $serverName = "LAPTOP-RV8CGFPK\SQLEXPRESS"; //serverName\instanceName
        $connectionInfo = array( "Database"=>"dbguardia", "UID"=>"Alexander", "PWD"=>"1049284"); 
        $conn = sqlsrv_connect( $serverName, $connectionInfo); 
        $insertar = "UPDATE PERMISO
                    SET banderapermiso = 1
                 WHERE codigopermiso = '$sucodigo'"; 
        $consulta = sqlsrv_query($conn,$insertar);
          
          
          $insertar2 = "SELECT nombre,codigopermiso,fechadeguard,fechadecamb,comentario,nombre_cam,codig_cam FROM PERMISO where banderapermiso=0"; 
          $consulta = sqlsrv_query($conn,$insertar2);
  if($consulta){        
           while($rs=sqlsrv_fetch_array($consulta)) 
  { 
    $respuesta = '<tr>' 
           .'<td>'.$rs['nombre'].'</td>' 
           .'<td>'.$rs['codigopermiso'].'</td>'
           .'<td>'.$rs['fechadeguard'].'</td>' 
           .'<td>'.$rs['fechadecamb'].'</td>' 
           .'<td>'.$rs['comentario'].'</td>' 
         .'<td>'.$rs['nombre_cam'].'</td>' 
         .'<td>'.$rs['codig_cam'].'</td>' 
        
           .'</tr>'; 
  }}
          
          
          
          
      }

echo $respuesta;
 
?>