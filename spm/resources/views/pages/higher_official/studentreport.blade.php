@extends('layouts.app')


@section('chart')
    @if ($cID != null)
        $(document).ready(function() {
        @foreach ($courses as $c)
            $("#btn{{ $c->id }}").click(function() {
            <?php
            unset($arr);
            $arr = [];
            foreach ($p1 as $p) {
            if ($p->courseID == $c->courseID) {
            array_push($arr, [$p->coNo, ceil($p->co_percentage)]);
            }
            }
            ?>;
            google.charts.load('current', {
            packages: ['corechart', 'bar']
            });
            google.charts.setOnLoadCallback(drawBasic);
            function drawBasic() {
            var co = new google.visualization.DataTable();
            co.addColumn('number', 'CoNo');
            co.addColumn('number', 'Success');

            co.addRows(<?php echo json_encode($arr); ?>);

            var co_options = {
            title: '{{ $c->courseID }} CO Achievement',
            hAxis: {
            title: 'CoNo',
            },
            vAxis: {
            title: 'Success',
            },
            legend: {position: 'none'}
            };
            var chart = new google.visualization.ColumnChart(
            document.getElementById('chart1'));
            chart.draw(co, co_options);
            <?php
            unset($arr);
            $arr = [];
            foreach ($p2 as $p) {
            if ($p->courseID == $c->courseID) {
            array_push($arr, [$p->ploNo, ceil($p->success)]);
            }
            }
            ?>;

            var plo = new google.visualization.DataTable();
            plo.addColumn('number', 'ploNo');
            plo.addColumn('number', 'Success');
            plo.addRows(<?php echo json_encode($arr); ?>);

            var plo_options = {
            title: '{{ $c->courseID }} PLO Achievement',
            hAxis: {
            title: 'PLO No',
            },
            vAxis: {
            title: 'Success',
            },
            legend: {position: 'none'}
            };
            var chart = new google.visualization.ColumnChart(
            document.getElementById('chart2'));
            chart.draw(plo, plo_options);
            }
            });
        @endforeach
        });
    @endif
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
                <div class="col-xl-5 d-flex justify-content-center">
                    <form action="{{ '/hsrO/' . $higherO->employeeID . '/d' }}" method="POST" class="d-flex">
                        @csrf
                        <input name="tsID" class="form-control me-2" type="text" required placeholder="Student ID"
                            aria-label="Search" id="tsID">
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
        <div class="col-xl-12 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20">View CO and PLO earned in Course</h2>
                @if ($cID != null)
                    @foreach ($courses as $c)
                        <button type="button" class="btn btn-warning btn-sm scroll-click"
                            id="btn{{ $c->id }}">{{ $c->courseID }}</button>
                    @endforeach
                @endif
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
@endsection
