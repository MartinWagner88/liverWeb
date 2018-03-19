<?php
session_start();
if(!isset($_SESSION['user_session'])){
	header("Location: index.php");
}
?>

<?php
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

include_once("db_connect.php");

$pdo = new PDO($pdoSerAUs, $username, $password);

$pruritus_diagramm = "SELECT datum, ".$parameter." FROM ".$tabelle." WHERE stammdaten_idstammdaten='$id_stammdaten' ORDER BY datum ASC";

$pruDiaErg = $pdo->query($pruritus_diagramm);

$zaehler1=0;
$ergSuche=array();

foreach($pruDiaErg as $zeile){
  if($zeile[$parameter]!=null){
    $zaehler2=0;
    $ergSuche[$zaehler1][$zaehler2]=strtok($zeile['datum'], " ");
    $zaehler2++;
    $ergSuche[$zaehler1][$zaehler2]=$zeile[$parameter];
    $zaehler1++;
  }
}
echo json_encode($ergSuche);
?>
