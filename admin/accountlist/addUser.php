<?php
// Include file untuk koneksi ke database
include 'connect.php';

// Cek koneksi ke database
if ($con->connect_error) {
    die("Koneksi gagal: " . $con->connect_error);
}

// Cek apakah tombol submit ditekan
if (isset($_POST['submit'])) {
    // Ambil nilai dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Query untuk memasukkan data ke dalam database
    $sql = "INSERT INTO tbl_account (username, password, role) VALUES ('$username', '$password', '$role')";

    // Eksekusi query
    if ($con->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    // Tutup koneksi ke database
    $con->close();
}
?>
