@extends('layouts.admin')
@section('title','Notify User')
@section('content')
@include('includes.banner',['one'=>'Notification','two'=>'Create'])
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
                                        Notify
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form class="composeForm" method="POST" action=" {{ route('admin.notify') }} ">
                            <!-- <form class="composeForm" method="POST" action="p.php"> -->
                            @csrf
                            <div class="form-group">
                                <label>Notification Receiver</label>
                                <select class="form-control" name="group" id="group">
                                    <option value="">Select Group</option>
                                    <option value="su">Specific User</option>
                                    <option value="sd">Specific Doctor</option>
                                    <option value="sp">Specific Pharmacy</option>
                                    <option value="ssp">Specific Service Provider</option>
                                    <option value="gu">Grouped User</option>
                                    <option value="gd">Grouped Doctor</option>
                                    <option value="gp">Grouped Pharmacy</option>
                                    <option value="gsp">Grouped Service Provider</option>
                                    <option value="au">All User</option>
                                    <option value="ad">All Doctor</option>
                                    <option value="ap">All Pharmacy</option>
                                    <option value="asp">All Service Provider</option>
                                    <option value="all">All</option>

                                </select>
                            </div>
                            <div class="form-group" id="receiveDiv">
                                <div class="form-line">
                                    <label for="receiver">Receiver</label>
                                    <select class="js-states form-control js-example-basic-multiple" multiple="multiple"
                                        name="receiver[]" id="receiver">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="title" class="form-control"
                                        placeholder="Notification Title" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="body" class="form-control" placeholder="Notification Body"
                                        required>
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="m-l-25 m-b-20">
                            <button type="submit" class="btn btn-info btn-border-radius waves-effect">Send</button>
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
    $('#receiver').select2();
    $('#receiveDiv').hide();

    var group;
    $("#group").on('change', function(e) {
        if (this.value == 'all' || this.value == 'au' || this.value == 'ad' || this.value == 'ap'|| this.value == 'asp') $('#receiveDiv').hide();
        else $('#receiveDiv').show();

        if (this.value == 'su' || this.value == 'gu') {
            group = "user"
        };
        if (this.value == 'sd' || this.value == 'gd') {
            group = "doctor"
        };
        if (this.value == 'sp' || this.value == 'gp') {
            group = "pharmacy"
        };
        if (this.value == 'ssp' || this.value == 'gsp') {
            group = "service"
        };

        if (this.value !== 'all' || this.value !== '') {
            $.post('list', {
                group: group,
                _token: "{{ csrf_token() }}"
            }, function(result) {
                $('#receiver').html(result);
            });
        }

        if (this.value == 'su' || this.value == 'sd' || this.value == 'sp'|| this.value == 'ssp') {
            $('#receiver').attr('name', 'receiver');
            $('#receiver').prop('multiple', "");
            $('#receiver').removeClass('js-example-basic-multiple');
            $('#receiver').addClass('js-example-basic-single');

        } else {
            $('#receiver').attr('name', 'receiver[]');
            $('#receiver').prop('multiple', "multiple");
            $('#receiver').removeClass('js-example-basic-single');
            $('#receiver').addClass('js-example-basic-multiple');
        }



    });
</script>
@endsection