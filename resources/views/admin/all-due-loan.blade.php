<?php
include_once './include/config.php';

$sql = "SELECT ua.member_id, lc.loan_id, lc.user_id, lc.last_collection_amount, lc.total_loan_repay_amount, lc.due_amount, lc.fine_imposed, lc.collection_date, lc.next_payment_date,lr.installment_amount, lr.repay_date, lr.total_amount FROM `loan_collection` AS lc LEFT JOIN loan_record AS lr ON lr.loan_id =  lc.loan_id LEFT JOIN user_account AS ua ON lc.user_id = ua.user_id  WHERE lr.sanction_status = 1 AND (lc.due_amount > 0 OR lr.repay_status = 0) ";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?php include 'include/header.php'; ?>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title m-b-0">Loan</h4>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="./dashboard.php">
                                <i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Manage</li>
                        <li class="breadcrumb-item">Due Loan</li>
                        <li class="breadcrumb-item">All</li>
                    </ul>
                    <div class="section-body" id="check">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Add Collection</h4>
                                    </div>
                                    <div class="card-body">
                                        <form id="loan_collection">
                                            <div class="form-inline mb-4" style="justify-content:space-between">

                                                <label>Total Loan (BDT)</label>
                                                <input type="number" id="total_amount" class="form-control" readonly>

                                                <label>Loan Due (BDT)</label>
                                                <input type="number" id="due_amount" class="form-control" readonly>

                                                <input type="hidden" name="loan_id" id="loan_id" required>

                                                <label>Installment Amount</label>
                                                <input type="number" id="installment_amount" class="form-control" required>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-danger pull-left" id="check-close">Close</button>
                                                <button type="submit" name="submit" class="btn btn-success pull-right">Add Collection</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Loan Collection</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>User ID</th>
                                                        <th>Loan ID</th>
                                                        <th>Collection Date</th>
                                                        <th>Last Collection</th>
                                                        <th>Repay Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $user_id = $row["user_id"];
                                                            $member_id = $row["member_id"];
                                                            $loan_id = $row["loan_id"];
                                                            $total_amount = $row["total_amount"];
                                                            $last_collection_amount = $row["last_collection_amount"];
                                                            $collection_date = $row["collection_date"];
                                                            $next_payment_date = $row["next_payment_date"];
                                                            $repay_date = $row["repay_date"];
                                                            $installment_amount = $row["installment_amount"];
                                                            $due_amount = $row["due_amount"];
                                                            $fine_imposed = $row["fine_imposed"];
                                                    ?>
                                                            <tr>
                                                                <td><a href="./view-more.php?user_id=<?= $user_id ?>"><?= $member_id ?></a></td>
                                                                <td> <a target="_blank" href="./view-loan.php?loan_id=<?= $loan_id ?>"> <?= $loan_id ?> </a> </td>
                                                                <td><?php if ($next_payment_date != "0000-00-00") echo date('d-m-Y', strtotime($next_payment_date)); ?></td>
                                                                <td><?php if ($last_collection_amount != 0) echo 'BDT ' . $last_collection_amount; ?> ( <?php if ($collection_date != NULL) echo date('d-m-y', strtotime($collection_date)); ?> )</td>
                                                                <td><?php if ($repay_date != NULL) echo date('d-m-Y', strtotime($repay_date)); ?></td>
                                                                <td>
                                                                    <button class="btn btn-primary" onclick="addCollection('<?= $loan_id ?>','<?= $due_amount ?>','<?= $installment_amount ?>','<?= $total_amount ?>');">Add Collection <i class="fa fa-plus-circle"></i></button></a>
                                                                    <button class="btn btn-info" onclick="view_loan('<?= $loan_id ?>');"><i class="fas fa-file-alt"></i></button></a>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php include 'include/footer.php'; ?>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <script src="assets/bundles/datatables/datatables.min.js"></script>
    <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
    <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
    <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
    <script src="assets/js/page/datatables.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <script>
        function view_loan(loan_id) {
            window.open("./view-loan.php?loan_id=" + loan_id);
        }

        $(document).ready(function() {
            $('#check').hide();
        });

        function addCollection(loan_id, da, ia, total_amount) {
            var due_amount = parseFloat(da);
            var installment_amount = parseFloat(ia);
            $('#check').show();
            $('#due_amount').val(due_amount);
            $('#total_amount').val(total_amount);
            $('#loan_id').val(loan_id);
            if (due_amount >= installment_amount) {
                $('#installment_amount').val(installment_amount);

                $("#installment_amount").attr({
                    "max": due_amount,
                    "min": installment_amount
                });
            }
            if (due_amount < installment_amount) {
                $('#installment_amount').val(due_amount);

                $("#installment_amount").attr({
                    "max": due_amount,
                    "min": due_amount
                });
            }
        }

        $("#check-close").click(function() {
            $('#check').hide();
        });


        $('#loan_collection').on('submit', function(e) {
            e.preventDefault();
            var loan_id = $("#loan_id").val();
            var last_collection_amount = $("#installment_amount").val();
            $.ajax({
                type: 'POST',
                url: './ajax/loan-collection.php',
                data: {
                    'loan_id': loan_id,
                    'last_collection_amount': last_collection_amount
                },
                success: function(msg) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Loan Collection',
                        html: msg
                    }).then((result) => {
                        // Reload the Page
                        location.reload();
                    });
                }
            });
        });
    </script>
</body>


<!-- Mirrored from radixtouch.in/templates/admin/zivi/source/light/export-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Feb 2020 19:58:18 GMT -->

</html>