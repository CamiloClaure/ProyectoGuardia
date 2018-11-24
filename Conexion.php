<?php

$conn = new mysqli("127.0.0.1:3306", "camillus", "camillus", "dbGuardia");
$conn->set_charset("utf8");
    if($conn){
      //  echo "correcto";
    }else{
        echo "incorrecto";
        die( print_r( sqlsrv_errors(), true));
    }


?>
