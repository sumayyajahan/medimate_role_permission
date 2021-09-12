<?php
include_once './include/config.php';
$state = "Loading...";
if (isset($_GET['user_id']) && isset($_GET['state'])) {
    $user_id = $_GET['user_id'];
    $state = $_GET['state'];
    $sql = "SELECT * FROM user_account WHERE user_id =" . $user_id;
    $row = mysqli_fetch_assoc($conn->query($sql));

    // $now = time();
    // $your_date = strtotime($row['joining_date']);
    // $datediff = $now - $your_date;

    // $month_passed = ceil(floor($datediff / (24 * 60 * 60)) / 30);

    // $sql_close_fine = "SELECT * FROM `reset_close_fine` WHERE start <= " . $month_passed . " AND end >= " . $month_passed;
    // $row_close_fine = mysqli_fetch_assoc($conn->query($sql_close_fine));

    $sql_get_savings = "SELECT SUM(amount) AS total_savings FROM savings_record WHERE user_id =" . $user_id;
    $row_get_savings = mysqli_fetch_assoc($conn->query($sql_get_savings));
    $savings_amount = $row_get_savings['total_savings'];

    if ($state == 'close') {
        $close_fine = abs($savings_amount*0.05);
    }
    if ($state == 'reset') {
        $close_fine = abs($savings_amount*0.025);
    }



    $sql_get_last_loan = "SELECT loan_id, repay_status FROM loan_record WHERE sanction_status =1 AND user_id =" . $user_id . " ORDER BY record_add_time DESC LIMIT 1";
    $row_get_last_loan = mysqli_fetch_assoc($conn->query($sql_get_last_loan));
    $loan_id = NULL;
    $row_get_last_loan_collection['due_amount'] = 0;
    if ($row_get_last_loan != NULL) {
        if ($row_get_last_loan['repay_status'] == 0) {
            $loan_id = $row_get_last_loan['loan_id'];

            $sql_get_last_loan_collection = "SELECT due_amount FROM loan_collection WHERE loan_id = '" . $loan_id . "'";

            $row_get_last_loan_collection = mysqli_fetch_assoc($conn->query($sql_get_last_loan_collection));
        } else {
            $row_get_last_loan_collection['due_amount'] = 0;
        }
    }


    $sql_get_savings = "SELECT SUM(amount) AS total_savings FROM savings_record WHERE user_id =" . $user_id;
    $row_get_savings = mysqli_fetch_assoc($conn->query($sql_get_savings));

    if ($row_get_savings['total_savings'] == NULL) {
        $row_get_savings['total_savings'] = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Dashboard | Settle Account</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/chocolat/dist/css/chocolat.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?php include 'include/header.php'; ?>

            <div class="navbar-bg"></div>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title m-b-0">USER</h4>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="./dashboard.php">
                                <i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Settle Account</li>
                        <li class="breadcrumb-item"><?= ucwords($state) ?></li>
                    </ul>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-8 col-md-8 col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Settle Account <small>You are going to <?= ucwords($state) ?> the account.</small> </h4>
                                    </div>
                                    <div class="card-body">
                                        <h6>Information</h6>
                                        <p>
                                            User ID - <?= $row['member_id'] ?> <br>
                                            User - <?= $row['name'] ?> <br>
                                            Joining Date - <?= date('d / m / Y', strtotime($row['joining_date'])) ?>
                                        </p>
                                        <h6> <u> Loan & Savings </u> </h6>
                                        <p> Loan Due - BDT <?= $row_get_last_loan_collection['due_amount'] ?> <br>
                                            Total Savings - BDT <?= $row_get_savings['total_savings'] ?> <br>
                                            <?= ucwords($state) ?> Fine - BDT <?= $close_fine ?> <br>
                                            After Rounding -
                                            <?php
                                            $settle_amount = $row_get_savings['total_savings'] - $row_get_last_loan_collection['due_amount'] - $close_fine;
                                            if ($settle_amount > 0) {
                                                echo '<span style = "color:green">Druto Loan will Pay the user BDT ' . $settle_amount . "</span>";
                                            } else {
                                                $settle_amount *= -1;
                                                echo '<span style = "color:red">User will Pay Druto Loan BDT ' . $settle_amount . "</span>";
                                            }

                                            ?>
                                        </p>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" onclick="proceed();">Proceed</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-lg-4" id="proceed">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Transaction Amount</h4>
                                    </div>
                                    <div class="card-body">
                                        <h6>Put the exact amount the user paid or Medimate paid back to user.</h6>
                                        <input onkeyup="myFunction('<?= $settle_amount ?>');" class="form-control" type="text" name="confirm_amount" id="confirm_amount">
                                    </div>
                                    <div class="card-footer text-right">
                                        <button id="confirm_btn" disabled class="btn btn-warning" onclick="confirm();"> <i class="fas fa-exclamation-triangle"></i> Confirm to <?= $state ?></button>
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
    <script>
        $("#proceed").hide();

        function proceed() {
            $("#proceed").show();
        }

        function myFunction(confirm_amount) {
            var get_val = $("#confirm_amount").val();
            if (get_val == confirm_amount) {
                $("#confirm_btn").attr('disabled', false);
                $("#confirm_amount").css("color", "green");
            } else {
                $("#confirm_btn").attr('disabled', true);
                $("#confirm_amount").css("color", "red");
            }

        }

        function confirm() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f4a261',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?= ucwords($state) ?> Account'
            }).then((result) => {
                if (result.value) {
                    // send user id, loan id, transation history, mode of operation ;----- colse / reset via ajax here
                    // 1.add transaction 2. add savings record in terns of (-) for withdraw 3. Add loan collection 4. make loan repay done 5. Copy user with new user id 
                    var state = '<?= $state ?>';
                    var user_id = '<?= $user_id ?>';
                    var loan_id = '<?= $loan_id ?>';
                    $.ajax({
                        type: "POST",
                        url: "./ajax/close-reset-account.php",
                        data: {
                            state: state,
                            user_id: user_id,
                            loan_id: loan_id
                        },
                        success: function(result) {
                            // do something here
                            Swal.fire(
                                result,
                                'Redirecting to All Users Page',
                                'success'
                            ).then(function() {
                                window.location = "./manage-account.php";
                            })

                        }
                    });

                }
            })


        }
    </script>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="assets/bundles/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
</body>


</html>