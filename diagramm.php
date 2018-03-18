<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<title>Unbenanntes Dokument</title>
</head>

<body>

<div class="btn-group btn-group-justified">
  <a href="#" class="btn btn-default" id="meldButton" onClick="activateDiagramButton(this.id)">MELD</a>
  <a href="#" class="btn btn-default" id="pruritusButton"  onClick="activateDiagramButton(this.id)">Pruritus</a>
  <a href="#" class="btn btn-default" id="gptButton"  onClick="activateDiagramButton(this.id)">GPT</a>
    <a href="#" class="btn btn-default" id="hbvButton"  onClick="activateDiagramButton(this.id)">  HBV-DNA</a>
</div>

<div style="width:50%; height: 50%">
<canvas id="Diagramm"></canvas>
</div>

</body>
</html>
