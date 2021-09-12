@extends('layouts.admin')
@section('title','Service Provider Wallet Edit')
@section('content')
@include('includes.banner',['one'=>'Service Provider Wallet','two'=>'Edit'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.service-wallet.update',$serviceProviderWallet->id)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Service Provider Wallet</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label> Service Provider</label>
                            <select disabled name="service_provider_id" class="form-control" id="">
                                @foreach ($serviceProviders as $serviceProvider)
                                    <option @if ($serviceProvider->id == $serviceProviderWallet->service_provider_id) selected
                                        
                                    @endif value="{{$serviceProvider->id}}">{{$serviceProvider->name}} - {{$serviceProvider->serviceid}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input step=".01" type="number" class="form-control" value="{{$serviceProviderWallet->balance}}" name="amount" required>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Update </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection