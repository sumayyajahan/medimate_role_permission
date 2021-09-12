@extends('layouts.admin')
@section('title','Appointments')
@section('content')
@include('includes.banner',['one'=>'Appointments','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Manage Appointments</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableExport" class="table table-striped table-hover" id="" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Doctor</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointmentSchedules as $appointmentSchedule)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$appointmentSchedule->doctor->name}}-({{$appointmentSchedule->doctor->mobile}})
                                    </td>
                                    <td>{{$appointmentSchedule->user->name}}-({{$appointmentSchedule->user->mobile}})
                                    </td>
                                    <td>{{date('d M y',strtotime($appointmentSchedule->date))}}</td>
                                    <td>{{date('h:i a',strtotime($appointmentSchedule->appointmentSlot->start_time))}} -
                                        {{date('h:i a',strtotime($appointmentSchedule->appointmentSlot->end_time))}}
                                    </td>

                                    <td>
                                        @if ($appointmentSchedule->active == 1 && $appointmentSchedule->consult == 0)
                                        Active
                                        @elseif ($appointmentSchedule->active == 0 && $appointmentSchedule->consult ==
                                        0)
                                        Cancel
                                        @elseif ($appointmentSchedule->active == 0 && $appointmentSchedule->consult ==
                                        1)
                                        Meeting Done
                                        @endif

                                        @if ($appointmentSchedule->reschedule == 1)
                                        , Reschedule Request
                                        @endif

                                    </td>

                                    <td class="d-flex justify-content-around">
                                        <a href="{{route('admin.appointment-schedule.show',$appointmentSchedule->id)}}">
                                            <button class="m-1 btn btn-white"><img src="/icons/view.png" style="width:50px;"></button></a>
                                        <!-- <a href="{{route('admin.appointment-schedule.edit',$appointmentSchedule->id)}}">
                                            <button class="m-1 btn btn-white"><img src="/icons/edit.png" style="width:50px;"></button></a> -->

                                        <a class="m-1 btn btn-white" href="#" onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$appointmentSchedule->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$appointmentSchedule->id}}" action="{{ route('admin.appointment-schedule.destroy',$appointmentSchedule->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
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
