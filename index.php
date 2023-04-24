<!DOCTYPE html>
<html>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            
            
            

    <head>
    
     

      <div class="box-part text-center" >
                                                            
      <img src="cinepolis.png" width="290" height="90"> 

    </div>


        
        <br>
        <br>
        <title>Gráficas con Mysql y PHP </title>
        <h1 align="center" style= "color:#E9156A ;"> 
        Gráfico de Pastel: Idalid  </h1> 
        <br>
        <h2 align="center" style= "color:#E6548E ;""> Productos vendidos por Cinepolis </h2>

       



        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
            function drawChart() {
                // call ajax function to get sports data
                var jsonData = $.ajax({
                    url: "getData.php",
                    dataType: "json",
                    async: false
                }).responseText;
                //The DataTable object is used to hold the data passed into a visualization.
                var data = new google.visualization.DataTable(jsonData);
 
                // To render the pie chart.
                var chart = new google.visualization.PieChart(document.getElementById('chart_container'));
                chart.draw(data, {width: 1300, height: 1000});

                var options = {
                width: 1500,
                height: 1000,
                title: '',
               colors: ['#17becf', '#316395', '#22aa99','#b91383',  '#6633cc', '#329262', '#5574a6', '#3b3eac','#f4359e', '#2a778d', ]
               };

chart.draw(data, options);

            }
            // load the visualization api
            google.charts.load('current', {'packages':['corechart']});
 
            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            var options = {
          title: 'Productos vendidos por Cinepolis'
        };
        </script>
        
    </head>
    <body>
           <div id="chart_container"></div>
    </body>

    <?php

$con = new mysqli("localhost","root","","concesionario_autos"); // Conectar a la BD
$sql = "select * from venta"; // Consulta SQL
$query = $con->query($sql); // Ejecutar la consulta SQL
$data = array(); // Array donde vamos a guardar los datos
while($r = $query->fetch_object()){ // Recorrer los resultados de Ejecutar la consulta SQL
    $data[]=$r; // Guardar los resultados en la variable $data
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Grafica de Barra y Lineas con PHP y MySQL</title>
    <script src="chart.min.js"></script>
</head>
<body>
<h1 align="center" style= "color:#E9156A ;">Gráfica de Barras Concesionario</h1>
<canvas id="idventa" style="width:100%;" height="100"></canvas>
<script>
var ctx = document.getElementById("idventa");
var data = {
        labels: [ 
        <?php foreach($data as $d):?>
        "<?php echo $d->mes?>", 
        <?php endforeach; ?>
        ],
        datasets: [{
            label: '$ Venta',
            data: [
        <?php foreach($data as $d):?>
        <?php echo $d->valores;?>, 
        <?php endforeach; ?>
            ],
            backgroundColor: "#D10539",
            borderColor: "#D10539",
            borderWidth: 2
        }]
    };
var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    };
var idventa = new Chart(ctx, {
    type: 'bar', /* valores: line, bar*/
    data: data,
    options: options
});
</script>
</body>
</html>
</html>

