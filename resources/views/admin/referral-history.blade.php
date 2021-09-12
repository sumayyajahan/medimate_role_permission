@extends('layouts.admin')
@section('title','Referrals Log')
@section('content')
@include('includes.banner',['one'=>'Referrals','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ucfirst($type)}} Referrals</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportReport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>{{ucfirst($type)}} ID-Name</th>
                                    <th>Refer By ID-Name</th>
                                    <th>Referral Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($type == "user")
                                @foreach($referralHistories as $referralHistory)
                                <tr>
                                    <td> {{ $referralHistory->user->userid ?? ''}}
                                        ({{ $referralHistory->user->name ?? ''}}) </td>

                                    <td> {{ $referralHistory->userRefer->userid ?? '' }}
                                        ({{ $referralHistory->userRefer->name ?? ''}}) </td>

                                    <td> {{ date('d-m-Y h:i:s a',strtotime($referralHistory->created_at)) }} </td>
                                </tr>
                                @endforeach
                                @elseif($type == "doctor")
                                @foreach($referralHistories as $referralHistory)
                                <tr>
                                    <td> {{ $referralHistory->doctor->doctorid }} ({{ $referralHistory->doctor->name }})
                                    </td>

                                    <td> {{ $referralHistory->doctorRefer->doctorid }}
                                        ({{ $referralHistory->doctorRefer->name }}) </td>

                                    <td> {{ $referralHistory->created_at->toFormattedDateString() }} </td>
                                </tr>
                                @endforeach
                                @elseif($type == "service-provider")
                                @foreach($referralHistories as $referralHistory)
                                <tr>
                                    <td> {{ $referralHistory->serviceProvider->serviceid }}
                                        ({{ $referralHistory->serviceProvider->name }}) </td>

                                    <td> {{ $referralHistory->serviceProviderRefer->serviceid }}
                                        ({{ $referralHistory->serviceProviderRefer->name }}) </td>

                                    <td> {{ date('d-m-Y h:i:s a',strtotime($referralHistory->created_at)) }} </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection