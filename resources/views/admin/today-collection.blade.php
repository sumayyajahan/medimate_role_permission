<?php
include_once './include/config.php';
include_once './include/function.php';
$msg = "";
$sql = "SELECT sr.*, ua.member_id, ua.name, ua.daily_savings FROM (SELECT *, (ROW_NUMBER() OVER(PARTITION BY user_id ORDER BY record_add_time DESC)) RES FROM `savings_record`) sr LEFT JOIN user_account AS ua ON sr.user_id = ua.user_id WHERE ua.account_active_status = 1 AND sr.next_payment_date <= '" . date('Y-m-d') . "' AND RES = 1";
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>



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
                            <h4 class="page-title m-b-0">Savings</h4>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="./dashboard.php">
                                <i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Remaining Collection</li>
                        <li class="breadcrumb-item"><?= date('d-m-Y') ?></li>
                    </ul>
                    <div class="section-body" id="check">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Add Savings Record</h4>
                                    </div>
                                    <div class="card-body">
                                        <form id="addSavings">
                                            <div class="form-inline">
                                                <label class="mr-3">Number of Day:</label>
                                                <select class="mr-3 form-control js-example" onchange="num_day(this.value);" required>
                                                    <option selected="selected" value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                                <input type="hidden" id="user_id" required>
                                                <input type="hidden" id="number_of_day" required>
                                                <input type="hidden" id="daily_savings" required>
                                                <input type="hidden" id="prev_next_payment_date" required>

                                                <label class="mr-3">Amount</label>
                                                <input type="number" class="form-control mr-3" id="amount" readonly required>

                                                <label>Next Date of Payment</label>
                                                <input type="date" class="form-control" name="next_payment_date" id="next_payment_date" readonly required>

                                            </div>
                                            <div class="mt-3 mb-2 mr-1">
                                                <button type="submit" class="btn btn-outline-success pull-left">Add Record</button>
                                                <button type="button" id="check-close" class="btn btn-danger pull-right">Close</button>
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
                                        <h4>Remaining Collection Till <?= date('d-m-Y') ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>User ID</th>
                                                        <th>Name</th>
                                                        <th>Last Date of Savings</th>
                                                        <th>Next Date of Savings</th>
                                                        <th>Savings Time Gap</th>
                                                        <th>Savings Amount (Daily)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $user_id = $row["user_id"];
                                                            $name = $row["name"];
                                                            $member_id = $row["member_id"];
                                                            $daily_savings = $row["daily_savings"];
                                                            $savings_date = $row["savings_date"];
                                                            $next_payment_date = $row["next_payment_date"];

                                                            $earlier = strtotime($next_payment_date);
                                                            $later = strtotime(date('Y-m-d'));
                                                            $diff = ceil(abs($later - $earlier) / 86400);
                                                    ?>
                                                            <tr>
                                                                <td><a href="./view-more.php?user_id=<?= $user_id ?>"><?= $member_id ?></a></td>
                                                                <td><?= $name ?></td>
                                                                <td><?= date('d-m-y', strtotime($savings_date)) ?></td>
                                                                <td><?= date('d-m-y', strtotime($next_payment_date)) ?></td>
                                                                <td><?= $diff ?> days</td>
                                                                <td><?= $daily_savings ?></td>

                                                                <td>
                                                                    <button class="btn btn-success" onclick="addInfo('<?= $user_id ?>','<?= $daily_savings ?>','<?= $next_payment_date ?>');"><i class="fas fa-plus"></i> Savings</button></a>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $('#check').hide();
            $(".js-example").select2({
                tags: true
            });
        });

        function num_day(num) {
            console.log(num);

            var number_of_day = parseInt(num);
            $("#number_of_day").val(number_of_day);
            var daily_savings = parseFloat($('#daily_savings').val());
            $('#amount').val(Math.ceil(number_of_day * daily_savings));

            var prev_next_payment_date = $("#prev_next_payment_date").val();
            var next_payment_date = moment(prev_next_payment_date).add(num, 'days').format('YYYY-MM-DD');
            $("#next_payment_date").val(next_payment_date);
        }


        function addInfo(user_id, daily_savings, prev_date) {
            $('#check').show();
            $("#addSavings").trigger("reset");
            $(".js-example").select2({
                val: '',
                tags: true
            });
            $('#user_id').val(user_id);
            $('#daily_savings').val(daily_savings);
            $('#amount').val(daily_savings);
            $("#prev_next_payment_date").val(prev_date);
            num_day(1);

        }
        $("#check-close").click(function() {
            $('#check').hide();
        });


        $('#addSavings').on('submit', function(e) {
            e.preventDefault();
            var user_id = $("#user_id").val();
            var number_of_day = $("#number_of_day").val();
            var amount = $("#amount").val();
            var next_payment_date = $("#next_payment_date").val();
            $.ajax({
                type: 'POST',
                url: './ajax/add-user-savings.php',
                data: {
                    'user_id': user_id,
                    'number_of_day': number_of_day,
                    'amount': amount,
                    'next_payment_date': next_payment_date,
                },
                success: function(msg) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Savings Collection',
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