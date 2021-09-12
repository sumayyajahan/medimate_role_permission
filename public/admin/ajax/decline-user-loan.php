<?php
include_once '../include/config.php';

$msg = $err = " ";

if (isset($_POST['loan_id'])) {
    $loan_id = $_POST['loan_id'];

    $sql = "DELETE FROM `loan_record` WHERE loan_id = '" . $loan_id ."'";

    if ($conn->query($sql) === TRUE) {
        $msg .=  "Loan Declined.";
    } else {
        $err .=  "<br>Error: " . $conn->error;
    }
    echo $msg.$err;
}
