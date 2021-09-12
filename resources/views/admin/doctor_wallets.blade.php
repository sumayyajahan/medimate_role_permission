@extends('layouts.admin')
@section('title','Doctor Wallet')
@section('content')
@include('includes.banner',['one'=>'Doctor Wallet','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Doctor Wallet</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Doctor ID</th>
                                    <th>Doctor Name</th>
                                    <th>Doctor Mobile</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctorWallets as $doctorWallet)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$doctorWallet->doctor->doctorid}}</td>
                                    <td>{{$doctorWallet->doctor->name}}</td>
                                    <td>{{$doctorWallet->doctor->mobile}}</td>
                                    <td>{{$doctorWallet->balance}}</td>

                                    <td class="d-flex justify-content-around">
                                        {{-- <a href="{{route('admin.doctor-wallet.show',$doctorWallet->id)}}"> <button
                                                class="m-1 btn btn-primary">View</button></a> --}}
                                        <a href="{{route('admin.doctor-wallet.edit',$doctorWallet->id)}}"> <button
                                                class="m-1 btn btn-white"><img src="/icons/edit.png" style="width:50px;"></button></a>

                                        {{-- <a class="m-1 btn btn-danger" href="#"
                                        onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$doctorWallet->id}}').submit();}else{event.preventDefault()}">
                                        Delete</a>
                                        <form id="delete-form-{{$doctorWallet->id}}"
                                            action="{{ route('admin.doctor-wallet.destroy',$doctorWallet->id) }}"
                                            method="POST" style="display: none;">
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
