<?php
include_once '../include/config.php';
include_once '../include/function.php';

$sql1 = "SELECT `status` FROM auto_fine";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
$status = $row1['status'];
$msg = "You Can't Impose Fine.<br>This System doesn't support Fine.";
if ($status == 1) {
    if (isset($_GET['auto'])) {
        $auto = 0;
    } else $auto = 1;

    $conn->query("INSERT INTO fine_impose_stat(date,auto) VALUES('".date('Y-m-d H:i:s')."',".$auto.")");

    $today = date('Y-m-d');
    $sql = "SELECT lr.loan_id, lr.user_id, lr.fine FROM `loan_record` AS lr LEFT JOIN loan_collection AS lc ON lr.loan_id = lc.loan_id WHERE lc.fine_imposed = 0 AND lr.sanction_status = 1 AND lr.repay_status = 0 AND lr.repay_date <'".$today."'";
    
    $result = $conn->query($sql);
    $msg = "No such User Found to Impose Fine.";
    while ($row = $result->fetch_array()) {
        $user_id = $row['user_id'] ;
        $loan_id = $row['loan_id'] ;
        $fine =  $row['fine'] ;
        
        $transaction_id = getUniqueID(10);
        addTransaction($transaction_id,'fine', 'Loan Collection Fine Added', $fine, $user_id, $loan_id, 'Fine Amount added to user for late repay');
        
        $query = "UPDATE loan_collection SET total_loan_repay_amount = total_loan_repay_amount+".$fine. ", due_amount = due_amount+" . $fine . ", fine_imposed = ".$fine." WHERE loan_id = '" . $loan_id . "'";
        $conn->query($query);
        $msg = "Fine Imposed by Admin";
    
    }   
}
echo $msg ;



