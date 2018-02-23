<!-- Datenbankanbindung nach https://www.w3schools.com/php/php_mysql_select.asp -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST["nachname"])){$nachname = test_input($_POST["nachname"]);}
  if(isset($_POST["vorname"])){$vorname = test_input($_POST["vorname"]);}
  if(isset($_POST["geburtsdatum"])){$geburtsdatum = test_input($_POST["geburtsdatum"]);}
  if(isset($_POST["bericht-datum"])){$bericht = test_input($_POST["bericht-datum"]);}
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
    $sql = "SELECT idstammdaten FROM stammdaten";
    $stmt = $conn->prepare($sql);
        $stmt->execute();
        // for($x=0; $x < count($stmt); $x++){
        //   echo $x. "<br> asd";
        // }
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($result as $x){
          echo $x. "asd <br>";
        }
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
