<?php
include_once '../include/config.php';

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    $sql = "SELECT name, daily_savings, joining_date FROM user_account WHERE user_id =" . $user_id;
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);

    $name = $row['name'];
    $daily_savings = $row['daily_savings'];
    $joining_date = $row['joining_date'];


    $sql_savings = "SELECT savings_date, next_payment_date FROM `savings_record` WHERE user_id =" . $user_id . " ORDER by record_add_time desc LIMIT 1";
    $row_savings = mysqli_fetch_assoc($conn->query($sql_savings));

    $savings_date = $row_savings['savings_date'];
    $next_payment_date = (empty($row_savings['next_payment_date'])? $joining_date : $row_savings['next_payment_date']);

    echo json_encode(array(
        "name" => $name,
        "daily_savings" => $daily_savings,
        "savings_date" => $savings_date,
        "next_payment_date" => $next_payment_date
    ));

}
