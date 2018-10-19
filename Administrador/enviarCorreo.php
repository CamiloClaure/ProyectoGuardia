<?php

// $destino = $_POST["correo"];
// $fecha = $_POST["fecha"];
#$contenido = $_POST["contenido"];
//enviarCorreo($destino,$fecha);
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