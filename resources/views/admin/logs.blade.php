@extends('layouts.admin')
@section('title','View Logs')
@section('content')
@include('includes.banner',['one'=>'Logs','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Logs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Causer</th>
                                    <th>Description</th>
                                    <th>Subject</th>
                                    {{-- <th>Properties</th> --}}
                                    <th>Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                <tr>
                                    <td> {{ $loop->index+1 }} </td>
                                    <td> {{ $log->causer_type }} - ({{ $log->causer_id }}) </td>
                                    <td> {{ $log->description }} </td>
                                    <td> {{ $log->subject_type }} - ({{ $log->subject_id }}) </td>
                                    {{-- <td> {{ $log->properties }} </td> --}}
                                    <td> {{ $log->created_at->toFormattedDateString() }} </td>
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
