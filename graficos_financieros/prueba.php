<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PRUEBA DE GRAFICOS</title>
	<style>
		.chartBox{
			width: 700px;
		}
		.contenedor{
    position: relative;
    display: inline-block;
    text-align: center;
}
 

.centrado{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
	</style>
</head>

<body>

<div class="chartBox">
  <canvas id="myChart"></canvas>

  <div class="contenedor">
  <img src="../assets/img/platino.png" width="45px">
  <div class="centrado">Centrado</div>
</div>



</div>

<script src="./librerias/Chart.bundle.min.js"></script>
  <script type="text/javascript" src="./librerias/chartjs-plugin-labels.js"></script>
<script>
	//setup block

	const data = {
		labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
	};
	//plugin block
	const drawTest= {
		id: 'total1',
            beforeDraw: function(chart) {
                const width = chart.chart.width;
                const height = chart.chart.height;
                const ctx = chart.chart.ctx;
                ctx.restore();
                const fontSize = (height / 80).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = 'middle';
                var total1 = '80 %';
                const text = total1;
                const textX = Math.round((width - ctx.measureText(text).width) / 2);
                const textY = height / 1.8;
                ctx.fillStyle = 'rgba(77, 182, 172,1)';
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
	};

	//config block
	const config= {
		type: 'bar',
	      data: {
	        labels: ['January', 'February', 'March'],
	        datasets: [
	          {
	            label: 'My First dataset',
	            data: [50445, 33655, 15900],
	            backgroundColor: [
	              '#FF6384',
	              '#FF6384',
	              '#FF6384'
	            ]
	          },
	          {
	            label: 'My Second dataset',
	            data: [40445, 23655, 35900],
	            backgroundColor: [
	              '#36A2EB',
	              '#36A2EB',
	              '#36A2EB'
	            ]
	          }
	        ]
	      },
	      options: {
	        responsive: true,
	        maintainAspectRatio: false,
	        plugins: {
	          labels: {
	            render: 'percentage'
	          }
	        }
	      }

	};

	//render init block
	const myChart= new Chart(document.getElementById('myChart'),config);


	
</script>


</body>
</html>