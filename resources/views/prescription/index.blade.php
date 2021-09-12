<!doctype html>
<html lang="en">

<!-- Mirrored from raisa061.github.io/e-prescription.github.io/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Nov 2020 02:42:00 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prescription</title>
    <link rel="stylesheet" href="{{ asset('asset_p/style.css')  }}">
    <link rel="stylesheet" href="{{ asset('asset_p/css/bootstrap.min.css')  }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row curve">
            <div class="col text-center">
                <a href="#" id="down" onClick="window.print()" class="text-right btn download-btn"><img
                        src="https://img.icons8.com/metro/26/000000/download.png" /></a>
                <img src="/admin/assets/img/logo.png" alt="logo" class="logo">
            </div>
        </div>
    </div>

    <div class="row m-3"></div>

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h3 class="custom-font font-weight-bold text-secondary pres">Prescriptions</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-3"></div>

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-6 doc-details">
                    <h4 class="text-primary font-weight-light custom-font">{{ $ePrescription->doctor->name }}</h4>
                    <p class="custom-font text-secondary">{{ $ePrescription->doctor->degree }}</p>
                    <p class="font-weight-bold custom-font text-secondary serial">#{{ $ePrescription->id }}</p>
                </div>
                <div class="col-md-5 col-5">
                    <p class="text-right custom-font text-secondary date"> <span
                            class="font-weight-bold custom-font text-secondary">Date</span> :
                        {{ $ePrescription->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!--Form start-->
    <form action="#">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="border"><input type="text" value="NAME : {{ $ePrescription->user->name }}" readonly
                                class="w-100 h-100 border-0 custom-font"></p>
                    </div>
                    <div class="col-md-3">
                        <p class="border"><input type="text" value="GENDER : {{ $ePrescription->user->gender }}"
                                readonly class="w-100 border-0 custom-font"></p>
                    </div>
                    <div class="col-md-3">
                        <p class="border"><input type="text"
                                value="AGE : {{ Carbon\Carbon::parse($ePrescription->user->dob)->age }}" readonly
                                class="w-100 border-0 custom-font"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="border"><input type="text" value="PHONE : {{ $ePrescription->user->mobile }}" readonly
                                class="w-100 border-0 custom-font"></p>
                    </div>
                    <div class="col-md-6">
                        <p class="border"><input type="text" value="Member ID : {{ $ePrescription->user->userid }}"
                                readonly class="w-100 border-0 custom-font"></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--Form end-->

    <div class="row m-3"></div>
    <!--For desktop view-->
    <div class="large d-none d-md-block main">
        <!--Complaints & RX heading start-->
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 box-header p-3">
                        <p class="font-weight-bold text-white text-center m-0 p-0 custom-font">Complaints</p>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-md-8 box-header p-3">
                        <p class="font-weight-bold text-white text-center custom-font m-0 p-0">Medications</p>
                    </div>


                </div>
            </div>
        </div>
        <!--Complaints & RX heading end-->

        <!--Complaints & RX boxes start-->
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 border com box">
                        <div class="text">
                            <p>{{ $complaintAndHistory[0] ?? '' }}</p>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-8 border rx box">
                        <div class="text">
                            <h3>Rx</h3>
                            @foreach ($rxRow as $r)
                            @php
                            $rr = explode(',', $r);
                            @endphp
                            <p>{{ $rr[0] ?? '' }} <span class="border-left border-right m-3 p-2"> {{ $rr[1] ?? '' }}
                                </span>{{ $rr[2]  ?? '' }} Days <br> {{ $rr[3] ?? '' }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Complaints & RX boxes end-->

        <!--History heading start-->
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 box-header mt-h p-3">
                        <p class="font-weight-bold text-white text-center custom-font m-0 p-0">History</p>
                    </div>
                </div>
            </div>
        </div>
        <!--History heading end-->

        <!--History box start-->
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 border com history box">
                        <div class="text">
                            <p>{{  $complaintAndHistory[1] ?? ''  }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--History box end-->

        <!--Investigation  & follow-up heading start-->
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 box-header p-3">
                        <p class="font-weight-bold text-white text-center custom-font m-0 p-0">Investigation </p>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-8 box-header p-3">
                        <p class="font-weight-bold text-white text-center custom-font m-0 p-0">Advice</p>
                    </div>
                </div>
            </div>
        </div>
        <!--Investigation  & follow-up heading end-->

        <!--Investigation  & follow-up boxes start-->
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 border com box">
                        <div class="text">
                            <p>{{ $ePrescription->oe }}</p>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-8 border com box">
                        <div class="text">
                            <p>{{ $ePrescription->advice }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-3"></div>
    <!--Investigation  & follow-up boxes end-->


    <!--For mobile view-->
    <div class="small d-block d-md-none">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <!--complaints section start-->
                    <div class="col-12 box-header">
                        <p class="font-weight-bold text-white text-center m-0 p-0">Complaints</p>
                    </div>
                    <div class="col-12 border com box">
                        <div>
                            <p> {{ $complaintAndHistory[0] ?? '' }} </p>
                        </div>
                    </div>
                    <!--complaints section end-->
                    <div class="row m-3"></div>
                    <!--Rx section start-->
                    <div class="col-12 box-header">
                        <p class="font-weight-bold text-white text-center m-0 p-0">Medications</p>
                    </div>
                    <div class="col-md-8 border rx box">
                        <div class="text">
                            <h3>Rx</h3>
                            @foreach ($rxRow as $r)
                            @php
                            $rr = explode(',', $r);
                            @endphp
                            <p>{{ $rr[0] ?? '' }} <span class="border-left border-right m-3 p-2"> {{ $rr[1] ?? '' }}
                                </span>{{ $rr[2]  ?? '' }} days <br> {{ $rr[3] ?? '' }} </p>
                            @endforeach
                        </div>
                    </div>
                    <!--Rx section end-->
                    <div class="row m-4"></div>
                    <!--History section start-->
                    <div class="col-12 box-header">
                        <p class="font-weight-bold text-white text-center m-0 p-0">History</p>
                    </div>
                    <div class="col-12 border com box">
                        <div class="text">
                            <p>{{ $complaintAndHistory[1] ?? '' }}</p>
                        </div>
                    </div>
                    <!--History section end-->
                    <div class="row m-3"></div>
                    <!--Investigation  start-->
                    <div class="col-12 box-header">
                        <p class="font-weight-bold text-white text-center m-0 p-0">Investigation </p>
                    </div>
                    <div class="col-md-3 border com box">
                        <div class="text">
                            <p>{{ $ePrescription->oe }}</p>
                        </div>
                    </div>
                    <!--Investigation  end-->
                    <div class="row m-3"></div>
                    <!--Advice start-->
                    <div class="col-12 box-header">
                        <p class="font-weight-bold text-white text-center m-0 p-0">Advice</p>
                    </div>
                    <div class="col-md-8 border com box">
                        <div class="text">
                            <p>{{ $ePrescription->advice }}</p>
                        </div>
                    </div>
                    <!--Advice end-->
                    <div class="row m-3"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row box-header footer-text">
            <div class="col text-center custom-font ">
                <h4><small>This is an electronically generated report, hence does not require signature</small></h4>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('asset_p/js/bootstrap.min.js') }}"></script>
    {{-- <script src="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script> --}}
</body>

<!-- Mirrored from raisa061.github.io/e-prescription.github.io/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Nov 2020 02:42:02 GMT -->

</html>