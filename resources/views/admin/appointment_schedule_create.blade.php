@extends('layouts.admin')
@section('title', 'Add Appoinment')
@section('content')
@include('includes.banner',['one'=>'Create','two'=>' Appoinment'])
<style>
    /* label.checkbox-inline {
                margin-right: 15px;
            } */
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/material_blue.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form class="form-group" action="{{ route('admin.appointment-schedule.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Create Appoinment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Doctor</label><br>
                            <select class="form-control col-md-6" id="doctor" name="doctor_id" required>
                                <option value="">--Select Doctor--</option>

                                @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}/{{ $doctor->doctorid }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Select User</label><br>
                            <select required name="user_id" class="form-control col-md-6" id="user">
                                <option value="">--Select User--</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}/{{ $user->userid }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Select Date</label>
                            <input required class="col-md-6 form-control" id="date1" name="date" type="date" data-input />
                        </div>

                        <div class="form-group">
                            <label>Select Appointment Slot</label>
                            <select required name="appointment_slot_id" class="form-control col-md-6" id="appointment-slot">
                                <option value="">--Select Appointment Slot--</option>
                            </select>
                        </div>


                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-success mr-1" type="submit" name="grant">Book Appointment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
        $('#doctor').select2();
    $('#user').select2();
</script> --}}
@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<script>
    var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
    arrDays = [];
    var objDays = {
        "Sun": 0,
        "Mon": 1,
        "Tue": 2,
        "Wed": 3,
        "Thu": 4,
        "Fri": 5,
        "Sat": 6,
    };


    $("#doctor").on('change', function() {
        var doctorId = this.value;
        $.get("{{ route('admin.appointment.slot.by.doctor.get.date') }}", {
            doctorId: doctorId
        }, function(data) {
            var set = new Set(data);
            var dateChecker = [...set];

            dateChecker.forEach(e => {
                arrDays.push(objDays[e]);
            });
            console.log(arrDays);

            $("#date1").flatpickr({
                minDate: "today",
                enableTime: false,
                dateFormat: "Y-m-d",
                "enable": [
                    function(date) {
                        return (arrDays.includes(date.getDay()))
                    }
                ],
                "locale": {
                    "firstDayOfWeek": 0 // set start day of week to Monday
                },
                onChange: function(selectedDates, dateStr, instance) {
                    var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                    var dayName = days[new Date(selectedDates).getDay()];
                    // console.log();
                    console.log(dayName);
                    $.get("{{ route('admin.appointment.slot.by.doctor') }}", {
                        doctorId: doctorId,
                        day: dayName
                    }, function(data) {
                        $("#appointment-slot").html(data);
                    });

                }
            });
        });
    });
    // $('#doctor').select2();
    // $('#user').select2();
</script>
@endsection
