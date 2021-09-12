@extends('layouts.admin')
@section('title','Add Specialization')
@section('content')
@include('includes.banner',['one'=>'Specialization','two'=>'Create'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form  class="form-group" action="{{route('admin.specialization.store')}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Add Specialization</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Specialization Name</label>
                            <input value="{{old('name')}}" type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Priority</label>
                            <input value="{{old('priority')}}" type="number" class="form-control" name="priority" required>
                        </div>

                        <div class="form-group">
                            <label>Icon</label>
                            <input class="form-control" type="file" name="icon" accept="image/*" />
                        </div>


                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit" >Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
