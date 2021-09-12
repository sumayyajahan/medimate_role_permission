@extends('layouts.admin')
@section('title','Edit Product')
@section('content')
@include('includes.banner',['one'=>'Product','two'=>'Edit'])

<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form class="form-group" action="{{ route('admin.product.update',$product->id) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Product</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="form">Form</label>
                            <select class="form-control" name="form" id="form" required>
                                <option value="">Select Form</option>
                                <option value="Syrup" {{ ($product->form == 'Syrup')? 'selected' : '' }}>Syrup</option>
                                <option value="Tablet" {{ ($product->form == 'Tablet')? 'selected' : '' }}>Tablet
                                </option>
                                <option value="Capsule" {{ ($product->form == 'Capsule')? 'selected' : '' }}>Capsule
                                </option>
                                <option value="Powder" {{ ($product->form == 'Powder')? 'selected' : '' }}>Powder
                                </option>
                                <option value="Cream" {{ ($product->form == 'Cream')? 'selected' : '' }}>Cream</option>
                                <option value="Other" {{ ($product->form == 'Other')? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Generic Name</label>
                            <input type="text" class="form-control" name="generic_name"
                                value="{{ $product->generic_name }}" required>
                        </div>
                        <div class="form-group">
                            <label>Manufacturer</label>
                            <input type="text" class="form-control" name="pharmaceutical"
                                value="{{ $product->pharmaceutical }}" required>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" min="1" step="any" class="form-control" name="price"
                                value="{{ $product->price }}" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category" required>
                                <option value="">Select Category</option>
                                <option value="Prescription"
                                    {{ ($product->category == 'Prescription')? 'selected' : '' }}>Prescription</option>
                                <option value="OTC" {{ ($product->category == 'OTC')? 'selected' : '' }}>OTC</option>
                                <option value="HP" {{ ($product->category == 'HP')? 'selected' : '' }}>Health Product</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Product  Image</label>
                            <img style="width:100px;" src="{{ asset('product/'.$product->image) }}">
                            <br>
                            <input class="form-control" type="file" name="image" accept="image/*" />
                        </div>


                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit">Update Product</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
