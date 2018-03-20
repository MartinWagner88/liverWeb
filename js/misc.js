$(document).ready(function(){
    //Aktivieren aller Popover
//    $('[data-toggle="popover"]').popover();

    //Anpassen des Spacing hinter der Fixed-Navbar, um Überlappung zu vermeiden
    $(window).resize(function(){
      var navbarHeight = $("#mainNavbar").css("height");
      $("#patTableContainer").css("margin-top",navbarHeight);
      $("#patTableContainer").css("margin-top","+=4");
    });

    //Tabs beim Klicken: Nicht aktive ausblenden und für den geklickten Testen,
    //ob ein Patient ausgewählt wurde.
    $("#Verlaufseintrag-Nav").on("click",function(){
        tabsAusblenden();
        verlaufTesten("Verlaufseintrag-Tab");
    })
    $("#Verlauf-Nav").on("click",function(){
        tabsAusblenden();
        verlauf_laden_funktion(selectedPatientID,verlaufTesten("Verlauf-Tab"));
    })
    $("#Labor-Nav").on("click",function(){
        tabsAusblenden();
        verlaufTesten("Labor-Tab");
        activateDiagramButton("meldButton");
    })

      //Funktion zum bestimmen des aktiven Tabs nach: https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_ref_js_tab_events2&stacked=h
      $(".nav-tabs a").click(function(){
              $(this).tab('show');
      });
      $('.nav-tabs a').on('shown.bs.tab', function(event){
        activeTab = $(event.target).text();     // active tab
    //  var y = $(event.relatedTarget).text();  // previous tab
      });
});

//Funktion zum Ausblenden aller Tabs und der Fehlermeldung, dass kein Patient ausgewählt wurde,
//wenn ein Tab geklickt wird.
function tabsAusblenden(){
  $("#Verlaufseintrag-Tab").css("display","none");
  $("#Verlauf-Tab").css("display","none");
  $("#Labor-Tab").css("display","none");
  $("#verlaufNoPatient").css("display","none");
}

//Funktion zum Testen, ob ein Patient in der oberen Tabelle ausgewählt wurde: Wenn ja,
//dann ausblenden der Warnung und laden des der Methode übergebenen Tab. Wenn nein,
//dann Anzeigen der Fehlermeldung.
function verlaufTesten(tab){
  if (selectedPatientID != null){
    $("#"+ tab).css("display","inline");
    $("#verlaufNoPatient").css("display","none");
    return true;
  } else {
    $("#verlaufNoPatient").css("display","inline");
    return false;
  }
}
