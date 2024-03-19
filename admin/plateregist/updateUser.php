<?php
$servername = "localhost";
$username = "root";
$password = "limbujosua23";
$dbname = "db_upark";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    $createDate = date("d F Y");

    $sql = "SELECT * FROM tbl_account WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "UPDATE tbl_account SET username = '$newUsername', password = '$newPassword', create_at = '$createDate' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Username & Password updated successfully";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Current password is incorrect";
    }
}

$conn->close();
