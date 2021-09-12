@extends('layouts.admin')
@section('title','Cashout Requests')
@section('content')
@include('includes.banner',['one'=>'Cashout Requests','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Cashout Requests</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>

                                    <th>Sl</th>
                                    <th>Doctor's ID-Name</th>
                                    <th>Available Balance</th>
                                    <th>Requested Amount</th>
                                    <th>Note</th>
                                    <th>Mobile No.</th>
                                    <th>Requested Date</th>
                                    <th>Proceeded </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                <tr id="tr_{{ $log->id }}">
                                    <td> {{$loop->index+1}} </td>
                                    <td> {{$log->doctor->name}} / {{$log->doctor->doctorid}} </td>
                                    <td> {{$log->doctor->wallet->balance}} </td>
                                    <td> {{$log->amount}} </td>
                                    <td> {{$log->note}} </td>
                                    <td> {{$log->mobile}} </td>
                                    <td> {{ date('d/m/Y H:i:s', strtotime($log->created_at)) }} </td>
                                    <td>
                                        <button type="button" class="btn btn-white" onclick="done('{{ $log->id }}');"><img src="/icons/confirm.png" style="width:50px;"></button>
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
<script>
    function done(id) {
        $.get("cashout-requests/ajax/done/" + id, function(data) {
            $("#tr_" + id).remove();
        });
    }
</script>
@endsection
