<?php
session_start();
if(!isset($_SESSION['user_session'])){
	header("Location: index.php");
}
?>

<?php
//PHP-Datei zum Abrufs aller Verlaufseinträge eines Patienten aus der Datenbank.

//Auswahl des Patienten
$id_stammdaten = $_POST['patient'];

//Generischer Verbindungsaufbau zur Datenbank
include_once("db_connect.php");
$pdo = new PDO($pdoSerAUs, $username, $password);

//Abrufen aller Kommentar sowie dazugehöriger Datums- und Arztinformationen
//des gewähllten Patienten
$sql = "SELECT datum, kommentar, arzt FROM bericht WHERE stammdaten_idstammdaten='$id_stammdaten' ORDER BY datum DESC";

$ErgArrayPos=0;
//Erzeugen eines Arrays zum Zwischenspeichern der umformierten Verlaufseinträge
$verlaufErgArray=array();

//Array zum Speichern der aus der Datenbank abgerufenen Verlaufs-Informationen.
$verlaufErg = $pdo->query($sql);

//Durchlaufen des Arrays der abgerufenen Informationen und umformatieren zur
//Übertragung in das andere Array zum Zwischenspeichern.
foreach ($verlaufErg as $row) {
	//Aufsplitten der Teilinformationen des Datums in Teilvariablen.
	$datum=strtok($row['datum'], " ");
	$uhrzeit=strtok("");
	$jahr=strtok($datum,"-");
	$monat=strtok("-");
	$tag=strtok("-");
	$stunden=strtok($uhrzeit, ":");
	$minuten=strtok(":");

	//Anwendungsspezifisches Zusammensetzen der Teilvariablen des Datums und ausgeben
  //gemeinsam mit dem Arztnamen und dem Kommentar.
  $verlaufErgArray[$ErgArrayPos]= "<div class='panel panel-default'>
	       <div class='panel-heading'>
	        <h3 class='panel-title'>
	         <a data-toggle='collapse' data-parent='#accordion' href='#collapse".$ErgArrayPos."'>".$tag.".".$monat.".".$jahr.", ".$stunden.":".$minuten." &ndash; ".$row['arzt']."</a></h3></div>
	         <div id='collapse".$ErgArrayPos."' class='panel-collapse collapse";
  if ($ErgArrayPos==0){$verlaufErgArray[$ErgArrayPos].="in";};
  $verlaufErgArray[$ErgArrayPos].="'><div class='panel-body'>".$row['kommentar']."</div></div></div>";

  $ErgArrayPos++;
}

//Anlegen einer Ergebnisvariable mit entsprechenden Kopfeintrag
$ErgFinal="<div class='container'><div class='panel-group' id='accordion'> ";

//Durchlaufen des Ergebnisarrays und jeweils Anhängen der Ergebnisse an die
//Variable zum Ausgeben der Ergebnisse.
for ($i=0; $i<count($verlaufErgArray);$i++){
  $ErgFinal.=$verlaufErgArray[$i];
}

//Ausgeben der Ergebnisvariable
echo ($ErgFinal);
?>
