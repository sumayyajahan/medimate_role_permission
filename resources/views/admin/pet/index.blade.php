<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title','Pets')
@section('content')
    @include('includes.banner',['one'=>'Pet','two'=>'View'])
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between;">
                        <b style="font-size:large;">Manage Pets</b>
                        <span><a class="btn btn-success" href="{{route('admin.pet.create')}}">Add Pet Service</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Mobile</th>
                                    <th>Division</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($contents as $content)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$content->name}}</td>
                                        <td>{{$content->address}}</td>
                                        <td>{{$content->phone}}</td>
                                        <td>{{$content->division->name}}</td>

                                        <td class="d-flex">
                                            <a href="{{route('admin.pet.edit',$content->id)}}"> <button class="m-1 btn btn-white"><img src="/icons/edit.png" style="width:50px;"></button></a>

                                            <a class="m-1 btn btn-white" href="#" onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$content->id}}').submit();}else{event.preventDefault()}">
                                                <img src="/icons/discard.png" style="width:50px;"></a>
                                            <form id="delete-form-{{$content->id}}" action="{{ route('admin.pet.destroy',$content->id) }}" method="POST" style="display: none;">
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
