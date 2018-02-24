<?php
session_start();
include_once("db_connect.php");
if(isset($_POST['login_button'])) {
	$benutzer_name = trim($_POST['benutzer_name']);
	$benutzer_passwort = trim($_POST['benutzer_passwort']);
	
	$sql = "SELECT benutzer_id, benutzer_name, benutzer_passwort FROM benutzer WHERE benutzer_name='$benutzer_name'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);	
		
	if($row['benutzer_passwort']==$benutzer_passwort){				
		echo "ok";
		$_SESSION['user_session'] = $row['benutzer_id'];
	} else {				
		echo "email or password does not exist."; // wrong details 
	}		
}
?>