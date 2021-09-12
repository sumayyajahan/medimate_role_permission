<?php
include_once '../include/config.php';
include_once '../include/function.php';

if (isset($_POST)) {
    $state = $_POST['state'];
    $user_id = $_POST['user_id'];
    $loan_id = $_POST['loan_id'];
}
// 1.add transaction 
// 2. add savings record in terns of (-) for withdraw  
// 3. Add loan collection 
// 4. make loan repay done 5. Copy user with new user id 
//UPDATE loan_collection SET transaction_id =  CASE transaction_id WHEN '' THEN 'example' ELSE concat(transaction_id,' example') END WHERE loan_id !=1;

$transaction_id = getUniqueID(10);
$transaction_id_savings = getUniqueID(10);
$savings_id = getUniqueID(8);
$date = date('Y-m-d');

if ($loan_id != NULL) {

    //getting due amount of the last loan of the user

    $sql_get_last_loan_collection = "SELECT due_amount FROM loan_collection WHERE loan_id = '" . $loan_id . "'";
    $row_get_last_loan_collection = mysqli_fetch_assoc($conn->query($sql_get_last_loan_collection));
    $due_amount = $row_get_last_loan_collection['due_amount'];

    //adding transaction log for receiving collection amount of due loan amount
    addTransaction($transaction_id, 'credit', 'loan collection', $due_amount, $user_id, $loan_id, 'loan fully repaid , account '.$state);

    //adding loan collection for that last loan
    addLoanCollection($loan_id, $due_amount, $date, NULL, $transaction_id);

    //loan record repay status , repay date change
    $sql_update_last_loan = "UPDATE loan_record SET repay_status = 1, actual_repay_date = '" . $date . "' WHERE loan_id ='" . $loan_id . "'";
    $conn->query($sql_update_last_loan);
}

    //get total amount of savings of the user
    $sql_get_savings = "SELECT SUM(amount) AS total_savings FROM savings_record WHERE user_id =" . $user_id;
    $row_get_savings = mysqli_fetch_assoc($conn->query($sql_get_savings));
    $savings_amount = $row_get_savings['total_savings'];

    if ($savings_amount > 0) {
        
        // add transaction log for the withdrawal of the money.
        addTransaction($transaction_id_savings, 'debit', 'Savings Withdrawal', $savings_amount, $user_id, $savings_id, 'Full Amount Withdrawal , account ' . $state);
    
        //add saving record of that withdrawal amount in terms of (-ve)
        addSavingsRecord($savings_id, $user_id, 0, $savings_amount*-1, NULL, $date, $transaction_id_savings);
        
    }


    //check for state(close/reset?)
    if ($state == 'close') {
        //make the 	account_active_status = 0
        $sql_user_active_status_close = "UPDATE user_account SET account_active_status = 0 WHERE user_id = '" . $user_id . "'";
        $conn->query($sql_user_active_status_close);
        echo "Account Closed";
        
    }
    if ($state == 'reset') {
        //make the 	account_active_status = 2 & copy all data except user_id 
        $generate_user_id = date("ymdhis") . mt_rand(1010, 9999); //generate new user id for the copied data

        $sql_user_copy = "INSERT INTO user_account (form_no, group_no, member_id, user_id, joining_date, name, father_name, mother_name, present_address, permanent_address, 
        occupation, institute_name, designation, date_of_birth, age, marital_status, spouse_name, nationality, religion, monthly_avg_income, 
        daily_savings, mobile, supporting_doc, nid, user_image, nominee_name, nominee_relation_type, nominee_mobile, nominee_father_name, nominee_nid, 
        guarantor_name, guarantor_father_name, guarantor_mother_name, guarantor_present_address, guarantor_permanent_address, 
        guarantor_nid, guarantor_mobile, account_active_status, defaulter_status) 
        SELECT form_no, group_no, member_id, '" . $generate_user_id . "', '" . $date . "', name, father_name, mother_name, present_address, permanent_address, 
        occupation, institute_name, designation, date_of_birth, age, marital_status, spouse_name, nationality, religion, monthly_avg_income, 
        daily_savings, mobile, supporting_doc, nid, user_image, nominee_name, nominee_relation_type, nominee_mobile, nominee_father_name, nominee_nid, 
        guarantor_name, guarantor_father_name, guarantor_mother_name, guarantor_present_address, guarantor_permanent_address, 
        guarantor_nid, guarantor_mobile, 1, defaulter_status FROM user_account WHERE user_id = '" . $user_id . "'";

        $sql_user_active_status_change = "UPDATE user_account SET account_active_status = 2 WHERE user_id = '" . $user_id . "'";

        $conn->query($sql_user_copy);
        $conn->query($sql_user_active_status_change);


    echo "Account Reset";

    }