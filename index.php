<html>
    <head>
        <title>Grafik</title>
        <link rel="stylesheet" href="./bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script
            src="./jquery-3.5.1.js"></script>
        <script src="./Chart.min.js"></script>
    </head>
    <style>
        body{
            margin:0;
        }
    </style>
    <body>
        <div class="col-12">
            <center>
                <div class="col-4">
                    <select id="tipeChart" class="form-control" onchange="buatChart()">
                        <option value="bar">Bar Chart</option>
                        <option value="pie">Pie Chart</option>
                        <option value="line">Line Chart</option>
                    </select>
                </div>
            </center>
        </div>
        <div class="col-12">
            <br>
            <canvas id="myChart"></canvas>    
        </div>
    
    
    </body>
<script src="./bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var labels = [];
var dataSet = [];
var myChart;
var coloR = [];

var dynamicColors = function() {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgb(" + r + "," + g + "," + b + ")";
};

$(document).ready(function(){
    
    $.getJSON("./getData.php", function(data){
        $.each(data, function(key,val){
            if(val.jumlah > 0){
                labels.push(val.Country);
                dataSet.push(val.jumlah);
            }            
        });       
    }).done(function(){
        for (var i in dataSet) {
            coloR.push(dynamicColors());
        }
        buatChart();
    });
    
});


function buatChart(){
        var typeChart = $('#tipeChart').val();
        if (myChart) {
            myChart.destroy();
        }
        if(typeChart == 'line'){
            var dataSetnya = [{
                label: '# Data Kematian Terbanyak',
                data: dataSet,
                fill: false,
                borderColor: "#4183c4"
            }];
        }else{
            var dataSetnya = [{
                label: '# Data Kematian Terbanyak',
                data: dataSet,
                backgroundColor: coloR,
                borderWidth: 1
            }];    
        }
        
        
        myChart = new Chart(ctx, {
        type: typeChart,
        data: {
            labels: labels,
            datasets: dataSetnya
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        });
    }
</script>
</html>