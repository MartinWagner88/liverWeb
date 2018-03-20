

<?php
//LogIn Bereich modifiziert nach: http://www.phpzag.com/ajax-login-script-with-php-and-jquery

//Beim Ausloggen wird die Sesson terminiert und der Nutzer auf die Login-Seite
//"index.php" weitergeleitet.
	session_start();
	unset($_SESSION['user_session']);
	if(session_destroy()) {
		header("Location: index.php");
	}
?>
