<?php
session_start();
if(!isset($_SESSION['user_session'])){
	header("Location: index.php");
}
?>

<?php
$id_stammdaten = $_POST['patient'];

include_once("db_connect.php");
$pdo = new PDO($pdoSerAUs, $username, $password);

$sql = "SELECT datum, kommentar, arzt FROM bericht WHERE stammdaten_idstammdaten='$id_stammdaten' ORDER BY datum DESC";

$ErgArrayPos=0;
$verlaufErgArray=array();

$verlaufErg = $pdo->query($sql);

foreach ($verlaufErg as $row) {
  //$ErgArrayPos_2=0;
	$datum=strtok($row['datum'], " ");
	$uhrzeit=strtok("");
	$jahr=strtok($datum,"-");
	$monat=strtok("-");
	$tag=strtok("-");
	$stunden=strtok($uhrzeit, ":");
	$minuten=strtok(":");

  $verlaufErgArray[$ErgArrayPos]= "<div class='panel panel-default'>
	       <div class='panel-heading'>
	        <h3 class='panel-title'>
	         <a data-toggle='collapse' data-parent='#accordion' href='#collapse".$ErgArrayPos."'>".$tag.".".$monat.".".$jahr.", ".$stunden.":".$minuten." &ndash; ".$row['arzt']."</a></h3></div>
	         <div id='collapse".$ErgArrayPos."' class='panel-collapse collapse";
  if ($ErgArrayPos==0){$verlaufErgArray[$ErgArrayPos].="in";};
  $verlaufErgArray[$ErgArrayPos].="'><div class='panel-body'>".$row['kommentar']."</div></div></div>";

  $ErgArrayPos++;
}

$ErgFinal="<div class='container'><div class='panel-group' id='accordion'> ";

for ($i=0; $i<count($verlaufErgArray);$i++){
  $ErgFinal.=$verlaufErgArray[$i];
}

echo ($ErgFinal);
//echo json_encode($verlaufErgArray);
?>
