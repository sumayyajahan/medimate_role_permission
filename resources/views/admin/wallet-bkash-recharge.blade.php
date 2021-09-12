@extends('layouts.admin')
@section('title','Users bkash Trx Record')
@section('content')
@include('includes.banner',['one'=>'bKash Transactions Record','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>bKash Transactions Record</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>User's ID-Name</th>
                                    <th>Request Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $log)
                                <tr id="{{$log->trx_id}}">
                                    <td>{{$log->trx_id}}</td>
                                    <td>{{$log->user->name}} / {{$log->user->mobile}}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($log->created_at)) }}</td>
                                    <td>
                                        <button class="btn btn-white" type="button" onclick="recharge('{{ $log->user_id }}','{{$log->trx_id}}');"><img src="/icons/confirm.png" style="width:50px;"></button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
<script>
    function recharge(userId, trx_id) {
        Swal.fire({
            title: 'Enter Amount',
            input: 'number',
            inputLabel: 'Rechage Amount for Trx ID -' + trx_id,
            inputPlaceholder: 'Enter Amount',
            inputAttributes: {
                min: 1
            }
        }).then(function(inputValue) {
            if (inputValue === false) return false;

            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false
            }
            $.post('bkash/recharge', // url
                {
                    _token: '{{ csrf_token() }}',
                    user_id: userId,
                    amount: inputValue['value'],
                    payment_gateway: 'bKash-Admin',
                    payment_note: trx_id
                }, // data to be submit
                function(data, status, jqXHR) { // success callback
                    Swal.fire({
                        title: 'Success!',
                        text: 'Recharge Successfull',
                        icon: 'success',
                        confirmButtonText: 'Return'
                    }).then(() => {
                        $('#' + trx_id).remove();
                    })
                })

        });

    }
</script>
@endsection
