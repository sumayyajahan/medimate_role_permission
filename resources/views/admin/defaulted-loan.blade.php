<?php
include_once './include/config.php';

$sql = "SELECT *, DATEDIFF('" . date('Y-m-d') . "',repay_date) AS delayed_days, user_account.member_id FROM `loan_record` LEFT JOIN user_account ON loan_record.user_id = user_account.user_id WHERE sanction_status = 1 AND repay_status = 0 AND repay_date < '" . date('Y-m-d') . "'";
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
                        <li class="breadcrumb-item">Defaulted Loan</li>
                    </ul>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Defaulted Loan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>User ID</th>
                                                        <th>Loan ID</th>
                                                        <th>Total Amount</th>
                                                        <th>Delayed Days</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $user_id = $row["user_id"];
                                                            $member_id = $row["member_id"];
                                                            $loan_id = $row["loan_id"];
                                                            $delayed_days = $row["delayed_days"];
                                                            $total_amount = $row["total_amount"];
                                                    ?>
                                                            <tr>
                                                                <td><a href="./view-more.php?user_id=<?= $user_id ?>"><?= $member_id ?></a></td>
                                                                <td> <a target="_blank" href="./view-loan.php?loan_id=<?= $loan_id ?>"> <?= $loan_id ?> </a> </td>
                                                                <td><?= $total_amount ?></td>
                                                                <td><?= $delayed_days ?></td>
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

</body>

</html>