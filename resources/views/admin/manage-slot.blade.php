@extends('layouts.admin')
@section('title','View Slot')
@section('content')
@include('includes.banner',['one'=>'Doctor Slot','two'=>'View'])
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Doctor`s Slot View</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExportFilter" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Doctor ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Days</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>Test Name</td>
                                    <td>0125479654</td>
                                    <td>Cardiology</td>
                                    <td>01:00</td>
                                    <td>03:00</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Test Name 2</td>
                                    <td>0125479654</td>
                                    <td>ENT</td>
                                    <td>10:30</td>
                                    <td>11:30</td>
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
