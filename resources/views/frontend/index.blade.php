@extends('layouts.frontend')
@section('title','Home')
@section('content')
    <h3>Index</h3>
    <style type="text/css">
        #twilio-connect-button {
            background: url(https://www.twilio.com/bundles/connect-apps/img/connect-button.png);
            width: 130px;
            height: 34px;
            display: block;
            margin: 0 auto;
        }
    
        #twilio-connect-button:hover {
            background-position: 0 34px;
        }
    </style>
    <a href="https://www.twilio.com/authorize/CN8f06948cce950670618e70df5e9200fa" id="twilio-connect-button"></a>
    {{-- @foreach ($visitCharges as $visitCharge)
        Doctor Id : {{$visitCharge->doctor_id}} - Name : {{$visitCharge->doctor->name}} <br>
    @endforeach --}}
@endsection