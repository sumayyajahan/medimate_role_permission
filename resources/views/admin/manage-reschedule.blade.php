@extends('layouts.admin')
@section('title','View Appointment Reschedule Solutions')
@section('content')
@include('includes.banner',['one'=>'Appointment Reschedule Solutions','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Appointment Reschedule Solutions</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportFilter" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Doctor ID</th>
                                    <th>Name</th>
                                    <th>Appointment Date</th>
                                    <th>Appointment Slot</th>
                                    <th>Type</th>
                                    <th>Changed Date</th>
                                    <th>Changed Slot</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                      <td>User 1</td>
                                      <td>Doctor 1</td>
                                    <td>Test Name</td>
                                    <td>22/9/20</td>
                                    <td>01:00 - 3.00</td>
                                    <td>Reschedule</td>
                                    <td>23/9/20</td>
                                    <td>03:00</td>
                                </tr>
                                <tr>
                                      <td>User 1</td>
                                        <td>Doctor 1</td>
                                    <td>Test Name</td>
                                    <td>22/9/20</td>
                                    <td>01:00 - 3.00</td>
                                    <td>Reschedule</td>
                                    <td>23/9/20</td>
                                    <td>03:00</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
