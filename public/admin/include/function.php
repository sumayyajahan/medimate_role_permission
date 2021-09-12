<?php
date_default_timezone_set("Asia/Dhaka");
function getUniqueID($length)
{
    $unique_keys = str_shuffle(time() . strtoupper(uniqid('ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
    return substr($unique_keys, 0, $length);
}

include_once 'config.php';

function addTransaction($transaction_id, $transaction_type, $transaction_for, $amount, $user_id, $process_id, $comment)
{
    global $conn;
    $transaction_insert_sql = "INSERT INTO transaction_log(transaction_id,transaction_type,transaction_for,amount,user_id,process_id,comment,transaction_time) 
                               VALUES('" . $transaction_id . "','" . $transaction_type . "','" . $transaction_for . "','" . $amount . "','" . $user_id . "','" . $process_id . "','" . $comment . "','" . date('Y-m-d H:i:s') ."')";
    $conn->query($transaction_insert_sql);
}


function addLoanCollection($loan_id, $last_collection_amount, $collection_date, $next_payment_date, $transaction_id)
{
    global $conn;
    $loan_collection_insert_sql = "UPDATE loan_collection SET last_collection_amount = " . $last_collection_amount . ", 
                                   due_amount =  due_amount -" . $last_collection_amount . ", 
                                   collection_date = '" . $collection_date . "', next_payment_date = '" . $next_payment_date . "', transaction_id =  IFNULL (CONCAT( transaction_id , ',". $transaction_id ."' ), '". $transaction_id ."')   
                                   WHERE loan_id = '" . $loan_id . "'"; 
    $conn->query($loan_collection_insert_sql);
}

function addSavingsRecord($savings_id, $user_id, $number_of_day, $amount, $next_payment_date, $savings_date, $transaction_id)
{
    global $conn;
    $savings_insert_sql = "INSERT INTO savings_record  (`savings_id`, `user_id`, `number_of_day`, `amount`, `next_payment_date`, `savings_date`, `transaction_id`) VALUES('" . $savings_id . "', '" . $user_id . "', '" . $number_of_day . "', '" . $amount . "', '" . $next_payment_date . "', '" . $savings_date . "', '" . $transaction_id . "')"; 
    $conn->query($savings_insert_sql);
}


// function for approving loan used in approve loan from requested one and edit loan page

function approveLoan($loan_id){
    global $conn;
    $msg = $err = " ";
    $lending_date = date('Y-m-d');

    $sql = "SELECT * FROM `loan_record` WHERE loan_id = '" . $loan_id . "'";
    $row = mysqli_fetch_assoc($conn->query($sql));
    $lending_period = $row['lending_period'];
    $installment_number = $row['installment_number'];
    $repay_date = date('Y-m-d', strtotime($lending_date . ' + ' . $lending_period . ' days'));
    $total_amount = $row['total_amount'];
    $per_day = floor($lending_period / $installment_number);
    $next_payment_date = date('Y-m-d', strtotime($lending_date . ' + ' . $per_day . ' days'));

    $transaction_id = getUniqueID(10);
    addTransaction($transaction_id, 'debit', 'loan sanction', $row['amount'], $row['user_id'], $loan_id, 'Loan Amount Given to User Upon User Request');

    $update_sql = "UPDATE `loan_record` SET lending_date = '" . $lending_date . "', repay_date = '" . $repay_date . "', sanction_status = 1, 
                    transaction_id = '" . $transaction_id . "' WHERE loan_id = '" . $loan_id . "'";


    $insert_to_loan_collection = "INSERT INTO `loan_collection` (`loan_id`, `user_id`, `last_collection_amount`, 
                       `total_loan_repay_amount`, `due_amount`, `fine_imposed`, `next_payment_date`) 
                       VALUES ('" . $loan_id . "','" . $row['user_id'] . "',0,'" . $total_amount . "','" . $total_amount . "',
                       0,'" . $next_payment_date . "')";

    if ($conn->query($update_sql) === TRUE) {
        if ($conn->query($insert_to_loan_collection) === TRUE) {
            $msg .=  "Loan Sanctioned to User.";
        } else {
            $err .=  "Error: " . $conn->error;
        }
    } else {
        $err .=  "<br>Error: " . $conn->error;
    }
    echo $msg . $err;

}

?>