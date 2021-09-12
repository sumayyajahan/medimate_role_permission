@extends('layouts.admin')
@section('title','Pharmacy Salesmen')
@section('content')
@include('includes.banner',['one'=>'Pharmacy Salesmen','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="justify-content: space-between;">
                    <b style="font-size:large;">Manage Pharmacy Salesmen Accounts</b>
                    <span><a class="btn btn-success" href="{{route('admin.pharmacy-salesman.create')}}">Add Pharmacy Salesmen</a></span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Pharmacy</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pharmacySalesmans as $pharmacySalesman)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$pharmacySalesman->pharmacy->name}}</td>
                                    <td>{{$pharmacySalesman->name}}</td>
                                    <td>{{$pharmacySalesman->email}}</td>
                                    <td>{{$pharmacySalesman->mobile}}</td>
                                    <td>{{$pharmacySalesman->admin->name ?? 'N/A'}}</td>

                                    <td class="d-flex">
                                        <a href="{{route('admin.pharmacy-salesman.show',$pharmacySalesman->id)}}"> <button class="m-1 btn btn-white"> <img src="/icons/view.png" style="width:50px;"></button></a>
                                        <a href="{{route('admin.pharmacy-salesman.edit',$pharmacySalesman->id)}}"> <button class="m-1 btn btn-white"> <img src="/icons/edit.png" style="width:50px;"></button></a>

                                        <a class="m-1 btn btn-white" href="#" onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$pharmacySalesman->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$pharmacySalesman->id}}" action="{{ route('admin.pharmacy-salesman.destroy',$pharmacySalesman->id) }}" method="POST" style="display: none;">
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
