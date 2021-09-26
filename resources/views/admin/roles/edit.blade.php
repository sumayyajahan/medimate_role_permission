<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title','Update Role')
@section('content')
   @include('includes.banner',['one'=>'Roles','two'=>'Create'])

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            <h4>Update Role</h4>
                        </div>
                        <div class="card-body">
                          <form action="{{ route('admin.roles.update', $role->id) }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Name</label>
                                <input value="{{ $role->name }}" type="text" class="form-control" name="name" required>

                            </div>
                            <div class="card-footer text-left">
                                <button class="btn btn-primary mr-1" type="submit">Update</button>
                            </div>
                         </form>
                        </div>

                    </div>

            </div>
        </div>
    </div>
@endsection
