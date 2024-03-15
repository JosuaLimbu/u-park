<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $create_at = date("j F Y");
    $sql = "INSERT INTO `tbl_account` (role, username, password, create_at) VALUES ('$role', '$username', '$password', '$create_at')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        http_response_code(200);
        echo "Account added successfully!";
    } else {
        http_response_code(500);
        echo "Failed to add account.";
    }
} else {
    http_response_code(400);
    echo "Bad request!";
}
?>