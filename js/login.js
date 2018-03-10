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
			url  : 'login.php',
			data : data,
			beforeSend: function(){
				$("#error").fadeOut();
				$("#login_button").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
			},
			success : function(response){
<<<<<<< HEAD
				console.log("TypResponse:"+typeof(response));
				console.log("InhaltResponse:"+response);
				if(response ==="ok"){
					console.log('richtig');
					$("#login_button").html('<img src="bilder/ajax-loader.gif" /> &nbsp; Signing In ...');
					setTimeout(' window.location.href = "main.php"; ',5000);
=======
				if(response){
					$("#login_button").html('<img src="bilder/ajax-loader.gif" /> &nbsp; Einloggen ...');
					setTimeout(' window.location.href = "main.php"; ',2000);
>>>>>>> 69acb5d2161a814dc336951c548a0c54c5be78d5
				} else {
					console.log("falsch");
					$("#error").fadeIn(1000, function(){
						$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+' Das Passwort ist für diesen Benutzer nicht g&uumlltig!</div>');
						$("#login_button").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
					}); 
				}
			}
		});
		return false;
	}
});
