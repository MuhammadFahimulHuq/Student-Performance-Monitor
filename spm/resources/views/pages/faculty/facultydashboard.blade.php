@extends('layouts.app')

@section('chart')
$(document).ready(function() {
    @foreach ($c1 as $c)
    $("#btn{{$c->id}}").click(function() {
        <?php unset($arr);$arr=array();
        foreach($p1 as $p){
            if($p->courseID==$c->courseID)
                array_push($arr,[$p->coNo,ceil($p->success)]);}?>;
    google.charts.load('current', {
        packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawBasic);
    function drawBasic() {
    var co = new google.visualization.DataTable();
    co.addColumn('number', 'CoNo');
    co.addColumn('number', 'Success');

    co.addRows(<?php echo json_encode($arr);?>);

    var co_options = {
        title: '{{$c->courseID}} CO Achievement',
        hAxis: {
            title: 'CoNo',
        },
        vAxis: {
            title: 'Success',
        },
        legend: {position: 'none'}
    };
    var chart = new google.visualization.ColumnChart(
        document.getElementById('chart1'));
    chart.draw(co, co_options);
    <?php unset($arr);$arr=array();
    foreach($p2 as $p){
        if($p->courseID==$c->courseID)
            array_push($arr,[$p->ploNo,ceil($p->success)]);}?>;

    var plo = new google.visualization.DataTable();
    plo.addColumn('number', 'ploNo');
    plo.addColumn('number', 'Success');
    plo.addRows(<?php echo json_encode($arr);?>);

    var plo_options = {
        title: '{{$c->courseID}} PLO Achievement',
        hAxis: {
            title: 'PLO No',
        },
        vAxis: {
            title: 'Success',
        },
        legend: {position: 'none'}
    };
    var chart = new google.visualization.ColumnChart(
        document.getElementById('chart2'));
    chart.draw(plo, plo_options);
    }
    });
    @endforeach
});
@endsection

@section('sidebar')
    <li class="dropdown">
        <a href="{{'/facultyD/'.$faculty->employeeID.'/d'}}" class="dropdown-toggle">
            <span class="micon dw dw-house-1"></span><span class="mtext">Home</a></span>
        </a>
    </li>
    <li class="dropdown">
        <a href="{{'/dataEntry/'.$faculty->employeeID.'/d'}}" class="dropdown-toggle">
            <span class="micon dw dw-edit2"></span><span class="mtext">Data Entry</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="{{'/studentReport/'.$faculty->employeeID.'/d'}}" class="dropdown-toggle">
            <span class="micon dw dw-list3"></span><span class="mtext">Student Report</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="{{'/courseReport/'.$faculty->employeeID.'/d'}}" class="dropdown-toggle">
            <span class="micon dw dw-invoice"></span><span class="mtext">Course Report</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title text-center">Number Of Cources</h5>
                        <p class="card-text text-center">{{ $c1->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-info">
                    <div class="card-body">
                        <h5 class="card-title text-center">Number Of Section</h5>
                        <p class="card-text text-center">{{ $c2->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-success">
                    <div class="card-body">
                        <h5 class="card-title text-center">Success Rate</h5>
                        <p class="card-text text-center">{{ ceil($c3->AVG('co_percentage')) }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-warning">
                    <div class="card-body">
                        <h5 class="card-title text-center">PLO Taught</h5>
                        <p class="card-text text-center">{{ $c4->count() }}</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20 text-center">View CO and PLO earned of Course</h2>
                @foreach ($c1 as $c)
                    <button type="button" class="btn btn-danger btn-sm scroll-click" id="btn{{ $c->id }}">{{ $c->courseID }}</button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">
                <div id="chart1"></div>
            </div>
        </div>
        <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">
                <div id="chart2"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
                <!-- <h2 class="h4 mb-20">Activity</h2> -->
                <!-- <div id="chart5"></div> -->
            </div>
        </div>
    </div>
@endsection
