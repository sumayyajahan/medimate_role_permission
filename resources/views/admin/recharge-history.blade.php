@extends('layouts.admin')
@section('title','Recharge Log')
@section('content')
@include('includes.banner',['one'=>'Recharge','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Recharge</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportReport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>User's ID-Name</th>
                                    <th>Trx ID</th>
                                    <th>Recharge Amount</th>
                                    <th>Payment Gateway</th>
                                    <th>Recharge Note</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                <tr>
                                    <td> {{ $log->user->userid}} - {{ $log->user->name }} </td>
                                    <td> {{ $log->trx_id }} </td>
                                    <td> {{ $log->amount }} </td>
                                    <td> {{ $log->payment_gateway }} </td>
                                    <td> {{ $log->payment_note }} </td>
                                    <td> {{ date('d-m-Y h:i:s a',strtotime($log->created_at)) }} </td>
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
