@extends('layouts.admin')
@section('title','Service Provider Wallet')
@section('content')
@include('includes.banner',['one'=>'Service Provider Wallet','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Service Provider Wallet</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Service Provider ID</th>
                                    <th>Service Provider Name</th>
                                    <th>Service Provider Mobile</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($serviceProviderWallets as $serviceProviderWallet)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$serviceProviderWallet->serviceProvider->serviceid}}</td>
                                <td>{{$serviceProviderWallet->serviceProvider->name}}</td>
                                <td>{{$serviceProviderWallet->serviceProvider->mobile}}</td>
                                <td>{{$serviceProviderWallet->balance}}</td>

                                <td class="d-flex">
                                    {{-- <a href="{{route('admin.user-wallet.show',$serviceProviderWallet->id)}}"> <button class="m-1 btn btn-primary">View</button></a> --}}
                                    <a href="{{route('admin.service-wallet.edit',$serviceProviderWallet->id)}}"> <button class="m-1 btn btn-white"><img src="/icons/edit.png" style="width:50px;"></button></a>

                                    {{-- <a class="m-1 btn btn-danger" href="#"
                                        onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$serviceProviderWallet->id}}').submit();}else{event.preventDefault()}">
                                        Delete</a>
                                    <form id="delete-form-{{$serviceProviderWallet->id}}" action="{{ route('admin.user-wallet.destroy',$serviceProviderWallet->id) }}" method="POST"
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
