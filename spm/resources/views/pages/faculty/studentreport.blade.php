@extends('layouts.app')

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
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="CourseID" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Show</button>
                    </form>
                </div>
                <!-- <h2 class="h4 mb-20">Activity</h2> -->
                <!-- <div id="chart5"></div> -->
            </div>
        </div>
    </div>
@endsection
