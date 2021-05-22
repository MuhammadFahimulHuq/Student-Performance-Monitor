@extends('layouts.app')

@section('chart')
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawBasic);
    function drawBasic() {

    var stdplo = new google.visualization.DataTable();
    stdplo.addColumn('number', 'PLO');
    stdplo.addColumn('number', 'Success');
    stdplo.addRows(<?php echo $stdplo; ?>);

    var stdploO = {
    title: 'Student Wise PLO',
    hAxis: {
    title: 'PLO No`',
    },
    vAxis: {
        title: 'Success',
    },
    legend: {position: 'none'}
    };

    var dptplo = new google.visualization.DataTable();
    dptplo.addColumn('number', 'PLO');
    dptplo.addColumn('number', 'Success');
    dptplo.addRows(<?php echo $dptplo; ?>);

    var dptploO = {
    title: 'Department Wise PLO',
    hAxis: {
    title: 'PLO No`',
    },
    vAxis: {
        title: 'Success',
    },
    legend: {position: 'none'}
    };

    var ptplo = new google.visualization.DataTable();
    ptplo.addColumn('number', 'PLO');
    ptplo.addColumn('number', 'Success');
    ptplo.addRows(<?php echo $ptplo; ?>);

    var ptploO = {
    title: 'Program Wise PLO',
    hAxis: {
    title: 'PLO No`',
    },
    vAxis: {
        title: 'Success',
    },
    legend: {position: 'none'}
    };
    var chart = new google.visualization.ColumnChart(
    document.getElementById('chart_div3'));
    chart.draw(ptplo, ptploO);

    var chart = new google.visualization.ColumnChart(
    document.getElementById('chart_div1'));
    chart.draw(stdplo, stdploO);

    var chart = new google.visualization.ColumnChart(
    document.getElementById('chart_div2'));
    chart.draw(dptplo, dptploO);
    }

@endsection
@section('sidebar')
    <li class="dropdown">
        <a href="{{ '/studentD/' . $student->studentID . '/d' }}" class="dropdown-toggle">
            <span class="micon dw dw-house-1"></span><span class="mtext">Home</a></span>
        </a>
    </li>
    <li class="dropdown">
        <a href="{{ '/overallReport/' . $student->studentID . '/d' }}" class="dropdown-toggle">
            <span class="micon dw dw-library"></span><span class="mtext">Overall Report</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-warning">
                <div class="card-body">
                    <h5 class="card-title text-center">Number Of Achievements</h5>
                    <p class="card-text text-center">{{ $cards->where('plo_percentage', '>', 40)->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-info">
                <div class="card-body">
                    <h5 class="card-title text-center">Number Of Attempts</h5><br>
                        <p class="card-text text-center">{{ $cards->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-success">
                <div class="card-body">
                    <h5 class="card-title text-center">Success Rate</h5>
                    <p class="card-text text-center">{{ floor(($cards->sum('plo_percentage') / ($cards->count() * 100)) * 100.0) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-danger">
                <div class="card-body">
                    <h5 class="card-title text-center">PLO No</h5>
                    <p class="card-text text-center">{{ $lowest->ploID }}</p>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="row">
        <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">
                <div id="chart_div1"></div>
            </div>
        </div>
        <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">
                <div id="chart_div2"></div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
                <div id="chart_div3"></div>
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

    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
                <!-- <h2 class="h4 mb-20">Activity</h2> -->
                <!-- <div id="chart5"></div> -->
            </div>
        </div>
    </div>
@endsection
