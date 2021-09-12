@extends('layouts.admin')
@section('title','Bulk Add Product')
@section('content')
@include('includes.banner',['one'=>'Product','two'=>'Bulk Create'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form  class="form-group" action="{{ route('admin.product.bulk.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Add Product in Bulk</h4>
                    </div>
                    <div class="card-body">



                        <div class="form-group">
                            <label>Product CSV File <small class="text-danger"> All fields are required | Use UTF-8 Encoded CSV</small></label>

                            <input class="form-control" type="file" name="file" required />
                        </div>


                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-success mr-1" type="submit" name="submit"><i
                                class="fas fa-file-upload"></i> Import</button>
                        <a class="btn btn-info ml-2" href="{{ asset('product/sample.csv') }}"><i class="fas fa-cloud-download-alt"></i>
                            Download Sample File</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
