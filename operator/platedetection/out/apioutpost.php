<?php
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(array("message" => "Metode yang diperbolehkan hanya POST"));
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['plate_number']) || empty($data['date'])) {
    http_response_code(400);
    echo json_encode(array("message" => "Data tidak lengkap. Pastikan semua field diisi"));
    exit;
}

include '../connection.php';

$plate_number = $data['plate_number'];
$date = $data['date'];

$sql = "INSERT INTO tbl_detectout (plate_number, date) VALUES ('$plate_number', '$date')";

if ($conn->query($sql) === TRUE) {
    http_response_code(201);
    echo json_encode(array("message" => "Data berhasil ditambahkan"));
} else {
    http_response_code(500);
    echo json_encode(array("message" => "Gagal menambahkan data: " . $conn->error));
}

$conn->close();
?>