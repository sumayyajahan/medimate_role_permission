@extends('layouts.admin')
@section('title','Recharge')
@section('content')
@include('includes.banner',['one'=>'Recharge','two'=>'Create'])
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form id="add-account" class="form-group" action="add-account.php" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h4>Recharge</h4>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label>User</label>
                            <select class="form-control" name="district" id="">
                                <option value="">Select User</option>
                                <option value="">User 1</option>
                                <option value="">User 2</option>
                                <option value="">User 3</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" class="form-control" name="name" required>
                        </div>

                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary mr-1" type="submit" name="submit">Recharge</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
