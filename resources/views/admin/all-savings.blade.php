<?php
include_once './include/config.php';
include_once './include/function.php';
$msg = "";
$sql = "SELECT sr.*, ua.member_id, ua.name FROM `savings_record` AS sr  LEFT JOIN user_account AS ua ON sr.user_id = ua.user_id WHERE amount > 0 ORDER BY sr.record_add_time DESC";
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
                            <h4 class="page-title m-b-0">Savings</h4>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="./dashboard.php">
                                <i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Manage</li>
                        <li class="breadcrumb-item">View All</li>
                    </ul>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>All Savings Record</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>User ID</th>
                                                        <th>User Name</th>
                                                        <th>Savings Amount</th>
                                                        <th>Savings Time</th>
                                                        <th>Number of Day</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $user_id = $row["user_id"];
                                                            $name = $row["name"];
                                                            $member_id = $row["member_id"];
                                                            $amount = $row["amount"];
                                                            $record_add_time = $row["record_add_time"];
                                                            $number_of_day = $row["number_of_day"];
                                                            $savings_id = $row["savings_id"];
                                                    ?>
                                                            <tr>
                                                                <td><a href="./view-more.php?user_id=<?= $user_id ?>"><?= $member_id ?></a></td>
                                                                <td><?= $name ?></td>
                                                                <td><?= $amount ?></td>
                                                                <td><?= date('d-m-y h:i:s a', strtotime($record_add_time)) ?></td>
                                                                <td><?= $number_of_day ?></td>
                                                                <td><button class="btn btn-icon bg-red" onclick="delete_savings('<?= $savings_id ?>');"><i class="far fa-trash-alt"></i></button></td>
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
    <script>
        function delete_savings(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete Savings'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: './ajax/delete-savings-record.php',
                        data: {
                            'savings_id': id
                        },
                        success: function(msg) {
                            Swal.fire({
                                position: 'top-end',
                                icon: "info",
                                html: msg,
                                showConfirmButton: false,
                                timerProgressBar: true,
                                timer: 1000
                            }).then(function() {
                                window.location = window.location.href;
                            })
                        }
                    });
                }
            })
        }
    </script>
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