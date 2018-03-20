<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Verlauf erstellen</title>
</head>

<!-- Dokument zum Erstellen eines Verlaufseintrags für einen Patienten inklusive
Decision-Support für Hepatitis-Therapie sowie Einschätzung und Bewertung
des Schweregrads der Leberzirrhose. -->

<body>

<form id="formular_verlauf"  method="post" class="form-group">

<div class="container-fluid">
  <div class="row">
    <div class="well col-sm-12">
      <h4>Allgemeine Informationen</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3">
      <div class="">
        <label for="arzt">Arzt:</label>
      </div>
      <!-- Die Information, welcher Arzt den Verlaufseintrag erstellt, wird automatisch
      aus dem angemeldeten Nutzer abgeleitet. Die Information wird für spätere
      Verwendung als "Hidden"-Eingabefeld gespeichert sowie sichtbar ausgegeben. -->
      <input type="hidden" name="arzt" id="arzt" value="<?php echo $nutzer['titel']." ".substr($nutzer['vorname'],0,1).". ".$nutzer['nachname'] ?>">
      <span><?php echo $nutzer['titel']." ".substr($nutzer['vorname'],0,1).". ".$nutzer['nachname'] ?></span>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <div class="">
          <label for="az">Allgemeinzustand:</label>
        </div>
        <div class="radio">
            <label><input type="radio"  name="az" id"az_gut" value="gut" checked="checked"/> gut</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="az" value="leichtRe"/> leicht reduziert</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="az" value="deutlRe"/> deutlich reduziert</label>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <div class="">
          <label for="kgKG">K&ouml;rpergewicht:</label>
        </div>
        <div class="">
          <label for="kgKG">
          <input type="number" min="25" max="250" step="0.1" id="kgKG" name="kgKG" required="required"/>
          kg</label>
        </div>
        <div class="radio">
            <label><input type="radio"  name="gewVer" value="stabil" checked="checked"/> stabil</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="gewVer" value="steigend"/> steigend</label>
        </div>
        <div class="radio">
            <label><input type="radio" name="gewVer" value="fallend"/> fallend</label>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <div class="">
          <label for="wieVorZahl">Wiedervorstellung in:</label>
        </div>
        <div class="">
          <label for="wieVorZahl">
            <input type="number" min="0" max="100" step="1" id="wieVorZahl" name="wieVorZahl"/>
          </label>
        </div>
        <div class="">
          <label for="wieVorEinheit">
          <select name="wieVorEinheit" id="wieVorEinheit">
          <option label="Monat(en)" selected="selected">Monat(en)</option>
          <option label="Wochen(n)">Woche(n)</option>
          <option label="Jahr(en)">Jahr(en)</option>
          </select>
          </label>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- Im folgenden "Diagnosen"-Menü werden die jeweiligen Eingabefelder nur angezeigt,
    wenn die Checkbox für die Diagnose aktiviert ist. Ebenso verhält es sich
    mit den Buttons für Decision-Support und Information über Leberzirrhose -->
    <div class="well col-sm-12">
      <h4>Diagnosen</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3">
      <!-- Für die Diagnose "Primär sklerosierende Cholangitis (PSC)" wird die Intensisität
      des Juckreizes ("Pruritus") über eine visuelle Analogskale
      (hier: Slider von 0 bis 10) abgefragt und das Ergebnis dynamisch als Text ausgegeben. -->
      <div class="">
        <label><input type="checkbox" onclick="darstellung()" name="psc_anzeige" id="psc_anzeige" value="j" /> PSC</label>
      </div>
      <div class="form-group" id="group_psc" style="display:none">
        <div class="">
          <label id="slidecontainerLabel" for="slidecontainer">Intensität des Pruritus: (?/10):</label>
        </div>
        <div id="slidecontainer">
          <input type="range" min="0" max="10" value="0" class="slider" id="pruritus" name="pruritus" style="width:100%">
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <!-- Für die Diagnose Hepatitis B werden der Laborwert Glutamat-Pyruvat-Transaminase
      ("GPT" gemessen in Units/Liter, Parameter der Leberzellschädigung),
      sowie die Viruslast (gemessen in Units/Liter) abgefragt. Daraus wird -
      geschlechtsspezifisch - die Empfehlung zur antiviralen Therapie gemäß S3-Leitlinie
      als "Decision-Support" visualisiert. -->
      <div class="">
        <label><input type="checkbox" onclick="darstellung()" name="hepB_anzeige" id="hepB_anzeige" value="j" /> Hepatitis B</label>
      </div>
      <div class="form-group" id="group_hepatitis_B" style="display:none">
        <div class="form-group">
          <div class="">
            <label for="gpt">GPT: </label>
          </div>
          <input type="number" min="0" max="50000" step="0.1" id="gpt" name="gpt"/>
          <label for="gpt">U/l</label>
        </div>
        <div class="form-group">
          <div class="">
              <label for="hbv_dna">HBV-DNA:</label>
          </div>
          <input type="number" min="0" max="10000000000" step="1" id="hbv_dna" name="hbv_dna"/>
          <label for="hbv_dna">U/l</label>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <!-- Für Leberzirrhose wird der umfangreichste Teil der notwendigen Eingaben benötigt,
      da verschiedene klinische (zB Blutungen, Hirnschäden) oder laborchemische Parameter
      (zB Albumin, Kreatinin) die zu berechnenden Scores MELD (Model of Endstage Liver Disease)
      und Child-Pugh (Stadium der Leberzirrhose) beeinflussen. -->
      <div class="text-center">
        <label><input type="checkbox" onclick="darstellung()" name="leZi_anzeige" id="leZi_anzeige" value="j" /> Leberzirrhose</label>
      </div>
      <div class="form-group" id="group_leZi" style="display:none">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <div class="">
                <label for="blutung">Gastrointestinale Blutung:</label>
              </div>
              <label class="radio-inline"><input type="radio" name="blutung" value="n" checked="checked"> nein</label>
              <label class="radio-inline"><input type="radio" name="blutung" value="h"> H&auml;matemesis</label>
              <label class="radio-inline"><input type="radio" name="blutung" value="t"> Teerstuhl</label>
              <label class="radio-inline"><input type="radio" name="blutung" value="b"> H&auml;matemesis und Teerstuhl</label>
              <label class="radio-inline"><input type="radio" name="blutung" value="s"> sonstige Blutung</label>
            </div>
            <div class="form-group">
              <div class="">
                <label for="hepEnz">Hepatische Enzephalopathie: </label>
              </div>
              <label class="radio-inline"><input type="radio" name="hepEnz" value="1" checked="checked"/> nein</label>
              <label class="radio-inline"><input type="radio" name="hepEnz" value="2"/> leichtgradig</label>
              <label class="radio-inline"><input type="radio" name="hepEnz" value="3"/> ausgepr&auml;gt</label>
            </div>
            <div class="form-group">
              <div class="">
                <label for="aszites">Aszites: </label>
              </div>
              <label class="radio-inline"><input type="radio"  name="aszites" value="1" checked="checked"/> nein</label>
              <label class="radio-inline"><input type="radio" name="aszites" value="2"/> leichtgradig</label>
              <label class="radio-inline"><input type="radio" name="aszites" value="3"/> ausgepr&auml;gt</label>
            </div>
            <div class="form-group">
              <div class="">
                <label for="dialyse">Dialyse:</label>
                <!-- Beispielhaftes Popover zur Erläuterung der genauen Definition
                (Häufigkeit in Zeitraum), wann dieses Feld auf "ja" gesetzt wird. -->
                <a data-toggle="popover" title="" data-content="Wurde der Patient in der letzten Woche mindestens zweimal dialysiert?"><span class="glyphicon glyphicon-question-sign"></span></a>
              </div>
              <label><input type="radio"  name="dialyse" value="0" checked="checked"/> nein</label>
              <label><input type="radio" name="dialyse" value="1"/> ja</label>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <div class="">
                <label for="albumin">Albumin:</label>
              </div>
              <input type="number" min="5" max="100" step="0.1" id="albumin" name="albumin"/>
              <label for="albumin">g/l</label>
            </div>
            <div class="form-group">
              <div class="">
                  <label for="inr">INR: </label>
              </div>
              <input type="number" min="0" max="50" step="0.01" id="inr" name="inr"/>
            </div>
            <div class="form-group">
              <div class="">
                <label for="bili">Bilirubin: </label>
              </div>
              <input type="number" min="0" max="100" step="0.1" id="bili" name="bili"/>
              <label for="bili">mg/dl</label>
            </div>
            <div class="form-group">
              <div class="">
                <label for="krea">Kreatinin: </label>
              </div>
              <input type="number" min="0" max="30" step="0.1" id="krea" name="krea"/>
              <label for="krea">mg/dl</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- In diesem Abschnitt befinden sich Buttons (links) und Textfeld (Mitte) für den automatisch
    generierten Kommentar und dessen Absenden in die Datenbank, sowie die beschriebenen
    Felder für Decision-Support in der Hepatitis-Therapie und Einschätzung der Leberzirrhose. -->
    <div class="well col-sm-12">
      <h4>Ergebnis</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3">
      <div class="text-center">
        <label for="">Klinischen Verlauf generieren</label>
      </div>
      <div class="">
        <button type="button" id="button_kommentar"class="btn btn-info btn-block" onclick="formular_validierung()"> Kommentar generieren</button>
        <button type="button" onclick="formular_ajax()" class="btn btn-success btn-block"><span class="glyphicon glyphicon-floppy-disk"></span> Speichern</button>
        <button type="button" onclick="formular_eingabe_reset()" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-refresh"></span>  Zurücksetzen</button>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="text-center">
        <label for="kommentar_text">Klinischer Verlauf (automatisch generiert)</label>
      </div>
      <div id="kommentar_fehler" style="display:none" class="alert alert-danger">
        <span class="glyphicon glyphicon-info-sign"></span> Da nicht alle Plfichtfelder ausgefüllt wurden, konnte das Kommentar nicht aktualisiert werden. Die erforderlichen Angaben wurden rot markiert.
      </div>
      <div id="kommentar_generiert" style="width:100%">
        <textarea rows="5" style="width:100%" id="kommentar_text" name="kommentar_text" type="text">
        </textarea>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="text-center">
        <label for="">Klinische Ergebnisse</label>
      </div>
      <!-- Die Buttons für Decision-Support und Leberzirrhose sind standardmäßig zwar sichtbar,
      aber disabled. Wenn die betreffende Krankheit gewählt wurde, werden die jeweiligen
      Buttons drückbar, erzeugen ein erläuterndes Pop-Up-Fenster ("Modal") und werden je nach Werten eingefärbt. -->
      <button type="button" id="button_empfehlung"class="btn btn-basic btn-block disabled" data-toggle="modal" style="">Hepatitis-Therapie</button>
      <button type="button" id="child_e" name="child_e" class="btn btn-basic btn-block disabled" data-toggle="modal" style=""> Child-Pugh </button>
      <button type="button" id="meld_e" name="meld_e" class="btn btn-basic btn-block disabled" data-toggle="modal" style=""> MELD </button>
    </div>
  </div>
</div>

<div style="display:none">
<input type="hidden" name="child_t" id="child_t"/>
<input type="hidden" name="meld_t" id="meld_t"/>
<input type="hidden" name="id_patient_t" id="id_patient_t"/>
</div>

</form>

<!-- Modal zur Bestätigung der erfolgreichen Speicherung eines Verlaufseintrags. -->
<div id="speicherung_erfolgreich_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Die Daten wurden erfolgreich gespeichert.</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Schließen</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal zur Erläuterung der Therapieempfehlung auf Basis des Therapiealgorithmus
zur antiviralen Therapie bei Hepatitis B nach S3-Leitlinie der Deutschen Gesellschaft
für Verdauungs- und Stoffwechselkrankheiten e.V.  -->
<div id="antivirale_therapie_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Erläuterung der Therapieempfehlung bei Hepatitis B</h4>
        <img class="img-responsive img-rounded" src="pictures/hep_B_algorithmus.png" alt="abc">
        <br>
        <p>Übersicht zur Therapie-Indikation bei einer Hepatitis B (S. 15 in
          <a target="_blank" href="https://www.dgvs.de/wp-content/uploads/2016/11/Leitlinie_Hepatitis_B.pdf">
              <span class="glyphicon glyphicon-link"></span>
          </a>
          ).
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Schließen</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal zur Erläuterung Child-Pugh-Score und Risikoabschätzung je nach Stadium -->
<div id="child_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Einstufung und Konsequenzen des Child-Stadiums einer Leberzirrhose</h4>
        <img class="img-responsive img-rounded" src="pictures/child.png" alt="abc">
        <br>
        <p id="child_modal_p"></p>
        <p>Die Stadieneinteilung und Aussagen zur Prognose stammen aus
          <a target="_blank" href="https://de.wikipedia.org/wiki/Child-Pugh-Score">
              <span class="glyphicon glyphicon-link"></span>
          </a>
          .
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Schließen</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal zur Erläuterung des MELD-Score und je nach errechnet Wert Angabe einer
(im Rahmen statistischer Abschätzbarkeit) patientenindividuellen Prognose -->
<div id="meld_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Prognose bei Leberzirrhose im Endstadium je nach MELD</h4>
        <div class="container">
            <img class="img-responsive img-rounded " src="pictures/meld.jpg" alt="abc">
        </div>
        <!-- Prognose-Paragraph, der je nach Eingabe patientenindividuell generiert wird. -->
        <p id="meld_modal_p"></p>
        <!-- Generischer Paragraph zur Erläuterung des MELD-Score -->
        <p>Je höher der Punktwert, umso niedriger ist die Wahrscheinlichkeit des Patienten,
          die nächsten 3 Monate ohne Lebertransplantation zu überleben.
          Die Abbildung zeigt die geschätzte Überlebenswahrscheinlichkeit bei verschiedenen MELD Werten (Quelle:
          <a target="_blank" href="https://lebertransplantation.eu/transplantation/vor-der-transplantation/untersuchung-und-auswahl-der-patienten-zur-lebertransplantation-meld-score.html">
              <span class="glyphicon glyphicon-link"></span>
          </a>
          ).
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Schließen</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
