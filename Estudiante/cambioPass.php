<?php
require_once('../Conexion.php');

$usuario = $_POST["user"];
$passwd = $_POST["passwd"];
$newPasswd = $_POST["newPass"];
$reqPass = $_POST["requiredPass"];


if($reqPass === $newPasswd){
    
    if(validar($conn,$usuario,$passwd,$newPasswd)){
        #el usuario existe en la base de datos
        if(realizarCambio($usuario,$newPasswd,$conn)){
            echo '<span>Cambio exitoso</span>
             <script>document.getElementsByClassName("cajaInput").value="";</script>';
            //header('Location: Estudiante.php');
        }else{
            echo "else";
        }
    }else{
        echo "incorrecto";
    
    }

    
}else{#caso que de alguna manera se haya saltado la validacion de js
    echo "estamos aca?" .$passwd;
}

function validar($conn,$user,$passwd,$newPasswd){
    $consulta = "call validarPass('$user','$passwd',@respuesta)";
    $query = mysqli_query($conn,$consulta);
    $dato = "select @respuesta as respuesta";
    $respuesta = mysqli_fetch_array(mysqli_query($conn,$dato));
    return $respuesta["respuesta"];
}
function realizarCambio($codigo, $newPassword, $conn){
    $varCambio = "call setPassword('$codigo','$newPassword',@respuesta)";
    $query = mysqli_query($conn,$varCambio);
    $dato = "select @respuesta as respuesta";
    $respuesta = mysqli_fetch_array(mysqli_query($conn,$dato));
    return $respuesta["respuesta"];
}
?>