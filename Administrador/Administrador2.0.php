<?php
session_start();
require_once('../Conexion.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Administrador</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="..\Imagenes\iconoEmi.ico">
        <link rel="stylesheet" href="../Estilos/estiloAdmin.css">
        <link rel="stylesheet" href="../Estilos/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="..\Estilos\estiloEstudiantes.css">
        <!----------------------- Estilo Selectmultiple ------------------------>
        <link rel="stylesheet" href="../Estilos/EstiloSelect/bootstrap-select.min.css">
        

        <script src="../Estilos/EstiloSelect/jquery.min.js"></script>
        <script src="../Estilos/js/bootbox.min.js"></script>
       

        <script src="../Estilos/EstiloSelect/bootstrap.bundle.min.js"></script>
        <!------------------------------------------------------------------>
        <script src="../Estilos/bootstrap-select-1.13.1/dist/js/bootstrap-select.min.js"></script>

        <!-- 
        <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.3.3/dist/semantic.min.js"></script>-->


    </head>
    <body onload="cargarLista();">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <img src="../Imagenes/logo20.png" id="pageLogo">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">Solicitudes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gestionar personal
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Oficiales Superiores</a>
                            <a class="dropdown-item" href="#">Oficiales Subalternos</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Estudiantes</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <h5 class="nav-link"><?php echo $_SESSION['usuario'];?></h5>
                    </li>
                </ul>
            </div>
        </nav>
        <hr>
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-2 sidenav" id="menuLateralIz">
                    <div class="well">
                        <h3>Funciones lista guardia</h3>
                    </div>
                    <!--<div class="well">
                        <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#NuevaLista">Agregar lista</button>
                    </div>-->
                    <div class="card border-dark " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <div class="card-header text-white bg-dark" >Opciones</div>
                        <div class="card-body p-0">

                           <div class="nav flex-column nav-pills text-white  bg-secondary " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                              <a class="nav-link text-white active" id="v-pills-inicio-tab" data-toggle="pill" href="#v-pills-inicio" role="tab" aria-controls="v-pills-inicio" aria-selected="true">Listas</a>
                              <a class="nav-link text-white" id="v-pills-nuevaLista-tab" data-toggle="pill" href="#v-pills-nuevaLista" role="tab" aria-controls="v-pills-nuevaLista" aria-selected="false">Nueva lista</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-6 col-md-7" id="contenedorCentral">
                    <div class="tab-content " id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-inicio" role="tabpanel" aria-labelledby="v-pills-inicio-tab">

                            <h1 style="vertical-align: middle;">Listas de guardia</h1>

                            <hr>
                            <h3>Las listas son las siguientes</h3>
                            <div id="tabla" ></div>

                        </div>
                        <div class="tab-pane fade" id="v-pills-nuevaLista" role="tabpanel" aria-labelledby="v-pills-nuevaLista-tab">
                            <h4>Nueva lista de guardia</h4>
                            <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-bodyLista-tab" data-toggle="pill" href="#v-pills-bodyLista" role="tab" aria-controls="v-pills-bodyLista" aria-selected="false">Alumnos</a>
                                <a class="nav-link" id="v-pills-headerLista-tab" data-toggle="pill" href="#v-pills-headerLista" role="tab" aria-controls="v-pills-headerLista" aria-selected="true">Oficiales</a>
                            </div>
                        
                        <div class="tab-content">
                            <!-- Detalle de lista de guardia -->
                           
                            <div class="tab-pane fade show active" id="v-pills-bodyLista" role="tabpanel" aria-labelledby="v-pills-bodyLista-tab">
                                Detalle de la lista de guardia
                                   <form action="getCurso.php" id="frmgetCurso">
                                <div class="row">
                                       
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lSemestre">Semestre</span>
                                </div>
                                <div name="semestre" placeholder="semestre" class="form-control"  aria-label="Semestre" aria-describedby="lSemestre">

                                <select  name="semestre[]" class="selectpicker form-control form-control-sm" multiple="" id="multi-select">
                                    <option data-value="tercero">3er Semestre</option>
                                    <option data-value="cuarto">4to Semestre</option>
                                    <option data-value="quinto">5to Semestre</option>
                                    <option data-value="sexto">6to Semestre</option>
                                    <option data-value="septimo">7mo Semestre</option>
                                    <option data-value="octavo">8vo Semestre</option>
                                    <option data-value="noveno">9no Semestre</option>
                                </select>
                                 </div>

                            </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        
                                         <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lCarrera">Carrera</span>
                                </div>
                                <div name="carrera" placeholder="carrera" class="form-control"  aria-label="Carrera" aria-describedby="lCarrera">
                                <select class="selectpicker form-control form-control-sm" multiple name="carrera[]" id="exampleFormControlSelect1">
                                    <option>Ing. Sistemas</option>
                                    <option>Ing. Electronica</option>
                                    <option>Ing. Industrial</option>
                                    <option>Ing. Comercial</option>
                                    <option>Ing. Mecatronica</option>
                                    <option>Ing. Petrolera</option>
                                    <option>Ing. Civil</option>
                                    <option>Ing. Ambiental</option>
                                    <option>Ing. Agronomica</option>

                                </select>
                            </div>
                                     <input type="submit" name="btngetCurso" id="btnCurso" value="+" class="btn btn-primary">
                        </div>
                                    </div>
                                    
                                </div>
                                   </form>
                                <div id="bodyLista"></div>
                            </div>
                            
                            <!-- Fin detalle de lista de guardia -->
                            
                            <div class="tab-pane fade " id="v-pills-headerLista" role="tabpanel" aria-labelledby="v-pills-headerLista-tab">
                                <!-- Formulario tab lista de guardia -->
                                <form action="generarListaP1.php" class="mt-4" method="POST" id="formLista">

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lgrupo">Grupo estudiantes</span>
                                </div>
                                <input type="text" class="form-control" name="grupo" placeholder="grupo" aria-label="grupo" aria-describedby="lgrupo" id="igrupo" readonly>

                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lfecha">Fecha</span>
                                </div>
                                <input type="date" class="form-control"  min="<?php $hoy=date("Y-m-d"); echo $hoy;?>" name="fecha" placeholder="fecha" aria-label="fecha" aria-describedby="lfecha" id="ifecha">
                            </div>

                            <div id="select-oficiales" class="row"></div>


                            <!--<input type="submit" name="aceptar" value="Aceptar" class="btn btn-primary" id="btnLista">-->
                            <input type="submit" name="aceptar" value="Continuar" class="btn btn-primary" data-toggle="modal" data-target="#mListaAprobar">
                        </form>
                        <div id="msgCreado"></div>
                    </div>
                            
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 sidenav" id="menuLateralDer">
                    <div class="well">
                        <h3>Funciones</h3>
                    </div>
                   <div class="btn-group-vertical">

                        <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#Insertar">Agregar estudiante</button>
                        
                        <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#Modificar">Editar estudiantes</button>
                        <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#Insertarofi">Insertar Oficial</button>
                        <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#Modificarofi">Editar Oficial</button>

                   </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="modal fade" id="correo">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Correo</h4>
                        </div>
                        <div class="modal-body">
                           <form action="thread.php" method="post">
                               <input type="email" name="correo" id="email">
                               <input type="text" name="contenido" id="content">
                               <input type="date" name="fecha" id="date">
                               <input type="submit" value="send">
                           </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btnCancelarLista" data-dismiss="modal">Cancelar</button>
                            <button id="btnSendCorreo" type="button" class="btn btn-primary">Crear</button>
                    </div>
                </div>
            </div>
            </div>
        <div class="modal fade" id="mListaAprobar">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Aprobar lista</h4>
                    </div>
                    <div class="modal-body">
                       <div id="tblFinal"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnCancelarLista" data-dismiss="modal">Cancelar</button>
                        <button id="btnCrearLista" type="button" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="mListaModificar">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Aprobar modificacion de la lista</h4>
                    </div>
                    <div class="modal-body">
                       <div id="tblFinalModificarr"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btnCancelarLista" data-dismiss="modal">Cancelar</button>
                        <button id="btnModificarListar" type="button" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </div>
        </div>
        <!--MODAL INSERTAR-->
        <div id="Insertar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Insertar</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                        <form action="Insertar.php" method="POST" id="formInput">

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" name="labelnombre"
                                          id="lNombre">Nombre</span>
                                </div>
                                <input required type="text" class="form-control" name="nombre" placeholder="Nombre" aria-label="Nombre" aria-describedby="lNombre">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lApellidosP">Apellido paterno</span>
                                </div>
                                <input required type="text" class="form-control" name="apellidosP" placeholder="Apellido paterno" aria-label="ApellidosP" aria-describedby="lApellidosP">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lApellidosM">Apellido materno</span>
                                </div>
                                <input required type="text" class="form-control" name="apellidosM" placeholder="Apellido materno" aria-label="ApellidosM" aria-describedby="lApellidosM">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lCodigo">Codigo</span>
                                </div>
                                <input required type="text" class="form-control" name="codigo" placeholder="Codigo" aria-label="Codigo" aria-describedby="lCodigo">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lCarrera">Carrera</span>
                                </div>
                                <select class="form-control" name="carrera" id="exampleFormControlSelect1">
                                    <option>Ing. Sistemas</option>
                                    <option>Ing. Electronica</option>
                                    <option>Ing. Industrial</option>
                                    <option>Ing. Comercial</option>
                                    <option>Ing. Mecatronica</option>
                                    <option>Ing. Petrolera</option>
                                    <option>Ing. Civil</option>
                                    <option>Ing. Ambiental</option>
                                    <option>Ing. Agronomica</option>

                                </select>
                            </div>


                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lSemestre">Semestre</span>
                                </div>
                                <!--<input type="text" name="semestre" placeholder="semestre" class="form-control" aria-label="Semestre" aria-describedby="lSemestre">-->
                                <select class="form-control" name="semestre" id="exampleFormControlSelect1">
                                    <option>3er Semestre</option>
                                    <option>4to Semestre</option>
                                    <option>5to Semestre</option>
                                    <option>6to Semestre</option>
                                    <option>7mo Semestre</option>
                                    <option>8vo Semestre</option>
                                    <option>9no Semestre</option>
                                </select>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lTurno">Turno</span>
                                </div>
                                <select required class="form-control" name="turno" id="exampleFormControlSelect1">
                                    <option>Mañana</option>
                                    <option>Tarde</option>
                                </select>
                            </div>


                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lGenero">Género</span>
                                </div>
                                <select class="form-control" name="genero" id="exampleFormControlSelect1">
                                    <option>Femenino</option>
                                    <option>Masculino</option>
                                </select>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lCargo">Cargo</span>
                                </div>
                                <select class="form-control" name="cargo" id="exampleFormControlSelect1">
                                    <option>Numero</option>
                                    <option>Cabo</option>
                                </select>
                            </div>

                            <input type="submit" name="insertar" value="Insertar" class="btn btn-primary" id="btnEnviar">

                            <div id="resp"></div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
        <!--MODAL MODIFICAR-->
        <div id="Modificar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modificar</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                        <form action="modificarEst.php" class="needs-validation" method="POST" id="formModify">

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mlbuscar">Buscar</span>
                                </div>
                                <input requiered type="text" class="form-control" name="buscar" placeholder="Ingresar codigo" aria-label="buscar" aria-describedby="mlbuscar" onkeyup="showHint(this.value)" id="mbuscar">

                            </div>
                            <h4 id="txtSug"></h4>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mlCodigo">Codigo</span>
                                </div>
                                <input requiered type="text" class="form-control" name="codigo" placeholder="Codigo" aria-label="Codigo" aria-describedby="mlCodigo" id="mcodigo">

                            </div>


                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mlNombre">Nombre</span>
                                </div>
                                <input requiered type="text" class="form-control" name="nombre" placeholder="Nombre" aria-label="Nombre" aria-describedby="mlNombre" id="mnombre">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mlApellidos">Apellidos</span>
                                </div>
                                <input requiered type="text" class="form-control" name="apellidos" placeholder="Apellidos" aria-label="Apellidos" aria-describedby="mlApellidos" id="mapellidos">
                            </div>


                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mlCarrera">Carrera</span>
                                </div>
                                <input requiered type="text" class="form-control" name="carrera" placeholder="Carrera" aria-label="Carrera" aria-describedby="mlCarrera" id="mcarrera">
                            </div>


                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mlSemestre">Semestre</span>
                                </div>

                                <input requiered type="text" class="form-control" name="semestre" placeholder="Semestre" aria-label="Semestre" aria-describedby="mlSemestre" id="msemestre">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mlTurno">Turno</span>
                                </div>
                                <input requiered type="text" class="form-control" name="turno" placeholder="Turno" aria-label="Turno" aria-describedby="mlTurno" id="mturno">
                            </div>


                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mlGenero">Género</span>
                                </div>
                                <input requiered type="text" class="form-control" name="genero" placeholder="Género" aria-label="Género" aria-describedby="mlGenero" id="mgenero">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="mlCargo">Cargo</span>
                                </div>
                                <input requiered type="text" class="form-control" name="cargo" placeholder="Cargo" aria-label="Cargo" aria-describedby="mlCargo" id="mcargo">
                            </div>

                            <input type="submit" name="aceptar" value="Aceptar" class="btn btn-primary" id="btnAceptar">



                        </form>
                        <div id="msgExito"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
        <!-- Inserotar oficial -->
        <div id="Insertarofi" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Insertar Oficial</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">
                        <form action="Insertarofi.php" class="needs-validation" method="POST" id="formInputOficial">

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" name="labelnombre"
                                          id="lNombre">Nombre</span>
                                </div>
                                <input required type="text" class="form-control" name="nombre" placeholder="Nombre" aria-label="Nombre" aria-describedby="lNombre">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lApellidosP">Apellido paterno</span>
                                </div>
                                <input required type="text" class="form-control" name="apellidoP" placeholder="Apellido paterno" aria-label="ApellidosP" aria-describedby="lApellidosP">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lApellidosM">Apellido materno</span>
                                </div>
                                <input required type="text" class="form-control" name="apellidoM" placeholder="Apellido materno" aria-label="ApellidosM" aria-describedby="lApellidosM">
                            </div>

                             <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lcelular">Celular</span>
                                </div>
                                <input required type="text" class="form-control" name="celular" placeholder="Celular" aria-label="Celular" aria-describedby="Celular">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lCodigo">Codigo</span>
                                </div>
                                <input required type="text" class="form-control" name="codigo" placeholder="Codigo" aria-label="Codigo" aria-describedby="lCodigo">
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lCarrera">Carrera</span>
                                </div>
                                <select required class="form-control" name="carrera" id="exampleFormControlSelect1">
                                    <option>Ing. Sistemas</option>
                                    <option>Ing. Electronica</option>
                                    <option>Ing. Industrial</option>
                                    <option>Ing. Comercial</option>
                                    <option>Ing. Mecatronica</option>
                                    <option>Ing. Petrolera</option>
                                    <option>Ing. Civil</option>
                                    <option>Ing. Ambiental</option>
                                    <option>Ing. Agronomica</option>
                                    <option>-</option>

                                </select>
                            </div>


                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lSemestre">Semestre</span>
                                </div>
                                <!--<input type="text" name="semestre" placeholder="semestre" class="form-control" aria-label="Semestre" aria-describedby="lSemestre">-->
                                <select required class="form-control" name="semestre" id="exampleFormControlSelect1">
                                    <option>3er Semestre</option>
                                    <option>4to Semestre</option>
                                    <option>5to Semestre</option>
                                    <option>6to Semestre</option>
                                    <option>7mo Semestre</option>
                                    <option>8vo Semestre</option>
                                    <option>9no Semestre</option>
                                    <option>-</option>
                                </select>
                            </div>

                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lTipoofi">Tipo de Oficial</span>
                                </div>
                                <!--<input type="text" name="semestre" placeholder="semestre" class="form-control" aria-label="Semestre" aria-describedby="lSemestre">-->
                                <select required class="form-control" name="descripcion" id="exampleFormControlSelect1">
                                    <option>Superior</option>
                                    <option>Subalterno</option>
                                </select>
                            </div>


                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lTipoofi">Grado</span>
                                </div>
                                <!--<input type="text" name="semestre" placeholder="semestre" class="form-control" aria-label="Semestre" aria-describedby="lSemestre">-->
                                <select required class="form-control" name="lGrado" id="exampleFormControlSelect1">
                                    <option>Cnl</option>
                                    <option>Tcnl</option>
                                    <option>My</option>
                                    
                                    <option>Cap</option>
                                    <option>Tte</option>
                                    <option>Stte</option>
                                    <option>Alf</option>
                                    
                                </select>
                            </div>



                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lTurno">Turno</span>
                                </div>
                                <select required class="form-control" name="turno" id="exampleFormControlSelect1">
                                    <option>Mañana</option>
                                    <option>Tarde</option>
                                </select>
                            </div>


                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lGenero">Género</span>
                                </div>
                                <select required class="form-control" name="genero" id="exampleFormControlSelect1">
                                    <option>Femenino</option>
                                    <option>Masculino</option>
                                </select>
                            </div>

                              <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lCodigo">Correo</span>
                                </div>
                                <input required type="text" class="form-control" name="correo" placeholder="Correo" aria-label="Correo" aria-describedby="lCorreo">
                            </div>

                            <input type="submit" name="insertarofi" value="Insertar" class="btn btn-primary" id="btnEnviar">

                            <div id="respOfi"></div>


                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>

        <div id="Modificarofi" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Oficial</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
    
                        </div>
                        <div class="modal-body">
                            <form action="modificarOficial.php" class="needs-validation" method="POST" id="formModificarOficial">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lCodigo">Buscar</span>
                                    </div>
                                    <input id="buscarOf"required type="text" class="form-control" name="buscar" placeholder="Ingresar codigo" aria-label="Codigo" aria-describedby="lCodigo" onkeyup="showHintOf(this.value)">
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lCodigo">Codigo</span>
                                    </div>
                                    <input id="codigoOf"required type="text" class="form-control" name="codigo" placeholder="Codigo" aria-label="Codigo" aria-describedby="lCodigo">
                                </div>
                                <h4 id="txtSugOf"></h4>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" name="labelnombre"
                                              id="lNombre">Nombre</span>
                                    </div>
                                    <input id="nombreOf" required type="text" class="form-control" name="nombre" placeholder="Nombre" aria-label="Nombre" aria-describedby="lNombre">
                                </div>
    
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lApellidosP">Apellido paterno</span>
                                    </div>
                                    <input id="apellidopOf" required type="text" class="form-control" name="apellidoP" placeholder="Apellido paterno" aria-label="ApellidosP" aria-describedby="lApellidosP">
                                </div>
    
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lApellidosM">Apellido materno</span>
                                    </div>
                                    <input id="apellidomOf" required type="text" class="form-control" name="apellidoM" placeholder="Apellido materno" aria-label="ApellidosM" aria-describedby="lApellidosM">
                                </div>
    
                                 <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lcelular">Celular</span>
                                    </div>
                                    <input id="celularOf" required type="text" class="form-control" name="celular" placeholder="Celular" aria-label="Celular" aria-describedby="Celular">
                                </div>
    
                                
    
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lCarrera">Carrera</span>
                                    </div>
                                    <input id="carreraOf" required type="text" class="form-control" name="carrera" placeholder="Carrera" aria-label="Carrera" aria-describedby="lCarrera">
                                </div>
    
    
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lSemestre">Semestre</span>
                                    </div>
                                    <!--<input type="text" name="semestre" placeholder="semestre" class="form-control" aria-label="Semestre" aria-describedby="lSemestre">-->
                                    <input id="semestreOf" required type="text" class="form-control" name="semestre" placeholder="Semestre" aria-label="Semestre" aria-describedby="lSemestre">
                                </div>
    
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="descripcion">Tipo de Oficial</span>
                                    </div>
                                    <!--<input type="text" name="semestre" placeholder="semestre" class="form-control" aria-label="Semestre" aria-describedby="lSemestre">-->
                                    <input id="descripcionOf" required type="text" class="form-control" name="descripcion" placeholder="Descripcion" aria-label="descripcion" aria-describedby="descripcion">
                                </div>
    
    
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="grado">Grado</span>
                                    </div>
                                    <!--<input type="text" name="semestre" placeholder="semestre" class="form-control" aria-label="Semestre" aria-describedby="lSemestre">-->
                                    <input id="gradoOf" required type="text" class="form-control" name="grado" placeholder="Grado" aria-label="grado" aria-describedby="grado">
                                </div>
    
    
    
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lTurno">Turno</span>
                                    </div>
                                    <input id="turnoOf"r equired type="text" class="form-control" name="turno" placeholder="Turno" aria-label="turno" aria-describedby="turno">
                                </div>
    
    
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lGenero">Género</span>
                                    </div>
                                    <input id="generoOf" required type="text" class="form-control" name="genero" placeholder="Genero" aria-label="genero" aria-describedby="lGenero">
                                </div>
    
                                  <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="lCodigo">Correo</span>
                                    </div>
                                    <input id="correoOf" required type="text" class="form-control" name="correo" placeholder="Correo" aria-label="Correo" aria-describedby="lCorreo">
                                </div>
    
                                <input type="submit" name="insertarofi" value="Modificar" class="btn btn-primary" id="btnEnviar">
    
                                <div id="respOfi"></div>
    
    
                            </form>
                        </div>
                        <div id="msgExitoOf"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        <!-- Fin oficial -->
<!-- MODIFICAR LISTA DE GUARDIA-->
        <div id="editarLista" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg modal-xxl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nueva Lista</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <!-- MODAL MODIFICAR LISTA -->
                    <div class="modal-body col-xs-12 col-sm-12 col-md-12" id="tblFinalModificar">
                         <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-bodyModificarLista-tab" data-toggle="pill" href="#v-pills-bodyModificarLista" role="tab" aria-controls="v-pills-bodyLista" aria-selected="false">Alumnos</a>
                                <a class="nav-link" id="v-pills-headerModificarLista-tab" data-toggle="pill" href="#v-pills-headerModificarLista" role="tab" aria-controls="v-pills-headerLista" aria-selected="true">Oficiales</a>
                            </div>
                        
                        <div class="tab-content">
                            <!-- Detalle de lista de guardia -->
                            <div class="tab-pane fade show active" id="v-pills-bodyModificarLista" role="tabpanel" aria-labelledby="v-pills-bodyModificarLista-tab">
                                Detalle de la lista de guardia
                                   <form action="getCursoModificar.php" id="frmgetCursoModificar">
                                <div class="row">
                                       
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lSemestre">Semestre</span>
                                </div>
                                <div name="semestre" placeholder="semestre" class="form-control"  aria-label="Semestre" aria-describedby="lSemestre">

                                <select  name="semestreM[]" class="selectpicker form-control form-control-sm" multiple="" id="multi-select">
                                    <option data-value="tercero">3er Semestre</option>
                                    <option data-value="cuarto">4to Semestre</option>
                                    <option data-value="quinto">5to Semestre</option>
                                    <option data-value="sexto">6to Semestre</option>
                                    <option data-value="septimo">7mo Semestre</option>
                                    <option data-value="octavo">8vo Semestre</option>
                                    <option data-value="noveno">9no Semestre</option>
                                </select>
                                 </div>

                            </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        
                                         <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="lCarrera">Carrera</span>
                                </div>
                                <div name="carrera" placeholder="carrera" class="form-control"  aria-label="Carrera" aria-describedby="lCarrera">
                                <select class="selectpicker form-control form-control-sm" multiple name="carreraM[]" id="exampleFormControlSelect1">
                                    <option>Ing. Sistemas</option>
                                    <option>Ing. Electronica</option>
                                    <option>Ing. Industrial</option>
                                    <option>Ing. Comercial</option>
                                    <option>Ing. Mecatronica</option>
                                    <option>Ing. Petrolera</option>
                                    <option>Ing. Civil</option>
                                    <option>Ing. Ambiental</option>
                                    <option>Ing. Agronomica</option>

                                </select>
                            </div>
                                     <input type="submit" name="btngetCurso" id="btnCursoModifcar" value="+" class="btn btn-primary">
                        </div>
                                    </div>
                                    
                                </div>
                                   </form>
                                <div class="row">

                                    <div id="bodyListaModificar" class="col-sm-6 col-lg-6 col-xs-12"></div>
                                    
                                    <div id="newbody" class="col-sm-6 col-lg-6 col-xs-12"></div>

                                </div>
                            </div>
                            
                            <!-- Fin detalle de lista de guardia -->
                            
                            <div class="tab-pane fade " id="v-pills-headerModificarLista" role="tabpanel" aria-labelledby="v-pills-headerModificarLista-tab">
                                <!-- Formulario tab lista de guardia -->
                                <form action="modificarLista.php" class="mt-4" method="POST" id="formListaModificar">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="lgrupo">Grupo estudiantes</span>
                                            </div>
                                            <input type="text" class="form-control" name="grupo" placeholder="grupo" aria-label="grupo" aria-describedby="lgrupo" id="igrupoModif" readonly>
            
                                        </div>
                                    </div>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="lfecha">Fecha</span>
                                            </div>
                                            <input type="date" class="form-control"  min="<?php $hoy=date("Y-m-d"); echo $hoy;?>" name="fecha" placeholder="fecha" aria-label="fecha" aria-describedby="lfecha" id="ifechaModif">
                                        </div>
                                    </div>
                                </div>
                                <div id="select-oficialesModificar" class="row"></div>
                            
                             <!--<input type="submit" name="aceptar" value="Aceptar" class="btn btn-primary" id="btnLista">-->
                            <input type="submit" name="aceptar" value="Continuar" class="btn btn-primary" data-toggle="modal">
                        </form>
                        <div id="msgCreadoModif"></div>
                    </div>
                            
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
        </div>
        
        <div id="modalNewStd" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Mostrar Estudiantes</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <div class="modal-body">

                          <div class="row">
                           <div class="col-sm-12" id="tempEst">
                               
                           </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
        <div id="resultado"></div>
        
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permisos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          <div class="modal-body">

              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">Codigo:</span>
                  </div>
                    <input type="text" id="sucodigo" name="sucodigo" class="form-control" placeholder="Introduzca el codigo del estudiante cuyo cambio sera aceptado " aria-label="Username" aria-describedby="basic-addon1">
              </div>
              <table class="table">
                <thead class="thead-blue">
                  <tr>
        <!--      <th scope="col">#</th>-->
                    <th scope="col">Nombre</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Fecha de guardia</th>
                    <th scope="col">Fecha de cambio de guardia</th>
                    <th scope="col">Comentario</th>
                    <th scope="col">Nombre cambio</th>
                    <th scope="col">Codigo cambio </th>
                  </tr>
              </thead>
              <tbody id="tablaYeic">
              <?php
                  $insertar = "select nombre,codigoEst,fechadelaguard,fechadelcamb,comentario,nombre_cam,codig_cam FROM PERMISO where bandera_permiso=0";
                  $consulta = mysqli_query($conn,$insertar);
                  if($consulta){
                      while($rs=mysqli_fetch_array($consulta))
                  {
                echo '<tr>'
                   .'<td>'.$rs['nombre'].'</td>'
                   .'<td>'.$rs['codigoEst'].'</td>'
                   .'<td>'.$rs['fechadelaguard'].'</td>'
                   .'<td>'.$rs['fechadelcamb'].'</td>'
                   .'<td>'.$rs['comentario'].'</td>'
                 .'<td>'.$rs['nombre_cam'].'</td>'
                 .'<td>'.$rs['codig_cam'].'</td>'

                   .'</tr>';
                    }}
                  ?>
          </tbody>
        </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnReb">Aceptar el cambio </button>
              </div>
            </div>
          </div>
        </div>


                <footer class="page-footer fixed-bottom" id="futer">
                    <p class="derechosR text-center m-0">Todos los derechos reservados OneByte Corp. 2018</p>

            <script>$('#multi-select')
          .dropdown()
        ;</script>
                </footer>
         <script type="text/javascript" src="Insertar.js">
        $('.selectpicker').selectpicker({
          style: 'btn-info',
          size: 4
        });
        </script>

    </body>
</html>