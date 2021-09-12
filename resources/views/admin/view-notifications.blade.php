@extends('layouts.admin')
@section('title','View Notifications')
@section('content')
@include('includes.banner',['one'=>'Notifications','two'=>'View'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Notifications</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Receiver Type</th>
                                    <th>Receiver ID/Name</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $notification)
                                <tr>
                                    @if($notification->user_id !== Null)
                                    <td> Patient </td>
                                    <td> {{ $notification->user->name }} / {{ $notification->user->userid }} </td>
                                    @endif

                                    @if($notification->doctor_id !== Null)
                                    <td> Doctor </td>
                                    <td> {{ $notification->doctor->name }} / {{ $notification->doctor->doctorid }} </td>
                                    @endif

                                    @if($notification->pharmacy_id !== Null)
                                    <td> Pharmacy </td>
                                    <td> {{ $notification->pharmacy->name }} / {{ $notification->pharmacy->id }} </td>
                                    @endif
                                    <td> {{ $notification->title }} </td>
                                    <td> {{ $notification->body }} </td>
                                    <td>Unable to Delete</td>
                                </tr>
                                @endforeach

                                @foreach($notificationsAll as $notification)
                                <tr>
                                    <td> {{ ucfirst($notification->type) }} </td>
                                    <td> All </td>
                                    <td> {{ $notification->title }} </td>
                                    <td> {{ $notification->body }} </td>
                                    <td>
                                        <a class="m-1 btn btn-white" href="#"
                                            onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$notification->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$notification->id}}"
                                            action="{{ route('admin.notification.destroy',$notification->id) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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
@endsection
