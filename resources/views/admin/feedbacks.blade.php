@extends('layouts.admin')
@section('title','View Feedback')
@section('content')
@include('includes.banner',['one'=>'Feedback','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Feedback</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Message</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feedbacks as $feedback)
                                <tr>
                                    <td> {{ $loop->index+1 }} </td>
                                    <td> {{ $feedback->name }} </td>
                                    <td> {{ $feedback->email }} </td>
                                    <td> {{ $feedback->phone }} </td>
                                    <td> {{ $feedback->subject }} </td>
                                    <td> {{ $feedback->message }} </td>
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
