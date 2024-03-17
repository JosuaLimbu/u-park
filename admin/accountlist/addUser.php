<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php';

    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $check_query = "SELECT * FROM tbl_account WHERE username = '$username'";
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo json_encode(array("status" => "error", "message" => "Username sudah ada di database!"));
        exit;
    }

    $currentDateTime = date('j F Y');

    $sql_min_id = "SELECT MIN(t1.id) + 1 AS smallest_empty_id
                   FROM tbl_account AS t1
                   LEFT JOIN tbl_account AS t2 ON t1.id + 1 = t2.id
                   WHERE t2.id IS NULL";
    $result_min_id = mysqli_query($con, $sql_min_id);
    $row_min_id = mysqli_fetch_assoc($result_min_id);
    $new_id = $row_min_id['smallest_empty_id'];

    $sql = "INSERT INTO tbl_account (id, username, password, role, create_at) VALUES ('$new_id', '$username', '$password', '$role', '$currentDateTime')";

    if (mysqli_query($con, $sql)) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Terjadi kesalahan saat menambahkan data!"));
    }

    mysqli_close($con);
} else {
    echo json_encode(array("status" => "error", "message" => "Metode pengiriman data bukan POST!"));
}
