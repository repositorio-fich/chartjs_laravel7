<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <title>Chart.js en Laravel 7</title>
</head>
<body>
<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200"></p>
<form method="POST" action="#">
    @csrf
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="col s2">
                    <input type="text" class="datepicker" id="desde" name="desde">
                    <label for="desde">Desde:</label>
                </div>
                <div class="col s2">
                    <input type="text" class="datepicker" id="hasta" name="hasta">
                    <label for="hasta">Hasta:</label>
                </div>
                <div class="col s2">
                    <a class="waves-effect waves-light btn-small" id="buscar">Ventas</a>
                </div>
            </div>
            <div class="row">
                <div class="col s6 card blue-grey lighten-5">
                    <canvas id="lienzo" height="120" width="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        M.Datepicker.init(elems, { setDefaultDate: true, format: 'dd-mm-yyyy', autoClose: true});
    });

    $(function (){
        $('#buscar').on("click", function(e) {
            let desde_ = $('#desde').val();
            let hasta_ = $('#hasta').val();
            e.preventDefault();
            $.ajax({
                url: '/reporte/ventas',
                type: 'GET',
                async: true,
                data: {
                    desde: desde_,
                    hasta: hasta_,
                    _token: $('input[name="_token"]').val()
                },
                success: function (response){
                    if(response!=0){
                        var datas = JSON.parse(response);
                        graficar_reporte(datas);
                    }else{
                        console.log('No se encontraron datos');
                    }
                },
                error: function (error){
                },
            })
        });
    });

    function graficar_reporte(datas) {
        var lienzo_ = document.getElementById("lienzo").getContext("2d");
        var dibujar_en_lienzo = new Chart(lienzo_,{
            type: "line",
            data: {
                labels: datas.map(item =>item.fecha),
                datasets:[{
                    label: 'ventas',
                    borderColor: 'green',
                    data:datas.map(item=>item.total_diario),
                }]
            },
            options: {
                title: {
                    display: true,
                },
                legend: {
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            //stepSize: 10
                        }
                    }],
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Dias'
                        }
                    }]
                }
            }
        });
    }

</script>
</body>
</html>
