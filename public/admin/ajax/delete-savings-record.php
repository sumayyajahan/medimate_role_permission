<?php
include_once '../include/config.php';

$msg = $err = " ";

if (isset($_POST['savings_id'])) {
    $savings_id = $_POST['savings_id'];

    $sql_t = "DELETE FROM `transaction_log` WHERE process_id = '" . $savings_id . "'";
    $sql_s = "DELETE FROM `savings_record` WHERE savings_id = '" . $savings_id . "'";

    if ($conn->query($sql_s) === TRUE) {
    if ($conn->query($sql_t) === TRUE) {
        $msg .=  "Savings Record Erased.";
    } else {
            $err .=  "<br>Error: " . $conn->error;
        }
    } else {
        $err .=  "<br>Error: " . $conn->error;
    }
    echo $msg . $err;
}
