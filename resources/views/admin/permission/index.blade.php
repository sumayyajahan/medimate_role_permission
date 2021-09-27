<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title','Permissions')
@section('content')
    @include('includes.banner',['one'=>'Permissions','two'=>'View'])
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between;">
                        <b style="font-size:large;">Manage Permissions</b>
                        <span><a class="btn btn-success" href="{{route('admin.permissions.create')}}">Add New Permission</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table_id">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Permission Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>
                                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="post" id="form_submit{{ $permission->id }}" class="form-inline" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void(0)" onclick="document.getElementById('form_submit{{ $permission->id }}').submit()" class="btn btn-sm btn-danger">Del</a>
                                        </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

@endpush
