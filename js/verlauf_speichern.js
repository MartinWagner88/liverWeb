//Speicherung des Eingabe-Formulars Verlauf mittels AJAX
function formular_ajax(){
  //Konkatination der Daten für Datentransfer
    var daten_formular = "arzt="+$('#arzt').val()+"&kommentar_text="+$('#kommentar_text').val()+"&kgKG="+$('#kgKG').val()+"&pruritus="+$('#pruritus').val()+"&gpt="+$('#gpt').val()+"&hbv_dna="+$('#hbv_dna').val()+"&albumin="+
    $('#albumin').val()+"&inr="+$('#inr').val()+"&bili="+$('#bili').val()+"&krea="+$('#krea').val()+"&child_t="+$('#child_t').val()+"&meld_t="+$('#meld_t').val()+"&id_patient_t="+$('#id_patient_t').val();
    $.ajax({
      type: "POST",
      url: "verlauf_verarbeitung.php",
      data: daten_formular,
      success: function(){
        ton('audio/speichern.mp3');
        $('#speicherung_erfolgreich_modal').modal({
          backdrop: true,
          show: true,
          keyboard: true
        });
        formular_eingabe_reset();
      }
  });

};
//Reset des Eingabe-Formulars nach dem Speichern der Eingaben inkl. Ausblenden der optionalen Anschnitte
function formular_eingabe_reset(){
  document.getElementById("formular_verlauf").reset();
  darstellung();
}
