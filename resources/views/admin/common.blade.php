@extends('layouts.admin')
@section('title','View Common Docs')
@section('content')
@include('includes.banner',['one'=>'Common','two'=>'Docs'])

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Documents</h4>
                </div>
                <div class="card-body">
                    <form action=" {{ route('admin.faq') }} " method="post">
                        @csrf
                        <label for="faq">
                            <h5>Frequently Asked Questions</h5>
                        </label>
                        <textarea class="form-control" name="faq" id="faq">{!! $faq->details !!}</textarea>
                        <hr>
                        <label for="tnc">
                            <h5>
                                Terms And Conditions
                            </h5>
                        </label>
                        <textarea class="form-control" name="tnc" id="tnc">{!! $tnc->details !!}</textarea>
                        <hr>
                        <label for="rp">
                            <h5>
                                Refund Policy
                            </h5>
                        </label>
                        <textarea class="form-control" name="rp" id="rp">{!! $rp->details !!}</textarea>
                        <br>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('faq');
    CKEDITOR.replace('tnc');
    CKEDITOR.replace('rp');
</script>
@endsection
