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
    $newname = $_POST['newname'];
    $newplatenumber = $_POST['newplatenumber'];


    $sql = "SELECT * FROM tbl_plateregist WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "UPDATE tbl_plateregist SET name = '$newname', plate_number = '$newplatenumber'WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "Name and plate number updated successfully";
        } else {
            echo "Error updating plate number: " . $conn->error;
        }
    } else {
        echo "Current plate number is incorrect";
    }
}

$conn->close();
