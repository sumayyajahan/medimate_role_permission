@extends('layouts.admin')
@section('title','Referral Point')
@section('content')
@include('includes.banner',['one'=>'Referral','two'=>'Point'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.referral.point.update',$referralPoint->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>Referral Point</h4>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label>User Refer To Point</label>
                            <input type="number" min="0" class="form-control" name="user_refer_to" value="{{$referralPoint->user_refer_to}}" required>
                        </div>
                        <div class="form-group">
                            <label>User Refer By Point</label>
                            <input type="number" min="0" class="form-control" name="user_refer_by" value="{{$referralPoint->user_refer_by}}" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Doctor Refer To Point</label>
                            <input type="number" min="0" class="form-control" name="doctor_refer_to" value="{{$referralPoint->doctor_refer_to}}" required>
                        </div>
                        <div class="form-group">
                            <label>Doctor Refer By Point</label>
                            <input type="number" min="0" class="form-control" name="doctor_refer_by" value="{{$referralPoint->doctor_refer_by}}" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Service Provider Refer To Point</label>
                            <input type="number" min="0" class="form-control" name="service_refer_to" value="{{$referralPoint->service_refer_to}}" required>
                        </div>
                        <div class="form-group">
                            <label>Service Provider Refer By Point</label>
                            <input type="number" min="0" class="form-control" name="service_refer_by" value="{{$referralPoint->service_refer_by}}" required>
                        </div>

                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Update</button>
                        {{-- <button class="btn btn-secondary" type="reset">Reset</button> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
