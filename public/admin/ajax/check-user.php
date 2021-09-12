<?php
include_once '../include/config.php';

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    $count_defaulted_loan = "SELECT COUNT(*) AS cnt FROM `loan_record` WHERE sanction_status = 1 AND repay_date < actual_repay_date AND user_id =" . $user_id;
    $row_count_defaulted_loan = mysqli_fetch_assoc($conn->query($count_defaulted_loan));
    $cnt  = $row_count_defaulted_loan['cnt'];

    $count_loan_due = "SELECT DATEDIFF('" . date('Y-m-d') . "',repay_date) AS diff FROM `loan_record` WHERE sanction_status = 1 AND repay_status = 0 AND user_id =" . $user_id . " ORDER by lending_date desc LIMIT 1";
    $row_count_loan_due = mysqli_fetch_assoc($conn->query($count_loan_due));
    if (!empty($row_count_loan_due)) {
        if ($row_count_loan_due['diff'] > -1) {
            $loan_due = $row_count_loan_due['diff'];
        } else $loan_due = 0;
    }
    else $loan_due = 0;

    $sql_savings_due = "SELECT DATEDIFF('" . date('Y-m-d') . "',next_payment_date) AS diff FROM `savings_record` WHERE user_id =" . $user_id . " ORDER by savings_date desc LIMIT 1";
    $row_savings_due = mysqli_fetch_assoc($conn->query($sql_savings_due));
    if ($row_savings_due['diff'] > -1) {
        $savings_due = $row_savings_due['diff'];
    } else $savings_due = 0;

    $sql_get_last_loan = "SELECT loan_id, repay_status FROM loan_record WHERE user_id =" . $user_id . " ORDER BY lending_date DESC LIMIT 1";
    $row_get_last_loan = mysqli_fetch_assoc($conn->query($sql_get_last_loan));
    $loan_id = NULL;
    if ($row_get_last_loan['repay_status'] == 0) {
        $loan_id = $row_get_last_loan['loan_id'];

        $sql_get_last_loan_collection = "SELECT due_amount FROM loan_collection WHERE loan_id = '" . $loan_id . "'";

        $row_get_last_loan_collection = mysqli_fetch_assoc($conn->query($sql_get_last_loan_collection));
        $loan_collection_due = $row_get_last_loan_collection['due_amount'];
    } else {
        $loan_collection_due = 0;
    }


    $sql_get_savings = "SELECT SUM(amount) AS total_savings FROM savings_record WHERE user_id =" . $user_id;
    $row_get_savings = mysqli_fetch_assoc($conn->query($sql_get_savings));
    $savings_amount = $row_get_savings['total_savings'];

    echo json_encode(array(
        "cnt" => $cnt,
        "loan_due" => $loan_due,
        "loan_collection_due" => $loan_collection_due,
        "savings_due" => $savings_due,
        "savings_amount" => $savings_amount
    ));

}
?>