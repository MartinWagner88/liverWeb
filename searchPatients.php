<?php
//php-Datei zum Suchen von Patienten in der Datenbank

//Übernehmen der Formularinhalte, wenn diese gesetzt wurden und
//Testen der Eingaben zur Vermeidung von Hacker-Angriffen wie Cross-site scripting (XSS)
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST["nachname"])){$nachname = test_input($_POST["nachname"]);}
  if(isset($_POST["vorname"])){$vorname = test_input($_POST["vorname"]);}
  if(isset($_POST["geburtsdatum"])){$geburtsdatum = test_input($_POST["geburtsdatum"]);}
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

// Datenbankanbindung nach https://www.w3schools.com/php/php_mysql_select.asp
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //SQL-Abfrage ohne Berücksichtigung der eingegebenen Suchparameter.
    $sql = "SELECT idstammdaten, nachname, vorname, geburtsdatum, geschlecht  FROM stammdaten";

    //Erweitern der SQL-Abfrage um Einschränkungen, wenn die jeweiligen Felder
    //im Formular gesetzt sind. Durch die Nutzung von "LIKE" funktioniert die Suche
    //auch bei nur teilweiser Eingabe der Namen.
    $firstSqlExtension = TRUE;
    if(!empty($nachname)){
      $sql .= " WHERE (nachname LIKE '$nachname%'";
      $firstSqlExtension = FALSE;
    };
    if(!empty($vorname)){
      if($firstSqlExtension){
        $sql .= " WHERE (vorname LIKE '$vorname%'";
        $firstSqlExtension = FALSE;
        }
        else {
        $sql .= " AND vorname LIKE '$vorname%'";
        }
      }
    if(!empty($geburtsdatum)){
      if($firstSqlExtension){
        $sql .= " WHERE (geburtsdatum='$geburtsdatum'";
        $firstSqlExtension = FALSE;
        }
        else {
        $sql .= " AND geburtsdatum='$geburtsdatum'";
        }
      }
    if(!$firstSqlExtension){
      $sql .= ")";
    }

    $stmt = $conn->prepare($sql);
      $stmt->execute();
      // Setzen des herausgesuchten Arrays auf "associative"
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $counter=TRUE;
      foreach($stmt->fetchAll() as $value){
      //Erzeugen einer Tabellenzeile je Patient, wobei die ID des Zeilenelements
      //immer die Stammdaten-ID enthält, was für die Verknüpfung der Patiententabelle
      //mit den Hauptfunktionalitäten genutzt wird.
        echo "<tr id=tr_".$value["idstammdaten"].">
                <td>".$value["nachname"]."</td>
                <td>".$value["vorname"]."</td>
                <td>".$value["geburtsdatum"]."</td>
                <td>".$value["geschlecht"]."</td>
                <td><span id=delete_".$value["idstammdaten"]."_".$value["vorname"]."_".$value["nachname"]." class=\"glyphicon glyphicon-trash patientTrash\"></span></td>

              </tr>
        ";
      }
  }
  catch(PDOException $e){
    // Beim Auftreten einer Ausnahme Ausgabe des SQL-Statements und des Fehlers.
    echo $sql . "<br>" . $e->getMessage();
  }

?>
