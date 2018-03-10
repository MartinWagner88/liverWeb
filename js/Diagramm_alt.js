const CHART =document.getElementById("pruritusDiagramm");

let pruritusDiagramm = new Chart(CHART, {
	type:'line',
 	data: {
        labels: pruDatArray,
        datasets: [{
            label: "Intensität des Pruritus",
			fill: false,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: pruritusArray
        }]
    }});