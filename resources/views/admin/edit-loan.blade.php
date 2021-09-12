<?php
include_once './include/config.php';
include_once './include/function.php';
$msg = "";
$err = "";


$sql_slab = "SELECT * FROM slab ";
$result_slab = $conn->query($sql_slab);

if (isset($_POST['grant'])) {
    $msg = "";
    $err = "";
    $loan_id = $_POST['loan_id'];
    $slab = $_POST['slab'];
    $amount = $_POST['amount'];
    $lending_period = $_POST['lending_period'];
    $interest = $_POST['interest'];
    $fine = $_POST['fine'];
    $total_amount = $_POST['total_amount'];
    $installment_number = $_POST['installment_number'];
    $installment_amount = $_POST['installment_amount'];




    $update_sql = "UPDATE `loan_record` SET  `slab` = '" . $slab . "', `amount` = '" . $amount . "',
                 `lending_period` = '" . $lending_period . "', `interest` = '" . $interest . "', 
                 `total_amount` = '" . $total_amount . "', `installment_number` = '" . $installment_number . "', 
                `installment_amount` = '" . $installment_amount . "', `fine` = '" . $fine . "' WHERE loan_id = '" . $loan_id . "'";



    if ($conn->query($update_sql) === TRUE) {
        $msg .=  "Loan Requested Edit Successfully.";
    } else {
        $err .=  "<br>Error: " . $conn->error;
    }

    if ($_POST['grant'] == 'approve') {
        approveLoan($loan_id);
    }
}
if (isset($_GET['loan_id'])) {
    $loan_id = $_GET['loan_id'];
    $sql = "SELECT loan_record.*, user_account.member_id, user_account.name FROM loan_record LEFT JOIN user_account ON loan_record.user_id = user_account.user_id WHERE sanction_status = 0 AND loan_id ='" . $loan_id . "'";
    $row = mysqli_fetch_assoc($conn->query($sql));
    if (mysqli_num_rows($conn->query($sql)) == 0) {
        header("Location: ./dashboard.php");
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
                            <li class="breadcrumb-item">Edit Loan</li>
                            <li class="breadcrumb-item">Change</li>
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
                                    <form class="form-group" action="edit-loan.php" method="post">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Edit Loan</h4>
                                                <span>You can only edit the slab and installment number.</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>User ID <?= $row["member_id"] ." - ". $row["name"] ?></label> 
                                                    <input type="hidden" class="form-control" name="user_id" value="<?= $row["user_id"] ?>" autofocus required readonly>

                                                </div>

                                                <div class="form-group">
                                                    <p id="user-info"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label>Loan Id</label>
                                                    <input type="text" class="form-control" name="loan_id" value="<?= $row["loan_id"] ?>" readonly required>
                                                </div>


                                                <div class="form-group">
                                                    <p id="slab-info"></p>
                                                </div>


                                                <div class="form-group">
                                                    <label>
                                                        <h4>Slab</h4>
                                                    </label>
                                                    <select class="form-control" id="slab" name="slab" onChange="getSlab(this.value);" required>
                                                        <option value disabled>Select Slab</option>
                                                        <?php
                                                        foreach ($result_slab as $SlabResult) {
                                                            if ($SlabResult["slab_id"] == $row["slab"]) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }

                                                        ?>
                                                            <option <?= $selected ?> value="<?= $SlabResult["slab_id"] ?>"><?= "BDT " . $SlabResult["amount"] . " for " . $SlabResult["period"] . " days, Fee " . $SlabResult["interest"] ?></option>
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
                                                    <label>Amount</label>
                                                    <input type="number" step="any" class="form-control" id="amount" name="amount" readonly required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Subscription Fee (BDT)</label>
                                                    <input type="number" step="any" class="form-control" id="interest" name="interest" readonly required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Total Amount Including Inerest</label>
                                                    <input type="number" step="any" class="form-control" id="total_amount" name="total_amount" readonly required>
                                                </div>

                                                <div class="form-group">
                                                    <!-- <label>Fine</label> -->
                                                    <input type="hidden" id="fine" name="fine" readonly required>
                                                </div>


                                                <div class="form-group">
                                                    <label>
                                                        <h5>Installment Number (Pay "X" Installments)</h5>
                                                    </label>
                                                    <input type="number" class="form-control" min="1" id="installment_number" name="installment_number" value="<?= $row["installment_number"] ?>" onchange="i_number(this.value)" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Installment Amount (Per Installment Amount to be Paid)</label>
                                                    <input type="number" step="any" class="form-control" id="installment_amount" min="1" name="installment_amount" value="<?= $row["installment_amount"] ?>" readonly required>
                                                </div>


                                            </div>
                                            <div class="card-footer text-left">
                                                <button type=submit onclick="return false;" style="display:none;"></button>
                                                <button class="btn btn-warning mr-1" type="submit" name="grant" value="edit">Edit Changes</button>
                                                <button class="btn btn-success mr-1" type="submit" name="grant" value="approve">Edit & Grant Loan</button>
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
            $(document).ready(function() {
                getUserLastSlab('<?= $row["user_id"] ?>');
                getSlab('<?= $row["slab"] ?>');
            })
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
                        $("#installment_number").val(1);
                        i_number(1);
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
<?php
} else {
    echo "<script>window.close();</script>";
}
?>