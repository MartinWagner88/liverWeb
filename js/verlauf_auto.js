//Ein- und Ausblenden von optionalen Eingabefeldern des Eingabe-Formulars für den Verlauf
function darstellung(){
	var diagnosenGruppenArray = ['group_psc', 'group_hepatitis_B', 'group_leZi'];
	var diagnosenCheckboxArray = ['psc_anzeige','hepB_anzeige','leZi_anzeige'];
	for(i=0;i<diagnosenGruppenArray.length; i++){
		if(document.getElementById(diagnosenCheckboxArray[i]).checked===true){
			document.getElementById(diagnosenGruppenArray[i]).style.display='block';
			if (i===1){document.getElementById('button_empfehlung').classList.remove("disabled")};
			if (i===2){
				document.getElementById('child_e').classList.remove("disabled");
				document.getElementById('meld_e').classList.remove("disabled");
			};
		}
		else{
			document.getElementById(diagnosenGruppenArray[i]).style.display='none';
			if (i===1){
				disableBtn(document.getElementById('button_empfehlung'),"Hepatis-Therapie");
				};
			if (i===2){
				disableBtn(document.getElementById('child_e'),"Child-Score");
				disableBtn(document.getElementById('meld_e'),"MELD-Score");
			};
		};
	}
}
//Anpassung der Info-Buttons im Eingabe-Formular in Abhängigkeit vom Ergebnis
function disableBtn(button,text){
	button.classList.add("disabled","btn-basic");
	button.classList.remove("btn-success","btn-danger","btn-warning");
	button.innerHTML=text;
	button.dataset.target="";
}

function warnBtn(button){
	button.classList.add("btn-warning");
	button.classList.remove("disabled","btn-success","btn-danger","btn-basic");
	reDefineModal(button);
}

function succBtn(button){
	button.classList.add("btn-success");
	button.classList.remove("disabled","btn-danger","btn-basic","btn-warning");
	reDefineModal(button);
}

function dangBtn(button){
	button.classList.add("btn-danger");
	button.classList.remove("disabled","btn-success","btn-basic","btn-warning");
	reDefineModal(button);
}
//Ansteuerung des korrekten Modal nach Ancklicken des entsprechenden Info-Buttons
function reDefineModal(button){
	switch (button.id) {
		case "button_empfehlung":
			button.dataset.target='#antivirale_therapie_modal';
			break;
		case "child_e":
			button.dataset.target='#child_modal';
			break;
		case "meld_e":
			button.dataset.target='#meld_modal';
			break;
		default: return "";

	}
}
//Formular-Validierung bei Eingabe-Formular; Pflichtfelder in Abhängigkeit von den gewählten Krankheiten
function formular_validierung(){

	var validationOk = true;

	validationOk=feld_leer('kgKG');

	if(document.getElementById('leZi_anzeige').checked===true){
	var validAlbumin=feld_leer('albumin');
	var validInr=feld_leer('inr');
	var validBili=feld_leer('bili');
	var validKrea=feld_leer('krea');
	if (validationOk===false ||validAlbumin ===false||validInr ===false||validBili ===false||validKrea ===false){validationOk=false};
	}

	if(document.getElementById('hepB_anzeige').checked===true){
	var validGpt=feld_leer('gpt');
	var validHbv_dna=feld_leer('hbv_dna');
	if (validationOk===false ||validGpt ===false||validHbv_dna ===false){validationOk=false};
	}

	var validWieVorZahl=feld_leer('wieVorZahl');
	if (validationOk===false ||validWieVorZahl ===false){validationOk=false};

if(validationOk===true){
	kommentar_generieren();
	document.getElementById('kommentar_fehler').style.display='none'
	}else{
document.getElementById('kommentar_fehler').style.display='block'};

}

//Färbt leere Felder rot; bei befüllten Feldern wird der Hintergrudn wieder weiß gefärbt
function feld_leer(id){
	var validationResult=true;
	if(document.getElementById(id).value===""){
		document.getElementById(id).style.backgroundColor='#CD5C5C' ;
		validationResult=false;
	}else{
	document.getElementById(id).style.backgroundColor='#FFFFFF' ;
	}
	return validationResult;
}

//JSON für Textbausteine per AJAX abgefragt
function kommentar_generieren(){
	 var abfrage = new XMLHttpRequest();
	   abfrage.open("POST", "js/json_verlauf.json", true);
  abfrage.onreadystatechange = function() {
    if (abfrage.readyState == 4 && this.status==200) {
		var verlauf = JSON.parse(abfrage.responseText);
		// übergibt JSON an Funktion zur Generierung des Auto-Kommentars
		kommentar_ausfuehren(verlauf);
    }
  }
  abfrage.send(null);
}
//Erstellung des Auto-Kommentars - Übergabe der erforderlichen Variablen
  function kommentar_ausfuehren(verlauf){
	var geschlecht_v = selectedPatientGe;
	var az_v =getValue_radioButton('az');
	var pruritus_v = document.getElementById('pruritus').value;
	if (pruritus_v == 0){var pruritus_k="p0"}else{var pruritus_k="p1"};
	var kg_v=document.getElementById('kgKG').value;
	var gewVer_v =getValue_radioButton('gewVer');
	var hepEnz_vv =getValue_radioButton('hepEnz');
	var hepEnz_v = "he"+hepEnz_vv.toString();
	var blutung_v =getValue_radioButton('blutung');
	var aszites_vv =getValue_radioButton('aszites');
	var aszites_v = "as"+aszites_vv.toString();

	var geschlecht_j = verlauf[0].geschlecht[geschlecht_v];
	var pruritus_j = verlauf[1].pruritus[pruritus_k];
	var az_j = verlauf[2].allgemeinzustand[az_v];
	var hepEnz_j = verlauf[3].hepEnz[hepEnz_v];
	var blutung_j = verlauf[4].blutung[blutung_v];
	var aszites_j = verlauf[5].aszites[aszites_v];

	//Berechnung der Leberfunktions-Scores
	if(document.getElementById('leZi_anzeige').checked===true){
	var cps=berechne_childPugh();
	var ms=berechne_meld();
	}else{
		document.getElementById('child_e').classList.add('disabled');
		document.getElementById('meld_e').classList.add('disabled');
	}

	var wieVorEinheit_id=document.getElementById('wieVorEinheit');
	var wieVorEinheit_e=wieVorEinheit_id.options[wieVorEinheit_id.selectedIndex].text;
	var wieVorZahl_v=document.getElementById('wieVorZahl').value;

	// Generierung des Kommentar-Textes
	var ergebnisString = geschlecht_j+"befindet sich in "+az_j+". Das aktuelle Körpergewicht beträgt "+kg_v+" kg und ist somit "+gewVer_v+". ";
	if(document.getElementById('psc_anzeige').checked===true){
		ergebnisString+=geschlecht_j+pruritus_j;
		if (pruritus_k==="p1"){ergebnisString+="("+pruritus_v.toString()+"/10)). "};
	};
	if(document.getElementById('leZi_anzeige').checked===true){
	ergebnisString+=hepEnz_j+geschlecht_j+blutung_j+aszites_j+"Der Child-Pugh-Score beträgt "+cps+" Punkte und der MELD-Score "+ms+" Punkte."
	}
	ergebnisString+=" Wir empfehlen eine Wiedervorstellung in "+wieVorZahl_v+" "+wieVorEinheit_e+".";

	document.getElementById('kommentar_text').value=ergebnisString;

	document.getElementById('kommentar_generiert').style.display='block';

	document.getElementById('button_kommentar').innerHTML= "Kommentar aktualisieren";

	var gpt_v=document.getElementById('gpt').value;
	var hbv_dna_v=document.getElementById('hbv_dna').value;
	var indikation_hbv_therapie = false;

	if(document.getElementById('group_leZi').style.display==='visible'){
		if(hbv_dna_v>50){indikation_hbv_therapie=true}
}else{
	if(hbv_dna_v>2000 && ((geschlecht_v==="w" && gpt_v>35)||(geschlecht_v==="m" && gpt_v>50))){
		indikation_hbv_therapie=true;
	}
}

if(document.getElementById('hepB_anzeige').checked===true){
	if(indikation_hbv_therapie===true){
		document.getElementById('button_empfehlung').innerHTML= "Eine antivirale Therapie ist prinzipiell indiziert.";
		dangBtn(document.getElementById('button_empfehlung'));
	}else{
		document.getElementById('button_empfehlung').innerHTML= "Aktuell ist keine antivirale Therapie indiziert.";
		succBtn(document.getElementById('button_empfehlung'));
		}
	};
document.getElementById('button_empfehlung').style.display='block';
}

//Hilfsfunktion u.a. zur Berechnung des ChildPugh Scores
function getValue_radioButton(kriterium){
	var kriterium=document.getElementsByName(kriterium);
	for (var i =0; i< kriterium.length; i++){
		if (kriterium[i].checked){
		return kriterium[i].value;
		}

	}	return 'leer';
}
//Hilfsfunktion zur Berechnung des ChildPugh Scores (Leberfunktion)
function berechne_childPugh(){
	var albumin_v=document.getElementById('albumin').value;
	var bili_v=document.getElementById('bili').value;
	var inr_v=document.getElementById('inr').value;
	var aszites_v =getValue_radioButton('aszites');
	var hepEnz_v =getValue_radioButton('hepEnz');

	var albumin= 2;
	if(albumin_v>35){albumin=1}
	else if(albumin_v<28){albumin=3}

	var bili= 2;
	if(bili_v<2){bili=1}
	else if(bili_v>3){bili=3}

	var inr= 2;
	if(inr_v<1.7){inr=1}
	else if(inr_v>2.3){inr=3}

	var childPughScore = parseInt(albumin)+parseInt(bili)+parseInt(inr)+parseInt(aszites_v)+parseInt(hepEnz_v);

	var childPughScore_text ='Child-Pugh-Score: '+childPughScore;
	var childStadium;
	if (document.getElementById('leZi_anzeige').checked===true){
		if (childPughScore<7){
			succBtn(document.getElementById('child_e'));
			childStadium = "A";
			childPughScore_text = "Child-" + childStadium + "-Zirrhose (Child-Pugh-Score: "+childPughScore+")";
		} else{
			if (childPughScore<10) {
				warnBtn(document.getElementById('child_e'));
				childStadium = "B";
				childPughScore_text = "Child-" + childStadium + "-Zirrhose (Child-Pugh-Score: "+childPughScore+")";
			} else {
				dangBtn(document.getElementById('child_e'));
				childStadium = "C";
				childPughScore_text = "Child-" + childStadium + "-Zirrhose (Child-Pugh-Score: "+childPughScore+")";
			};
		};
		document.getElementById('child_e').innerHTML=childPughScore_text;
		document.getElementById('child_modal_p').innerHTML="Dieser Patient hat eine Child-" + childStadium +
																											"-Zirrhose bei einem Child-Pugh-Score von " + childPughScore + ".";
	}

	document.getElementById('child_t').value=childPughScore;

	return childPughScore;

}
//Hilfsfunktion zur Berechnung des MELD-Scores (Leberfunktion)
function berechne_meld(){
	var bili_v=parseFloat(document.getElementById('bili').value);
	var inr_v=parseFloat(document.getElementById('inr').value);
	var krea_v=parseFloat(document.getElementById('krea').value);
	var dialyse_v=parseInt(getValue_radioButton('dialyse'));

	if (krea_v < 1) {krea_v = 1};
	if (krea_v > 4 || dialyse_v==1){krea_v = 4};
	if (bili_v < 1) {bili_v = 1};
	if (inr_v < 1) {inr_v = 1;}

	var meld_score = Math.round(10*((0.378*Math.log(bili_v))+(1.12*Math.log(inr_v))+(0.957*Math.log(krea_v)+0.643)));

	var meld_score_text='MELD-Score: '+meld_score;
	var risikoHoehe;
	var risikoLetal;
if (document.getElementById('leZi_anzeige').checked===true){
	document.getElementById('meld_e').innerHTML=meld_score_text;
	if (meld_score<20){
		succBtn(document.getElementById('meld_e'));
		risikoHoehe = "relativ geringes";
		risikoLetal = "unter 6";
	} else{
		if (meld_score<40) {
			warnBtn(document.getElementById('meld_e'));
			risikoHoehe = "mittleres";
			risikoLetal = "20-50";
		} else {
			dangBtn(document.getElementById('meld_e'));
			risikoHoehe = "hohes";
			risikoLetal = "über 70";
		};
	};
	document.getElementById("meld_modal_p").innerHTML="Dieser Patient hat ein " + risikoHoehe + " Risiko. " +
																					"Im Falle eines Krankenhausaufenthalts liegt die Wahrscheinlichkeit, innerhalb der nächsten 3 Monate zu versterben, bei " +
																					risikoLetal +" Prozent (Quelle: <a target='_blank' href='https:/"+"/www.ncbi.nlm.nih.gov/pubmed/12512033'/><span class='glyphicon glyphicon-link'></span></a>).";

}

	document.getElementById('meld_t').value=meld_score;

	return meld_score;
}
