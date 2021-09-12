@extends('layouts.admin')
@section('title','View Pharmacy Representatives')
@section('content')
@include('includes.banner',['one'=>'Pharmacy Representatives','two'=>'Create'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Manage Pharmacy Representatives</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Store Name</th>
                                    <th>Representatives' Name</th>
                                    <th>Number</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>Kamal Shop</td>
                                    <td>Jamal Bhuiyan</td>
                                    <td>0125422854</td>
                                    <td style="width:8%;"> <img class="col-12 p-0" alt="image" src="uploads/user.png"></td>

                                    <td class="d-flex">
                                        <a href="edit-pharmacy-reps.php?id=1"> <button class="m-2 btn btn-info">Edit Representative Profile</button></a>
                                        <!-- <a href="delete-account.php?user_id=1"> <button class="m-2 btn btn-danger">Delete</button></a> -->
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
