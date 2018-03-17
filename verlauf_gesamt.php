<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Unbenanntes Dokument</title>
</head>

<body>

<div id="verlauf_container">
</div>

<!--<script>
	function verlauf_anzeigen_funktion(jahre, monate, tage, stunden, minuten, kommentare, arzt){
    var laenge =jahre.length;
		document.write("<div class='container'>");
		document.write("<div class='panel-group' id='accordion'>");
    for(i=0; i<laenge; i++){
      document.write("<div class='panel panel-default'>");
  		document.write("<div class='panel-heading'>");
  		document.write("<h3 class='panel-title'>");
  		document.write("<a data-toggle='collapse' data-parent='#accordion' href='#collapse"+i+"'>"+tage[i]+"."+monate[i]+"."+jahre[i]+", "+stunden[i]+":"+minuten[i]+" &ndash; "+arzt[i]+"</a></h3></div>");
  		document.write("<div id='collapse"+i+"' class='panel-collapse collapse ");
  		if (i==0){document.write("in");};
  		document.write("'> <div class='panel-body'>"+kommentare[i]);
  		document.write("</div></div></div>");
    }
  }
</script>

	$zahl_panel=0;

	foreach ($pdo->query($sql) as $row) {
		$zahl_panel++;
		$datum=strtok($row['datum'], " ");
		$uhrzeit=strtok("");
		$jahr=strtok($datum,"-");
		$monat=strtok("-");
		$tag=strtok("-");
		$stunden=strtok($uhrzeit, ":");
		$minuten=strtok(":");

		echo "<div class='panel panel-default'>";
		echo "<div class='panel-heading'>";
		echo "<h3 class='panel-title'>";
		echo "<a data-toggle='collapse' data-parent='#accordion' href='#collapse".$zahl_panel."'>".$tag.".".$monat.".".$jahr.", ".$stunden.":".$minuten." &ndash; ".$row['arzt']."</a></h3></div>";
		echo "<div id='collapse".$zahl_panel."' class='panel-collapse collapse ";
		if ($zahl_panel==1){echo "in";};
		echo "'> <div class='panel-body'>".$row['kommentar'];
		echo "</div></div></div>";

	}
	-->
</body>
</html>
