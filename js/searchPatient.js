
// Defining global variables
  var selectedPatientID;
  var selectedPatientGe;
  var testCounter = 0;


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

$(document).ready(function(){

//Auswahl eines Patienten aus PatientTable nach Suche
  $("#patTable tbody").on('click', 'tr', function(){
    //Entfärben sämtlicher Zeilen
    $("#patTable tbody tr").css("background-color","white");
    //Einfärben der gewählten Zeile
    $(this).css("background-color","#cccccc");
    selectedPatientID = this.id.slice(3);
    selectedPatientGe = this.cells[3].innerHTML;
    document.getElementById('id_patient_t').value=selectedPatientID;
    $("#patNumberDisplay").html('Patienten-ID: ' + selectedPatientID);
    diagramm_laden_funktion('meld', selectedPatientID);
  });

    //Aktivieren aller Popover
    $('[data-toggle="popover"]').popover();

    //Anpassen des Spacing hinter der Fixed-Navbar, um Überlappung zu vermeiden
    $(window).resize(function(){
      var navbarHeight = $("#mainNavbar").css("height");
      $("#patTableContainer").css("margin-top",navbarHeight);
    });

    //Beim Klicken des Reset-Buttons Tabelle verschwinden lassen
    $("#patReset").on("click",function(){
      $('#patTableDiv').css('display','none');
      $('#noPatientError').css('display','none');
      $('html, body').animate({scrollTop: 0},10);
    });




});
