<?php
//LogIn Bereich modifiziert nach: http://www.phpzag.com/ajax-login-script-with-php-and-jquery
session_start();
include_once("db_connect.php");

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if(isset($_POST['login_button'])) {
	$benutzer_name = trim($_POST['benutzer_name']);
	$benutzer_passwort = trim($_POST['benutzer_passwort']);

	$sql = "SELECT benutzer_id, benutzer_name, benutzer_passwort FROM benutzer WHERE benutzer_name='$benutzer_name'";

	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);

	if(password_verify($benutzer_passwort, $row['benutzer_passwort'])){
		$_SESSION['user_session'] = $row['benutzer_id'];
		echo "ok";
	} else {
		echo '';
	}
}
?>
