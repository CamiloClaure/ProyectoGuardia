$(document).ready(function(){
	
	$('.borrar').click(function(e){
			
		e.preventDefault();
		
		var pid = $(this).attr('data-id');
		var parent = $(this).parent("td").parent("tr");
		
		bootbox.dialog({
		  message: "Are you sure you want to Delete ?",
		  title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
		  buttons: {
			success: {
			  label: "No",
			  className: "btn-success",
			  callback: function() {
				 $('.bootbox').modal('hide');
			  }
			},
			danger: {
			  label: "Delete!",
			  className: "btn-danger",
			  callback: function() {
				  
				  
				  $.ajax({
					  
					  type: 'POST',
					  url: 'delete.php',
					  data: 'delete='+pid
					  
				  })
				  .done(function(response){
					  
					  bootbox.alert(response);
					  parent.fadeOut('slow');
					  
				  })
				  .fail(function(){
					  
					  bootbox.alert('Something Went Wrong ....');
												
				  })
										
			  }
			}
		  }
		});
		
		
	});
	
});
