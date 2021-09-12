<?php
include_once './include/config.php';

$sql = "SELECT *, user_account.member_id FROM loan_record LEFT JOIN user_account ON loan_record.user_id = user_account.user_id WHERE sanction_status = 1";
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
                        <li class="breadcrumb-item">Loan History</li>
                    </ul>

               

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h4>Loan History</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>User ID</th>
                                                        <th>Loan Sanction Date</th>
                                                        <th>Slab</th>
                                                        <th>Repayed ?</th>
                                                        <th>View Full Report</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $user_id = $row["user_id"];
                                                            $member_id = $row["member_id"];
                                                            $loan_id = $row["loan_id"];
                                                            $lending_date = $row["lending_date"];
                                                            $slab = $row["slab"];
                                                            $yes = '<i class="fas fa-check fa-lg col-green"></i> Yes';
                                                            $no = '<i class="fas fa-times fa-lg col-red"></i> No';
                                                            $repay_status_view = $row['repay_status'] == 1 ? $yes :  $no;

                                                    ?>
                                                            <tr>
                                                                <td><a href="./view-more.php?user_id=<?= $user_id ?>"><?= $member_id ?></a></td>
                                                                <td><?= date('d-m-Y', strtotime($lending_date)) ?></td>
                                                                <td><?= $slab ?></td>
                                                                <td><?= $repay_status_view ?></td>

                                                                <td>
                                                                    <button class="btn btn-info" onclick="view_loan('<?= $loan_id ?>');"><i class="fas fa-file-alt"></i>&nbsp; Loan Report</button></a>
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
    </script>
</body>

</html>