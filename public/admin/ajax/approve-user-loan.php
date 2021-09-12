<?php
include_once '../include/config.php';
include_once '../include/function.php';

$msg = $err = " ";

if (isset($_POST['loan_id'])) {
    $loan_id = $_POST['loan_id'];
    approveLoan($loan_id);
}
?>