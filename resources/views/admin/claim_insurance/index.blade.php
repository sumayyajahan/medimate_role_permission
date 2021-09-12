<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title','Claim Insurance')
@section('content')
    @include('includes.banner',['one'=>'Claim Insurance','two'=>'View'])
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between;">
                        <b style="font-size:large;">Manage Claim Insurance</b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Enroll ID</th>
                                    <th>Member ID</th>
                                    <th>Insured Name</th>
                                    <th>Claim Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($contents as $content)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$content->enroll_id}}</td>
                                        <td>{{$content->member_id}}</td>
                                        <td>{{$content->insured_name}}</td>
                                        <td>{{$content->claim_type}}</td>
                                        <td class="d-flex">
                                            <a href="{{route('admin.claim-insurance-request.show',$content->id)}}" target="_blank"> <button
                                                    class="m-1 btn btn-white"> <img src="{{asset('icons/view.png')}}"
                                                                                    style="width:50px;"> </button></a>
                                            <a class="m-1 btn btn-white" href="#" onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$content->id}}').submit();}else{event.preventDefault()}">
                                                <img src="/icons/discard.png" style="width:50px;"></a>
                                            <form id="delete-form-{{$content->id}}" action="{{ route('admin.claim-insurance-request.destroy',$content->id) }}" method="POST" style="display: none;">
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
