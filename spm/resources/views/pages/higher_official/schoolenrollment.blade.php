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
        <a href="javascript:;" class="dropdown-toggle">
            <span class="micon dw dw-house-1"></span><span class="mtext">Enrollment</span>
        </a>
        <ul class="submenu">
            <li><a href="{{ '/schoolEnrollment/' . $higherO->employeeID . '/d' }}">School Enrollment</a></li>
            <li><a href="{{ '/departmentEnrollment/' . $higherO->employeeID . '/d' }}">Department Enrollment</a></li>
            <li><a href="{{ '/programEnrollment/' . $higherO->employeeID . '/d' }}">Program Enrollment</a></li>
        </ul>
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
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20 text-center">Enrollment</h2>
                <form action="{{ '/hse/' . $higherO->employeeID . '/d' }}" method="POST" class="d-flex">
                    @csrf
                    <label class="mb-20" for="startDate">Choose Starting Date</label>
                    <select class="form-select mb-20" aria-label="Default select example" id="startDate" name="startDate">
                        <option value="1">spring16</option>
                        <option value="2">summer16</option>
                        <option value="3">autumn16</option>
                        <option value="4">spring17</option>
                        <option value="5">summer17</option>
                        <option value="6">autumn17</option>
                        <option value="7">spring18</option>
                        <option value="8">summer18</option>
                        <option value="9">autumn18</option>
                        <option value="10">spring19</option>
                        <option value="11">summer19</option>
                    </select>
                    <label class="mb-20" for="endDate">Choose Ending Date</label>
                    <select class="form-select mb-20" aria-label="Default select example" id="endDate" name="endDate">
                        <option value="1">spring16</option>
                        <option value="2">summer16</option>
                        <option value="3">autumn16</option>
                        <option value="4">spring17</option>
                        <option value="5">summer17</option>
                        <option value="6">autumn17</option>
                        <option value="7">spring18</option>
                        <option value="8">summer18</option>
                        <option value="9">autumn18</option>
                        <option value="10">spring19</option>
                        <option value="11">summer19</option>
                    </select>
                    <label for="School">Choose Schools:</label>
                    <input type="checkbox" id="school1" name="school1" value="1">
                    <label for="school1">Engineering, Technology & Sciences</label><br>
                    <input type="checkbox" id="school2" name="school2" value="2">
                    <label for="school2">Business & Entrepreneurship</label><br>
                    {{-- <option value="3">Environment And Life Sciences</option>
                        <option value="4">Liberal Arts & Social Sciences</option>
                        <option value="5">Pharmacy And Public Health</option> --}}
                    <button class="btn btn-outline-success mb-20" type="submit">Show</button>
                </form>
                @if (session()->has('message'))
                    <div class="alert alert-danger">{{ session()->get('message') }}</div>
                @endif
                <div id="chart"></div>

            </div>
        </div>
    </div>

@endsection
