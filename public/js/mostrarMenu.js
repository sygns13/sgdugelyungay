var listaPrecios = [];

$(function(){

	$("#msjeInicial").on("click", function(event){

		event.preventDefault();
		$.get("/mensajeInicial",function(response){
		$('#contenidoItem').html(response.view);
		
		});
	});

	$("#videoInicial").on("click", function(event){

		event.preventDefault();
		$.get("/videoPresentacion",function(response){
		$('#contenidoItem').html(response.view);
		
		});
	});

	$("#dgestion").on("click", function(event){

		event.preventDefault();
		$.get("/documentosGestion",function(response){
		$('#contenidoItem').html(response.view);
		
		});
	});

	$("#calendarioGo").on("click", function(event){

		event.preventDefault();
		$.get("/rcalendario",function(response){
		$('#contenidoItem').html(response.view);
		
		});
	});

	$("#galeria").on("click", function(event){

		event.preventDefault();
		$.get("/rgaleria",function(response){
		$('#contenidoItem').html(response.view);
		
		});
	});

	$("#funciones").on("click", function(event){

		event.preventDefault();
		$.get("/rfuncion",function(response){
		$('#contenidoItem').html(response.view);
		
		});
	});

	$("#album").on("click", function(event){

		event.preventDefault();
		$.get("/ralbum",function(response){
		$('#contenidoItem').html(response.view);
		
		});
	});
	

});





