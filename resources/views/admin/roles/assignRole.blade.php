<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title', 'Add Role')
@section('content')
    @include('includes.banner',['one'=>'Assign Role to User','two'=>'Create'])

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form class="form-group" action="{{ url('rt-admin/storeRoleToAdmin') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Assign Role to User</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Select Service Type</label>
                                <select name="service_type" id="service_type_id" class="form-control">
                                    <option value="">-select service type-</option>
                                    @foreach ($service_types as $service_type)
                                        <option value="{{ $service_type->id }}">{{ $service_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Select Service Person</label>
                                <select name="person_name" id="person_id" class="form-control">
                                    <option value="">-select person-</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Assign Role</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value="">-select roles-</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="card-footer text-left">
                            <button class="btn btn-primary mr-1" type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $("#checkAll").click(function() {
            if ($(this).is(':checked') == false) {
                $("input[type='checkbox']").prop('checked', false);
            } else {
                $("input[type='checkbox']").prop('checked', true);
            }
        });

        $('#service_type_id').change(function() {
            var serviceType = $(this).val();
            $("#person_id").html("<option>-select a person-</option>");
            $.ajax({
                type: "GET",
                url: "{{ url('/rt-admin/getServices') }}",
                data: {
                    service_type_id: serviceType
                },
                dataType: 'json',
                success: function(res) {
                    res.forEach(el => {
                        $("#person_id").append("<option value='" + el.id + "'>" + el.name +"</option>");
                    })
                }
            });

        });
    </script>
@endsection

