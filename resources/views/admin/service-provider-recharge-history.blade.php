@extends('layouts.admin')
@section('title','Service Provider Recharge Record')
@section('content')
@include('includes.banner',['one'=>'Service Provider Recharge Record','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Service Provider Recharge Record</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportReport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Service Provider's ID-Name</th>
                                    <th>Paitent's ID-Name</th>
                                    <th>Transaction Amount</th>
                                    <th>Transaction Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$log->serviceProvider->serviceid}} - {{$log->serviceProvider->name}}</td>
                                    <td>{{$log->user->userid}} - {{$log->user->name}}</td>
                                    <td>{{$log->amount}}</td>
                                    <td>{{$log->created_at->toFormattedDateString()}}</td>
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