<?php
//php-Datei zum Speichern eines neuen Patienten

//Übernehmen der Formularinhalte, wenn diese gesetzt wurden und
//Testen der Eingaben zur Vermeidung von Hacker-Angriffen wie Cross-site scripting (XSS)
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST["nachname_m"])){$nachname = test_input($_POST["nachname_m"]);}
  if(isset($_POST["vorname_m"])){$vorname = test_input($_POST["vorname_m"]);}
  if(isset($_POST["geburtsdatum_m"])){$geburtsdatum = test_input($_POST["geburtsdatum_m"]);}
  if(isset($_POST["geschlecht_m"])){$geschlecht = test_input($_POST["geschlecht_m"]);}
}

//Methode zum Testen der Eingaben übernommen von https://www.w3schools.com/php/php_form_validation.asp
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//Spezifikation der Datenbankanbindung
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "liverweb";

//Aufbauen der Datenbankverbindung und Schreiben der Informationen
//über den neuen Patienten in die Stammdatentabelle.
//Datenbankanbindung nach https://www.w3schools.com/php/php_mysql_insert.asp
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO stammdaten (nachname, vorname, geburtsdatum, geschlecht)
    VALUES ('$nachname','$vorname','$geburtsdatum','$geschlecht')";
    //Nutzen von exec() weil keine Werte zurückgegeben werden
    $conn->exec($sql);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
