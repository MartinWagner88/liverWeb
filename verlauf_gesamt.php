<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Unbenanntes Dokument</title>
</head>

<body>

<?php
//
// $nachname=$_POST["nachname"];
// $vorname=$_POST["vorname"];
// $arzt=$_POST["arzt"];
// $kommentar=$_POST["kommentar_text"];
// $kgKG=$_POST["kgKG"];
// $pruritus_intensitaet=$_POST["pruritus"];
// $gpt=$_POST["gpt"];
// $hbv_dna=$_POST["hbv_dna"];
// $albumin=$_POST["albumin"];
// $inr=$_POST["inr"];
// $bilirubin=$_POST["bili"];
// $kreatinin=$_POST["krea"];
// $child=$_POST["child_t"];
// $meld=$_POST["meld_t"];
//
// $zeit = new DateTime();
// $datum = $zeit->format('Y-m-d H:i:s');
//
//
// $verbindung = mysqli_connect("localhost", "root", "" ,"liverweb")
// or die ("Fehler im System!");
//
// $auslesen_id="SELECT idstammdaten  FROM stammdaten WHERE nachname='$nachname' AND vorname='$vorname'";
//
// if($stmt=mysqli_prepare($verbindung, $auslesen_id)){
// mysqli_stmt_execute($stmt);
// mysqli_stmt_bind_result($stmt, $id_stammdaten);
// while (mysqli_stmt_fetch($stmt)){
// 	}
// mysqli_stmt_close($stmt);
// }
//
//
// $einfuegen_bericht="INSERT INTO bericht (datum, arzt, kommentar, stammdaten_idstammdaten) VALUES ('$datum','$arzt', '$kommentar','$id_stammdaten')";
// $einfuegen_bericht_ausfuehren=mysqli_query($verbindung, $einfuegen_bericht) or die(" keine Übertragung in die Datenbank!_1");
// $einfuegen_laborwerte="INSERT INTO laborwerte (datum, gpt, albumin, bilirubin, inr, kreatinin, hbv_dna, stammdaten_idstammdaten) VALUES ('$datum', '$gpt', '$albumin', '$bilirubin', '$inr', '$kreatinin', '$hbv_dna','$id_stammdaten')";
// $einfuegen_laborwerte_ausfuehren=mysqli_query($verbindung, $einfuegen_laborwerte) or die(" keine Übertragung in die Datenbank!");
// $einfuegen_pruritus="INSERT INTO pruritus (datum, pruritus_intensitaet, stammdaten_idstammdaten) VALUES ('$datum','$pruritus_intensitaet' ,'$id_stammdaten')";
// $einfuegen_pruritus_ausfuehren=mysqli_query($verbindung, $einfuegen_pruritus) or die(" keine Übertragung in die Datenbank!");
// $einfuegen_leberfunktion="INSERT INTO leberfunktion (datum, child, meld, stammdaten_idstammdaten) VALUES ('$datum','$child', '$meld', '$id_stammdaten')";
// $einfuegen_leberfunktion_ausfuehren=mysqli_query($verbindung, $einfuegen_leberfunktion) or die(" keine Übertragung in die Datenbank!");

//mysqli_close($verbindung);
$id_stammdaten = $_POST['patient'];

$pdo = new PDO('mysql:host=localhost;dbname=liverweb', 'root', '');

$sql = "SELECT datum, kommentar, arzt FROM bericht WHERE stammdaten_idstammdaten='$id_stammdaten' ORDER BY datum DESC";

?>
<div class="container">

<div class="panel-group" id='accordion'>


<?php
$zahl_panel=0;

foreach ($pdo->query($sql) as $row) {
	$zahl_panel++;
	$datum=strtok($row['datum'], " ");
	$uhrzeit=strtok("");
	$jahr=strtok($datum,"-");
	$monat=strtok("-");
	$tag=strtok("-");
	$stunden=strtok($uhrzeit, ":");
	$minuten=strtok(":");

	echo "<div class='panel panel-default'>";
	echo "<div class='panel-heading'>";
	echo "<h3 class='panel-title'>";
	echo "<a data-toggle='collapse' data-parent='#accordion' href='#collapse".$zahl_panel."'>".$tag.".".$monat.".".$jahr.", ".$stunden.":".$minuten." &ndash; ".$row['arzt']."</a></h3></div>";
	echo "<div id='collapse".$zahl_panel."' class='panel-collapse collapse ";
	if ($zahl_panel==1){echo "in";};
	echo "'> <div class='panel-body'>".$row['kommentar'];
	echo "</div></div></div>";

}





?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
