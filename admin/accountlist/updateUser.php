<?php
// Pastikan hanya permintaan POST yang diizinkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file koneksi database
    include 'connect.php';

    // Periksa apakah data yang diperlukan telah diterima dari permintaan
    if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['newPassword'])) {
        // Escape input untuk mencegah serangan SQL injection
        $id = mysqli_real_escape_string($con, $_POST['id']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $newPassword = mysqli_real_escape_string($con, $_POST['newPassword']);

        // Query SQL untuk memperbarui username dan password pengguna berdasarkan ID
        $sql = "UPDATE tbl_account SET username='$username', password='$newPassword', updated_at=NOW() WHERE id='$id'";

        // Eksekusi query dan periksa apakah berhasil
        if (mysqli_query($con, $sql)) {
            // Kirim respons berhasil ke klien
            echo "User updated successfully!";
        } else {
            // Kirim pesan kesalahan jika gagal menjalankan query
            echo "Error updating user: " . mysqli_error($con);
        }
    } else {
        // Kirim pesan kesalahan jika data yang diperlukan tidak diterima dari permintaan
        echo "Missing required data!";
    }

    // Tutup koneksi database
    mysqli_close($con);
} else {
    // Kirim pesan kesalahan jika metode permintaan tidak diizinkan
    echo "Method not allowed!";
}
?>