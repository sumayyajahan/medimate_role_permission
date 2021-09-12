@extends('layouts.admin')
@section('title','Enrolled Request')
@section('content')
@include('includes.banner',['one'=>'Enrolled Request','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Enrolled Request</h4>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($logs as $log)
                                <tr id="tr_{{ $log->id }}">
                                    <td> {{$loop->index+1}} </td>
                                    <td><a href="{{ route('admin.insurance.enroll.details', $log->id) }}" target="_blank">{{ $log->user->name }} / {{ $log->user->userid }}</a> </td>
                                    <td> {{ $log->insurance->name }} - {{ $log->insurancePackage->name }} </td>
                                    <td> {{ $log->type }}</td>
                                    <td> {!! \App\Models\GoodHealthDeclaration::has_declaration_form( $log->id) !!} </td>
                                    <td> {{ $log->comment }}</td>
                                    <td> {{ date('d/m/Y', strtotime($log->created_at)) }}</td>
                                    <td class="d-flex justify-content-around">
                                        <button class="btn btn-white" onclick="accept('{{ $log->id }}');"> <img src="/icons/confirm.png" style="width:50px;"> </button>
                                        <button class="btn btn-white" onclick="reject('{{ $log->id }}');"> <img src="/icons/cancel.png" style="width:50px;"> </button>
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

<script>
    function accept(id) {
        $.get("ajax/acceptEnroll/" + id, function(data) {
            $("#tr_" + id).remove();
        });
    }

    function reject(id) {
        $.get("ajax/rejectEnroll/" + id, function(data) {
            $("#tr_" + id).remove();
        });
    }

</script>

@endsection
