
// Defining global variables
  var selectedPatientID;
  var selectedPatientGe;
  var testCounter = 0;


//Kommunikation mit Datenbank nach https://www.w3schools.com/js/js_ajax_database.asp
function updatePatTableBody(){
  // Auslesen der Daten aus dem Formular per id
  var nachname = document.getElementById('nachname').value;
  var vorname = document.getElementById('vorname').value;
  var geburtsdatum = document.getElementById('geburtsdatum').value;
  var berichtDatum = document.getElementById('berichtDatum').value;

  // Erstellen einer Variable mit key-value-Paaren, die an die Datenbank geschickt wird
  var  formData = 'nachname=' + nachname +
                     '&vorname=' + vorname +
                     '&geburtsdatum=' + geburtsdatum +
                     '&berichtDatum=' + berichtDatum;
  var xhttp;
      document.getElementById('patTable_Body').innerHTML = formData;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      document.getElementById('patTable_Body').innerHTML = this.responseText;
    }
  };
  xhttp.open("POST","php/searchPatients.php",true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(formData);
}

function choosePatient(){

}

// $(document).ready(function(){
//   $("thead").click(function(){
//       $("tbody").css("background-color","red");
//       console.log("TEST" + testCounter);
//       testCounter =+ 1;
//   });
//
//   $('#patTable tr').click(function(){
//     console.log("Funktion 2");
//     $("thead").css("background-color","green");
//     $("tbody").css("background-color","green");
//   });
// });

$(document).ready(function(){

//Auswahl eines Patienten aus PatientTable nach Suche
  $("#patTable tbody").on('click', 'tr', function(){
    //Entfärben sämtlicher Zeilen
    $("#patTable tbody tr").css("background-color","white");
    //Einfärben der gewählten Zeile
    $(this).css("background-color","#cccccc");
    selectedPatientID = this.id.slice(3);
    selectedPatientGe = this.cells[3].innerHTML;
    $("#patNumberDisplay").html('Patienten-ID: ' + selectedPatientID);
    diagramm_laden_funktion('meld', selectedPatientID);
    //"Patienten-ID: ".selectedPatientID;
  });


// //Test-Funktionen zum Ausprobieren der Funktionalität von jquery und css
//   $("#patTable thead").dblclick(function(){
//     $("#patTable tbody tr:nth-of-type(3)").css("background-color","blue");
//     console.log("3rd row blue; "+testCounter);
//     testCounter += 1;
//   });
//
//   $("#patTable thead").mouseenter(function(){
//     $("#patTable").css("background-color","green");
//     console.log("Table-Background green; "+testCounter);
//     testCounter += 1;
//   });
//
//   $("#patTable").dblclick(function(){
//     $("#patTable").css("background-color","red");
//     console.log("Background red; " + testCounter);
//     testCounter += 1;
//   });




});
