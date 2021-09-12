@extends('layouts.admin')
@section('title','View Previous Appointments')
@section('content')
@include('includes.banner',['one'=>'Previous Appointments','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Previous Appointments View</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportFilter" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Doctor ID</th>
                                    <th>Doctor's Name</th>
                                    <th>Department</th>
                                    <th>Appointment Date</th>
                                    <th>Appointment Time</th>
                                    <th>View E-Prescription</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>User - 1</td>
                                    <td>Doctor - 1</td>
                                    <td>Test Name</td>
                                    <td>ENT</td>
                                    <td>12/09/2020</td>
                                    <td>01:00</td>
                                    <td> <button class="btn btn-info"><i class="fas fa-file-alt"></i></button>  </td>
                                </tr>
                                <tr>
                                    <td>User - 2</td>
                                    <td>Doctor - 2</td>
                                    <td>Test Name2</td>
                                    <td>ENT</td>
                                    <td>22/09/2020</td>
                                    <td>10:30b</td>
                                    <td> <button class="btn btn-info"><i class="fas fa-file-alt"></i></button>  </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#tableExportFilter thead tr').clone(true).appendTo('#tableExportFilter thead');
        $('#tableExportFilter thead tr:eq(1) th').each(function(i) {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

        var table = $('#tableExportFilter').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', {
                extend: 'print',
                title: 'Report View',
            }],
            orderCellsTop: true,
            fixedHeader: true
        });

    });
</script>
@endsection
