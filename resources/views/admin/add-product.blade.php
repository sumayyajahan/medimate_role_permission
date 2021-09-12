@extends('layouts.admin')
@section('title','Add Product')
@section('content')
@include('includes.banner',['one'=>'Product','two'=>'Create'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form class="form-group" action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Add New Product</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="form">Form</label>
                            <select class="form-control" name="form" id="form" >
                                <option value="">Select Form</option>
                                <option value="Syrup">Syrup</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Capsule">Capsule</option>
                                <option value="Powder">Powder</option>
                                <option value="Cream">Cream</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Generic Name</label>
                            <input type="text" class="form-control" name="generic_name" >
                        </div>
                        <div class="form-group">
                            <label>Manufacturer</label>
                            <input type="text" class="form-control" name="pharmaceutical" >
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" min="1" step="any" class="form-control" name="price" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category"  required>
                                <option value="Prescription">Prescription</option>
                                <option value="OTC">OTC</option>
                                <option value="HP">Health Product</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Product Image</label>
                            <input class="form-control" type="file" name="image"  accept="image/*" />
                        </div>


                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit">Add Product</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
