<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Verlauf erstellen</title>
<script  src="js/verlauf_auto.js" async></script>
</head>

<body>



<form action="verlauf_verarbeitung.php" method="post" class="form-group">

<p>

<h4>Patientendaten</h4>
<label for="nachname">Nachname
<input type="text" id="nachname" name="nachname" required="required"/>
</label>

<label for="vorname">Vorname
<input type="text" id="vorame" name="vorname" required="required"/>
</label>

</p>


<p>

<h4>Eckdaten</h4>
<label for="arzt">Arzt
<select name="arzt">
<option label="Dr. Wagner">Dr. Wagner</option>
<option label="Dr. Vetter">Dr. Vetter</option>
</select>
</label>
</p>

<div class="form-group">
<h4>Geschlecht: <br/></h4>
<label><input type="radio"  name="geschlecht" value="w"/> weiblich</label>
<label><input type="radio" name="geschlecht" value="m" checked="checked"/> m&auml;nnlich</label>
</div>

<div class="form-group">
<h4>Allgemeinzustand: <br/></h4>
<label><input type="radio"  name="az" id"az_gut" value="gut" checked="checked"/> gut</label>
<label><input type="radio" name="az" value="leichtRe"/> leicht reduziert</label>
<label><input type="radio" name="az" value="deutlRe"/> deutlich reduziert</label>
</div>

<div class="form-group">
<h4>K&ouml;rpergewicht: <br/></h4>
<label for="kgKG">
<input type="number" min="25" max="250" step="0.1" id="kgKG" name="kgKG" required="required"/>
kg</label>

<label><input type="radio"  name="gewVer" value="stabil" checked="checked"/> stabil</label>
<label><input type="radio" name="gewVer" value="steigend"/> steigend</label>
<label><input type="radio" name="gewVer" value="fallend"/> fallend</label>
</div>

<div >
<h4>Diagnosen:  <br/></h4>
<label>PSC   <input type="checkbox" onclick="darstellung()" name="psc_anzeige" id="psc_anzeige" value="j" />     </label>
<label>Hepatitis B   <input type="checkbox" onclick="darstellung()" name="hepB_anzeige" id="hepB_anzeige" value="j" />     </label>
<label>Leberzirrhose   <input type="checkbox" onclick="darstellung()" name="leZi_anzeige" id="leZi_anzeige" value="j" /> </label>
</div>

<div class="form-group" id="group_psc" style="display:none">
<h4>Intensität des Pruritus: <br/></h4>
<div id="slidecontainer">
<input type="range" min="0" max="10" value="0" class="slider" id="pruritus" name="pruritus" style="width:75%">
</div>
</div>

<div class="form-group" id="group_hepatitis_B" style="display:none">

<div class="form-group">
<label for="inr">GPT:
<input type="number" min="0" max="50000" step="0.1" id="gpt" name="gpt"/>
U/l</label>
</div>

<div class="form-group">
<label for="inr">HBV-DNA:
<input type="number" min="0" max="10000000000" step="1" id="hbv_dna" name="hbv_dna"/>
U/l</label>
</div>

</div>


<div class="form-group" id="group_leZi" style="display:none">

<div class="form-group">
<h4>Gastrointestinale Blutung:  <br/></h4>
<label><input type="radio" name="blutung" value="n" checked="checked"/> nein</label>
<label><input type="radio" name="blutung" value="h"/> H&auml;matemesis</label>
<label><input type="radio" name="blutung" value="t"/> Teerstuhl</label>
<label><input type="radio" name="blutung" value="b"/> H&auml;matemesis und Teerstuhl</label>
<label><input type="radio" name="blutung" value="s"/> sonstige Blutung</label>
</div>

<div class="form-group">
<h4>Hepatische Enzephalopathie:  <br/></h4>
<label><input type="radio" name="hepEnz" value="1" checked="checked"/> nein</label>
<label><input type="radio" name="hepEnz" value="2"/> leichtgradig</label>
<label><input type="radio" name="hepEnz" value="3"/> ausgepr&auml;gt</label>
</div>

<div class="form-group">
<h4>Aszites:  <br/></h4>
<label><input type="radio"  name="aszites" value="1" checked="checked"/> nein</label>
<label><input type="radio" name="aszites" value="2"/> leichtgradig</label>
<label><input type="radio" name="aszites" value="3"/> ausgepr&auml;gt</label>
</div>


<div class="form-group">
<h4>Laborwerte:  <br/></h4>
<label for="albumin">Albumin:
<input type="number" min="5" max="100" step="0.1" id="albumin" name="albumin"/>
g/l</label>
</div>

<div class="form-group">
<label for="inr">INR:
<input type="number" min="0" max="50" step="0.01" id="inr" name="inr"/>
</label>
</div>

<div class="form-group">
<label for="bili">Bilirubin:
<input type="number" min="0" max="100" step="0.1" id="bili" name="bili"/>
mg/dl</label>
</div>

<div class="form-group">
<label for="krea">Kreatinin:
<input type="number" min="0" max="30" step="0.1" id="krea" name="krea"/>
mg/dl</label>
</div>

<div class="form-group">
<h4>Dialyse: <br/></h4>
<label><input type="radio"  name="dialyse" value="0" checked="checked"/> nein</label>
<label><input type="radio" name="dialyse" value="1"/> ja</label>
</div>
</div>

<div class="form-group">
<label for="wieVorZahl">Wiedervorstellung in:
<input type="number" min="0" max="100" step="1" id="wieVorZahl" name="wieVorZahl"/>
</label>

<label for="wieVorEinheit">
<select name="wieVorEinheit" id="wieVorEinheit">
<option label="Monate(n)" selected="selected">Monate(n)</option>
<option label="Wochen(n)">Woche(n)</option>
<option label="Jahre(n)">Jahre(n)</option>
</select>
</label>
</div>

<div id="kommentar_generiert" style="display: none; width:100%">


<label for="az">Klinischer Verlauf (automatisch generiert)
</label><br />
<textarea rows="6" style="width:75%" id="kommentar_text" name="kommentar_text" type="text">
</textarea>
</div>

<div style="display:none">
<input type="number" name="child_t" id="child_t"/>
<input type="number" name="meld_t" id="meld_t"/>
</div>


<button type="button" id="button_kommentar"class="btn btn-info" onclick="formular_validierung()"> Kommentar generieren</button><br/><br/>
<p style="color:red; display:none" id="kommentar_fehler">Da nicht alle Plfichtfelder ausgefüllt wurden, konnte das Kommentar nicht aktualisiert werden. Die erforderlichen Angaben wurden rot markiert.</p>
<button type="button" id="button_empfehlung"class="btn btn-warning" style="display:none"> Empfehlungen: </button><br/><br/>
<button id="child_e" name="child_e" class="btn btn-warning" style="display:none"> </button>
<button id="meld_e" name="meld_e" class="btn btn-warning" style="display:none"> </button><br/><br/>
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Speichern</button>
<button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-refresh"></span>  Zurücksetzen</button>

</form>


</body>
</html>
