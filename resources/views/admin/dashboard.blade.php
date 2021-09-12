@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
@include('includes.banner',['one'=>'Admin','two'=>'Dashboard'])
<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-statistic-4">
                <div class="info-box7-block">
                    <h6 class="m-b-20 text-right">User Account Opened</h6>
                    <h4 class="text-right"><i class="fas fa-user-plus pull-left bg-indigo c-icon"></i>
                        <span>
                            {{ $users }}
                        </span>
                    </h4>
                    @if ($u_percent > 0)
                    <p class="mb-0 mt-3 text-muted"><i class="fas fa-arrow-circle-up col-green m-r-5"></i><span
                            class="text-success font-weight-bold">{{ $u_percent }}%</span> then previous month</p>
                    @else
                    <p class="mb-0 mt-3 text-muted"><i class="fas fa-arrow-circle-down col-red m-r-5"></i><span
                            class="text-danger font-weight-bold">{{ $u_percent }}%</span> then previous month</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-statistic-4">
                <div class="info-box7-block">
                    <h6 class="m-b-20 text-right">Registered Doctor</h6>
                    <h4 class="text-right"><i class="fas fa-money-check-alt pull-left bg-red c-icon"></i>
                        <span>
                            {{ $doctors }}
                        </span>
                    </h4>
                    @if ($d_percent > 0)
                    <p class="mb-0 mt-3 text-muted"><i class="fas fa-arrow-circle-up col-green m-r-5"></i><span
                            class="text-success font-weight-bold">{{ $d_percent }}%</span> then previous month</p>
                    @else
                    <p class="mb-0 mt-3 text-muted"><i class="fas fa-arrow-circle-down col-red m-r-5"></i><span
                            class="text-danger font-weight-bold">{{ $d_percent }}%</span> then previous month</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-statistic-4">
                <div class="info-box7-block">
                    <h6 class="m-b-20 text-right">Total Appointment Count</h6>
                    <h4 class="text-right"><i class="fas fa-dollar-sign pull-left bg-green c-icon"></i>
                        <span>
                            {{ $app }}
                        </span>
                    </h4>
                    @if ($a_percent > 0)
                    <p class="mb-0 mt-3 text-muted"><i class="fas fa-arrow-circle-up col-green m-r-5"></i><span
                            class="text-success font-weight-bold">{{ $a_percent }}%</span> then previous month</p>
                    @else
                    <p class="mb-0 mt-3 text-muted"><i class="fas fa-arrow-circle-down col-red m-r-5"></i><span
                            class="text-danger font-weight-bold">{{ $a_percent }}%</span> then previous month</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="card-statistic-4">
                <div class="info-box7-block">
                    <h6 class="m-b-20 text-right"><?= date('d M, Y') ?></h6>
                    <h4 class="text-right"><i class="fas fa-clock pull-left bg-blue c-icon"></i><span id="time"></span>
                    </h4>
                    <p class="mb-0 mt-3 text-muted"><i class="fas fa-arrow-circle-right col-blue m-r-5"></i><span
                            class="text-info font-weight-bold">{{ date_default_timezone_get() }}</span> Time Zone</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-8 col-md-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Appointment Chart</h4>
            </div>
            <div class="card-body">
                <ul class="list-inline text-center m-b-0">
                    <li class="list-inline-item p-r-30"><i data-feather="arrow-up-circle" class="col-green"></i>
                        <h5 class="m-b-0">{{ $completed_appointment }}</h5>
                        <p class="text-muted font-14 m-b-0">Completed</p>
                    </li>
                    <li class="list-inline-item p-r-30"><i data-feather="arrow-up-circle" class="col-orange"></i>
                        <h5 class="m-b-0">{{ $pending_appointment }}</h5>
                        <p class="text-muted font-14 m-b-0">Awaiting</p>
                    </li>

                </ul>
                <div id="revenue"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12 col-lg-4">
        <div class="card l-bg-purple">
            <div class="card-body">
                <div class="text-white">
                    <div class="row">
                        <div class="col-md-6 col-lg-5">
                            <h4 class="mb-0 font-26 text-white">{{ $avg_user }}</h4>
                            <p class="mb-2 text-white">User Registered Per Month in Average</p>
                            {{-- <p class="mb-0 text-white">
                                <span class="font-20"></span>
                            </p> --}}
                        </div>
                        <div class="col-md-6 col-lg-7">
                            <div class="sparkline-bar p-t-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card l-bg-cyan-dark">
            <div class="card-body">
                <div class="text-white">
                    <div class="row">
                        <div class="col-md-6 col-lg-5">
                            <h4 class="mb-0 font-26 text-white"> {{ $app }}</h4>
                            <p class="mb-2 text-white">New Appointment This Month</p>
                            <p class="mb-0 text-white">
                                @if ($a_percent > 0)
                                <span class="font-20">{{ $a_percent }}%</span> Increase
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 col-lg-7">
                            <div class="sparkline-inline p-t-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Doctor OnBoard</h4>
            </div>
            <div class="card-body">
                <div id="support-scroll">
                    <ul class="list-unstyled ">
                        @foreach ($latest5Doctor as $doctor)
                        <li class="media border-bottom m-b-10 support-ticket">
                            <img alt="image" class="mr-3 user-img" width="40"
                                src="{{ asset('images/' . $doctor->image) }}" alt="NO">
                            <div class="media-body">
                                <div class="media-right">
                                    @if ($doctor->appointmentSlot->count() == 0)
                                    <i class="fas fa-exclamation col-red"></i>

                                    @else
                                    <i class="fas fa-check-double col-green"></i>

                                    @endif
                                </div>
                                <div class="media-title mb-1">{{ $doctor->name }}</div>
                                <div class="text-muted font-12">{{ $doctor->specialization }}</div>
                                <div class="media-description">{{ $doctor->designation }}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Order Status <small>Pending more than 30 minutes</small></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="order-tbl-scroll">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Patient</th>
                                <th>Items</th>
                                <th>Pharmacy</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name . '-' . $order->user->mobile }}</td>
                                <td>
                                    @php
                                    if($order->prescription_product_name != NULL ){
                                    $p = explode(',', $order->prescription_product_name);
                                    $q = explode(',', $order->prescription_product_quantity);
                                    foreach ($p as $key => $item){
                                    echo $item ." * ". $q[$key];
                                    if(!($key === array_key_last($p))) echo ",&nbsp;";
                                    }
                                    }
                                    if($order->otc_product_id != NULL ){
                                    $p = explode(',', $order->otc_product_id);
                                    $q = explode(',', $order->otc_product_quantity);
                                    foreach ($p as $key => $item){
                                    echo $item ." * ". $q[$key];
                                    if(!($key === array_key_last($p))) echo ",&nbsp;";
                                    }
                                    }
                                    @endphp
                                </td>
                                <td>{{ $order->pharmacy->name . '-' . $order->pharmacy->mobile }}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-6 col-sm-6">
        <div class="card card-warning">
            <div class="card-header">
                <h4>Transaction Query (Wallet Transaction Report)</h4>
                <form id="transaction_search" class="card-header-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search" required>
                        <div class="input-group-btn">
                            <button id="trx-search" class="btn btn-primary btn-icon"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <marquee id="appear-here">Transaction Details will appear here.</marquee>
                <p id="transaction-result"> </p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3">
        <div class="card card-warning">
            <div class="card-header">
                <h4>Track Delivery</h4>
                <form id="transaction_search" class="card-header-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Delivery ID" required>
                        <div class="input-group-btn">
                            <button id="trx-search" class="btn btn-primary btn-icon"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <marquee id="appear-here">Details will appear here.</marquee>
                <p id="transaction-result"> </p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3">
        <div class="card card-danger">
            <div class="card-header">
                <h4>User Profile</h4>
            </div>
            <div class="card-body">
                <form class="card-header-form" action="{{route('admin.user.search')}}" method="get" target="_blank">
                    <div class="input-group">
                        <input type="text" name="userid" class="form-control" placeholder="USER ID" required>
                        <div class="input-group-btn">
                            <button class="btn btn-info-outline"><i class="fas fa-play"
                                    style="color:#EC7063; font-size: 2.5em !important;"></i></button>
                        </div>
                    </div>
                </form>
                <marquee>User Information will be displayed.</marquee>
            </div>

        </div>
    </div>

    {{-- <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="info-box7-block">
                        <h6 class="m-b-20 text-right">SMS Sent</h6>
                        <h4 class="text-right"><i class="fas fa-paper-plane pull-left bg-dark c-icon"></i>
                            <span>
                                100
                            </span>
                        </h4>
                    </div>
                </div>
                <div class="card-statistic-4">
                    <div class="info-box7-block">
                        <h6 class="m-b-20 text-right">Balance Left</h6>
                        <h4 class="text-right"><i class="fas fa-comments-dollar pull-left bg-dark c-icon"></i>
                            <span>
                                100
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
        </div> --}}
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<script>
    (function() {
            function checkTime(i) {
                return (i < 10) ? "0" + i : i;
            }

            function startTime() {
                var today = new Date(),
                    h = checkTime(today.getHours()),
                    m = checkTime(today.getMinutes()),
                    s = checkTime(today.getSeconds());
                document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
                t = setTimeout(function() {
                    startTime()
                }, 500);
            }
            startTime();
        })();

</script>
<script>
    var sparkline_values = [10, 7, 4, 8, 5, 8, 6, 5, 2, 4, 7, 4, 9, 6, 5, 9];
        var sparkline_values_chart = [2, 6, 4, 8, 3, 5, 2, 7];
        var sparkline_values_bar = [10, 7, 4, 8, 5, 8, 8, 6, 5, 2, 4, 7, 4, 9, 8, 6, 5, 2, 4, 7, 4, 9, 10, 2, 4, 7, 4, 9, 7,
            4, 8, 5, 8, 6, 5
        ];
        $(".sparkline-bar").sparkline(sparkline_values_bar, {
            type: "bar",
            width: "100%",
            height: "100",
            barColor: "white",
            barWidth: 2
        });
        $('.sparkline-inline').sparkline(sparkline_values, {
            type: 'line',
            width: '100%',
            height: '100',
            lineWidth: 1,
            lineColor: 'white',
            fillColor: 'rgba(87,75,144,.25)',
            highlightSpotColor: "rgba(63,82,227,.1)",
            highlightLineColor: "rgba(63,82,227,.1)",
            spotRadius: 3,
        });

</script>

<script>
    $('#transaction_search').on('submit', function(e) {
        e.preventDefault();
        $('#appear-here').hide();
        var transaction_id = $("input[name=search]").val();
        $.ajax({
        type: 'GET',
        url: './ajax/transaction-query/' + transaction_id,
        success: function(msg) {
        if (msg) {
        $('#transaction_search').trigger("reset");
        console.log(msg);
        var result = msg;
        var print_result = `Transaction Time: ${result.created_at}
        <br> Transaction Type : ${result.type}
        <br> Transaction Amount : BDT ${result.amount}
        <br> Payment Gateway : ${result.payment_gateway}
        <br> Payment Note : ${result.payment_note}`;
        $('#transaction-result').html(print_result);
        } else {
        $('#transaction-result').html("No Record Found");
        }
        }
        });
        });


</script>


@endsection