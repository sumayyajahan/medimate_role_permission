@extends('layouts.admin')
@section('title','Pharmacies')
@section('content')
@include('includes.banner',['one'=>'Pharmacy','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="justify-content: space-between;">
                    <b style="font-size:large;">Manage Trashed Pharmacy Accounts</b>
                    {{-- <span><a class="btn btn-success" href="{{route('admin.pharmacy.create')}}">Add
                    Pharmacy</a></span> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>District</th>
                                    <th>Created By</th>
                                    <th>Permanent Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pharmacies as $pharmacy)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$pharmacy->pharmaid}}</td>
                                    <td>{{$pharmacy->name}}</td>
                                    <td>{{$pharmacy->email}}</td>
                                    <td>{{$pharmacy->mobile}}</td>
                                    <td>{{$pharmacy->address}}</td>
                                    <td>{{$pharmacy->district}}</td>
                                    <td>{{$pharmacy->admin->name ?? 'N/A'}}</td>

                                    <td class="d-flex">
                                        {{-- <a href="{{route('admin.pharmacy.show',$pharmacy->id)}}"> <button
                                            class="m-1 btn btn-white"> <img src="/icons/view.png"
                                                style="width:50px;"></button></a>
                                        <a href="{{route('admin.pharmacy.edit',$pharmacy->id)}}"> <button
                                                class="m-1 btn btn-white"> <img src="/icons/edit.png"
                                                    style="width:50px;"></button></a> --}}

                                        <a class="m-1 btn btn-white" href="#"
                                            onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$pharmacy->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$pharmacy->id}}"
                                            action="{{ route('admin.pharmacy.forceDelete',$pharmacy->id) }}"
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