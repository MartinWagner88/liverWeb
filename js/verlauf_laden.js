//Diese Funktion initiert eine AJAX Abfrage zur Darstellung der Übersicht der Verläufe des ausgewählten Patienten.
	function verlauf_laden_funktion(selPatID, verlaufGetestet){
			if (verlaufGetestet){
				var PatIDTrans='patient='+selPatID;
	      var xhttp;
	      xhttp = new XMLHttpRequest();
	      xhttp.onreadystatechange = function(){
	        if (this.readyState == 4 && this.status == 200){
          	if (!this.response){
	            $("#patTableDiv").css("display","none");
	            $("#noPatientError").css("display","inline");

	          } else {
	          //Anzeigen der Veräufe in folgendem Ordner
	          document.getElementById('verlauf_container').innerHTML = this.responseText;
	          }
	        }
	      };
	      xhttp.open("POST","verlauf_gesamt_db.php",true);
	      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	      xhttp.send(PatIDTrans);
			};
	};
