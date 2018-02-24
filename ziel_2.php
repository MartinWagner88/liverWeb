<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Unbenanntes Dokument</title>
</head>

<body>

<?php


$nachname=$_POST["nachname"];
$vorname=$_POST["vorname"];
$arzt=$_POST["arzt"];
$text=$_POST["freitext"];

$zeit = new DateTime();
$datum = $zeit->format('Y-m-d H:i:s');




$verbindung = mysqli_connect("localhost", "root", "" ,"liverweb") 
or die ("Fehler im System!");

$auslesen_id="SELECT idstammdaten  FROM stammdaten WHERE nachname='$nachname' AND vorname='$vorname'";

if($stmt=mysqli_prepare($verbindung, $auslesen_id)){
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $idstammdaten);
while (mysqli_stmt_fetch($stmt)){
	}
mysqli_stmt_close($stmt);
}


$einfuegen="INSERT INTO bericht (datum, arzt, kommentar, stammdaten_idstammdaten) VALUES ('$datum','$arzt', '$text','$idstammdaten')";
$einfuegen_ausfuehren=mysqli_query($verbindung, $einfuegen) or die(" keine Übertragung in die Datenbank!");

mysqli_close($verbindung);


$pdo = new PDO('mysql:host=localhost;dbname=liverweb', 'root', '');

$sql = "SELECT datum, kommentar, arzt FROM bericht WHERE stammdaten_idstammdaten='$idstammdaten' ORDER BY datum DESC";

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

</div>
</div>

?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>