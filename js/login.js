$('document').ready(function() { 
	/* handling form validation */
	$("#login-form").validate({
		rules: {
			benutzer_passwort: {
				required: true,
			},
			benutzer_name: {
				required: true,				
			},
		},
		messages: {
			benutzer_passwort:{
			  required: "Bitte geben Sie Ihr Passwort an!"
			 },
			benutzer_name: "Bitte geben Sie Ihren Benutzernamen an!",
		},
		submitHandler: submitForm	
	});	   
	/* Handling login functionality */
	function submitForm() {		
		var data = $("#login-form").serialize();				
		$.ajax({				
			type : 'POST',
			url  : 'liverWeb/login.php',
			data : data,
			beforeSend: function(){	
				$("#error").fadeOut();
				$("#login_button").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
			},
			success : function(response){						
				if(response=="ok"){									
					$("#login_button").html('<img src="liverWeb/bilder/ajax-loader.gif" /> &nbsp; Signing In ...');
					setTimeout(' window.location.href = "liverWeb/main.html"; ',4000);
				} else {									
					$("#error").fadeIn(1000, function(){						
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+' Das Passwort ist für den Benutzer nicht g&uumlltig!</div>');
						$("#login_button").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
					});
				}
			}
		});
		return false;
	}   
});