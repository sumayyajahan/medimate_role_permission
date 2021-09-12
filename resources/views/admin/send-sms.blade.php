<?php
include_once './include/config.php';
$mobile = "";

if (isset($_GET['mobile'])) {

    $mobile = $_GET['mobile'];
}

if (isset($_POST['sendsms'])) {
    $to = $_POST['mobile'];
    $token = "3b02e2588412c41d757c26939c3e338";
    $message = $_POST['msg'];

    $url = "http://api.greenweb.com.bd/api.php";


    $data = array(
        'to' => "$to",
        'message' => "$message",
        'token' => "$token"
    ); // Add parameters in key value
    $ch = curl_init(); // Initialize cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $smsresult = curl_exec($ch);

    //Result
    echo '
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

  swal.fire({
    position: "top-end",
    html: "' . $smsresult . '",
    showConfirmButton: false,
    timer: 4000
  }).then(function(){
      window.close() ;
  })
});

</script>
';

    //Error Display
    echo curl_error($ch);
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
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
                        <li class="breadcrumb-item">Send SMS</li>
                        <!-- <li class="breadcrumb-item">Details</li> -->
                    </ul>
                    <div class="section-body">
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                            <div class="card">
                                <div class="boxs mail_listing">
                                    <div class="inbox-center table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th colspan="1">
                                                        <div class="inbox-header">
                                                            Compose New Message
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form class="composeForm" method="POST" action="send-sms.php">
                                                <!-- <form class="composeForm" method="POST" action="p.php"> -->
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="mobile" class="form-control" placeholder="TO" value="<?= $mobile ?>" readonly required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="msg" class="form-control" placeholder="Message" required>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="m-l-25 m-b-20">
                                                <button type="submit" name="sendsms" class="btn btn-info btn-border-radius waves-effect">Send</button>
                                                <button type="reset" class="btn btn-danger btn-border-radius waves-effect">Discard</button>
                                            </div>
                                        </div>
                                        </form>
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
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
</body>

</html>