<!-- Created by Ariful Islam at 6/6/2021 - 11:28 AM -->
@extends('layouts.admin')
@section('title','Edit App Notification')
@section('content')
    @include('includes.banner',['one'=>'App Notification','two'=>'Edit'])

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form class="form-group" action="{{route('admin.app-notify.update',$content->id)}}" method="post"
                      enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit App Notification</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Type</label>
                                <select name="can_access_app" id="can_access_app" class="form-control">
                                    <option value="1" {{ $content->can_access_app ==1?'selected':'' }}>Version Update</option>
                                    <option value="0" {{ $content->can_access_app ==0?'selected':'' }}>Notice</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Title</label>
                                <input value="{{ $content->title }}" type="text" class="form-control" name="title" required>
                            </div>

                            <div class="form-group">
                                <label>Body</label>
                                <input value="{{ $content->body }}" type="text" class="form-control" name="body" required>
                            </div>

                            <div class="form-group">
                                <label>Android Version (Build Number)</label>
                                <input value="{{ $content->build_number }}" type="text" class="form-control" name="build_number" required>
                            </div>

                            <div class="form-group">
                                <label>Apple Version (Build Number)</label>
                                <input value="{{ $content->apple_build }}" type="text" class="form-control" name="apple_build" required>
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
