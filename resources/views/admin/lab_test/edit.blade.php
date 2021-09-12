<!-- Created by Ariful Islam at 6/6/2021 - 11:28 AM -->
@extends('layouts.admin')
@section('title','Edit Lab Test')
@section('content')
    @include('includes.banner',['one'=>'Lab Test','two'=>'Edit'])

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form class="form-group" action="{{route('admin.lab-test.update',$content->id)}}" method="post"
                      enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Pet Service</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Name</label>
                                <input value="{{ $content->name }}" type="text" class="form-control" name="name" required>
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
