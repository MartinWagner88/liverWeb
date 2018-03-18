function diagramm_laden_funktion(labor_parameter, selectedPatientID){

         $.ajax({
              type: 'POST',
              url: 'diagramm_db.php',
              data: {parameter: labor_parameter, patient: selectedPatientID},
              dataType: 'json',
              success: function(result) {
                var zeitenDiagramm = [result.length];
                var datenDiagramm = [result.length];
                for(i=0; i<result.length;i++){
                  zeitenDiagramm[i]=result[i][0];
                  datenDiagramm[i]=result[i][1];
                }
                diagramm_anzeigen_funktion(zeitenDiagramm, datenDiagramm, labor_parameter);
              }
          });
}

function diagramm_anzeigen_funktion(zeitenDiagramm, datenDiagramm, labor_parameter){

  switch(labor_parameter) {
      case 'meld': var beschriftungDiagramm ='MELD Score';
          break;
      case 'pruritus_intensitaet':var beschriftungDiagramm ='Intensität des Pruritus';
          break;
      case 'gpt': var beschriftungDiagramm ='GPT / ALT';
          break;
      case 'hbv_dna': var beschriftungDiagramm ='HBV-DNA';
          break;
      default:
          var beschriftungDiagramm ='Wert im Verlauf';
  }

  const CHART =document.getElementById("Diagramm");

  let pruritusDiagramm = new Chart(CHART, {
  	type:'line',
   	data: {
          labels: zeitenDiagramm,
          datasets: [{
              label: beschriftungDiagramm,
  			      fill: false,
              backgroundColor: 'rgb(255, 99, 132)',
              borderColor: 'rgb(255, 99, 132)',
              data: datenDiagramm
              }]
          }
    });

  $('html, body').animate({scrollTop: $(document).height()}, 0);
  console.log("Heruntergescrollt!" + Date.now());

}

function activateDiagramButton(button){
  $("#meldButton,#pruritusButton,#gptButton,#hbvButton").removeClass("active");
  $('#' + button).addClass("active");
}
