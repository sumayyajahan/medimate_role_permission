<!-- Created by Ariful Islam at 6/6/2021 - 11:27 AM -->
@extends('layouts.admin')
@section('title','Roles')
@section('content')
    @include('includes.banner',['one'=>'Roles','two'=>'View'])
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="justify-content: space-between;">
                        <b style="font-size:large;">Manage Role</b>
                        <span><a class="btn btn-success" href="">Add New Role</a></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_id">
                                <thead>
                                    <tr>
                                        <th>Col1</th>
                                        <th>Col2</th>
                                        <th>Col3</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>data-1a</td>
                                        <td>data-1b</td>
                                        <td>data-1c</td>
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
@push('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

@endpush
