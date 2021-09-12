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
                            <h4 class="page-title m-b-0">ADMIN PASSWORD</h4>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="./dashboard.php">
                                <i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Change</li>
                        <li class="breadcrumb-item">Password</li>
                    </ul>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card" id="sample-login">
                                    <form>
                                        <div class="card-header">
                                            <h4>Admin Password Change</h4>
                                        </div>
                                        <div class="card-body pb-0">
                                            <p class="text-muted"></p>
                                            <input type="hidden" name="admin_id" value="<?= $_SESSION["admin_id"]?>">

                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-key"></i>
                                                        </div>
                                                    </div>
                                                    <input type="password" name="old_password" class="form-control" placeholder="Old Password" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>New Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-lock"></i>
                                                        </div>
                                                    </div>
                                                    <input type="password" name="new_password" class="form-control" placeholder="New Password" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-lock"></i>
                                                        </div>
                                                    </div>
                                                    <input type="password" name="con_new_password" class="form-control" placeholder="Retype New Password" required>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer pt-">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
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
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
    <script>
        $('form').on('submit', function(e) {
            e.preventDefault();
            var admin_id = $("input[name=admin_id]").val();
            var new_password = $("input[name=new_password]").val();
            var con_new_password = $("input[name=con_new_password]").val();
            var old_password = $("input[name=old_password]").val();
            if (con_new_password == new_password) {
                $.ajax({
                    type: 'POST',
                    url: './ajax/cng-pwd.php',
                    data: {
                        'admin_id': admin_id,
                        'new_password': new_password,
                        'old_password': old_password
                    },
                    success: function(msg) {
                        Swal.fire({
                            position: 'top-end',
                            icon: "info",
                            html: msg,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 5000
                        }).then(function() {
                            window.location = "./logout.php";
                        })
                    }
                });
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: "error",
                    html: "New Password and Confirm Password Must be Same.",
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 5000
                })
            }

        });
    </script>
</body>

</html>