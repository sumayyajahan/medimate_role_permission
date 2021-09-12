@extends('layouts.admin')
@section('title','Add Slot - Doctor')
@section('content')
@include('includes.banner',['one'=>'Doctor','two'=>'Create Slot'])
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    label.checkbox-inline {
        margin-right: 15px;
    }
</style>
<div class="section-body">
    <div class="row">
        <div class="col-7 col-md-7 col-lg-7">
            <form class="form-group" action="{{route('admin.appointment-slot.store')}}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" autocomplete="false">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Slot</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Doctor</label>
                            <select required class="col-md-6 form-control" name="doctor_id" id="doctor_id">
                                <option value="">Select Doctor</option>
                                @foreach ($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->name}} / {{$doctor->mobile}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-inline">
                            <label class="mr-2" for="">Start Time</label>
                            <input required class="form-control mr-4" type="time" name="start_time" id="">

                            <label class="mr-2" for="">End Time</label>
                            <input required class="form-control mr-4" type="time" name="end_time" id="">
                        </div>

                        <br><br>
                        <div class="form-group">
                            <label>Select Day</label>
                            <select required class="col-md-6 form-control" multiple name="day[]" id="day">
                                <option value="Sat">Saturday</option>
                                <option value="Sun">Sunday</option>
                                <option value="Mon">Monday</option>
                                <option value="Tue">Tuesday</option>
                                <option value="Wed">Wednesday</option>
                                <option value="Thu">Thursday</option>
                                <option value="Fri">Friday</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-success mr-1" type="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="appT" class="col-md-5 bg-white">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td> Day </td>
                        <td>Start Time</td>
                        <td>End Time</td>
                    </tr>
                </thead>
                <tbody id="putslot"></tbody>

            </table>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $('#appT').hide();
    $("#doctor_id").select2();
    $("#day").select2();

    $('#doctor_id').on("change", function(e) {
        $('#putslot').html('');
        var val = $(this).val();
        $.get("/rt-admin/getDSlot/" + val, function(data, status) {
            for (let index = 0; index < data.length; index++) {

                var elem = `
                <tr>
                <td>${data[index].day}</td>
                <td>${data[index].start_time}</td>
                <td>${data[index].end_time}</td>
                </tr>
                `;

                $('#putslot').append(elem);
                $('#appT').show();


            }
        });
    });
</script>
@endsection
