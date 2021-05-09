<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".btn1").click(function() {

                google.load("visualization", "1", {
                    packages: ["corechart"],
                    "callback": drawChart
                });
                google.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Work', 11],
                        ['Eat', 2],
                        ['Commute', 2],
                        ['Watch TV', 2],
                        ['Sleep', 7]
                    ]);
                    var options = {
                        chartArea: {
                            width: '100%',
                            height: '100%'
                        },
                        forceIFrame: 'false',
                        is3D: 'true',
                        pieSliceText: 'value',
                        sliceVisibilityThreshold: 1 / 20, // Only > 5% will be shown.
                        titlePosition: 'none'
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                }
            });
            $(".btn2").click(function() {

                google.load("visualization", "1", {
                    packages: ["corechart"],
                    "callback": drawChart
                });
                google.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Work', 1],
                        ['Eat', 2],
                        ['Commute', 2],
                        ['Watch TV', 2],
                        ['Sleep', 7]
                    ]);
                    var options = {
                        chartArea: {
                            width: '100%',
                            height: '100%'
                        },
                        forceIFrame: 'false',
                        is3D: 'true',
                        pieSliceText: 'value',
                        sliceVisibilityThreshold: 1 / 20, // Only > 5% will be shown.
                        titlePosition: 'none'
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                }
            });
        });
    </script>



</head>

<body>
    <h1>SUCCESS</h1>
    {{-- <div id="chart_div"></div> --}}
    <button class="btn1">Plot chart!</button>
    <button class="btn2">Plot chart!</button>
    <div id="piechart" style="width: 900px; height: 500px;"></div>

</body>

</html>
