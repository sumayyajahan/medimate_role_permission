<!-- Created by Ariful Islam at 8/24/2021 - 2:03 AM -->
@extends('layouts.public_layout')
@section('title', 'Enroll Details')

@section('main-content')
    <br>
    <h3 align="center"> Enroll Details {{ $enroll->user->name }}</h3>
    <br>
    <div class="row">

        <div class="col-md-12">
            <table class="table table-hover table-bordered">
                <tbody>

                <tr>
                    <th> Name </th>
                    <td> {{ $enroll->name }}</td>
                </tr>

                <tr>
                    <th> Insurance package </th>
                    <td> {{ $enroll->insurancePackage->name  }}</td>
                </tr>

                <tr>
                    <th> Insurance </th>
                    <td> {{ \App\Models\Insurance::get_name_by_id($enroll->insurance_id) }}</td>
                </tr>

                <tr>
                    <th> Date of Birth </th>
                    <td> {{ $enroll->date_of_birth }}</td>
                </tr>

                <tr>
                    <th> Gender </th>
                    <td> {{ $enroll->user->gender }}</td>
                </tr>

                <tr>
                    <th> Marital Status </th>
                    <td> {{ $enroll->marital_status }}</td>
                </tr>

                <tr>
                    <th> Nominee name </th>
                    <td> {{ $enroll->nominee_name }}</td>
                </tr>

                <tr>
                    <th> Nominee Number </th>
                    <td> {{ $enroll->nominee_number }}</td>
                </tr>

                <tr>
                    <th> Nominee relation </th>
                    <td> {{ $enroll->nominee_relation }}</td>
                </tr>

                <tr>
                    <th> NID No </th>
                    <td> {{ $enroll->nid_no }}</td>
                </tr>


                <tr>
                    <th> NID </th>
                    <td><img src="{{ asset('images/'.$enroll->nid_front) }}" alt="" width="200px" height="100px"><img src="{{ asset('images/'.$enroll->nid_back) }}" alt="" width="200px" height="100px"></td>
                </tr>

                <tr>
                    <th> Status </th>
                    <td> {{ \App\Helpers\DataHelper::insurance_status()[$enroll->status] }}</td>
                </tr>

                <tr>
                    <th> Activation date </th>
                    <td> {{ $enroll->activation_date }}</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
