@extends('layouts.admin')
@section('title', 'Manage Doctors')
@section('content')
    @include('includes.banner',['one'=>'Doctor','two'=>'View'])
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between;">
                        <b style="font-size:large;">Manage Doctor Accounts</b>
                        <span><a class="btn btn-success" href="{{ route('admin.doctor.create') }}">Add Doctor</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableExport" class="table table-striped table-hover" id="" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Doctor ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Degree</th>
                                        <th>Date</th>
                                        <!---<th>Address</th>--->
                                        <th>Specialization</th>
                                        <th>Department</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                        @if ($doctor->status == 0)
                                            @php($tr_class = 'text-danger')
                                        @else
                                            @php($tr_class = '')
                                        @endif
                                        <tr class="{{ $tr_class }}">
                                            <td>{{ $doctor->id }}</td>
                                            <td>{{ $doctor->doctorid }}</td>
                                            <td>{{ $doctor->name }}</td>
                                            <td>{{ $doctor->email }}</td>
                                            <td>{{ $doctor->mobile }}</td>
                                            <td>{{ $doctor->degree }}</td>
                                            <td>{{ $doctor->created_at->format('d/m/Y') }}</td>
                                            <td>{{ str_replace(',', ',  ', $doctor->specialization) }}</td>
                                            <td>{{ $doctor->department }}</td>

                                            <td class="d-flex">
                                                @can('view doctors')
                                                <a href="{{ route('admin.doctor.show', $doctor->id) }}"> <button
                                                        class="m-1 btn btn-white"> <img src="/icons/view.png"
                                                            style="width:50px;"></button></a>
                                                @endcan
                                                @can('edit doctors')
                                                    <a href="{{ route('admin.doctor.edit', $doctor->id) }}"> <button
                                                            class="m-1 btn btn-white"> <img src="/icons/edit.png"
                                                                style="width:50px;"></button></a>
                                                @endcan
                                                @can('delete doctors')
                                                <a class="m-1 btn btn-white" href="#"
                                                    onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{ $doctor->id }}').submit();}else{event.preventDefault()}">
                                                    <img src="/icons/discard.png" style="width:50px;"></a>
                                                <form id="delete-form-{{ $doctor->id }}"
                                                    action="{{ route('admin.doctor.destroy', $doctor->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                @endcan
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
