@extends('layouts.admin')
@section('title','Edit Appoinment ')
@section('content')
@include('includes.banner',['one'=>'Edit','two'=>'Appoinment'])
<style>
    label.checkbox-inline {
        margin-right: 15px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/material_blue.css">

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form class="form-group" action="{{route('admin.appointment-schedule.update',$appointmentSchedule->id)}}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <input type="hidden" autocomplete="false">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Appoinment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Doctor</label>
                            <select required name="doctor_id" class="form-control col-md-6" id="doctor">
                                <option value="">--Select Doctor--</option>
                                @foreach ($doctors as $doctor)
                                <option @if ($doctor->id == $appointmentSchedule->doctor_id)
                                    selected                                    
                                @endif value="{{$doctor->id}}">{{$doctor->name}} - {{$doctor->doctorid}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Select User</label>
                            <select  required name="user_id" class="form-control col-md-6" id="">
                                <option value="">--Select User--</option>
                                @foreach ($users as $user)
                                <option @if ($user->id == $appointmentSchedule->user_id)
                                    selected                                    
                                @endif value="{{$user->id}}">{{$user->name}} - {{$user->userid}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Select Date</label>
                            <input required value="{{$appointmentSchedule->date}}" class="col-md-6 form-control" id="" name="date" type="date" data-input />
                        </div>

                        <div class="form-group">
                            <label>Select Appointment Slot</label>
                            <select required name="appointment_slot_id" class="form-control col-md-6"
                                id="appointment-slot">
                                <option value="">--Select Appointment Slot--</option>
                            </select>
                        </div>


                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-success mr-1" type="submit" name="grant">Update Appointment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<script>
    $("#date1").flatpickr({
        enableTime: false,
        dateFormat: "d-m-Y",
        "disable": [
            function(date) {
                return (date.getDay() === 2 || date.getDay() === 6); // disable weekends
            }
        ],
        "locale": {
            "firstDayOfWeek": 0 // set start day of week to Monday
        }
    });

</script>

@section('script')
<script>
    $(document).ready(function(){
        $.get("{{route('admin.appointment.slot.by.doctor')}}",{doctorId:{{$appointmentSchedule->doctor_id}}},function(data){
            $("#appointment-slot").html(data);
        });
        $("#doctor").on('change',function(){
            var doctorId = this.value;
            $.get("{{route('admin.appointment.slot.by.doctor')}}",{doctorId:doctorId},function(data){
            $("#appointment-slot").html(data);
            });
        });
    });
</script>
@endsection

@endsection