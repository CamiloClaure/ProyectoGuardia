<?php
require_once('../Conexion.php');
$getLista = "select lgv.idoficial,lgv.codigoEstudiante  , ofi.correo as 'correoOf', est.correo as 'correoEst', lgv.fecha
from OFICIAL ofi 
    right join LISTA_GUARDIA_VIG lgv
        on  lgv.idoficial = ofi.idoficial
    left join ESTUDIANTE est
        on est.codigo = lgv.codigoEstudiante
        where correo_enviado = 'pendiente'";
$execConsulta = mysqli_query($conn,$getLista);
while($datos = mysqli_fetch_array($execConsulta)){
    if($datos["correoEst"] != "-" && $datos["codigoEstudiante"] != '0'){
        enviarCorreo($datos["correoEst"],$datos["fecha"]);
        $codigo = $datos["codigoEstudiante"];
        echo $codigo;
        $update = "update LISTA_GUARDIA_VIG
                    set correo_enviado = 'enviado'
                    where codigoEstudiante = '$codigo'";
        $consultaUpdate = mysqli_query($conn,$update);                   
    }elseif($datos["correoOf"] != "-" && $datos["idoficial"] != '0'){
        enviarCorreo($datos["correoOf"],$datos["fecha"]);
        $codigo = $datos["idoficial"];
        $update = "update LISTA_GUARDIA_VIG
                    set correo_enviado = 'enviado'
                    where idoficial = '$codigo'";
        $consultaUpdate = mysqli_query($conn,$update);   
    }
}

function enviarCorreo($destino,$fecha){
    $mail = "Se le comunica a ud. que se encuentra de guardia el ".$fecha.". Por lo tanto se le recomienda tomar en cuenta para prever perdida de puntaje";
    
    $titulo = "Aviso Guardia";
    
    $headers = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
    
    $headers .= "From: SIGUEMI $destino\r\n";
    
    $bool = mail($destino,$titulo,$mail,$headers);
    if($bool){
        echo "Mensaje enviado";
    }else{
        echo "Mensaje no enviado";
    }
}
?>