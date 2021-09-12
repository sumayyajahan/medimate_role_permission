@extends('layouts.admin')
@section('title','Doctor Wallet Cash Out')
@section('content')
@include('includes.banner',['one'=>'Doctor Wallet','two'=>'Cash Out'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="{{route('admin.doctor-wallet.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Cash Out - Doctor Wallet</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Select Doctor</label>
                            <select name="doctor_id" class="form-control" id="">
                                @foreach ($doctors as $doctor)
                                <option value="{{$doctor->id}}">{{$doctor->name}} - {{$doctor->doctorid}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input value="{{old('amount')}}" step=".01" type="number" class="form-control" name="amount" required>
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
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Cash Out </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if (session('status'))
<script>
    $(document).ready(
        Swal.fire(
            'Cash Out Successful',
            "{{ session('status') }}",
            'success'
        )
    );
</script>
@endif
@endsection
