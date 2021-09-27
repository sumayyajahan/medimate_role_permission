<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title','Update Permission')
@section('content')
   @include('includes.banner',['one'=>'Permissions','two'=>'Create'])

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form class="form-group" action="{{route('admin.permissions.update', $permission->id )}}" method="post"
                       enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Permission</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input value="{{ $permission->name }}" type="text" class="form-control" name="name" required>

                                <span class="badge badge-pill badge-success mt-3">
                                    @php
                                       use App\Models\Admin;
                                        $item = new Admin;
                                        $table = $item->getTable();
                                        print_r($table);
                                    @endphp
                                </span>
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
