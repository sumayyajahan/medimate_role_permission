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
                            <h4 class="page-title m-b-0">Admin</h4>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="./dashboard.php">
                                <i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">View Doctor - 1</li>
                        <li class="breadcrumb-item">View Form</li>
                    </ul>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <form id="add-account" class="form-group" action="add-account.php" method="post" enctype="multipart/form-data">
                                    <div id="card" class="card">
                                        <div class="card-header">
                                            <h4> Doctor's Profile</h4>
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" value="Test Doctor Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Mobile No.</label>
                                                <input type="text" class="form-control" name="mobile" minlength="11" maxlength="11" value="0125125452" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" value="username@mail.com" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="date" class="form-control" name="dob" value="1992-06-11" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Document Type</label>
                                                <select class="form-control" name="district" id="">
                                                    <option value="">Select Document</option>
                                                    <option value="" selected>NID</option>
                                                    <option value="">Passport No</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Document No</label>
                                                <input type="text" class="form-control" name="bmdc_reg" required value="125125545285">
                                            </div>
                                            <div class="form-group">
                                                <label>BMDC Registration No</label>
                                                <input type="text" class="form-control" name="bmdc_reg" required value="ASDF-545125545285">
                                            </div>
                                            <div class="form-group">
                                                <label>Doctor's Department</label>
                                                <select class="form-control" name="district" id="">
                                                    <option value="">Select Department</option>
                                                    <option value="" selected>Kidney</option>
                                                    <option value="">Neurology</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Doctor's Degree</label>
                                                <input type="text" class="form-control" name="deg" required value="MBBS">
                                            </div>
                                            <div class="form-group">
                                                <label>Doctor's Designation</label>
                                                <input type="text" class="form-control" name="des" value="Professor, DMCH" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Doctor's Specialized Felid</label>
                                                <input type="text" class="form-control" name="spec" value="Kidney Specialist" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="address" value="Dhaka, BD" required>
                                            </div>

                                            <div class="form-group">
                                                <label>District</label>
                                                <select class="form-control" name="district" id="">
                                                    <option value="">Select District</option>
                                                    <option selected value="">District 1</option>
                                                    <option value="">District 2</option>
                                                    <option value="">District 3</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Police Station</label>
                                                <select class="form-control" name="ps" id="">
                                                    <option value="">Select Police Station</option>
                                                    <option selected value="">Police Station 2</option>
                                                    <option value="">Police Station 3</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Post Office</label>
                                                <select class="form-control" name="po" id="">
                                                    <option value="">Select Post Office</option>
                                                    <option selected value="">PPost Office 2</option>
                                                    <option value="">Post Office 3</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" value="userdoc" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="text" class="form-control" name="password" value="<?= bin2hex(openssl_random_pseudo_bytes(4)) ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Doctor's Image</label>
                                                <br>
                                                <img style="max-width:90%;height:auto" src="uploads/user.png" alt="" srcset=""> <br>
                                                <input id="capture" class="form-control" type="file" name="user_image" accept="image/*" />


                                            </div>


                                        </div>
                                        <div class="card-footer text-left">
                                            <button class="btn btn-primary mr-1" type="submit" name="submit">Update</button>
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
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            $('button').hide();
            $('#capture').hide();
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
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
                $('#spouse_name').attr('', true);

            } else {
                $('#spouse_name').attr('', false);
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