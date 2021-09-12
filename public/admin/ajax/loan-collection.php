<?php
include_once '../include/config.php';
include_once '../include/function.php';

$msg = "";

if (isset($_POST['loan_id']) && isset($_POST['last_collection_amount'])) {
    $loan_id = $_POST['loan_id'];
    $last_collection_amount = $_POST['last_collection_amount'];

    $sql = "SELECT * FROM `loan_record` WHERE loan_id = '" . $loan_id . "'";
    $row = mysqli_fetch_assoc($conn->query($sql));
    
    $sql_2 = "SELECT due_amount,next_payment_date FROM `loan_collection` WHERE loan_id = '" . $loan_id . "'";
    $row_2 = mysqli_fetch_assoc($conn->query($sql_2));

    if ($row_2['due_amount'] == $last_collection_amount) {

        $transaction_id = getUniqueID(10);
        $actual_repay_date = date('Y-m-d');
        addTransaction($transaction_id, 'debit', 'loan collection', $last_collection_amount, $row['user_id'], $loan_id, 'Loan Collection Amount Received. Full Loan Repaid.');

        $update_sql_lr = "UPDATE `loan_record` SET repay_status = 1, actual_repay_date = '" . $actual_repay_date . "' WHERE loan_id = '" . $loan_id . "'";
        $conn->query($update_sql_lr);
        addLoanCollection($loan_id,$last_collection_amount,$actual_repay_date,NULL,$transaction_id);

        $msg.="Loan Amount Fully Repaid.<br>Collection Successful.";
        $msg.="<br><a target='_blank' href='./view-loan.php?loan_id=".$loan_id . "'>View The Detailed Report</a>";

    }

    if ($row_2['due_amount'] > $last_collection_amount) {

        $transaction_id = getUniqueID(10);
        $actual_date = date('Y-m-d');
        $previous_payment_date = $row_2['next_payment_date'];

        addTransaction($transaction_id, 'debit', 'loan collection', $last_collection_amount, $row['user_id'], $loan_id, 'Loan Collection Amount Received. Partial Payment.');

        $lending_period = $row['lending_period'];
        $installment_number = $row['installment_number'];
        $per_day = floor($lending_period / $installment_number);
        $next_payment_date = date('Y-m-d', strtotime($previous_payment_date . ' + ' . $per_day . ' days'));

        addLoanCollection($loan_id, $last_collection_amount, $actual_date, $next_payment_date, $transaction_id);

        $msg .= "Loan Amount Collected Successfully. ";
        $msg .= "<br>Remaining Due - " . ($row_2['due_amount'] - $last_collection_amount);
        $msg .= "<br>Next Payment Date - " . date('d-m-Y', strtotime($next_payment_date));
        $msg .= "<br><a target='_blank' href='./view-loan.php?loan_id=" . $loan_id . "'>View The Detailed Report</a>";

    }


    echo $msg;
    
}
