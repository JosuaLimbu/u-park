<?php
// Atur header untuk respons JSON
header('Content-Type: application/json');

// Pastikan metode yang digunakan adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("message" => "Metode yang diperbolehkan hanya POST"));
    exit;
}

// Periksa apakah data telah diterima dengan benar
$data = json_decode(file_get_contents("php://input"), true);

// Periksa apakah data memiliki struktur yang sesuai
if (empty($data['plate_number']) || empty($data['date'])) {
    http_response_code(400); // Bad Request
    echo json_encode(array("message" => "Data tidak lengkap. Pastikan semua field diisi"));
    exit;
}

// Sambungkan ke database
include '../connection.php';

// Tangkap data dari request
$plate_number = $data['plate_number'];
$date = $data['date'];

// Buat query untuk memasukkan data ke dalam tabel
$sql = "INSERT INTO tbl_detectout (plate_number, date) VALUES ('$plate_number', '$date')";

// Jalankan query
if ($conn->query($sql) === TRUE) {
    http_response_code(201); // Created
    echo json_encode(array("message" => "Data berhasil ditambahkan"));
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(array("message" => "Gagal menambahkan data: " . $conn->error));
}

// Tutup koneksi database
$conn->close();
?>