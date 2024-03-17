<?php
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "operator") {
    exit;
}
$page = ''; //buat page aktif di sidebar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
    <link rel="icon" type="image/png" href="../../img/U-Park.png">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="setting.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include '../components/sidebar/sidebar.php'; ?>
    <!-- CONTENT -->
    <section id="content">
        <!-- Include navbar -->
        <?php include '../components/navbar/navbar.php'; ?>
                <!-- MAIN -->
                <main>
            <!-- Main content -->
            
            <div class="container">
                <h2>Change Password</h2>

                <form action="changePas.php" method="POST">
                    <label for="old_password">Current Password:</label><br>
                    <input type="password" id="old_password" name="old_password" required><br>
                    <label for="new_password">New Password:</label><br>
                    <input type="password" id="new_password" name="new_password" required><br>

                    <label for="confirm_new_password">Confirm New Password:</label><br>
                    <input type="password" id="confirm_new_password" name="confirm_new_password" required><br>
                    <br>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Change Password</button>
                </form>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="../components/js/script.js"></script>
    <script src="../components/js/datetime.js"></script>
    <script src="../components/js/dropdown.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function submitForm() {
    // Code untuk mengirim form dengan AJAX
    $.ajax({
        type: 'POST',
        url: 'changePas.php', // Ganti dengan URL skrip PHP Anda
        data: $('form').serialize(),
        success: function(response) {
            // Jika berhasil, tampilkan popup dengan SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Password berhasil diubah!',
                text: response // Response dari skrip PHP (misalnya: "Password berhasil diubah!")
            });
        },
        error: function(error) {
            // Jika terjadi kesalahan, tampilkan pesan error
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat mengubah password!'
            });
        }
    });
}
</script>
</body>
</html>
