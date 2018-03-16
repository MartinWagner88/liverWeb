

<?php
//LogIn Bereich modifiziert nach: http://www.phpzag.com/ajax-login-script-with-php-and-jquery
	session_start();
	unset($_SESSION['user_session']);
	if(session_destroy()) {
		header("Location: index.php");
	}
?>
