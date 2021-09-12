<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title','Add Lab Test')
@section('content')
    @include('includes.banner',['one'=>'Lab test','two'=>'Create'])

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form  class="form-group" action="{{route('admin.lab-test.store')}}" method="post"
                       enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Lab test</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Name</label>
                                <input value="{{old('name')}}" type="text" class="form-control" name="name" required>
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
