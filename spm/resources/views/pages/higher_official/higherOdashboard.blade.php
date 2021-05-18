@extends('layouts.app')

@section('chart')

@endsection

@section('sidebar')
    <li class="dropdown">
        <a href="{{'/HigherO/'.$higherO->employeeID.'/d'}}" class="dropdown-toggle">
            <span class="micon dw dw-house-1"></span><span class="mtext">Home</a></span>
        </a>
    </li>
    <li class="dropdown">
        <a href="{{'/studentReportO/'.$higherO->employeeID.'/d'}}" class="dropdown-toggle">
            <span class="micon dw dw-list3"></span><span class="mtext">Student Report</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="{{'/courseReportO/'.$higherO->employeeID.'/d'}}" class="dropdown-toggle">
            <span class="micon dw dw-invoice"></span><span class="mtext">Course Report</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20 text-center"></h2>

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
