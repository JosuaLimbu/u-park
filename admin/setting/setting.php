<?php
session_start();
if (!isset ($_SESSION["username"]) || !isset ($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: http://localhost/upark");
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
<style>
    :root {
        --blue: #04A6B5;
    }

    a {
        text-decoration: none;
    }
</style>

<body style="background-color: #eee;">
    <?php include '../components/sidebar/sidebar.php'; ?>
    <!-- CONTENT -->
    <section id="content">
        <!-- Include navbar -->
        <?php include '../components/navbar/navbar.php'; ?>
        <!-- MAIN -->
        <main>
            <!-- Main content -->
            <div class="head-title">
                <div class="left" style="font-family: 'Montserrat', sans-serif; font-weight: 600">
                    <p>Changes Password</p>
                </div>
            </div>
            <div class="container">
                
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
    var oldPassword = $('#old_password').val().trim();
    var newPassword = $('#new_password').val().trim();
    var confirmNewPassword = $('#confirm_new_password').val().trim();

    // Memeriksa apakah ada field yang kosong
    if (oldPassword === '' || newPassword === '' || confirmNewPassword === '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please fill in all fields!',
        });
        return;
    }

    // Memeriksa apakah password baru dan konfirmasi password cocok
    if (newPassword !== confirmNewPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'New Password and Confirm New Password do not match!',
        });
        return;
    }

    // Mengirim data form dengan AJAX
    $.ajax({
        type: 'POST',
        url: 'changePas.php', // Sesuaikan dengan URL skrip PHP Anda
        data: {
            old_password: oldPassword,
            new_password: newPassword,
            confirm_new_password: confirmNewPassword
        },
        success: function(response) {
            if (response === "PasswordChangedSuccessfully") {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response // Response dari skrip PHP (misalnya: "Password berhasil diubah!")
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response,
                });
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'An error occurred while changing password! Please try again later.',
            });
        }
    });
}


</script>

</body>

</html>