@extends('layouts.admin')
@section('title','View Products')
@section('content')
@include('includes.banner',['one'=>'Products','two'=>'View All'])


<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Manage Products</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Form</th>
                                    <th>Generic Name</th>
                                    <th>Pharmaceutical</th>
                                    <th>Price</th>
                                    {{-- <th>Image</th> --}}
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->form }}</td>
                                    <td>{{ $product->generic_name }}</td>
                                    <td>{{ $product->pharmaceutical }}</td>
                                    <td>{{ $product->price }}</td>
                                    {{-- <td>
                                        <img style="width:60px;" src="{{ asset('product/'.$product->image) }}">
                                    </td> --}}
                                    <td>{{ $product->category }}</td>
                                    <td class="d-flex">
                                        {{-- <a href="{{route('admin.product.show',$product->id)}}">
                                        <button class="m-1 btn btn-primary">View</button></a> --}}
                                        <a href="{{route('admin.product.edit',$product->id)}}">
                                            <button class="m-1 btn btn-white"><img src="/icons/edit.png" style="width:50px;"></button></a>

                                        <a class="m-1 btn btn-white" href="#"
                                            onclick="if (confirm('Are you sure to delete?')){document.getElementById('delete-form-{{$product->id}}').submit();}else{event.preventDefault()}">
                                            <img src="/icons/discard.png" style="width:50px;"></a>
                                        <form id="delete-form-{{$product->id}}"
                                            action="{{ route('admin.product.destroy',$product->id) }}" method="POST"
                                            style="display: none;">
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
