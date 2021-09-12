@extends('layouts.admin')
@section('title','Edit Slot - Doctor')
@section('content')
@include('includes.banner',['one'=>'Doctor','two'=>'Edit Slot'])
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
                        <h4>Edit Slot</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Doctor</label>
                            <select required class="col-md-6 form-control" name="doctor_id" id="">
                                <option value="">Select Doctor</option>
                                @foreach ($doctors as $doctor)
                                <option @if ($appointmentSlot->doctor_id == $doctor->id) selected
                                    
                                @endif value="{{$doctor->id}}">{{$doctor->name}} - {{$doctor->doctorid}}</option>
                                @endforeach
                            </select>
                           
                        </div>

                        <div class="form-inline">
                            <label class="mr-2" for="">Start Time</label>
                            <input value="{{$appointmentSlot->start_time}}" required class="form-control mr-4" type="time" name="start_time" id="">

                            <label class="mr-2" for="">End Time</label>
                            <input value="{{$appointmentSlot->end_time}}" required class="form-control mr-4" type="time" name="end_time" id="">
                        </div>

                        <br><br>
                        <div class="form-group">
                            <label>Select Day</label>
                            <select required class="col-md-6 form-control" name="day" id="">
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
                    <div class="card-footer text-left">
                        <button class="btn btn-success mr-1" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
