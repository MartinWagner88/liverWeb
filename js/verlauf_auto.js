function darstellung(){
	var diagnosenGruppenArray = ['group_psc', 'group_hepatitis_B', 'group_leZi'];
	var diagnosenCheckboxArray = ['psc_anzeige','hepB_anzeige','leZi_anzeige'];
	for(i=0;i<diagnosenGruppenArray.length; i++){
		if(document.getElementById(diagnosenCheckboxArray[i]).checked===true){
			document.getElementById(diagnosenGruppenArray[i]).style.display='block'}
		else{document.getElementById(diagnosenGruppenArray[i]).style.display='none'}
		}
}

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
	
	var validWieVorZahl=feld_leer('wieVorZahl');
	if (validationOk===false ||validWieVorZahl ===false){validationOk=false};
	
if(validationOk===true){
	kommentar_generieren();
	document.getElementById('kommentar_fehler').style.display='none'
	}else{
document.getElementById('kommentar_fehler').style.display='block'};

}

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

function kommentar_generieren(){

	
	 var abfrage = new XMLHttpRequest();
	   abfrage.open("POST", "liverWeb/js/json_verlauf.json", true);
	   
  abfrage.onreadystatechange = function() {
    if (abfrage.readyState == 4 && this.status==200) {
		var verlauf = JSON.parse(abfrage.responseText);
		kommentar_ausfuehren(verlauf); 
		 
    }
  }
  abfrage.send(null);	
}
  
  function kommentar_ausfuehren(verlauf){  
  
  	var geschlecht_v =getValue_radioButton('geschlecht');
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
		document.getElementById('child_e').style.display='none';
		document.getElementById('meld_e').style.display='none';
	}
	
	var wieVorEinheit_id=document.getElementById('wieVorEinheit');
	var wieVorEinheit_e=wieVorEinheit_id.options[wieVorEinheit_id.selectedIndex].text;
	var wieVorZahl_v=document.getElementById('wieVorZahl').value;
	
	
	// Generation des Kommentar-Textes
	var ergebnisString = geschlecht_j+" befindet sich in einem "+az_j+". Das aktuelle Körpergewicht beträgt "+kg_v+" kg und ist somit "+gewVer_v+". "; 
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

if(indikation_hbv_therapie===true){
	document.getElementById('button_empfehlung').innerHTML= "Eine antivirale Therapie ist prinzipiell indiziert.";
}else{
document.getElementById('button_empfehlung').innerHTML= "Keine Empfehlung!";
}
document.getElementById('button_empfehlung').style.display='block';
}





function getValue_radioButton(kriterium){
	var kriterium=document.getElementsByName(kriterium);
	for (var i =0; i< kriterium.length; i++){
		if (kriterium[i].checked){
		return kriterium[i].value;
		}
		
	}	return 'leer';
}

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
	document.getElementById('child_e').innerHTML=childPughScore_text;
	document.getElementById('child_e').style.display='inline';
	document.getElementById('child_t').value=childPughScore;
	
	return childPughScore;
	
}

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
	document.getElementById('meld_e').innerHTML=meld_score_text;
	document.getElementById('meld_e').style.display='inline';
	document.getElementById('meld_t').value=meld_score;
	
	return meld_score;
}

