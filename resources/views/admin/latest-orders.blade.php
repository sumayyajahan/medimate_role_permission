@extends('layouts.admin')
@section('title','Latest Orders')
@section('content')
@include('includes.banner',['one'=>'Latest Orders','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Latest Orders</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportReport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order ID</th>
                                    <th>User</th>
                                    <th>Pharmacy</th>
                                    <th>Amount</th>
                                    <th>Order Items</th>
                                    <th>Order Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                <tr>
                                    <td> {{ $loop->index+1 }} </td>
                                    <td> {{ $log->id }} </td>
                                    <td> {{ $log->user->name }} / {{ $log->user->userid }}</td>
                                    <td> {{ $log->pharmacy->name }} </td>
                                    <td> {{ $log->amount }} </td>
                                    <td>
                                        <ol>
                                            @if($log->e_prescription_id != NULL)
                                            <li>E-Prescription</li>
                                            @endif
                                            @if($log->report_prescription_id != NULL)
                                            <li>Old-Prescription</li>
                                            @endif
                                            @if($log->otc_product_id != NULL)
                                            <li>OTC Products</li>
                                            @endif
                                        </ol>
                                    </td>
                                    <td> {{ $log->created_at }} </td>
                                    <td> {{ $log->state->name }} </td>
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
