@extends('layouts.admin')
@section('title','Bulk Add Product')
@section('content')
@include('includes.banner',['one'=>'Product','two'=>'Bulk Create'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="add-account.php" method="post"
                enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Product in Bulk</h4>
                    </div>
                    <div class="card-body">



                        <div class="form-group">
                            <label>Product CSV File</label>
                            <input class="form-control" type="file" name="" required />
                        </div>


                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-success mr-1" type="submit" name="submit"><i
                                class="fas fa-file-upload"></i> Import</button>
                        <button class="btn btn-info ml-2" type="button"><i class="fas fa-cloud-download-alt"></i>
                            Download Sample File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
