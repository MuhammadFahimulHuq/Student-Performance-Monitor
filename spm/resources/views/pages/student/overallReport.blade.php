@extends('layouts.app')

@section('sidebar')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <span class="micon dw dw-house-1"></span><span class="mtext">Home</a></span>
        </a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle">
            <span class="micon dw dw-library"></span><span class="mtext">Overall Report</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20">PLO Achievements</h2>
                <!-- <div id="chart5"></div> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20">View CO and PLO earned in Course</h2>
                <button type="button" class="btn btn-primary btn-sm scroll-click">CSE203</button>
                <button type="button" class="btn btn-primary btn-sm scroll-click">CSE204</button>
                <button type="button" class="btn btn-primary btn-sm scroll-click">CSE201</button>
                <button type="button" class="btn btn-primary btn-sm scroll-click">CSE210</button>
                <button type="button" class="btn btn-primary btn-sm scroll-click">CSE214</button>
                <button type="button" class="btn btn-primary btn-sm scroll-click">CSE216</button>
                <button type="button" class="btn btn-primary btn-sm scroll-click">CSE307</button>
                <button type="button" class="btn btn-primary btn-sm scroll-click">CSE309</button>

                <!-- <div id="chart5"></div> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">
                <!-- <h2 class="h4 mb-20">Activity</h2> -->
                <!-- <div id="chart5"></div> -->
                {{-- {{dd(empty($users))}} --}}

                {{-- {{!empty($users)?$users:''}} --}}
            </div>
        </div>
        <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">
                <!-- <h2 class="h4 mb-20">Activity</h2> -->
                <!-- <div id="chart5"></div> -->
            </div>
        </div>
    </div>
@endsection
