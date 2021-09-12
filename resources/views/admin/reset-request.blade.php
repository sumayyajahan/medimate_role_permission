<?php
include_once './include/config.php';

$sql = "SELECT * FROM user_account WHERE account_active_status = 4";
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
                            <h4 class="page-title m-b-0">User</h4>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="./dashboard.php">
                                <i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Accounts</li>
                        <li class="breadcrumb-item">Reset Requests</li>
                    </ul>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Reset Requested Accounts</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Defaulted ( <i class="fas fa-times fa-lg col-red"></i> )</th>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Profile Photo</th>
                                                        <th>Phone</th>
                                                        <th>Address</th>
                                                        <th>Join Date</th>
                                                        <th>Cancel</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $user_id = $row["user_id"];
                                                            $name = $row["name"];
                                                            $mobile = $row["mobile"];
                                                            $present_address = $row["present_address"];
                                                            $image = $row["user_image"];
                                                            $joining_date = date("d/m/Y", strtotime($row["joining_date"]));
                                                            $defaulter_status = $row["defaulter_status"];
                                                            if ($defaulter_status == 0) {
                                                                $defaulter = '<i class="fas fa-check fa-lg col-green"></i>';
                                                            } else {
                                                                $defaulter = '<i class="fas fa-times fa-lg col-red"></i>';
                                                            }

                                                    ?>
                                                            <tr>
                                                                <td><?= $defaulter ?></td>
                                                                <td><?= $user_id ?></td>
                                                                <td><?= $name ?></td>
                                                                <td style="width:10%;"> <img class="col-12" alt="image" src="<?= $image ?>"></td>
                                                                <td><?= $mobile ?></td>
                                                                <td><?= $present_address ?></td>
                                                                <td><?= $joining_date ?></td>
                                                                <td> <button type="button" onclick="cancel('<?= $user_id ?>')" class="btn btn-danger">Deny</button></td>
                                                                <td class="text-center d-grid p-1">
                                                                    <a href="view-more.php?user_id=<?= $user_id ?>"> <button class="btn btn-outline-secondary">View more</button></a>
                                                                    <a href="account-status.php?user_id=<?= $user_id ?>"> <button class="btn btn-outline-info">Account Status</button></a>
                                                                    <a href="edit-user.php?user_id=<?= $user_id ?>"> <button class="btn btn-outline-warning">Edit User</button></a>
                                                                    <a href="settle-account.php?state=close&user_id=<?= $user_id ?>"> <button class="btn btn-outline-danger">Close Account</button></a>
                                                                    <a href="settle-account.php?state=reset&user_id=<?= $user_id ?>"> <button class="btn btn-outline-primary">Reset Account</button></a>
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
        function cancel(user_id) {
            $.ajax({
                type: "POST",
                url: "./ajax/cancel-close-reset-account.php",
                data: {
                    user_id: user_id
                },
                success: function(result) {
                    // do something here
                    Swal.fire(
                        result,
                        'Redirecting to Requested Page',
                        'success'
                    ).then(function() {
                        window.location = "./reset-request.php";
                    })

                }
            });
        }
    </script>
</body>


<!-- Mirrored from radixtouch.in/templates/admin/zivi/source/light/export-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Feb 2020 19:58:18 GMT -->

</html>