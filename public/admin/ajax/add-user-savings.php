<?php
include_once '../include/config.php';
include_once '../include/function.php';
$msg = "";

if (isset($_POST['user_id'])) {
    $msg = "";
    $user_id = $_POST['user_id'];
    $number_of_day = $_POST['number_of_day'];
    $amount = $_POST['amount'];
    $next_payment_date = $_POST['next_payment_date'];
    $savings_date = date('Y-m-d');


    $transaction_id = getUniqueID(10);
    $savings_id = getUniqueID(8);

    addTransaction($transaction_id, 'credit', 'Savings Amount Deposit', $amount, $user_id, $savings_id, 'Daily Savings Amount Deposited by User From Admin Panel');

    addSavingsRecord($savings_id, $user_id, $number_of_day, $amount, $next_payment_date, $savings_date, $transaction_id);

    $msg .= "Savings Record Added";
}

?>
