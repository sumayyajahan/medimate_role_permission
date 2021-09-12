@extends('layouts.admin')
@section('title','Add Slot - Doctor')
@section('content')
@include('includes.banner',['one'=>'Doctor','two'=>'Create Slot'])
<style>
    label.checkbox-inline {
        margin-right: 15px;
    }
</style>
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form class="form-group" action="add-savings.php" method="POST" autocomplete="off">
                <input type="hidden" autocomplete="false">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Slot</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Doctor</label>
                            <input list="user_id" class="col-md-6 form-control" name="user_id" autofocus required>
                            <datalist id="user_id">
                                <option value="Doctor 1"> Doctor 1</option>
                            </datalist>
                        </div>

                        <div class="form-inline">
                            <label class="mr-2" for="">Start Time</label>
                            <input class="form-control mr-4" type="time" name="" id="">

                            <label class="mr-2" for="">End Time</label>
                            <input class="form-control mr-4" type="time" name="" id="">
                        </div>

                        <br><br>
                        <label for="">Days</label>
                        <div class="form-group ">
                            <label class="checkbox-inline">
                                <input type="checkbox" value=""> Sunday
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value=""> Monday
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value=""> Tuesday
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value=""> Wednesday
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value=""> Thursday
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value=""> Friday
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" value=""> Saturday
                            </label>
                        </div>

                    </div>
                    <div class="card-footer text-left">
                        <button type=submit onclick="return false;" style="display:none;"></button>
                        <button class="btn btn-success mr-1" type="submit" name="grant">Add</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
