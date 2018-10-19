<?php
require_once('../Conexion.php');

$grupo = $_POST["grupo"];
$codigoJefe = $_POST["codjefe"];
$codigoCap = $_POST["codCap"];
$fecha = $_POST["fecha"];

$insertaHeaderLista = "insert into LISTA_GUARDIA(OPERACIONES_idAdministrador, grupo, capitan_serv,jefeRonda,fecha,cantidad_permisos)
						values (123,'$grupo','$codigoCap','$codigoJefe','$fecha','0')";
#$Valores = array($grupo,$codigoCap,$codigoJefe,$fecha,0);
$envio = mysqli_query($conn,$insertaHeaderLista);

$insertaCap = "insert into LISTA_GUARDIA_VIG(grupo,idoficial,fecha,flagPermiso)	values ('$grupo','$codigoCap','$fecha','0')";
#$ValoresCap = array($grupo,$codigoCap,$fecha,0);
$envioCap = mysqli_query($conn,$insertaCap);

$insertaJefe = "insert into LISTA_GUARDIA_VIG(grupo,idoficial,fecha,flagPermiso) values ('$grupo','$codigoJefe','$fecha','0')";
#$ValoresJefe = array($grupo,$codigoJefe,$fecha,0);
$envioss = mysqli_query($conn,$insertaJefe);


	$consultaMananaH = "select  codigo
					from ESTUDIANTE
					where flagGuardia = 0 and genero = 'Masculino' and turno = 'mañana' limit 10";



	$consultaTardeH = "select codigo
					from ESTUDIANTE
					where flagGuardia = 0 and genero = 'Masculino' and turno = 'tarde' limit 10";




	$consultaMananaM = "select codigo
					from ESTUDIANTE
					where flagGuardia = 0 and genero = 'Femenino' and turno = 'mañana' limit 5";




	$consultaTardeM = "select codigo
					from ESTUDIANTE
					where flagGuardia = 0 and genero = 'Femenino' and turno = 'tarde' limit 5";


$envioHM = mysqli_query($conn,$consultaMananaH);
$envioHT = mysqli_query($conn,$consultaTardeH);
$envioMM = mysqli_query($conn,$consultaMananaM);
$envioMT = mysqli_query($conn,$consultaTardeM);


if($envioHM){

	while($tmpData = mysqli_fetch_array($envioHM)){
			insertarEstudiantes($grupo,$tmpData['codigo'],$fecha,0,$conn);
			updateEstudiantes($tmpData['codigo'],$conn);
	}
}

if($envioHT){
	while($tmpData = mysqli_fetch_array($envioHT)){
			insertarEstudiantes($grupo,$tmpData['codigo'],$fecha,0,$conn);
			updateEstudiantes($tmpData['codigo'],$conn);
	}
}

if($envioMM){
	while($tmpData = mysqli_fetch_array($envioMM)){

		insertarEstudiantes($grupo,$tmpData['codigo'],$fecha,0,$conn);
		updateEstudiantes($tmpData['codigo'],$conn);

	}
}

if($envioMT){
	while($tmpData = mysqli_fetch_array($envioMT)){
		insertarEstudiantes($grupo,$tmpData['codigo'],$fecha,0,$conn);
		updateEstudiantes($tmpData['codigo'],$conn);
	}
}
concretarUpdate($conn);
	echo "Lista creada exitosamente";
function insertarEstudiantes($grupo,$tmpData,$fecha, $flagPermiso,$conn){
	$consultaFast = "insert into LISTA_GUARDIA_VIG(grupo,codigoEstudiante,fecha,flagPermiso)
					values ('$grupo','$tmpData','$fecha', '$flagPermiso')";

	mysqli_query($conn,$consultaFast);
}
function updateEstudiantes($codigo,$conn){
	$consulta = "insert into ESTUDIANTE_TMP(codigo)
	            values('$codigo')";
	mysqli_query($conn,$consulta);
}
function concretarUpdate($conn){
	$consulta = "update ESTUDIANTE
join ESTUDIANTE_TMP tmp ON ESTUDIANTE.codigo = tmp.codigo
set ESTUDIANTE.flagGuardia = 1";

	mysqli_query($conn,$consulta);
	$consulta = "delete
	from ESTUDIANTE_TMP";
	mysqli_query($conn,$consulta);
}

?>
