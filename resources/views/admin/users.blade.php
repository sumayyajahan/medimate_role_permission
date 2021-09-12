@extends('layouts.admin')
@section('title','Manage Users')
@section('content')
@include('includes.banner',['one'=>'User','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="justify-content: space-between;">
                    <b style="font-size:large;">Manage Patient Accounts</b>
                    <span><a class="btn btn-success" href="{{route('admin.user.create')}}">Add Patient</a></span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableExport" class="table table-striped table-hover" id="" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID.</th>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Referral Code</th>
                                    <th>Child</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>

                                    <td>{{$user->userid}} @if($user->parent_id != NULL)
                                        (child)
                                        @endif</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->mobile}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>{{$user->gender}}</td>
                                    <td>{{$user->referral_code}}</td>
                                    <td>@if($user->parent_id == NULL)
                                        <a href="{{route('admin.user.child.create',$user->id)}}">Add </a>
                                        <a href="{{route('admin.user.child',$user->id)}}"> View </a>
                                        @else
                                        <a href="{{route('admin.user.child.edit',$user->id)}}">Separate</a>
                                        @endif</td>

                                    <td class="d-flex">
                                        <a href="{{route('admin.user.show',$user->id)}}"> <button
                                                class="m-1 btn btn-white"> <img src="{{asset('icons/view.png')}}"
                                                    style="width:50px;"> </button></a>
                                        <a href="{{route('admin.user.edit',$user->id)}}"> <button
                                                class="m-1 btn btn-white"><img src="/icons/edit.png"
                                                    style="width:50px;"></button></a>

                                        <a class="m-1 btn btn-white" href="#"
                                            onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$user->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$user->id}}"
                                            action="{{ route('admin.user.destroy',$user->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
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
