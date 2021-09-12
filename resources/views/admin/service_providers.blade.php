@extends('layouts.admin')
@section('title','Manage Service Providers')
@section('content')
@include('includes.banner',['one'=>'Service Provider','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="justify-content: space-between;">
                    <b style="font-size:large;">Manage Service Providers Accounts</b>
                    <span><a class="btn btn-success" href="{{route('admin.service-provider.create')}}">Add Service Provider</a></span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableExport" class="table table-striped table-hover" id="" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID.</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($serviceProviders as $serviceProvider)
                                <tr>
                                    <td>{{$serviceProvider->id}}</td>
                                    <td>{{$serviceProvider->serviceid}}</td>
                                    <td>{{$serviceProvider->name}}</td>
                                    <td>{{$serviceProvider->email}}</td>
                                    <td>{{$serviceProvider->mobile}}</td>
                                    <td>{{$serviceProvider->address}}</td>
                                    <td>{{$serviceProvider->gender}}</td>

                                    <td class="d-flex">
                                        <a href="{{route('admin.service-provider.show',$serviceProvider->id)}}"> <button
                                                class="m-1 btn btn-white"> <img src="/icons/view.png"
                                                    style="width:50px;"> </button></a>
                                        <a href="{{route('admin.service-provider.edit',$serviceProvider->id)}}"> <button
                                                class="m-1 btn btn-white"><img src="/icons/edit.png"
                                                    style="width:50px;"></button></a>

                                        <a class="m-1 btn btn-white" href="#"
                                            onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$serviceProvider->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$serviceProvider->id}}"
                                            action="{{ route('admin.service-provider.destroy',$serviceProvider->id) }}"
                                            method="POST" style="display: none;">
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
