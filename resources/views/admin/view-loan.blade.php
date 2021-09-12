<?php
include_once './include/config.php';
if (isset($_GET['loan_id'])) {
    $loan_id = $_GET['loan_id'];
    $sql = "SELECT *, user_account.member_id, user_account.name, slab.* FROM loan_record LEFT JOIN user_account ON loan_record.user_id = user_account.user_id LEFT JOIN slab ON slab = slab.slab_id WHERE loan_id = '" . $loan_id . "'";
    $row = mysqli_fetch_assoc($conn->query($sql));

    $user_id = $row['user_id'];
    $member_id = $row['member_id'];
    $name = $row['name'];
    $lending_date = $row['lending_date'];
    $repay_date = $row['repay_date'];
    $slab = $row['slab'];
    $amount = $row['amount'];
    $lending_period = $row['lending_period'];
    $interest = $row['interest'];
    $total_amount = $row['total_amount'];
    $installment_number = $row['installment_number'];
    $installment_amount = $row['installment_amount'];
    $sanction_status = $row['sanction_status'];
    $repay_status = $row['repay_status'];
    $actual_repay_date = $row['actual_repay_date'];
    $fine = $row['fine'];
    $transaction_id = $row['transaction_id'];
    $record_add_time = $row['record_add_time'];
    $record_update_time = $row['record_update_time'];

?>
    <!DOCTYPE html>
    <html lang="en">


    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <!-- General CSS Files -->
        <link rel="stylesheet" href="assets/css/app.min.css">
        <!-- Template CSS -->
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
                                <a href="./">
                                    <i class="fas fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">View Loan</li>
                            <li class="breadcrumb-item">Detailed Report</li>
                        </ul>

                        <div class="section-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <form class="form-group">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Loan Report</h4>
                                            </div>
                                            <div class="card-body">


                                                <div class="form-group">
                                                    <h5>Loan ID - <?= $loan_id ?></h5>

                                                    <h5> User - <a target="_blank" href="./view-more.php?user_id=<?= $user_id ?>"> <?= $member_id ?> ( <?= $name ?> )</a></h5>

                                                    <br>
                                                    <p>Record Added : <?= date('d-m-Y h:i:s A', strtotime($record_add_time)) ?></p>

                                                    <p>Slab : <?= "BDT " . $row["amount"] . " for " . $row["period"] . " days, Fee " . $row["interest"] ?></p>

                                                    <p>Lending Period (Days) : <?= $lending_period ?></p>

                                                    <p>Amount : <?= $amount ?></p>

                                                    <p>Fee (BDT) : <?= $interest ?></p>

                                                    <p>Total Amount Including Fee : <?= $total_amount + $interest ?></p>

                                                    <p>Number of Installment : <?= $installment_number ?></p>

                                                    <p>Installment Amount : <?= $installment_amount ?></p>

                                                    <!-- <p>Fine (If not repayed on time) : <?= $fine ?></p> -->

                                                    <?php
                                                    if ($sanction_status == 1) {
                                                    ?>
                                                        <h5 style="color:green">Loan Sanctioned</h5>

                                                        <p>Lending Date : <?= date('d-m-Y', strtotime($lending_date)) ?></p>

                                                        <p>Repay Date : <?= date('d-m-Y', strtotime($repay_date)) ?></p>

                                                        <p>Transaction ID : <?= $transaction_id ?></p>

                                                        <p>Repay Date : <?= date('d-m-Y', strtotime($repay_date)) ?></p> <br>

                                                    <?php
                                                    }
                                                    if ($sanction_status == 0) {
                                                    ?>
                                                        <h5 style="color:red">Loan Not Sanctioned Yet</h5>
                                                    <?php
                                                    }
                                                    if ($repay_status == 1) {
                                                    ?>
                                                        <h5 style="color:green">Loan Repaid</h5>


                                                        <p>Full Repay Date : <?= date('d-m-Y', strtotime($actual_repay_date)) ?></p>

                                                    <?php
                                                    }

                                                    if ($repay_status == 0) {
                                                    ?>

                                                        <h5 style="color:red">Loan Not Repaid Yet</h5>

                                                    <?php
                                                    }
                                                    if ($sanction_status == 1) {
                                                        $sql_collection = "SELECT * FROM loan_collection WHERE loan_id = '" . $loan_id . "'";
                                                        $row_collection = mysqli_fetch_assoc($conn->query($sql_collection));
                                                        $transaction_id_all = explode(",", $row_collection['transaction_id']);
                                                    ?>
                                                       <br> <h5> <u> Loan Collection History</u></h5>
                                                        <p>
                                                            Due Amount - BDT <?= $row_collection['due_amount'] ?> <br>
                                                            <br>
                                                            Detailed Collection -<br>
                                                            <?php
                                                            if(!empty($row_collection['transaction_id'])){
                                                            foreach ($transaction_id_all as $value) {
                                                                $sql_transaction_find = "SELECT * FROM transaction_log WHERE transaction_id = '" . $value . "'";
                                                                $row_transaction_find = mysqli_fetch_assoc($conn->query($sql_transaction_find));
                                                                echo date('d-m-Y h:i:s a', strtotime($row_transaction_find['transaction_time'])) . " => BDT " . $row_transaction_find['amount'];
                                                                echo "<br>";
                                                            }
                                                            }
                                                            else echo "*No Transaction was made yet.";

                                                            ?>
                                                        </p>
                                                    <?php
                                                    }
                                                    ?>




                                                </div>
                                            </div>

                                        </div>
                                    </form>
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
        <!-- Template JS File -->
        <script src="assets/js/scripts.js"></script>
        <!-- Custom JS File -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>