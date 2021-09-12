@extends('layouts.admin')
@section('title','Add Appoinment - Users')
@section('content')
@include('includes.banner',['one'=>'Users','two'=>'Create Appoinment'])
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
            <form class="form-group" action="" method="POST" autocomplete="off">
                <input type="hidden" autocomplete="false">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Appoinment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select User</label>
                            <input list="user_id" class="col-md-6 form-control" name="user_id" autofocus required>
                            <datalist id="user_id">
                                <option value="User 1"> User 1</option>
                            </datalist>
                        </div>

                        <div class="form-group">
                            <label>Select Doctor</label>
                            <input list="doctor_id" class="col-md-6 form-control" name="doctor_id" required>
                            <datalist id="doctor_id">
                                <option value="Doctor 1"> Doctor 1 - ENT </option>
                                <option value="Doctor 2"> Doctor2 - Cardiology </option>
                            </datalist>
                        </div>

                        <div class="form-group">
                            <label>Select Date</label>
                            <input class="col-md-6 form-control" id="date1" placeholder="DD/MM/YYYY" data-input />
                        </div>

                        <div class="form-group">
                            <label>Select Timing Slot</label>
                            <select name="" class="form-control col-md-6" id="">
                                <option value="">Select Timing Slot</option>
                                <option value="">10:00 - 11:00</option>
                            </select>
                        </div>


                    </div>
                    <div class="card-footer text-left">
                        <button type=submit onclick="return false;" style="display:none;"></button>
                        <button class="btn btn-success mr-1" type="submit" name="grant">Book Appointment</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
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

@endsection
