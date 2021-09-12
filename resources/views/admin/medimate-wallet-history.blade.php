@extends('layouts.admin')
@section('title','Medimate Transactions Record')
@section('content')
@include('includes.banner',['one'=>'Medimate Transactions Record','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Total Commission Point = {{ $total }} </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportReport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
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
                                    <td>{{$log->amount}}</td>
                                    <td>{{$log->type}}</td>
                                    <td>{{$log->created_at}}</td>
                                    <td>{{$log->payment_gateway}}</td>
                                    <td>{{$log->payment_note}}</td>


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
