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
            <div class="col-xl-5 d-flex justify-content-center">
                <form action="{{'/hcrO/'.$higherO->employeeID.'/d'}}" method="POST" class="d-flex">
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

@endsection
