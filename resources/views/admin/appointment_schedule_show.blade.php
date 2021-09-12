@extends('layouts.admin')
@section('title','View Appoinment ')
@section('content')
@include('includes.banner',['one'=>'View','two'=>'Appoinment'])
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
            <form class="form-group" action="#" method="POST" autocomplete="off">
                <input type="hidden" autocomplete="false">
                <div class="card">
                    <div class="card-header">
                        <h4>View Appoinment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Doctor</label>
                            <input disabled required value="{{$appointmentSchedule->doctor->name}} - {{$appointmentSchedule->doctor->doctorid}}" class="col-md-6 form-control" id="" name="text"
                                type="text" data-input />
                        </div>

                        <div class="form-group">
                            <label>User</label>
                            <input disabled required value="{{$appointmentSchedule->user->name}} - {{$appointmentSchedule->user->userid}}"
                                class="col-md-6 form-control" id="" name="text" type="text" data-input />
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <input disabled required value="{{date('d M y',strtotime($appointmentSchedule->date))}}" class="col-md-6 form-control" id="" name="text" type="text" data-input />
                        </div>

                        <div class="form-group">
                            <label>Appointment Slot</label>
                            <input disabled required value="{{date('h:i a',strtotime($appointmentSchedule->appointmentSlot->start_time))}} - {{date('h:i a',strtotime($appointmentSchedule->appointmentSlot->end_time))}}""
                                class="col-md-6 form-control" id="" name="text" type="text" data-input />
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<script>
    $("#text1").flatpickr({
        enableTime: false,
        textFormat: "d-m-Y",
        "disable": [
            function(text) {
                return (text.getDay() === 2 || text.getDay() === 6); // disable weekends
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