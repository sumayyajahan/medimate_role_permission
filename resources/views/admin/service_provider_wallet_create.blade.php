@extends('layouts.admin')
@section('title','Service Provider Wallet Create')
@section('content')
@include('includes.banner',['one'=>'Service Provider Wallet','two'=>'Add Points'])
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.service-wallet.store')}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Add Point to Service Provider Wallet</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Select Service Provider</label>
                            <select name="service_provider_id" class="form-control" id="" required>
                                <option>--- Select Service Provider ---</option>
                                @foreach ($serviceProviders as $serviceProvider)
                                <option value="{{$serviceProvider->id}}">{{$serviceProvider->name}} -
                                    {{$serviceProvider->serviceid}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input value="{{old('amount')}}" step=".01" type="number" class="form-control" name="amount"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Payment Gateway</label>
                            <input type="text" class="form-control" name="payment_gateway" required>
                        </div>
                        <div class="form-group">
                            <label>Payment Note</label>
                            <input type="text" class="form-control" name="payment_note">
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Add </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@if (session('status'))
<script>
    $(document).ready(
    Swal.fire(
        'Point Added Successfully',
        "{{ session('status') }}",
        'success'
    )
    );
</script>
@endif
@endsection