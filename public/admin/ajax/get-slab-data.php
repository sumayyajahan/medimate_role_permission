<?php
include_once '../include/config.php';
if (isset($_POST['slab_id'])) {
    $slab_id = $conn->real_escape_string($_POST['slab_id']);
    $sql = "SELECT * FROM slab WHERE slab_id = ".$slab_id;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $period = $row["period"];
            $amount = $row["amount"];
            $interest = $row["interest"];
            $fine = $row["fine"];
            echo json_encode(array(
                "period" => $period,
                "amount" => $amount,
                "interest" => $interest,
                "fine" => $fine
            ));
        }
    }
}
?>