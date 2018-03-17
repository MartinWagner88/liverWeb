function verlauf_laden(selectedPatientID){
        alert(selectedPatientID);
         $.ajax({
              type: 'POST',
              url: 'verlauf_gesamt.php',
              data: {patient: selectedPatientID}
          });
}
