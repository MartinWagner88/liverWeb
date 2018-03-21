
//Beim Klicken eines Mülleimer-span wird für dessen ID die Patientenlöschung eingeleitet
$(document).on("click","span.patientTrash", function(){
  patientDeleteDialog(this.id,"b","c");
});

//Dialog der Patientenlöschung
function patientDeleteDialog(delete_id){
  //Die Übergebene ID des Mülleimer-span wird gesplittet, um ID, Vorname und
  //Nachname des Patienten zu extrahieren.
  var patArray = delete_id.split("_");
  var patientenID = patArray[1];
  var vorname = patArray[2];
  var nachname = patArray [3];
  //Bestätigungsdialog definieren
  var loeschen = confirm("Willst du den Patienten " + vorname + " " + nachname +
                         " mit ID " + patientenID + " wirklich unwiderruflich löschen?");

  //Wenn bestätigt, dann Löschen einleiten und Tabelle aktualisieren.
  if (loeschen){
    deletePatient(patientenID);
    updatePatTableBody();
  }
};

//Löschvorgang
function deletePatient(patientenID){
    //Speichern der übergebenen Daten in einer Variable
    var daten_loeschPatient = "idStammdaten="+patientenID;
    //Übergeben an php-Datei mittels AJAX
    $.ajax({
      type: "POST",
      url: "deletePatient.php",
      data: daten_loeschPatient,
      success: function(){
        //Bestätigungsalert für Löschung und Tabelle aktualisieren
        alert("Patient gelöscht");
        updatePatTableBody();
      }
  });
};
