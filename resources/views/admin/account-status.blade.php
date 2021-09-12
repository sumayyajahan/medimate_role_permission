<?php
include_once './include/config.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $count_defaulted_loan = "SELECT COUNT(*) AS cnt FROM `loan_record` WHERE sanction_status = 1 AND repay_date < actual_repay_date AND user_id =" . $user_id;
    $row_count_defaulted_loan = mysqli_fetch_assoc($conn->query($count_defaulted_loan));

    $count_loan_due = "SELECT DATEDIFF('" . date('Y-m-d') . "',repay_date) AS diff FROM `loan_record` WHERE sanction_status = 1 AND repay_status = 0 AND user_id =" . $user_id . " ORDER by lending_date desc LIMIT 1";
    $row_count_loan_due = mysqli_fetch_assoc($conn->query($count_loan_due));

    $sql_savings_due = "SELECT savings_date, DATEDIFF('" . date('Y-m-d') . "',next_payment_date) AS diff FROM `savings_record` WHERE user_id =" . $user_id . " ORDER by savings_date desc LIMIT 1";
    $row_savings_due = mysqli_fetch_assoc($conn->query($sql_savings_due));

    $get_last_slab_sql = "SELECT slab, slab.* FROM loan_record  LEFT JOIN slab ON `slab` = slab.slab_id WHERE sanction_status = 1 AND user_id =" . $user_id .  " ORDER by lending_date desc LIMIT 1";
    $row_get_last_slab = mysqli_fetch_assoc($conn->query($get_last_slab_sql));


    $sql_loan = "SELECT loan_record.*, loan_collection.fine_imposed FROM loan_record LEFT JOIN loan_collection ON loan_record.loan_id = loan_collection.loan_id WHERE loan_record.sanction_status = 1 AND  loan_record.user_id =" . $user_id;

    $sql_get_savings = "SELECT SUM(amount) AS total_savings FROM savings_record WHERE user_id =" . $user_id;
    $row_get_savings = mysqli_fetch_assoc($conn->query($sql_get_savings));
    $savings_amount = $row_get_savings['total_savings'];

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
                                <h4 class="page-title m-b-0">User Accounts</h4>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i class="fas fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">Accounts</li>
                            <li class="breadcrumb-item">Status</li>
                        </ul>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>All Loans</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive mb-3">
                                                <table class="table table-striped table-hover" id="tableExport" style="width:100%;" data-page-length='2'>
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Date Sanctioned</th>
                                                            <th>Amount</th>
                                                            <th data-toggle="tooltip" data-placement="right" title="Actual Repay Date by User">Repayed?</th>
                                                            <th>Fixed Repay Date</th>
                                                            <th>Actually Repay Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if ($result_loan = $conn->query($sql_loan)) {
                                                            $yes = '<i class="fas fa-check fa-lg col-green"></i> Yes';
                                                            $no = '<i class="fas fa-times fa-lg col-red"></i> No';
                                                            while ($row_loan = $result_loan->fetch_assoc()) {
                                                                $repay_status_view = $row_loan['repay_status'] == 1 ? $yes :  $no;
                                                        ?>
                                                                <tr>
                                                                    <td> <a target="_blank" href="./view-loan.php?loan_id=<?= $row_loan['loan_id'] ?>"> <?= $row_loan['loan_id'] ?> </a> </td>
                                                                    <td><?= date('d-M-Y', strtotime($row_loan['lending_date'])) ?></td>
                                                                    <td><?= $row_loan['total_amount'] ?></td>
                                                                    <td><?= $repay_status_view ?></td>
                                                                    <td><?php if ($row_loan['repay_date']) echo date('d-M-Y', strtotime($row_loan['repay_date'])); ?></td>
                                                                    <td><?php if ($row_loan['repay_status']) echo date('d-M-Y', strtotime($row_loan['actual_repay_date']));
                                                                        else echo "Not Repayed Yet"; ?></td>
                                                                </tr>


                                                        <?php
                                                            }
                                                            $result_loan->free_result();
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- </div>
                    </div>
                    <div class="section-body">
                        <div class="row"> -->
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Account Status Informations</h4>
                                        </div>
                                        <div class="card-body mr-auto">
                                            <div class="form-inline mb-2" style="justify-content:space-between">
                                                <label>Total Savings (BDT)</label>
                                                <input type="number" class="form-control" value="<?= $savings_amount ?>" readonly>
                                            </div>
                                            <div class="form-inline mb-2" style="justify-content:space-between">
                                                <label data-toggle="tooltip" data-placement="right" title="How many times failed to repay on time?">Defaulted Loans <br> (Total Delayed Times)</label>
                                                <input type="number" class="form-control" value="<?= $row_count_defaulted_loan['cnt'] ?>" readonly>
                                            </div>
                                            <div class="form-inline mb-2" style="justify-content:space-between">
                                                <label data-toggle="tooltip" data-placement="right" title="How many days passed till he didn't paid savings amount?">Savings Due (Days)</label>
                                                <input type="number" class="form-control" value="<?php if ($row_savings_due['diff'] > -1) echo $row_savings_due['diff']; ?>" readonly>
                                            </div>
                                            <div class="form-inline mb-2" style="justify-content:space-between">
                                                <label>Loan Due (Days)</label>
                                                <input type="number" min="0" class="form-control" value="<?php if ($row_count_loan_due['diff'] > -1) echo $row_count_loan_due['diff']; ?>" readonly>
                                            </div>
                                            <div class="form-inline mb-2" style="justify-content:space-between">
                                                <label>Last Date of Savings</label>
                                                <input type="date" class="form-control" value="<?= $row_savings_due['savings_date'] ?>" readonly>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Last Slab of Loan</label>
                                                <input type="text" class="form-control" value="<?= "BDT " . $row_get_last_slab["amount"] . " for " . $row_get_last_slab["period"] . " days, Fee " . $row_get_last_slab["interest"]; ?>" readonly>
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
<?php
} else {
    header("Location: ./dashboard.php");
}
?>