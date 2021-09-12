<?php
include_once 'config.php';

function addTransaction($transaction_id, $transaction_type, $transaction_for, $amount, $user_id, $process_id,$comment){
    global $conn;
    $transaction_insert_sql = "INSERT INTO transaction_log(transaction_id,transaction_type,transaction_for,amount,user_id,process_id,comment) 
                               VALUES('" . $transaction_id . "','" . $transaction_type . "','" . $transaction_for . "','" . $amount . "','" . $user_id . "','" . $process_id . "','" . $comment . "')";
    $conn->query($transaction_insert_sql);

}


?>