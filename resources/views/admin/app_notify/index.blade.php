<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title','App Notifications')
@section('content')
    @include('includes.banner',['one'=>'App Notifications','two'=>'View'])
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between;">
                        <b style="font-size:large;">Manage App Notifications</b>
                        <span><a class="btn btn-success" href="{{route('admin.app-notify.create')}}">Add App Notifications</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                <tr>
                                    <th>ID.</th>
                                    <th>Type</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Android Version</th>
                                    <th>Apple Version</th>
                                    <th>Updated on</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($contents as $content)
                                    <tr>
                                        <td>{{$content->id}}</td>
                                        <td>{{$content->can_access_app == 1?'Version Update':'Notice' }}</td>
                                        <td>{{$content->title}}</td>
                                        <td>{{$content->body}}</td>
                                        <td>{{$content->build_number}}</td>
                                        <td>{{$content->apple_build}}</td>
                                        <td>{{ \Carbon\Carbon::parse($content->updated_at)->diffForHumans() }}</td>

                                        <td class="d-flex">
                                            <a href="{{route('admin.app-notify.edit',$content->id)}}"> <button class="m-1 btn btn-white"><img src="/icons/edit.png" style="width:50px;"></button></a>

                                            <a class="m-1 btn btn-white" href="#" onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$content->id}}').submit();}else{event.preventDefault()}">
                                                <img src="/icons/discard.png" style="width:50px;"></a>
                                            <form id="delete-form-{{$content->id}}" action="{{ route('admin.app-notify.destroy',$content->id) }}" method="POST" style="display: none;">
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
