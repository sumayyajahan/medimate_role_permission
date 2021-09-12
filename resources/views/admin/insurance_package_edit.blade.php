@extends('layouts.admin')
@section('title','Edit Package')
@section('content')
@include('includes.banner',['one'=>'Package','two'=>'Edit'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group"
                action="{{route('admin.insurance-package.update',$insurancePackage->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Package</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Select Insurance Company</label>
                            <select class="form-control" required name="insurance_id" id="">
                                <option value="">Select Insurance Company</option>
                                @foreach ($insurances as $insurance)
                                <option @if ($insurance->id == $insurancePackage->insurance_id)
                                    selected
                                    @endif value="{{$insurance->id}}">{{$insurance->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Package Type</label>
                            <select name="type" id="type" class="form-control">
                                <option @if ($insurancePackage->type == "Family Package") selected @endif value="Family Package">Family Package</option>
                                <option @if ($insurancePackage->type == "Video Call Package") selected @endif value="Video Call Package">Video Call Package</option>
                                <option @if ($insurancePackage->type == "Health Insurance") selected @endif value="Health Insurance">Health Insurance</option>
                                <option @if ($insurancePackage->type == "Pregnancy Package") selected @endif value="Pregnancy Package">Pregnancy Package</option>
                                <option @if ($insurancePackage->type == "Accidental Package") selected @endif value="Accidental Package">Accidental Package</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Package Name</label>
                            <input value="{{$insurancePackage->name}}" type="text" class="form-control" name="name"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input value="{{$insurancePackage->amount}}" type="number" class="form-control"
                                name="amount" required>
                        </div>
                        <div class="form-group">
                            <label>Package Duration</label>
                            <input value="{{$insurancePackage->duration}}" type="number" class="form-control" min="1"
                                name="duration" required>
                        </div>

                        <div class="form-group">
                            <label>Video Consultation per Month</label>
                            <input value="{{$insurancePackage->video_call}}" type="number" class="form-control" name="video_call" required>
                        </div>

                        <div class="form-group">
                            <label>Diagnostic Discount %</label>
                            <input value="{{$insurancePackage->diagnostic_discount }}" type="number" class="form-control" name="diagnostic_discount">
                        </div>

                        <div class="form-group">
                            <label>Hospital Discount %</label>
                            <input value="{{$insurancePackage->hospital_discount }}" type="number" class="form-control" name="hospital_discount">
                        </div>

                        <div class="form-group">
                            <label>Life (GT) Coverage</label>
                            <input value="{{$insurancePackage->insurance }}" type="number" class="form-control" name="insurance">
                        </div>

                        <div class="form-group">
                            <label>Emergency Medical Care Yearly Coverage</label>
                            <input value="{{$insurancePackage->emergency_medical }}" type="number" class="form-control" name="emergency_medical">
                        </div>

                        <div class="form-group">
                            <label>Hospitalization in a year</label>
                            <input value="{{$insurancePackage->hospitalization }}" type="number" class="form-control" name="hospitalization">
                        </div>

                        <div class="form-group">
                            <label>Accidental death coverage</label>
                            <input value="{{$insurancePackage->accidental_death }}" type="text" class="form-control" name="accidental_death">
                        </div>

                        <div class="form-group">
                            <label>Terms of insurance url</label>
                            <input value="{{$insurancePackage->terms_url }}" type="text" class="form-control" name="terms_url">
                        </div>


                        <div class="form-group">
                            <label>Max Points per video call</label>
                            <input value="{{$insurancePackage->point_per_call }}" type="text" class="form-control" name="point_per_call">
                        </div>


                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
