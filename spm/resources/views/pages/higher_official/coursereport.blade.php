@extends('layouts.app')

@section('chart')

@endsection

@section('sidebar')
    <li class="dropdown">
        <a href="{{ '/HigherO/' . $higherO->employeeID . '/d' }}" class="dropdown-toggle">
            <span class="micon dw dw-house-1"></span><span class="mtext">Home</a></span>
        </a>
    </li>
    <li class="dropdown">
        <a href="{{ '/studentReportO/' . $higherO->employeeID . '/d' }}" class="dropdown-toggle">
            <span class="micon dw dw-list3"></span><span class="mtext">Student Report</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="{{ '/courseReportO/' . $higherO->employeeID . '/d' }}" class="dropdown-toggle">
            <span class="micon dw dw-invoice"></span><span class="mtext">Course Report</span>
        </a>
    </li>
@endsection

@section('content')
    <form action="{{ '/hcrO/' . $higherO->employeeID . '/d' }}" method="POST" class="d-flex">
        @csrf
        <label class="card-text mb-20" for="startDate">Choose Starting Date</label>
        <select class="form-select mb-20" aria-label="Default select example" id="startDate" name="startDate">
            <option value="12">autumn19</option>
            <option value="13">spring20</option>
            <option value="14">summer20</option>
            <option value="15">autumn20</option>
            <option value="16">spring21</option>
        </select>
        <label class="card-text mb-20" for="endDate">Choose Ending Date</label>
        <select class="form-select mb-20" aria-label="Default select example" id="endDate" name="endDate">
            <option value="12">autumn19</option>
            <option value="13">spring20</option>
            <option value="14">summer20</option>
            <option value="15">autumn20</option>
            <option value="16">spring21</option>
        </select>
        <label class="card-text mb-20" for="Course">Course</label>
        <select class="form-select mb-20" aria-label="Default select example" id="courseID" name="courseID">
            <option value="CSE201">CSE201</option>
            <option value="CSE203+L">CSE203+L</option>
            <option value="CSE204+L">CSE204+L</option>
            <option value="CSE210+L">CSE210+L</option>
            <option value="CSE303+L">CSE303+L</option>
            <option value="CSE307">CSE307</option>
            <option value="ACN201">ACN201</option>
            <option value="ACN202">ACN202</option>
            <option value="ACN301">ACN301</option>
            <option value="ACN302">ACN302</option>
            <option value="ACN305">ACN305</option>
            <option value="CSE214">CSE214</option>
            <option value="CSE309">CSE309</option>
            <option value="CSE216+L">CSE216+L</option>
            <option value="MIS102">MIS102</option>
            <option value="MIS340">MIS340</option>
            <option value="MIS341">MIS341</option>
        </select>
        <button class="btn btn-outline-success mb-20" type="submit">Show</button>
    </form>
    @if (session()->has('message'))
        <div class="alert alert-danger">{{ session()->get('message') }}</div>
    @endif
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
        <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">
                <div id="chart3"></div>
            </div>
        </div>
        <div class="col-xl-6 mb-30">
            <div class="card-box height-100-p pd-20">
                <div id="chart4"></div>
            </div>
        </div>
    </div>

@endsection
