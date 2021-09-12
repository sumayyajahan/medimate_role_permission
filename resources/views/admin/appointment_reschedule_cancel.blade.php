@extends('layouts.admin')
@section('title','BULK Cancel Appointments')
@section('content')
@include('includes.banner',['one'=>'Appointments','two'=>'BULK Cancel'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Bulk Cancel Appointments</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableExport" class="table table-striped table-hover" id="" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Doctor</th>
                                    <th>User</th>
                                    <th>User Mobile</th>
                                    <th>Date / Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointmentSchedules as $appointmentSchedule)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$appointmentSchedule->doctor->name}}-({{$appointmentSchedule->doctor->doctorid}})
                                    </td>
                                    <td>{{$appointmentSchedule->user->name}}-({{$appointmentSchedule->user->userid}})
                                    </td>
                                    <td>{{$appointmentSchedule->user->mobile}} </td>
                                    <td>{{date('d M y',strtotime($appointmentSchedule->date))}}
                                        <br>
                                        {{date('h:i a',strtotime($appointmentSchedule->appointmentSlot->start_time))}} -
                                        {{date('h:i a',strtotime($appointmentSchedule->appointmentSlot->end_time))}}
                                    </td>



                                    <td class="d-flex justify-content-around">
                                        {{-- <a href="route('admin.appointment-schedule.show',$appointmentSchedule->id) ">
                                            <button class="m-1 btn btn-primary">View</button></a>
                                            <a target="_blank" href="{{route('admin.appointment-schedule.inform.reschedule',$appointmentSchedule->id)}}">
                                        <button class="m-1 btn btn-success">Informed</button></a>

                                        --}}
                                        <a
                                            href="{{route('admin.appointment-schedule.update.reschedule',$appointmentSchedule->id)}}">
                                            <button class="m-1 btn btn-white"><img src="/icons/edit.png" style="width:50px;"></button></a>

                                        <a
                                            href="{{route('admin.appointment-schedule.cancel.reschedule',$appointmentSchedule->id)}}">
                                            <button class="m-1 btn btn-white"><img src="/icons/confirm.png" style="width:50px;"></button></a>

                                        <a class="m-1 btn btn-white" href="#"
                                            onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$appointmentSchedule->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$appointmentSchedule->id}}"
                                            action="{{ route('admin.appointment-schedule.destroy',$appointmentSchedule->id) }}"
                                            method="POST" style="display: none;">
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
