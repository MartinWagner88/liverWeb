/*verlauf_LeZi={
	"geschlecht":{
		"w":"Die Patientin", 
		"m":"Der Patient"
	},
	"pruritus":{
		"0": "vereint das Vorliegen von Pruritus. ",
		"1": "berichtet von Pruritus (Intensität:  ", 
	},
	"allgemeinzustand":{
		"gut":"gutem Allgemeinzustand",
		"leichtRe":"leicht reduziertem Allgemeinzustand",
		"deutlRe":"deutlich reduziertem Allgemeinzustand",
	},
	"hepEnz":{
		"1":"Es ergab sich kein Hinweis auf eine hepatische Enzephalopathie. ",
		"2":"Es liegt eine leichtgradige hepatische Enzephalopathie vor. ",
		"3":"Es liegt eine hochgradige hepatische Enzephalopathie vor. "
	},
	"blutung":{
	"n":"verneinte das Vorliegen einer gastrointestinalen Blutung	. ",
	"h":"berichtet von Hämatemesis. ",
	"t":"berichtet von Teerstuhl. ",
	"h_t":"berichtet von Hämatemesis und Teerstuhl. ",
	"s":"berichtet von einer gastrointestinalen Blutung. ",
	}
}
*/

function darstellung(id){
if(document.getElementById(id).style.display==='none'){document.getElementById(id).style.display='block'}
else{document.getElementById(id).style.display='none'};
}

function kommentar_generieren(){

	
	 var abfrage = new XMLHttpRequest();
	   abfrage.open("GET", "liverWeb/js/json_verlauf.json", true);
	   
  abfrage.onreadystatechange = function() {
    if (abfrage.readyState == 4) {
		//document.getElementById('testAjax').innerHTML="post"; 	
		var verlauf_LeZi = JSON.parse(abfrage.responseText);
		kommentar_ausfuehren(verlauf_LeZi); 
		 
    }
  }
  abfrage.send(null);	
}
  
  function kommentar_ausfuehren(verlauf_LeZi){  
  
  	var geschlecht_v =getValue_radioButton('geschlecht');
	var az_v =getValue_radioButton('az');
	var pruritus_v = document.getElementById('pruritus').value;
	if (pruritus_v == 0){var pruritus_k=0}else{var pruritus_k=1};
	var kg_v=document.getElementById('kgKG').value;
	var gewVer_v =getValue_radioButton('gewVer');
	var hepEnz_v =getValue_radioButton('hepEnz').toString();
	var blutung_v =getValue_radioButton('blutung');
		
	var geschlecht_j = verlauf_LeZi.geschlecht[geschlecht_v];
	var az_j = verlauf_LeZi.allgemeinzustand[az_v];
	var pruritus_j = verlauf_LeZi.pruritus[pruritus_k];
	var hepEnz_j = verlauf_LeZi.hepEnz[hepEnz_v];
	var blutung_j = verlauf_LeZi.blutung[blutung_v];
	
	
	var cps=berechne_childPugh();
	var ms=berechne_meld();
	
	var wieVorEinheit_id=document.getElementById('wieVorEinheit');
	var wieVorEinheit_e=wieVorEinheit_id.options[wieVorEinheit_id.selectedIndex].text;
	var wieVorZahl_v=document.getElementById('wieVorZahl').value;
	
	var ergebnisString = geschlecht_j+" befindet sich in einem "+az_j+". Das aktuelle Körpergewicht beträgt "+kg_v+" kg und ist somit "+gewVer_v+". "+geschlecht_j+" "+pruritus_j
	if (pruritus_k==1){ergebnisString= ergebnisString+pruritus_v+"/10). "};
	ergebnisString= ergebnisString+hepEnz_j+geschlecht_j+" "+blutung_j+"Der Child-Pugh-Score beträgt "+cps+" Punkte und der MELD-Score "+ms+" Punkte. Wir empfehlen eine Wiedervorstellung in "+wieVorZahl_v+" "+wieVorEinheit_e+".";

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

