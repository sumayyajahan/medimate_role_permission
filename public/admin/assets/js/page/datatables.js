"use strict";

$("[data-checkboxes]").each(function () {
    var me = $(this),
        group = me.data('checkboxes'),
        role = me.data('checkbox-role');

    me.change(function () {
        var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
            checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
            dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
            total = all.length,
            checked_length = checked.length;

        if (role == 'dad') {
            if (me.is(':checked')) {
                all.prop('checked', true);
            } else {
                all.prop('checked', false);
            }
        } else {
            if (checked_length >= total) {
                dad.prop('checked', true);
            } else {
                dad.prop('checked', false);
            }
        }
    });
});

$("#table-1").dataTable({
    "columnDefs": [{
        "sortable": false,
        "targets": [2, 3]
    }]
});
$("#table-2").dataTable({
    "columnDefs": [{
        "sortable": false,
        "targets": [0, 2, 3]
    }],
    order: [
        [1, "asc"]
    ] //column indexes is zero based

});
$('#save-stage').DataTable({
    "scrollX": true,
    stateSave: true
});
$('#tableExport').DataTable({
    dom: 'Bfrtip',
    order:[[0,"desc"]],
    buttons: [{
            extend: 'copyHtml5',
            text: '<img style="width:50%" src="/icons/copy.png">',
            titleAttr: 'Copy',
                exportOptions: {
                    columns: ':not(:last-child)',
                    stripHtml: false
                }
        },
        {
            extend: 'excelHtml5',
            text: '<img style="width:50%" src="/icons/xls.png">',
            titleAttr: 'Excel',
                exportOptions: {
                    columns: ':not(:last-child)',
                    stripHtml: false
                }
        },
        {
            extend: 'csvHtml5',
            text: '<img style="width:50%" src="/icons/csv.png">',
            titleAttr: 'CSV',
                exportOptions: {
                    columns: ':not(:last-child)',
                    stripHtml: false
                }
        },
        {
            extend: 'pdfHtml5',
            text: '<img style="width:50%" src="/icons/pdf.png">',
            titleAttr: 'PDF',
                exportOptions: {
                    columns: ':not(:last-child)',
                    stripHtml: false
                }
        },
        {
            extend: 'print',
            text: '<img style="width:50%" src="/icons/print.png">',
            title: 'Medimate',
            exportOptions: {
                columns: ':not(:last-child)',
                stripHtml: false
            }
        }
    ]
});


// Setup - add a text input to each footer cell
$('#tableExportFilter thead tr').clone(true).appendTo('#tableExportFilter thead');
$('#tableExportFilter thead tr:eq(1) th').not(':last').each(function (i) {
    var title = $(this).text();
    $(this).html('<input type="text" placeholder="Search ' + title + '" />');

    $('input', this).on('keyup change', function () {
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

// Setup - add a text input to each footer cell
$('#tableExportReport thead tr').clone(true).appendTo('#tableExportReport thead');
$('#tableExportReport thead tr:eq(1) th').each(function (i) {
    var title = $(this).text();
    $(this).html('<input type="text" placeholder="Search ' + title + '" />');

    $('input', this).on('keyup change', function () {
        if (table.column(i).search() !== this.value) {
            table
                .column(i)
                .search(this.value)
                .draw();
        }
    });
});

var table = $('#tableExportReport').DataTable({
    dom: 'Bfrtip',
    buttons: [{
            extend: 'copyHtml5',
            text: '<img style="width:50%" src="/icons/copy.png">',
            titleAttr: 'Copy'
        },
        {
            extend: 'excelHtml5',
            text: '<img style="width:50%" src="/icons/xls.png">',
            titleAttr: 'Excel'
        },
        {
            extend: 'csvHtml5',
            text: '<img style="width:50%" src="/icons/csv.png">',
            titleAttr: 'CSV'
        },
        {
            extend: 'pdfHtml5',
            text: '<img style="width:50%" src="/icons/pdf.png">',
            titleAttr: 'PDF'
        },
        {
            extend: 'print',
            text: '<img style="width:50%" src="/icons/print.png">',
            title: 'Medimate Report',
        }
    ],
    orderCellsTop: true,
    fixedHeader: true
});
