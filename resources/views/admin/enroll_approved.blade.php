@extends('layouts.admin')
@section('title','Enrolled Request - Approved by Insurance Provider')
@section('content')
@include('includes.banner',['one'=>'Enrolled Request','two'=>'Approved by Insurance Provider'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Enrolled Request - Approved by Insurance Provider</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>User Name</th>
                                    <th>Insurance & Package </th>
                                    <th>Type</th>
                                    <th>Health Form</th>
                                    <th>Comment</th>
                                    <th>Application Date</th>
                                    <th>Accepted Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($logs as $log)
                                <tr>
                                    <td> {{$loop->index+1}} </td>
                                    <td><a href="{{ route('admin.insurance.enroll.details', $log->id) }}" target="_blank">{{ $log->user->name }} / {{ $log->user->userid }}</a> </td>
                                    <td> {{ $log->insurance->name }} - {{ $log->insurancePackage->name }} </td>
                                    <td> {{ $log->type }}</td>
                                    <td> {!! \App\Models\GoodHealthDeclaration::has_declaration_form( $log->id) !!} </td>
                                    <td> {{ $log->comment }}</td>
                                    <td> {{ date('d/m/Y', strtotime($log->created_at)) }}</td>
                                    <td> {{ date('d/m/Y', strtotime($log->updated_at)) }}</td>
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
