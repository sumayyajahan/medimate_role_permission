@extends('layouts.admin')
@section('title','View Insurance Packages')
@section('content')
@include('includes.banner',['one'=>'Insurance Packages','two'=>'Create'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Manage Insurance Packages</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Insurance Name</th>
                                    <th>Package Name</th>
                                    <th>Package Amount</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>Metlife alico</td>
                                    <td>Package 1 </td>
                                    <td>500000</td>
                                    <td>5</td>
                                    <td class="d-flex">
                                        <a href="edit-insurance-package.php?id=1"> <button class="m-2 btn btn-info">Edit Package</button></a>
                                        <!-- <a href="delete-account.php?user_id=1"> <button class="m-2 btn btn-danger">Delete</button></a> -->>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
