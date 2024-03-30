<?php
include 'connection.php';

$plate_number = $_POST['plate_number'];

// Query untuk memeriksa apakah terdapat entri dengan exit_time kosong untuk nomor plat yang diberikan
$sql = "SELECT * FROM tbl_vehicleentry WHERE plate_number = '$plate_number' AND exit_time IS NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Jika terdapat entri dengan exit_time kosong, kirimkan respons bahwa exit_time masih kosong
    echo json_encode(array("status" => "exit_time_empty"));
} else {
    // Jika tidak terdapat entri dengan exit_time kosong, kirimkan respons bahwa exit_time tidak kosong
    echo json_encode(array("status" => "exit_time_not_empty"));
}

$conn->close();
?>