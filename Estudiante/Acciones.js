function cargarLista() {
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            //console.log(JSON.stringify(this));
            document.getElementById("calendarioWeb").innerHTML =  this.responseText;

            var botones = document.querySelectorAll('.btn-sm');
            for(var i = 0; i <botones.length;i++){
                botones[i].addEventListener('click',moverInfo);
            }
            var sol = document.getElementById("Solicitud").addEventListener('click', solicitud);
           // var cambio = document.getElementById("btnValidar").addEventListener('click', cambioAjax);
          


        }
    };
    xmlhttp.open("GET", "mostrarListaEst.php", true);
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
    var miAjax = new XMLHttpRequest();
    miAjax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("calendarioWeb").innerHTML = this.responseText;

        }
    };
    miAjax.open("GET","Permiso2.0.php",true);
    miAjax.send();
}

/*function cambioAjax(){
    var cAjax = new XMLHttpRequest();
    cAjax.onreadystatechange = function() {
        if(this.readyState === 4 && this.status === 200){
            document.getElementById("respuestaPass").innerHTML = this.responseText;
        }
    };
    
    cAjax.open("POST","cambioPass.php",true);
    cAjax.send();
}

$('#validar').submit(function() {
    // Enviamos el formulario usando AJAX
    $.ajax({
        type: 'POST',
        url: 'cambioPass.php',
        data: $('#validar').serialize(),
        // Mostramos un mensaje con la respuesta de PHP
        success: function(data) {
           
           // $('#respuestaPass').html(data);

        }
    })        
    return false;
}); 
*/
$('#frmPermisoAlex').submit(function() {
    
    $.ajax({
        type: 'POST',
        url: 'codigo.php',
        data: $('#frmPermisoAlex').serialize(),
   
        success: function(data) {
           
            $('#resPermiso').html(data);

        }
    });        
    return false;
}); 
