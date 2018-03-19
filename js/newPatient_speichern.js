//Speicherung des neuen Patienten mittels AJAX
function formular_ajax_neuerPatient(){

    var daten_neuerPatient = "nachname_m="+$('#nachname_m').val()+"&vorname_m="+$('#vorname_m').val()+"&geburtsdatum_m="+$('#geburtsdatum_m').val()+"&geschlecht_m="+$('input[name="geschlecht_m"]:checked').val();
    $.ajax({
      type: "POST",
      url: "newPatient.php",
      data: daten_neuerPatient,
      success: function(){
        //document.getElementById("newPatientModalForm").reset();
        $('#newPatientModal').modal('hide');
        $('#speicherung_erfolgreich_modal').modal({
          backdrop: false,
          show: true,
          keyboard: true
        });
      }
  });
};

function formular_valid_neuerPatient(){
  if($('#nachname_m').val()===""||$('#vorname_m').val()===""||$('#geburtsdatum_m').val()===""){
    feld_leer('nachname_m');
    feld_leer('vorname_m');
    var GebValue=$('#geburtsdatum_m').val();
    if(GebValue===""){
      document.getElementById('geburtsdatum_m').style.backgroundColor='#CD5C5C';
    }else {
      document.getElementById('geburtsdatum_m').style.backgroundColor='#FFFFFF';
    }
    document.getElementById('warnung_neuer_patient').style.display='block';
  }else{
    formular_ajax_neuerPatient();
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
