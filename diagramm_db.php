<?php
//Sicherstellen, dass Nutzer sich authentifiziert hat.
session_start();
if(!isset($_SESSION['user_session'])){
	header("Location: index.php");
}
?>


<?php
//Datei zum Abrufen der Daten für ein Diagramm aus der Datenbank und überführen derselben in das Format für die Darstellung

//Definieren des Patienten und der Art des Diagramms
$id_stammdaten = $_POST['patient'];
$parameter = $_POST['parameter'];

if($parameter === 'gpt' || 'hbv_dna'){
  $tabelle ='laborwerte';
}
if($parameter === 'meld'){
  $tabelle ='leberfunktion';
}
if($parameter === 'pruritus_intensitaet'){
  $tabelle ='pruritus';
}

//Einbinden der generischen Datenbankverbindung
include_once("db_connect.php");

$pdo = new PDO($pdoSerAUs, $username, $password);

//Abrufen der Datums-Messwert-Paare je nach gewählter Art des Diagramms und Patient
$pruritus_diagramm = "SELECT datum, ".$parameter." FROM ".$tabelle." WHERE stammdaten_idstammdaten='$id_stammdaten' ORDER BY datum ASC";

$pruDiaErg = $pdo->query($pruritus_diagramm);

$zaehler1=0;
$ergSuche=array();

//Übertragen der abgerufenen Werte in ein Array
foreach($pruDiaErg as $zeile){
  if($zeile[$parameter]!=null){
    $zaehler2=0;
    $ergSuche[$zaehler1][$zaehler2]=strtok($zeile['datum'], " ");
    $zaehler2++;
    $ergSuche[$zaehler1][$zaehler2]=$zeile[$parameter];
    $zaehler1++;
  }
}
//Ausgabe des Array im json-Format
echo json_encode($ergSuche);
?>
