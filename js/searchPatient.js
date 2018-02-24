



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
  console.log(formData);
  //$.post("Pinky-Brain/php/searchPatients.php",formData);
  var xhttp;
      document.getElementById('patTable_Body').innerHTML = formData;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    console.log(xhttp.readyState);
    console.log(xhttp.status);
    if (this.readyState == 4 && this.status == 200){
      document.getElementById('patTable_Body').innerHTML = this.responseText;
      console.log(this.responseText);
    }
  };
  xhttp.open("POST","php/searchPatients.php",true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(formData);
}
