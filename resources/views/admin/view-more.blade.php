<?php
include_once './include/config.php';

if (isset($_GET['user_id']) || isset($_GET['member_id'])) {
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $sql = "SELECT * FROM user_account WHERE user_id =" . $user_id;
    }
    if (isset($_GET['member_id'])) {
        $member_id = $_GET['member_id'];
        $sql = "SELECT * FROM user_account WHERE account_active_status = 1 AND member_id = '" . $member_id . "'";
    }
    $row = mysqli_fetch_assoc($conn->query($sql));
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

        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        <style>
            @media print {
                button {
                    display: none;
                }


                #formImg {
                    display: block !important;
                }


                #capture {
                    display: none !important;
                }

                #nf {
                    page-break-before: always;
                }


            }
        </style>
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
                            <li class="breadcrumb-item">View Account</li>
                            <li class="breadcrumb-item">Details</li>
                        </ul>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <form class="form-group">
                                        <div id="card" class="card">
                                            <div class="card-header">
                                                <title><?= $row['name'] ?> (<?= $row['member_id'] ?>)</title>
                                                <h4 id="pi">Account Details of - <?= $row['name'] ?> (<?= $row['member_id'] ?>)</h4>
                                                <a target="_blank" href="./send-sms.php?mobile=<?= $row['mobile'] ?>">
                                                    <button type="button" class="btn btn-danger waves-effect btn-compose pull-right">Send SMS <i class="far fa-paper-plane"></i></button>
                                                </a>
                                                <a target="_blank" href="./notify-user.php?user_id=<?= $row['user_id'] ?>">
                                                    <button type="button" class="btn btn-warning waves-effect btn-compose pull-right ml-4">Notify User <i class="far fa-share-square"></i></button>
                                                </a>
                                                <button type="button" onclick="printDiv('card')" class="btn btn-primary waves-effect btn-compose ml-4"><i class="fas fa-print">&nbsp;Print Form </i></button>
                                                <img id="formImg" style="display: none;" class="col-md-2 pull-right" alt="image" src="<?= $row['user_image'] ?>">
                                            </div>

                                            <p class="form-group" style="align-self: center;">
                                                Account Status : <?php
                                                                    if ($row['account_active_status'] == 1) {
                                                                        echo "Active Account";
                                                                    } else echo "Not Active"; ?>
                                                &nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
                                                Defaulter Status : <?php
                                                                    if ($row['defaulter_status'] == 0) {
                                                                        echo "No";
                                                                    } else echo "YES"; ?>
                                            </p>
                                            <div class="card-body">
                                                <div class="form-inline" style="justify-content:space-evenly">
                                                    <label>Form No</label>
                                                    <input type="number" class="form-control mb-2 mr-sm-2" value="<?= $row['form_no'] ?>" readonly>
                                                    <label>Group</label>
                                                    <input type="text" class="form-control mb-2 mr-sm-2" value="<?= $row['group_no'] ?>" readonly>
                                                    <label>User ID</label>
                                                    <input type="text" class="form-control mb-2 mr-sm-2" value="<?= $row['member_id'] ?>" readonly>
                                                </div>

                                                <div class="form-inline" style="justify-content:space-evenly">
                                                    <label>Member ID <br> (System ID)</label>
                                                    <input type="text" class="form-control mb-2 mr-sm-0" value="<?= $row['user_id'] ?>" readonly>
                                                    <label>Joining Date</label>
                                                    <input type="date" class="form-control mb-2 mr-sm-3" value="<?= $row['joining_date'] ?>" readonly>
                                                </div>

                                                <hr>
                                                <h6 class="text-center">Personal Info</h6>
                                                <hr>
                                                Password : <input class="btn btn-info waves-effect btn-compose" onclick="this.value='<?= $row['app_password'] ?>'" type="button" value="Show Password" id="myButton1" />


                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" value="<?= $row['name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Father's Name</label>
                                                    <input type="text" class="form-control" value="<?= $row['father_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mother's Name</label>
                                                    <input type="text" class="form-control" value="<?= $row['mother_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Present Address</label>
                                                    <textarea class="form-control" readonly><?= $row['present_address'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Permanent Address</label>
                                                    <textarea class="form-control" readonly><?= $row['permanent_address'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control" value="<?= $row['occupation'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Institution Name</label>
                                                    <input type="text" class="form-control" value="<?= $row['institute_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <input type="text" class="form-control" value="<?= $row['designation'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    <input type="date" class="form-control" value="<?= $row['date_of_birth'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="text" class="form-control" value="<?= $row['age'] ?>" readonly>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label>Marital Status</label>
                                                    <select class="form-control" disabled>
                                                        <option <?php if ($row['marital_status'] == "single") echo 'selected'; ?> value="single">Single</option>
                                                        <option <?php if ($row['marital_status'] == "married") echo 'selected'; ?> value="married">Married</option>
                                                        <option <?php if ($row['marital_status'] == "divorced") echo 'selected'; ?> value="divorced">Divorced</option>
                                                        <option <?php if ($row['marital_status'] == "widow") echo 'selected'; ?> value="widow">Widow</option>
                                                    </select>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label>Spouse Name</label>
                                                    <input type="text" class="form-control" value="<?= $row['spouse_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nationality</label>
                                                    <select class="form-control" disabled>
                                                        <option <?php if ($row['nationality'] == "bangladeshi") echo 'selected'; ?> value="bangladeshi">Bangladeshi</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Religion</label>
                                                    <select class="form-control" name="religion" disabled>
                                                        <option <?php if ($row['religion'] == "islam") echo 'selected'; ?> value="islam" selected>Islam</option>
                                                        <option <?php if ($row['religion'] == "hinduism") echo 'selected'; ?> value="hinduism">Hinduism</option>
                                                        <option <?php if ($row['religion'] == "christianity") echo 'selected'; ?> value="christianity">Christianity</option>
                                                        <option <?php if ($row['religion'] == "Buddhism") echo 'selected'; ?> value="buddhism">Buddhism</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Monthly Avg. Income</label>
                                                    <input type="number" class="form-control" step="any" value="<?= $row['monthly_avg_income'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Daily Savings</label>
                                                    <input type="number" class="form-control" step="any" value="<?= $row['daily_savings'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile No</label>
                                                    <input type="text" class="form-control" value="<?= $row['mobile'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Supporting Document</label>
                                                    <input type="text" class="form-control" value="<?= $row['supporting_doc'] ?>" readonly>

                                                </div>
                                                <div class="form-group">
                                                    <label>Document Number</label>
                                                    <input type="text" class="form-control" name="nid" value="<?= $row['nid'] ?>" readonly required>
                                                </div>
                                                <div id="capture" class="form-group">
                                                    <label>Image</label>
                                                    <img class="col-sm-1" alt="image" src="<?= $row['user_image'] ?>">
                                                </div>

                                                <hr>
                                                <h6 id="nf" class="text-center">Nominee Info</h6>
                                                <hr>

                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" value="<?= $row['nominee_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Relation Type</label>
                                                    <input type="text" class="form-control" value="<?= $row['nominee_relation_type'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile No.</label>
                                                    <input type="text" class="form-control" value="<?= $row['nominee_mobile'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Father's Name</label>
                                                    <input type="text" class="form-control" value="<?= $row['nominee_father_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>NID / Passport No.</label>
                                                    <input type="text" class="form-control" value="<?= $row['nominee_nid'] ?>" readonly>
                                                </div>
                                                <hr>
                                                <h6 class="text-center">Guarantor Info</h6>
                                                <hr>

                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" value="<?= $row['guarantor_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Father's Name</label>
                                                    <input type="text" class="form-control" value="<?= $row['guarantor_father_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mother's Name</label>
                                                    <input type="text" class="form-control" value="<?= $row['guarantor_mother_name'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Present Address</label>
                                                    <textarea class="form-control" readonly><?= $row['guarantor_present_address'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Permanent Address</label>
                                                    <textarea class="form-control" readonly><?= $row['guarantor_permanent_address'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>NID / Passport No.</label>
                                                    <input type="text" class="form-control" value="<?= $row['guarantor_nid'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile No.</label>
                                                    <input type="text" class="form-control" value="<?= $row['guarantor_mobile'] ?>" readonly>
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
        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                $('button').hide();
                $('capture').hide();
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: ./dashboard.php");
}
?>