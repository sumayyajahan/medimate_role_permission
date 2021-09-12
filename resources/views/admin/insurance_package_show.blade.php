@extends('layouts.admin')
@section('title','View Package')
@section('content')
@include('includes.banner',['one'=>'Package','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.insurance-package.update',$insurancePackage->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>View Package</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label> Insurance Company</label>
                            <input disabled value="{{\App\Models\Insurance::get_name_by_id($insurancePackage->insurance_id)}}" type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Package Type</label>
                            <input disabled value="{{ $insurancePackage->type}}" type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Package Name</label>
                            <input disabled value="{{$insurancePackage->name}}" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input disabled value="{{$insurancePackage->amount}}" type="number" class="form-control" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label>Package Duration</label>
                            <input disabled value="{{$insurancePackage->duration}} Month" type="text" class="form-control" min="1" name="duration" required>
                        </div>

                        <div class="form-group">
                            <label>Video Consultation per Month</label>
                            <input disabled value="{{$insurancePackage->video_call}}" type="number" class="form-control" name="video_call" required>
                        </div>

                        <div class="form-group">
                            <label>Diagnostic Discount %</label>
                            <input disabled value="{{$insurancePackage->diagnostic_discount }}" type="number" class="form-control" name="diagnostic_discount">
                        </div>

                        <div class="form-group">
                            <label>Hospital Discount %</label>
                            <input disabled value="{{$insurancePackage->hospital_discount }}" type="number" class="form-control" name="hospital_discount">
                        </div>

                        <div class="form-group">
                            <label>Life (GT) Coverage</label>
                            <input disabled value="{{$insurancePackage->insurance }}" type="number" class="form-control" name="insurance">
                        </div>

                        <div class="form-group">
                            <label>Emergency Medical Care Yearly Coverage</label>
                            <input disabled value="{{$insurancePackage->emergency_medical }}" type="number" class="form-control" name="emergency_medical">
                        </div>

                        <div class="form-group">
                            <label>Hospitalization in a year</label>
                            <input disabled value="{{$insurancePackage->hospitalization }}" type="number" class="form-control" name="hospitalization">
                        </div>


                        <div class="form-group">
                            <label>Accidental death coverage</label>
                            <input disabled value="{{$insurancePackage->accidental_death }}" type="text" class="form-control" name="accidental_death">
                        </div>

                        <div class="form-group">
                            <label>Terms of insurance url</label>
                            <input disabled value="{{$insurancePackage->terms_url }}" type="text" class="form-control" name="terms_url">
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
