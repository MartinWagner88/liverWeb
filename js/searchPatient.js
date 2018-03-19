
// Defining global variables
  var selectedPatientID;
  var selectedPatientGe;
  var testCounter = 0;
  var activeTab;

//Kommunikation mit Datenbank nach https://www.w3schools.com/js/js_ajax_database.asp
function updatePatTableBody(){
  //nach oben scrollen
  $('html, body').animate({scrollTop: 0},10);
  //Tabelle anzeigen
  $("#patTableDiv").css("display","block");
  $("#noPatientError").css("display","none");
  // Auslesen der Daten aus dem Formular per id
  var nachname = document.getElementById('nachname').value;
  var vorname = document.getElementById('vorname').value;
  var geburtsdatum = document.getElementById('geburtsdatum').value;

  // Erstellen einer Variable mit key-value-Paaren, die an die Datenbank geschickt wird
  var  formData = 'nachname=' + nachname +
                     '&vorname=' + vorname +
                     '&geburtsdatum=' + geburtsdatum;
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      if (!this.response){
        $("#patTableDiv").css("display","none");
        $("#noPatientError").css("display","inline");
      } else {
      document.getElementById('patTable_Body').innerHTML = this.responseText;
      }
    }
  };
  xhttp.open("POST","php/searchPatients.php",true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(formData);
}

function updateLowerTab(selectedPatientID){
  var aktiverTab = activeTab;
  switch (aktiverTab) {
    case " Labor":
      activateDiagramButton("meldButton");
      break;
    case " Verlauf":
      verlauf_laden_funktion(selectedPatientID, true);
      break;
    case " Verlaufseintrag":
      verlaufTesten("Verlaufseintrag-Tab");
      //Marcel123 -> Todo
      break;
    default: console.log("nix gewählt");
  };
      // if ($('#Verlauf-Tab').css('display')==='inline'){
      //   verlauf_laden_funktion(selectedPatientID);
      // };
      // if ($('Labor-Tab').css('display')==='inline'){
      //
      // }
}

$(document).ready(function(){

//Auswahl eines Patienten aus PatientTable nach Suche
  $("#patTable tbody").on('click', 'tr', function(){
    //Entfärben sämtlicher Zeilen
    $("#patTable tbody tr").css("background-color","white");
    //Einfärben der gewählten Zeile
    $(this).css("background-color","#cccccc");
    //Daten des gewählten Patienten an globale Variable übergeben
    formular_eingabe_reset();
    selectedPatientID = this.id.slice(3);
    selectedPatientGe = this.cells[3].innerHTML;
    document.getElementById('id_patient_t').value=selectedPatientID;
    //Verstecken der verlaufNoPatient-Warnung
    $("#verlaufNoPatient").css("display","none");
    //Gewählten Tab mit dem gewählten Patienten aktualisieren
    updateLowerTab(selectedPatientID);
  });

    //Aktivieren aller Popover
//    $('[data-toggle="popover"]').popover();

    //Anpassen des Spacing hinter der Fixed-Navbar, um Überlappung zu vermeiden
    $(window).resize(function(){
      var navbarHeight = $("#mainNavbar").css("height");
      $("#patTableContainer").css("margin-top",navbarHeight);
    });

    //Beim Klicken des Reset-Buttons Tabelle verschwinden lassen
    $("#patReset").on("click",function(){
      selectedPatientID = null;
      $('#patTableDiv').css('display','none');
      $('#noPatientError').css('display','none');
      $('html, body').animate({scrollTop: 0},10);
      tabsAusblenden();
    });
});
