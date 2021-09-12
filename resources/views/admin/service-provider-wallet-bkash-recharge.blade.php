@extends('layouts.admin')
@section('title','Service Providers bkash Trx Record')
@section('content')
@include('includes.banner',['one'=>'bKash Transactions Record','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Service Provider bKash Transactions Record</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Service Provider's ID-Name</th>
                                    <th>Request Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $log)
                                <tr id="{{$log->trx_id}}">
                                    <td>{{$log->trx_id}}</td>
                                    <td>{{$log->serviceProvider->serviceid}} / {{$log->serviceProvider->name}}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($log->created_at)) }}</td>
                                    <td>
                                        <button class="btn btn-white" type="button"
                                            onclick="recharge('{{ $log->service_provider_id }}','{{$log->trx_id}}');"><img
                                                src="/icons/confirm.png" style="width:50px;"></button>
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
    function recharge(serviceId, trx_id) {
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
            $.post('/rt-admin/service-provider-recharge-request/bkash/recharge', // url
                {
                    _token: '{{ csrf_token() }}',
                    service_provider_id: serviceId,
                    amount: inputValue['value'],
                    payment_gateway: 'bKash-Admin',
                    payment_note: trx_id
                }, // data to be submit
                function(data, status, jqXHR) { // success callback
                console.log(data);
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