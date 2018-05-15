$(function(){

	$('#form-file').on('submit', function(ev){
		ev.preventDefault();
		var fd = new FormData(document.getElementById("#form-file"));
		$.ajax({
		  url: "cargar.php",
		  type: "POST",
		  data: fd,
		  processData: false,  // tell jQuery not to process the data
		  contentType: false   // tell jQuery not to set contentType
		}).done(function(){

		}).fail(function(){

		}).always(function(){
			
		});

	});

	


});