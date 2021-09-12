<!-- Created by Ariful Islam at 6/6/2021 - 11:28 AM -->
@extends('layouts.admin')
@section('title','Edit Diagnostic Service')
@section('content')
    @include('includes.banner',['one'=>'Diagnostic','two'=>'Edit'])

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form class="form-group" action="{{route('admin.diagnostic.update',$content->id)}}" method="post"
                      enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Diagnostic Service</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Name</label>
                                <input value="{{ $content->name }}" type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input value="{{ $content->address }}" type="text" class="form-control" name="address" required>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input value="{{ $content->phone }}" type="text" class="form-control" name="phone" required>
                            </div>


                            <div class="form-group">
                                <label>Division</label>
                                <select name="district_id" id="" class="form-control">
                                    <option value="{{ $content->district_id }}">{{ $content->district->name }}</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>

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
