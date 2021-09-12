@extends('layouts.admin')
@section('title','User Wallet')
@section('content')
@include('includes.banner',['one'=>'User Wallet','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>User Wallet</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Balance</th>
                                    <th>Last Recharge</th>
                                    <th>Last Expense Amount</th>
                                    <th>Last Expense Purpose</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>11</td>
                                    <td>Test User</td>
                                    <td>150</td>
                                    <td>100</td>
                                    <td>50</td>
                                    <td>Product Order (Order ID - 10)</td>

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
