$(document).ready(function(){
  //Intensität des Pruritus in Label des Sliders ausgeben
  // $("#pruritus").on("click",function(){
  //   $("#pruritus").css("background-color","green");
  // });
  $("#pruritus").on("change",function(){
    $("#slidecontainerLabel").html("Intensität des Pruritus ("+this.value+"/10):");
  });

});
