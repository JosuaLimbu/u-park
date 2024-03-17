<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../../dabaseconnect/connect.php';

    // Ambil nilai dari sesi untuk mendapatkan username pengguna yang sedang masuk
    $username = $_SESSION["username"];
    $oldPassword = $_POST["old_password"];
    $newPassword = $_POST["new_password"];

    // Periksa apakah username dan password lama cocok
    $query = "SELECT * FROM tbl_account WHERE username='$username' AND password='$oldPassword'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        // Jika username dan password lama cocok, update password baru
        $updateQuery = "UPDATE tbl_account SET password='$newPassword' WHERE username='$username'";
        if (mysqli_query($con, $updateQuery)) {
            echo "Password berhasil diubah!";
        } else {
            echo "Error: " . $updateQuery . "<br>" . mysqli_error($con);
        }
    } else {
        // Jika username dan password lama tidak cocok, kirimkan pesan kesalahan
        echo "Password lama salah!";
    }

    mysqli_close($con);
} else {
    echo "Metode pengiriman data bukan POST!";
}
?>
