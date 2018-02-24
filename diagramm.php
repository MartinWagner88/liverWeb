<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unbenanntes Dokument</title>
</head>

<body>

<?php

$id_stammdaten = 16;

$pdo = new PDO('mysql:host=localhost;dbname=liverweb', 'root', '');

$pruritus_diagramm = "SELECT datum, pruritus_intensitaet FROM pruritus WHERE stammdaten_idstammdaten='$id_stammdaten' ORDER BY datum ASC";

$pruDiaErg = $pdo->query($pruritus_diagramm);

echo"<script> var pruritusArray = [];</script>";
echo"<script> var pruDatArray = [];</script>";

$zaehler=0;
$ergPru=array();
$ergDatI=array();
$datumString=array();

foreach($pruDiaErg as $zeile){
$ergPru[$zaehler]=$zeile['pruritus_intensitaet'];
echo"<script> pruritusArray[".$zaehler."]=".$ergPru[$zaehler]."</script>";
$ergDatI[$zaehler]=strtok($zeile['datum'], " ");
echo"<script> pruDatArray[".$zaehler."]=String('".$ergDatI[$zaehler]."')</script>";

$zaehler++;
}
?>
<div style="width:50%; height: 50%">
<canvas id="pruritusDiagramm"></canvas>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
<script src="js/Diagramm.js"></script> 
</body>
</html>