@extends('layouts.admin')
@section('title','Reschedule Request')
@section('content')
@include('includes.banner',['one'=>'Appointment Reschedule Request','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Appointment Reschedule Solutions</h4>
                </div>
                <div class="card-body">
                    <label for="">Select Doctor`s Request</label>
                    <select class="form-control col-md-6" name="" id="">
                        <option value="">Doctor 1 </option>
                        <option value="">Doctor 2 </option>
                    </select>
                     <button class="mt-1 form-control col-md-1 btn btn-success">Load <i class="fas fa-chevron-circle-right"></i></button>
                    <div class="p-2"></div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportFilter" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Appointment Date</th>
                                    <th>Appointment Slot</th>
                                    <th>Type</th>
                                    <th>Changed Date</th>
                                    <th>Changed Slot</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>User 1</td>
                                    <td>Test Name</td>
                                    <td>22/9/20</td>
                                    <td>01:00 - 3.00</td>
                                    <td>Reschedule</td>
                                    <td>23/9/20</td>
                                    <td>03:00</td>
                                    <td>
                                        <button class="btn btn-success">Proceed <i class="fas fa-chevron-circle-right"></i></button>
                                        <button class="btn btn-danger">Cancel <i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                   <td>User 2</td>
                                    <td>Test Name2</td>
                                    <td>12/9/20</td>
                                    <td>01:00 - 3.00</td>
                                    <td>Cancel</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td> <button class="btn btn-success">Proceed <i class="fas fa-chevron-circle-right"></i></button> </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
