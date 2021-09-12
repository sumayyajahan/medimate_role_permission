@extends('layouts.admin')
@section('title','Frequent Doctor')
@section('content')
@include('includes.banner',['one'=>'Frequent Doctor','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Most Frequent Doctor</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportReport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Doctor's ID</th>
                                    <th>Doctor's Name</th>
                                    <th>Upcoming Appointment </th>
                                    <th>Successful Appointment</th>
                                    <th>Canceled / Rescheduled Appointment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                <tr>
                                    <td> {{$loop->index+1}} </td>
                                    <td> {{$log->doctorid}} </td>
                                    <td> {{$log->name}} </td>
                                    <td> {{$log->appointment_schedule_up_count}} </td>
                                    <td> {{$log->appointment_schedule_old_count}} </td>
                                    <td> {{$log->appointment_schedule_canceled_count}} </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
