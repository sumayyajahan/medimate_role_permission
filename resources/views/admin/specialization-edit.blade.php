@extends('layouts.admin')
@section('title','Edit Specialization')
@section('content')
@include('includes.banner',['one'=>'Specialization','two'=>'Edit'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form class="form-group" action="{{route('admin.specialization.update',$specialization->id)}}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Specialization</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Specialization Name</label>
                            <input value="{{ $specialization->name }}" type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Priority</label>
                            <input value="{{ $specialization->priority }}" type="number" class="form-control" name="priority"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Icon</label>
                            <img src="{{ asset($specialization->icon) }}">
                            <br>
                            <input class="form-control" type="file" name="icon" accept="image/*" />
                        </div>


                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
