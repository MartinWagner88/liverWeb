<!-- Datenbankanbindung nach https://www.w3schools.com/php/php_mysql_select.asp -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST["nachname"])){$nachname = test_input($_POST["nachname"]);}
  if(isset($_POST["vorname"])){$vorname = test_input($_POST["vorname"]);}
  if(isset($_POST["geburtsdatum"])){$geburtsdatum = test_input($_POST["geburtsdatum"]);}
  if(isset($_POST["berichtDatum"])){$bericht = test_input($_POST["berichtDatum"]);}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "liverweb";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$sql = "SELECT idstammdaten  FROM stammdaten WHERE (nachname='$nachname'
    //                                                          AND vorname='$vorname'
    //                                                          AND geburtsdatum='$geburtsdatum')";
    $sql = "SELECT idstammdaten, nachname, vorname, geburtsdatum, geschlecht  FROM stammdaten";
    $stmt = $conn->prepare($sql);
        $stmt->execute();
        // for($x=0; $x < count($stmt); $x++){
        //   echo $x. "<br> asd";
        // }
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $counter=TRUE;
        foreach($stmt->fetchAll() as $value){
        //foreach($result as $x->$y){
          echo "<tr>
                  <td>".$value["nachname"]."</td>
                  <td>".$value["vorname"]."</td>
                  <td>".$value["geburtsdatum"]."</td>
                  <td>".$value["geschlecht"]."</td>
                  <td><label class='radio-inline'><input type='radio' id='wahlPatient".$value['idstammdaten']."' name='wahlPatient' value='".$value['idstammdaten']."'";
                  if($counter){echo "checked";};
                  echo "></label></td>
                </tr>
          ";
          echo $value["idstammdaten"]." asd ".$counter."<br>";
        $counter=FALSE;
        }
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
