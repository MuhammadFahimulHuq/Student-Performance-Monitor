@extends('layouts.app')

@section('sidebar')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <span class="micon dw dw-house-1"></span><span class="mtext">Home</a></span>
        </a>
    </li>
    <li class="dropdown">
        @foreach ($users as $user)
        <a href="{{'/overallReport/'.$user->user_id.'/d'}}" class="dropdown-toggle">
            <span class="micon dw dw-library"></span><span class="mtext">Overall Report</span>
        </a>
        @endforeach

    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">

                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">

                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">

                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">

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
