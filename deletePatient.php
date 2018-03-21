<?php
//php-Datei zum Speichern eines neuen Patienten

//Übernehmen der Formularinhalte, wenn diese gesetzt wurden und
//Testen der Eingaben zur Vermeidung von Hacker-Angriffen wie Cross-site scripting (XSS)
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST["idStammdaten"])){$id_stammdaten = test_input($_POST["idStammdaten"]);}
}

//Methode zum Testen der Eingaben übernommen von https://www.w3schools.com/php/php_form_validation.asp
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//Spezifikation der Datenbankanbindung
include_once("db_connect.php");

//Aufbauen der Datenbankverbindung und Schreiben der Informationen
//über den neuen Patienten in die Stammdatentabelle.
//Datenbankanbindung nach https://www.w3schools.com/php/php_mysql_insert.asp
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "DELETE FROM bericht WHERE stammdaten_idstammdaten='$id_stammdaten'";
    $sql2 = "DELETE FROM laborwerte WHERE stammdaten_idstammdaten='$id_stammdaten'";
    $sql3 = "DELETE FROM leberfunktion WHERE stammdaten_idstammdaten='$id_stammdaten'";
    $sql4 = "DELETE FROM pruritus WHERE stammdaten_idstammdaten='$id_stammdaten'";
    $sql5 = "DELETE FROM stammdaten WHERE idstammdaten='$id_stammdaten'";
    //Nutzen von exec() weil keine Werte zurückgegeben werden
    $conn->exec($sql1);
    $conn->exec($sql2);
    $conn->exec($sql3);
    $conn->exec($sql4);
    $conn->exec($sql5);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
