@extends('layouts.admin')
@section('title','Manage Insurance Package Lists')
@section('content')
@include('includes.banner',['one'=>'Insurance Package Lists','two'=>'Create'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Manage Insurance Package Lists</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Insurance Company</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>AmountYear</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($insurancePackages as $insurancePackage)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{\App\Models\Insurance::get_name_by_id($insurancePackage->insurance_id)}}</td>
                                    <td>{{ $insurancePackage->type }} </td>
                                    <td>{{$insurancePackage->name}}</td>
                                    <td>{{$insurancePackage->amount}}</td>
                                    <td>{{$insurancePackage->duration}}</td>
                                    <td>{{$insurancePackage->admin->name ?? 'N/A'}}</td>

                                    <td class="d-flex justify-content-around">
                                        <a href="{{route('admin.insurance-package.show',$insurancePackage->id)}}">
                                            <button class="m-1 btn btn-white"> <img src="/icons/view.png" style="width:50px;"></button></a>
                                        <a href="{{route('admin.insurance-package.edit',$insurancePackage->id)}}">
                                            <button class="m-1 btn btn-white"> <img src="/icons/edit.png" style="width:50px;"></button></a>

                                        <a class="m-1 btn btn-white" href="#" onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$insurancePackage->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$insurancePackage->id}}" action="{{ route('admin.insurance-package.destroy',$insurancePackage->id) }}" method="POST" style="display: none;">
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
