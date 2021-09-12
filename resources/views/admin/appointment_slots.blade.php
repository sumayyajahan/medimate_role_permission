@extends('layouts.admin')
@section('title','View Slot')
@section('content')
@include('includes.banner',['one'=>'Doctor Slot','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Doctor`s Slot View</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Doctor Id</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Day</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointmentSlots as $appointmentSlot)
                                <tr>
                                    {{-- <td>{{$loop->index+1}}</td> --}}
                                    <td>{{$appointmentSlot->doctor->doctorid}}</td>
                                    <td>{{$appointmentSlot->doctor->name}} / {{ $appointmentSlot->doctor->mobile }}</td>
                                    <td>{{$appointmentSlot->doctor->department}}</td>
                                    <td>{{date('h:i a',strtotime($appointmentSlot->start_time))}}</td>
                                    <td>{{date('h:i a',strtotime($appointmentSlot->end_time))}}</td>
                                    <td>{{$appointmentSlot->day}}</td>

                                    <td class="d-flex justify-content-around">
                                        <a href="{{route('admin.appointment-slot.show',$appointmentSlot->id)}}"> <button class="m-1 btn btn-white"><img src="/icons/view.png" style="width:50px;"></button></a>
                                        <a href="{{route('admin.appointment-slot.edit',$appointmentSlot->id)}}"> <button class="m-1 btn btn-white"><img src="/icons/edit.png" style="width:50px;"></button></a>

                                        <a class="m-1 btn btn-white" href="#" onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$appointmentSlot->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$appointmentSlot->id}}" action="{{ route('admin.appointment-slot.destroy',$appointmentSlot->id) }}" method="POST" style="display: none;">
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
