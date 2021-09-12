@extends('layouts.admin')
@section('title','Manage Insurance Lists')
@section('content')
@include('includes.banner',['one'=>'Insurance Lists','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Manage Insurance Lists</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>Metlife alico</td>
                                    <td>Admin-1</td>
                                    <td class="d-flex">
                                        <a href="add-insurance-package.php?id=1"> <button class="m-2 btn btn-info">Add Package</button></a>
                                        <a href="edit-insurance.php?id=1"> <button class="m-2 btn btn-outline-dark">Edit Insurance</button></a>
                                        <!--  <a href="delete-account.php?user_id=1"> <button class="m-2 btn btn-danger">Delete</button></a> -->
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
