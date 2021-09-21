<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title', 'Add Role')
@section('content')
    @include('includes.banner',['one'=>'Assign Permissions to role','two'=>'Create'])

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form class="form-group" action="{{ url('rt-admin/storePermissionToRole') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Assign Permissions to a Role</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Select Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="">-select roles-</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="checkAll" autofocus>
                                <label class="custom-control-label" for="checkAll">Check All</label>
                            </div>

                            @foreach ($permissions as $permission)
                                <div class="form-group form-check">
                                    <input type="checkbox" name="permission_ids[]" value="{{ $permission->id }}"
                                        class="form-check-input" id="{{ $permission->id }}">
                                    <label class="form-check-label"
                                        for="{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach

                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary mr-1" type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $("#checkAll").click(function() {
            if ($(this).is(':checked') == false) {
                $("input[type='checkbox']").prop('checked', false);
            } else {
                $("input[type='checkbox']").prop('checked', true);
            }
        });
    </script>
@endsection
