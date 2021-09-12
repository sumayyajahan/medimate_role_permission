@extends('layouts.admin')
@section('title','Doctor`s Wallet')
@section('content')
@include('includes.banner',['one'=>'Doctor`s Wallet','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Doctors' Wallet</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Doctors' ID</th>
                                    <th>Doctors' Name</th>
                                    <th>Balance</th>
                                    <th>Last Received Amount</th>
                                    <th>Last Withdraw Amount</th>
                                    <th>Last Withdraw Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>11</td>
                                    <td>Test User</td>
                                    <td>150</td>
                                    <td>100</td>
                                    <td>50</td>
                                    <td>05/01/2020</td>

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
