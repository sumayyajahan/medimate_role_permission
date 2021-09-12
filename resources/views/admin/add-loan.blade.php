<?php
include_once './include/config.php';
include_once './include/function.php';
$msg = "";
$err = "";
$sql = "SELECT * FROM user_account WHERE account_active_status = 1 AND defaulter_status = 0";
$result = $conn->query($sql);

$sql_slab = "SELECT * FROM slab ";
$result_slab = $conn->query($sql_slab);

if (isset($_POST['grant'])) {
    $msg = "";
    $err = "";
    $user_id = $_POST['user_id'];
    $loan_id = $_POST['loan_id'];
    $lending_date = $_POST['lending_date'];
    $repay_date = $_POST['repay_date'];
    $slab = $_POST['slab'];
    $amount = $_POST['amount'];
    $lending_period = $_POST['lending_period'];
    $interest = $_POST['interest'];
    $fine = $_POST['fine'];
    $total_amount = $_POST['total_amount'];
    $installment_number = $_POST['installment_number'];
    $installment_amount = $_POST['installment_amount'];
    $next_payment_date = $_POST['next_payment_date'];

    $transaction_id = getUniqueID(10);
    addTransaction($transaction_id, 'debit', 'loan sanction', $amount, $user_id, $loan_id, 'Loan Amount Given to User');

    $insert_sql = "INSERT INTO `loan_record` (`loan_id`, `user_id`, `lending_date`, `repay_date`, 
                `slab`, `amount`, `lending_period`, `interest`, `total_amount`, `installment_number`, 
                `installment_amount`, `sanction_status`, `repay_status`, `fine`, `transaction_id`) 
                VALUES ('" . $loan_id . "','" . $user_id . "','" . $lending_date . "','" . $repay_date . "',
                '" . $slab . "','" . $amount . "','" . $lending_period . "','" . $interest . "',
                '" . $total_amount . "','" . $installment_number . "','" . $installment_amount . "',
                1,0,'" . $fine . "','" . $transaction_id . "')";


    $insert_to_loan_collection = "INSERT INTO `loan_collection` (`loan_id`, `user_id`, `last_collection_amount`, 
                       `total_loan_repay_amount`, `due_amount`, `fine_imposed`, `next_payment_date`) 
                       VALUES ('" . $loan_id . "','" . $user_id . "',0,'" . $total_amount . "','" . $total_amount . "',
                       0,'" . $next_payment_date . "')";

    if ($conn->query($insert_sql) === TRUE) {
        if ($conn->query($insert_to_loan_collection) === TRUE) {
            $msg .=  "Loan Sanctioned to User.";
        } else {
            $err .=  "Error: " . $conn->error;
        }
    } else {
        $err .=  "<br>Error: " . $conn->error;
    }
}

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
                            <a href="./dashboard.php">
                                <i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Add Loan</li>
                        <li class="breadcrumb-item">Form</li>
                    </ul>
                    <div id="msg-err">
                        <h1 style="color:green;"><?php if ($msg) {
                                                        echo $msg;
                                                    } ?></h1>
                        <h1 style="color:red;"><?php if ($err) {
                                                    echo $err;
                                                } ?></h1>

                    </div>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <form class="form-group" action="add-loan.php" method="post">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Add Loan</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>User Id</label>
                                                <input list="user_id" class="form-control" name="user_id" onChange="getUserLastSlab(this.value);" autofocus required>
                                                <datalist id="user_id">
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<option value="' . $row["user_id"] . '">' . $row["name"] . '( ' . $row["member_id"] . ' )</option>';
                                                        }
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>

                                            <div class="form-group">
                                                <p id="user-info"></p>
                                                <p id="user-savings"></p>
                                            </div>

                                            <div class="form-group">
                                                <label>Loan Id</label>
                                                <input type="text" class="form-control" name="loan_id" value="<?= getUniqueID(6) ?>" required readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Lending Date</label>
                                                <input type="date" required class="form-control" id="lending_date" name="lending_date" value="<?= date('Y-m-d') ?>" onchange="l_date(this.value)">
                                            </div>

                                            <div class="form-group">
                                                <p id="slab-info"></p>
                                            </div>


                                            <div class="form-group">
                                                <label>Slab</label>
                                                <select class="form-control" id="slab" name="slab" onChange="getSlab(this.value);" required>
                                                    <option value disabled selected>Select Slab</option>
                                                    <?php
                                                    foreach ($result_slab as $SlabResult) {
                                                    ?>
                                                        <option value="<?= $SlabResult["slab_id"] ?>"><?= "BDT " . $SlabResult["amount"] . " for " . $SlabResult["period"] . " days, Fee " . $SlabResult["interest"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Lending Period (Days)</label>
                                                <input type="number" class="form-control" id="lending_period" name="lending_period" readonly required>
                                            </div>

                                            <div class="form-group">
                                                <label>Repay Date</label>
                                                <input type="date" class="form-control" name="repay_date" id="repay_date" readonly required>
                                            </div>

                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="number" step="any" class="form-control" id="amount" name="amount" readonly required>
                                            </div>

                                            <div class="form-group">
                                                <label>Subscription Fee (BDT)</label>
                                                <input type="number" step="any" class="form-control" id="interest" name="interest" readonly required>
                                            </div>

                                            <div class="form-group">
                                                <label>Total Amount Including Fee</label>
                                                <input type="number" step="any" class="form-control" id="total_amount" name="total_amount" readonly required>
                                            </div>

                                            <div class="form-group">
                                                <!-- <label>Fine</label> -->
                                                <input type="hidden" class="form-control" id="fine" name="fine">
                                            </div>


                                            <div class="form-group">
                                                <label>Installment Number (Pay "X" Installments)</label>
                                                <input type="number" class="form-control" min="1" id="installment_number" name="installment_number" onchange="i_number(this.value)" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Installment Amount (Per Installment Amount to be Paid)</label>
                                                <input type="number" step="any" class="form-control" id="installment_amount" min="1" name="installment_amount" readonly required>
                                            </div>

                                            <div class="form-group">
                                                <label>1st Installment Date</label>
                                                <input type="date" class="form-control" name="next_payment_date" id="next_payment_date" readonly>
                                            </div>


                                        </div>
                                        <div class="card-footer text-left">
                                            <button type=submit onclick="return false;" style="display:none;"></button>
                                            <button class="btn btn-success mr-1" type="submit" name="grant">Grant</button>
                                            <button class="btn btn-secondary" type="reset">Reset</button>
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

    <script>
        setTimeout(function() {
            if ($('#msg-err').length > 0) {
                $('#msg-err').remove();
            }
        }, 5000)

        function l_date(e) {
            var l_date = e;
            var period = $("#lending_period").val();
            var r_date = moment(l_date).add(period, 'days').format('YYYY-MM-DD');
            $("#repay_date").val(r_date);
        }

        function i_number(e) {
            var l_date = $("#lending_date").val();
            var period = $("#lending_period").val();
            var per_day = Math.floor(period / e);
            var date1 = moment(l_date).add(per_day, 'days').format('YYYY-MM-DD');
            $("#next_payment_date").val(date1);
            var amount = $("#amount").val();
            $("#installment_amount").val(Math.ceil(amount / e));

        }


        function getSlab(slab_id) {
            $.ajax({
                type: "POST",
                url: "./ajax/get-slab-data.php",
                data: 'slab_id=' + slab_id,
                success: function(data) {
                    var result = $.parseJSON(data);
                    console.log(result);
                    $("#lending_period").val(result.period);
                    var l_date = $("#lending_date").val();
                    var r_date = moment(l_date).add(result.period, 'days').format('YYYY-MM-DD');
                    $("#repay_date").val(r_date);
                    $("#amount").val(result.amount);
                    $("#interest").val(result.interest);
                    $("#fine").val(result.fine);
                    var total_amount = parseFloat(result.amount) + parseFloat(result.interest);
                    $("#total_amount").val(total_amount);
                }
            });
        }

        function getUserLastSlab(user_id) {
            $.ajax({
                type: "POST",
                url: "./ajax/get-user-last-slab.php",
                data: 'user_id=' + user_id,
                success: function(data) {
                    var result = $.parseJSON(data);
                    $("#slab-info").text(result.max_slab_echo);
                    $("#user-info").text(result.cnt_echo);
                    $("#user-savings").text("User savings = " + result.savings_amount);
                    $("#user-info").css("color", result.color);
                }
            });
        }
    </script>
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