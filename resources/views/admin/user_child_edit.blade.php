@extends('layouts.admin')
@section('title', 'Separate User Child')
@section('content')
@include('includes.banner',['one'=>'User Child','two'=>'Separate'])
<div class="section-body">
    <div class="row">
        {{-- <form action="{{route('admin.user.store')}}" method="POST">
        @csrf
        <input type="text" name="ratul" />
        <input type="submit" value="submit">
        </form> --}}
        <div class="col-12 col-md-12 col-lg-12">
            <form id="" class="form-group" action="{{ route('admin.user.child.update',$user->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Separate User Child</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label> Mobile No.</label>
                            <input minlength="11" maxlength="11" value="" type="text" class="form-control" name="mobile"
                                placeholder="01XXXXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label> Email.</label>
                            <input value="" type="text" class="form-control" name="email" placeholder="">
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <input class="btn btn-primary mr-1" type="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection