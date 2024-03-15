
<?php
session_start();
// changes password belum jadi, masih error ini

// Pastikan form data dikirimkan dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file koneksi ke database
    include '../../dabaseconnect/connect.php';

    // Ambil nilai dari formulir
    $username = $_POST["username"];
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];

    // Periksa apakah username dan password lama cocok
    $query = "SELECT * FROM tbl_account WHERE username='$username' AND password='$oldPassword'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        // Jika username dan password lama cocok, update password baru
        $updateQuery = "UPDATE tbl_account SET password='$newPassword' WHERE username='$username'";
        if (mysqli_query($con, $updateQuery)) {
            echo "Password berhasil diubah!";
        } else {
            echo "Error: " . $updateQuery . "<br>" . mysqli_error($con);
        }
    } else {
        // Jika username dan password lama tidak cocok, kirimkan pesan kesalahan
        echo "password lama salah!";
    }

    // Tutup koneksi ke database
    mysqli_close($con);
} else {
    // Jika tidak ada data yang dikirimkan dengan metode POST, kirimkan pesan error
    echo "Metode pengiriman data bukan POST!";
}
?>
