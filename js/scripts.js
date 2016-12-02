// JavaScript Document




<!--///// JS LOADER  ///////////////////////////////////////////
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
////////////////////////////////////////////////////////-->
$.fn.spin.presets.opts = {
  lines: 13 // The number of lines to draw
, length: 8 // The length of each line
, width: 4 // The line thickness
, radius: 10 // The radius of the inner circle
, scale: 1 // Scales overall size of the spinner
, corners: 1 // Corner roundness (0..1)
, color: '#000' // #rgb or #rrggbb or array of colors
, opacity: 0.25 // Opacity of the lines
, rotate: 0 // The rotation offset
, direction: 1 // 1: clockwise, -1: counterclockwise
, speed: 1 // Rounds per second
, trail: 60 // Afterglow percentage
, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
, zIndex: 2e9 // The z-index (defaults to 2000000000)
, className: 'spinner' // The CSS class to assign to the spinner
, top: '50%' // Top position relative to parent
, left: '50%' // Left position relative to parent
, shadow: false // Whether to render a shadow
, hwaccel: false // Whether to use hardware acceleration
, position: 'absolute' // Element positioning
}
<!--///// FIM JS LOADER  ///////////////////////////////////////////
////////////////////////////////////////////////////////-->







<!--///// FUNÇÃO PARA RESETAR  /////////////////////////////
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
////////////////////////////////////////////////////////-->
function clear(){
	$('.alert').fadeOut();
	$('#form_cadastro').each (function(){
		this.reset();
		$('input[name=id]').val('');
	});
}
<!--///// FIM FUNÇÃO PARA RESETAR  /////////////////////////////
////////////////////////////////////////////////////////-->








<!--///// SALVAR CADASTRO  /////////////////////////////
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
////////////////////////////////////////////////////////-->
$('#salvar').click(function(e){
	e.preventDefault();
	
	$('#form_cadastro').prepend('<div id="spin"></div>');
	$('#spin').spin('opts');
	$('.alert').removeClass('alert-danger');
	$('.alert').removeClass('alert-success');
	
	$.ajax({
		url: ".ajax/cadastrar.php",
		type: "POST",
		dataType: "json",
		data: new FormData($("#form_cadastro")[0]),
		cache: false,
		contentType: false,
		processData: false,
		success: function(retorno){
			$('#form_cadastro #spin').remove();
			if(retorno.acao=='novo'){
				$('.table').append(retorno.cadastro);
				$('.alert').addClass('alert-success').html(retorno.alerta).fadeIn();
				setTimeout(clear, 3000);
			}else if(retorno.acao=='editar'){
				$('#c_'+retorno.id).html(retorno.cadastro);
				$('.alert').addClass('alert-success').html(retorno.alerta).fadeIn();
				setTimeout(clear, 3000);
			}else if(retorno.acao=='alerta'){
				$('.alert').addClass('alert-danger').html(retorno.alerta).fadeIn();
			}
			return false;
		},
		error: function(error){
			 console.log("Error:");
			 console.log(error);
		}
	})
	return false;
});
<!--///// FIM SALVAR CADASTRO  /////////////////////////////
////////////////////////////////////////////////////////-->










<!--///// EDITAR CADASTRO  /////////////////////////////
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
////////////////////////////////////////////////////////-->
$('.table').on('click', 'img.editar', function(e){
	e.preventDefault();
	
	cadastro = $(this).data('id');
	
	$('#form_cadastro').prepend('<div id="spin"></div>');
	$('#spin').spin('opts');
	$('.alert').fadeOut();
	$('.alert').removeClass('alert-danger');
	$('.alert').removeClass('alert-success');
	
	$.ajax({
		url: ".ajax/editar.php",
		type: "POST",
		dataType: "json",
		data: { id: cadastro },
		success: function(retorno){
			$('#form_cadastro #spin').remove();
			
			$('input[name=id]').val(retorno.id);
			$('input[name=nome]').val(retorno.nome);
			$('input[name=sobrenome]').val(retorno.sobrenome);
			$('input[name=endereco]').val(retorno.endereco);
			
			return false;
		},
		error: function(error){
			 console.log("Error:");
			 console.log(error);
		}
	})
	return false;
});
<!--///// FIM SALVAR CADASTRO  /////////////////////////////
////////////////////////////////////////////////////////-->














<!--///// DELETAR CADASTRO  /////////////////////////////
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
////////////////////////////////////////////////////////-->
$('.table').on('click', 'img.deletar', function(e){
	e.preventDefault();
	
	cadastro = $(this).data('id');
	
	bootbox.confirm({
		message: "Tem certeza que deseja excluir este cadastro?",
		buttons: {
			confirm: {
				label: 'Sim',
				className: 'btn-success'
			},
			cancel: {
				label: 'Não',
				className: 'btn-danger'
			}
		},
		callback: function (result) {
			if(result==true){
				$.ajax({
					url: ".ajax/deletar.php",
					type: "POST",
					dataType: "json",
					data: { id: cadastro },
					success: function(retorno){
						$('#c_'+retorno.id).remove();
						return false;
					},
					error: function(error){
						 console.log("Error:");
						 console.log(error);
					}
				})
			}
		}
	});
	return false;
});
<!--///// FIM SALVAR CADASTRO  /////////////////////////////
////////////////////////////////////////////////////////-->



















<!--///// ATUALIZAR TABELA  /////////////////////////////
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
////////////////////////////////////////////////////////-->
function atualizar(){
	date = $('input[name=date]').val();
	
	$.ajax({
		url: ".ajax/atualizar.php",
		type: "POST",
		dataType: "json",
		data: { date: date},
		success: function(retorno){
			if(retorno.atualiza=='ok'){
				$('.table').html(retorno.cadastros);
				$('input[name=date]').val(retorno.date);
			}
			
			return false;
		}
	})
}

setInterval(atualizar, 1000);

<!--///// FIM ATUALIZAR TABELA  /////////////////////////////
////////////////////////////////////////////////////////-->