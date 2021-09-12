@extends('layouts.admin')
@section('title','All Transactions Record')
@section('content')
@include('includes.banner',['one'=>'All Transactions Record','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Transactions Record</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>User's ID-Name</th>
                                    <th>Doctor's ID-Name</th>
                                    <th>Type Of Transaction</th>
                                    <th>Transaction For</th>
                                    <th>Transaction Time</th>
                                    <th>Transaction Amount</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>45454</td>
                                    <td>USer-1</td>
                                    <td>Doctor-1</td>
                                    <td>User to Doctor</td>
                                    <td>Doctor's Appointment Charge</td>
                                    <td>11/11/2020 05:08:55 PM</td>
                                    <td>100</td>
                                    <td>Appointment Charge</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
