@extends('layouts.admin')
@section('title','Manage Insurance Lists')
@section('content')
@include('includes.banner',['one'=>'Insurance Lists','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Manage Insurance Lists</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Contact Person Number</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($insurances as $insurance)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$insurance->name}}</td>
                                    <td>{{$insurance->contact_person_name}}</td>
                                    <td>{{$insurance->contact_person_phone}}</td>
                                    <td>{{$insurance->admin->name ?? 'N/A'}}</td>

                                    <td class="d-flex">
                                        <a href="{{route('admin.insurance.show',$insurance->id)}}"> <button class="m-1 btn btn-white"> <img src="/icons/view.png" style="width:50px;"></button></a>
                                        <a href="{{route('admin.insurance.edit',$insurance->id)}}"> <button class="m-1 btn btn-white"> <img src="/icons/edit.png" style="width:50px;"></button></a>

                                        <a class="m-1 btn btn-white" href="#" onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$insurance->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$insurance->id}}" action="{{ route('admin.insurance.destroy',$insurance->id) }}" method="POST" style="display: none;">
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
