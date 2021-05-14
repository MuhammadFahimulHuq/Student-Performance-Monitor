@extends('layouts.app')

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
                        {{-- <p class="card-text text-center">{{ $cards->where('plo_percentage', '>', 40)->count() }}</p> --}}

                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-info">
                    <div class="card-body">
                        <h5 class="card-title text-center">Number Of Section</h5>
                        {{-- <p class="card-text text-center">{{ $cards->where('plo_percentage', '>', 40)->count() }}</p> --}}

                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-success">
                    <div class="card-body">
                        <h5 class="card-title text-center">Success Rate</h5>
                        {{-- <p class="card-text text-center">{{ $cards->where('plo_percentage', '>', 40)->count() }}</p> --}}

                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1 bg-warning">
                    <div class="card-body">
                        <h5 class="card-title text-center">PLO Taught</h5>
                        {{-- <p class="card-text text-center">{{ $cards->where('plo_percentage', '>', 40)->count() }}</p> --}}

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
@endsection
