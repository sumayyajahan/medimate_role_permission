@extends('layouts.admin')
@section('title','Specialization')
@section('content')
@include('includes.banner',['one'=>'Specialization','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="justify-content: space-between;">
                    <b style="font-size:large;">Manage Specialization</b>
                    <span><a class="btn btn-success" href="{{route('admin.specialization.create')}}">Add Specialization</a></span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Priority</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($specializations as $specialization)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$specialization->priority}}</td>
                                    <td>{{$specialization->name}}</td>
                                    <td> <img style="width:100px;" src="{{ asset($specialization->icon) }}" alt="{{$specialization->name}}"> </td>

                                    <td class="d-flex">
                                        <a href="{{route('admin.specialization.edit',$specialization->id)}}"> <button class="m-1 btn btn-white"><img src="/icons/edit.png" style="width:50px;"></button></a>

                                        <a class="m-1 btn btn-white" href="#" onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$specialization->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$specialization->id}}" action="{{ route('admin.specialization.destroy',$specialization->id) }}" method="POST" style="display: none;">
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
