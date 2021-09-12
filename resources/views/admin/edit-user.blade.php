<?php
include_once './include/config.php';
unset($msg);
unset($err);
$msg = "";
$err = "";
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    $msg = "";
    $err = "";

    // image directory set
    $target_dir = "./uploads/users/";
    $target_file = $target_dir . $_POST['user_id'] . ".jpg";
    $uploadOk = 1;
    $fileOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $form_no = $_POST['form_no'];
    $group_no = $_POST['group_no'];
    $member_id = $_POST['member_id'];
    $user_id = $_POST['user_id'];
    $joining_date = $_POST['joining_date'];
    $name = $_POST['name'];
    $app_password = $_POST['app_password'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $present_address = $_POST['present_address'];
    $permanent_address = $_POST['permanent_address'];
    $occupation = $_POST['occupation'];
    $institute_name = $_POST['institute_name'];
    $designation = $_POST['designation'];
    $date_of_birth = $_POST['date_of_birth'];
    $age = $_POST['age'];
    $marital_status = $_POST['marital_status'];
    $spouse_name = $_POST['spouse_name'];
    $nationality = $_POST['nationality'];
    $religion = $_POST['religion'];
    $monthly_avg_income = $_POST['monthly_avg_income'];
    $daily_savings = $_POST['daily_savings'];
    $mobile = $_POST['mobile'];
    $supporting_doc = $_POST['supporting_doc'];
    $nid = $_POST['nid'];
    $nominee_name = $_POST['nominee_name'];
    $nominee_relation_type = $_POST['nominee_relation_type'];
    $nominee_mobile = $_POST['nominee_mobile'];
    $nominee_father_name = $_POST['nominee_father_name'];
    $nominee_nid = $_POST['nominee_nid'];
    $guarantor_name = $_POST['guarantor_name'];
    $guarantor_father_name = $_POST['guarantor_father_name'];
    $guarantor_mother_name = $_POST['guarantor_mother_name'];
    $guarantor_present_address = $_POST['guarantor_present_address'];
    $guarantor_permanent_address = $_POST['guarantor_permanent_address'];
    $guarantor_nid = $_POST['guarantor_nid'];
    $guarantor_mobile = $_POST['guarantor_mobile'];
    $defaulter_status_post = $_POST['defaulter_radio'];


    // upload iamge file

    if ($_FILES["user_image"]["size"] > 0) {
        // Check file size
        if ($_FILES["user_image"]["size"] > 5000000) {
            $err =  "Your file is too large.<br>Upload Image less then 5mb.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $err .=  "Only JPG, JPEG, PNG files are allowed.<br>";
            $uploadOk = 0;
        }
    }
    if ($_FILES["user_image"]["size"] == 0) {
        $fileOk = 0;
    }



    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $err .=  "Your file was not uploaded.<br>";
        // if everything is ok, try to upload file
    } else { //add col name write update query
        $sql = "UPDATE user_account SET 
        form_no = " . $form_no . ", group_no =  '" . $group_no . "', member_id =  '" . $member_id . "', joining_date = '" . $joining_date . "',
        name = '" . $name . "', father_name = '" . $father_name . "',mother_name = '" . $mother_name . "',
        present_address = '" . $present_address . "', permanent_address = '" . $permanent_address . "',
        occupation = '" . $occupation . "', institute_name = '" . $institute_name . "', designation = '" . $designation . "',
        date_of_birth = '" . $date_of_birth . "', age = '" . $age . "', marital_status = '" . $marital_status . "',
        spouse_name = '" . $spouse_name . "', nationality = '" . $nationality . "', religion = '" . $religion . "',
        monthly_avg_income = '" . $monthly_avg_income . "', daily_savings = '" . $daily_savings . "', mobile = '" . $mobile . "',
        supporting_doc = '" . $supporting_doc . "', nid = '" . $nid . "', app_password = '" . $app_password . "', nominee_name = '" . $nominee_name . "', nominee_relation_type = '" . $nominee_relation_type . "',
        nominee_mobile = '" . $nominee_mobile . "', nominee_father_name = '" . $nominee_father_name . "', nominee_nid = '" . $nominee_nid . "',
        guarantor_name = '" . $guarantor_name . "', guarantor_father_name = '" . $guarantor_father_name . "',
        guarantor_mother_name = '" . $guarantor_mother_name . "', guarantor_present_address = '" . $guarantor_present_address . "',
        guarantor_permanent_address = '" . $guarantor_permanent_address . "', guarantor_nid = '" . $guarantor_nid . "', guarantor_mobile = '" . $guarantor_mobile . "',
        defaulter_status = '" . $defaulter_status_post . "' WHERE user_id = '" . $user_id . "'";
        if ($conn->query($sql) === TRUE) {
            if ($fileOk == 1) {
                if (file_exists($target_file)) unlink($target_file);
                move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file);
            }
            $msg .=  "Form No: " . $form_no . " | USER ID: " . $member_id;
            $msg .=  "<hr><h3>" . $name . "</h3>";
        } else {
            $err .=  "Error: " . $conn->error;
        }
    }
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $sql = "SELECT * FROM user_account WHERE user_id =" . $user_id;
    $row = mysqli_fetch_assoc($conn->query($sql));
    $defaulter = $row['defaulter_status'];
    $defaulter_status = ($defaulter == 1) ? "Yes" :  "No";
    $defaulter_status_no = ($defaulter == 0) ? "checked" :  "";
    $defaulter_status_yes = ($defaulter == 1) ? "checked" :  "";
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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script>
            function alertFunc(msg) {
                Swal.fire({
                    icon: 'success',
                    title: "Edited Successful",
                    html: msg
                })
            }

            function alertFuncErr() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: err
                })
            }
        </script>
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
                        <div id="msg-err">
                            <h1 style="color:green;"><?php if ($msg) {
                                                            echo '<script type="text/javascript">',
                                                                'alertFunc("' . $msg . '");',
                                                                '</script>';
                                                        } ?></h1>
                            <h1 style="color:red;"><?php if ($err) {
                                                        echo '<script type="text/javascript">',
                                                            'alertFuncErr("' . $err . '");',
                                                            '</script>';
                                                    } ?></h1>

                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <form id="add-account" class="form-group" action="" method="post" enctype="multipart/form-data">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Account Details of - <?= $row['name'] ?> (<?= $row['member_id'] ?>)</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-inline" style="justify-content:space-evenly">
                                                    <label>Form No</label>
                                                    <input type="number" class="form-control mb-2 mr-sm-2" name="form_no" value="<?= $row['form_no'] ?>" required>
                                                    <label>Group</label>
                                                    <input type="text" class="form-control mb-2 mr-sm-2" name="group_no" value="<?= $row['group_no']  ?>" required>
                                                    <label>Member ID</label>
                                                    <input type="text" class="form-control mb-2 mr-sm-2" name="member_id" value="<?= $row['member_id'] ?>" readonly required>
                                                </div>

                                                <div class="form-inline" style="justify-content:space-evenly">
                                                    <label>User ID</label>
                                                    <input type="text" class="form-control mb-2 mr-sm-0" name="user_id" value="<?= $row['user_id'] ?>" readonly>
                                                    <label>Joining Date</label>
                                                    <input type="date" class="form-control mb-2 mr-sm-3" name="joining_date" value="<?= $row['joining_date'] ?>" required>
                                                </div>
                                                <hr>
                                                <div class="form-group col-2" data-toggle="tooltip" data-placement="top" title="User's Current Status : <?= $defaulter_status ?>">
                                                    <label class="form-label">Defaulter ? </label>
                                                    <div class="selectgroup w-100">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="defaulter_radio" value="1" class="selectgroup-input-radio" <?= $defaulter_status_yes ?>>
                                                            <span class="selectgroup-button">Yes</span>
                                                        </label>
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="defaulter_radio" value="0" class="selectgroup-input-radio" <?= $defaulter_status_no ?>>
                                                            <span class="selectgroup-button">No</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <label>Change Password</label>
                                                    <input type="text" class="form-control" name="app_password" value="<?= $row['app_password'] ?>" required>
                                                </div>

                                                <hr>
                                                <h6 class="text-center">Personal Info</h6>
                                                <hr>

                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name" value="<?= $row['name'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Father's Name</label>
                                                    <input type="text" class="form-control" name="father_name" value="<?= $row['father_name'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mother's Name</label>
                                                    <input type="text" class="form-control" name="mother_name" value="<?= $row['mother_name'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Present Address</label>
                                                    <textarea class="form-control" name="present_address" required><?= $row['present_address'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Permanent Address</label>
                                                    <textarea class="form-control" name="permanent_address" required><?= $row['permanent_address'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control" name="occupation" value="<?= $row['occupation'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Institution Name</label>
                                                    <input type="text" class="form-control" name="institute_name" value="<?= $row['institute_name']  ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <input type="text" class="form-control" name="designation" value="<?= $row['designation']  ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date of Birth</label>
                                                    <input type="date" class="form-control" name="date_of_birth" value="<?= $row['date_of_birth']  ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="text" class="form-control" name="age" value="<?= $row['age']  ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Marital Status</label>
                                                    <select id="marital_status" class="form-control" name="marital_status" required>
                                                        <option <?php if ($row['marital_status'] == "single") echo 'selected'; ?> value="single">Single</option>
                                                        <option <?php if ($row['marital_status'] == "married") echo 'selected'; ?> value="married">Married</option>
                                                        <option <?php if ($row['marital_status'] == "divorced") echo 'selected'; ?> value="divorced">Divorced</option>
                                                        <option <?php if ($row['marital_status'] == "widow") echo 'selected'; ?> value="widow">Widow</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Spouse Name</label>
                                                    <input id="spouse_name" type="text" class="form-control" name="spouse_name" value="<?= $row['spouse_name'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nationality</label>
                                                    <select class="form-control" name="nationality" required>
                                                        <option <?php if ($row['nationality'] == "bangladeshi") echo 'selected'; ?> value="bangladeshi">Bangladeshi</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Religion</label>
                                                    <select class="form-control" name="religion" required>
                                                        <option <?php if ($row['religion'] == "islam") echo 'selected'; ?> value="islam" selected>Islam</option>
                                                        <option <?php if ($row['religion'] == "hinduism") echo 'selected'; ?> value="hinduism">Hinduism</option>
                                                        <option <?php if ($row['religion'] == "christianity") echo 'selected'; ?> value="christianity">Christianity</option>
                                                        <option <?php if ($row['religion'] == "Buddhism") echo 'selected'; ?> value="buddhism">Buddhism</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Monthly Avg. Income</label>
                                                    <input type="number" class="form-control" name="monthly_avg_income" step="any" value="<?= $row['monthly_avg_income'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Daily Savings</label>
                                                    <input type="number" class="form-control" name="daily_savings" step="any" value="<?= $row['daily_savings'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile No</label>
                                                    <input type="text" class="form-control" name="mobile" value="<?= $row['mobile'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Supporting Document</label>
                                                    <select id="supporting_doc" class="form-control" name="supporting_doc" required>
                                                        <option <?php if ($row['supporting_doc'] == "NID") echo 'selected'; ?> value="NID" selected>NID</option>
                                                        <option <?php if ($row['supporting_doc'] == "Passport") echo 'selected'; ?> value="Passport">Passport</option>
                                                        <option <?php if ($row['supporting_doc'] == "Birth Certificate") echo 'selected'; ?> value="Birth Certificate">Birth Certificate</option>
                                                        <option <?php if ($row['supporting_doc'] == "Driving License Number") echo 'selected'; ?> value="Driving License Number">Driving License Number</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Document Number</label>
                                                    <input type="text" class="form-control" name="nid" value="<?= $row['nid'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <div class="row">
                                                        <img class="col-sm-2" alt="image" src="<?= $row['user_image'] ?>">
                                                        <input type="file" class="form-control col-md-4" name="user_image">
                                                    </div>

                                                </div>

                                                <hr>
                                                <h6 class="text-center">Nominee Info</h6>
                                                <hr>

                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="nominee_name" value="<?= $row['nominee_name'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Relation Type</label>
                                                    <input type="text" class="form-control" name="nominee_relation_type" value="<?= $row['nominee_relation_type'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile No.</label>
                                                    <input type="text" class="form-control" name="nominee_mobile" value="<?= $row['nominee_mobile'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Father's Name</label>
                                                    <input type="text" class="form-control" name="nominee_father_name" value="<?= $row['nominee_father_name'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>NID / Passport No.</label>
                                                    <input type="text" class="form-control" name="nominee_nid" value="<?= $row['nominee_nid'] ?>" required>
                                                </div>
                                                <hr>
                                                <h6 class="text-center">Guarantor Info</h6>
                                                <hr>

                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="guarantor_name" value="<?= $row['guarantor_name'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Father's Name</label>
                                                    <input type="text" class="form-control" name="guarantor_father_name" value="<?= $row['guarantor_father_name'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mother's Name</label>
                                                    <input type="text" class="form-control" name="guarantor_mother_name" value="<?= $row['guarantor_mother_name'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Present Address</label>
                                                    <textarea class="form-control" name="guarantor_present_address" required><?= $row['guarantor_present_address'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Permanent Address</label>
                                                    <textarea class="form-control" name="guarantor_permanent_address" required><?= $row['guarantor_permanent_address'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>NID / Passport No.</label>
                                                    <input type="text" class="form-control" name="guarantor_nid" value="<?= $row['guarantor_nid'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile No.</label>
                                                    <input type="text" class="form-control" name="guarantor_mobile" value="<?= $row['guarantor_mobile'] ?>" required>
                                                </div>
                                                <div class="card-footer text-left">
                                                    <button class="btn btn-success mr-1" name="submit" type="submit">Update</button>
                                                    <button class="btn btn-secondary" type="reset">Reset</button>
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
        <script>
            var optionSelected = document.getElementById("marital_status");
            var valueSelected = optionSelected.options[optionSelected.selectedIndex].value;

            if (valueSelected == "single") {
                $('#spouse_name').val('');
                $('#spouse_name').attr('readonly', true);

            } else {
                $('#spouse_name').attr('readonly', false);
            }

            $('#marital_status').on('change', function(e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                if (valueSelected == "single") {
                    $('#spouse_name').val('');
                    $('#spouse_name').attr('readonly', true);

                } else {
                    $('#spouse_name').attr('readonly', false);
                }
            });
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
    header("Location: ./dashboard.php");
}
?>