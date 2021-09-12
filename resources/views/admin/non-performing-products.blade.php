@extends('layouts.admin')
@section('title','Non Performing Products')
@section('content')
@include('includes.banner',['one'=>'Non Performing Products','two'=>'Create'])

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Non Performing Products</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Product's ID</th>
                                                        <th>Product's Name</th>
                                                        <th>Searched Count</th>
                                                        <th>Ordered Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>18</td>
                                                        <td>Adovas</td>
                                                        <td>0</td>
                                                        <td>0</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endsection