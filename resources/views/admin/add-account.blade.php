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
                            <h4 class="page-title m-b-0">User</h4>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="./dashboard.php">
                                <i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Add Account</li>
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
                                <form id="add-account" class="form-group" action="add-account.php" method="post" enctype="multipart/form-data">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Add Account</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-inline" style="justify-content:space-evenly">
                                                <label>Form No</label>
                                                <input type="number" class="form-control mb-2 mr-sm-2" name="form_no" autofocus required>
                                                <label>Group</label>
                                                <input type="text" class="form-control mb-2 mr-sm-2" name="group_no" value="<?= $generate_group ?>" required>
                                                <label>Member ID</label>
                                                <input type="text" class="form-control mb-2 mr-sm-2" name="member_id" value="<?= $generate_user_id ?>" required>
                                            </div>

                                            <div class="form-inline" style="justify-content:space-evenly">
                                                <label>User ID</label>
                                                <input type="text" class="form-control mb-2 mr-sm-0" name="user_id" value="<?= $generate_user_id ?>" required>
                                                <label>Joining Date</label>
                                                <input type="date" class="form-control mb-2 mr-sm-3" name="joining_date" value="<?= date("Y-m-d") ?>" required>
                                            </div>

                                            <hr>
                                            <h6 class="text-center">Personal Info</h6>
                                            <hr>

                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Father's Name</label>
                                                <input type="text" class="form-control" name="father_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Mother's Name</label>
                                                <input type="text" class="form-control" name="mother_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Present Address</label>
                                                <textarea class="form-control" name="present_address" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Permanent Address</label>
                                                <textarea class="form-control" name="permanent_address" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Occupation</label>
                                                <input type="text" class="form-control" name="occupation" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Institution Name</label>
                                                <input type="text" class="form-control" name="institute_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <input type="text" class="form-control" name="designation" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="date" class="form-control" id="date_of_birth" max="<?= date("Y-m-d") ?>" onchange="getAge();" name="date_of_birth" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input type="text" class="form-control" id="age" name="age" required readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Marital Status</label>
                                                <select id="marital_status" class="form-control" name="marital_status" required>
                                                    <option value="single">Single</option>
                                                    <option value="married">Married</option>
                                                    <option value="divorced">Divorced</option>
                                                    <option value="widow">Widow</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Spouse Name</label>
                                                <input id="spouse_name" type="text" class="form-control" name="spouse_name" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Nationality</label>
                                                <select class="form-control" name="nationality" required>
                                                    <option value="bangladeshi" selected>Bangladeshi</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <select class="form-control" name="religion" required>
                                                    <option value="islam" selected>Islam</option>
                                                    <option value="hinduism">Hinduism</option>
                                                    <option value="christianity">Christianity</option>
                                                    <option value="buddhism">Buddhism</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Monthly Avg. Income</label>
                                                <input type="number" class="form-control" min="1" step="any" name="monthly_avg_income" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Daily Savings</label>
                                                <input type="number" class="form-control" min="1" step="any" name="daily_savings" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile No</label>
                                                <input type="text" class="form-control" name="mobile" minlength="11" maxlength="11" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Supporting Document</label>
                                                <select id="supporting_doc" class="form-control" name="supporting_doc" required>
                                                    <option value="NID" selected>NID</option>
                                                    <option value="Passport">Passport</option>
                                                    <option value="Birth Certificate">Birth Certificate</option>
                                                    <option value="Driving License Number">Driving License Number</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Document Number</label>
                                                <input type="text" class="form-control" name="nid" placeholder="NID/Passport/Birth Certificate/Driving License Number" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" class="form-control" name="user_image" required>
                                            </div>

                                            <hr>
                                            <h6 class="text-center">Nominee Info</h6>
                                            <hr>

                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="nominee_name" value="N/A" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Relation Type</label>
                                                <input type="text" class="form-control" name="nominee_relation_type" value="N/A" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile No.</label>
                                                <input type="text" class="form-control" name="nominee_mobile" minlength="11" maxlength="11" value="01XXXXXXXXX" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Father's Name</label>
                                                <input type="text" class="form-control" name="nominee_father_name" value="N/A" required>
                                            </div>
                                            <div class="form-group">
                                                <label>NID / Passport No.</label>
                                                <input type="text" class="form-control" name="nominee_nid" value="N/A" required>
                                            </div>
                                            <hr>
                                            <h6 class="text-center">Guarantor Info</h6>
                                            <hr>

                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="guarantor_name" value="N/A" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Father's Name</label>
                                                <input type="text" class="form-control" name="guarantor_father_name" value="N/A" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Mother's Name</label>
                                                <input type="text" class="form-control" name="guarantor_mother_name" value="N/A" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Present Address</label>
                                                <textarea class="form-control" name="guarantor_present_address" required>N/A</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Permanent Address</label>
                                                <textarea class="form-control" name="guarantor_permanent_address" required>N/A</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>NID / Passport No.</label>
                                                <input type="text" class="form-control" name="guarantor_nid" value="N/A" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile No.</label>
                                                <input type="text" class="form-control" name="guarantor_mobile" minlength="11" maxlength="11" value="01XXXXXXXXX" required>
                                            </div>
                                        </div>
                                        <div class="card-footer text-left">
                                            <button class="btn btn-primary mr-1" type="submit" name="submit">Submit</button>
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
            if ($('#msg-err').length > 1) {
                $('#msg-err').remove();
                window.location = window.location.href;
            }
        }, 7000)

        function getAge() {
            var dateString = $("#date_of_birth").val();
            var today = new Date();
            var birthDate = new Date(dateString);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            $("#age").val(age);
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