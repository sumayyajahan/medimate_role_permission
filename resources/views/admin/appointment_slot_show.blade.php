@extends('layouts.admin')
@section('title','Show Slot - Doctor')
@section('content')
@include('includes.banner',['one'=>'Doctor','two'=>'Show Slot'])
<style>
    label.checkbox-inline {
        margin-right: 15px;
    }
</style>
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form class="form-group" action="{{route('admin.appointment-slot.update',$appointmentSlot->id)}}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <input type="hidden" autocomplete="false">
                <div class="card">
                    <div class="card-header">
                        <h4>Show Slot</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input disabled value="{{$appointmentSlot->doctor->name}}" type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Id</label>
                            <input disabled disabled value="{{$appointmentSlot->doctor->doctorid}}" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input disabled value="{{$appointmentSlot->doctor->mobile}}" type="text" class="form-control" name="mobile" minlength="11"
                                maxlength="11" value="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input disabled disabled value="{{$appointmentSlot->doctor->email}}" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-inline">
                            <label class="mr-2" for="">Start Time</label>
                            <input disabled value="{{$appointmentSlot->start_time}}" required class="form-control mr-4" type="time" name="start_time" id="">

                            <label class="mr-2" for="">End Time</label>
                            <input disabled value="{{$appointmentSlot->end_time}}" required class="form-control mr-4" type="time" name="end_time" id="">
                        </div>

                        <br><br>
                        <div class="form-group">
                            <label> Day</label>
                            <select disabled required class="col-md-6 form-control" name="day" id="">
                                <option value="{{$appointmentSlot->day}}">{{$appointmentSlot->day}}</option>
                                <option value="Sat">Sat</option>
                                <option value="Sun">Sun</option>
                                <option value="Mon">Mon</option>
                                <option value="Tue">Tue</option>
                                <option value="Wed">Wed</option>
                                <option value="Thu">Thu</option>
                                <option value="Fri">Fri</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
