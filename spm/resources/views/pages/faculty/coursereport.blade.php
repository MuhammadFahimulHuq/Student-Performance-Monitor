@extends('layouts.app')

@section('chart')
@if($c1!=NULL) <?php $flag=true; ?> @endif
@if($cID != NULL)
<?php unset($arr);$arr=array();
        foreach($c2 as $p){
            if($p->courseID==$cID)
            array_push($arr,[$p->coNo,ceil($p->success)]);
            }?>;
    google.charts.load('current', {
        packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawBasic);
    function drawBasic() {
    var c2 = new google.visualization.DataTable();
    c2.addColumn('number', 'CoNo');
    c2.addColumn('number', 'Success');
    c2.addRows(<?php echo json_encode($arr);?>);
    var c2_options = {
        title: 'All Instructor {{$cID}} CO Achievement',
        hAxis: {
            title: 'CoNo',
        },
        vAxis: {
            title: 'Success',
        },
        legend: {position: 'none'}
    };
    var chart = new google.visualization.ColumnChart(
        document.getElementById('chart2'));
    chart.draw(c2, c2_options);

<?php unset($arr);$arr=array();
if($flag){
foreach($c1 as $p){
    if($p->courseID==$cID)
    array_push($arr,[$p->coNo,ceil($p->success)]);
    }}?>;
    var c1 = new google.visualization.DataTable();
    c1.addColumn('number', 'CoNo');
    c1.addColumn('number', 'Success');
    c1.addRows(<?php echo json_encode($arr);?>);
    var c1_options = {
        title: 'Faculty {{$cID}} CO Achievement',
        hAxis: {
            title: 'CoNo',
        },
        vAxis: {
            title: 'Success',
        },
        legend: {position: 'none'}
    };
    @if($flag)
    var chart = new google.visualization.ColumnChart(
        document.getElementById('chart1'));
    chart.draw(c1, c1_options);
    @endif

<?php unset($arr);$arr=array();
if($flag){
foreach($c3 as $p){
    if($p->courseID==$cID)
    array_push($arr,[$p->ploNo,ceil($p->success)]);
    }}?>;
    var c3 = new google.visualization.DataTable();
    c3.addColumn('number', 'CoNo');
    c3.addColumn('number', 'Success');
    c3.addRows(<?php echo json_encode($arr);?>);
    var c3_options = {
        title: 'Faculty {{$cID}} PLO Achievement',
        hAxis: {
            title: 'PLO No',
        },
        vAxis: {
            title: 'Success',
        },
        legend: {position: 'none'}
    };
    @if($flag)
    var chart = new google.visualization.ColumnChart(
        document.getElementById('chart3'));
    chart.draw(c3, c3_options);
    @endif
    <?php unset($arr);$arr=array();
    foreach($c4 as $p){
        if($p->courseID==$cID)
        array_push($arr,[$p->ploNo,ceil($p->success)]);
        }?>;
        var c4 = new google.visualization.DataTable();
        c4.addColumn('number', 'CoNo');
        c4.addColumn('number', 'Success');
        c4.addRows(<?php echo json_encode($arr);?>);
        var c4_options = {
            title: 'All Instructor {{$cID}} PLO Achievement',
            hAxis: {
                title: 'PLO No',
            },
            vAxis: {
                title: 'Success',
            },
            legend: {position: 'none'}
        };
        var chart = new google.visualization.ColumnChart(
            document.getElementById('chart4'));
        chart.draw(c4, c4_options);
    }
@endif
@endsection

@section('sidebar')
    <li class="dropdown">
        <a href="{{ '/facultyD/' . $faculty->employeeID . '/d' }}" class="dropdown-toggle">
            <span class="micon dw dw-house-1"></span><span class="mtext">Home</a></span>
        </a>
    </li>
    <li class="dropdown">
        <a href="{{ '/dataEntry/' . $faculty->employeeID . '/d' }}" class="dropdown-toggle">
            <span class="micon dw dw-edit2"></span><span class="mtext">Data Entry</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="{{ '/studentReport/' . $faculty->employeeID . '/d' }}" class="dropdown-toggle">
            <span class="micon dw dw-list3"></span><span class="mtext">Student Report</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="{{ '/courseReport/' . $faculty->employeeID . '/d' }}" class="dropdown-toggle">
            <span class="micon dw dw-invoice"></span><span class="mtext">Course Report</span>
        </a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card-box height-100-p pd-20">
            <div class="col-xl-5 d-flex justify-content-center">
                <form action="{{'/hcr/'.$faculty->employeeID.'/d'}}" method="POST" class="d-flex">
                    @csrf
                    <input name="tcID" class="form-control me-2" type="text" required placeholder="Course ID" aria-label="Search" id="tcID">
                    <button class="btn btn-outline-success" type="submit">Show</button>
                </form>
            </div>
        </div>
    </div>
</div>
@if (session()->has('message'))
<div class="alert alert-danger">{{ session()->get('message') }}</div>
@endif
<div class="row">
    <div class="col-xl-6 mb-30">
        <div class="card-box height-100-p pd-20">
            <div id="chart1"></div>
            <div id="no-Data1">No-data</div>
        </div>
    </div>
    <div class="col-xl-6 mb-30">
        <div class="card-box height-100-p pd-20">
            <div id="chart2"></div>
            <div id="no-Data2">No-data</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 mb-30">
        <div class="card-box height-100-p pd-20">
            <div id="chart3"></div>
            <div id="no-Data3">No-data</div>
        </div>
    </div>
    <div class="col-xl-6 mb-30">
        <div class="card-box height-100-p pd-20">
            <div id="no-Data4">No-data</div>
            <div id="chart4"></div>
        </div>
    </div>
</div>
<script>
@if($c1 != NULL)
    document.getElementById("no-Data1").innerHTML = "";
@endif
@if($c2 != NULL)
    document.getElementById("no-Data2").innerHTML = "";
@endif
@if($c3 != NULL)
    document.getElementById("no-Data3").innerHTML = "";
@endif
@if($c4 != NULL)
    document.getElementById("no-Data4").innerHTML = "";
@endif
</script>

@endsection
