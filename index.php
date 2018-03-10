<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
<title></title>
<!-- LogIn Bereich modifiziert nach: http://www.phpzag.com/ajax-login-script-with-php-and-jquery/-->

</head>

<body class="">

<div class="col-xs-12" style="height:10px;"></div>

<div class="container">
	<form class="form-login" method="post" id="login-form">
		<h2 class="form-login-heading">Anmeldung - LiverWeb</h2><hr />
		<p class="form-login-heading">Ihr persönlicher Assistent für die Lebersprechstunde</p>
		<div class="form-login-heading" id="error" style="display:none">
		Test-Error</div>
		<p>&nbsp;</p>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Benutzername" name="benutzer_name" id="benutzer_name" />
			<span id="check-e"></span>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" placeholder="Passwort" name="benutzer_passwort" id="benutzer_passwort" />
		</div>
		<hr />
		<div class="form-group">
			<button type="submit" class="btn btn-default" name="login_button" id="login_button">
			<span class="glyphicon glyphicon-log-in"></span> &nbsp; Anmelden
			</button>
		</div>
	</form>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</body>

</html>
