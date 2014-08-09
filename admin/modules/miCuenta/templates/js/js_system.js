// LOGIN SISTEMA
$(document).ready(function(){
	$("#frmLogin").validate();
	$("#frmLogin input[name=usuario]").focus();
	
	
	$("#frmPerfil").validate({
		  rules: {
		    clave: { required: true, minlength: 6 },
			force: { required: true, min: 40    }
		  }
		});
	
	
});

$(function(){
	$("#clave").complexify({strengthScaleFactor:0.5, minimumChars:6 }, function (valid, complexity) {
		if (!valid) {
			$('#progress').css({'width':complexity + '%'}).removeClass('progressbarValid').addClass('progressbarInvalid');
		} else {
			$('#progress').css({'width':complexity + '%'}).removeClass('progressbarInvalid').addClass('progressbarValid');
		}
		$('#complexity').html(Math.round(complexity) + '%');
	});
});


function validarForce(){
	if ($('#force').val()<40){
		alert('La Fuerza de Clave debe superar el 40% para poder ser guardada..');
		return false;
	}
}