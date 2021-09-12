<?php
include_once '../include/config.php';
include_once '../include/function.php';

if (isset($_POST)) {
    $user_id = $_POST['user_id'];
    
    //make the 	account_active_status = 1
    $sql_user_active_status_close = "UPDATE user_account SET account_active_status = 1 WHERE user_id = '" . $user_id . "'";
    $conn->query($sql_user_active_status_close);
    echo "Account Re-Activated";
    
}