<?php
include_once '../include/config.php';
if (isset($_POST['transaction_id'])) {
    $transaction_id = $conn->real_escape_string($_POST['transaction_id']);
    $sql = "SELECT * FROM transaction_log WHERE transaction_id = '$transaction_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $user_id = $row["user_id"];
            $transaction_type = $row["transaction_type"];
            $transaction_for = $row["transaction_for"];
            $amount = $row["amount"];
            $process_id = $row["process_id"];
            $comment = $row["comment"];
            $transaction_time = date("l, d F Y, H:i:s A", strtotime($row["transaction_time"]));
            echo json_encode(array(
                "user_id" => $user_id,
                "transaction_type" => ucwords($transaction_type),
                "transaction_for" => ucwords($transaction_for),
                "amount" => $amount,
                "process_id" => $process_id,
                "comment" => ucwords($comment),
                "transaction_time" => $transaction_time
            ));
        }
    }
    
}
?>