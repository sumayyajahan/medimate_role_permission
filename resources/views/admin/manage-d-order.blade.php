@extends('layouts.admin')
@section('title','Delivered Orders')
@section('content')
@include('includes.banner',['one'=>'Orders','two'=>'Delivered'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Delivered Orders</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User Name</th>
                                    <th>Items * Quantity</th>
                                    <th>Bill Amount</th>
                                    <th>Pharmacy</th>
                                    <th>Delivery Address</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)
                                <tr>
                                    <td> {{$order->id}} </td>
                                    <td> {{$order->user->name}} / {{ $order->user->mobile }}</td>
                                    <td>
                                        @php
                                        if($order->prescription_product_name != NULL ){
                                        $p = explode(',', $order->prescription_product_name);
                                        $q = explode(',', $order->prescription_product_quantity);
                                        foreach ($p as $key => $item){
                                        echo $item ." * ". $q[$key];
                                        echo ", ";
                                        }
                                        }
                                        @endphp
                                    </td>
                                    <td> {{$order->amount}} </td>
                                    <td> {{ $order->pharmacy->name }} </td>
                                    <td> {{ $order->user->address }} </td>
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
