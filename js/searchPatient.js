
//Definieren globaler Variablen für die Kommunikation obere Tabelle
//mit unteren Hauptfunktionalitäten dem dort aktiven Tab
  var selectedPatientID;
  var selectedPatientGe;
  var testCounter = 0;
  var activeTab;

//Aktualisieren der Patietenauswahltabelle
//Kommunikation mit Datenbank nach https://www.w3schools.com/js/js_ajax_database.asp
function updatePatTableBody(){
  //nach oben scrollen,d amit die gesamte Tabelle sichtbar ist.
  $('html, body').animate({scrollTop: 0},10);
  //Tabellen-Element anzeigen
  $("#patTableDiv").css("display","block");
  //Fehler ausblenden
  $("#noPatientError").css("display","none");
  // Auslesen der Daten aus dem Formular in der Navigationsleiste
  var nachname = document.getElementById('nachname').value;
  var vorname = document.getElementById('vorname').value;
  var geburtsdatum = document.getElementById('geburtsdatum').value;

  //Erstellen einer Variable mit key-value-Paaren, die an die Datenbank geschickt wird
  var  formData = 'nachname=' + nachname +
                     '&vorname=' + vorname +
                     '&geburtsdatum=' + geburtsdatum;
  //AJAX-Abfrage an Datenbank per Javaskript
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      if (!this.response){
        //wenn die Antwort leer ist, Ausblenden der Tabelle und Ausgeben, dass
        //es keinen solchen Patienten gibt.
        $("#patTableDiv").css("display","none");
        $("#noPatientError").css("display","inline");
      } else {
      //Übertragen der Datenbankantwort in den Tabellenkörper
      document.getElementById('patTable_Body').innerHTML = this.responseText;
      }
    }
  };
  xhttp.open("POST","searchPatients.php",true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(formData);
}

//Aktualisieren des jeweils aktiven Tabs mit dem gültigen ausgewählten Patienten
function updateLowerTab(selectedPatientID){
  var aktiverTab = activeTab;
  switch (aktiverTab) {
    //Bei LaborTab: Laden des MELD-Diagramms
    case " Labor":
      activateDiagramButton("meldButton");
      break;
    //Bei Verlauf: Laden des Verlaufs für den gewählten Patienten
    case " Verlauf":
      verlauf_laden_funktion(selectedPatientID, true);
      break;
    //Bei Verlaufseintrag: Ausblenden von Fehlermeldung und aktualisieren der Verlaufseinträge
    case " Verlaufseintrag":
      verlaufTesten("Verlaufseintrag-Tab");
      break;
    default: ;
  };
}

$(document).ready(function(){

  //Auswahl eines Patienten aus PatientTable nach Suche durch Klick auf Zeile
  $("#patTable tbody").on('click', 'tr', function(){
    //Entfärben sämtlicher Zeilen
    $("#patTable tbody tr").css("background-color","white");
    //Einfärben der gewählten Zeile
    $(this).css("background-color","#cccccc");
    //Reset des Formulars für Verlaufs-Eintrag
    formular_eingabe_reset();
    //Daten des gewählten Patienten an globale Variable übergeben
    selectedPatientID = this.id.slice(3);
    selectedPatientGe = this.cells[3].innerHTML;
    document.getElementById('id_patient_t').value=selectedPatientID;
    //Verstecken der verlaufNoPatient-Warnung
    $("#verlaufNoPatient").css("display","none");
    //Gewählten Tab mit dem gewählten Patienten aktualisieren
    updateLowerTab(selectedPatientID);
  });

    //Aktivieren aller Popover
    $('[data-toggle="popover"]').popover();

    //Beim Klicken des Reset-Buttons Patientenauswahl löschen und Tabelle sowie
    //Fehlermeldungen und Tabs ausblenden
    $("#patReset").on("click",function(){
      selectedPatientID = null;
      $('#patTableDiv').css('display','none');
      $('#noPatientError').css('display','none');
      $('html, body').animate({scrollTop: 0},10);
      tabsAusblenden();
    });
});
