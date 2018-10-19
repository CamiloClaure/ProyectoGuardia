
document.getElementsByTagName("html").addEventListener("load",cargarNombre());
function cargarNombre(){
    alert(nombre);
}
$('#form, #fat, #fo3').submit(function() {
    // Enviamos el formulario usando AJAX
          $.ajax({
              type: 'POST',
              url: $(this).attr('action'),
              data: $(this).serialize(),
              // Mostramos un mensaje con la respuesta de PHP
              success: function(data) {
                  $('#result').html(data);
              }
          })      
          return false;
      }); 

      document.getElementById("cajaInput").vdocument
      document.get