<?php
session_start();
if(!isset($_SESSION['user_session'])){
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <!--Bootstrap required Meta-Tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LiverWeb - Dashboard</title>

    <!--Bootstrap CSS -->
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
		<!-- Own css -->
		<link rel="stylesheet" href="css/master.css">
    <!--Java-Script-Dateien -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


  </head>
  <body>

	<!--Daten einlesen-->
	<?php
	include_once("db_connect.php");
	$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

	$sql = "SELECT nachname, vorname, titel FROM benutzer WHERE benutzer_id='".$_SESSION['user_session']."'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$nutzer = mysqli_fetch_assoc($resultset);
	?>

  <!--Main Navigation Bar-->
  <nav id="mainNavbar" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">LiverWeb</a>
      </div>
		<!-- Inline Form to search for or add Patients.  -->
		<form class="navbar-form navbar-left">
				<div class="form-group">
		      <input type="text" class="form-control" id="nachname" name="nachname" placeholder="Nachname">
		      <input type="text" class="form-control" id="vorname" name="vorname" placeholder="Vorname">
			    <label for="geburtsdatum" style="color:rgba(255, 255, 255, 0.5);"> Geburtsdatum:</label>
		      <input type="date" class="form-control" id="geburtsdatum" name="geburtsdatum" min="1900-01-01" placeholder="Geburtsdatum">
		    </div>
		    <button id="patsuchsubmit" type="button" onclick="updatePatTableBody()" class="btn btn-default">
						<span class="glyphicon glyphicon-search"></span>
				</button>
		    <button id="patReset" type="reset" class="btn btn-default ">
					<span class="glyphicon glyphicon-remove"></span>
			</button>
		    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#newPatientModal">Neuer Patient</button>
			</form>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $nutzer['titel']." ".substr($nutzer['vorname'],0,1).". ".$nutzer['nachname'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php">Log-Out</a></li>
          </ul>
        </li>
			<!-- Link to Glyphicon-Homepage as a thank you for the free glyphicons -->
      <a target="_blank" href="http://glyphicons.com/" class="navbar-text glyphicon glyphicon-glass"></a>
      </ul>
    </div>
  </nav>

  <!-- Modal newPatientModal-->
  <div id="newPatientModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Neuen Patienten anlegen</h4>
        </div>
        <div class="modal-body">
          <form id="newPatientModalForm" class="" action="newPatient.php" method="post">
            <div class="form-group">
              <label for="nachname">Nachname:</label>
              <input type="text" class="form-control" id="nachname_m" name="nachname_m" placeholder="Nachname">
            </div>
            <div class="form-group">
              <label for="vorname">Vorname:</label>
              <input type="text" class="form-control" id="vorname_m" name="vorname_m" placeholder="Vorname">
            </div>
            <div class="form-group">
              <label for="geburtsdatum">Geburtsdatum:</label>
              <input type="date" class="form-control" id="geburtsdatum_m" name="geburtsdatum_m" min="1900-01-01" placeholder="Geburtsdatum">
            </div>
            <div class="form-group">
              <label for="geschlecht">Geschlecht:</label>
              <br>
              <label class="radio-inline"><input type="radio" id="geschlecht-m" name="geschlecht_m" value="m" checked>männlich</label>
              <label class="radio-inline"><input type="radio" id="geschlecht-w" name="geschlecht_m" value="w">weiblich</label>
            </div>
            <button type="button" onclick="formular_ajax_neuerPatient()"class="btn btn-success btn-block " data-dismiss="modal">Bestätigen</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Schließen</button>
        </div>
      </div>
    </div>
  </div>

	<div id="patTableContainer" class="container-fluid" style="margin-top:55px">
		<div id="noPatientError" class="container" style="display:none">
			<div class="alert alert-danger text-center">
			<strong>Achtung!</strong> Kein Patient mit den angegebenen Merkmalen gefunden.
			</div>
		</div>
	  <div id="patTableDiv" class="table-responsive" style="width:95%;margin: 0 auto;display:none">
	    <table id="patTable" class="table table-hover">
	      <thead>
	        <tr>
	          <th>Nachname</th>
	          <th>Vorname</th>
	          <th>Geburtsdatum</th>
	          <th>Geschlecht</th>
	        </tr>
	      </thead>
	      <tbody id="patTable_Body">
	      </tbody>
	    </table>
	  </div>
	</div>


<div class="container-fluid"></div>

 <ul class="nav nav-tabs nav-justified navbar-inverse">
   <li><a data-toggle="tab" href="#Verlaufseintrag-Tab"><span class="glyphicon glyphicon-list-alt"></span> Verlaufs-Eintrag</a></li>
	 <li><a data-toggle="tab" href="#Verlauf-Tab"><span class="glyphicon glyphicon-th-list"></span> Verlauf gesamt</a></li>
   <li><a data-toggle="tab" href="#Labor-Tab"><span class="glyphicon glyphicon-stats"></span> Labor</a></li>
 </ul>

 <div class="tab-content">
   <div id="Verlaufseintrag-Tab" class="tab-pane fade">
		 <?php
		 include "eingabe.php";
		 ?>
   </div>
	 <div id="Verlauf-Tab" class="tab-pane fade">
		 <?php
		 include "verlauf_gesamt.php";
		 ?>
   </div>
   <div id="Labor-Tab" class="tab-pane fade">
		 <?php
		 include "diagramm.php";
		 ?>
		 <!-- <iframe src="diagramm.php" width="100%" height="100%" style="border:none;position:absolute"></iframe> -->
   </div>
 </div>


  <!-- Bootstrap javascript. jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
	<script src="js/searchPatient.js"></script>
	<script src="js/diagramm_laden.js"></script>
	<script  src="js/verlauf_auto.js"></script>
	<script  src="js/slider.js"></script>
	<script  src="js/verlauf_speichern.js"></script>

<!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> -->

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
