<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title','Add App Notification')
@section('content')
    @include('includes.banner',['one'=>'App Notification','two'=>'Create'])

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form  class="form-group" action="{{route('admin.app-notify.store')}}" method="post"
                       enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Add App Notification</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Type</label>
                                <select name="can_access_app" id="can_access_app" class="form-control">
                                    <option value="1">Version Update</option>
                                    <option value="0">Notice</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Title</label>
                                <input value="{{old('title')}}" type="text" class="form-control" name="title" required>
                            </div>

                            <div class="form-group">
                                <label>Body</label>
                                <input value="{{old('body')}}" type="text" class="form-control" name="body" required>
                            </div>

                            <div class="form-group">
                                <label>Android Version (Build Number)</label>
                                <input value="{{ $android_build }}" type="text" class="form-control" name="build_number" required>
                            </div>

                            <div class="form-group">
                                <label>Apple Version (Build Number)</label>
                                <input value="{{ $apple_build }}" type="text" class="form-control" name="apple_build" required>
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
