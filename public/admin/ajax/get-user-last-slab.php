<?php
include_once '../include/config.php';
if (isset($_POST['user_id'])) {
    $user_id = $conn->real_escape_string($_POST['user_id']);

    $sql = "SELECT MAX(slab) as max_slab, slab.* FROM loan_record  LEFT JOIN slab ON `slab` = slab.slab_id WHERE sanction_status = 1 AND user_id = ".$user_id;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $sql_history = "SELECT COUNT(*) as cnt FROM loan_record WHERE sanction_status = 1 AND repay_status = 0 AND user_id = ".$user_id;
    $result_history = $conn->query($sql_history);
    $row_history_history = $result_history->fetch_assoc();

    $sql_get_savings = "SELECT SUM(amount) AS total_savings FROM savings_record WHERE user_id =" . $user_id;
    $row_get_savings = mysqli_fetch_assoc($conn->query($sql_get_savings));
    $savings_amount = $row_get_savings['total_savings'];

    if ($row["max_slab"] == NULL) {
        $max_slab_echo =  "Previous Loan Slab Not Found";
        $cnt_echo =  "Previous Loan Data Not Found";
        $color = "blue";
    } else {
        $max_slab =  "BDT " . $row["amount"] . " for " . $row["period"] . " days, Fee " . $row["interest"] ;
        $max_slab_echo =   "Previous Max Availed Slab - " . $max_slab;
        $cnt = $row_history_history["cnt"];
        if ($cnt == 0) {
            $cnt_echo = "All Previous Loan Repaid Successfully";
            $color = "green";
        } else {
            $cnt_echo = "Previous Loan NOT REPAID";
            $color = "red";
        }
    }

    echo json_encode(array(
        "max_slab_echo" => $max_slab_echo,
        "cnt_echo" => $cnt_echo,
        "color" => $color,
        "savings_amount" => $savings_amount
    ));

}
