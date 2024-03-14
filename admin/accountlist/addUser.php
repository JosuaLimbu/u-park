<?php
session_start();

// Pastikan form data dikirimkan dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file koneksi ke database
    include 'connect.php';

    // Ambil nilai dari formulir
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Tambahkan waktu saat ini
    $currentDateTime = date('Y-m-d H:i:s');

    // Contoh query untuk menyimpan data ke dalam database, termasuk waktu saat ini
    $sql = "INSERT INTO tbl_account (username, password, role, create_at) VALUES ('$username', '$password', '$role', '$currentDateTime')";

    // Eksekusi query
    if (mysqli_query($con, $sql)) {
        // Jika query berhasil dijalankan, kirimkan respons berhasil ke client
        echo "Data berhasil ditambahkan!";
    } else {
        // Jika query gagal dijalankan, kirimkan pesan kesalahan ke client
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Tutup koneksi ke database
    mysqli_close($con);
} else {
    // Jika tidak ada data yang dikirimkan dengan metode POST, kirimkan pesan error
    echo "Metode pengiriman data bukan POST!";
}
?>
