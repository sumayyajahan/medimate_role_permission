<?php
include_once '../include/config.php';

    $sql = "SELECT * FROM user_account";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row["user_id"];
            $name = $row["name"];
            $phone = $row["phone"];
            $present_address = $row["present_address"];
            $joining_date = date("d/m/Y", strtotime($row["joining_date"]));
            $defaulter_status = $row["defaulter_status"];
            echo json_encode(array(
                "user_id" => $user_id,
                "name" => ucwords($name),
                "phone" => $phone,
                "present_address" => ucwords($present_address),
                "joining_date" => $joining_date,
                "defaulted" => $defaulter_status
            ));
        }
    }
?>