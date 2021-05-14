@extends('layouts.app')

@section('chart')
$(document).ready(function() {
    @foreach ($courses as $c)
    $("#btn{{$c->id}}").click(function() {
        <?php unset($arr);$arr=array();
        foreach($p1 as $p){
            if($p->courseID==$c->courseID)
                array_push($arr,[$p->coNo,ceil($p->co_percentage)]);}?>;
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
            array_push($arr,[$p->ploID,ceil($p->success)]);}?>;

    var plo = new google.visualization.DataTable();
    plo.addColumn('number', 'ploNo');
    plo.addColumn('number', 'Success');
    plo.addRows(<?php echo json_encode($arr);?>);

    var plo_options = {
        title: '{{$c->courseID}} PLO Achievement',
        hAxis: {
            title: 'PLO',
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
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20">PLO Achievements</h2>
                <table class="table table-responsive">
                    <tr>
                        <th>Course</th>
                        @foreach ($plos as $p)
                            <th>ploNo{{ $p->ploID }}</th>
                        @endforeach
                    </tr>
                    @foreach ($courses as $c)
                        <tr>
                            <th>{{ $c->courseID }}</th>
                            @foreach ($success as $s)
                                @if ($c->courseID == $s->courseID)
                                {{-- //FIX:: --}}
                                    <th>{{ empty($s->success) ? : ceil($s->success) }}</th>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20">View CO and PLO earned in Course</h2>
                @foreach ($courses as $c)
                    <button type="button" class="btn btn-warning btn-sm scroll-click" id="btn{{ $c->id }}">{{ $c->courseID }}</button>
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
@endsection
