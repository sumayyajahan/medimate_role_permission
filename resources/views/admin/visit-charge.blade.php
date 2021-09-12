@extends('layouts.admin')
@section('title','Setup Charge')
@section('content')
@include('includes.banner',['one'=>'Doctor Visit Charge','two'=>'Setup'])
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<div class="section-body">
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <div class="card">
            <div class="boxs mail_listing">
                <div class="inbox-center table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th colspan="1">
                                    <div class="inbox-header">
                                        Setup Visiting Charge
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form class="composeForm" method="POST" action=" {{ route('admin.visit-charge.store') }} ">
                            <!-- <form class="composeForm" method="POST" action="p.php"> -->
                                @csrf

                            <div class="form-group">
                                <label>Select Doctor</label>
                                <select class="js-example-basic-single form-control" required name="doctor_id" id="doctor">
                                    <option value="">Select Doctor</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name  }} / {{ $doctor->designation }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <label for="visit_charge">Doctor's Visit</label>
                                    <input type="number" name="visit_charge" id="visit_charge" class="form-control"
                                        placeholder="Doctor's Charge" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="commission">Service Charge</label>
                                    <input type="number" id="commission" name="commission" class="form-control" placeholder="Service Charge"
                                        required>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="m-l-25 m-b-20">
                            <button type="submit" class="btn btn-info btn-border-radius waves-effect">Update</button>
                            <button type="reset" class="btn btn-danger btn-border-radius waves-effect">Discard</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$('#doctor').select2();
$('#doctor').on('select2:select', function()
{
getVisitCharge( this.value );
});
function getVisitCharge(id){
   $.get('visit-charge/'+id, function(data, status) {
    var val = data;
    console.log(val.visit_charge);
       $('#visit_charge').val(val.visit_charge);
       $('#commission').val(val.commission);
   });
}
</script>
@endsection
