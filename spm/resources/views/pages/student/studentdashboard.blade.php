@extends('layouts.app')

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
                <div class="d-flex flex-wrap align-items-center">
                        <h5 class="card-title">Number Of Achievements</h5>
                        <p class="card-text">{{ $cards->where('plo_percentage', '>', 40)->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-info">
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="card-title">Number Of Attempts</h5>
                    <p class="card-text">{{ $cards->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-success">
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="card-title mb-20">Success Rate</h5>
                    <p class="card-text">{{ floor(($cards->sum('plo_percentage')/($cards->count()*100)*100.00)) }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-danger">
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="card-title">Lowest PLO</h5>
                    <p class="card-text">{{ $lowest->ploID }}</p>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">
                <!-- <h2 class="h4 mb-20">Activity</h2> -->
                <!-- <div id="chart5"></div> -->
            </div>
        </div>
        <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">

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
