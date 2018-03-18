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
							console.log("no response to verlauf laden");
	          } else {
	          //alert(this.response);
	          document.getElementById('verlauf_container').innerHTML = this.responseText;
	          }
	        }
	      };
	      xhttp.open("POST","verlauf_gesamt_db.php",true);
	      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	      xhttp.send(PatIDTrans);
			};
	};

/*
var jahre = [result.length];
var monate = [result.length];
var tage = [result.length];
var stunden = [result.length];
var minuten = [result.length];
var kommentare = [result.length];
var arzt = [result.length];

for(i=0; i<result.length;i++){
  jahre[i]=result[i][0];
  monate[i]=result[i][1];
  tage[i]=result[i][2];
  stunden[i]=result[i][3];
  minuten[i]=result[i][4];
  kommentare[i]=result[i][5];
  arzt[i]=result[i][6];
*/
