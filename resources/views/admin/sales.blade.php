@extends('layouts.admin')
@section('title','View Sales Report')
@section('content')
@include('includes.banner',['one'=>'Sales','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sales Reports</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportReport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Pharmacy Name</th>
                                    <th>User Name</th>
                                    <th>Sales Amount</th>
                                    <th>Order Through</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                <tr>
                                    <td> {{ $log->pharmacy->name }} </td>
                                    <td> {{ $log->user->name }} </td>
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
