<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php';

    $name = $_POST["name"];
    $plate_number = $_POST["plate_number"];


    $sql_min_id = "SELECT MIN(t1.id) + 1 AS smallest_empty_id
                   FROM tbl_plateregist AS t1
                   LEFT JOIN tbl_plateregist AS t2 ON t1.id + 1 = t2.id
                   WHERE t2.id IS NULL";
    $result_min_id = mysqli_query($con, $sql_min_id);
    $row_min_id = mysqli_fetch_assoc($result_min_id);
    $new_id = $row_min_id['smallest_empty_id'];

    $sql = "INSERT INTO tbl_plateregist (id, name, plate_number) VALUES ('$new_id', '$name', '$plate_number')";

    if (mysqli_query($con, $sql)) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Terjadi kesalahan saat menambahkan data!"));
    }

    mysqli_close($con);
} else {
    echo json_encode(array("status" => "error", "message" => "Metode pengiriman data bukan POST!"));
}
