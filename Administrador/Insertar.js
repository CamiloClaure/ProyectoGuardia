function borrarLista(evento){
        var grupo = parseInt(evento.target.name);
        bootbox.confirm({
        title: "Borrar lista",
        message: "Estas seguro de querer borrar la lista?",
        closeButton: false,
        buttons: {
            confirm: {
                label: 'Eliminar',
                className: 'btn-danger'
            },
            cancel: {
                label: 'Cancelar',
                className: 'btn-secondary'
            }
        },
        callback: function(result){
            
            if(result){
                $.ajax({
                
                    type: 'POST',
                    url: 'eliminarLista.php',
                    data: 'borrar='+grupo,
                    success: function(data){
                        
                        bootbox.alert(data);
                        cargarLista();
                    }
                });
            }else{

            }       
        }
        });  
    
}

function modificarLista(evento){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd = '0'+dd;
        } 

        if(mm<10) {
            mm = '0'+mm;
        } 

        today = yyyy + '' + mm + '' + dd;
        var fechaToday = parseInt(today);
       
        var fechaInicio = $(this).attr("fecha").split("-");
        var fechaI = fechaInicio[0] + fechaInicio[1] + fechaInicio[2];
        var fechaIn = parseFloat(fechaI);
        
        var dias = fechaIn - fechaToday;
   
    var grupo = parseInt(evento.target.name);
    if(dias<0){
        $('#tblFinalModificar').html("nell");
       
    }else{
        $.ajax({
                
            type: 'POST',
            url: 'getLista.php',
            data: 'grupo='+grupo,
            success: function(data){
                $('#bodyListaModificar').html(data);
                //alert(data);
            }
        });
    }
    
    
     
    
        var diff_ =dias/(1000 * 60 * 60 * 24);
        console.log("Fecha inicio: " + fechaIn + " Fecha fin: " + fechaToday);
        console.log(dias);
   
}

function moverComponentes(){
    $('.movible').on('change', function(e){
        //var padre = $(this).parent
        if (this.checked) {
            console.log('Checkbox ' + $(this).parent().val() + ' checked');
            //$(this).parent().parent().appendTo('#listaGuardiaModifcarT');
            var existe = false;
            var largo = $('#listaGuardiaModifcarT .nroFila').length;

            for(i = 1; i <= largo;i++){
                if($($('#listaGuardiaModifcarT .nroFila')[i-1]).attr("value") == $(this).attr("value")){
                    existe = true;
                    console.log($(this).value);
                    console.log($($('#listaGuardiaModifcarT .nroFila')[i-1]).val());
                }
            }
            if(!existe){
                $(this).parent().parent().appendTo('#listaGuardiaModifcarT');
                console.log("no existe"); console.log($(this).val());
                console.log($($('#listaGuardiaModifcarT .nroFila')[0]).attr("value"));
            }
            
        } else {
            console.log('Checkbox ' + $(e.currentTarget).val() + ' unchecked');
        }
    });
    
    
}

$('#btnCrearLista').click(function(){
    $.ajax({
        type: 'POST',
        url: 'setLista.php',
        success: function(data){
            $('#resultado').html(data);
            cargarLista();
            location.reload();
        }
    });
});

/*$('#btnModificarLista').click(function(){
    $.ajax({
        type: 'POST',
        url: 'updateLista.php',
        success: function(data){
            $('#resultado').html(data);
            cargarLista();
            //location.reload();
        }
    });
});*/



$('.btnCancelarLista').click(function(){
    $.ajax({
        type: 'POST',
        url: 'cancelarLista.php',
        success: function(data){
            $('#resultado').html(data);}
    });
});

$('#formInputOficial').submit(function() {
    // Enviamos el formulario usando AJAX
    $.ajax({
        type: 'POST',
        url: 'Insertarofi.php',
        data: $('#formInputOficial').serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('input[type="text"]').val('');
            $('#respOfi').html(data);

        }
    });        
    return false;
}); 



$('#formInput').submit(function() {
    // Enviamos el formulario usando AJAX
    $.ajax({
        type: 'POST',
        url: 'Insertar.php',
        data: $('#formInput').serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('input[type="text"]').val('');
            $('#resp').html(data);

        }
    });        
    return false;
}); 

$('#formModify').submit(function() {
    // Enviamos el formulario usando AJAX
    $.ajax({
        type: 'POST',
        url: 'modificarEst.php',
        data: $('#formModify').serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('input[type="text"]').val('');
            $('#msgExito').html(data);

        }
    });
    return false;
}); 


$('#formModificarOficial').submit(function() {
    // Enviamos el formulario usando AJAX
    $.ajax({
        type: 'POST',
        url: 'modificarOficial.php',
        data: $('#formModificarOficial').serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('input[type="text"]').val('');
            $('#msgExitoOf').html(data);

        }
    });
    return false;
}); 

$('#formLista').submit(function() {
    // Enviamos el formulario usando AJAX
    $.ajax({
        type: 'POST',
        url: 'generarListaP1.php',
        data: $('#formLista,#formTmpEst').serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            
            $('#tblFinal').html(data);
          cargarLista();

        }
    });
    return false;
}); 

$('#formListaModificar').submit(function() {
    // Enviamos el formulario usando AJAX
    $.ajax({
        type: 'POST',
        url: 'modificarLista.php',
        data: $('#formListaModificar,#frmReadyToSendStudents').serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            
            $('#tblFinalModificar').html(data);
          //cargarLista();

        }
    });
    return false;
}); 

$('#frmgetCurso').submit(function() {
    // Enviamos el formulario usando AJAX
    $.ajax({
        type: 'POST',
        url: 'getCurso.php',
        data: $('#frmgetCurso').serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            
            $('#bodyLista').html(data);
          //cargarLista();

        }
    });       
    return false;
}); 
$('#frmgetCursoModificar').submit(function() {
    // Enviamos el formulario usando AJAX
    $.ajax({
        type: 'POST',
        url: 'getCursoModificar.php',
        data: $('#frmgetCursoModificar').serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            
            $('#newbody').html(data);
            var slcModificar = document.querySelectorAll('.movible');
            for(var i = 0; i <slcModificar.length;i++){
                slcModificar[i].addEventListener('click',moverComponentes);
            }

        }
    });
    return false;
}); 


$('#formBuscar').submit(function(){

                      $.ajax({  type: 'POST',
                      url: 'BusquedaListaEstu.php',
                      data: $('#formBuscar').serialize(),
    // Mostramos un mensaje con la respuesta de PHP
    success: function(data) {
     $('#tempEst').html(data);
        alert(data);

    }
});

return false;
});
$('#select-oficiales').ready(function() {
    $.ajax({
        type: 'GET',
        url: 'generarOficiales.php',
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('#select-oficiales').html(data);
            $('#select-oficialesModificar').html(data);
        }
    });
    return false;
});

$('#btnSalir').click(function (e) { 
    $.ajax({
        type: 'POST',
        url: 'salir.php',
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
            $('#btnSalir').html(data);
           
        }
    });
    return false;
});

function showHint(str) {
    if (str.length == 0 || str == "") { 
        document.getElementById("txtSug").innerHTML = "";
        $('input[id="msemestre"]').val("");
        $('input[id="mturno"]').val("");
        $('input[id="mnombre"]').val("");
        $('input[id="mapellidos"]').val("");
        $('input[id="mcarrera"]').val("");
        $('input[id="mcargo"]').val("");
        $('input[id="mgenero"]').val("");
        $('input[id="mcodigo"]').val("");
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var temp = this.responseText.split(",");

                if(temp.length >2){
                    $('input[id="msemestre"]').val(temp[0]);
                    $('input[id="mturno"]').val(temp[1]);
                    $('input[id="mnombre"]').val(temp[2]);
                    $('input[id="mapellidos"]').val(temp[3]);
                    $('input[id="mcarrera"]').val(temp[4]);
                    $('input[id="mcargo"]').val(temp[5]);
                    $('input[id="mgenero"]').val(temp[6]);
                    $('input[id="mcodigo"]').val(temp[7]);
                }
                else{
                    $('input[id="msemestre"]').val("");
                    $('input[id="mturno"]').val("");
                    $('input[id="mnombre"]').val("");
                    $('input[id="mapellidos"]').val("");
                    $('input[id="mcarrera"]').val("");
                    $('input[id="mcargo"]').val("");
                    $('input[id="mgenero"]').val("");
                    $('input[id="mcodigo"]').val("");
                }

            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}

function showHintOf(str) {
    if (str.length == 0 || str == "") { 
        document.getElementById("txtSugOf").innerHTML = "";
        $('input[id="nombreOf"]').val("");
                    $('input[id="apellidopOf"]').val("");
                    $('input[id="apellidomOf"]').val("");
                    $('input[id="celularOf"]').val("");
                    $('input[id="carreraOf"]').val("");
                    $('input[id="semestreOf"]').val("");
                    $('input[id="descripcionOf"]').val("");
                    $('input[id="gradoOf"]').val("");
                    $('input[id="turnoOf"]').val("");
                    $('input[id="generoOf"]').val("");
                    $('input[id="correoOf"]').val("");
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var temp = this.responseText.split(",");

                if(temp.length >2){
                    $('input[id="nombreOf"]').val(temp[0]);
                    $('input[id="apellidopOf"]').val(temp[1]);
                    $('input[id="apellidomOf"]').val(temp[2]);
                    $('input[id="celularOf"]').val(temp[3]);
                    $('input[id="carreraOf"]').val(temp[4]);
                    $('input[id="semestreOf"]').val(temp[5]);
                    $('input[id="descripcionOf"]').val(temp[6]);
                    $('input[id="gradoOf"]').val(temp[7]);
                    $('input[id="turnoOf"]').val(temp[8]);
                    $('input[id="generoOf"]').val(temp[9]);
                    $('input[id="correoOf"]').val(temp[10]);
                    $('input[id="codigoOf"]').val(temp[11]);
                    
                    console.log("temp en 0: " + temp[0]);
                }
                else{
                    $('input[id="nombreOf"]').val("");
                    $('input[id="apellidopOf"]').val("");
                    $('input[id="apellidomOf"]').val("");
                    $('input[id="celularOf"]').val("");
                    $('input[id="carreraOf"]').val("");
                    $('input[id="semestreOf"]').val("");
                    $('input[id="descripcionOf"]').val("");
                    $('input[id="gradoOf"]').val("");
                    $('input[id="turnoOf"]').val("");
                    $('input[id="generoOf"]').val("");
                    $('input[id="correoOf"]').val("");
                    $('input[id="codigoOf"]').val("");
                    console.log("else");
                }

            }
        };
        xmlhttp.open("GET", "getHintOf.php?q=" + str, true);
        xmlhttp.send();
    }
    console.log(str);
}

function cargarLista(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(JSON.stringify(this));
            document.getElementById("tabla").innerHTML =  this.responseText;

            var botones = document.querySelectorAll('.visualizar');
            var btnEliminar = document.querySelectorAll('.borrar');
            var btnModificar = document.querySelectorAll('.modificarLista');
            for(var i = 0; i <botones.length;i++){
                botones[i].addEventListener('click',moverInfo);
                btnEliminar[i].addEventListener('click',borrarLista);
                btnModificar[i].addEventListener('click',modificarLista);
                
            }
            var btnModificar = document.querySelectorAll('.btn-modificar');
            document.getElementById("btnReb").addEventListener('click',solicitud);
            document.getElementById("btnNegar").addEventListener('click',solicitudNegada);
           
        }
    };
    xmlhttp.open("GET", "mostrarLista.php", true);
    xmlhttp.send();
}
function moverInfo(evento){
    var grupo = parseInt(evento.target.name);
   
   var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tempEst").innerHTML = this.responseText;


            }
        };
        xmlhttp.open("GET", "BusquedaListaEstu.php?q=" + grupo, true);
        xmlhttp.send();
}

 
function solicitud(){
        var sucod = document.getElementById("sucodigo").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("tablaYeic").innerHTML=this.responseText;
    
    }
    };
    xhttp.open("GET", "Aprobacion.php?cod="+sucod, true);
    xhttp.send();
    
}
function solicitudNegada(){
    var sucod = document.getElementById("sucodigo").value;
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
document.getElementById("tablaYeic").innerHTML=this.responseText;

}
};
xhttp.open("GET", "Negacion.php?cod="+sucod, true);
xhttp.send();

}
