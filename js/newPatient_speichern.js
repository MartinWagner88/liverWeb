//Speicherung des neuen Patienten mittels AJAX
function formular_ajax_neuerPatient(){
    //Speichern der übergebenen Daten in einer Variable
    var daten_neuerPatient = "nachname_m="+$('#nachname_m').val()+"&vorname_m="+$('#vorname_m').val()+"&geburtsdatum_m="+$('#geburtsdatum_m').val()+"&geschlecht_m="+$('input[name="geschlecht_m"]:checked').val();
    //Übergeben an php-Datei mittels AJAX
    $.ajax({
      type: "POST",
      url: "newPatient.php",
      data: daten_neuerPatient,
      success: function(){
        //Ausblenden des Eingabe-Modals und Ersetzen durch Bestätigungs-Modal
        $('#newPatientModal').modal('hide');
        $('#speicherung_erfolgreich_modal').modal({
          backdrop: false,
          show: true,
          keyboard: true
        });
      }
  });
};

//Testen, ob die geforderten Felder ausgefüllt sind
function formular_valid_neuerPatient(){
  //Wenn ein Feld fehlt.
  if($('#nachname_m').val()===""||$('#vorname_m').val()===""||$('#geburtsdatum_m').val()===""){
    //wenn Variable fehlt, dann färben.
    feld_leer('nachname_m');
    feld_leer('vorname_m');
    //Spezifische Färbung für Geburtsdatum, aufgrund der spezifischen Datenfeldeigenschaften.
    var GebValue=$('#geburtsdatum_m').val();
    if(GebValue===""){
      document.getElementById('geburtsdatum_m').style.backgroundColor='#CD5C5C';
    }else {
      document.getElementById('geburtsdatum_m').style.backgroundColor='#FFFFFF';
    }
    document.getElementById('warnung_neuer_patient').style.display='block';
  }else{
    //neuen Patienten in die Datenbank schreiben
    formular_ajax_neuerPatient();
    //Formular leeren und ggf. entfärben
    formular_leer_neuerPatient();
  }
}
function formular_leer_neuerPatient(){
  document.getElementById('nachname_m').style.backgroundColor='#FFFFFF';
  document.getElementById('vorname_m').style.backgroundColor='#FFFFFF';
  document.getElementById('geburtsdatum_m').style.backgroundColor='#FFFFFF';
  document.getElementById('warnung_neuer_patient').style.display='none';
  document.getElementById("newPatientModalForm").reset();
}
