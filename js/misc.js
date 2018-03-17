$(document).ready(function(){
    //Aktivieren aller Popover
    $('[data-toggle="popover"]').popover();

    //Anpassen des Spacing hinter der Fixed-Navbar, um Überlappung zu vermeiden
    $(window).resize(function(){
      var navbarHeight = $("#mainNavbar").css("height");
      $("#patTableContainer").css("margin-top",navbarHeight);
      $("#patTableContainer").css("margin-top","+=4");
    });

    //Beim Klicken des Reset-Buttons Tabelle verschwinden lassen
    $("#patReset").on("click",function(){
      $('#patTableDiv').css('display','none');
      $('#noPatientError').css('display','none');
    });

    //Tabs ein- und ausblenden beim Klicken
    $("#Verlaufseintrag-Nav").on("click",function(){
        tabsAusblenden();
        $("#Verlaufseintrag-Tab").css("display","inline");
    })
    $("#Verlauf-Nav").on("click",function(){
        tabsAusblenden();
        $("#Verlauf-Tab").css("display","inline");
    })
    $("#Labor-Nav").on("click",function(){
        tabsAusblenden();
        $("#Labor-Tab").css("display","inline");
    })



});

function tabsAusblenden(){
  $("#Verlaufseintrag-Tab").css("display","none");
  $("#Verlauf-Tab").css("display","none");
  $("#Labor-Tab").css("display","none");
}
