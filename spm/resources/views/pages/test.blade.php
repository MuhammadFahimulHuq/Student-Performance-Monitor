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
    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    {{-- <link href="{{ asset('css/login.css') }}" rel="stylesheet"> --}}

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="{{ asset('js/charts.js') }}"></script>

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
    {{ $username }}
    <h1>SUCCESS</h1>
    {{-- <div id="chart_div"></div> --}}
    <button class="btn1">Plot chart!</button>
    <button class="btn2">Plot chart!</button>
    <div id="piechart" style="width: 900px; height: 500px;">The chart would be plotted here.</div>

</body>

</html>

{{-- @extends('layout.main')

//             @section('content')

//             <div class="row align-items-center pt-5">
//                 <div class="row">
//                     <div class="col-md-6 offset-md-3 pt-5">
//                         <h2>User login</h2>
//                         <div class="container pt-4">
//                             <form>

//                                 <div class="row mb-3">

//                                     <label for="inputusername3" class="col-sm-2 col-form-label col-form-label-lg">ID</label>
//                             <div class="col-sm-10">
//                                 <input type="number" class="form-control form-control-lg" id="inputusername3">
//                             </div>

//                         </div>



//                         <div class="row mb-3">

//                             <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">Password</label>
//                             <div class="col-sm-10">
//                                 <input type="password" class="form-control form-control-lg" id="inputPassword3">
//                             </div>

//     </div>

//     <div class="row mb-3">
//         <div class="form-group">

//             <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label col-form-label-lg">User type</label>
//             <select class="form-control" id="exampleFormControlSelect1">
//                 <option>Student</option>
//                 <option>Faculty</option>
//                 <option>Admin</option>

//             </select>
//         </div>

//     </div>


//     <button type="submit" class="btn btn-primary">Sign in</button>

// </form>

// </div>


// </div>

// </div>

// @endsection --}}
