<?php
$servername = "localhost";
$username = "root";
$password = "limbujosua23";
$dbname = "db_upark";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die ("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT number_plate FROM tbl_detectin ORDER BY date DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array('number_plate' => $row['number_plate']);
    echo json_encode($data);
} else {
    echo "0 results";
}
$conn->close();

