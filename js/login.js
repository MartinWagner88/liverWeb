//Script für login modifiziert nach: http://www.phpzag.com/ajax-login-script-with-php-and-jquery
$('document').ready(function() {
//Prüfung der Logineingaben
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
	//Gibt Daten an login.php zur Prüfung auf gültigen Benutzer/Passwort-Kombination weiter
	function submitForm() {
		var data = $("#login-form").serialize();
		$.ajax({
			type : 'POST',
			url  : 'login.php',
			data : data,
			beforeSend: function(){
				$("#error").fadeOut();
				$("#login_button").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Senden...');
			},
			success : function(response){
				if(response ==="ok"){
					$("#login_button").html('<img src="pictures/ajax-loader.gif" /> &nbsp; Einloggen...');
					setTimeout(' window.location.href = "main.php"; ',2000);
				} else {
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
