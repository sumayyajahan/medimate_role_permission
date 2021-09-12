@extends('layouts.admin')
@section('title','Cashout Successful')
@section('content')
@include('includes.banner',['one'=>'Cashout Successful','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Cashout Successful</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>

                                    <th>Doctor's ID-Name</th>
                                    <th>Requested Amount</th>
                                    <th>Requested Date</th>
                                    <th>Proceed Time </th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>Doctor-1</td>
                                    <td>100</td>
                                    <td>11/11/2020 05:08:55 PM</td>
                                    <td>11/11/2020 05:18:55 PM</td>
                                    <td>Paid By bKash To 01254113254 Trxn id - 1241542454</td>
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
