@extends('layouts.admin')
@section('title','User Wallet')
@section('content')
@include('includes.banner',['one'=>'User Wallet','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>User Wallet</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>User Mobile</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($userWallets as $userWallet)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$userWallet->user->userid}}</td>
                                <td>{{$userWallet->user->name}}</td>
                                <td>{{$userWallet->user->mobile}}</td>
                                <td>{{$userWallet->balance}}</td>

                                <td class="d-flex">
                                    {{-- <a href="{{route('admin.user-wallet.show',$userWallet->id)}}"> <button class="m-1 btn btn-primary">View</button></a> --}}
                                    <a href="{{route('admin.user-wallet.edit',$userWallet->id)}}"> <button class="m-1 btn btn-white"><img src="/icons/edit.png" style="width:50px;"></button></a>

                                    {{-- <a class="m-1 btn btn-danger" href="#"
                                        onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$userWallet->id}}').submit();}else{event.preventDefault()}">
                                        Delete</a>
                                    <form id="delete-form-{{$userWallet->id}}" action="{{ route('admin.user-wallet.destroy',$userWallet->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
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
