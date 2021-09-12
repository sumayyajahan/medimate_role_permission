@extends('layouts.admin')
@section('title','Doctor Transactions Record')
@section('content')
@include('includes.banner',['one'=>'Doctor Transactions Record','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Doctor Transactions Record</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportReport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Doctor's ID-Name</th>
                                    <th>Type Of Transaction</th>
                                    <th>Transaction Amount</th>
                                    <th>Transaction For</th>
                                    <th>Transaction Time</th>
                                    <th>Payment Gateway</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                <tr>
                                    <td>{{$log->trx_id}}</td>
                                    <td>{{$log->doctor->doctorid}} - {{$log->doctor->name}}</td>
                                    <td>{{($log->deposit == 1) ? 'Deposit' : 'Cash Out'}}</td>
                                    <td>{{$log->amount}}</td>
                                    <td>{{$log->type}}</td>
                                    <td>{{$log->created_at}}</td>
                                    <td>{{$log->payment_gateway}}</td>
                                    <td>{{$log->payment_note}}</td>
                                    {{-- @if($log->user)
                                    <td>{{$log->user->userid}} - {{$log->user->name}}</td>
                                    @else
                                    <td>Null</td>
                                    @endif --}}

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
