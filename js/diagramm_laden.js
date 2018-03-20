
// Laden eines Diagramm je nach spezifiziertem Parameter und Patienten
function diagramm_laden_funktion(labor_parameter, selectedPatientID){

         //Abfrage der Daten mittels Ajax aus der Datenbank
         $.ajax({
              type: 'POST',
              url: 'diagramm_db.php',
              data: {parameter: labor_parameter, patient: selectedPatientID},
              dataType: 'json',
              success: function(result) {
                //Übertragen der Daten in zwei Array für x- und y-Achse
                var zeitenDiagramm = [result.length];
                var datenDiagramm = [result.length];
                for(i=0; i<result.length;i++){
                  zeitenDiagramm[i]=result[i][0];
                  datenDiagramm[i]=result[i][1];
                }
                //Aufruf der Funktion, die das eigentliche Diagramm zeichnet
                diagramm_anzeigen_funktion(zeitenDiagramm, datenDiagramm, labor_parameter);
              }
          });
}

//Zeichnen eines Diagramms aus zwei Arrays für x- und y-Achse sowie abzubildendem Parameter
function diagramm_anzeigen_funktion(zeitenDiagramm, datenDiagramm, labor_parameter){

  //Titel des Diagramms
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

  //Erzeugen des Diagramms mit der chart.js-Libraby
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

  //Herunterscrollen beim Zeichnen des Diagramms, damit direkt das gesamte Diagramm
  //sichtbar ist.
  $('html, body').animate({scrollTop: $(document).height()}, 0);

}

//Methode zum Aktivieren der Diagramm-Buttons: Optisches Aktivieren  mit der
//"active"-Klasse von Bootstrap, entfernen dieser Klasse bei allen anderen Buttons
//und Laden des entsprechnden Diagramms.
function activateDiagramButton(button){
  $("#meldButton,#pruritusButton,#gptButton,#hbvButton").removeClass("active");
  $('#' + button).addClass("active");
  switch (button) {
    case "meldButton":
      diagramm_laden_funktion('meld', selectedPatientID);
      break;
    case "pruritusButton":
      diagramm_laden_funktion('pruritus_intensitaet', selectedPatientID);
      break;
    case "gptButton":
      diagramm_laden_funktion('gpt', selectedPatientID);
      break;
    case "hbvButton":
      diagramm_laden_funktion('hbv_dna', selectedPatientID)
      break;
    default:
  }
}
