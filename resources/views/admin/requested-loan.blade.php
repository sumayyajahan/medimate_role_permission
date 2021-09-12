<?php
include_once './include/config.php';

$sql = "SELECT *, user_account.member_id FROM loan_record LEFT JOIN user_account ON loan_record.user_id = user_account.user_id WHERE sanction_status = 0";
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
                        <li class="breadcrumb-item">Requested Loan</li>
                    </ul>
                    <div class="section-body" id="check">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Check Eligibility</h4>
                                    </div>
                                    <div class="card-body">
                                        <h6 id="success" class="text-success"></h6>
                                        <h4 id="warning" class="text-danger"></h4>
                                        <h6>Total Savings (BDT)</h6>
                                        <p id="total_savings"></p>
                                        <h6>Savings Due (Days)</h6>
                                        <p id="savings_due"></p>
                                        <h6>Loan Due (Day) <small>Last loan repay date exceeded</small> </h6>
                                        <p id="loan_due"></p>
                                        <h6>Loan Collection Due Amount (BDT)</h6>
                                        <p id="loan_collection_due"></p>
                                        <h6>Defaulted Loans (Numbers)</h6>
                                        <p id="defaulted_loan"></p>

                                        <div class="text-right" id="check-close">
                                            <button class="btn btn-danger">Close</button>
                                        </div>
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
                                        <h4>Requested Loan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>User ID</th>
                                                        <th>Requested Time</th>
                                                        <th>Requested Slab</th>
                                                        <th>Installment Number</th>
                                                        <th>Check Eligibility</th>
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
                                                            $record_add_time = $row["record_add_time"];
                                                            $slab = $row["slab"];
                                                            $total_amount = $row["total_amount"];
                                                            $installment_number = $row["installment_number"];
                                                    ?>
                                                            <tr>
                                                                <td><a href="./view-more.php?user_id=<?= $user_id ?>"><?= $member_id ?></a></td>
                                                                <td><?= date('d-m-y h:i:s a', strtotime($record_add_time)) ?></td>
                                                                <td><?= $slab ?></td>
                                                                <td><?= $installment_number ?></td>
                                                                <td>
                                                                    <a href="javascript:void();" onclick="checkeligibility('<?= $user_id ?>','<?= $total_amount ?>');"> <button class="btn btn-outline-info">Check <i class="fa fa-info-circle"></i></button></a>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-success m-1 px-3" onclick="approve('<?= $loan_id ?>');">Approve &nbsp;<i class="fa fa-check-square"></i></button></a>
                                                                    <button class="btn btn-danger m-1 px-3" onclick="decline('<?= $loan_id ?>');">Decline <i class="fa fa-times-circle"></i></button></a>
                                                                    <br>
                                                                    <button class="btn btn-warning m-1" onclick="edit_loan('<?= $loan_id ?>');"><i class="fas fa-edit">Edit Loan</i></button></a>
                                                                    <button class="btn btn-info m-1 px-4" onclick="view_loan('<?= $loan_id ?>');"><i class="fas fa-file-alt">&nbsp;View</i></button></a>
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
        $(document).ready(function() {
            $('#check').hide();
        });

        $("#check-close").click(function() {
            $('#check').hide();
        });

        function view_loan(loan_id) {
            window.open("./view-loan.php?loan_id=" + loan_id);
        }

        function edit_loan(loan_id) {
            window.open("./edit-loan.php?loan_id=" + loan_id);
        }


        function checkeligibility(user_id, total_amount) {
            $('#check').show();
            $.ajax({
                type: "POST",
                url: "./ajax/check-user.php",
                data: 'user_id=' + user_id,
                success: function(data) {
                    console.log(data);
                    var result = $.parseJSON(data);
                    $("#total_savings").text(result.savings_amount);
                    $("#savings_due").text(result.savings_due);
                    $("#loan_due").text(result.loan_due);
                    $("#loan_collection_due").text(result.loan_collection_due);
                    $("#defaulted_loan").text(result.cnt);
                    if (result.savings_amount >= total_amount * 0.6) {
                        $("#success").text("User has 60% of savings");
                    } else $("#warning").text("User has less Savings");
                }
            });
        }

        function approve(loan_id) {
            Swal.fire({
                title: 'Loan will be sanctioned to User, Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#2e856e',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve Loan'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "./ajax/approve-user-loan.php",
                        data: 'loan_id=' + loan_id,
                        success: function(data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                html: data,
                                showConfirmButton: false,
                                timer: 1500,
                                onClose: () => {
                                    location.reload();
                                }
                            })
                        }
                    });
                }
            })
        }

        function decline(loan_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Decline Loan'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "./ajax/decline-user-loan.php",
                        data: 'loan_id=' + loan_id,
                        success: function(data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                html: data,
                                showConfirmButton: false,
                                timer: 1500,
                                onClose: () => {
                                    location.reload();
                                }
                            })
                        }
                    });
                }
            })
        }
    </script>
</body>

</html>