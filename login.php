<?php

//LogIn Bereich modifiziert nach: http://www.phpzag.com/ajax-login-script-with-php-and-jquery

session_start();

//Einbinden der generischen Datenbankansteuerung
include_once("db_connect.php");

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//Prüfen ob der Login-Button gedrück wurde und dann übernehmen von Nutzername und Passwort aus den Eingabedaten.
if(isset($_POST['login_button'])) {
	$benutzer_name = trim($_POST['benutzer_name']);
	$benutzer_passwort = trim($_POST['benutzer_passwort']);

  //Abrufen der entsprechenden Daten aus der Datenbank. Das Passwort ist in der
  //Datenbank nur als Hash, nicht im Klartext gespeichert.
	$sql = "SELECT benutzer_id, benutzer_name, benutzer_passwort FROM benutzer WHERE benutzer_name='$benutzer_name'";

	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);

  //Prüfen und entsprechende Ausgabe der Übereinstimmung mit php-eigenen Methode password_verify
	if(password_verify($benutzer_passwort, $row['benutzer_passwort'])){
		$_SESSION['user_session'] = $row['benutzer_id'];
		echo "ok";
	} else {
		echo '';
	}
}
?>
