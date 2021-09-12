@extends('layouts.admin')
@section('title','Commission Setup Charge')
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
                                        Setup Commission
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form class="composeForm" method="POST" action=" {{ route('admin.commission.store') }} ">
                            <!-- <form class="composeForm" method="POST" action="p.php"> -->
                            @csrf

                            <div class="form-group">
                                <label>Select Service Provider</label>
                                <select class="js-example-basic-single form-control" required name="service_provider_id" id="service_provider">
                                    <option value="">Select Service Provider</option>
                                    @foreach ($service_providers as $service_provider)
                                    <option value="{{ $service_provider->id }}">{{ $service_provider->name  }} / {{ $service_provider->mobile }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <label for="personal_recharge">Personal Recharge</label>
                                    <input type="number" name="personal_recharge" id="personal_recharge" class="form-control" placeholder="Personal Recharge" required>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="family_recharge">Family Recharge</label>
                                    <input type="number" id="family_recharge" name="family_recharge" class="form-control" placeholder="Family Recharge" required>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="patient_recharge">Patient Recharge</label>
                                    <input type="number" id="patient_recharge" name="patient_recharge" class="form-control" placeholder="Patient Recharge" required>

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
    $('#service_provider').select2();
    $('#service_provider').on('select2:select', function() {
        getVisitCharge(this.value);
    });

    function getVisitCharge(id) {
        $.get('commission-charge/' + id, function(data, status) {
            var val = data;

            $('#personal_recharge').val(val.personal_recharge);
            $('#family_recharge').val(val.family_recharge);
            $('#patient_recharge').val(val.patient_recharge);
        });
    }

</script>
@endsection

