function formular_ajax(){
    var daten_formular = "arzt="+$('#arzt').val()+"&kommentar_text="+$('#kommentar_text').val()+"&kgKG="+$('#kgKG').val()+"&pruritus="+$('#pruritus').val()+"&gpt="+$('#gpt').val()+"&hbv_dna="+$('#hbv_dna').val()+"&albumin="+
    $('#albumin').val()+"&inr="+$('#inr').val()+"&bili="+$('#bili').val()+"&krea="+$('#krea').val()+"&child_t="+$('#child_t').val()+"&meld_t="+$('#meld_t').val()+"&id_patient_t="+$('#id_patient_t').val();
    $.ajax({
      type: "POST",
      url: "verlauf_verarbeitung.php",
      data: daten_formular,
      success: function(){
        $('#speicherung_erfolgreich_modal').modal({
          backdrop: true,
          show: true,
          keyboard: true
        });
        document.getElementById("formular_verlauf").reset();
      }
  });

};

function formular_ajax_neuerPatient(){
    var daten_neuerPatient = "nachname="+$('#nachname').val()+"&vorname="+$('#vornmae').val()+"&geburtsdatum="+$('#geburtsdatum').val()+"&geschlecht="+$('input[name="geschlecht_m"]:checked').val();
    $.ajax({
      type: "POST",
      url: "php/searchPatients.php",
      data: daten_neuerPatient,
      success: function(){
        document.getElementById("newPatientModalForm").reset();
        $('#newPatientModal').hide();
        $('#speicherung_erfolgreich_modal').modal({
          backdrop: true,
          show: true,
          keyboard: true
        });
      }
  });

};
